<?php

// this where api route will be 

use PhpSPA\Http\Router;

return function(Router $router) {
   $router->get('/api/users', require __DIR__ . '/../controllers/UsersController.php');
};
