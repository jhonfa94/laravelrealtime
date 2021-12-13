<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


/*
    Definimos la serguridad del canal, donde se informa que si no esta autenticado el usuario
    no puede hacer uso del canal privado
*/
Broadcast::channel('notifications', function ($user) {
    return $user != null;
});
