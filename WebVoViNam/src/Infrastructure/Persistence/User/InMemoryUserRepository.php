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


    //Lấy danh sách account , dùng để kiểm tra đăng nhập
    function getListobj()
    {
        //mảng dữ liệu lấy được từ InMemoryUserRepository.php
        $stmt = $this->conn->query("SELECT * FROM taikhoan");
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = array();
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                $obj = [
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
    //Lấy account bằng tên đăng nhập
    function getObj($tenDangNhap)
    {
        // Sử dụng prepared statement để tránh SQL Injection
        $stmt = $this->conn->prepare("SELECT * FROM taikhoan WHERE tenDangNhap = :tenDangNhap");
        $stmt->bindParam(':tenDangNhap', $tenDangNhap);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    // login
    function login($tenDangNhap, $matKhau)
    {
            // truy suất tài khoản trong csdl dựa theo userName
            $user = $this->getObj($tenDangNhap);
            // 5 trường hợp
            // đăng nhập sai pass
            // Đăng nhập thành công và quyền là user
            // Đăng nhập thanh công và quyền la admin
            // Đăng nhập không thành công do tài khoản bị khóa
            // Đăng nhập không thành công do chưa có tài khoản

            // kiểm tra xem kết quả truy suất có trả về null không
            // nếu có -> chưa có tài khoản
            if ($user != null) {
                // nếu đăng nhập không sai pass
                if ($user['matKhau'] === $matKhau) {
                    // lấy thông tin thuộc tính user
                    if ($user['kichHoat'] === '1') {
                        return [
                            "tenDangNhap" => $user['tenDangNhap'],
                            "ho" => $user['ho'],
                            "ten" => $user['ten'],
                            "matKhau" => $user['matKhau'],
                            "anhDaiDien" => $user['anhDaiDien'],
                            "loai" => $user['loai'],
                            "thoiGianTao" => $user['thoiGianTao'],
                            "thoiGianSua" => $user['thoiGianSua'],
                            "kichHoat" => $user['kichHoat'],
                            "soDienThoai" => $user['soDienThoai'],
                            "maQuyen" => $user['maQuyen'],
                            "mess" => "success"
                        ];
                    } else {
                        return ['mess' => 'Block'];
                    }
                } else {
                    return ['mess' => 'wrongPass'];
                }
            } else {
                return ['mess' => 'không có'];
            }
        }

}