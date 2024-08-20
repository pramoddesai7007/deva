<?php $webinfo = $this->webinfo;
$settinginfo = $this->settinginfo;
/*for whatsapp modules*/
$WhatsApp = $this->db->where('directory', 'whatsapp')->where('status', 1)->get('module');
$whatsapp_count = $WhatsApp->num_rows();
/*end whatsmoudles*/
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="<?php echo html_escape(base_url((!empty($settinginfo->favicon) ? $settinginfo->favicon : 'assets/img/elite-logo.jpeg'))) ?>" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="<?php echo base_url(); ?>website_assets/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>website_assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>website_assets/plugins/themify/themify-icons.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>website_assets/plugins/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>website_assets/plugins/owl-carousel/dist/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/sweetalert/sweetalert.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>website_assets/plugins/owl-carousel/dist/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>website_assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>website_assets/plugins/select2/dist/css/select2-bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>website_assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>website_assets/plugins/fancybox/dist/jquery.fancybox.min.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>website_assets/plugins/jQuery/jquery-3.5.1.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Caveat:400,700|Playfair+Display:400,400i,700,700i,900,900i|Sarabun:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800&display=swap" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>website_assets/css/style.css?v=3" rel="stylesheet">
    <!-- for whatsapp modules -->
    <?php if ($whatsapp_count  == 1) {
        $whatsapp_data = $WhatsApp->row();
        $whatsapp_url =  str_replace("/images/thumbnail.jpg", "", $whatsapp_data->image);
    ?>
        <link href="<?php echo base_url() . $whatsapp_url; ?>/css/floating-wpp.min.css" rel="stylesheet">
        <script src="<?php echo base_url() . $whatsapp_url; ?>/js/floating-wpp.min.js"></script>

    <?php
    } ?>
    <title><?php echo html_escape($title); ?></title>

</head>

<body>
    <input type="hidden" id='base_url' value="<?php echo base_url(); ?>" />
    <input type="hidden" id='csrf_token' value="<?php echo $this->security->get_csrf_hash(); ?>" />
    <input type="hidden" id="findate" value="<?php echo maxfindate(); ?>">
    <nav class="navbar navbar-expand-lg navbar-light header-sticky shadow-sm">
        <!-- <a class="navbar-brand" href="<?php echo base_url(); ?>"><img
                src="<?php echo base_url() . html_escape(!empty($webinfo->logo) ? $webinfo->logo : 'assets/img/header-logo.png'); ?>"
                alt=""></a> -->
        <img src="<?php echo base_url(); ?>assets/img/editlogo.png" style="width:168px ; height:65px ; margin-top:10px ; margin-left:5px ;">
        <div class="d-flex order-lg-last">
            <ul class="navbar-right d-flex align-items-center list-unstyled mb-0">

                <li class="nav-item nav-btn">
                    <?php echo form_open('user/roomlist'); ?>
                    <div class="row no-gutters custom-search-input-2 search-form-content">
                        <div>
                        <button type="submit" class="border-0 d-none d-lg-inline-block nav-link">
    <a class="text-black" href="http://localhost/hotelelite/my-profile" style="color: black;">My Profile</a>
