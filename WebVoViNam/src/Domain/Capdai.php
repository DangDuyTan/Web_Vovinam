<?php
/** DTO */ /**DAL */ /** Model */
declare(strict_types=1);

namespace App\Domain;

use JsonSerializable;
use App\Infrastructure\Persistence\Database\db;
use PDO;
use PDOException;

class Capdai implements JsonSerializable
{
    private $conn;
    private $maCapDai;
    private $tenCapDai;

    public function __construct(
        PDO $conn,
        $maCapDai,
        $tenCapDai
    ) {
        $this->conn = $conn;
        $this->maCapDai = $maCapDai;
        $this->tenCapDai = $tenCapDai;
    }

    public function getmaCapDai() { return $this->maCapDai; }
    public function gettenCapDai() { return $this->tenCapDai; }

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
            'maCapDai' => $this->maCapDai,
            'tenCapDai' => $this->tenCapDai,
        ];
    }
       
}
