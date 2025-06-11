<p align="center">
    <a href="https://omegamvc.github.io" target="_blank">
        <img src="https://github.com/omegamvc/omega-assets/blob/main/images/logo-omega.png" alt="Omega Logo">
    </a>
</p>

<p align="center">
    <a href="https://omegamvc.github.io">Documentation</a> |
    <a href="https://github.com/omegamvc/omegamvc.github.io/blob/main/README.md#changelog">Changelog</a> |
    <a href="https://github.com/omegamvc/omega/blob/main/CONTRIBUTING.md">Contributing</a> |
    <a href="https://github.com/omegamvc/omega/blob/main/CODE_OF_CONDUCT.md">Code Of Conduct</a> |
    <a href="https://github.com/omegamvc/omega/blob/main/LICENSE">License</a>
</p>

# PHP MVC
Welcome to **php-mvc**, a minimal MVC framework designed to streamline your PHP development process. This lightweight framework offers essential features for building web applications while maintaining simplicity and ease of use.

## Feature
- MVC structure
- Application Container (power with [php-di](https://github.com/PHP-DI/PHP-DI))
- Router Support
- Models builder
- Query builder
- CLI command
- Service Provider and Middleware
- Templator (template engine)

## Getting Started in 4 Simple Steps

1. **Create Your Application**:

```bash
composer create-project omegamvc/php-mvc project-name
```

2. **Navigate to Your Project**:

```bash
cd project-name
```

3. **Build Your Assets**:

```bash
npm install
npm run build
```

4. **Serve Your Application**:

```bash
php cli serve
```

## Additional Features ✨

### CLI Commands for Building Your App

```bash
# Create migration schema
php cli make:migration profiles
php cli db:create # skip if database already exists
php cli migrate

# Create a model
php cli make:model Profile --table-name profiles

# Create controller (or API services)
php cli make:controller Profile
php cli make:services Profile

# Presenter for HTML response
php cli make:view profile
```

### Example Code Snippets

#### Migration Schema
```php
// database/migration/<timestamp>_profile.php

Schema::table('profiles', function (Create $column) {
    $column('user')->varChar(32);
    $column('real_name')->varChar(100);

    $column->primaryKey('user');
});
```

#### Controller
```php
// app/Controller/ProfileController.php

public function index(MyPDO $pdo): Response
{
    return view('profiles', [
        'name' => Profile::find('omega', $pdo)->real_name
    ]);
}
```

#### Services (rest api out of the box)
Api ready to go `http://localhost:8080/api/profile/index`.
```php
// app/services/ProfileServices.php

public function index(MyPDO $pdo): array
{
    return [
        'name'   => Profile::find('omega', $pdo)->real_name,
        'status' => 200,
        'header' => []
    ];
}
```

#### View
```php
// resources/views/profile.template.php

{% extend('base/base.template.php') %}

{% section('title', 'hay {{ $name }}') %}

{% section('content') %}
<p>{{ $name }}</p>
{% endsection %}
```

### Router Configuration
```php
// route/web.php

Router::get('/profile', Profile::class);
```

### Optimize
Optimize by cached Application.
```bash
# cache view compiler
php cli view:cache
# cache application config
php cli config:cache
```

### Integrate Server
You can start the built-in server with the following command:
```bash
composer serve
```
This command launches the server on the default port 8000.
If you want to change the port, you can use:
```bash
composer serve -- --port=YOUR_PORT
```
