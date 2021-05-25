<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class UserPolicy
{
    use HandlesAuthorization;

    public function isAdmin(User $user){

        Log::debug($user->is_admin);

        if($user->is_admin){
            return true;
        }
        return false;
    }
}