</button>

                        </div>
                    </div>
                    <?php echo form_close() ?>
                </li>

                <li class="nav-item login">
                    <?php if ($this->session->userdata('UserID') == FALSE) { ?>
                        <a class="nav-link" href="<?php echo base_url(); ?>user/login"><i class="far fa-user-circle d-lg-none"></i><span class="d-none d-lg-block"><?php echo display('sign_in') ?></span></a>
                    <?php } else {
                    ?>
                        <a class="nav-link" href="<?php echo base_url(); ?>user/logout"><i class="far fa-user-circle d-lg-none"></i><span class="d-none d-lg-block"><?php echo display('logout') ?></span></a>
                    <?php } ?>
                </li>
                <li class="nav-item dropdown search-icon">
                    <div class="dropdown-menu search-dropdown dropdown-menu-right animate slideIn" aria-labelledby="navbarDropdown1">
                        <input type="email" class="form-control rounded-0" id="searc" placeholder="Search...">
                    </div>
                </li>
                <li class="nav-item nav-btn">
                    <?php echo form_open('user/roomlist'); ?>
                    <div class="row no-gutters custom-search-input-2 search-form-content">
                        <div class="search-option col-12 col-sm-6 col-lg-3" hidden>
                            <label><?php echo display('check_in') ?> <i class="ti-calendar"></i></label>
                            <input id="daterangepickers" class="form-control" type="text" name="checkin" value="<?php date('Y-m-d'); ?>">
                        </div>
                        <div class="search-option col-12 col-sm-6 col-lg-3" hidden>
                            <label><?php echo display('check_out') ?> <i class="ti-calendar"></i></label>
                            <input id="daterangepickers2" class="form-control" type="text" name="checkout" value="<?php date('Y-m-d'); ?>">
                        </div>
                        <div class="search-option col-12 col-sm-6 col-lg-3" hidden>
                            <div class="d-flex align-items-center justify-content-between h-50 border-bottom w-100 px-lg-3 px-xl-4">
                                <div class="search-title fs-13 text-uppercase"><?php echo display('adults') ?></div>
                                <div class="d-flex justify-content-center align-items-center number-spinner">
                                    <a class=" btn-pm" data-dir="dwn"><span class="ti-minus"></span></a>
                                    <input type="text" class="spinner" name="adults" value="2">
                                    <a class=" btn-pm" data-dir="up"><span class="ti-plus"></span></a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between h-50 w-100 px-lg-3 px-xl-4">
                                <div class="search-title fs-13 text-uppercase"><?php echo display('children') ?></div>
                                <div class="d-flex justify-content-center align-items-center children">
                                    <a class=" btn-pm" data-dir="dwn"><span class="ti-minus"></span></a>
                                    <input type="text" class="spinner" name="children" value="0">
                                    <a class=" btn-pm" data-dir="up"><span class="ti-plus"></span></a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="border-0 d-none d-lg-inline-block nav-link">
                                <i class="far fa-calendar-alt mr-2"></i><span><?php echo display('book_now') ?></span>
                            </button>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </li>
            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php $allmenu = $this->allmenu;
                foreach ($allmenu as $menu) {
                    $dropdown = '';
                    $dropdownassest = '';
                    $dropdownaclass = '';
                    $activeclass = '';
                    if ($menu->menu_name == 'Home') {
                        $activeclass = 'active';
                        $href = base_url() . '';
                    } else {
                        $activeclass = '';
                        $href = base_url() . '' . $menu->menu_slug;
                    }
                    if (!empty($menu->sub)) {
                        $dropdown = 'dropdown';
                        $dropdownassest = 'id=navbarDropdown2 role=button data-toggle=dropdown aria-haspopup=true aria-expanded=false';
                        $dropdownaclass = 'dropdown-toggle';
                        $href = '#';
                    }
                ?>
                    <li class="nav-item <?php echo html_escape($dropdown); ?> <?php echo html_escape($activeclass); ?>">
                        <a class="nav-link <?php echo html_escape($dropdownaclass); ?>" href="<?php echo html_escape($href); ?>" <?php echo html_escape($dropdownassest); ?>><?php echo html_escape($menu->menu_name); ?></a>
                        <div class="dropdown-menu animate slideIn" aria-labelledby="navbarDropdown2">
                            <?php if (!empty($menu->sub)) {
                                foreach ($menu->sub as $submenu) {
                            ?>
                                    <a class="dropdown-item" href="<?php echo base_url() . '' . html_escape($submenu->menu_slug); ?>"><?php echo html_escape($submenu->menu_name); ?></a>
                            <?php }
                            }  ?>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
    <!-- /.End of navbar -->
<script>
    // JavaScript to change navbar color on scroll
window.addEventListener('scroll', function() {
    var navbar = document.querySelector('.navbar');
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > 0) {
        navbar.style.backgroundColor = 'rgb(255, 172, 28)';
    } else {
        // Reset to original color if not scrolled
        navbar.style.backgroundColor = ''; // Or you can set it to any default color here
    }
});
</script>



    <section>



        <!-- <div>
        <?php
        $imagePath = 'assets/img/slider1.jpg';
        echo '<img style="width:100%; height:100%;" src="' . $imagePath . '" alt="">';
        ?>
    </div> -->

        <div id="carouselExampleIndicators1" class="carousel slide" data-ride="carousel">
            <!-- <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators1" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators1" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators1" data-slide-to="2"></li>
    </ol> -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/img/room_1.jpeg" class="d-block w-100" alt="..." style="
                       height: 650px;">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/slider_3.jpeg" class="d-block w-100" alt="..." style="
                       height: 650px;">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/slider_4.jpeg" class="d-block w-100" alt="..." style="
                       height: 650px;">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators1" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators1" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    </section>

    <section class="section-scroll">
        <div class="container">
            <div class="row">

                <div class=" col-12 mt-3">
                    <h2 class="text-center">Rooms</h2>
                </div>

                <div class="p-3">
                    <h4 style="background-color: #D3D3D3; color: black;">ROOMS COME & STAY WITH US</h4>

                    <p>Welcome to Hotel Elite boutique, where every room is meticulously designed with your comfort in
                        mind. Our tastefully decorated rooms are furnished with cozy bedding, modern amenities and a
                        welcoming atmosphere that will make you feel right at home. From stylish decor to Internet
                        connection every detailing is done keeping your comfort in mind. Whether you are here for
                        business or leisure, we guarantee you will find everything you need to relax and rejuvenate a
                        comfortable stay.</p>
                </div>

                <div class="container">
    <div class="row">
        <div class="col-lg-6 mt-3">
            <div class="room-card">
                <img src="assets/img/room_1.jpeg" class="room-img" alt="Deluxe Room">
                <div class="room-details">
                    <h3 class="room-title">DELUXE ROOM</h3>
                    <p class="room-description">Spacious 400 square foot Deluxe Rooms cater to your comfort to the fullest.</p>
                    <a href="<?php echo base_url(); ?>Deluxroom/deluxroom" class="btn btn-primary">Explore</a>
                </div>
            </div>
            
        </div>
        <div class="col-lg-6 mt-3">
            <div class="room-card">
                <img src="assets/img/slider_2.jpeg" class="room-img" alt="Premier Room">
                <div class="room-details">
                    <h3 class="room-title">PREMIER ROOM</h3>
                    <p class="room-description">Nestled in the upper floors of the hotel are the luxurious 400 square feet Premier Room.</p>
                    <a href="<?php echo base_url(); ?>Premierroom/premierroom" class="btn btn-primary">Explore</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mt-3">
            <div class="room-card">
                <img src="assets/img/slider_2.jpeg" class="room-img" alt="O Suites">
                <div class="room-details">
                    <h3 class="room-title">O SUITES</h3>
                    <p class="room-description">Luxurious & spacious room with King Bed and seating arrangement. Apprx. 550 Sq ft.</p>
                    <a href="<?php echo base_url(); ?>Osuites/osuites" class="btn btn-primary">Explore</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mt-3">
            <div class="room-card">
                <img src="assets/img/slide33.png" class="room-img" alt="Presidential Suite">
                <div class="room-details">
                    <h3 class="room-title">PRESIDENTIAL SUITE</h3>
                    <p class="room-description">The presidential suite, overlooks the lush green canopy of hotel Elite for those who relish splendid contemporary luxury. Apprx. 1375 Sq.ft.</p>
                    <a href="<?php echo base_url(); ?>Presidentialroom/presidentialroom" class="btn btn-primary">Explore</a>
                </div>
            </div>
        </div>
    </div>
