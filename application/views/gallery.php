

<section>
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

    <div class="section-padding gallery-section" id="gallery">
        <div class="container">
            <!-- Section Title Start -->
            <div class="text-center">
                <h2 class="title" style="
    margin-bottom: 16px;  color: black;">Our Gallery</h2>
                <!-- <p>Some Random Photos Lorem ipsum, dolor sit.</p> -->
            </div>
            <!-- Section Title End -->

            <div id="btncontainer" class="filter">
                <a class="btn btn-active" href="#all" data-filter="all">ALL</a>
                <?php foreach ($gallery_type as $gtype) { ?>
                    <a class="btn" href="#<?php echo strtolower(str_replace(' ', '_', $gtype->title)); ?>" data-filter="<?php echo strtolower(str_replace(' ', '_', $gtype->title)); ?>"><?php echo html_escape($gtype->title); ?></a>
                <?php } ?>
            </div>

            <!-- Gallery Section Start -->

            <div class="gallery sets">
                <?php foreach ($galleries as $gallery) { ?>
                    <a class="all <?php echo strtolower(str_replace(' ', '_', $gallery->title)); ?>"><img src="<?php echo html_escape(base_url() . (!empty($gallery->image) ? $gallery->image : 'assets/img/Gallery-page/1st_twin_room.png')); ?>" /></a>
                <?php } ?>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <a class="prev">&#10094;</a>
  <a class="next">&#10095;</a>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const filters = document.querySelectorAll('.filter .btn');

    filters.forEach(filter => {
      filter.addEventListener('click', function (e) {
        e.preventDefault();
        const selectedFilter = this.getAttribute('data-filter');
        const galleryItems = document.querySelectorAll('.gallery .all');

        galleryItems.forEach(item => {
          item.style.display = 'none';
          if (selectedFilter === 'all' || item.classList.contains(selectedFilter)) {
            item.style.display = 'block';
          }
        });

        // Remove active class from all filters and add it to the clicked filter
        filters.forEach(filter => filter.classList.remove('btn-active'));
        this.classList.add('btn-active');
      });
    });

    
    // Add event listener to each image
    const galleryImages = document.querySelectorAll('.gallery .all img');
    galleryImages.forEach(img => {
      img.addEventListener('click', function () {
        const modal = document.getElementById('myModal');
        const modalImg = document.getElementById("img01");
        const modalClose = document.getElementsByClassName("close")[0];
        modal.style.display = "block";
        modalImg.src = this.src;

        // Close the modal when the close button is clicked
        modalClose.onclick = function() {
          modal.style.display = "none";
        }

        // Function to change image when arrow buttons are clicked
        const prevBtn = document.getElementsByClassName("prev")[0];
        const nextBtn = document.getElementsByClassName("next")[0];
        const images = Array.from(galleryImages);
        let currentIndex = images.indexOf(this);

        // Show previous image
        prevBtn.onclick = function() {
          currentIndex = (currentIndex - 1 + images.length) % images.length;
          modalImg.src = images[currentIndex].src;
        }

        // Show next image
        nextBtn.onclick = function() {
          currentIndex = (currentIndex + 1) % images.length;
          modalImg.src = images[currentIndex].src;
        }
      });
    });
  });
