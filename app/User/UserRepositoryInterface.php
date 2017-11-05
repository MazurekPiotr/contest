<?php
namespace App\User;

interface UserRepositoryInterface
{
    public function getUser($id);
    public function getAll();
}