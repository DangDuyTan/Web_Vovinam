<?php
/** DTO */ /**DAL */ /** Model */
declare(strict_types=1);

namespace App\Domain;

use JsonSerializable;
use App\Infrastructure\Persistence\Database\db;
use PDO;
use PDOException;

class Chitietquyen implements JsonSerializable
{
    private $conn;
    private $maQuyen;
    private $maChucNang;
    private $chucNangThem;
    private $chucNangSua;
    private $chucNangXoa;
    private $chucNangTimKiem;
    private $chamDiemDonLuyen;
    private $chamDiemSongLuyen;
    private $chamDiemCanBan;
    private $chamDiemDoiKhang;
    private $chamDiemTheLuc;
    private $chamDiemLyThuyet;

    public function __construct(
        PDO $conn,
        $maQuyen,
        $maChucNang,
        $chucNangThem,
        $chucNangSua,
        $chucNangXoa,
        $chucNangTimKiem,
        $chamDiemDonLuyen,
        $chamDiemSongLuyen,
        $chamDiemCanBan,
        $chamDiemDoiKhang,
        $chamDiemTheLuc,
        $chamDiemLyThuyet
    ) {
        $this->conn = $conn;
        $this->maQuyen = $maQuyen;
        $this->maChucNang = $maChucNang;
        $this->chucNangThem = $chucNangThem;
        $this->chucNangSua = $chucNangSua;
        $this->chucNangXoa = $chucNangXoa;
        $this->chucNangTimKiem = $chucNangTimKiem;
        $this->chamDiemDonLuyen = $chamDiemDonLuyen;
        $this->chamDiemSongLuyen = $chamDiemSongLuyen;
        $this->chamDiemCanBan = $chamDiemCanBan;
        $this->chamDiemDoiKhang = $chamDiemDoiKhang;
        $this->chamDiemTheLuc = $chamDiemTheLuc;
        $this->chamDiemLyThuyet = $chamDiemLyThuyet;

    }

    public function getmaQuyen() { return $this->maQuyen; }
    public function getmaChucNang() { return $this->maChucNang; }
    public function getchucNangThem() { return $this->chucNangThem; }
    public function getchucNangSua() { return $this->chucNangSua; }
    public function getchucNangXoa() { return $this->chucNangXoa; }
    public function getchucNangTimKiem() { return $this->chucNangTimKiem; }
    public function getchamDiemDonLuyen() { return $this->chamDiemDonLuyen; }
    public function getchamDiemSongLuyen() { return $this->chamDiemSongLuyen; }
    public function getchamDiemDoiKhang() { return $this->chamDiemDoiKhang; }
    public function getchamDiemTheLuc() { return $this->chamDiemTheLuc; }
    public function getchamDiemLyThuyet() { return $this->chamDiemLyThuyet; }
    public function getchamDiemCanBan() { return $this->chamDiemCanBan; }

       // xóa một đối tượng bởi mã đối tượng 
       function deleteByID($maQuyen)
       {
              // không có khóa chính
       }

       // xóa một đối tượng bằng cách truyền đối tượng vào
       function delete($obj)
       {
              if ($obj != null) {
                     $maQuyen = $obj->getmaQuyen();
                     $maChucNang = $obj->getmaChucNang();
                     $string = "DELETE FROM chitietquyen WHERE maQuyen = '$maQuyen' AND maChucNang = '$maChucNang'";

                     return $this->conn->query($string);
              } else {
                     return false;
              }
       }

       // xóa đối tượng theo mã codePermission
       function deleteObj_by_codePermission($maQuyen)
       {
              $query = "DELETE FROM chitietquyen WHERE maQuyen = '$maQuyen'";
              return $this->conn->query($query);
       }

