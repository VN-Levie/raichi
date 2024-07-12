<?php

namespace System;

class View
{

    public static function render($path, $data = [])
    {
        try {
            global $user, $route;
            $data[] = $user;
            $data[] = $route;
            extract($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    // renderPartial
    private static function get_contents($path)
    {
        $path = str_replace('.', '/', $path);
        $contents = null;
        // echo $path;
        if (file_exists($path . '.php')) {
            $contents = file_get_contents($path . '.php');
        } elseif (file_exists($path . '.blade.php')) {
            $contents = file_get_contents($path . '.blade.php');
        } elseif (file_exists($path . '.html')) {
            $contents = file_get_contents($path . '.html');
        }
        if ($contents == null) {
            throw new \Exception("View <strong>'{$path}'</strong> not found.");
        }
        return $contents;
    }


    private static function template($text, $path = null)
    {
        global $user, $route;
        return $text;
    }





    public static function abort($code, $message = null)
    {
        $data = [
            'error_code' => $code,
            'error_message' => $message
        ];
        http_response_code($code);
        extract($data);
        require '../resources/views/error.blade.php';
        exit;
    }
}
