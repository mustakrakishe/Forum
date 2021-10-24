<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Topic;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Topic $topic)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Topic $topic)
    {
        return $user->id === $topic->author_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Topic $topic)
    {
        return $user->id === $topic->author_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Topic $topic)
    {
        return $user->id === $topic->author_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Topic $topic)
    {
        return $user->id === $topic->author_id;
    }

    /**
     * Determine whether the user can validate the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */

    public function validateTopic(User $user)
    {
        return true;
    }
}
