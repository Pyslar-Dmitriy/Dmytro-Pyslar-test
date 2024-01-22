<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Interfaces\UsersResource;
use App\Models\User;
use Illuminate\Support\Collection;
use SimpleXMLElement;

class UsersXMLResource implements UsersResource
{
    public function readyForResponse(Collection $users): mixed
    {
        $xml = new SimpleXMLElement('<users></users>');

        foreach ($users as $user) {
            /** @var User $user */
            $userNode = $xml->addChild('user');
            $userNode->addChild('fullName', $user->firstName . ' ' . $user->lastName);
            $userNode->addChild('phone', $user->phone);
            $userNode->addChild('email', $user->email);
            $userNode->addChild('country', $user->country);
        }

        return $xml->asXML();
    }
}
