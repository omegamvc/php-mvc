<?php

declare(strict_types=1);

namespace App\Controllers;

use DI\DependencyException;
use DI\NotFoundException;
use System\Http\Response;

use function array_key_exists;
use function file_exists;
use function method_exists;
use function str_replace;
use function System\Application\app;
use function System\Application\services_path;

class ApiController extends Controller
{
    /**
     * @param string $unit
     * @param string $action
     * @param string $version
     * @return Response
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function index(string $unit, string $action, string $version): Response
    {
        /** @var array<string, int|string|array<string, string>> $api */
        $api = $this->getService($unit, $action, $version);

        $status   = array_key_exists('code', $api) ? (int) $api['code'] : 200;
        /** @var array<string, string> $header */
        $header   = array_key_exists('headers', $api) ? $api['headers'] : [];
        unset($api['headers']);
        $response = new Response($api, $status);

        $response
            ->headers
            ->add($header)
            ->remove('Expires')
            ->remove('Pragma')
            ->remove('X-Powered-By')
            ->remove('Connection')
            ->remove('Server');

        return $response->json();
    }

    /**
     * @param string $serviceName
     * @param string $methodName
     * @param string $version
     * @return array<string, mixed>
     * @throws DependencyException
     * @throws NotFoundException
     */
    protected function getService(string $serviceName, string $methodName, string $version): array
    {
        $serviceName .= 'Service';
        $serviceName  = str_replace('-', '', $serviceName);
        $methodName   = str_replace('-', '_', $methodName);

        if (file_exists(services_path($serviceName . '.php'))) {
            $service = new $serviceName();
            if (method_exists($service, $methodName)) {
                /** @var array<string, mixed> $resultWrap */
                $resultWrap = app()->call([$service, $methodName], ['version' => $version]);

                return $resultWrap;
            }

            // method not found
            return [
                'status'  => 'Bad Request',
                'code'    => 400,
                'error'   => [
                    'server'  => 'Bad Request',
                    'layer'   => 1,
                ],
                'headers' => ['HTTP/1.1 400 Bad Request'],
            ];
        }

        // page not found
        return [
            'status'  => 'Service Not Found',
            'code'    => 404,
            'error'   => [
                'server'  => 'Service Not Found',
                'layer'   => 1,
            ],
            'headers' => ['HTTP/1.1 404 Service Not Found'],
        ];
    }
}
