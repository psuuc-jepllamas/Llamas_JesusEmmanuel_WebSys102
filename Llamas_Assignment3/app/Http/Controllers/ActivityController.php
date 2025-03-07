<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function showData(){
        return view('activity');
    }

    public function process(Request $request){
        $validated = $request->validate([
            'fname' => 'required|string|max:50',
            'lname' => 'required|string|max:50',
            'sex' => 'required',
            'birthdate' => 'required|date|date_format:Y-m-d',
            'mobile' => 'required', 'regex:/^(0998|0999|0920)-\d{3}-\d{3}$/',
            'telno' => 'required|numeric|digits_between:7,15',
            'address' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'website' => 'required|url|max:255',
        ]);

        return back() -> with('success', 'Form submitted successfully!');
    }
}
