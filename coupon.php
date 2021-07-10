<?php


include('config.php');


$price=300;
$dollerprice=5;

if(isset($_POST['coupon'])){


$coupon=$_POST['coupon'];

    $easydb = new easyfeature();
    $sqli="SELECT * FROM company Where coupon='$coupon'";
    $r=$easydb->checkduplicate($sqli);
    if($r>0){

        $discount=$easydb->fetchrow($sqli,'discount');

        $discountsub=$price*$discount/100;

        $dollerdiscount=$dollerprice*$discount/100;
$price=$price-$discountsub;
$dollerprice=$dollerprice-$dollerdiscount;

echo json_encode(['err'=>0,'price'=>$price,'dollorprice'=>$dollerprice]);
exit;





    }else{
        echo json_encode(['err'=>1,'msg'=>"Not a Valid Copuon"]);
        exit;

    }




}

echo "unAuthorized";
exit;

?>