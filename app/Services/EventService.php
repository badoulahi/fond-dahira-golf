<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventService
{
    public function eventService(string $action)
    {
        $user = $this->getCurrentUser();

        Event::create([
            'user_id' => $user ? $user->id : null,
            'action' => $action,
        ]);

    }

    private function getCurrentUser()
    {
        foreach (['auth-manager', 'auth-employer'] as $guard) {
            if (Auth::guard($guard)->check()) {
                return Auth::guard($guard)->user();
            }
        }
        return null;
    }
}
