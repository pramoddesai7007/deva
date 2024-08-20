<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
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
    <div class="section">
        <div class="container">


            <div class="row g-5">
                <div class="col-lg-5 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".3s">
                    <div class="h-100 position-relative">
                        <img src="assets/img/s14.jpeg" class="img-fluid w-75 rounded" alt="" style="margin-bottom: 25%;">
                        <div class="position-absolute w-75" style="top: 25%; left: 25%;">
                            <img src="assets/img/s29.jpeg" class="img-fluid w-100 rounded" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".5s">
                <h5 class="text-primary" style="background-color: #D3D3D3;">About Us</h5>


                    <h1 class="mb-4"><strong>About HighTech Agency And Its Innovative IT Solutions</strong></h1>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed efficitur quis purus ut interdum. Pellentesque aliquam dolor eget urna ultricies tincidunt. Nam volutpat libero sit amet leo cursus, ac viverra eros tristique. Morbi quis quam mi. Cras vel gravida eros. Proin scelerisque quam nec elementum viverra. Suspendisse viverra hendrerit diam in tempus. Etiam gravida justo nec erat vestibulum, et malesuada augue laoreet.</p>
                    <p class="mb-4">Pellentesque aliquam dolor eget urna ultricies tincidunt. Nam volutpat libero sit amet leo cursus, ac viverra eros tristique. Morbi quis quam mi. Cras vel gravida eros. Proin scelerisque quam nec elementum viverra. Suspendisse viverra hendrerit diam in tempus.</p>
                    <a href="" class="btn btn-secondary rounded-pill px-5 py-3" style="background-color: #D3D3D3; color: black; transition: background-color 0.3s;">More Details</a>
                    <style>
    .btn-secondary:hover {
        background-color: #5cbde466 !important;
        color: black !important;
    }
