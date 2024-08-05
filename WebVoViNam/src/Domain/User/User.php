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



    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'mess' => 'success',
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
