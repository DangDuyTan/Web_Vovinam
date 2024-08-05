<?php

//BLL

declare(strict_types=1);

namespace App\Domain\Student;

interface StudentRepository
{
    //Lấy danh sách 

    public function getSelect();
    
    public function DanhSachKQ();

    public function searchDSKQ($keyword);

    public function ListCTKQ($maChiTietKetQua);
   
}
