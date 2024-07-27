<!DOCTYPE html>
<html lang="en">
<?php require('config.php') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        <?php 
        //require('../../css/admin/sidebar.css');
        //require('../../css/admin/header_admin.css');
        //require('../../css/admin/footer_admin.css');
        // require('../../css/admin/danhsachnguoidung2.css');
        require('css/QLND.css');

        ?>
    </style>
</head>

<body>
    <div class="container-sb">
        <div class="side-bar">
            
        </div>
        <div class="content">
            <div class="header">
                <?php //require('./header_admin.php'); ?>
            </div>
            <div class="content-page">
                <div>
                    <h1>QUẢN LÝ NGƯỜI DÙNG</h1>
                    <a href="#" onclick="addObj(event)" class="add-new"><i class="fa fa-plus"></i> Thêm người dùng
                        mới</a>
                </div>
                <div class="tim-kiem">
                    <form action="tongquanQLND.php" method="get">
                        <input type="text" name="tenTimKiem" id="input-search-account" placeholder="Nhập dữ liệu tìm kiếm người dùng">
                        <button class="search" type="submit">Tìm kiếm</button>
                    </form>
                </div>
                <table class="danh-sach">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên đăng nhập</th>
                            <th>Họ</th>
                            <th>Tên</th>
                            <th>Loại</th>
                            <th>Số điện thoại</th>
                            <th>Kích hoạt</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody id="danhsachUser">
                        <!-- <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td> -->
                        <!-- <td><a class="edit-button"><i class="fa fa-edit"></i>Sửa</a></td> -->
                        <!-- <td> <a href="#" class="delete-button" data-bs-toggle="modal" data-bs-target="#deleteUser"><i class="fa fa-trash"></i></a><td>
                        </tr> -->
                    </tbody>
                </table>
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
                include_once $filepath . '\..\Views\admin\footer_admin.php';
                //require(__DIR__ . '\..\Views\footer.php'); 
                ?>
            </div>
        </div>
    </div>
    <!-- Sửa người dùng -->
    <div id="edit-User">
        <!-- <div class="modal fade" id="edituser-${i.codeSupplier}" tabindex="-1" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Sửa thông tin người dùng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên đăng nhập</label>
                                <input type="text" class="form-control" id="${i.username}" value="${i.username}"
                                    name="codeSupplier" placeholder="NCC001" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Mật khấu</label>
                                <input type="password" class="form-control" id="${i.username}-${i.passWord}"
                                    value="${i.passWord}" name="passWord">
                            </div>
                            <input type="hidden" class="form-control" id="${i.username}-${i.dateCreated}"
                                value="${i.dateCreated}" name="dateCreated">
                            <div class="mb-3">
                                <label for="name" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="${i.username}-${i.name}" value="${i.name}"
                                    name="name">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" id="${i.username}-${i.address}"
                                    value="${i.address}" name="address">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="${i.username}-${i.email}"
                                    value="${i.email}" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Số điện thoại</label>
                                <input class="form-control" id="${i.username}-${i.phoneNumber}" value="${i.phoneNumber}"
                                    name="phoneNumber">
                            </div>
                            <div class="mb-3">
                                <label for="brandsuppliers" class="form-label">Ngày sinh</label>
                                <input type="date" class="form-control" id="${i.username}-${i.birth}" value="${i.birth}"
                                    name="birth">
                            </div>
                            <div class="mb-3">
                                <label for="brandsuppliers" class="form-label">Giới tính</label>
                                <input type="sex" class="form-control" id="${i.username}-${i.sex}" value="${i.sex}"
                                    name="birth">
                            </div>
                            <div class="mb-3">
                                <label for="brandsuppliers" class="form-label">Nhóm người dùng</label>
                                <input type="" class="form-control" id="${i.username}-${i.birth}" value="${i.birth}"
                                    name="birth">
                            </div>
                            <div class="mb-3">
                                <label for="brandsuppliers" class="form-label">Trạng thái</label>
                                <input type="" class="form-control" id="${i.username}-${i.accountStatus}"
                                    value="${i.accountStatus}" name="birth">
                            </div>
                            <div style="text-align:right;">
                                <button type="submit" data-bs-dismiss="modal" class="btn btn-primary"
                                    onclick="updateObj('${i.username}', '${i.username}-${i.passWord}', '${i.username}-${i.dateCreated}','${i.username}-${i.accountStatus}','${i.username}-${i.name}','${i.username}-${i.address}','${i.username}-${i.email}','${i.username}-${i.phoneNumber}','${i.username}-${i.birth}','${i.username}-${i.sex}','${i.username}-${i.codePermissions}',event)">Sửa
                                    nhà cung cấp</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->

    </div>

    <!--  Xóa nhómm người dùng -->
    <div id="delete-User">
        <div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Xóa nhóm người dùng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Bạn có chắc muốn xóa người dùng này?
                        <br>
                        Mã người dùng:
                        <br>
                        Tên người dùng:
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-dan    ger btn-confirm-delete">Xóa</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="../../Js/admin/sidebar.js?v=<?php echo $version ?>"></script> -->
    <!-- <script src="../../Js/admin/usermanager.js?v=<?php echo $version ?>"></script> -->
    <script src="../../Js/QuanLyNguoiDung.js?v=<?php echo $version ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>