</script>
    <script>
        // JavaScript for filtering images
        document.addEventListener('DOMContentLoaded', function() {
            const filters = document.querySelectorAll('.filter .btn');

            filters.forEach(filter => {
                filter.addEventListener('click', function(e) {
                    e.preventDefault();
                    const selectedFilter = this.getAttribute('data-filter');
                    const galleryItems = document.querySelectorAll('.gallery .all');

                    galleryItems.forEach(item => {
                        item.style.display = 'none';
                        if (selectedFilter === 'all' || item.classList.contains(selectedFilter)) {
                            item.style.display = 'block';
                        }
                    });

                    // Remove active class from all filters and add it to the clicked filter
                    filters.forEach(filter => filter.classList.remove('btn-active'));
                    this.classList.add('btn-active');
                });
            });
        });
    </script>



    <!-- /.End of gallery -->




    <style>
        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-weight: 500;
            color: #4c4c4c;
            outline: none;
            visibility: visible;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            cursor: pointer;
            outline: 0;
        }

        .section-padding {
            padding-top: 80px;
        }

        .gallery-section {
            position: relative;
            z-index: 1;
        }

        .title {
            font-size: 46px;
            font-weight: 700;
            font-family: "Playfair Display", serif;
            color: #f44336;
        }

        .filter {
            text-align: center;
            max-width: 1050px;
            margin: auto;
        }

        .btn {
            padding: 10px 20px;
            margin: 5px 4px 4px 0;
            display: inline-block;
            color: #003;
            border: 1px solid #000; 
            background: white;
          
            transition: all 0.4s;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 500;
        }

        .btn:hover,
        .btn-active {
            background: #eee;
            color: #000;
            -webkit-transform: translateY(3px);
            -ms-transform: translateY(3px);
            transform: translateY(3px);
        }

        .gallery {
            display: flex;
            justify-content: center;
            width: fit-content;
            max-width: 1320px;
            flex-wrap: wrap;
            margin: 25px auto;
            /* gap: 14px; */
        }

        .gallery a {
            display: flex;
        }

        .gallery img {
            width: 200px;
            height: 220px;
            object-fit: cover;
            transition: 0.3s ease-in-out;
            border-radius: 12px;
            overflow: hidden;
            margin: 10px 10px;
        }

        .gallery img:hover {
            transform: scale(1.1);
        }

        .sets .hide,
        .sets .pophide {
            width: 0%;
            opacity: 0;
        }

        .closeBtn {
            position: absolute;
            font-size: 22px;
            font-weight: 500;
            right: 25px;
            top: 25px;
            color: white;
            transition: 0.5s linear;
            padding: 8px 40px;
            border-radius: 25px;
            background: red;
            outline-offset: -6px;
            outline: 2px solid #fff;
        }

        .closeBtn:hover {
            cursor: pointer;
            background: white;
            color: black;
            outline: 2px solid #000;
        }

        .openDiv {
            width: 100%;
            height: 100vh;
            background: #000000e7;
            position: fixed;
            top: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            left: 0;
            z-index: 9999;
        }

        .imgPreview {
            width: 70%;
            object-fit: scale-down;
            max-height: 40vw;
            height: auto;
        }

        .prevButton,
        .nextButton {
            transition: 1s linear;
            padding: 10px 35px;
            font-size: 18px;
            border: none;
            color: white;
            background: #0005;
            border-radius: 10px;
            border: 1px solid white;
            margin: 10px;
        }

        .prevButton:hover,
        .nextButton:hover {
            background: #fff;
            color: black;
        }

        /* resposive CSS Code */

        @media (max-width: 1199px) {
            .section-padding {
                padding-top: 70px;
            }
        }

        @media (max-width: 991px) {
            .section-padding {
                padding-top: 50px;
            }
        }

        @media (max-width: 767px) {
            .title {
                font-size: 36px;
            }

            .gallery img {
                margin: 8px 8px;
                width: 175px;
            }

            .closeBtn {
                padding: 6px 25px;
            }

            .prevButton,
            .nextButton {
                font-size: 18px;
                padding: 8px 25px;
            }
        }

        @media (max-width: 540px) {
            .section-padding {
                padding-top: 30px;
            }

            .gallery img {
                margin: 8px 6px;
                width: 155px;
            }

            .closeBtn {
                font-size: 18px;
                border-radius: 15px;
            }

            .prevButton,
            .nextButton {
                font-size: 18px;
                padding: 6px 20px;
                border-radius: 10px;
                margin: 5px;
            }

            
            .imgPreview {
                width: 90%;
                max-height: 50vh;
                height: auto;
            }

        }

        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 9999;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9);
            /* Black w/ opacity */
        }

        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        .modal-content img {
            width: 100%;
            height: auto;
        }

        /* Add close button styles */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        .prev, .next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: auto;
    margin-top: -30px;
    padding: 16px;
    color: white;
    font-weight: bold;
    font-size: 20px;
    transition: 0.6s ease;
    border-radius: 0 3px 3px 0;
    user-select: none;
  }

  .next {
    right: 0;
    border-radius: 3px 0 0 3px;
  }

  /* On hover, add a black background color with a little bit see-through */
  .prev:hover, .next:hover {
    background-color: rgba(0, 0, 0, 0.8);
  }
    </style>

    <script>
        $(".filter a").click(function(e) {
            e.preventDefault();
            var a = $(this).attr("href");
            a = a.substr(1);
            $(".sets a").each(function() {
                if (!$(this).hasClass(a) && a != "") $(this).addClass("hide");
                else $(this).removeClass("hide");
            });



            // Add active class to the current button (highlight it)
            var btnContainer = document.getElementById("btncontainer");
            var btns = btnContainer.getElementsByClassName("btn");
            for (var i = 0; i < script btns.length; i++) {
                var current = document.getElementsByClassName("btn-active");
                current[0].className = current[0].className.replace(" btn-active", "");
                this.className += " btn-active";

            }
        });
        let imgs = document.querySelectorAll("img");
        let count;
        imgs.forEach((img, index) => {
            img.addEventListener("click", function(e) {
                if (e.target == this) {
                    count = index;
                    let openDiv = document.createElement("div");
                    let imgPreview = document.createElement("img");
                    let butonsSection = document.createElement("div");
                    butonsSection.classList.add("butonsSection");
                    let closeBtn = document.createElement("button");
                    let nextBtn = document.createElement("button");
                    let prevButton = document.createElement("button");
                    prevButton.innerText = "Previous";
                    nextBtn.innerText = "Next";

                    nextBtn.classList.add("nextButton");
                    prevButton.classList.add("prevButton");
                    nextBtn.addEventListener("click", function() {
                        if (count >= imgs.length - 1) {
                            count = 0;
                        } else {
                            count++;
                        }

                        imgPreview.src = imgs[count].src;
                    });

                    prevButton.addEventListener("click", function() {
                        if (count === 0) {
                            count = imgs.length - 1;
                        } else {
                            count--;
                        }

                        imgPreview.src = imgs[count].src;
                    });

                    closeBtn.classList.add("closeBtn");
                    closeBtn.innerText = "Close";
                    closeBtn.addEventListener("click", function() {
                        openDiv.remove();
                    });

                    imgPreview.classList.add("imgPreview");
                    imgPreview.src = this.src;

                    butonsSection.append(prevButton, nextBtn);
                    openDiv.append(imgPreview, butonsSection, closeBtn);

                    openDiv.classList.add("openDiv");

                    document.querySelector("body").append(openDiv);
                }
            });
        });
    </script>
    <br>
    <!-- <section class="">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center ">
                    <h2>CONTACT INFORMATION</h2>
                </div>
                <div class="col-lg-4 col-md-6 text-center mt-2">
                    <div class="card" style="width: rem;">
                        <img src="assets/img/location2.jpeg" class="card-img-top mx-auto d-block w-25 mt-2" alt="..."
                            style="border-radius:7px;">
                        <div class="card-body">
                            <p class="card-text">Near Shushma Petrol Pump, Pune Bangalore Highway(NH4), Wadhe Phata,
                                Satara 415002</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 text-center mt-2">
                    <div class="card" style="width: rem;">
                        <img src="assets/img/phone2.jpeg" class="card-img-top mx-auto d-block w-25 mt-2" alt="..."
                            style="border-radius:7px;">
                        <br>
                      
                        <div class="card-body">
                            <p class="card-text">+91 9075000750</p>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 col-md-6 text-center mt-2">
                    <div class="card" style="width: ;">
                        <img src="assets/img/pc1.jpeg" class="card-img-top mx-auto d-block w-25 mt-2" alt="..."
                            style="border-radius:7px;">
                        <br>
                        
                        <div class="card-body">
                            <p class="card-text">hotelelitesatara@gmail.com</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <br>
    
    <section>
        <div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3800.7516734913565!2d74.02341377429995!3d17.70918729345679!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc239d69a539c3b%3A0xa99023bfc15dbd3f!2sHotel%20Sky%20Inn!5e0!3m2!1sen!2sin!4v1698291177562!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section> -->



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