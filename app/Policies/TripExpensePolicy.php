<?php

namespace App\Policies;

use App\Models\TripExpense;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TripExpensePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, int $tripId): bool
    {
        return $user->tripIds->contains($tripId);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TripExpense $tripExpense): bool
    {
        return $tripExpense->trip->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, int $tripId): bool
    {
        return $user->tripIds->contains($tripId);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TripExpense $tripExpense): bool
    {
        return $user->id === $tripExpense->trip->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TripExpense $tripExpense): bool
    {
        return $user->id === $tripExpense->trip->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TripExpense $tripExpense): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TripExpense $tripExpense): bool
    {
        return $user->id === $tripExpense->trip->user_id;
    }

    public function attach(User $user, TripExpense $tripExpense): bool
    {
        return $user->id === $tripExpense->trip->user_id;
    }

    public function detach(User $user, TripExpense $tripExpense): bool
    {
        return $user->id === $tripExpense->trip->user_id;
    }
}
