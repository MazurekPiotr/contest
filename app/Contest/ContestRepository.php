<?php
namespace App\Contest;

use App\Contest\ContestRepositoryInterface;
use App\Contest\Contest;

class ContestRepository implements ContestRepositoryInterface
{
    private $contestRepository;

    function __construct(ContestRepositoryInterface $contestRepository)
    {
        $this->contestRepository = $contestRepository;
    }

    public function getAll()
    {
        return $this->contestRepository->getAll();
    }

    public function getContest($id)
    {
        return $this->contestRepository->getContest($id);
    }
}