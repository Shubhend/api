
<?php

require_once('vendor/autoload.php');


$price=300;
$dollerprice=5;

$key="rzp_test_vpmW3l6DDfElfQ";

$api =new Razorpay\Api\Api($key,'BbYaWYyGPc33YElRa2rpoify');


//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//


if(isset($_POST['price'])){


$price=$_POST['price'];
$name=$_POST['fullname'];
$site=$_POST['site'];
$email=$_POST['email'];
$contact=$_POST['contact'];
$dollerprice=$_POST['dollorprice'];

$userdata=serialize($_POST);

    $orderData = [
        'amount'          => $price * 100, // 2000 rupees in paise
        'currency'        => 'INR',
        'payment_capture' => 1 // auto capture
    ];

    $razorpayOrder = $api->order->create($orderData);

    $razorpayOrderId = $razorpayOrder['id'];

    $_SESSION['razorpay_order_id'] = $razorpayOrderId;



}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="Description" content="One of the most and best Stunning Remarkable Plugin For INDEX your site in google and Bing">
    <title>Wordpress AutoFast Index Plugin</title>
    <!-- Favicon Icon -->

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
    <!--
      <script src="https://www.paypal.com/sdk/js?client-id=AbFiu-cDLQv1gGZIv_HBJVGbd_w3AB-s3uCSgYtv5ITkydjuUNkCUeP-NNtkPvuQWELHZyiuP5qaGQFP"></script>

    -->

    <script src="https://www.paypal.com/sdk/js?client-id=sb"></script>



</head>




<body>





<div class="container">
    <div class="py-5 text-center">

        <h2>Wp Autoindex License Upgrade  </h2>
        <p class="lead"> Make you wordpress more Intelligent with wp-Autoindex Plugin</p>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill">1</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Wp-Autoindex Plugin</h6>
                        <small class="text-muted">Make your wordpress more intelligent with Autofast Indexing Plugin</small>
                    </div>
                    <span class="text-muted" id="rsprice">Rs<?php echo $price; ?></span>
                </li>



                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD),(INR)</span>
                    <strong id="combprice">$<?php echo $dollerprice; ?>, Rs<?php echo $price; ?></strong>
                </li>
            </ul>


                <div class="input-group" id="promo">
                    <input type="text" id="couponvalue" class="form-control" placeholder="Promo code">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary" id="coupon">Redeem</button>
                    </div>
                </div>

        </div>


        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing </h4>
            <form action="" id="form" method="post">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Full name</label>
                        <input type="text" class="form-control" name="fullname" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            Valid Full name is required.
                        </div>
                    </div>

                </div>


                <div class="mb-3">
                    <label for="email">Email <span class="text-muted">(key will be send in same email, and use same email in wp -Autofast plugin)</span></label>
                    <input type="email" class="form-control" name="email" placeholder="you@example.com">
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Full website (Same as wp-Autoindex plugin settings)</label>
                    <input type="text" class="form-control" name="site" placeholder="https://example.com" required>
                    <div class="invalid-feedback">
Valid Site url Required
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address2">Contact No. <span class="text-muted">(Optional)</span></label>
                    <input type="text" class="form-control" name="contact" placeholder="1234567890">
                </div>


                <h4 class="mb-3">Payment</h4>

                <hr class="mb-4">






                      <input type="hidden" name="price" id="mainprice" value="<?php echo $price; ?>">

                <input type="hidden" name="dollorprice" id="maindprice" value="<?php echo $dollerprice; ?>">

                <input type="hidden" name="coupon" id="couponcode" value="">

                <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>

               </form>


<?php
if(isset($_POST['price'])){

?>

        <style>
            #form{
                display:none;
            }
            #promo{
                display:none;
            }
        </style>
    <h3 class="mb-3">Payment Option</h3>
    <div class="container">
        <div class="row">
            <div class="col-sm">

                <h4 class="mb-3">$ <?PHP echo $dollerprice; ?></h4>

                <div id="paypal" ></div>
            </div>
            <hr/>
            <div class="col-sm">

                <h4 class="mb-3">Rs <?PHP echo $price; ?></h4>
                <button class="btn btn-primary btn-sm" id="rzp-button1" onclick="raz()">Other methods</button>
            </div>

        </div>
    </div>





    <script>

            paypal.Buttons({
                createOrder: function (data, actions) {
                    // This function sets up the details of the transaction, including the amount and line item details.
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: '<?php echo $dollerprice; ?>'
                            }
                        }]
                    });
                },
                onApprove: function (data, actions) {
                    // This function captures the funds from the transaction.
                    return actions.order.capture().then(function (details) {
                        // This function shows a transaction success message to your buyer.
                        console.log(details);

                        $.post("transaction.php", {data: details,type: 'paypal',userdata: '<?php echo $userdata; ?>' }, function (result) {

                            alert(" Transaction Complete, Please Check Your Email");

                        });

                     //   alert('Transaction completed by ' + details.payer.name.given_name + ". Please, Check Your email for this plugin");
                    });
                }
            }).render('#paypal');

            function raz() {

                var options = {
                    "key": "<?php echo $key; ?>", // Enter the Key ID generated from the Dashboard
                    "amount": "<?php echo $price; ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                    "currency": "INR",
                    "name": "Wp-Autoindex wordpress Plugin",
                    "description": "Wp-autoindex Wordpress Plugin",
                    "image": "5.jpg",
                    "order_id": "<?php echo $razorpayOrderId; ?>", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                    "handler": function (response) {

                        $.post("transaction.php", {data: response,type: 'razorpay',userdata: '<?php echo $userdata; ?>'}, function (result) {

                            alert(" Transaction Complete, Please Check Your Email");

                        });


                       // console.log(response);

                    },
                    "prefill": {
                        "name": "<?php echo $name; ?>",
                        "email": "<?php echo $email; ?>",
                        "contact": "<?php echo $contact; ?>"
                    },
                    "notes": {
                        "address": "Razorpay Corporate Office Wp-Autoindex Plugin"
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.on('payment.failed', function (response) {
                   alert("Try again");
                });

                    rzp1.open();
                    e.preventDefault();

            }

    </script>



<?php } ?>
        </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017-2019 Company Name</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
</div>

<script>

    $("#coupon").click(function(){


        $.post( "coupon.php", { coupon: $("#couponvalue").val() })
            .done(function( data ) {

                data =  JSON.parse(data);

                console.log(data);

                if(data.err==0){
  $("#rsprice").html('Rs'+data.price);
                    $("#combprice").html('$'+data.dollorprice+', Rs'+data.price);
$("#mainprice").val(data.price);
                    $("#maindprice").val(data.dollorprice);
$("#couponcode").val( $("#couponvalue").val());

                }else{

                    alert("Not a Valid Coupon, Try again!");
                }

            });


    })



</script>

<!-- Bootstrap core JavaScript -->
<script src="enroll/js/jquery.min.js"></script>
<script src="enroll/js/bootstrap.bundle.min.js"></script>
<!-- Plugin JavaScript -->
<script src="enroll/js/jquery.easing.min.js"></script>
<!-- Scrolling Nav JavaScript -->
<script src="enroll/js/scrolling-nav.js"></script>
<!-- Particles JavaScript -->
<!-- Owl Carousel javascript -->
<script src="enroll/js/owl.carousel.js"></script>
<!-- WOW JavaScript -->
<script src="enroll/js/wow.min.js"></script>
<!-- Custom JavaScript -->
<script src="enroll/js/custom.js"></script>
<!-- Facebook Pixel Code -->

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

</body>
</html>