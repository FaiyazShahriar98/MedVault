<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>MediVault - Medical Website </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/tooplate-style.css">
</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

    <!-- PRE LOADER -->
    <section class="preloader">
        <div class="spinner">
            <span class="spinner-rotate"></span>
        </div>
    </section>

    <!-- MENU -->
    <section class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                </button>
                <a href="index.php" class="navbar-brand"><i class="fa fa-heartbeat"></i> MediVault</a>

            </div>

            <!-- MENU LINKS -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="doctors.php">Doctors</a></li>
                    <li><a href="news-detail.html">News</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tools <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="bmi.php">BMI Calculator</a></li>
                            <li><a href="tracker.php">Blood Pressure & Sugar Tracker</a></li>
                        </ul>
                    </li>

                    <?php if (isset($_SESSION['username'])): ?>
                        <li><a href="profile.php" class="welcome-btn">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></a></li>
<li><a href="php/logout.php" class="logout-btn">Logout</a></li>

                    <?php else: ?>
                        <li><a href="signup.html" class="register-btn">Register</a></li>
                        <li><a href="Login.html" class="register-btn">Log in</a></li>
                    <?php endif; ?>

                    <li class="appointment-btn"><a href="appointment.php" class="btn btn-primary">Make an Appointment</a></li>
                    <li><a href="donation.html" class="btn btn-danger navbar-btn donate-btn">Donate</a></li>

                </ul>    
            </div>
        </div>
    </section>

   

    <section id="home" class="slider" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                         <div class="owl-carousel owl-theme">
                              <div class="item item-first">
                                   <div class="caption">
                                        <div class="col-md-offset-1 col-md-10">
                                             <h3>Let's make your life happier</h3>
                                             <h1>Healthy Living</h1>
                                             <a href="#team" class="section-btn btn btn-default smoothScroll">Meet Our Doctors</a>
                                        </div>
                                   </div>
                              </div>

                              <div class="item item-second">
                                   <div class="caption">
                                        <div class="col-md-offset-1 col-md-10">
                                             <h3>Lead the Best life</h3>
                                             <h1>New Lifestyle</h1>
                                             <a href="#about" class="section-btn btn btn-default btn-gray smoothScroll">More About Us</a>
                                        </div>
                                   </div>
                              </div>

                              <div class="item item-third">
                                   <div class="caption">
                                        <div class="col-md-offset-1 col-md-10">
                                             <h3>Live the Healthiest Life</h3>
                                             <h1>Your Health Benefits</h1>
                                             <a href="#news" class="section-btn btn btn-default btn-blue smoothScroll">Read Stories</a>
                                        </div>
                                   </div>
                              </div>
                         </div>

               </div>
          </div>
     </section>


  <!-- ABOUT -->
<section id="about">
     <div class="container">
          <div class="row align-items-center">
               <!-- Left Content -->
               <div class="col-md-6 col-sm-6">
                    <div class="about-info">
                         <h2 class="wow fadeInUp" data-wow-delay="0.6s">Welcome to Your Medical Vault</h2>
                         <div class="wow fadeInUp" data-wow-delay="0.8s">
                              <p>MediVault is a secure and user-friendly web platform designed to streamline the management of medical appointments, records, and health data. </p>
                              <p>It ensures privacy, efficiency, and accessibility, empowering users to seamlessly connect with healthcare providers and maintain their medical information in one place.</p>
                         </div>
                         <figure class="profile wow fadeInUp" data-wow-delay="1s">
                              <img src="images/author-image.jpg" class="img-responsive" alt="">
                              <figcaption>
                                   <h3>Dr. Neil Jackson</h3>
                                   <p>General Principal</p>
                              </figcaption>
                         </figure>
                    </div>
               </div>

               <!-- Right Circular Image -->
               <div class="col-md-6 col-sm-6">
                    <div class="about-image wow fadeInUp" data-wow-delay="0.8s">
                         <img src="images/about-bg.jpg" alt="Health Center" class="rounded-image img-responsive">
                    </div>
               </div>
          </div>
     </div>
