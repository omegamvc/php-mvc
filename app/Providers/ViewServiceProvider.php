<?php

declare(strict_types=1);

namespace App\Providers;

use System\Container\Exception\DependencyResolutionException;
use System\Container\Exception\ServiceNotFoundException;
use System\Http\Response\Response;
use System\Container\ServiceProvider\AbstractServiceProvider;
use System\Support\Vite;
use System\View\Templator;
use System\View\TemplatorFinder;

use function array_merge;

class ViewServiceProvider extends AbstractServiceProvider
{
    /**
     * @throws ServiceNotFoundException
     * @throws DependencyResolutionException
     */
    public function boot(): void
    {
        $this->registerViteResolver();
        $this->registerViewResolver();
    }

    protected function registerViteResolver(): void
    {
        $this->app->set('vite.gets', fn (): Vite => new Vite($this->app->getPublicPath(), '/build/'));
        $this->app->set('vite.location', fn (): string => $this->app->getPublicPath() . '/build/manifest.json');
        $this->app->set('vite.hasManifest', fn (): bool => file_exists($this->app->get('vite.location')));
    }

    /**
     * @throws ServiceNotFoundException
     * @throws DependencyResolutionException
     */
    protected function registerViewResolver(): void
    {
        $global_template_var = [
            'vite_has_manifest' => $this->app->get('vite.hasManifest'),
        ];
        $extensions = $this->app->get('config')['VIEW_EXTENSIONS'] ?? [];

        $this->app->set(TemplatorFinder::class, fn () => new TemplatorFinder(view_paths(), $extensions));
        $this->app->set('view.instance', fn () => new Templator($this->app->get(TemplatorFinder::class), get_storage_path('app/view/')));
        $this->app->set(
            'view.response',
            fn () => fn (string $view, array $data = []): Response => new Response(
                $this->app->get('view.instance')->render($view, array_merge($data, $global_template_var))
            )
        );
    }
}
