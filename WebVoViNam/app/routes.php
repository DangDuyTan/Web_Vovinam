<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;

use App\Application\Actions\Judge\QuanLyChamThi;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Domain\User\UserRepository;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->group('/api/user', function (Group $group) {
        $group->post('/getList', ListUsersAction::class);
        $group->get('/getList', ListUsersAction::class);
        $group->get('/{Id}', ViewUserAction::class);
    });
    $app->group('/api/judge', function (Group $group) {
        $group->post('/getList', QuanLyChamThi::class);
        $group->get('/getList', QuanLyChamThi::class);
        
    });
};
