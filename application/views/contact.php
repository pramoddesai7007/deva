<!-- <div class="map-content">
    <div id="map"></div>
</div> -->
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
        <div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3800.7516734913565!2d74.02341377429995!3d17.70918729345679!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc239d69a539c3b%3A0xa99023bfc15dbd3f!2sHotel%20Sky%20Inn!5e0!3m2!1sen!2sin!4v1698291177562!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

<section class="section border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 text-center border-right">
                <!-- <h6 class="text-uppercase mb-2 font-weight-bold fs-13"><?php echo display('message_us') ?></h6> -->
                <h6 class="text-uppercase mb-2 font-weight-bold fs-13">Follow Us On</h6>

                <!-- /.End of heading -->
                <div class="mb-5 mb-md-0 new-contact-icon ">
                    <!-- <a href="#!" class="h4"><?php echo display('start_chat') ?></a> -->

                  <a class=""  href="https://instagram.com/hoteleliteboutique?utm_source=qr&igshid=MzNlNGNkZWQ4Mg=="><i class="bio bi-instagram"></i></a>
                  <a href="https://www.facebook.com/profile.php?id=61552483810794&mibextid=ZbWKwL"><i class="bio bi-facebook"></i></a>
                  <a href="#"><i class="bio bi-twitter"></i></a>
                  <a href="#"><i class="bio bi-dribbble"></i></a>




                </div>
                <!-- /.End of link -->
            </div>
            <?php $hotline=$this->db->select('*')->from('tbl_slider')->where('slid',75)->get()->row();?>
            <div class="col-12 col-md-4 text-center border-right">
                <h6 class="text-uppercase mb-2 font-weight-bold fs-13"><?php echo html_escape($hotline->title);?></h6>
                <!-- /.End of heading -->
                <div class="mb-5 mb-md-0">
                    <a href="#!" class="h4">
                        <?php echo html_escape($hotline->subtitle);?>
                    </a>
                </div>
                <!-- /.End of link -->
            </div>
            <?php $contact=$this->db->select('*')->from('tbl_slider')->where('slid',74)->get()->row();?>
            <div class="col-12 col-md-4 text-center">
                <h6 class="text-uppercase mb-2 font-weight-bold fs-13"><?php echo html_escape($contact->title);?></h6>

                <!-- /.End of heading -->
                <a href="#!" class="h4">
                    <?php echo html_escape($contact->subtitle);?>
                </a>
                <!-- /.End of link -->
            </div>
        </div>
    </div>