</div>




            </div>


            
        </div>
    </section>

    <style>
.room-card {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    height: 100%;
}

.room-img {
    width: 100%;
    height: 300px; /* Increase the height for larger images */
    object-fit: cover;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}

.room-details {
    padding: 20px;
    background-color: #fff;
    height: calc(100% - 300px); /* Adjust the height of room details */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.room-title {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
}

.room-description {
    font-size: 16px;
    color: #666;
    margin-bottom: 20px;
}

.btn-primary {
    background-color: #D3D3D3;
    border: none;
    color: black; /* Add black color */
}

.btn-primary:hover {
    background-color: #ff4f4f;
    color: white; /* Change text color on hover */
}

</style>

    <br>


    <br>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hotel Amenities</title>
        <!-- Include Owl Carousel CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
        <style>
            .text-center {
                text-align: center;
                margin-bottom: 25px;
            }

            .amenity {
                text-align: center;
                width: 200px;
                margin: 0 auto;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .amenity img {
                height: auto;
                max-width: 30%;
                /* Adjust the value to decrease or increase image size */
                margin-bottom: 3px;
                /* Add 3px margin to the bottom */
            }

            .amenity span {
                margin-top: 3px;
                /* Add 3px margin to the top */
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="text-center">
                <h2>Hotel Amenities</h2>
            </div>

            <!-- Container for Owl Carousel -->
            <div class="owl-carousel owl-theme" id="amenities-slider">
                <!-- Amenity items -->
                <div class="amenity">
                    <img src="<?php echo base_url(); ?>assets/img/icn1.png" alt="...">
                    <span>24X7 Security</span>
                </div>

                <div class="amenity">
                    <img src="<?php echo base_url(); ?>assets/img/icn2.png" alt="...">
                    <span>Free Wifi</span>
                </div>

                <div class="amenity">
                    <img src="<?php echo base_url(); ?>assets/img/icn8.png" alt="...">
                    <span>Daily Housekeeping</span>
                </div>

                <div class="amenity">
                    <img src="<?php echo base_url(); ?>assets/img/icn4.png" alt="...">
                    <span>AC</span>
                </div>

                <div class="amenity">
                    <img src="<?php echo base_url(); ?>assets/img/icn5.png" alt="...">
                    <span>Room Service</span>
                </div>

                <!-- Add more amenity items here -->
                <div class="amenity">
                    <img src="<?php echo base_url(); ?>assets/img/icn3.png" alt="...">
                    <span>Parking</span>
                </div>

                <div class="amenity">
                    <img src="<?php echo base_url(); ?>assets/img/icn9.png" alt="...">
                    <span>Free Toiletries</span>
                </div>

                <div class="amenity">
                    <img src="<?php echo base_url(); ?>assets/img/icn10.png" alt="...">
                    <span>LCD TV</span>
                </div>

                <div class="amenity">
                    <img src="<?php echo base_url(); ?>assets/img/icn11.png" alt="...">
                    <span>Clean Towels</span>
                </div>

                <div class="amenity">
                    <img src="<?php echo base_url(); ?>assets/img/icn12.png" alt="...">
                    <span> Card Payment</span>
                </div>

                <div class="amenity">
                    <img src="<?php echo base_url(); ?>assets/img/icn11.png" alt="...">
                    <span>Clean Linen</span>
                </div>
            </div>
        </div>

        <!-- Include jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Include Owl Carousel JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script>
            $(document).ready(function() {
                // Initialize Owl Carousel with autoplay and pause on hover
                $('#amenities-slider').owlCarousel({
                    loop: true,
                    margin: 10,
                    nav: true,
                    autoplay: true, // Enable autoplay
                    autoplayTimeout: 1000, // Set autoplay interval to 1 second
                    autoplayHoverPause: true, // Pause on hover
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 5
                        },
                        2000: {
                            items: 5
                        }
                    }
                });
            });
        </script>

    </body>
    </html>
</section>
    <br>
    <br>
    <!-- <section>
        <div class="container">
            <div class="row">

                <div class="new-cards1 col-sm-6 col-md-4 mt-2">
                    <ul class="p-4 ">
                        <li>
                            <h4>PARKING</h4>
                        </li>
                        <li>Self-parking: Complimentary On-site
                        </li>
                        <li>Valet parking: Complimentary
                        </li>
                        <li>EV charging: Nearby, null
                        </li>
                        <li>Secured: Not available
                        </li>
                        <li>Covered: Available
                        </li>


                    </ul>
                </div>

                <div class="new-cards2 col-sm-6 col-md-4 mt-2">
                    <ul class="p-4">
                        <li>
                            <h4>TRANSPORTATION
                            </h4>
                        </li>
                        <li>Airport Transfers: Available on Request and Chargeable
                        </li>
                        <li>Railway Transfers: Available on Request and Chargeable
                        </li>
                        <li>Pune International Airport: 116 Kms
                        </li>
                        <li>Satara Railway Station: 7 Kms
                        </li>
                    </ul>
                </div>

                <div class="new-cards3 col-sm-6 col-md-4 mt-2">
                    <ul class="p-4">
                        <li>
                            <h4>WHAT'S NEARBY
                            </h4>
                        <li>Thoseghar: 28 KM
                        </li>
                        <li>Cas Heritech Flower Valley: 29 KM
                        </li>
                        <li>Sajjangad Fort: 18 KM
                        </li>
                        <li>Mahabaleshawar : 57 km
                        </li>
                        <li>Panchgani: 44 Km
                        </li>
                        <li>Vasota: 58 Km
                        </li>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

    </section> -->













    <!-- /.End of newslatter -->
    <footer class="main-footer py-5 border-top-muted bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-xl-3 mb-5">
                    <div class="footer-about">
                        <div class="footer-logo mb-3">
                            <!-- <a href="<?php echo base_url(); ?>"><img
                                    src="<?php echo base_url() . html_escape(!empty($webinfo->footer_logo) ? $webinfo->footer_logo : 'assets/img/header-logo.png'); ?>"
                                    alt="" class="img-fluid"></a> -->
                            <img src="<?php echo base_url(); ?>assets/img/editlogo.png" style="width:168px ; height:65px ; margin-top:10px ; margin-left:5px ;">
                        </div>
                        <?php $footerfirst = $this->db->select('*')->from('tbl_slider')->where('slid', 72)->get()->row();
                        echo htmlspecialchars_decode($footerfirst->subtitle);
                        ?>
                        <div><br></div>
                        <?php $footerfirst = $this->db->select('*')->from('tbl_slider')->where('slid', 74)->get()->row();
                        echo htmlspecialchars_decode($footerfirst->subtitle);
                        ?>

                    </div>
                </div>
                <div class="col-lg-7 col-xl-7 offset-xl-1">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-4 mb-3 mb-lg-0">
                            <?php $footerleftfirst = $this->db->select('*')->from('tbl_widget')->where('widgetid', 23)->get()->row(); ?>
                            <h3 class="link-title fs-18 mb-3 font-weight-600 position-relative text-white">
                                <?php echo html_escape($footerleftfirst->widget_title); ?></h3>
                            <?php $topmenu = $this->db->select('*')->from('top_menu')->get()->result(); ?>
                            <ul class="footer-link list-unstyled menu mb-0">
                                <?php foreach ($topmenu as $top) { ?>
                                    <li class="mb-2"><a class="link d-block font-weight-500" href="<?php echo html_escape($top->menu_slug); ?>"><?php echo html_escape($top->menu_name); ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-4 mb-3 mb-lg-0">
                            <?php $footersecond = $this->db->select('*')->from('tbl_widget')->where('widgetid', 24)->get()->row(); ?>
                            <h3 class="link-title fs-18 mb-3 font-weight-600 position-relative text-white">
                                <?php echo display("social_link"); ?></h3>
                            <?php $link = $this->db->select('*')->from('tbl_slider')->where('slid', 81)->get()->row(); ?>
                            <?php $link1 = $this->db->select('*')->from('tbl_slider')->where('slid', 82)->get()->row(); ?>
                            <?php $link2 = $this->db->select('*')->from('tbl_slider')->where('slid', 83)->get()->row(); ?>
                            <?php $link3 = $this->db->select('*')->from('tbl_slider')->where('slid', 84)->get()->row(); ?>
                            <ul class="list-unstyled social-icon">
                                <li><a href="<?php echo html_escape($link->link1) ?>" target="_blank" rel="noopener noreferrer"> <i class="fab fa-instagram icon-wrap"></i>
                                        <span><?php echo  display("instagram") ?> </span> </a></li>
                                <li><a href="<?php echo html_escape($link1->link1) ?>" target="_blank" rel="noopener noreferrer"> <i class="fab fa-twitter icon-wrap"></i>
                                        <span><?php echo  display("twitter") ?></span> </a></li>
                                <li><a href="<?php echo html_escape($link2->link1) ?>" target="_blank" rel="noopener noreferrer"> <i class="fab fa-dribbble icon-wrap"></i>
                                        <span><?php echo  display("dribbble") ?></span> </a></li>
                                <li><a href="<?php echo html_escape($link3->link1) ?>" target="_blank" rel="noopener noreferrer"> <i class="fab fa-facebook-f icon-wrap"></i>
                                        <span><?php echo  display("facebook") ?></span> </a></li>
                            </ul>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <?php $footerfourth = $this->db->select('*')->from('tbl_widget')->where('widgetid', 26)->get()->row(); ?>
                            <h3 class="link-title fs-18 mb-3 font-weight-600 position-relative text-white">
                                <?php echo html_escape($footerfourth->widget_title); ?></h3>
                            <?php echo htmlspecialchars_decode($footerfourth->widget_desc); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- /.End of main footer -->
    <div class="sub-footer border-top-muted bg-dark py-3">
        <div class="container">
            <div class="row justify-content-end align-items-center">
                <div class="col-md-6">
                    <div class="copy"><?php echo html_escape($webinfo->powerbytxt); ?></div>
                    <p class="text-white">© Copyright 2023 by AB Software Solution.</p>
                </div>
                <div class="col-md-6">
                    <ul class="list-unstyled text-right mb-0">
                        <li class="list-inline-item"><a href="<?php echo base_url(); ?>privacy" class="text-white"><?php echo display('privacy') ?></a></li>
                        <li class="list-inline-item"><a href="<?php echo base_url(); ?>terms" class="text-white"><?php echo display('terms_conditions') ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /.End of sub footer -->








    <!-- new cdn -->


    <script>
        $(document).ready(function() {
            $('#carouselExampleIndicators1').carousel();
        });
    </script>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Add Bootstrap JavaScript link -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo base_url(); ?>website_assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>website_assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>website_assets/plugins/owl-carousel/dist/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>website_assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="<?php echo base_url(); ?>website_assets/plugins/daterangepicker/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>website_assets/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url(); ?>website_assets/plugins/isotope/isotope.pkgd.js"></script>
    <script src="<?php echo base_url(); ?>website_assets/plugins/fancybox/dist/jquery.fancybox.min.js"></script>
    <script src="<?php echo base_url(); ?>website_assets/plugins/theia-sticky-sidebar/dist/ResizeSensor.min.js"></script>
    <script src="<?php echo base_url(); ?>website_assets/plugins/theia-sticky-sidebar/dist/theia-sticky-sidebar.min.js">
    </script>
    <script src="<?php echo base_url(); ?>website_assets/plugins/numscroller/numscroller-1.0.js"></script>
    <!-- sweetalert -->
    <script src="<?php echo base_url('assets/sweetalert/sweetalert.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>website_assets/js/script.js"></script>
    <script src="<?php echo base_url(); ?>website_assets/js/subscriber_email.js"></script>
    <?php if ($title == 'Contact Us') { ?>
        <input type="hidden" id="latitude" value="<?php echo html_escape($settinginfo->latitude); ?>">
        <input type="hidden" id="longitude" value="<?php echo html_escape($settinginfo->longitude); ?>">
        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo html_escape($settinginfo->map_key); ?>">
        </script>
        <script src="<?php echo base_url(); ?>website_assets/js/loadMap.js"></script>
    <?php } ?>
    <?php if ($whatsapp_count  == 1) {
        $whatsapp_data = $WhatsApp->row();
        $whatsapp_url =  str_replace("/images/thumbnail.jpg", "", $whatsapp_data->image);
        $wtapp = $this->db->select('*')->from('whatsapp_settings')->get()->row();
        if ($wtapp->chatenable == 1) {
    ?>
            <div id="WAButton"></div>
            <input type="hidden" id="wanumber" value="<?php echo $this->settinginfo->whatsapp_number; ?>">
            <input type="hidden" id="waheader" value="<?php echo display('whatsapp_chat') ?> ">
            <input type="hidden" id="wapopup" value="<?php echo display('hello,_how_can_we_help_you?') ?>">
            <input type="hidden" id="wabtnimg" value="<?php echo base_url() . $whatsapp_url; ?>">
            <script src="<?php echo base_url() ?>website_assets/js/wachat.js?v=1"></script>
    <?php }
    } ?>
</body>

</html>