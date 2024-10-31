<?php

namespace App\Policies;

use App\Models\CommitteeMeeting;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommitteeMeetingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission([
            'view all committee meetings',
            'view own committee meetings',
            'view member committee meetings'
        ]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CommitteeMeeting $committeeMeeting): bool
    {
        // Super admin can view any meeting
        if ($user->hasRole('Super-Admin')) {
            return true;
        }

        if ($user->hasPermissionTo('view all committee meetings')) {
            return true;
        }

        if ($user->hasPermissionTo('view own committee meetings')) {
            return $committeeMeeting->user_id === $user->id ||
                $committeeMeeting->members()->where('user_id', $user->id)->exists();
        }

        if ($user->hasPermissionTo('view member committee meetings')) {
            return $committeeMeeting->members()->where('user_id', $user->id)->exists();
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CommitteeMeeting $committeeMeeting): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CommitteeMeeting $committeeMeeting): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CommitteeMeeting $committeeMeeting): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CommitteeMeeting $committeeMeeting): bool
    {
        //
    }
}
