<?php

namespace App\Http\Controllers;

use App\Form;
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
        $form = Form::create($data);
        return redirect("forms/$form->id/edit");
    }

    public function show(Form $form)
    {
        //
    }

    public function edit(Form $form)
    {
        $fragment = request('f') ?? 'main';
        return view("forms.edit.$fragment", compact('form', 'fragment'));
    }

    public function update(Request $request, Form $form)
    {
        dd($request->all());
    }

    public function destroy(Form $form)
    {
        //
    }
}
