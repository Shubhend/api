<?php


$date=date("Y-m-d");

include('config.php');
include('sendemail.php');



if(isset($_POST['type'])){

    if($_POST['type']=='paypal'){

        $savedata=['data'=>$_POST['data'],'userdata'=>unserialize($_POST['userdata']),'type'=>'paypal'];
       // var_dump(unserialize($_POST['userdata']));
       $userdata=unserialize($_POST['userdata']);
        $couponemail=updatecoupon($userdata['coupon']);
        $userid=adduser($userdata);

        $key=updatelicense($userid,$userdata);

        transactionstore($savedata,$userid,'paypal',$_POST['data']['id']);
        sendmail($userdata['email'],$_POST['data']['id']);

        file_put_contents('transactions/'.$date.'-logs.log', json_encode($savedata) . "\n", FILE_APPEND);

    }

    if($_POST['type']=='razorpay'){

      // var_dump($_POST['data']);exit;
        $savedata=['data'=>$_POST['data'],'userdata'=>unserialize($_POST['userdata']),'type'=>'razorpay'];

        $userdata=unserialize($_POST['userdata']);
        $couponemail=updatecoupon($userdata['coupon']);
        $userid=adduser($userdata);

        $key=updatelicense($userid,$userdata);

        transactionstore($savedata,$userid,'razorpay',$_POST['data']['razorpay_payment_id']);


        sendmail($userdata['email'],$_POST['data']['razorpay_payment_id']);


        //   $savedata=['data'=>$_POST['data'],'userdata'=>unserialize($_POST['userdata'])];
        file_put_contents('transactions/'.$date.'-logs.log', json_encode($savedata) . "\n", FILE_APPEND);




    }


}





function transactionstore($data,$userid,$type,$transactionid){

    $easydb = new easyfeature();
$email=$data['userdata']['email'];
$userdata=json_encode($data['userdata']);
    $date=date("Y-m-d h:i:sa");

$data=json_encode($data);

    $sqline="INSERT INTO  transactions VALUES(NULL,'$userid','$type','$email','$transactionid','$data','$userdata','$date') ";
    $easydb->insert($sqline);


}

function updatelicense($userid,$userdata){


    $easydb = new easyfeature();
    $sqli="SELECT * FROM license Where user='$userid' ";

    $coupon=$userdata['coupon'];
    $date=date("Y-m-d");


    $dateex=date_create(date("Y-m-d"));
    date_add($dateex,date_interval_create_from_date_string("365 days"));
    $expdate=date_format($dateex,"Y-m-d");

    $res=$easydb->checkduplicate($sqli);

    if($res>0){
        $key=$easydb->fetchrow($sqli,'secret_key');



        $sqline="UPDATE  license   SET  date='$date', expiry_date='$expdate' WHERE user='$userid' ";
        $easydb->insert($sqline);


     }
     else{

         $key=generateRandomString();

         $sqline="INSERT INTO  license VALUES(NULL,'$userid','$key','$date','$coupon','$expdate') ";
         $easydb->insert($sqline);



     }

     return $key;

    }

function generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function updatecoupon($coupon){

    if(! $coupon){
        return true;
    }
    $date=date("Y-m-d h:i:sa");

    $easydb = new easyfeature();
    $sqli="SELECT * FROM company Where coupon='$coupon'";
    $r=$easydb->checkduplicate($sqli);
    if($r>0){

        $count=$easydb->fetchrow($sqli,'count');

        $email=$easydb->fetchrow($sqli,'email');

        $count=$count+1;
        $sqline="UPDATE  company   SET   count='$count',update_at='$date' WHERE coupon='$coupon' ";
        $easydb->insert($sqline);


    }

    return $email;

}

function adduser($userdata){

    $easydb = new easyfeature();
    $email=$userdata['email'];
    $site=$userdata['site'];
    $ver=$userdata['version'];
    $date=date("Y-m-d h:i:sa");


    try{




        $sqli="SELECT * FROM autoindex Where email='$email'";
        $r=$easydb->checkduplicate($sqli);
        if($r>0){
            $userid=$easydb->fetchrow($sqli,'id');
            $count=$easydb->fetchrow($sqli,'count');
            $count=$count+1;
            $sqline="UPDATE  autoindex   SET paid='1' , version='$ver', count='$count',site='$site',updated_date='$date' WHERE email='$email' ";
            $easydb->insert($sqline);


        }else{

            $sqline="INSERT INTO  autoindex VALUES(NULL,'$email','1','$date','$site','1','$ver',0,'$date') ";
            $easydb->insert($sqline);

            $userid=$easydb->fetchrow($sqli,'id');


        }




        //user records
        $sqli="SELECT * FROM autoindexusers Where email='$userid'";
        $r=$easydb->checkduplicate($sqli);
        if($r>0){
            $count=$easydb->fetchrow($sqli,'count');
            $count=$count+1;
            $sqline="UPDATE  autoindexusers   SET  count='$count',site='$site' WHERE email='$userid' ";
            $easydb->insert($sqline);


        }else{


            $sqline="INSERT INTO  autoindexusers VALUES(NULL,'$userid','$date','1','$site') ";
            $easydb->insert($sqline);
        }



    }catch(\Exception $e){
        // var_dump($e->getMessage());

        $fp = fopen('log.log', 'a');//opens file in append mode
        fwrite($fp, json_encode($e->getMessage()));
        fclose($fp);

return 0;

    }

return $userid;


}

?>