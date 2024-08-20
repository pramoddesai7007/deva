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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 text-center">

            <?php if($this->session->userdata('message')) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <?php echo $this->session->userdata('message'); 
						 $this->session->unset_userdata('message');
						?>
            </div>
            <?php } ?>
            <?php if ($this->session->userdata('exception')) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <?php echo $this->session->userdata('exception');
						 $this->session->unset_userdata('exception');
						 ?>
            </div>
            <?php } ?>
            <?php if (validation_errors()) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <?php echo validation_errors(); ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="hero-header">
    <div class="header-slider header-slider-preloader slider-two" id="home">
        <div class="animation-slide owl-carousel owl-theme" id="animation-slide">
            <?php foreach($slider_info as $slider){?>
            <div class="item bg-img-hero"
                data-image-src="<?php echo base_url().html_escape(!empty($slider->image)?$slider->image:'assets/img/Home-page/slider.png');?>">
            </div>
            <?php } ?>
        </div>
    </div>
    <!-- /.End of header slider -->
    <div class="container">
        <div class="hero-header_wrap">
            <div class="row align-items-center">
                <div class="col-12 col-md-7">
                    <div class="header-text my-5">
                        <?php $slidertext=$this->db->select('*')->from('tbl_widget')->where('widgetid',1)->get()->row();?>
                        <h6 class="header-subtitle"><?php echo html_escape($slidertext->widget_name);?></h6>
                        <h1 class="header-title"><?php echo html_escape($slidertext->widget_title);?></h1>
                        <p class="header-des mb-0"><?php echo html_escape($slidertext->widget_desc);?></p>
                    </div>
                </div>
                <div class="col-md-5 d-none d-md-block">
                    <div class="offer-carousel owl-carousel owl-theme">
                        <?php foreach($randoffer as $myoffer){
								$offerDate = date("F d", strtotime($myoffer->offer_date));
								$offertotal=$myoffer->offer;
								$tax=$this->settinginfo->vat;
								$taxamount=$offertotal*$tax/100;
					 			$servicecharge=$this->settinginfo->servicecharge;
								$serviceamnt=$offertotal*$servicecharge/100;
								$nextdate=date('Y-m-d',strtotime($myoffer->offer_date. "+1 days"));
								$roominfo= $this->db->select('*')->from('roomdetails')->where('roomid',$myoffer->roomid)->get()->row();  
								?>
                        <div class="offer d-flex align-items-center text-center">
                            <div class="w_100">
                                <div class="ribbon">
                                    <span><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?><?php echo html_escape($offertotal);?><?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?></span>
                                </div>
                                <h2 class="text-white mb-4 font-weight-bold">
                                    <?php echo html_escape($myoffer->offertitle);?></h2>
                                <h3 class="text-white fs-21"><?php echo html_escape($myoffer->offertext);?></h3>
                                <a href="<?php echo base_url();?>roomdetails?checkin=<?php echo $myoffer->offer_date;?>&checkout=<?php echo $nextdate;?>&adults=<?php echo $roominfo->capacity;?>&children=1&roomid=<?php echo $myoffer->roomid;?>"
                                    class="btn btn-primary mt-5"><?php echo display('book_by') ?>
                                    <?php echo html_escape($offerDate);?></a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- /.End of hero header -->
    <div class="slider_preloader">
        <div class="slider_preloader_status">&nbsp;</div>
    </div>
    <!-- /.End of slider preloader -->
</div>
<!-- /.End of hero header -->
<div class="container">
    <div class="search-area">
        <?php echo form_open('user/roomlist');?>
        <div class="row no-gutters custom-search-input-2 search-form-content">
            <div class="search-option col-12 col-sm-6 col-lg-3">
                <label><?php echo display('check_in')?> <i class="ti-calendar"></i></label>
                <input id="daterangepicker" class="form-control" type="text" name="checkin"
                    value="<?php date('Y-m-d');?>">
            </div>
            <div class="search-option col-12 col-sm-6 col-lg-3">
                <label><?php echo display('check_out')?> <i class="ti-calendar"></i></label>
                <input id="daterangepicker2" class="form-control" type="text" name="checkout"
                    value="<?php date('Y-m-d');?>">
            </div>
            <div class="search-option col-12 col-sm-6 col-lg-3">
                <div class="d-flex align-items-center justify-content-between h-50 border-bottom w-100 px-lg-3 px-xl-4">
                    <div class="search-title fs-13 text-uppercase"><?php echo display('adults')?></div>
                    <div class="d-flex justify-content-center align-items-center number-spinner">
                        <a class=" btn-pm" data-dir="dwn"><span class="ti-minus"></span></a>
                        <input type="text" class="spinner" name="adults" value="2">
                        <a class=" btn-pm" data-dir="up"><span class="ti-plus"></span></a>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between h-50 w-100 px-lg-3 px-xl-4">
                    <div class="search-title fs-13 text-uppercase"><?php echo display('children')?></div>
                    <div class="d-flex justify-content-center align-items-center children">
                        <a class=" btn-pm" data-dir="dwn"><span class="ti-minus"></span></a>
                        <input type="text" class="spinner" name="children" value="0">
                        <a class=" btn-pm" data-dir="up"><span class="ti-plus"></span></a>
                    </div>
                </div>
            </div>
            <?php $hotline=$this->db->select('*')->from('tbl_slider')->where('slid',75)->get()->row();?>
            <div class="col-lg-3">
                <button type="submit" class="btn">
                    <span><?php echo display('need_help')?>
                        <p><?php echo html_escape($hotline->subtitle);?></p></span>
                    <?php echo display('check_availability')?>
                </button>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
</div>
<br>
<br>
<!-- /.End of search area -->
<!-- 
<div class="section section-feature bg-gray position-relative">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-3 mb-4 mb-md-0">
                <div class="feature-box text-center">
                    <?php $pig_mpney=$this->db->select('*')->from('tbl_slider')->where('slid',58)->get()->row();?>
                    <div class="feature-box-icon mb-3">
                    <img src="<?php echo html_escape(base_url().(!empty($pig_mpney->image)?$pig_mpney->image:'assets/img/Home-page/save_line_all.png'));?>"
                            alt="Card image" class="img-fluid">
                    </div>
                    <?php $saveupto=$this->db->select('*')->from('tbl_widget')->where('widgetid',7)->get()->row();?>
                    <h4 class="feature-box-title fs-21 font-weight-600">
                        <?php echo html_escape($saveupto->widget_title);?></h4>
                    <p class="mb-0"><?php echo html_escape($saveupto->widget_desc);?></p>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 mb-4 mb-md-0">
                <div class="feature-box text-center">
                    <div class="feature-box-icon mb-3">
                        <?php $tik_mark=$this->db->select('*')->from('tbl_slider')->where('slid',59)->get()->row();?>
                        <img src="<?php echo html_escape(base_url().(!empty($tik_mark->image)?$tik_mark->image:'assets/img/Home-page/save_line_all.png'));?>"
                            alt="Card image" class="img-fluid">
                    </div>
                    <?php $best=$this->db->select('*')->from('tbl_widget')->where('widgetid',8)->get()->row();?>
                    <h4 class="feature-box-title fs-21 font-weight-600"><?php echo html_escape($best->widget_title);?>
                    </h4>
                    <p class="mb-0"><?php echo html_escape($best->widget_desc);?></p>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 mb-4 mb-sm-0">
                <div class="feature-box text-center">
                    <?php $wifi=$this->db->select('*')->from('tbl_slider')->where('slid',60)->get()->row();?>
                    <div class="feature-box-icon mb-3">
                    <img src="<?php echo html_escape(base_url().(!empty($wifi->image)?$wifi->image:'assets/img/Home-page/save_line_all.png'));?>"
                            alt="Card image" class="img-fluid">
                    </div>
                    <?php $wifi=$this->db->select('*')->from('tbl_widget')->where('widgetid',9)->get()->row();?>
                    <h4 class="feature-box-title fs-21 font-weight-600"><?php echo html_escape($wifi->widget_title);?>
                    </h4>
                    <p class="mb-0"><?php echo html_escape($wifi->widget_desc);?></p>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="feature-box text-center">
                    <?php $nights=$this->db->select('*')->from('tbl_slider')->where('slid',61)->get()->row();?>
                    <div class="feature-box-icon mb-3">
                    <img src="<?php echo html_escape(base_url().(!empty($nights->image)?$nights->image:'assets/img/Home-page/save_line_all.png'));?>"
                            alt="Card image" class="img-fluid">
                    </div>
                    <?php $enjoy=$this->db->select('*')->from('tbl_widget')->where('widgetid',10)->get()->row();?>
                    <h4 class="feature-box-title fs-21 font-weight-600"><?php echo html_escape($enjoy->widget_title);?>
                    </h4>
                    <p class="mb-0"><?php echo html_escape($enjoy->widget_desc);?></p>
                </div>
            </div>
        </div>
    </div>
</div>
 -->

<!-- /.End of feature -->
<div class="section section-about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-6 col-12">
                <?php foreach($banner_homemiddle as $homemiddle){ ?>
                <div class="position-relative">
                <img src="<?php echo base_url().html_escape(!empty($homemiddle->image)?$homemiddle->image:'assets/img/Home-page/below_slider.png');?>"
                        class="rounded img-fluid mx-auto d-block" alt="">
                    <div class="play-icon">
                        <a href="<?php echo html_escape($homemiddle->slink);?>" class="play-btn video-play-icon">
                            <i class="mdi mdi-play text-primary rounded-circle bg-white shadow"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
            <!--end col-->
<style>.btn-primary {
    color: black; /* Change the text color to black */
}
</style>
            <div class="col-lg-7 col-md-6 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <div class="ml-lg-5 ml-md-4">
                    <div class="section-title">
                        <?php $hmd=$this->db->select('*')->from('tbl_widget')->where('widgetid',3)->get()->row();?>
                        <span class="badge badge-pill badge-soft-primary"><?php echo display('about') ?></span>
                        <h4 class="title mt-3 mb-4"><span class="text-primary" style="color: #FFAC1C;"><?php echo html_escape($hmd->widget_title);?></span></h4>

                        <p class="text-muted para-desc mx-auto mb-0">
                            <?php echo html_escape($hmd->widget_desc);?></p>
                        <div class="mt-4">
                            <a href="#" class="btn btn-primary"><?php echo display('learn_more') ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->

        </div>
    </div>
</div>



<!-- <div class="section container rounded join-content box-shadow mb-5 shadow">
    <div class="text-center col-middle">
        <?php $joinus=$this->db->select('*')->from('tbl_widget')->where('widgetid',6)->get()->row();?>
        <h2 class="fs-32 text-white mb-4 "><?php echo html_escape($joinus->widget_desc);?></h2>
        <a href="<?php echo base_url();?>user/login"
            class="btn btn-outline-white mr-3"><?php echo display('sign_in')?></a>
        <a href="<?php echo base_url();?>register" class="btn btn-white"><?php echo display('join_us')?></a>
    </div>
</div> -->
<!-- /.End of join box -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slider Example</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <style>
        .slider {
            position: relative;
        }
        .slider .card-img {
            height: 200px; /* Adjust the height as needed */
            overflow: hidden;
        }
        .slider .card-img img {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
        .slick-prev, .slick-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1;
            background-color: rgba(0, 0, 0, 0.5); /* Background color of arrows */
            border: none;
            color: #fff; /* Color of arrows */
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .slick-prev:hover, .slick-next:hover {
            background-color: rgba(0, 0, 0, 0.8); /* Hover background color of arrows */
        }
        .slick-prev {
            left: 10px;
        }
        .slick-next {
            right: 10px;
        }
    </style>
</head>
<body>

<div class="slider">
    <?php
        foreach($banner_topweek as $topweek){
    ?>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card border-0 box-shadow rounded-0 mb-4">
            <a href="<?php echo html_escape($topweek->slink);?>" class="card-img position-relative">
                <img src="<?php echo html_escape(base_url().(!empty($topweek->image)?$topweek->image:'assets/img/Home-page/below_slider_second.png'));?>" class="img-fluid wd_xs_100" alt="...">
                <button type="button" class="position-absolute btn btn-primary btn-sm"><?php echo display('book_now') ?></button>
            </a>
            <div class="card-body">
                <h5 class="card-title mb-0 weeklyoffer-title"><a href="<?php echo html_escape($topweek->slink);?>" class="text-dark"><?php echo html_escape($topweek->title);?></a></h5>
            </div>
        </div>
        <!-- /.End of card -->
    </div>
    <?php
        }
    ?>
    <button type="button" class="slick-prev">&#10094;</button>
    <button type="button" class="slick-next">&#10095;</button>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
    $(document).ready(function(){
        $('.slider').slick({
            slidesToShow: 4, // Adjust the number of slides to show
            slidesToScroll: 1,
            autoplay: true, // Enable autoplay
            autoplaySpeed: 2000, // Adjust autoplay speed in milliseconds
            prevArrow: false,
            nextArrow: false,
            responsive: [
                {
                    breakpoint: 992, // Adjust the breakpoint as needed
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 576, // Adjust the breakpoint as needed
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    });
</script>

</body>
</html>


<?php $destination=$this->db->select('*')->from('tbl_widget')->where('widgetid',5)->get()->row();?>
<div class="section section-destination">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="section-title text-center mb-5 col-middle">
                    <h2 class="block-title fs-25 mb-2 font-weight-bold">
                        <?php echo html_escape($destination->widget_title);?></h2>
                    <div class="sub-title fs-18">
                        <?php echo html_escape($destination->widget_desc);?>
                    </div>
                </div>
                <!-- /.End of section title -->
            </div>
        </div>
        <div class="destinations-carousel owl-carousel owl-theme">
            <?php foreach($banner_destination as $destination){ ?>
            <div class="card card-poster text-white flex-row align-items-end border-0">
                <a href="<?php echo html_escape($destination->slink);?>"
                    class="tile-link position-absolute w-100 h-100 top-0 left-0"></a>
                    <img src="<?php echo html_escape(base_url().(!empty($destination->image)?$destination->image:'assets/img/Home-page/explore_destinations.png'));?>"
                    alt="Card image" class="bg-image">
                <div class="card-body overlay-content position-relative">
                    <div class="mb-3">
                        <button type="button"
                            class="btn btn-primary btn-sm book-btn"><?php echo display('book_now') ?></button>
                    </div>
                    <span
                        class="item-tag text-uppercase bg-white font-weight-500 mb-2 d-inline-block"><?php echo html_escape($destination->subtitle);?></span>
                    <h5 class="card-title font-weight-bold text-white"><?php echo html_escape($destination->title);?>
                    </h5>
                </div>
            </div>
            <?php } ?>
        </div>

    </div>
</div>
<!-- /.End of destination -->


<style>
    .card-title {
        color: #333;
        font-size: 20px;
        /* font-weight: bold; */
        margin-bottom: 15px;
    }
    .card {
            height: 100%;
        }

        .card-body {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

    .card-description {
        color: #666;
        font-size: 16px;
        font-family: 'Poppins', sans-serif;
    }

    .feature-box-icon img {
        max-width: 100px;
        margin: 0 auto;
    }

    .feature-box {
        padding: 20px;
    }
</style>

<div class="section section-feature bg-gray position-relative">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-3 mb-4 mb-md-0">
                <div class="card">
                    <div class="card-body feature-box text-center">
                        <?php $pig_mpney=$this->db->select('*')->from('tbl_slider')->where('slid',58)->get()->row();?>
                        <div class="feature-box-icon mb-3">
                            <img src="<?php echo html_escape(base_url().(!empty($pig_mpney->image)?$pig_mpney->image:'assets/img/Home-page/save_line_all.png'));?>"
                                alt="Card image" class="img-fluid">
                        </div>
                        <?php $saveupto=$this->db->select('*')->from('tbl_widget')->where('widgetid',7)->get()->row();?>
                        <h4 class="card-title"><?php echo html_escape($saveupto->widget_title);?></h4>
                        <p class="card-description"><?php echo html_escape($saveupto->widget_desc);?></p>
                    </div>
                </div>
            </div>
            <!-- /.End of feature -->
            <div class="col-sm-6 col-md-3 mb-4 mb-md-0">
                <div class="card">
                    <div class="card-body feature-box text-center">
                        <?php $tik_mark=$this->db->select('*')->from('tbl_slider')->where('slid',59)->get()->row();?>
                        <div class="feature-box-icon mb-3">
                            <img src="<?php echo html_escape(base_url().(!empty($tik_mark->image)?$tik_mark->image:'assets/img/Home-page/save_line_all.png'));?>"
                                alt="Card image" class="img-fluid">
                        </div>
                        <?php $best=$this->db->select('*')->from('tbl_widget')->where('widgetid',8)->get()->row();?>
                        <h4 class="card-title"><?php echo html_escape($best->widget_title);?></h4>
                        <p class="card-description"><?php echo html_escape($best->widget_desc);?></p>
                    </div>
                </div>
            </div>
            <!-- /.End of feature -->
            <div class="col-sm-6 col-md-3 mb-4 mb-sm-0">
                <div class="card">
                    <div class="card-body feature-box text-center">
                        <?php $wifi=$this->db->select('*')->from('tbl_slider')->where('slid',60)->get()->row();?>
                        <div class="feature-box-icon mb-3">
                            <img src="<?php echo html_escape(base_url().(!empty($wifi->image)?$wifi->image:'assets/img/Home-page/save_line_all.png'));?>"
                                alt="Card image" class="img-fluid">
                        </div>
                        <?php $wifi=$this->db->select('*')->from('tbl_widget')->where('widgetid',9)->get()->row();?>
                        <h4 class="card-title"><?php echo html_escape($wifi->widget_title);?></h4>
                        <p class="card-description"><?php echo html_escape($wifi->widget_desc);?></p>
                    </div>
                </div>
            </div>
            <!-- /.End of feature -->
            <div class="col-sm-6 col-md-3">
                <div class="card">
                    <div class="card-body feature-box text-center">
                        <?php $nights=$this->db->select('*')->from('tbl_slider')->where('slid',61)->get()->row();?>
                        <div class="feature-box-icon mb-3">
                            <img src="<?php echo html_escape(base_url().(!empty($nights->image)?$nights->image:'assets/img/Home-page/save_line_all.png'));?>"
                                alt="Card image" class="img-fluid">
                        </div>
                        <?php $enjoy=$this->db->select('*')->from('tbl_widget')->where('widgetid',10)->get()->row();?>
                        <h4 class="card-title"><?php echo html_escape($enjoy->widget_title);?></h4>
                        <p class="card-description"><?php echo html_escape($enjoy->widget_desc);?></p>
                    </div>
                </div>
            </div>
            <!-- /.End of feature -->
        </div>
    </div>
</div>

 
<br>


  <!-- testo start -->
  <section>
        <div class="container text-center testo-cards" >
            <div>
                <h2>"Our Customers Feedbacks"</h2>
            </div>
            <br>
            <div class="slider-container1">
                <div class="slider1">

                    <div class="slide1" style="background-image: url(image1.jpg);">
                        <div class="custom-card" id="newcard2">
                            <h4>"Omkar Sandhane"</h4>
                            <p>The staff was attentive, friendly, and knowledgeable about the menu.
                                Speaking of the menu, it was a delightful culinary journey. The
                                dishes were beautifully presented and bursting with flavors.</p>
                        </div>
                    </div>

                    <div class="slide1" style="background-image: url(image2.jpg);">
                        <div class="custom-card" id="newcard3">
                            <h4>"Mansi"</h4>
                            <p>Nice hotel on the Highway onroute Goa if you need to take a break.
                                Restaurant has nice food options and service is also good. Neat and
                                clean rooms much like big cities at a fair price. More Breakfast
                                options should be included. The terrace has gazebos for night
                                dining.
                        </div>
                    </div>

                    <div class="slide1" style="background-image: url(image3.jpg);">
                        <div class="custom-card" id="newcard6">
                            <h4>"Anjan Datta"</h4>
                            <p>TVery nice lobby area which is also a veg restuarant. They also have
                                non-veg restuarant on their 1st floor. The food is very nice. The
                                full kabab platter is seriously large, and it could be shared by 4
                                people with rotis etc. All-in-All a happy experience.</p>
                        </div>
                    </div>


                    <div class="slide1" style="background-image: url(image1.jpg);">
                    <div class="custom-card" id="newcard6">
                            <h4>"Dpk H"</h4>
                            <p> I visit this place everytime when i travel from pune or to pune,
                                ambience is very excellent, clean washrooms, very polite staff, and
                                ample parking space. Its really good stopover whos looking for just
                                a quick refreshments.</p>
                        </div>
                    </div>

                    <div class="slide1" style="background-image: url(image2.jpg);">
                    <div class="custom-card" id="newcard6">
                            <h4>"Niranjan Ghadge"</h4>
                            <p> Restaurant is situated on Bangalore-Pune expressway and approach is easy. Food quality
                                is great and has quite nice ambience as well. Rooftop sitting arrangement is also
                                available. Both veg and non-veg food offered on different floors of the restaurant.
                                Butter chicken is must try.</p>
                        </div>

                    </div>
                    <div class="slide1" style="background-image: url(image3.jpg);">
                    <div class="custom-card" id="newcard6">
                            <h4>"Samir Saxena"</h4>
                            <p> The rooms were comfortable and clean, staff was courteous and responsive. The veg
                                restaurant Shravan served good food. They also have a non veg restaurant and a roof top
                                restaurant</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    
    <script>
        const slides = document.querySelectorAll('.slide1');
        let currentIndex = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.style.display = 'block';
                } else {
                    slide.style.display = 'none';
                }
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        }

        function startAutoSlide() {
            setInterval(nextSlide, 7000); 
        }

        showSlide(currentIndex);
        startAutoSlide();
    </script>

    <!-- testo end -->

