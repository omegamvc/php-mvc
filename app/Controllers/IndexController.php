<?php

namespace App\Controllers;

use System\Http\Response\Response;

class IndexController extends Controller
{
    public function index(): Response
    {
        return view('index', [
            'title' => 'Php is great',
            'say'   => 'hello, php enthusiastic!',
        ]);
    }
}
