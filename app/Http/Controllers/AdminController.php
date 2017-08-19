<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contest;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function contests() {
        $contests = Contest::all();

        return view('admin.contests', compact(['contests']));
    }

    public function users() {
        return view('admin.users');
    }

    public function createContest(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:3',
            'description' => 'required|min:1',
            'question' => 'required|min:1',
            'answer' => 'required|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

        Contest::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'question' => $request->get('question'),
            'answer' => $request->get('answer')
        ]);

        $contests = Contest::all();

        return view('admin.contests', compact(['contests']));
    }

}
