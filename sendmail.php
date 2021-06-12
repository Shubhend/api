<?php

include('../loginpagecss/classes/user.php');
include('../loginpagecss/classes/phpmailer/mail.php');


include('config.php');

$file = 'data/data.json';
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$paymentid=$_POST['paymentid'];

$data=["email"=>$email,"mobile"=>$mobile,"payment"=>$paymentid];

file_put_contents($file, json_encode($data)."\n\n", FILE_APPEND);

if(! $email==''){
    //send email


    try{
        $date=date("Y-m-d h:i:sa");
        $date=date_create(date("Y-m-d h:i:sa"));
        date_add($date,date_interval_create_from_date_string("365 days"));
        $expiry= date_format($date,"Y-m-d h:i:sa");
        $key=time().rand(100,999);

        $easydb = new easyfeature();
        $sqli="SELECT * FROM autoindex Where email='$email'";
        $r=$easydb->checkduplicate($sqli);
        if($r>0){



            $userid=$easydb->fetchrow($sqli,'id');
            $count=$easydb->fetchrow($sqli,'count');
            $count=$count+1;
            $sqline="UPDATE  license   SET  date='$date', secret_key='$key' expiry_date ='$expiry' WHERE email='$userid' ";
            $easydb->insert($sqline);


        }else{

            $sqline="INSERT INTO  license VALUES(NULL,'$email','$key','$date','$expiry') ";
            $easydb->insert($sqline);

            $userid=$easydb->fetchrow($sqli,'id');


        }




    }catch(\Exception $e){
        var_dump($e->getMessage());

        $fp = fopen('log.log', 'a');//opens file in append mode
        fwrite($fp, json_encode($e->getMessage()));
        fclose($fp);



        exit;
    }



        $url='https://theonlinevoting.com';
    $to = $email;
    $subject = "Wp-AutoFast Plugin";

    $body = "<h2>Hello, you’re awesome! welcome in journey of Fast Indexing Site Ranking  </h2>
			<img src='https://www.pamelagrow.com/wp-content/uploads/2013/07/Welcome-300x199.jpg' style='width:100%;height:50%;'/>
		<h3>
		
		We are Very Thankful, That you Have Bought our Premium Wordpress plugin.
		<br/>
Thanks Aloooot.
<br/>
You are not alone, we are with you to help in ranking your site.
Please Setup, this Plugin in your Wordpress, If you got any problem while setup, Feel free to contact us.
<br/>
Email:WOPENSYS@GMAIL.COM <br/>
WhatsApp no. 9868969659  <br/>


We made full setup video for you 
<br/>
<a href='https://www.youtube.com/watch?v=OPrYhDM74LA'>Setup Video</a>
<br/>
or 
<br/>
<a href='https://theonlinevoting.com/wpautoindex.php'> More Detail </a>
<br/>
Here is Your Plugin You Can Download It from this Link
<br/>

<a href='https://drive.google.com/file/d/1L02ORU-G-dl-sv4dzuIuRLB-MyZKF6fl/view?usp=sharing'>Download Premium Plugin</a>

<br/>
or
<br/>
	<a href='https://we.tl/t-r6c2spcSaw' >Download Server2</a>	
		</h3>
<br/>
Regards,
<br/>
theonlinevoting.com<br/>

			<p>Regards Site Admin</p>";

    $mail = new Mail();
    $mail->setFrom('noreply@theonlinevoting.com','Wp-AutoFast Index Wordpress Premium Plugin');

    $mail->addAddress($to);
    $mail->subject($subject);
    $mail->body($body);
    $mail->send();



}




?>