<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface UsersResource
{
    public function readyForResponse(Collection $users): mixed;
}
