<?php

declare(strict_types=1);

namespace App\Models;

class User
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $phone,
        public string $email,
        public string $country
    )
    {
    }
}
