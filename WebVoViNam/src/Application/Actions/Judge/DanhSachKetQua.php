<?php
/** Controller  */
declare(strict_types=1);

namespace App\Application\Actions\Judge;

use Psr\Http\Message\ResponseInterface as Response;

class DanhSachKetQua extends JudgeAction
{
    protected function handleGet(): Response
    {
        $searchKeyword = $this->request->getQueryParams()['TimKiem'] ?? '';
        $maChiTietKetQua = $this->request->getQueryParams()['maChiTietKetQua'] ?? '';

        if (!empty($searchKeyword)) {
            $results = $this->judgeRepository->searchDSKQ($searchKeyword);
            $response = $this->response->withHeader('Content-Type', 'application/json');
            $response->getBody()->write(json_encode($results));
            return $response;

        } else if (!empty($maChiTietKetQua)) { 
            $results = $this->judgeRepository->ListCTKQ($maChiTietKetQua);
            $response = $this->response->withHeader('Content-Type', 'application/json');
            $response->getBody()->write(json_encode($results));
            return $response;              
        }
         else {
            // If no search keyword, handle the default case
            $results = $this->judgeRepository->DanhSachKQ();
            ob_start();
            $filepath = realpath(dirname(__DIR__));
            include_once $filepath . '\..\Views\DSKQ.php';
            $output = ob_get_clean();

            $response = $this->response;
            $response->getBody()->write($output);
            return $response;
        }
    }
    protected function handlePost(): Response
    {
        $data = $this->request->getParsedBody();
        $function = $data['function'] ?? '';
    
        if ($function === 'DanhSachKQ') {
            $khoaThi = $data['khoaThi'] ?? '';
            $capDai = $data['capDai'] ?? '';
    
            $result = $this->judgeRepository->DanhSachKQ($khoaThi, $capDai);
       
        } else if($function === 'searchDSKQ') {
            $searchTerm = $this->request->getQueryParams()['TimKiem'] ?? '';
            $result = $this->judgeRepository->searchDSKQ($searchTerm);

        } else if($function === 'ListCTKQ') {
            $result = $this->judgeRepository->ListCTKQ();
        }
        else {
            // Mặc định gọi getSelect nếu không có hoặc không đúng tham số
            $result = $this->judgeRepository->getSelect();
        }
        
        $jsonResult = json_encode($result);

        $response = $this->response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write($jsonResult);
        return $response;
    }
}    