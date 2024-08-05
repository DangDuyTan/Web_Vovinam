<?php

//BLL

declare(strict_types=1);

namespace App\Domain\Judge;

interface JudgeRepository
{
    //Lấy danh sách 
    public function getListPDiem();

    public function getSelect();

    public function updateScore($maCTPhieuDiem, $ThuocBai, $NhanhManh, $TanPhap, $ThuyetPhuc, $GhiChu);
    
    public function DanhSachKQ();

    public function searchDSKQ($keyword);

    public function ListCTKQ($maChiTietKetQua);
   
}
