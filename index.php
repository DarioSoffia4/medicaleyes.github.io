<?php
 if(!isset($_SESSION)) { 
     session_start(); 
 } 

$uri = strtolower(parse_url($_SERVER['REQUEST_URI'])['path']);


$routes = [
    '/medicaleyes/' => 'controllers/index.php',
    '/medicaleyes/home' => 'controllers/index.php',
    '/medicaleyes/login' => 'controllers/login.php',
    '/medicaleyes/signup' => 'controllers/signup.php',
    '/medicaleyes/dashboard' => 'controllers/dashboard.php',
    '/medicaleyes/aipredict' => 'controllers/aipredict.php',
    '/medicaleyes/projects' => 'controllers/projects.php',
    '/medicaleyes/upload' => 'functions/upload.php',
    '/medicaleyes/delete' => 'functions/delete.php'
];


if(array_key_exists($uri,$routes)){
    require $routes[$uri];
}else{
    echo "404 - Not found";
}