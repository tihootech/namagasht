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
        //
    }

    public function edit(Form $form)
    {
        if ($question_id = request('qid')) {
            $question = Question::find($question_id);
        }else {
            $fragment = request('f') ?? 'main';
            $question = new Question;
        }
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

        // handle file upload
        $old_file = null;
        if ($request->has_file) {
            if ($new_file = $request->file) {
                $data['file_path'] = upload($new_file, $old_file);
            }
        }elseif($request->question_id) {
            delete_file($old_file);
        }

        // store or update record in database
        if ($question_id = $request->question_id) {
            $question = Question::find($question_id);
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
        dd($qid);
    }

    public function destroy(Form $form)
    {
        //
    }
}
