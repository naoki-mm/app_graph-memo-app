<?php

namespace App\Policies;

use App\Graph;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GraphPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any graphs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create graphs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the graph.
     *
     * @param  \App\User  $login_user
     * @param  \App\Graph  $request_graph
     * @return bool
     */
    public function update(User $login_user, Graph $request_graph)
    {
        return $login_user->id === $request_graph->user_id;
    }

    /**
     * Determine whether the user can delete the graph.
     *
     * @param  \App\User  $user
     * @param  \App\Graph  $graph
     * @return mixed
     */
    public function delete(User $user, Graph $graph)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the graph.
     *
     * @param  \App\User  $user
     * @param  \App\Graph  $graph
     * @return mixed
     */
    public function restore(User $user, Graph $graph)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the graph.
     *
     * @param  \App\User  $user
     * @param  \App\Graph  $graph
     * @return mixed
     */
    public function forceDelete(User $user, Graph $graph)
    {
        return true;
    }
}
