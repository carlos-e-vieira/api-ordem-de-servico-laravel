## JWT Auth
https://jwt-auth.readthedocs.io/en/develop/

### Instalação do Pacote
composer require php-open-source-saver/jwt-auth

### Publicar o jwt.php
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

Caso não crie o arquivo jwt.php dentro de config, criar manualmente.

### Adicionar Service Provider
No config/app.php

'providers' => [
    PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider::class,
]

### Gerar Token
php artisan jwt:secret

### Auth Guard
config/auth.php

'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'api' => [
        'driver' => 'jwt',
        'provider' => 'users',
    ],
],

### Configurar a Model User
Implementar a Interface na model User:
implements JWTSubject

Adicionar os 2 metodos especificados na documentação:

public function getJWTIdentifier(): mixed
{
    return $this->getKey();
}

public function getJWTCustomClaims(): array
{
    return [];
}

<hr>