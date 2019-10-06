<?php

namespace App\Exports;

use App\Form;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FormsExport implements FromView
{
    public function view(): View
    {
		$form_id = session('form_id');
		session(['form_id' => null]);
        return view('forms.partials.form_report', [
            'form' => Form::find($form_id)
        ]);
    }
}
