<?php

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

Broadcast::channel('notify-admin', function ($user) {
    return $user->isAdmin();
});

Broadcast::channel('notify-user.{id}', function ($user, $userId) {
    return $user->id == $userId;
});


