<?php
/** DTO */ /**DAL */ /** Model */
declare(strict_types=1);

namespace App\Domain\User;

use JsonSerializable;
use App\Infrastructure\Persistence\Database\db;
use PDO;
use PDOException;

class User implements JsonSerializable
{
    private $conn;

    private int $Id;
    private string $tenDangNhap;
    private string $ho;
    private string $ten;
    private $matKhau;
    private $anhDaiDien;
    private $loai;
    private $thoiGianTao;
    private $thoiGianSua;
    private $kichHoat;
    private $soDienThoai;
    private $maQuyen;


    public function __construct(
        PDO $conn,
        
        $Id,
        $tenDangNhap,
        $ho,
        $ten,
        $matKhau,
        $anhDaiDien,
        $loai,
        $thoiGianTao,
        $thoiGianSua,
        $kichHoat,
        $soDienThoai,
        $maQuyen
    ) {
        $this->conn = $conn;
        $this->Id = $Id;
        $this->tenDangNhap = $tenDangNhap;
        $this->ho = ucfirst($ho);
        $this->ten = ucfirst($ten);
        $this->matKhau = $matKhau;
        $this->anhDaiDien = $anhDaiDien;
        $this->loai = $loai;
        $this->thoiGianTao = $thoiGianTao;
        $this->thoiGianSua = $thoiGianSua;
        $this->kichHoat = $kichHoat;
        $this->soDienThoai = $soDienThoai;
        $this->maQuyen = $maQuyen;
    }

    public function getId(): int { return $this->Id; }
    public function gettenDangNhap(): string { return $this->tenDangNhap; }
    public function getho(): string { return $this->ho; }
    public function getten(): string { return $this->ten; }
    public function getmatKhau(){ return $this->matKhau; }
    public function getanhDaiDien() { return $this->anhDaiDien; }
    public function getloai() { return $this->loai; }
    public function getthoiGianTao() { return $this->thoiGianTao; }
    public function getthoiGianSua() { return $this->thoiGianSua; }
    public function getkichHoat() { return $this->kichHoat; }
    public function getsoDienThoai() { return $this->soDienThoai; }
    public function getmaQuyen() { return $this->maQuyen; }

    // lấy ra mảng các đối tượng
    function getListObj()
    {
        // Mảng để lưu trữ các đối tượng
        $result = array();
        // Câu lệnh truy vấn
        $string = 'SELECT * FROM taikhoan';
        // Thực hiện truy vấn
        $stmt = $this->conn->query($string);

        // Kiểm tra số hàng được trả về
        if ($stmt && $stmt->rowCount() > 0) {
            // Lặp qua các dòng kết quả và thêm vào mảng
            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $taiKhoan = new User(
                    $data['Id'],
                    $data['tenDangNhap'],
                    $data["ho"],
                    $data["ten"],
                    $data["matKhau"],
                    $data["anhDaiDien"],
                    $data["loai"],
                    $data["thoiGianTao"],
                    $data["thoiGianSua"],
                    $data["kichHoat"],
                    $data["soDienThoai"],
                    $data["maQuyen"]
                );
                // Tạo đối tượng TaiKhoanDTO và thêm vào mảng
                array_push($result, $taiKhoan);
            }
            return $result;
        } else {
            // Trường hợp không có dữ liệu trả về
            return null;
        }
    }

    // lấy ra một đối tượng dựa theo id
    function getObj($Id)
    {
        // Câu lệnh truy vấn
        $stmt = $this->conn->prepare("SELECT * FROM taikhoan WHERE Id = :Id");
        $stmt->execute(['Id' => $Id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new User(
                $data['Id'],
                $data['tenDangNhap'],
                $data["ho"],
                $data["ten"],
                $data["matKhau"],
                $data["anhDaiDien"],
                $data["loai"],
                $data["thoiGianTao"],
                $data["thoiGianSua"],
                $data["kichHoat"],
                $data["soDienThoai"],
                $data["maQuyen"]
            );           
        } else {
            // Trường hợp không có dữ liệu trả về
            return null;
        }
    }
    



    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'Id' => $this->Id,
            'tenDangNhap' => $this->tenDangNhap,
            'ho' => $this->ho,
            'ten' => $this->ten,
            'matKhau' => $this->matKhau,
            'anhDaiDien' => $this->anhDaiDien,
            'loai' => $this->loai,
            'thoiGianTao' => $this->thoiGianTao,
            'thoiGianSua' => $this->thoiGianSua,
            'soDienThoai' => $this->soDienThoai,
            'maQuyen' => $this->maQuyen,
            'kichHoat' => $this->kichHoat,
        ];
    }
}
