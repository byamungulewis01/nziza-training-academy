<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Course;
use App\Models\Licence;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //index
    public function index()
    {
        $branches = Branch::all();
        $licences = Licence::all();
        $courses = Course::all();
        return view('settings.index', compact('branches', 'licences', 'courses'));
    }


}
