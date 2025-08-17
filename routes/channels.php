<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('teacher-import-channel', function ($user) {
    // otorisasi user jika perlu, return true supaya bisa subscribe
    return true;
});
