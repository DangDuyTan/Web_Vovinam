<!DOCTYPE html>
<html lang="en">
<?php require('config.php') ?>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        <?php 
        require('css/DSKQ.css');
        require('css/sidebar.css');
        require('css/footer.css');
        require('css/header.css');
        ?>
    </style>
  </head>
  <body>

    <div class="contain_sb">
        <div class="side-bar">
            <?php 
                $filepath = realpath(dirname(__DIR__));
                include_once $filepath . '\Views\sidebar.php';
            ?>
        </div>
        <div class = "content">
            <div class="header">
                <?php 
                    $filepath = realpath(dirname(__DIR__));
                    include_once $filepath . '\Views\header.php';
                 ?>
            </div>
            <div class="content-select">
                <h1 class="text-2xl font-semibold">Danh sách kết quả</h1>
                <div class="tim-kiem">
                <form id="searchForm" method="GET">
                    <input class="search" type="search" name="TimKiem" id="input-search-dskq" placeholder="Nhập dữ liệu tìm kiếm...">
                    <button type="submit">Tìm kiếm</button>
                </form>
                </div>
                
                <div class="sle_op">
                        <div class="flex-1">
                            <label for="khoa-thi" class="block_text">Khóa thi:</label>
                            <select id="khoa-thi" class="sle_op.option" name = "khoathi">
                        <!--      <option>Chọn Khóa Thi</option>
                          <option>Kỳ thi Thu 2024</option> -->
                            </select>
                            
                        </div>
                        <div class="flex-1">
                            <label for="cap-dai-du-thi" class="block_text">Cấp đai dự thi:</label>
                            <select id="cap-dai-du-thi" class="sle_op.option" name = "capdaiduthi">
                               <option>Chọn Cấp Đai</option>
                        <!--         <option>Tự Vệ</option> -->
                            </select>
                        </div>
                       
                </div>
                
                <button class="btn_loc" id= "locdanhsach" >Lọc</button>
            </div>

            <div class="content-show">
                <div class="overflow-x-auto">
                    <table class="danh-sach">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ tên</th>
                            <th>Mã thẻ</th>
                            <th>Khóa thi</th>
                            <th>Cấp đai dự thi</th>
                            <th>Tổng điểm</th>
                            <th>Kết quả</th>
                            <th>Ngày chấm</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="danhsachKetqua">
                <!--    <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                                <button class="see-button">Xem chi tiết</button>
                            </td>
                        </tr> -->
                    </tbody>
                    </table>
                </div>
                <!-- <div class="phan-trang">
                    <a href="#">&laquo;</a>
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">&raquo;</a>
                </div> -->
            </div>
            <ul class="pagination pagination-sm justify-content-end" id="Pagination" style="cursor:pointer; margin-right:1rem;">
                <!-- <li class="page-item"><a class="page-link">Previous</a></li>
                    <li class="page-item active"><a class="page-link">1</a></li>
                    <li class="page-item"><a class="page-link">2</a></li>
                    <li class="page-item"><a class="page-link">3</a></li>
                    <li class="page-item"><a class="page-link">Next</a></li> -->
            </ul>

            <div class="footer">
                <?php 
                    $filepath = realpath(dirname(__DIR__));
                    include_once $filepath . '\Views\footer.php';
                ?>
        </div>
        </div>
    </div>

    <div id="XemChiTietKQPD" class="ctkq">
        <div class="detailmodel">
         <!--   <span class="close">&times;</span>
             Nội dung chi tiết sẽ được chèn vào đây -->
        </div>
    </div>

    <script src="../../Js/DSKetqua_judge.js?v=<?php echo $version ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            getSelect();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

  </body>
</html>