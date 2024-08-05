<?php

//BLL

declare(strict_types=1);

namespace App\Domain\User;

interface UserRepository
{
    //Lấy danh sách 
    public function getListobj();

    //Lấy một đối tượng bằng khóa chính của đối tượng đó
    public function getObj($tenDangNhap);

    public function login($tenDangNhap, $matKhau);
   
}
