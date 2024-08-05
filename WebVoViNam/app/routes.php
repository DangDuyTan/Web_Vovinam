<?php

declare(strict_types=1);
use App\Application\Actions\User\LoginUser;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;

use App\Application\Actions\Judge\QuanLyChamThi;
use App\Application\Actions\Judge\DanhSachKetQua;

use App\Application\Actions\Student\DSKQ;
use App\Application\Actions\Student\Dki_Thi;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

use App\Domain\User\UserRepository;
use App\Domain\Judge\JudgeRepository;
use App\Domain\Student\StudentRepository;


return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });
    $app->group('', function (Group $group) {
        $group->post('/login', LoginUser::class);
        $group->get('/login', LoginUser::class);
    });

    $app->group('/api/user', function (Group $group) {
        $group->post('/getList', ListUsersAction::class);
        $group->get('/getList', ListUsersAction::class);

        $group->post('/{Id}', ViewUserAction::class);
        $group->get('/{Id}', ViewUserAction::class);
    });
    $app->group('/api/judge', function (Group $group) {
        $group->post('/getPD', QuanLyChamThi::class);
        $group->get('/getPD', QuanLyChamThi::class);
    });
   
    $app->group('/api/judge', function (Group $group) {
        $group->post('/getKQ', DanhSachKetQua::class);
        $group->get('/getKQ', DanhSachKetQua::class);
    });
    
    $app->group('/api/student', function (Group $group) {
        $group->post('/getKQ', DSKQ::class);
        $group->get('/getKQ', DSKQ::class);
    });
    $app->group('/api/student', function (Group $group) {
        $group->post('/getDKDT', Dk_Thi::class);
        $group->get('/getDKDT', Dk_Thi::class);
    });
    /*$app->get('/api/judge/getKQ/${maChiTietKetQua}', function (Request $request, Response $response, array $args) {
        $maChiTietKetQua = $args['maChiTietKetQua'];
        $judgeRepository = $this->get('App\Domain\Judge\JudgeRepository');
        $result = $judgeRepository->ListCTKQ($maChiTietKetQua);
    
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
    });
    */
};
