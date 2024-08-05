<?php
/** DTO */ /**DAL */ /** Model */
declare(strict_types=1);

namespace App\Domain\Student;

use JsonSerializable;
use App\Infrastructure\Persistence\Database\db;
use PDO;
use PDOException;

class Monsinh implements JsonSerializable
{
    private $conn;
    private $maMonSinh;
    private $maThe;
    private $hoTen;
    private $gioiTinh;
    private $ngaySinh;
    private $chieuCao;
    private $canNang;
    private $diaChi;
    private $soDienThoai;
    private $email;
    private $cccd;
    private $anhCCCD;
    private $anh3x4;
    private $ngayCapCCCD;
    private $noiCapCCCD;
    private $tenPhuHuynh;
    private $sdtPhuHuynh;
    private $congViec;
    private $lichSuTapLuyen;
    private $lichSuThi;
    private $bangCap;
    private $trinhDoVanHoa;
    private $khâNngNoiBat;
    private $maCapDai;

    public function __construct(
        PDO $conn,
        $maMonSinh,
        $maThe,
        $hoTen,
        $gioiTinh,
        $ngaySinh,
        $chieuCao,
        $canNang,
        $diaChi,
        $soDienThoai,
        $email,
        $cccd,
        $anhCCCD,
        $anh3x4,
        $ngayCapCCCD,
        $noiCapCCCD,
        $tenPhuHuynh,
        $sdtPhuHuynh,
        $congViec,
        $lichSuTapLuyen,
        $lichSuThi,
        $bangCap,
        $trinhDoVanHoa,
        $khâNngNoiBat,
        $maCapDai
    ) {
        $this->conn = $conn;
        $this->maMonSinh = $maMonSinh;
        $this->maThe = $maThe;
        $this->hoTen = $hoTen;
        $this->giơiTinh = $gioiTinh;
        $this->ngaySinh = $ngaySinh;
        $this->chieuCao = $chieuCao;
        $this->canNang = $canNang;
        $this->diaChi = $diaChi;
        $this->soDienThoai = $soDienThoai;
        $this->email = $email;
        $this->cccd = $cccd;
        $this->anhCCCD = $anhCCCD;
        $this->anh3x4 = $anh3x4;
        $this->ngayCapCCCD = $ngayCapCCCD;
        $this->noiCapCCCd = $noiCapCCCd;
        $this->tenPhuHuynh = $tenPhuHuynh;
        $this->sdtPhuHuynh = $sdtPhuHuynh;
        $this->congViec = $congViec;
        $this->lichsuTapLuyen = $lichsuTapLuyen;
        $this->lichSuThi = $lichSuThi;
        $this->bangCap = $bangCap;
        $this->trinhDoVanHoa = $trinhDoVanHoa;
        $this->khaNangNoiBat = $khaNangNoiBat;
        $this->maCapDai = $maCapDai;
    }

    public function getmaMonSinh() { return $this->maMonSinh; }
    public function getmaThe() { return $this->maThe; }
    public function gethoTen() { return $this->hoTen; }
    public function getgioiTinh() { return $this->gioiTinh; }
    public function getngaySinh() { return $this->ngaySinh; }
    public function getchieuCao() { return $this->chieuCao; }
    public function getcanNang() { return $this->canNang; }
    public function getdiaChi() { return $this->diaChi; }
    public function getsoDienThoai() { return $this->soDienThoai; }
    public function getemail() { return $this->email; }
    public function getcccd() { return $this->cccd; }
    public function getanhCCCD() { return $this->anhCCCD; }
    public function getanh3x4() { return $this->anh3x4; }
    public function getngayCapCCCD() { return $this->ngayCapCCCD; }
    public function getnoiCapCCCD() { return $this->noiCapCCCD; }
    public function gettenPhuHuynh() { return $this->tenPhuHuynh; }
    public function getsdtPhuHuynh() { return $this->sdtPhuHuynh; }
    public function getcongviec() { return $this->congviec; }
    public function getlichSuTapLuyen() { return $this->lichSuTapLuyen; }
    public function getlichSuThi() { return $this->lichSuThi; }
    public function getbangCap() { return $this->bangCap; }
    public function gettrinhDoVanHoa() { return $this->trinhDoVanHoa; }
    public function getkhaNangNoiBat() { return $this->khaNangNoiBat; }
    public function getmaCapDai() { return $this->maCapDai; }