       // lấy ra mảng các đối tượng
       function getListObj()
       {
            // Mảng để lưu trữ các đối tượng
            $array_list = array();
            // Câu lệnh truy vấn
            $query = 'SELECT * FROM chitietquen';
            // Thực thi truy vấn
            $result = $this->conn->query($query);

            // Kiểm tra số hàng được trả về
            if ($result && $result->rowCount() > 0) {
                    // Lặp qua từng hàng dữ liệu và tạo đối tượng PermissionDTO
                    while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
                    $permission = new PermissionsDetailDTO(
                        $data["maQuyen"],
                        $data["maChucNang"],
                        $data["chucNangThem"],
                        $data["chucNangSua"],
                        $data["chucNangXoa"],
                        $data["chucNangTimKiem"],
                        $data["chamDiemDonLuyen"],
                        $data["ChamDiemSongLuyen"],
                        $data["ChamDiemCanBan"],
                        $data["ChamDiemDoiKhang"],
                        $data["ChamDiemTheLuc"],
                        $data["ChamDiemLyThuyet"]
                    );
                    array_push($array_list, $permission);
                    }
                    // Trả về mảng các đối tượng PermissionDTO
                    return $array_list;
            } else {
                    // Trường hợp không có dữ liệu trả về
                    // echo "Không có dữ liệu được trả về từ truy vấn.";
                    return null;
            }
       }

       // lấy ra một array đối tượng dựa theo mã đối tượng
       function getObj($maQuyen)
       {
              // bảng không có khóa chính nên không thể truy suất ra 1 đối tượng cựu thể dựa theo mã code
       }

       // truy suất theo codePermission
       function getArrByPermission($maQuyen)
       {
              // Câu lệnh truy vấn
              $query = "SELECT * FROM chitietquyen WHERE maQuyen = '$maQuyen'";
              // Thực thi truy vấn
              $result = $this->conn->query($query);
              $array = array();
              // Kiểm tra số hàng được trả về
              if ($result && $result->rowCount() > 0) {
                while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
                    $permissionDetail = new PermissionsDetailDTO(
                    $data["maQuyen"],
                    $data["maChucNang"],
                    $data["chucNangThem"],
                    $data["chucNangSua"],
                    $data["chucNangXoa"],
                    $data["chucNangTimKiem"],
                    $data["chamDiemDonLuyen"],
                    $data["ChamDiemSongLuyen"],
                    $data["ChamDiemCanBan"],
                    $data["ChamDiemDoiKhang"],
                    $data["ChamDiemTheLuc"],
                    $data["ChamDiemLyThuyet"]
                    );
                    array_push($array, $permissionDetail);
                }
                    return $array;
              } else {
                     // Trường hợp không có dữ liệu trả về
                     // echo "Không có dữ liệu được trả về từ truy vấn.";
                     return null;
              }
       }

       // truy suất theo function 
       function getArrByFunctionCode($maChucNang)
       {
            // Câu lệnh truy vấn
            $query = "SELECT * FROM chitietquyen WHERE maChucNang = '$maChucNang'";
            // Thực thi truy vấn
            $result = $this->conn->query($query);
            $array = array();
            // Kiểm tra số hàng được trả về
            if ($result && $result->rowCount() > 0) {
            while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
                $permissionDetail = new PermissionsDetailDTO(
                $data["maQuyen"],
                $data["maChucNang"],
                $data["chucNangThem"],
                $data["chucNangSua"],
                $data["chucNangXoa"],
                $data["chucNangTimKiem"],
                $data["chamDiemDonLuyen"],
                $data["ChamDiemSongLuyen"],
                $data["ChamDiemCanBan"],
                $data["ChamDiemDoiKhang"],
                $data["ChamDiemTheLuc"],
                $data["ChamDiemLyThuyet"]
                );
                array_push($array, $permissionDetail);
            }
                return $array;
            } else {
                    // Trường hợp không có dữ liệu trả về
                    // echo "Không có dữ liệu được trả về từ truy vấn.";
                    return null;
            }
       }

    // thêm một đối tượng 
    function addObj($obj)
    {
        if ($obj != null) {
                $maQuyen = $obj->getmaQuyen();
                $maChucNang = $obj->getmaChucNang();

                $check = "SELECT * FROM chitietquyen WHERE maQuyen = '$maQuyen' AND maChucNang = '$maChucNang'";
                $resultCheck = $this->conn->query($check);

                if ($resultCheck && $resultCheck->rowCount() < 1) {
                    $chucNangThem = $obj->getchucNangThem();
                    $chucNangSua = $obj->getchucNangSua();
                    $chucNangXoa = $obj->getchucNangXoa();
                    $chucNangTimKiem = $obj->getchucNangTimKiem();
                    $chamDiemDonLuyen = $obj->getchamDiemDonLuyen();
                    $chamDiemSongLuyen = $obj->getChamDiemSongLuyen();
                    $chamDiemCanBan = $obj->getChamDiemCanBan();
                    $chamDiemDoiKhang = $obj->getChamDiemDoiKhang();
                    $chamDiemTheLuc = $obj->getChamDiemTheLuc();
                    $chamDiemLyThuyet = $obj->getChamDiemLyThuyet();
                    // Câu lệnh truy vấn để thêm dữ liệu mới
                    $query = "INSERT INTO chitietquyen 
                    (maQuyen, 
                    maChucNang, 
                    chucNangThem, 
                    chucNangSua, 
                    chucNangXoa, 
                    chucNangTimKiem,
                    chamDiemDonLuyen,
                    chamDiemSongLuyen,
                    chamDiemCanBan,
                    chamDiemDoiKhang,
                    chamDiemTheLuc,
                    chamDiemLyThuyet
                    ) 
                    VALUES ('$maQuyen', 
                    '$maChucNang', 
                    '$chucNangThem', 
                    '$chucNangSua', 
                    '$chucNangXoa', 
                    '$chucNangTimKiem',
                    '$chamDiemDonLuyen',
                    '$chamDiemSongLuyen',
                    '$chamDiemCanBan',
                    '$chamDiemDoiKhang',
                    '$chamDiemTheLuc',
                    '$chamDiemLyThuyet',
                    )";

                    // Thực thi câu lệnh truy vấn và trả về kết quả
                    return $this->conn->query($query);
                } else {
                    return false;
                }
        } else {
                return false;
        }
    }

       // sửa một đối tượng
       function upadateObj($obj)
       {
              if ($obj != null) {
                     $codePermissions = $obj->getCodePermissions();
                     $functionCode = $obj->getFunctionCode();
                     $addPermission = $obj->getAddPermission();
                     $seePermission = $obj->getSeePermission();
                     $deletePermission = $obj->getDeletePermission();
                     $fixPermission = $obj->getFixPermission();

                     // Câu lệnh UPDATE
                     $query = "UPDATE permissionsDetail 
                                 SET functionCode = '$functionCode', 
                                     addPermission = '$addPermission', 
                                     seePermission = '$seePermission', 
                                     deletePermission = '$deletePermission', 
                                     fixPermission = '$fixPermission' 
                                 WHERE codePermissions = '$codePermissions' AND functionCode = '$functionCode'";

                     // Thực thi câu lệnh UPDATE và trả về kết quả
                     return $this->actionSQL->query($query);
              } else {
                     return false;
              }
       }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'maQuyen' => $this->maQuyen,
            'tenQuyen' => $this->tenQuyen,
        ];
    }
}
