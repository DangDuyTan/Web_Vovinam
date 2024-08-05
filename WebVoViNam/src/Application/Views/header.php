<?php 

use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use App\Infrastructure\Persistence\Database\db;

// Tạo đối tượng UserRepository
$pdo = new PDO('mysql:host=localhost;dbname=vovi_db', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$userRepository = new InMemoryUserRepository($pdo);

// Truy vấn thông tin người dùng từ cơ sở dữ liệu
$result = $userRepository->getListobj();

// Kiểm tra sự tồn tại của các khóa trong mảng $result
$Id = isset($result['Id']) ? $result['Id'] : null;
$ho = isset($result['ho']) ? $result['ho'] : null;
$ten = isset($result['ten']) ? $result['ten'] : null;
$maQuyen = isset($result['maQuyen']) ? $result['maQuyen'] : null;
$anhDaiDien = isset($result['anhDaiDien']) ? $result['anhDaiDien'] : null;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header id="header">
        <div class = "user-wrapper">
            <span>
                <!-- Hiển thị ảnh đại diện -->
                <img src="<?php //echo htmlspecialchars($anhDaiDien); ?>" width="40px" height="40px" alt="" />
                <div class="info-header">
                    <?php
                        // Hiển thị tên đầy đủ và quyền của người dùng
                        if ($ho !== null && $ten !== null) {
                            echo "Hi! " . htmlspecialchars($ho) . " " . htmlspecialchars($ten) . "<br>";
                        } else {
                            echo "Hi! <br>";
                        };
                        // Hiển thị quyền người dùng
                        /*   if ($maQuyen == 'admin') {
                            //echo "Administrator";
                        } else if ($maQuyen == 'coach') {
                            //echo "Huấn Luyện Viên";
                        } else if ($maQuyen == 'judge') {
                            //echo "Giám Khảo";
                        } else if ($maQuyen == 'student') {
                            //echo "Học sinh";
                        }
                            */
                    ?>
                </div>
            </span>
        </div>
        <div class="menu-header">
            <ul>
                <li><a href="./users-info.php"><i class="fas fa-angle-left"></i><span>Thông tin cá nhân</span></a></li>
                <li><a href="./changepassword.php"><i class="fas fa-angle-left"></i><span>Đổi mật khẩu</span></a></li>
                <li id="logout"><a href="#!"><i class="fas fa-angle-left"></i><span>Đăng xuất</span></a></li>
            </ul>
        </div>
    </header>
    <script src="../../Js/QuanLyNguoiDung.js?v=<?php echo $version ?>"></script>
</body>
</html>