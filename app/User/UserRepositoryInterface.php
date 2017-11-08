<?php
namespace App\User;

interface UserRepositoryInterface
{
    public function getUser($id);
    public function getUserByMail($mail);
    public function getAll();
    public function deleteUser($id);
}