<?php

declare(strict_types=1);

namespace App\Providers;

use DI\DependencyException;
use DI\NotFoundException;
use Omega\Http\Response;
use Omega\Integrate\ServiceProvider;
use Omega\Integrate\Vite;
use Omega\View\Templator;
use Omega\View\TemplatorFinder;

use function array_merge;
use function file_exists;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * @return void
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function boot(): void
    {
        $this->registerViteResolver();
        $this->registerViewResolver();
    }

    /**
     * @return void
     */
    protected function registerViteResolver(): void
    {
        $this->app->set('vite.gets', fn (): Vite => new Vite($this->app->publicPath(), '/build/'));
        $this->app->set('vite.location', fn (): string => $this->app->publicPath() . '/build/manifest.json');
        $this->app->set('vite.hasManifest', fn (): bool => file_exists($this->app->get('vite.location')));
    }

    /**
     * @return void
     * @throws NotFoundException
     * @throws DependencyException
     */
    protected function registerViewResolver(): void
    {
        $globalTemplateVar = [
            'vite_has_manifest' => $this->app->get('vite.hasManifest'),
            'vite_hmr_script'   => $this->app->get('vite.gets')->isRunningHRM()
                ? $this->app->get('vite.gets')->getHmrScript()
                : '',
        ];
        $extensions = $this->app->get('config')['VIEW_EXTENSIONS'] ?? [];

        $this->app->set(TemplatorFinder::class, fn () => new TemplatorFinder(view_paths(), $extensions));
        $this->app->set('view.instance',
            fn () => new Templator($this->app->get(TemplatorFinder::class), compiled_view_path())
        );
        $this->app->set(
            'view.response',
            fn () => fn (string $view, array $data = []): Response => new Response(
                $this->app->get('view.instance')->render($view, array_merge($data, $globalTemplateVar))
            )
        );
    }
}
