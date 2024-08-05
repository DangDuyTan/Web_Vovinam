<?php
/** Controller  */
declare(strict_types=1);

namespace App\Application\Actions\Student;

use Psr\Http\Message\ResponseInterface as Response;

class Dk_Thi extends StudentAction
{
    protected function handleGet(): Response
    {
        $searchKeyword = $this->request->getQueryParams()['TimKiem'] ?? '';
        //$maChiTietKetQua = $this->request->getQueryParams()['maChiTietKetQua'] ?? '';

        if (!empty($searchKeyword)) {
            $results = $this->studentRepository->searchDSKQ($searchKeyword);
            $response = $this->response->withHeader('Content-Type', 'application/json');
            $response->getBody()->write(json_encode($results));
            return $response;

        }/* else if (!empty($maChiTietKetQua)) { 
            $results = $this->judgeRepository->ListCTKQ($maChiTietKetQua);
            $response = $this->response->withHeader('Content-Type', 'application/json');
            $response->getBody()->write(json_encode($results));
            return $response;              
        }*/
         else {
            // If no search keyword, handle the default case
            $results = $this->studentRepository->DanhSachKTCD();
            ob_start();
            $filepath = realpath(dirname(__DIR__));
            include_once $filepath . '\..\Views\DkiduThi.php';
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
    
        if ($function === 'DanhSachKTCD') {
            $khoaThi = $data['khoaThi'] ?? '';
            $capDai = $data['capDai'] ?? '';
    
            $result = $this->studentRepository->DanhSachKTCD($khoaThi, $capDai);
       
        } else if($function === 'searchDSKQ') {
            $searchTerm = $this->request->getQueryParams()['TimKiem'] ?? '';
            $result = $this->studentRepository->searchDSKQ($searchTerm);

        }/* else if($function === 'ListCTKQ') {
            $result = $this->judgeRepository->ListCTKQ();
        }*/
        else {
            // Mặc định gọi getSelect nếu không có hoặc không đúng tham số
            $result = $this->studentRepository->getSelect();
        }
        
        $jsonResult = json_encode($result);

        $response = $this->response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write($jsonResult);
        return $response;
    }
}    