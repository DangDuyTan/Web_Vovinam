<?php
/** DTO */
declare(strict_types=1);

namespace App\Domain\Student;

use JsonSerializable;
use App\Infrastructure\Persistence\Database\db;
use PDO;
use PDOException;

class ketquathi implements JsonSerializable
{
    private $conn;

    private $maKetQuaThi;
    private $maMonSinh;
    private $maKhoaThi;
    private $capDaiHienTai;
    private $capDaiDuThi;
    private $ketQua;
    private $ghiChu;
    private $ngayCham;
    private $trangThaiHoSo;


    public function __construct(
        PDO $conn,

        $maKetQuaThi,
        $maMonSinh,
        $maKhoaThi,
        $capDaiHienTai,
        $capDaiDuThi,
        $ketQua,
        $ghiChu,
        $ngayCham,
        $trangThaiHoSo
    ) {
        $this->maKetQuaThi = $maKetQuaThi;
        $this->maMonSinh = $maMonSinh;
        $this->maKhoaThi =$maKhoaThi;
        $this->capDaiHienTai = $capDaiHienTai;
        $this->capDaiDuThi = $capDaiDuThi;
        $this->$trangThaiHoSo = $$trangThaiHoSo;
        $this->ketQua = $ketQua;
        $this->ghiChu = $ghiChu;
        $this->ngayCham = $ngayCham;
       
    }

    public function getmaKetQuaThi(): int { return $this->maKetQuaThi; }
    public function getmaMonSinh(): string { return $this->maMonSinh; }
    public function getmaKhoaThi(): string { return $this->maKhoaThi; }
    public function getcapDaiHienTai(): string { return $this->capDaiHienTai; }
    public function getcapDaiDuThi(){ return $this->capDaiDuThi; }
    public function gettrangThaiHoSo() { return $this->trangThaiHoSo; }
    public function getketQua() { return $this->ketQua; }
    public function getghiChu() { return $this->ghiChu; }
    public function getngayCham() { return $this->ngayCham; }
    


    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'maKetQuaThi' => $this->maKetQuaThi,
            'maMonSinh' => $this->maMonSinh,
            'maKhoaThi' => $this->maKhoaThi,
            'capDaiHienTai' => $this->capDaiHienTai,
            'capDaiDuThi' => $this->capDaiDuThi,
            'ketQua' => $this->ketQua,
            'trangThaiHoSo' => $this->trangThaiHoSo,
            'ghiChu' => $this->ghiChu,
            'ngayCham' => $this->ngayCham,
            
        ];
    }
}
