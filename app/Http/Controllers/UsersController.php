<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\UsersXMLResource;
use App\Interfaces\UsersService;
use App\Interfaces\UsersResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

class UsersController extends Controller
{
    public function getUsers(Request $request): Response
    {
        $limit = $request->limit ?? 10;
        $users = new Collection();

        $instance = App::make(UsersService::class);

        for ($i = 0; $i < $limit; $i++) {
            $users->add($instance->getUser());
        }

        $sorted = $users->sortBy([
            fn (User $a, User $b) => $b->lastName <=> $a->lastName
        ]);

        $resource = App::make(UsersResource::class);
        $formatted = $resource->readyForResponse($sorted);
        $header = $resource instanceof UsersXMLResource ? 'application/xml' : 'application/json';

        return response(content: $formatted)->header('Content-Type', $header);
    }
}
