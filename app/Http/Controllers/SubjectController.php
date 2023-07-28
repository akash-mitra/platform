<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function get(Subject $subject)
    {
        return view('private.subject', [
            'subject' => $subject,
            'posts' => $subject->posts()->orderBy('order')->get(),
        ]);
    }
}
