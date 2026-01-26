<?php

/**
 * Dump a variable for debugging and terminate the script.
 *
 * Prints a readable representation of the provided variable (wrapped in <pre> tags when
 * running in a web context) and then halts execution. Useful for quick debugging to
 * inspect values and stop further processing.
 *
 * @param mixed $variable The value to display (any type).
 * @return void This function exits the script; it does not return.
 */
function debug_and_die($variable) {
    echo '<pre style="background: #222; color: #0f0; padding: 20px; z-index: 9999; position: relative; border: 2px solid red;">';
    echo '<strong>Debug :</strong><br>';
    var_dump($variable);
    echo '</pre>';
    die();
}

/**
 * Escape a string for safe HTML output.
 *
 * Converts special characters to their corresponding HTML entities to prevent
 * cross-site scripting (XSS) when rendering user-supplied content in HTML.
 *
 * @param string $string The input string to be escaped.
 * @return string The escaped string, safe for inclusion in HTML output.
 */
function escape_html($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Redirects the client to the specified URL.
 *
 * Sends an HTTP Location header and terminates script execution to ensure no further output is sent.
 *
 * @param string $url The target URL to redirect to (absolute or relative).
 * @return void
 *
 * Note: No output must be sent before calling this function (headers must not have been sent).
 */
function redirect_to($url) {
    header("Location: $url");
    exit();
}
?>