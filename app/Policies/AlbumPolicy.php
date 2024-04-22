<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Album;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlbumPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // AlbumPolicy.php

    public function update(User $user, Album $album)
    {
        return $user->id === $album->user_id;
    }

    public function delete(User $user, Album $album)
    {
        return $user->id === $album->user_id;
    }
}
