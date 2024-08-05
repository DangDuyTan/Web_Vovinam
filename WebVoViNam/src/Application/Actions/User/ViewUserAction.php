<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;

class ViewUserAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function handleGet(): Response
    {
        // Buffer the output . '\..\..\Views'
        ob_start();
        $filepath = realpath(dirname(__DIR__));
        include_once $filepath . '\..\Views\admin\TongQuanQLND.php';
        $output = ob_get_clean();
        $this->logger->info("Users list was viewed.");
        $response = $this->response;
        $response->getBody()->write($output);
        return $response;
    }
    protected function handlePost(): Response
    {
        $userId = $this->resolveArg('tenDangNhap');
        $result = $this->userRepository->getObj($userId);
        $jsonResult = json_encode($result);
        $this->logger->info("Users list was viewed.");
        $response = $this->response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write($jsonResult);
        return $response;
    }
}
