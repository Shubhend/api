<?php



include('config.php');
if(isset($_POST['Lisense'])){
    $easydb = new easyfeature();
    $msg['valid']=0;
    $msg['msg']="Wrong license key";

    $email=$_POST['email'];
    $site=$_POST['url'];
    $lisensekey=$_POST['lisense_key'];
    $date=date("Y-m-d h:i:sa");


    $sqli="SELECT * FROM autoindexusers Where email='$email' && site='$site'";
    $r=$easydb->checkduplicate($sqli);
    if($r>0){

        $userid=$easydb->fetchrow($sqli,'id');

        $sqli="SELECT * FROM license Where user='$userid' ";
        $res=$easydb->checkduplicate($sqli);

        if($res>0){
            $key=$easydb->fetchrow($sqli,'secret_key');
            $createdate=$easydb->fetchrow($sqli,'date');
            $expirydate=$easydb->fetchrow($sqli,'expiry_date');






            if($key==$lisensekey){

                if(strtotime($expirydate) < strtotime($date)){

                    $msg['valid']=0;
                    $msg['msg']="Key Expired";

                }else{

                    $msg['valid']=1;
                    $msg['lisense_key']=$lisensekey;
                    $msg['created_date']=$createdate;
                    $msg['expiry_date']=$expirydate;
                    $msg['msg']=" verification Complete";

                }





            }


        }

    }else{
        $msg['valid']=0;
        $msg['msg']="Wrong license key";

    }




    echo json_encode($msg);
    exit;
    
    
    
    
}



?>