</section>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");

    * {
      margin: 0;
      padding: 0;
      scroll-behavior: smooth;
      box-sizing: border-box;
    }

    body {
      overflow-x: hidden;
      font-family: "Poppins", sans-serif;
      font-size: 16px;
    }

    ul {
      list-style: none;
    }

    input {
      overflow: hidden;
    }

    .section-title {
      position: relative;
      font-size: 30px;
      font-weight: 600;
      font-family: "Poppins", sans-serif;
      margin: 0 0 35px;
    }

    .sec-pad {
      padding: 60px 0 0;
      margin: 50px 0;
    }

    .contact-sec {
      align-item: center;
      display: flex;
      background-color: #ffffff;
    }

    .contact-sec .contact-ul li,
    .contact-ul b {
      font-size: 20px;
      margin: 10px 0;
      font-family: Cambria, Cochin, Georgia, Times, "Times New Roman", serif;
      word-wrap: break-word;
    }

    .contact-sec .contact-ul i {
      font-size: 18px;
      padding: 10px;
      margin-right: 10px;
      border-radius: 50%;
    }

    .contact-detail a {
      color: #000;
      text-decoration: none;
    }

    .contact-sec .contact-ul li b:hover {
      color: #f93;
    }

    .contact-sec .contact-ul li .fa-location-dot {
      color: #f44337;
      border: 2px solid #f4433790;
    }

    .contact-sec .contact-ul li .fa-phone {
      color: #00b055;
      border: 2px solid #00b05590;
    }

    .contact-sec .contact-ul li .fa-envelope {
      color: #ff6347;
      border: 2px solid #ff634790;
    }

    .contact-detail span {
      width: 400px;
      display: flex;
      justify-content: center;
    }

    .contact-detail span a {
      font-size: 20px;
      padding: 6px 12px;
      color: #000;
      border-radius: 50%;
      margin: 0px 5px;
    }

    .contact-detail span .fb {
      color: #3b5998;
      border: 3px solid #3b5998;
    }

    .contact-detail span .fb:hover {
      color: #fff;
      background-color: #3b5998;
    }

    .contact-detail span .insta {
      color: #833ab4;
      border: 3px solid #833ab4;
    }

    .contact-detail span .insta:hover {
      color: #fff;
      background-color: #833ab4;
    }

    .contact-detail span .twitter {
      color: #00acee;
      border: 3px solid #00acee;
    }

    .contact-detail span .twitter:hover {
      color: #fff;
      background-color: #00acee;
    }

    form.contFrm {
      max-width: 396px;
      margin: auto;
    }

    .inptFld {
      width: 100%;
      height: 50px;
      border: 0;
      margin: 0 0 10px;
      border-radius: 8px;
      padding: 0 20px;
      font-size: 16px;
      color: #000;
    }

    .inptFld:focus {
      outline-offset: -4px;
      outline: 1px solid #f93;
    }

    .contFrm textarea {
      height: 75px;
      padding-top: 5px;
    }

    .inptBtn {
  height: 50px;
  border: 0;
  background: #5cbde4; /* Changed background color */
  font-size: 14px;
  color: #fff;
  margin: auto;
  letter-spacing: 1px;
  cursor: pointer;
  width: 100%;
  max-width: 200px;
}
    /* Responsive CSS Start */

    @media (max-width: 991px) {
      .sec-pad {
        padding: 20px 0 0px;
      }

      .contact-sec .contact-ul li,
      .contact-ul b {
        font-size: 18px;
      }

      .contact-sec .contact-ul i {
        font-size: 14px;
        padding: 6px;
        margin-right: 6px;
      }

      .inptFld {
        height: 40px;
        margin: 0 0 10px;
        padding: 0 14px;
        font-size: 14px;
      }
    }

    @media (max-width: 767px) {
      .contact-detail span {
        width: auto;
      }

      .contact-detail span a {
        font-size: 18px;
        padding: 5px 10px;
        color: #000;
        border-radius: 50%;
        margin: 0px 5px 20px;
      }
    }

    @media (max-width: 575px) {
      .section-title {
        font-size: 26px;
        font-weight: 500;
      }

      .contact-sec {
        border-radius: 10% 10% 0% 0% / 5% 5% 0% 0%;
      }

      .contact-sec .contact-ul i {
        border: none;
      }

      .inptFld {
        height: 36px;
        margin: 0 0 8px;
        padding: 0 14px;
        font-size: 14px;
      }
    }

    @media (max-width: 480px) {
      .contact-sec .contact-ul li,
      .contact-ul b {
        font-size: 16px;
      }
    }
  </style>
</head>

<body>
  <section class="contact-sec sec-pad">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="contact-detail">
            <h1 class="section-title">Contact us</h1>

            <ul class="contact-ul">
              <li><i class="fa fa-map-marker-alt"></i> 91, Ram Nagar, Ram Mandir, Delhi</li>

              <li>
                <i class="fa fa-phone"></i>
                <a href="tel:08510004495"><b>0255000XXXX</b></a>,
                <a href="tel:08510005495"><b>0251600XXXX</b></a>
              </li>

              <li>
                <i class="fa fa-envelope"></i>
                <a href="mailto:pardeepkumar4bjp@gmail.com"><b> demounknown@gmail.com</b></a>
              </li>
            </ul>

            <span>
              <a href="#" class="fb"><i class="fab fa-facebook"></i></a>
              <a href="#" class="insta"><i class="fab fa-instagram"></i></a>
              <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
            </span>
          </div>
        </div>

        <div class="col-md-6">
          <form action="#" class="contFrm" method="POST">
            <div class="row">
              <div class="col-sm-6">
                <input type="text" name="name" placeholder="Your Name" class="inptFld" required />
              </div>

              <div class="col-sm-6">
                <input type="email" name="email" placeholder="Email Address" class="inptFld" required />
              </div>

              <div class="col-sm-6">
                <input type="tel" name="phone" placeholder="Phone Number" class="inptFld" required />
              </div>

              <div class="col-sm-6">
                <input type="text" name="sub" placeholder="Subject" class="inptFld" required />
              </div>

              <div class="col-12">
                <textarea class="inptFld" rows="" cols="" placeholder="Your Message..." required></textarea>
              </div>

              <div class="col-12">
                <input type="submit" name="submit" value="SUBMIT" class="inptBtn" />
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</body>

</html>

    <br>
    
   


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
