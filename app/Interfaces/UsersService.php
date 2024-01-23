<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\User;

interface UsersService
{
    public function getUser(): User;
}
