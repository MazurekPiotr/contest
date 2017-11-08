<?php

namespace App\Http\Controllers;

use App\User\UserRepositoryInterface;
use App\Contest\ContestRepositoryInterface;
use Illuminate\Http\Request;
use App\Contest\Contest;
use Carbon\Carbon;

class AdminController extends Controller
{
    private $userRepository;

    private $contestRepository;

    function __construct(UserRepositoryInterface $userRepository, ContestRepositoryInterface $contestRepository)
    {
        $this->userRepository = $userRepository;
        $this->contestRepository = $contestRepository;
    }

    public function contests() {
        $contests = $this->contestRepository->getAll();

        return view('admin.contests', compact(['contests']));
    }

    public function users() {
        $contests = $this->contestRepository->getAll();

        return view('admin.users', compact(['contests']));
    }

    public function createContest(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:3',
            'description' => 'required|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

        Contest::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'active' => false
        ]);

        $contests = $this->contestRepository->getAll();

        return view('admin.contests', compact(['contests']));
    }

    public function updateContest(Request $request) {
        $this->validate($request, [
            'contest' => 'required',
            'name' => 'min:1',
            'description' => 'required|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

        $contest = $this->contestRepository->getContest($request->contest);
        $contest->start_date = $request->start_date;
        $contest->end_date = $request->end_date;
        $contest->name = $request->name;
        $contest->save();

        $contests = $this->contestRepository->getAll();

        return view('admin.contests', compact(['contests']));
    }

    public function deleteUser($id) {

        $user = $this->userRepository->getUser($id);
        $user->delete();

        return redirect()->back();
    }

}
