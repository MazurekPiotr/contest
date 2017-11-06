<?php
namespace App\Contest;

use App\Contest\Contest;

class ContestRepository implements ContestRepositoryInterface
{
    public function getAll()
    {
        $contests = Contest::all();

        return $contests;
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