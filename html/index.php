<?php

/**
 * Bellisq PHP Framework
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Bellisq. All Rights Reserved.
 * @package bellisq/bellisq
 * @since 1.0.0
 */

use Bellisq\Bellisq\Application;


require('../vendor/autoload.php');

(function () {
    $server = $_SERVER;
    $get = $_GET;
    $post = $_POST;
    $cookie = $_COOKIE;
    $files = $_FILES;
    $env = $_ENV;

    $_SERVER = [];
    $_GET = [];
    $_POST = [];
    $_COOKIE = [];
    $_FILES = [];
    $_ENV = [];

    new Application(
        $server,
        $get,
        $post,
        $cookie,
        $files,
        $env
    );
})();

