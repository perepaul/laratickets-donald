<?php


declare(strict_types=1);


namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepository
{
    public function repository(): User;
}
