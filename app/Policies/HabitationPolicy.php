<?php

namespace App\Policies;

use App\Models\Habitation;
use App\Models\User;

class HabitationPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function canUpdateOrDelete(User $user, Habitation $habitation) {
        return $user->id == $habitation->user_id;
    }
}
