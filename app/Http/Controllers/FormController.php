<?php

namespace App\Http\Controllers;

use App\Form;
use App\Question;
use App\Filler;
use App\Answer;
use App\QuestionAsset as Asset;
use App\QuestionPointRule as Rule;

use Carbon\Carbon;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function index()
    {
        $forms = Form::latest()->get();
        return view('forms.index', compact('forms'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);
        $data['created_by'] = 0;
        $data['uid'] = random_sha();
        $form = Form::create($data);
        $message = __('messages.FORM_CREATED_SUCCESSFULLY');
        return redirect("forms/$form->id/edit")->withMessage($message);
    }

    public function edit(Form $form)
    {
        $question_id = request('qid');
        $question = $question_id ? Question::find($question_id) : new Question;
        $fragment = request('f') ?? 'main';
        $action = 'edit';
        $duplicate = request('d') ?? false;
        return view("forms.edit.$fragment", compact('form', 'fragment', 'question', 'action', 'duplicate'));
    }

    public function update(Request $request, Form $form)
    {
        if (is_array($request->update)) {
            foreach ($request->update as $field => $value) {
                $form->$field = $value;
            }
        }
        if ($request->bg_image) {
            $form->bg_image = upload($request->bg_image, $form->bg_image);
        }
        if ($request->delete_bg) {
            $form->bg_image = delete_file($form->bg_image);
        }
        $form->save();
        $message = __('messages.CHANGES_MADE_SUCCESSFULLY');
        return back()->withMessage($message);
    }

    public function question(Request $request)
    {
        // validate incoming data
        $data = $request->validate([
            'title' => 'required',
            'type' => 'required',
            'form_id' => 'required|exists:forms,id',
            'description' => 'nullable|string',
            'button' => 'nullable|string',
            'right_label' => 'nullable|string',
            'left_label' => 'nullable|string',
            'center_label' => 'nullable|string',
            'shape' => 'nullable|string',
            'min' => 'nullable|integer',
            'max' => 'nullable|integer',
            'range' => 'nullable|integer',
            'required' => 'nullable|boolean',
            'randomize' => 'nullable|boolean',
            'vertical' => 'nullable|boolean',
            'multiple' => 'nullable|boolean',
            'alphabet' => 'nullable|boolean',
            'no_label' => 'nullable|boolean',
            'double_size' => 'nullable|boolean',
            'decimal' => 'nullable|boolean',
            'zero_based' => 'nullable|boolean',
            'share' => 'nullable|boolean',
            'auto_reload' => 'nullable|integer',
        ]);

        // define question variable
        $question = Question::find($request->question_id) ?? new Question;

        // handle file upload
        $old_file = $question->id ? $question->file_path : null;
        if ($request->has_file) {
            if ($new_file = $request->file) {
                $data['file_path'] = upload($new_file, $old_file);
            }
        }elseif($old_file) {
            $data['file_path'] = null;
            delete_file($old_file);
        }

        // set position if it's a new question
        if ($request->type != 'welcome_page' && $request->type != 'thanks_page' && !$request->question_id) {
            $position = Question::where('form_id', $request->form_id)->max('position');
            $data['position'] = $position + 1;
        }

        // unset variables
        if (!$request->has_description) $data['description'] = null;
        if (!$request->has_button) $data['button'] = null;

        // store or update record in database
        if ($question->id) {
            $question->update($data);
        }else {
            $question = Question::create($data);
        }

        // store choices if any
        if ($choices = $request->choices) {
            if (!is_array($choices)) {
                $choices = explode("\r\n", $choices);
            }
            $question->update_choices($choices, $request->choices_id, $request->choices_file);
            $question->sort_choices();
        }

        // redirection
        $message = __('messages.CHANGES_MADE_SUCCESSFULLY');
        return redirect("forms/$request->form_id/edit")->withMessage($message);
    }

    public function delete_question($qid)
    {
        $question = Question::find($qid);
        if ($question->file_path) {
            delete_file($question->file_path);
        }
        $question->delete();
        $form = $question->form;
        $form->sort_questions_position();
        foreach ($question->assets as $asset) {
            delete_file($asset->image_path);
            $asset->delete();
        }
        $message = __('messages.ITEM_REMOVED_SUCCESSFULLY');
        return back()->withMessage($message);
    }

    public function show_to_fill($form_uid, Question $question)
    {
        $form = Form::where('uid', $form_uid)->first();
        if ($form) {
            $filler = Filler::where('uid', session('filler_uid'))->first();
            if (!$question->id || !$filler) {
                $question = $form->welcome_page;
            }
            $preview = request('p');
            return view('forms.fill', compact('form', 'question', 'preview'));
        }else {
            abort(404);
        }
    }

    public function fill(Form $form, Question $question, Request $request)
    {

        // create filler in database an store his unique id in session if not already happened
        $filler = Filler::where('uid', session('filler_uid'))->first();
        if (!$filler) {
            $filler = $form->add_filler();
            $filler_uid = $filler->uid;
            session(compact('filler_uid'));
            $first_question = $form->first_question;
            return redirect("form/$form->uid/$first_question->id");
        }
        if ($request->dir == 'next') {

            if( !$request->preview && !in_array($question->type, Form::$filters) ) {
                // register filler answer
                $answer = is_array($request->answer) ? implode('&&&', $request->answer) : $request->answer;
                if ($question->type == 'upload_file') {
                    $answer = upload($request->answer);
                }
                $question->register_answer($filler->id, $answer);
            }

            $target_question = $question->next();

        }else {

            $target_question = $question->prev();

        }


        // redirection
        if ($target_question) {
            // go to next or prev question
            return redirect("form/$form->uid/$target_question->id")->withTheme($request->theme);
        }else {
            // finish form filling process
            $form->update_points($filler);
            $filler_uid = session('filler_uid');
            $filler = Filler::where('uid', $filler_uid)->first();
            $filler->finish();
            session()->forget('filler_uid');
            return redirect("form/$form->uid")->withFinished(1);
        }
    }

    public function display_action(Form $form, $action, $page=null, Request $request)
    {
        if ($page=='table' && $request->search) {
            $fillers = Filler::query();
            if ($request->from) {
                $fillers = $fillers->where('created_at', '>=' , persian_to_carbon($request->from));
            }
            if ($request->untill) {
                $fillers = $fillers->where('created_at', '<=' , persian_to_carbon($request->untill));
            }
            if ($request->points) {
                $fillers = $fillers->where('points', $request->op , $request->points);
            }
            $fillers = $fillers->get();
        }
        $fragment = null;
        return view("forms.actions.$action", compact('form', 'action', 'page', 'fillers', 'fragment'));
    }

    public function delete_filler(Request $request)
    {
        if ($request->ids) {
            foreach ($request->ids as $id) {
                $filler = Filler::find($id);
                if ($filler) {
                    $filler->delete();
                    Answer::where('filler_id', $filler->id)->delete();
                }
            }
            $message = __('messages.ITEMS_REMOVED_SUCCESSFULLY');
            return back()->withMessage($message);
        }else {
            return back()->withError(__('messages.NO_CHECKED_ID'));
        }
    }

    public function point_rule(Question $question, Request $request)
    {
        $inputs = prepare_multiple($request->all());
        Rule::where('question_id', $question->id)->delete();
        foreach ($inputs as $record) {
            $record['question_id'] = $question->id;
            Rule::create($record);
        }
        $message = __('messages.CHANGES_MADE_SUCCESSFULLY');
        return back()->withMessage($message);
    }

    public function question_positions(Form $form, Request $request)
    {
        foreach ($request->all() as $i => $id) {
            $question = Question::find($id);
            $question->position = $i+1;
            $question->save();
        }
    }

    public function destroy(Form $form)
    {

        foreach ($form->all_questions as $question) {

            foreach ($question->assets as $asset) {
                delete_file($asset->image_path);
            }
            if ($question->type=='upload_file') {
                foreach ($question->answers as $answer) {
                    delete_file($answer->body);
                }
            }
            delete_file($question->file_path);

            Rule::where('question_id', $question->id)->delete();
            Asset::where('question_id', $question->id)->delete();
            Answer::where('question_id', $question->id)->delete();

        }

        Filler::where('form_id', $form->id)->delete();
        Question::where('form_id', $form->id)->delete();
        delete_file($form->bg_image);
        $form->delete();

        $message = __('messages.ITEM_REMOVED_SUCCESSFULLY');
        return back()->withMessage($message);
    }
}
