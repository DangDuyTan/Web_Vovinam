<?php

/** DAL */ /** Service */

declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\Database\db;
use PDO;
use PDOException;

class InMemoryUserRepository implements UserRepository
{

    private PDO $conn;
    //connect db
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }
    /**
     * {@inheritdoc}
     */
    public function findAll():array
    {
        try {
            $stmt = $this->conn->query("SELECT * FROM taikhoan");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $users = [];
            foreach ($results as $row) {
                $users[] = new User(
                    $row['Id'],
                    $row['tenDangNhap'],
                    $row['ho'],
                    $row['ten'],
                    $row['matKhau'],
                    $row['anhDaiDien'],
                    $row['loai'],
                    $row['thoiGianTao'],
                    $row['thoiGianSua'],
                    $row['kichHoat'],
                    $row['soDienThoai'],
                    $row['maQuyen']
                );
            }
            return $users;

        } catch (PDOException $e) {
            // Xử lý ngoại lệ kết nối cơ sở dữ liệu
            throw new \Exception("Error connecting to database: " . $e->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function findUserOfId(int $Id): User
    {
        $stmt = $this->conn->prepare("SELECT * FROM taikhoan WHERE Id = :Id");
        $stmt->execute(['Id' => $Id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            throw new UserNotFoundException();
        }
        return new User(
            $row['Id'],
            $row['tenDangNhap'],
            $row['ho'],
            $row['ten'],
            $row['matKhau'],
            $row['anhDaiDien'],
            $row['loai'],
            $row['thoiGianTao'],
            $row['thoiGianSua'],
            $row['kichHoat'],
            $row['soDienThoai'],
            $row['maQuyen']
        );
    }

    function getListobj()
    {
        //mảng dữ liệu lấy được từ InMemoryUserRepository.php
        $stmt = $this->conn->query("SELECT * FROM taikhoan");
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = array();
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                $obj = [
                    "Id" => $item["Id"],
                    "tenDangNhap" => $item['tenDangNhap'],
                    "ho" => $item['ho'],
                    "ten" => $item['ten'],
                    "matKhau" => $item['matKhau'],
                    "anhDaiDien" => $item['anhDaiDien'],
                    "loai" => $item['loai'],
                    "thoiGianTao" => $item['thoiGianTao'],
                    "thoiGianSua" => $item['thoiGianSua'],
                    "kichHoat" => $item['kichHoat'],
                    "soDienThoai" => $item['soDienThoai'],
                    "maQuyen" => $item['maQuyen'],
                    "mess" => "success"
                ];
                $result[] = $obj;
            }
            return $result;
            // return array("mess" => "success");
        } else {
            return array("mess" => "Failed");
        }
    }  
    
    function getObj(int $Id)
    {
        // Sử dụng prepared statement để tránh SQL Injection
        $stmt = $this->conn->prepare("SELECT * FROM taikhoan WHERE Id = :Id");
        //bindParam: Gán giá trị cho placeholder :Id
        $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
        $stmt->execute();
    
        // Fetch dữ liệu
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Kiểm tra nếu có dữ liệu trả về
        if ($item) {
            $obj = [
                "Id" => $item["Id"],
                "tenDangNhap" => $item['tenDangNhap'],
                "ho" => $item['ho'],
                "ten" => $item['ten'],
                "matKhau" => $item['matKhau'],
                "anhDaiDien" => $item['anhDaiDien'],
                "loai" => $item['loai'],
                "thoiGianTao" => $item['thoiGianTao'],
                "thoiGianSua" => $item['thoiGianSua'],
                "kichHoat" => $item['kichHoat'],
                "soDienThoai" => $item['soDienThoai'],
                "maQuyen" => $item['maQuyen'],
                "mess" => "success"
            ];
            return $obj;
        } else {
            // Trường hợp không có dữ liệu trả về
            return ["mess" => "No data found"];
        }
    }
    

}
