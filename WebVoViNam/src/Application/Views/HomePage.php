<!DOCTYPE html>
<html lang="en">
<?php require('../../config.php') ?>

<head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>HomePage</title>
       <!-- <link rel="stylesheet" href="../css/Footer.css">
       <link rel="stylesheet" href="../css/HomePage.css">
       <link rel="stylesheet" href="../css/Header.css"> -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
       <!-- thư viện dùng cho alert -->
       <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
       <link rel="shortcut icon" href="../image/logo-sgu.png" type="image/x-icon">
       <style>
              <?php
              require('../css/Header.css');
              require('../css/Footer.css');
              require('../css/HomePage.css');
              ?>
       </style>


</head>

<body>
       <!-- header -->
       <?php require('./header.php'); ?>
       <!-- body -->
       <section class="body">
              <div class="banner-img">
                     <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                   <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                   <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                   <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                   <div class="carousel-item active">
                                          <img src="../image/banner-1.png" class="d-block w-100" alt="...">
                                   </div>
                                   <div class="carousel-item">
                                          <img src="../image/banner-2-1.png" class="d-block w-100" alt="...">
                                   </div>
                                   <div class="carousel-item">
                                          <img src="../image/banner-3-1.png" class="d-block w-100" alt="...">
                                   </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                   <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                   <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                   <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                   <span class="visually-hidden">Next</span>
                            </button>
                     </div>
              </div>
              <div class="content-product">
                     <div class="product-feature">
                            <div class="pre-button">
                                   <span><i class="fas fa-chevron-left"></i></span>
                            </div>
                            <div class="next-button">
                                   <span><i class="fas fa-chevron-right"></i></span>
                            </div>
                            <div class="widget-title">
                                   <span>FEATURED</span>
                                   <span><i class="far fa-star"></i></span>
                            </div>
                            <div class="product">
                                   <div style="margin: 0 auto;" class="spinner-border text-primary" role="status">
                                          <span class="visually-hidden">Loading...</span>
                                   </div>
                                   <!-- <div class="product-item">
                                          <div class="image-item">
                                                 <a href='./ProductDetail.php'>
                                                        <img src="../image/product/product1/product-detail-1.png" alt="">
                                                        <a href="./Cart.php">
                                                               <div class="add-to-cart">
                                                                      <span><i class="fas fa-shopping-bag"></i></span>
                                                               </div>
                                                        </a>
                                                        <a href="./ProductDetail.php">
                                                               <div class="see-more">
                                                                      <span><i class="far fa-eye"></i></span>
                                                               </div>
                                                        </a>
                                                        <div class="discount">
                                                               <span>20%</span>
                                                        </div>
                                                 </a>
                                          </div>
                                          <div class="name-item">
                                                 <a href="">
                                                        <span>Conton T-shirt</span>
                                                 </a>
                                          </div>
                                          <div class="price-item">
                                                 <span>$ 9.99</span>
                                          </div>
                                   </div>
                                   <div class="product-item">
                                          <div class="image-item">
                                                 <a href="http://">
                                                        <img src="../image/product/product1/product-detail-1.png" alt="">
                                                        <a href="./Cart.php">
                                                               <div class="add-to-cart">
                                                                      <span><i class="fas fa-shopping-bag"></i></span>
                                                               </div>
                                                        </a>
                                                        <a href="./ProductDetail.php">
                                                               <div class="see-more">
                                                                      <span><i class="far fa-eye"></i></span>
                                                               </div>
                                                        </a>
                                                 </a>
                                          </div>
                                          <div class="name-item">
                                                 <a href="">
                                                        <span>Conton T-shirt</span>
                                                 </a>
                                          </div>
                                          <div class="price-item">
                                                 <span>$ 9.99</span>
                                          </div>
                                   </div>
                                   <div class="product-item">
                                          <div class="image-item">
                                                 <a href="http://">
                                                        <img src="../image/product/product1/product-detail-1.png" alt="">
                                                        <a href="./Cart.php">
                                                               <div class="add-to-cart">
                                                                      <span><i class="fas fa-shopping-bag"></i></span>
                                                               </div>
                                                        </a>
                                                        <a href="./ProductDetail.php">
                                                               <div class="see-more">
                                                                      <span><i class="far fa-eye"></i></span>
                                                               </div>
                                                        </a>
                                                 </a>
                                          </div>
                                          <div class="name-item">
                                                 <a href="">
                                                        <span>Conton T-shirt</span>
                                                 </a>
                                          </div>
                                          <div class="price-item">
                                                 <span>$ 9.99</span>
                                          </div>
                                   </div>
                                   <div class="product-item">
                                          <div class="image-item">
                                                 <a href="http://">
                                                        <img src="../image/product/product1/product-detail-1.png" alt="">
                                                        <a href="./Cart.php">
                                                               <div class="add-to-cart">
                                                                      <span><i class="fas fa-shopping-bag"></i></span>
                                                               </div>
                                                        </a>
                                                        <a href="./ProductDetail.php">
                                                               <div class="see-more">
                                                                      <span><i class="far fa-eye"></i></span>
                                                               </div>
                                                        </a>
                                                 </a>
                                          </div>
                                          <div class="name-item">
                                                 <a href="">
                                                        <span>Conton T-shirt</span>
                                                 </a>
                                          </div>
                                          <div class="price-item">
                                                 <span>$ 9.99</span>
                                          </div>
                                   </div>
                                   <div class="product-item">
                                          <div class="image-item">
                                                 <a href="http://">
                                                        <img src="../image/product/product1/product-detail-1.png" alt="">
                                                        <a href="./Cart.php">
                                                               <div class="add-to-cart">
                                                                      <span><i class="fas fa-shopping-bag"></i></span>
                                                               </div>
                                                        </a>
                                                        <a href="./ProductDetail.php">
                                                               <div class="see-more">
                                                                      <span><i class="far fa-eye"></i></span>
                                                               </div>
                                                        </a>
                                                 </a>
                                          </div>
                                          <div class="name-item">
                                                 <a href="">
                                                        <span>Conton T-shirt</span>
                                                 </a>
                                          </div>
                                          <div class="price-item">
                                                 <span>$ 9.99</span>
                                          </div>
                                   </div> -->
                            </div>
                     </div>
                     <div class="product-type">
                            <a href="./Shop.php">
                                   <div class="type">
                                          <img src="../image/home1_img1.jpg" alt="">
                                          <div class="widget-title">
                                                 <span>SHOP FOR</span>
                                                 <span>MEN</span>
                                          </div>
                                          <div class="see-more">
                                                 <span>Shop now <i class="fas fa-arrow-right"></i></span>
                                          </div>
                                   </div>
                            </a>
                            <a href="./Shop.php">
                                   <div class="type">
                                          <img src="../image/banner2.jpg" alt="">
                                          <div class="widget-title">
                                                 <span>SHOP FOR</span>
                                                 <span>WOMEN</span>
                                          </div>
                                          <div class="see-more">
                                                 <span>Shop now <i class="fas fa-arrow-right"></i></span>
                                          </div>
                                   </div>
                            </a>
                            <a href="./Shop.php">
                                   <div class="type">
                                          <img src="../image/banner3.jpg" alt="">
                                          <div class="widget-title">
                                                 <span>SHOP FOR</span>
                                                 <span>KID</span>
                                          </div>
                                          <div class="see-more">
                                                 <span>Shop now <i class="fas fa-arrow-right"></i></span>
                                          </div>
                                   </div>
                            </a>
                     </div>
                     <div class="product-top">
                            <div class="widget-title">
                                   <div>
                                          <a href="" id="reconmmended" class="is-active"><span>RECOMMENDED</span></a>
                                          <a href="" id="sale-product"><span>SALE PRODUCT</span></a>
                                          <a href="" id="best-selling-product"><span>BEST SELLING PRODUCTS</span></a>
                                   </div>
                                   <span><i class="far fa-star"></i></span>
                            </div>
                            <div class="product">
                                   <div style="margin: 0 auto;" class="spinner-border text-primary" role="status">
                                          <span class="visually-hidden">Loading...</span>
                                   </div>
                                   <!-- <div class="product-item">
                                          <div class="image-item">
                                                 <a href="http://">
                                                        <img src="../image/product/product1/product-detail-1.png" alt="">
                                                        <a href="./Cart.php">
                                                               <div class="add-to-cart">
                                                                      <span><i class="fas fa-shopping-bag"></i></span>
                                                               </div>
                                                        </a>
                                                        <a href="./ProductDetail.php">
                                                               <div class="see-more">
                                                                      <span><i class="far fa-eye"></i></span>
                                                               </div>
                                                        </a>
                                                        <div class="discount">
                                                               <span>20%</span>
                                                        </div>
                                                 </a>
                                          </div>
                                          <div class="name-item">
                                                 <a href="">
                                                        <span>Conton T-shirt</span>
                                                 </a>
                                          </div>
                                          <div class="price-item">
                                                 <span>$ 9.99</span>
                                          </div>
                                   </div>
                                   <div class="product-item">
                                          <div class="image-item">
                                                 <a href="http://">
                                                        <img src="../image/product/product1/product-detail-1.png" alt="">
                                                        <a href="./Cart.php">
                                                               <div class="add-to-cart">
                                                                      <span><i class="fas fa-shopping-bag"></i></span>
                                                               </div>
                                                        </a>
                                                        <a href="./ProductDetail.php">
                                                               <div class="see-more">
                                                                      <span><i class="far fa-eye"></i></span>
                                                               </div>
                                                        </a>
                                                 </a>
                                          </div>
                                          <div class="name-item">
                                                 <a href="">
                                                        <span>Conton T-shirt</span>
                                                 </a>
                                          </div>
                                          <div class="price-item">
                                                 <span>$ 9.99</span>
                                          </div>
                                   </div>
                                   <div class="product-item">
                                          <div class="image-item">
                                                 <a href="http://">
                                                        <img src="../image/product/product1/product-detail-1.png" alt="">
                                                        <a href="./Cart.php">
                                                               <div class="add-to-cart">
                                                                      <span><i class="fas fa-shopping-bag"></i></span>
                                                               </div>
                                                        </a>
                                                        <a href="./ProductDetail.php">
                                                               <div class="see-more">
                                                                      <span><i class="far fa-eye"></i></span>
                                                               </div>
                                                        </a>
                                                 </a>
                                          </div>
                                          <div class="name-item">
                                                 <a href="">
                                                        <span>Conton T-shirt</span>
                                                 </a>
                                          </div>
                                          <div class="price-item">
                                                 <span>$ 9.99</span>
                                          </div>
                                   </div>
                                   <div class="product-item">
                                          <div class="image-item">
                                                 <a href="http://">
                                                        <img src="../image/product/product1/product-detail-1.png" alt="">
                                                        <a href="./Cart.php">
                                                               <div class="add-to-cart">
                                                                      <span><i class="fas fa-shopping-bag"></i></span>
                                                               </div>
                                                        </a>
                                                        <a href="./ProductDetail.php">
                                                               <div class="see-more">
                                                                      <span><i class="far fa-eye"></i></span>
                                                               </div>
                                                        </a>
                                                 </a>
                                          </div>
                                          <div class="name-item">
                                                 <a href="">
                                                        <span>Conton T-shirt</span>
                                                 </a>
                                          </div>
                                          <div class="price-item">
                                                 <span>$ 9.99</span>
                                          </div>
                                   </div>
                                   <div class="product-item">
                                          <div class="image-item">
                                                 <a href="http://">
                                                        <img src="../image/product/product1/product-detail-1.png" alt="">
                                                        <a href="./Cart.php">
                                                               <div class="add-to-cart">
                                                                      <span><i class="fas fa-shopping-bag"></i></span>
                                                               </div>
                                                        </a>
                                                        <a href="./ProductDetail.php">
                                                               <div class="see-more">
                                                                      <span><i class="far fa-eye"></i></span>
                                                               </div>
                                                        </a>
                                                 </a>
                                          </div>
                                          <div class="name-item">
                                                 <a href="">
                                                        <span>Conton T-shirt</span>
                                                 </a>
                                          </div>
                                          <div class="price-item">
                                                 <span>$ 9.99</span>
                                          </div>
                                   </div>
                                   <div class="product-item">
                                          <div class="image-item">
                                                 <a href="http://">
                                                        <img src="../image/product/product1/product-detail-1.png" alt="">
                                                        <a href="./Cart.php">
                                                               <div class="add-to-cart">
                                                                      <span><i class="fas fa-shopping-bag"></i></span>
                                                               </div>
                                                        </a>
                                                        <a href="./ProductDetail.php">
                                                               <div class="see-more">
                                                                      <span><i class="far fa-eye"></i></span>
                                                               </div>
                                                        </a>
                                                 </a>
                                          </div>
                                          <div class="name-item">
                                                 <a href="">
                                                        <span>Conton T-shirt</span>
                                                 </a>
                                          </div>
                                          <div class="price-item">
                                                 <span>$ 9.99</span>
                                          </div>
                                   </div> -->
                            </div>
                     </div>
              </div>
              <div class="contact-us">
                     <div class="banner">
                            <img width="100%" src="../image/bg_newsletter_07_36c68509-febe-498f-88d7-88bf084d5134.jpg" alt="">
                     </div>

                     <div class="widget-title">
                            <span>CONTACT US</span>
                            <span><i class="far fa-star"></i></span>
                     </div>
                     <div class="text-infor">
                            <p>Our website always wants to bring the best to our customers. We always listen to customer feedback to have the best improvements and fixes for our customers. So, if you have any feedback for us, please contact us now. We will try to fix it to create the most comfort for users.</p>
                     </div>
                     <a href="./contacts.php">
                            <div class="button-contact">
                                   <span>CONTACT US <i class="fas fa-arrow-right"></i></span>
                            </div>
                     </a>

              </div>
       </section>

       <!-- footer -->
       <?php require('./footer.php'); ?>

       <script src="../Js/Header.js?v=<?php echo $version ?>"></script>
       <script src="../Js/HomePage.js?v=<?php echo $version ?>"></script>
       <!-- <script src="../Js/admin/payment.js?v=<?php echo $version ?>"></script> -->
       <!-- thư viện dùng cho alert -->
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
</body>

</html>