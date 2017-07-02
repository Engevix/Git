<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$query = rtrim(substr($_SERVER["REQUEST_URI"], 1), "/");

require ("../vendor/core/Router.php");
require ("../vendor/libs/functions.php");
require ("../app/controllers/Main.php");
require ("../app/controllers/Posts.php");

//Router::add("posts/view", ["controller" => "Posts", "action" => "add"]);
//Router::add("posts", ["controller" => "Posts", "action" => "index"]);
//Router::add("", ["controller" => "Main", "action" => "index"]);

Router::add("^$", ["controller" => "Main", "action" => "index"]);

Router::add("^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$");/*

    Array
    (
    [0] => posts/index
    [controller] => posts
    [1] => posts
    [action] => index
    [2] => index
    )
 */

Router::dispatch($query);
debug(Router::getRoutes());

//if (Router::matchRoute($query)) {
//    debug(Router::getRoute());
//} else {
//    echo "404";
//}