</section>



     <!-- TEAM -->
     <section id="team" data-stellar-background-ratio="1">
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-6">
                         <div class="about-info">
                              <h2 class="wow fadeInUp" data-wow-delay="0.1s">Our Doctors</h2>
                         </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-md-4 col-sm-6">
                         <div class="team-thumb wow fadeInUp" data-wow-delay="0.2s">
                              <img src="images/team-image1.jpg" class="img-responsive" alt="">

                                   <div class="team-info">
                                        <h3>Nate Baston</h3>
                                        <p>General Principal</p>
                                        <div class="team-contact-info">
                                             <p><i class="fa fa-phone"></i> 010-020-0120</p>
                                             <p><i class="fa fa-envelope-o"></i> <a href="#">general@medivault.com</a></p>
                                        </div>
                                        <ul class="social-icon">
                                             <li><a href="#" class="fa fa-linkedin-square"></a></li>
                                             <li><a href="#" class="fa fa-envelope-o"></a></li>
                                        </ul>
                                   </div>

                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <div class="team-thumb wow fadeInUp" data-wow-delay="0.4s">
                              <img src="images/team-image2.jpg" class="img-responsive" alt="">

                                   <div class="team-info">
                                        <h3>Jason Stewart</h3>
                                        <p>Pregnancy</p>
                                        <div class="team-contact-info">
                                             <p><i class="fa fa-phone"></i> 010-070-0170</p>
                                             <p><i class="fa fa-envelope-o"></i> <a href="#">pregnancy@medivault.com</a></p>
                                        </div>
                                        <ul class="social-icon">
                                             <li><a href="#" class="fa fa-facebook-square"></a></li>
                                             <li><a href="#" class="fa fa-envelope-o"></a></li>
                                             <li><a href="#" class="fa fa-flickr"></a></li>
                                        </ul>
                                   </div>

                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <div class="team-thumb wow fadeInUp" data-wow-delay="0.6s">
                              <img src="images/team-image3.jpg" class="img-responsive" alt="">

                                   <div class="team-info">
                                        <h3>Miasha Nakahara</h3>
                                        <p>Cardiology</p>
                                        <div class="team-contact-info">
                                             <p><i class="fa fa-phone"></i> 010-040-0140</p>
                                             <p><i class="fa fa-envelope-o"></i> <a href="#">cardio@medivault.com</a></p>
                                        </div>
                                        <ul class="social-icon">
                                             <li><a href="#" class="fa fa-twitter"></a></li>
                                             <li><a href="#" class="fa fa-envelope-o"></a></li>
                                        </ul>
                                   </div>

                         </div>
                    </div>
                    
               </div>
          </div>
     </section>


     <!-- NEWS -->
     <section id="news" data-stellar-background-ratio="2.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <!-- SECTION TITLE -->
                         <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                              <h2>Latest News</h2>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <!-- NEWS THUMB -->
                         <div class="news-thumb wow fadeInUp" data-wow-delay="0.4s">
                              <a href="news-detail.html">
                                   <img src="images/news-image1.jpg" class="img-responsive" alt="">
                              </a>
                              <div class="news-info">
                                   <span>March 08, 2018</span>
                                   <h3><a href="news-detail.html">About Amazing Technology</a></h3>
                                   <p>Discover cutting-edge advancements in medical technology, reshaping the future of healthcare. Explore how these innovations improve diagnostics and treatments.</p>
                                   <div class="author">
                                        <img src="images/author-image.jpg" class="img-responsive" alt="">
                                        <div class="author-info">
                                             <h5>Jeremie Carlson</h5>
                                             <p>CEO / Founder</p>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <!-- NEWS THUMB -->
                         <div class="news-thumb wow fadeInUp" data-wow-delay="0.6s">
                              <a href="news-detail.html">
                                   <img src="images/news-image2.jpg" class="img-responsive" alt="">
                              </a>
                              <div class="news-info">
                                   <span>February 20, 2018</span>
                                   <h3><a href="news-detail.html">Introducing a new healing process</a></h3>
                                   <p>Learn about a groundbreaking healing process designed to accelerate recovery. This approach combines modern medicine with holistic techniques for optimal results.</p>
                                   <div class="author">
                                        <img src="images/author-image.jpg" class="img-responsive" alt="">
                                        <div class="author-info">
                                             <h5>Jason Stewart</h5>
                                             <p>General Director</p>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <!-- NEWS THUMB -->
                         <div class="news-thumb wow fadeInUp" data-wow-delay="0.8s">
                              <a href="news-detail.html">
                                   <img src="images/news-image3.jpg" class="img-responsive" alt="">
                              </a>
                              <div class="news-info">
                                   <span>January 27, 2018</span>
                                   <h3><a href="news-detail.html">MediVault Launches AI-Powered Health Assistant</a></h3>
                                   <p>MediVault is thrilled to announce the launch of its groundbreaking AI-Powered Health Assistant, designed to revolutionize how patients and healthcare providers interact. </p>
                                   <div class="author">
                                        <img src="images/author-image.jpg" class="img-responsive" alt="">
                                        <div class="author-info">
                                             <h5>Andrio Abero</h5>
                                             <p>Online Advertising</p>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

               </div>
          </div>
     </section>


    


   

    <!-- FOOTER -->
