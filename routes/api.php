<?php

// this where api route will be 

use PhpSPA\Http\Request;
use PhpSPA\Http\Response;
use PhpSPA\Http\Router;

return function(Router $router) {

   $router->get('/api/users', function(Request $request, Response $response) {
      return $response->success('Received Information');
   });

};
