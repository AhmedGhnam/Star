<?php

namespace App\helpers;

use App\users\Models\User;

class Session {
    public static function start() {
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set(string $key, User|string $value) {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get(string $key) {
        self::start();
        return $_SESSION[$key] ?? null;
    }

    public static function destroy() {
        self::start();
        session_destroy();
    }

    public static function isLogged(): bool {
        return self::get('user') !== null;
    }

    public static function setRedirectAfterLogin(string $url): void {
        self::set('redirect_after_login', $url);
    }

    public static function getRedirectAfterLogin(): ?string {
        $url = self::get('redirect_after_login');
        unset($_SESSION['redirect_after_login']);
        return $url;

    }

    public static function isAdmin(): bool {
        $user = self::get('user');
        return isset($user->userRole) && $user->userRole === 'admin';
    }


}