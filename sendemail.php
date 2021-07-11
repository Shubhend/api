<?php

include('classes/phpmailer/mail.php');

function sendmail($email,$transactionid,$key){




    if(! $email==''){
        //send email


        $to = $email;
        $subject = "Wp-AutoFast Plugin";

        $body = "<h2>Hello, you’re awesome! welcome in journey of Fast Indexing Site Ranking  </h2> 
			<img src='https://www.pamelagrow.com/wp-content/uploads/2013/07/Welcome-300x199.jpg' style='width:100%;height:50%;'/>
		<h3>
		
		We are Very Thankful, That you Have Bought our Premium Wordpress plugin.
		<br/>
Thanks Aloooot.
<br/>

Your Transaction Id: ".$transactionid." <br/>

Your Lisense Key: ".$key." <br/>

Never, share you Lisense key.

<br/>
You are not alone, we are with you to help in ranking your site.
Please Setup, this Plugin in your Wordpress, If you got any problem while setup, Feel free to contact us.
<br/>
Email:WOPENSYS@GMAIL.COM <br/>
<a href='whatsapp://send?text=I have query about Wp-AutoIndex Plugin&phone=+919868969659'>Ping me on WhatsApp 9868969659</a>


We made full setup video for you 
<br/>
<a href='https://www.youtube.com/watch?v=OPrYhDM74LA'>Setup Video</a>
<br/>
or 
<br/>
<a href='http://firstpageranker.com/'> More Detail </a>
<br/>
Here is Your Plugin You Can Download It from this Link
<br/>

<a href='https://drive.google.com/file/d/1L02ORU-G-dl-sv4dzuIuRLB-MyZKF6fl/view?usp=sharing'>Download Premium Plugin</a>

<br/>

Regards,
<br/>


			<p>Regards Wp-Autoindex plugin Admin</p>";

        $mail = new Mail();
        $mail->setFrom('noreply@firstpageranker.com','Wp-AutoFast Index Wordpress Premium Plugin');

        $mail->addAddress($to);

        $mail->subject($subject);
        $mail->body($body);
        $mail->send();



    }


}



function sendcompanyemail($email,$transactionid,$coupon,$type){


    $to = $email;
    $subject = "Wp-AutoFast Plugin Coupon Transaction Information";

    $body = "<h2>Hello, Wp-autoindex Team   </h2> 
		
		Congratulations, That Someone Have Bought  Premium Wordpress plugin from your Coupon Code.
		<br/>
Details Given Below.
<br/>

User Transaction Id: ".$transactionid." <br/>
Coupon Used: ".$coupon." <br/>
Payment Type: ".$type." <br/>


<br/>
You are not alone, Need any Help ??

<br/>
Email:WOPENSYS@GMAIL.COM <br/>
<a href='whatsapp://send?text=I have query about Wp-AutoIndex Plugin&phone=+919868969659'> Ping me on WhatsApp 9868969659 </a>



Regards,
<br/>


			<p>Regards Wp-Autoindex plugin Admin</p>";

    $mail = new Mail();
    $mail->setFrom('noreply@firstpageranker.com','Congrats, Coupon Transaction Triggered for Wordpress Premium Plugin');

    $mail->addAddress($to);

    $mail->subject($subject);
    $mail->body($body);
    $mail->send();


}


?>