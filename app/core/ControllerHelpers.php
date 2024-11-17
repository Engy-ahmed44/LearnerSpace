<?php

namespace App\Core;

class ControllerHelpers
{
    /**
     * Check if the current request is a POST request.
     *
     * @return bool
     */
    public static function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Check if the current request is a GET request.
     *
     * @return bool
     */
    public static function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    /**
     * Sanitize input data.
     *
     * @param string $data
     * @return string
     */
    public static function sanitize($data)
    {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Redirect to a given URL.
     *
     * @param string $url
     * @return void
     */
    public static function redirect($url)
    {
        header('Location: /LearnerSpace/' . $url);
        exit;
    }

    /**
     * Get a specific POST parameter with optional default value.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function post($key, $default = null)
    {
        return isset($_POST[$key]) ? self::sanitize($_POST[$key]) : $default;
    }

    /**
     * Get a specific GET parameter with optional default value.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        return isset($_GET[$key]) ? self::sanitize($_GET[$key]) : $default;
    }
}
