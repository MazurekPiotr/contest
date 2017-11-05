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
        ]);

        $contests = $this->contestRepository->getAll();

        return view('admin.contests', compact(['contests']));
    }

    public function deleteUser($id) {

        $user = $this->userRepository->getUser($id);
        $user->delete();

        return redirect()->back();
    }

}
