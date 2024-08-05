<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;

class LoginUser extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function handleGet(): Response
    {
        // Buffer the output . '\..\..\Views'
        ob_start();
        $filepath = realpath(dirname(__DIR__));
        include_once $filepath . '\..\Views\login.php';
        $output = ob_get_clean();

        $response = $this->response;
        $response->getBody()->write($output);
        return $response;
    }
    protected function handlePost(): Response
    {
        $data = $this->request->getParsedBody();
        $tenDangNhap = $data['tenDangNhap'] ?? '';
        $matKhau = $data['matKhau'] ?? '';
        
        $user = $this->userRepository->login($tenDangNhap, $matKhau);
        
        if ($user['mess'] === 'success') {
            if ($user['maQuyen'] === 'giamkhaocanban') {
                return $this->redirect('/Views/HomePage.php');
            } else {
                return $this->redirect('/Views/judge-score.php');
            }
        } elseif ($user['mess'] === 'Block') {
            return $this->respondWithData(['mess' => 'Block']);
        } elseif ($user['mess'] === 'wrongPass') {
            return $this->respondWithData(['mess' => 'wrongPass']);
        } else {
            return $this->respondWithData(['mess' => 'notFound']);
        }
    
    }

    private function redirect(string $url): Response
    {
        $response = $this->response->withHeader('Location', $url);
        $response->getBody()->write('Redirecting...');
        return $response;
    }
}
