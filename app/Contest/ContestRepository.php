<?php
namespace App\Contest;

use App\Contest\Contest;

class ContestRepository implements ContestRepositoryInterface
{
    public function getAll()
    {
        return Contest::all();
    }

    public function getContest($id)
    {
        return Contest::find($id);
    }

    public function getContestantsFromContest($id)
    {
        return Contest::find($id)->users();
    }
}