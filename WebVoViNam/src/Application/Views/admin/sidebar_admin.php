
        <div class="bar-content">
            <div class="logo" id="logo">
                <img src="/../../image/logo.png" alt="" class="logo">
            </div>
            <div class="sub-menu">
                <ul class="nav-sb">
                    <li>
                        <a href="./Tongquan.php" class="<?php //echo (strpos($current_url,'/Tongquan.php') !==false ) ? 'active' : ''; ?>"><span class="box-cont"><i class="fas fa-tachometer-alt"></i></span><span>Tổng quan</span></a>
                    </li>
                    <li id="user-group-sidebar">
                        <a href="#!" class="<?php //echo (strpos($current_url,'/tongquanQLNND.php') !==false || strpos($current_url,'/tongquanthemQLNND.php') !==false ) ? 'active' : ''; ?>"><span class="box-cont"><i class="fas fa-users"></i></span><span>Nhóm người dùng</span> <i class="fas fa-angle-left"></i></a>
                        <ul class="ele-sub">
                            <li><a href="./tongquanQLNND.php"><span class="box-cont"><i class="far fa-circle"></i></span><span>Danh sách</span></a></li>
                            <li><a href="./tongquanthemQLNND.php"><span class="box-cont"><i class="far fa-circle"></i></span><span>Thêm mới</span></a></li>
                        </ul>
                    </li>
                    <li id="user-management-sidebar" >
                        <a href="#!" class="<?php //echo (strpos($current_url,'/tongquanQLND.php') !==false || strpos($current_url,'/tongquanQLND.php') !==false ) ? 'active' : ''; ?>"><span class="box-cont"><i class="fas fa-user"></i></span><span>Quản lý người dùng</span><i class="fas fa-angle-left"></i></a>
                        <ul class="ele-sub">
                            <li><a href="./tongquanQLND.php"><span class="box-cont"><i class="far fa-circle"></i></span><span>Danh sách</span></a></li>
                            <li id="add-user-management-sidebar"><a href="./tongquanQLND.php"><span class="box-cont"><i class="far fa-circle"></i></span><span>Thêm mới</span></a></li>
                        </ul>
                    </li>
                    <!-- môn sinh -->
                    <li id="student-management-sidebar">
                        <a href="#!" class="<?php //echo (strpos($current_url,'/list-products.php') !==false || strpos($current_url,'/tongquanQaddproductLND.php') !==false || strpos($current_url,'/list-sizes.php') !==false ) ? 'active' : ''; ?>"><span class="box-cont"><i class="fas fa-tshirt"></i></span><span>Quản lý sản phẩm</span><i class="fas fa-angle-left"></i></a>
                        <ul class="ele-sub">
                            <li><a href="./list-products.php"><span class="box-cont"><i class="far fa-circle"></i></span><span>Danh sách</span></a></li>
                            <li id="add-product-management-sidebar"><a href="./addproduct.php"><span class="box-cont"><i class="far fa-circle"></i></span><span>Thêm mới</span></a></li>
                            <li id="size-management-sidebar"><a href="./list-sizes.php"><span class="box-cont"><i class="far fa-circle"></i></span><span>Danh sách size</span></a></li>
                        </ul>
                    </li>
                    <li id="supplier-management-sidebar" >
                        <a href="#" class="<?php //echo (strpos($current_url,'/list-suppliers.php') !==false || strpos($current_url,'/addsupplier.php') !==false ) ? 'active' : ''; ?>"><span class="box-cont"><i class="fa-solid fa-warehouse"></i></span><span>Quản lý nhà cung cấp</span><i class="fas fa-angle-left"></i></a>
                        <ul class="ele-sub">
                            <li><a href="./list-suppliers.php"><span class="box-cont"><i class="far fa-circle"></i></span><span>Danh sách</span></a></li>
                            <li id="add-supplier-management-sidebar"><a href="./addsupplier.php"><span class="box-cont"><i class="far fa-circle"></i></span><span>Thêm mới</span></a></li>
                        </ul>
                    </li>
                    <li id="payment-management-sidebar">
                        <a href="#" class="<?php //echo (strpos($current_url,'/list-payment.php') !==false || strpos($current_url,'/add-payment.php') !==false ) ? 'active' : ''; ?>"><span class="box-cont"><i class="fa-solid fa-money-bill"></i></span><span>Quản lý thanh toán</span><i class="fas fa-angle-left"></i></a>
                        <ul class="ele-sub">
                            <li><a href="../admin/list-payment.php"><span class="box-cont"><i class="far fa-circle"></i></span><span>Danh sách</span></a></li>
                            <li id="add-payment-management-sidebar"><a href="../admin/add-payment.php"><span class="box-cont"><i class="far fa-circle"></i></span><span>Thêm mới</span></a></li>
                        </ul>
                    </li>
                    <li id="transportation-management-sidebar">
                        <a href="#" class="<?php //echo (strpos($current_url,'/list-transport.php') !==false || strpos($current_url,'/addtransport.php') !==false ) ? 'active' : ''; ?>"><span class="box-cont"><i class="fa-solid fa-truck-fast"></i></span><span>Quản lý vận chuyển</span><i class="fas fa-angle-left"></i></a>
                        <ul class="ele-sub">
                            <li><a href="../admin/list-transport.php"><span class="box-cont"><i class="far fa-circle"></i></span><span>Danh sách</span></a></li>
                            <li id="add-transportation-management-sidebar"><a href="../admin/addtransport.php"><span class="box-cont"><i class="far fa-circle"></i></span><span>Thêm mới</span></a></li>
                        </ul>
                    </li>
                    <li id="bill-management-sidebar"><a href="#!" class="<?php //echo (strpos($current_url,'/bill_list.php') !==false ) ? 'active' : ''; ?>"><span class="box-cont"><i class="fas fa-file-invoice-dollar"></i></span><span>Quản lý hóa đơn</span><i class="fas fa-angle-left"></i></a>
                        <ul class="ele-sub">
                            <li><a href="./bill_list.php"><span class="box-cont"><i class="far fa-circle"></i></span><span>Danh sách</span></a></li>
                            <!-- <li><a href="./bill_detail.php"><span class="box-cont"><i class="far fa-circle"></i></span><span>Trạng thái hóa đơn</span></a></li> -->
                        </ul>
                    </li>
                    <li id="contact-management-sidebar"><a href="#!" class="<?php //echo (strpos($current_url,'/contact_list.php') !==false ) ? 'active' : ''; ?>"><span class="box-cont"><i class="fas fa-phone-alt"></i></span><span>Quản lý liên hệ</span><i class="fas fa-angle-left"></i></a>
                        <ul class="ele-sub">
                            <li><a href="./contact_list.php"><span class="box-cont"><i class="far fa-circle"></i></span><span>Danh sách</span></a></li>
                            <!-- <li><a href="./contact_list_noti.php"><span class="box-cont"><i class="far fa-circle"></i></span><span>DS nhận thông báo</span></a></li> -->
                        </ul>
                    </li>
                    <li id="comment-management-sidebar"><a href="#!" class="<?php //echo (strpos($current_url,'/evaluate_list.php') !==false ) ? 'active' : ''; ?>"><span class="box-cont"><i class="fas fa-comments"></i></span><span>Quản lý đánh giá</span><i class="fas fa-angle-left"></i></a>
                        <ul class="ele-sub">
                            <li><a href="./evaluate_list.php"><span class="box-cont"><i class="far fa-circle"></i></span><span>Danh sách</span></a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>