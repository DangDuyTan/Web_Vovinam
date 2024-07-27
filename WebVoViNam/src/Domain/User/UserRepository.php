<?php

//BLL

declare(strict_types=1);

namespace App\Domain\User;

interface UserRepository
{
    /**
     * @return User[]
     */
    //public function findAll();

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    //public function findUserOfId(int $Id);

    //Lấy danh sách 
    public function getListobj();


    //Lấy một đối tượng bằng khóa chính của đối tượng đó
    public function getObj(int $Id);
   
}