    /* xóa một đối tượng bởi mã đối tượng 
    function deleteByID($maQuyen)
    {
           // do bảng accounts có liên kết khoa ngoại đến thuộc tính codePermissions của  bảng Permissions. Nếu thỏa các bảng kia không có tham chiếu đến dữ liệu đang được xóa thì mới cho phép xóa. Còn không sẽ báo lỗi.
           // còn bảng PermissionsDetail chỉ là một bảng phụ, có khóa ngoại tham chiếu đến khóa chỉnh của bảng Permission nên khi xóa phải xóa bên bảng PermissionsDetail trước rồi mới đc xóa.  
           $check_data_Accounts = "SELECT * FROM taikhoan WHERE maQuyen = '$maQuyen'";
           $resutl_1 = $this->conn->query($check_data_Accounts);
           // nếu tất cả các câu lệnh truy suất cho ra số dòng truy suất đều = 0 --> thỏa
           if ($resutl_1->num_rows < 1) {
                  // xóa bên bảng phụ trước
                  $string1 = "DELETE FROM chitietquyen WHERE maQuyen = '$maQuyen'";
                  // xoa ben bang permissions
                  $string2 = "DELETE FROM quyen WHERE maQuyen = '$maQuyen'";
                  $resutl1 = $this->conn->query($string1);
                  $resutl2 = $this->conn->query($string2);
                  return $resutl1 === $resutl2;
           } else {
                  return false;
           }
    }

    // xóa một đối tượng bằng cách truyền đối tượng vào
    function delete($obj)
    {
           if ($obj != null) {
                  $maQuyen = $obj->getmaQuyen();
                  // do bảng accounts có liên kết khoa ngoại đến thuộc tính codePermissions của  bảng Permissions. Nếu thỏa các bảng kia không có tham chiếu đến dữ liệu đang được xóa thì mới cho phép xóa. Còn không sẽ báo lỗi.
                  // còn bảng PermissionsDetail chỉ là một bảng phụ, có khóa ngoại tham chiếu đến khóa chỉnh của bảng Permission nên khi xóa phải xóa bên bảng PermissionsDetail trước rồi mới đc xóa.  
                  $check_data_Accounts = "SELECT * FROM taikhoan WHERE maQuyen = '$maQuyen'";
                  $resutl_1 = $this->conn->query($check_data_Accounts);
                  // nếu tất cả các câu lệnh truy suất cho ra số dòng truy suất đều = 0 --> thỏa
                  if ($resutl_1->num_rows < 1) {
                         // xóa bên bảng phụ trước
                         $string1 = "DELETE FROM chitietquyen WHERE maQuyen = '$maQuyen'";
                         // xoa ben bang permissions
                         $string2 = "DELETE FROM quyen WHERE maQuyen = '$maQuyen'";
                         $resutl1 = $this->conn->query($string1);
                         $resutl2 = $this->conn->query($string2);
                         return $resutl1 === $resutl2;
                  } else {
                         return false;
                  }
           }
    }

    // lấy ra mảng các đối tượng
    function getListObj()
    {
           // Mảng chứa các đối tượng
           $permission_list = array();
           // Câu lệnh truy vấn
           $query = 'SELECT * FROM quyen';
           // Thực hiện truy vấn
           $result = $this->conn->query($query);
           // Kiểm tra số hàng được trả về
           if ($result && $result->rowCount() > 0) {
                  // Lấy dữ liệu và đưa vào mảng
                  while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
                    $permission = new PermissionDTO (
                        $data["maQuyen"],
                        $data["tenQuyen"]
                    );
                    array_push($permission_list, $permission);
                  }
                  return $permission_list;
           } else {
                  // Trường hợp không có dữ liệu trả về
                  // echo "Không có dữ liệu được trả về từ truy vấn.";
                  return null;
           }
    }

    // lấy ra một đối tượng dựa theo mã đối tượng
    function getObj($maQuyen)
    {
           // Câu lệnh truy vấn
           $query = "SELECT * FROM quyen WHERE maQuyen = '$maQuyen'";
           // Thực hiện truy vấn
           $result = $this->conn->query($query);
           $data = $result->fetch(PDO::FETCH_ASSOC);
           // Kiểm tra số hàng được trả về
           if ($result && $result->rowCount() > 0) {
                if ($data) {
                    return new PermissionDTO (
                        $data["maQuyen"],
                        $data["tenQuyen"]
                    );
                }
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
                  // Lấy các thuộc tính từ đối tượng
                  $maQuyen = $obj->getmaQuyen();
                  $tenQuyen = $obj->gettenQuyen();

                  // Kiểm tra xem mã quyền đã tồn tại trong cơ sở dữ liệu chưa
                  $checkQuery = "SELECT * FROM quyen WHERE maQuyen = '$maQuyen'";
                  $resultCheck = $this->conn->query($checkQuery);

                  // Nếu đối tượng không rỗng và mã quyền chưa tồn tại
                  if ($obj != null && $resultCheck && $resultCheck->rowCount() < 1) {
                         // Câu lệnh truy vấn để thêm đối tượng vào bảng permissions
                         $insertQuery = "INSERT INTO quyen (maQuyen, tenQuyen) VALUES ('$maQuyen', '$tenQuyen')";
                         // Thực hiện truy vấn
                         return $this->conn->query($insertQuery);
                  } else {
                         // Trả về false nếu đối tượng rỗng hoặc mã quyền đã tồn tại
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
                // Lấy các thuộc tính từ đối tượng
                $maQuyen = $obj->getmaQuyen();
                $tenQuyen = $obj->gettenQuyen();
                // Câu lệnh UPDATE
                $query = "UPDATE quyen 
                        SET tenQuyen = '$tenquyen' 
                        WHERE maQuyen = '$maQuyen'";

                // Thực hiện truy vấn
                return $this->conn->query($query);
           } else {
                  // Trả về false nếu đối tượng rỗng
                  return false;
           }
    }

     */


    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'maMonSinh' => $this->maMonSinh,
            'maThe' => $this->maThe,
            'hoTen' => $this->hoTen,
            'gioiTinh' => $this->gioiTinh,
            'ngaySinh'  => $this->ngaySinh,
            'chieuCao'  => $this->chieuCao,
            'canNang' => $this->canNang,
            'diaChi' => $this->diaChi,
            'soDienThoai' => $this->soDienThoai,
            'email' => $this->email,
            'cccd' => $this->cccd,
            'anhCCCD' => $this->anhCCCD,
            'anh3x4' => $this->anh3x4,
            'ngayCapCCCD' => $this->ngayCapCCCD,
            'noiCapCCCD' => $this->noiCapCCCD,
            'tenPhuHuynh' => $this->tenPhuHuynh,
            'sdtPhuHuynh' => $this->sdtPhuHuynh,
            'congViec' => $this->congViec,
            'lichSuTapLuyen' => $this->lichSuTapLuyen,
            'lichSuThi' => $this->lichSuThi,
            'bangCap' => $this->bangCap,
            'trinhdoVanHoa' => $this->trinhDoVanHoa,
            'khaNangNoiBat' => $this->khaNangNoiBat,
            'maCapDai' => $this->maCapDai,
        ];
    }
       
}
