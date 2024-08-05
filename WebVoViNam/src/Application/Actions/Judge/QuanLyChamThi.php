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
        $data = $this->request->getParsedBody();
        $function = $data['function'] ?? '';
    
        if ($function === 'getListPDiem') {
            $khoaThi = $data['khoaThi'] ?? '';
            $capDai = $data['capDai'] ?? '';
            $phanThi = $data['phanThi'] ?? '';
    
            $result = $this->judgeRepository->getListPDiem($khoaThi, $capDai, $phanThi);

        } else if ($function === 'updateScore') {
            
            $maCTPhieuDiem = $data['maCTPhieuDiem'];
            $ThuocBai = $data['ThuocBai'];
            $NhanhManh = $data['NhanhManh'];
            $TanPhap = $data['TanPhap'];
            $ThuyetPhuc = $data['ThuyetPhuc'];
            $GhiChu = $data['GhiChu'];
            //$GiamKhaoCham = $data['GiamKhaoCham'];

            $result = $this->judgeRepository->updateScore($maCTPhieuDiem, $ThuocBai, $NhanhManh, $TanPhap, $ThuyetPhuc, $GhiChu);
        
        } else {
            // Mặc định gọi getSelect nếu không có hoặc không đúng tham số
            $result = $this->judgeRepository->getSelect();
        }
        
        $jsonResult = json_encode($result);

        $response = $this->response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write($jsonResult);
        return $response;
    }
}    