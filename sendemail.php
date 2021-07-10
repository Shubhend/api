<?php


include('classes/phpmailer/mail.php');

function sendmail($email,$transactionid){




if(! $email==''){
    //send email



    $url='https://theonlinevoting.com';
    $to = $email;
    $subject = "Wp-AutoFast Plugin";

    $body = "<h2>Hello, you’re awesome! welcome in journey of Fast Indexing Site Ranking  </h2> ".$transactionid."
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
   var_dump( $mail->send());



}


}

?>