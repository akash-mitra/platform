<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Models\Subject;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function get(Series $series)
    {
        return view('private.subject', [
            'series' => $series,
            'subjects' => $series->subjects()->orderBy('order')->get(),
        ]);
    }
}
