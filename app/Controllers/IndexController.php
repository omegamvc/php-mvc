<?php

declare(strict_types=1);

namespace App\Controllers;

use DI\DependencyException;
use DI\NotFoundException;
use Omega\Http\Response;

class IndexController extends Controller
{
    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function index(): Response
    {
        return view('index', [
            'title' => 'Php is great',
            'say'   => 'hello, php enthusiastic!',
        ]);
    }
}