</style>



                </div>
            </div>
        </div>
    </div>
    <br>
    <br><br><br>
    <!-- <div class="section section-about">
        <div class="container">
            <div class="row">
                <?php $thausand = $this->db->select('*')->from('tbl_widget')->where('widgetid', 13)->get()->row(); ?>
                <div class="col-md-10 offset-md-1">
                    <div class="section-title text-center mb-5 col-middle">
                        <h2 class="block-title fs-25 mb-2 font-weight-bold">
                            <?php echo html_escape($thausand->widget_title); ?></h2>
                        <div class="sub-title fs-18">
                            <?php echo html_escape($thausand->widget_desc); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php foreach ($company as $company_logo) { ?>
                <div class="col-4 col-md-2 mb-5">
                    <img class="clients"
                        src="<?php echo base_url() . html_escape(!empty($company_logo->image) ? $company_logo->image : 'assets/img/About-us/trusted_by_companies.png'); ?>"
                        alt="Image Description">
                </div>
                <?php } ?>
            </div>
        </div>
    </div> -->
    <!-- Our team Section -->
    <!--     
    <div class="section team">
        <div class="container">
            <div class="row">
                <?php $oteam = $this->db->select('*')->from('tbl_widget')->where('widgetid', 11)->get()->row(); ?>
                <div class="col-md-10 offset-md-1">
                    <div class="section-title text-center mb-5">
                        <h2 class="block-title fs-25 mb-2 font-weight-bold">
                            <?php echo html_escape($oteam->widget_title); ?></h2>
                        <div class="sub-title fs-18">
                            <?php echo html_escape($oteam->widget_desc); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <?php $social = $this->db->select('*')->from('tbl_widget')->where('widgetid', 28)->get()->row(); ?>
                <?php foreach ($team_info as $teaminfo) { ?>
                <div class="col-md-3">
                    <div class="team-member">
                        <figure>
                            <img src="<?php echo base_url() . html_escape(!empty($teaminfo->image) ? $teaminfo->image : 'assets/img/About-us/our_team.png'); ?>"
                                alt="" class="img-fluid">
                            <figcaption
                                class="d-flex flex-column justify-content-center align-content-center position-absolute bottom-0 left-0 w-100 p-3">
                                <p><?php echo html_escape($teaminfo->slink); ?></p>
                                <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item"><a href="<?php echo html_escape($teaminfo->link1); ?>"
                                            class="text-white fs-24"><i class="fab fa-facebook-square"></i></a></li>
                                    <li class="list-inline-item"><a href="<?php echo html_escape($teaminfo->link2); ?>"
                                            class="text-white fs-24"><i class="fab fa-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="<?php echo html_escape($teaminfo->link3); ?>"
                                            class="text-white fs-24"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </figcaption>
                        </figure>
                        <h4 class="fs-21 font-weight-600 mt-2 mb-0"><?php echo html_escape($teaminfo->title); ?></h4>
                        <p class="mb-0"><?php echo html_escape($teaminfo->subtitle); ?></p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div> -->



    <section>
        <div class="container">
            <div class="text-center">
                <div class="row justify-content-center mb-0 pb-0"> <!-- Adjusted margin and padding here -->
                    <div class="col-md-7 heading-section text-center ftco-animate">
                        <span class="subheading" style="font-family: 'Poppins', sans-serif; font-weight: bold; color: black;">Welcome to Harbor Lights Hotel</span>
                        <h2 class="mb-4">You'll Never Want To Leave</h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-sm-6 col-md-2 mt-2">
                    <div class="block">
                        <div class="new-cards1">
                            <div class="circle-icon"><img src="assets/img/room1.png" alt="Bed Icon"></div>
                            <h4 class="text-center mt-3">COZY ROOMS</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-2 mt-2">
                    <div class="block">
                        <div class="new-cards1">
                            <div class="circle-icon"><img src="assets/img/food2.png" alt="Food Icon"></div>
                            <h4 class="text-center mt-3">FOOD</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-2 mt-2">
                    <div class="block">
                        <div class="new-cards1">
                            <div class="circle-icon"><img src="assets/img/parking1.png" alt="Parking Icon"></div>
                            <h4 class="text-center mt-3">PARKING</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-2 mt-2">
                    <div class="block">
                        <div class="new-cards1">
                            <div class="circle-icon"><img src="assets/img/travelling1.png" alt="Travel Icon"></div>
                            <h4 class="text-center mt-3">TRANSFER SERVICE</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-2 mt-2">
                    <div class="block">
                        <div class="new-cards1">
                            <div class="circle-icon"><img src="assets/img/wifi1.png" alt="Wifi Icon"></div>
                            <h4 class="text-center mt-3">FREE WIFI</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
     .circle-icon {
        width: 80px;
        height: 80px;
        background-color: #ffffff; /* White color */
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .circle-icon img {
        width: 60px; /* Decreased image width */
        height: 60px; /* Decreased image height */
        object-fit: cover;
    }

    .block {
        display: inline-block;
        margin-right: 10px;
    }

    .new-cards1 {
        width: 180px;
        height: 200px;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        transition: transform 0.3s ease; /* Added transition for transform property */
    }

    .new-cards1:hover {
        transform: translateY(-13px); /* Move the div 5px upwards on hover */
    }

        </style>
    </section>
    <br>
    <br>
    <br><br>


    <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hotel Information</title>
<style>
    /* Container */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Section Heading */
    h2 {
        text-align: center;
        margin-bottom: 40px;
        font-size: 2rem;
        color: #333;
    }

    /* Info Box */
    .info-box {
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    /* Info Title */
    .info-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }

    /* Info Items */
    .info-item {
        margin-bottom: 10px;
        font-size: 1.1rem;
        color: #666;
    }

    /* Highlight on Hover */
    .info-item:hover {
        color: #000;
        transition: color 0.3s ease;
    }

    /* Responsive */
    @media (max-width: 768px) {
        h2 {
            font-size: 1.5rem;
        }

        .info-title {
            font-size: 1.2rem;
        }

        .info-item {
            font-size: 1rem;
        }
    }
</style>
</head>
<body>

<section>
    <div class="container">
        <h2>Hotel Information</h2>
        <div class="row">
            <div class="col-sm-6 col-md-4 mt-2">
                <div class="info-box">
                    <div class="info-title">PARKING</div>
                    <div class="info-item">Self-parking: Complimentary On-site</div>
                    <div class="info-item">Valet parking: Complimentary</div>
                    <div class="info-item">EV charging: Nearby, null</div>
                    <div class="info-item">Secured: Not available</div>
                    <div class="info-item">Covered: Available</div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 mt-2">
                <div class="info-box">
                    <div class="info-title">TRANSPORTATION</div>
                    <div class="info-item">Airport Transfers: Available on Request and Chargeable</div>
                    <div class="info-item">Railway Transfers: Available on Request and Chargeable</div>
                    <div class="info-item">Pune International Airport: 116 Kms</div>
                    <div class="info-item">Satara Railway Station: 7 Kms</div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 mt-2">
                <div class="info-box">
                    <div class="info-title">WHAT'S NEARBY</div>
                    <div class="info-item">Thoseghar: 28 KM</div>
                    <div class="info-item">Cas Heritech Flower Valley: 29 KM</div>
                    <div class="info-item">Sajjangad Fort: 18 KM</div>
                    <div class="info-item">Mahabaleshawar: 57 km</div>
                    <div class="info-item">Panchgani: 44 Km</div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>

    <br><br>