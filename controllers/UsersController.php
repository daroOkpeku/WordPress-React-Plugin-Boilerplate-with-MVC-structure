<?php

use PhpSPA\Http\Request;
use PhpSPA\Http\Response;

function(Request $request, Response $response) {
   return $response->success('Received Information');
};
