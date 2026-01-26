<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Determine whether a user is currently authenticated.
 *
 * Checks the application's session or authentication store for the presence
 * and validity of authentication credentials for the current request.
 *
 * @return bool True if an authenticated user session exists, false otherwise.
 */
function is_logged_in() {
    return isset($_SESSION['user']);
}

/**
 * Determine whether the current user has administrative privileges.
 *
 * Checks the application's authentication/session state to decide if the
 * currently authenticated user is an administrator. Returns true when the
 * user is logged in and has an admin role/flag, otherwise returns false.
 *
 * This function is read-only with respect to session/user data.
 *
 * @return bool True if the current user is an administrator, false otherwise.
 */
function is_admin() {
    return is_logged_in() && isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin';
}

/**
 * Retrieve the currently authenticated user.
 *
 * Attempts to obtain the user information from the application's authentication
 * storage (for example the session or a token) and returns it if available.
 *
 * @return array|null Associative array of user data when a user is authenticated, or null if no user is logged in.
 */
function get_user() {
    return $_SESSION['user'] ?? null;
}
?>