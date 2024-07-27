<?php
/** Controller  */
declare(strict_types=1);

namespace App\Application\Actions\Judge;

use Psr\Http\Message\ResponseInterface as Response;

class QuanLyChamThi extends JudgeAction
{
    protected function handleGet(): Response
    {
        // Buffer the output . '\..\..\Views'
        ob_start();
        $filepath = realpath(dirname(__DIR__));
        include_once $filepath . '\..\Views\judge-score.php';
        $output = ob_get_clean();

        $response = $this->response;
        $response->getBody()->write($output);
        return $response;
    }
    protected function handlePost(): Response
    {
        $result = $this->userRepository->getListobj();
        $jsonResult = json_encode($result);

        $response = $this->response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write($jsonResult);
        return $response;
    }
}    