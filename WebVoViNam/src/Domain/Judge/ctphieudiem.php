<?php
/** DTO */
declare(strict_types=1);

namespace App\Domain\Judge;

use JsonSerializable;
use App\Infrastructure\Persistence\Database\db;
use PDO;
use PDOException;

class ctphieudiem implements JsonSerializable
{
    private $conn;

    private $maCTPhieuDiem;
    private $maChiTietKetQua;
    private $maMonSinh;
    private $maKhoaThi;
    private $maCapDai;
    private $maKyThuat;
    private $ThuocBai;
    private $NhanhManh;
    private $TanPhap;
    private $ThuyetPhuc;
    private $Diem;
    private $KetQua;
    private $GiamKhaoCham;
    private $GhiChu;
    private $NgayCham;


    public function __construct(
        PDO $conn,

        $maCTPhieuDiem,
        $maChiTietKetQua,
        $maMonSinh,
        $maKhoaThi,
        $maCapDai,
        $maKyThuat,
        $ThuocBai,
        $NhanhManh,
        $TanPhap,
        $ThuyetPhuc,
        $Diem,
        $KetQua,
        $GiamKhaoCham,
        $GhiChu,
        $NgayCham
    ) {
        $this->maCTPhieuDiem = $maCTPhieuDiem;
        $this->maChiTietKetQua = $maChiTietKetQua;
        $this->maMonSinh = $maMonSinh;
        $this->maKhoaThi =$maKhoaThi;
        $this->maCapDai = $maCapDai;
        $this->maKyThuat = $maKyThuat;
        $this->$ThuocBai = $$ThuocBai;
        $this->NhanhManh = $NhanhManh;
        $this->TanPhap = $TanPhap;
        $this->ThuyetPhuc = $ThuyetPhuc;
        $this->Diem = $Diem;
        $this->KetQua = $KetQua;
        $this->GiamKhaoCham = $GiamKhaoCham;
        $this->GhiChu = $GhiChu;
        $this->$NgayCham = $NgayCham;
    }

    public function getmaCTPhieuDiem() { return $this->maCTPhieuDiem; }
    public function getmaChiTietKetQua() { return $this->maChiTietKetQua; }
    public function getmaMonSinh() { return $this->maMonSinh; }
    public function getmaKhoaThi() { return $this->maKhoaThi; }
    public function getmaCapDai() { return $this->maCapDai; }
    public function getmaKyThuat() { return $this->maKyThuat; }
    public function getThuocBai() { return $this->ThuocBai; }
    public function getNhanhManh() { return $this->NhanhManh; }
    public function getTanPhap() { return $this->TanPhap; }
    public function getThuyetPhuc() { return $this->ThuyetPhuc; }
    public function getDiem() { return $this->Diem; }
    public function getKetQua() { return $this->KetQua; }
    public function getGiamKhaoCham() { return $this->GiamKhaoCham; }
    public function getGhiChu() { return $this->GhiChu; }
    public function getNgayCham() { return $this->NgayCham; }
    
    // lấy ra mảng các đối tượng
    /*function getListPDiem()
    {
        // Mảng để lưu trữ các đối tượng
        $result = array();
        // Câu lệnh truy vấn
        $string = 'SELECT * FROM ctphieudiem';
        // Thực hiện truy vấn
        $stmt = $this->conn->query($string);

        // Kiểm tra số hàng được trả về
        if ($stmt && $stmt->rowCount() > 0) {
            // Lặp qua các dòng kết quả và thêm vào mảng
            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $ctphieudiem = new Table(
                    $data['maCTPhieuDiem'],
                    $data['maKetQuaThi'],
                    $data["maKhoaThi"],
                    $data["maCapDai"],
                    $data["maKyThuat"],
                    $data["maMonSinh"],
                    $data["ThuocBai"],
                    $data["NhanhManh"],
                    $data["TanPhap"],
                    $data["ThuyetPhuc"],
                    $data["Diem"],
                    $data["KetQua"],
                    $data["GiamKhaoCham"],
                    $data["GhiChu"]
                );
                // Tạo đối tượng TaiKhoanDTO và thêm vào mảng
                array_push($result, $ctphieudiem);
            }
            return $result;
        } else {
            // Trường hợp không có dữ liệu trả về
            return null;
        }
    }*/

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'maCTPhieuDiem' => $this->maCTPhieuDiem,
            'maChiTietKetQua' => $this->maChiTietKetQua,
            'maMonSinh' => $this->maMonSinh,
            'maKhoaThi' => $this->maKhoaThi,
            'maCapDai' => $this->maCapDai,
            'maKyThuat' => $this->maKyThuat,
            'ThuocBai' => $this->ThuocBai,
            'NhanhManh' => $this->NhanhManh,
            'TanPhap' => $this->TanPhap,
            'ThuyetPhuc' => $this->ThuyetPhuc,
            'Diem' => $this->Diem,
            'KetQua' => $this->KetQua,
            'GiamKhaoCham' => $this->GiamKhaoCham,
            'GhiChu' => $this->GhiChu,
            'NgayCham' => $this->NgayCham,
            
        ];
    }
}
