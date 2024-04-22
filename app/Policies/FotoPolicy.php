<?php

namespace App\Policies;

use App\Models\Foto;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FotoPolicy
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
    // FotoPolicy.php

    public function update(User $user, Foto $foto)
    {
        return $user->id === $foto->user_id;
    }

    public function delete(User $user, Foto $foto)
    {
        return $user->id === $foto->user_id;
    }
    public function view(User $user, Foto $photo)
    {
        return $user->id === $photo->user_id;
    }
}
