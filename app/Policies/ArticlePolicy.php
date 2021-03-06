<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User $user
     * @param  Article $article
     * @return mixed
     */
    public function view(User $user, Article $article)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     * @param  User $user
     * @param  Article $article
     * @return mixed
     */
    public function update(User $user, Article $article)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     * @param  User $user
     * @param  Article $article
     * @return mixed
     */
    public function delete(User $user, Article $article)
    {
        return $user->isAdmin();
    }
}