<footer data-stellar-background-ratio="5">
    <div class="container">
        <div class="row">

            <!-- Contact Info -->
            <div class="col-md-4 col-sm-4">
                <div class="footer-thumb"> 
                    <h4 class="wow fadeInUp" data-wow-delay="0.4s">Contact Info</h4>
                    <p>Your health is our priority. MediVault ensures secure and reliable healthcare services for you.</p>
                    <div class="contact-info">
                        <p><i class="fa fa-map-marker"></i> Bashundhara R/A, Dhaka, Bangladesh</p>
                        <p><i class="fa fa-phone"></i> +880 174-197-9133</p>
                        <p><i class="fa fa-envelope-o"></i> <a href="mailto:info@medivault.com">info@medivault.com</a></p>
                    </div>
                </div>
            </div>

            <!-- Latest News -->
            <div class="col-md-4 col-sm-4"> 
                <div class="footer-thumb"> 
                    <h4 class="wow fadeInUp" data-wow-delay="0.4s">Latest News</h4>
                    <div class="latest-stories">
                        <div class="stories-image">
                            <a href="#"><img src="images/news-placeholder.jpg" class="img-responsive" alt="Latest News"></a>
                        </div>
                        <div class="stories-info">
                            <a href="#"><h5>Advancements in Telemedicine</h5></a>
                            <span>April 10, 2024</span>
                        </div>
                    </div>

                    <div class="latest-stories">
                        <div class="stories-image">
                            <a href="#"><img src="images/news-placeholder.jpg" class="img-responsive" alt="Latest News"></a>
                        </div>
                        <div class="stories-info">
                            <a href="#"><h5>Enhanced Data Security in Healthcare</h5></a>
                            <span>March 15, 2024</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Opening Hours -->
            <div class="col-md-4 col-sm-4"> 
                <div class="footer-thumb">
                    <div class="opening-hours">
                        <h4 class="wow fadeInUp" data-wow-delay="0.4s">Opening Hours</h4>
                        <p>Monday - Friday <span>08:00 AM - 10:00 PM</span></p>
                        <p>Saturday <span>09:00 AM - 06:00 PM</span></p>
                        <p>Sunday <span>Closed</span></p>
                    </div> 

                    <ul class="social-icon">
                        <li><a href="#" class="fa fa-facebook-square"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-instagram"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom Section -->
            <div class="col-md-12 col-sm-12 border-top">
                <div class="col-md-4 col-sm-6">
                    <div class="copyright-text"> 
                        <p>Copyright &copy; 2024 MediVault
                     
                    </div>
          
             
            </div>
        </div>
    </div>
</footer>


     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.sticky.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/wow.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/custom.js"></script>



     
</body>
</html>
