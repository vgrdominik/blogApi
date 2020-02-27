<?php

// Only used to redirect password reset

Route::get('password-reset', function () {
    return redirect(config('ctic.spa_website'));
})->name('password.reset');
