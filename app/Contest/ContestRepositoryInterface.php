<?php
namespace App\Contest;


interface ContestRepositoryInterface
{
    public function getAll();
    public function getContest($id);
}