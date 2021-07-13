<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>Wp-Autoindex Offer</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Bootstrap core CSS -->
    <link href="enroll/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="enroll/font/css/fontawesome-all.css" rel="stylesheet">
    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="enroll/css/owl.carousel.min.css">
    <link rel="stylesheet" href="enroll/css/owl.theme.default.min.css">
    <!-- Animate CSS  -->
    <link href="enroll/css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="enroll/css/osahan.css" rel="stylesheet">
    <!-- Facebook Pixel Code -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<style>
    /* Some housekeeping to make the demo look nicer */
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        transition: all 0.25s cubic-bezier(.37,0,.45,.99);

    &:before,
    &:after {
         box-sizing: inherit;
     }

    }

    img {
        max-width: 100%;
        height: auto;
    }

    // Defualt Styling
       body {
           font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Fira Sans", "Helvetica Neue", sans-serif;
           line-height: 1.75;
       }

    .l-page-wrap {
        max-width: 1200px;
        padding: 0 2em;
        margin: 0 auto;
    }

    .l-page-wrap {
        max-width: 960px;
    }

    .nav-bar {
        padding: 1em 0;
        width: 100%;
        position: fixed;
        top: 0;
        z-index: 0001;
        transition: all 0.125s ease-in;
    }

    .nav-bar--is-solid {
        background-color: #fff;
    }

    .nav-bar__logo {
        width: 200px;
        height: 60px;
        background-color: #ddd;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .button {
        background-color: #06145D;
        color: #F0F3FF;
        border: 0;
        font-size: 1em;
        padding: 0.5em 1.66em;
        border-radius: 3em;
    }

    input {
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1em;
        padding: 0.25em 0.5em;
        margin: 1em 0 0;
    }

    /******** Demo Code Starts ********/

    @media (min-width: 800px) {

        .gated-hero {
            /* Vertically fill window */
            min-height: 100vh;
        }


        .gated-hero {
            /* Set up the grid */
            display: flex;
        }

        .gated-hero__item {
            /* Fill remaining space */
            flex: 1;
            /* Size evenly */
            flex-basis: 50%;
        }

    }

    .gated-hero__banner {
        /* Banner is made in 2 parts
         * The fill and the content
         * Content is BG image
         * Set to never clip or repeat
         */
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        /* Ensure it has a height on small screens */
        min-height: 50vh;
    }

    .hero-gate {
        /* Create some gutters */
        padding: calc(2em + 4vw);
        /* Horizontally & vertically center content */
        display: flex;
        align-items: center;
        justify-content: center;
        /* Size with max-width to allow the
         * collpase animation to work correctly
         */
        max-width: 100%;
        /* Clip contetn durring transition */
        overflow: hidden;
        /* Set up collapse transition */
        transition: all 0.25s cubic-bezier(0.37, 0, 0.45, 0.99);
    }

    .hero-gate--is-collapsed {
        /* Kill the gutters */
        padding: 0;
        /* Fade out */
        opacity: 0;
        overflow: hidden;
    }

    @media (max-width: 800px) {

        .hero-gate--is-collapsed {
            /* reduce it nothing */
            max-height: 0;
        }

    }

    @media (min-width: 800px) {

        .hero-gate--is-collapsed {
            /* Reduce it nothing */
            max-width: 0;
        }

    }

    .hero-gate__aligner {
        /* Set a max size */
        max-width: 30em;
    }

    .hero-gate__title {
        /* Basic styling */
        color: #06145D;
        line-height: 1.12;
    }

    .hero-gate__form {
        /* Add some breathing room */
        margin: 1em 0;
    }

    .gated-content {
        /* Basic styling */
        background-color: #fff;
        padding: 2em;
        /* Set up the transition */
        transition: all 0.25s cubic-bezier(0.37, 0, 0.45, 0.99) 0.25s;
        /* Overlap the hero */
        position: relative;
        top: -5em;
        /* Reset locked state */
        visibility: visible;
        height: auto;
    }

    .gated-content--is-locked {
        /* Make it hidden */
        height: 0;
        padding: 0;
        visibility: hidden;
        overflow: hidden;
        /* Push down so the slide in animation is longer */
        top: 5em;
    }
</style>

<body>

<?php

include('sendemail.php');

if(isset($_POST['name'])){
    $list = array($_POST['name'], $_POST['email'] ,$_POST['contact']);


    

    $file_open = fopen("newsletters/offer.csv", "a");
    $no_rows = count(file("newsletters/offer.csv"));
    if($no_rows > 1)
    {
        $no_rows = ($no_rows - 1) + 1;
    }
    $form_data = array(
        'sr_no'  => $no_rows,
        'name'  => $_POST['name'],
        'email'  => $_POST['email'],
        'subject' => $_POST['contact']
        
    );
    fputcsv($file_open, $form_data);

    offermail($_POST['email'],'HURRY50',$_POST['name']);

    echo "<script>alert('Coupon Code has been sent in you email, Please check ');document.location='index.php'</script>";

}


?>

<nav class="nav-bar js-nav-bar">
    <div class="l-page-wrap">
        <div class="nav-bar__logo">Wp AutoIndex Plugin</div>
    </div>
</nav>
<header class="gated-hero">
    <div class="gated-hero__item gated-hero__banner"
         style="background-color: #FFD643;
							background-image: url(4.jpeg)
							"></div>
    <div class="gated-hero__item gated-hero__gate hero-gate js-gate">
        <div class="hero-gate__aligner">
            <h1 class="hero-gate__title">
                Get An Intelligent Recommendation 50% offer in WP-Autoindex Premium Plugin
            </h1>
            <form action="" method="post">
                <div class="hero-gate__form">
                    <input type="email" name="email" placeholder="Email Address" required>
                    <input type="text" name="name" placeholder="Full Name" required>
                    <input type="text" name="contact" placeholder="Contact (Optional)">
                </div>
                <button class="js-submit button" type="submit">
                   Get Coupon Code
                </button>

            </form>

        </div>
    </div>

</header>
<section class="l-page-wrap l-page-wrap--narrow gated-content gated-content--is-locked js-gated-content" aria-hidden>
  
</section>
</div>

<script>
    // Real world, this should be attached to the successful submission of the form
    $('.js-submit').on('click', function() {
        var gate = $('.js-gate');
        var content = $('.js-gated-content');
        var gateHiddenClass = 'hero-gate--is-collapsed';
        var contentHiddenClass = 'gated-content--is-locked';
        gate.addClass(gateHiddenClass);
        content.removeClass(contentHiddenClass);
        content.attr('aria-hidden', false);
        content.find('h2').first().focus();
    });


    // Just here to make the demo look prettier
    $(window).on('scroll', function() {

        var visibleClass = 'nav-bar--is-solid';

        if ($(window).scrollTop() >= 20) {
            $('.js-nav-bar').addClass(visibleClass);
        } else {
            $('.js-nav-bar').removeClass(visibleClass);
        }

    });
</script>
</body>
</html>
