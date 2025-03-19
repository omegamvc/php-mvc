<?php

declare(strict_types=1);

namespace App\Controllers;

use System\Http\Response;

use function System\Application\view;

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
