<?php


declare(strict_types=1);


namespace App\Repositories;

use App\Models\User;

class UserRepositoryEloquent implements Interfaces\UserRepository
{
    private $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function repository(): User
    {
        return $this->users;
    }

    public function getAgents()
    {
        return $this->users::where('role', User::$support_agent);
    }

    public function getComplainants()
    {
        return $this->users::where('role', User::$complainant);
    }

    public function getAdmins()
    {
        return $this->users::where('role', User::$admin);
    }
}
