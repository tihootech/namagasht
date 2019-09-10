<?php

namespace App\Http\Controllers;

use App\Form;
use App\Question;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function index()
    {
        $forms = Form::latest()->get();
        return view('forms.index', compact('forms'));
    }

    public function create()
    {
        //
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

    public function show(Form $form)
    {
        dd('show');
        return view('forms.show', compact('form'));
    }

    public function edit(Form $form)
    {
        $question_id = request('qid');
        $question = $question_id ? Question::find($question_id) : new Question;
        $fragment = request('f') ?? 'main';
        return view("forms.edit.$fragment", compact('form', 'fragment', 'question'));
    }

    public function update(Request $request, Form $form)
    {
        dd($request->all());
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
            'no_label' => 'nullable|boolean',
            'double_size' => 'nullable|boolean',
            'decimal' => 'nullable|boolean',
            'zero_based' => 'nullable|boolean',
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
            Question::create($data);
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
        $message = __('messages.ITEM_REMOVED_SUCCESSFULLY');
        return back()->withMessage($message);
    }

    public function destroy(Form $form)
    {
        //
    }

    public function show_to_fill(Form $form, Question $question)
    {
        if (!$question->id) {
            $question = $form->welcome_page;
        }
        return view('forms.fill', compact('form', 'question'));
    }

    public function fill(Form $form, Question $question, Request $request)
    {
        if ($request->position == 'welcome_page') {
            $filler = $form->add_filler();
            $filler_uid = $filler->uid;
            session(compact('filler_uid'));
            $position = 0;
        }else {
            $position = $request->position;
        }
        $next_question = Question::where('form_id', $form->id)->where('position', '>', $position)->first();
        if (!$next_question->id) {
            Question::where('form_id', $form->id)->where('type', 'thanks_page')->first();
        }
        return redirect("form/$form->id/$next_question->id");
    }
}
