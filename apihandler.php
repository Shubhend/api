<?php
include('config.php');


$bingurl='http://firstpageranker.com/bing.php';

$googleurl='http://firstpageranker.com/google.php';

function validateuser($email,$site){


    $easydb = new easyfeature();


    $sqlivd="SELECT * FROM autoindex Where email='$email' ";
    $userid=$easydb->fetchrow($sqlivd,'id');

    $block=$easydb->fetchrow($sqlivd,'block');


    
    if($block==1){

        echo json_encode(['msg'=>"You are Blocked , Please Contact Us",'notification'=>'You Are Blocked , Please Contact Us']);
        exit;


    }



    $sqli="SELECT * FROM autoindexusers Where email='$userid' && site='$site'";
    $r=$easydb->checkduplicate($sqli);
    if($r>0) {
        $sqlius="SELECT * FROM autoindex Where email='$email' && site='$site'";
        $paid = $easydb->fetchrow($sqlius, 'paid');

        $count = $easydb->fetchrow($sqli, 'count');
$free=0;
        if($paid==0 && $count >50){

            echo json_encode(['msg'=>"Free quota has finished, Update Your Licence Key",'notification'=>'Free quota has Finished Please Update licence key']);
            exit;


        }
        $userid = $easydb->fetchrow($sqli, 'id');

        $sqlil="SELECT * FROM license Where user='$userid' ";
        $res=$easydb->checkduplicate($sqlil);

        if($res>0){
            $date=date("Y-m-d h:i:sa");

            $expirydate=$easydb->fetchrow($sqlil,'expiry_date');

            if(strtotime($expirydate) < strtotime($date) ){

                echo json_encode(['msg'=>"License Key Expired or not updated","notification"=>'Licence Key Expired ']);
                exit;

            }

        }


      return  $userid;


    }else{

        echo json_encode(['msg'=>"User Not Valid","notification"=>"User Not Valid"]);
        exit;



    }




}

function updaterequestcount($userid){
    $easydb = new easyfeature();
    $date=date("Y-m-d h:i:sa");
    $sqli="SELECT * FROM autoindexusers Where id='$userid'";
    $r=$easydb->checkduplicate($sqli);
    if($r>0){
        $count=$easydb->fetchrow($sqli,'count');
        $count=$count+1;
        $sqline="UPDATE  autoindexusers   SET  count='$count' WHERE id='$userid' ";
        $easydb->insert($sqline);


    }

    $sqli="SELECT * FROM autoindex Where id='$userid'";
    $r=$easydb->checkduplicate($sqli);
    if($r>0){
        $count=$easydb->fetchrow($sqli,'count');
        $count=$count+1;
        $sqline="UPDATE  autoindex   SET   count='$count',  updated_date='$date' WHERE id='$userid' ";
        $easydb->insert($sqline);


    }




}


function updatesite($url,$userid,$status,$code,$type){
    $easydb = new easyfeature();
    $date=date("Y-m-d h:i:sa");
    $sqli="SELECT * FROM requesturl Where url='$url' and  type='$type' ";
    $r=$easydb->checkduplicate($sqli);
    if($r>0) {

        $sqline="UPDATE  requesturl   SET  status='$status',code='$code' WHERE  url='$url' and  type='$type'  ";
        $easydb->insert($sqline);



    }
    else{
        $sqline="INSERT INTO  requesturl VALUES(NULL,'$userid','$url', '$status','$code','$type','$date') ";
        $easydb->insert($sqline);


    }

    if (!file_exists('requestlogs/'.$userid)) {
        mkdir('requestlogs/'.$userid, 0777, true);
    }


    $data=[];

    $data['url']=$url;
    $data['status']=$status;
    $data['type']=$type;


    $date=date("Y-m-d");
    file_put_contents('requestlogs/'.$userid.'/'.$date.'-logs.log', json_encode($data) . "\n", FILE_APPEND);





}


if(isset($_POST['type']) ){

    if($_POST['type']=='bing'){

        $uid=validateuser($_POST['email'],$_POST['site']);

        $postRequest = [
            "site" =>$_POST['site'],
            "link"=>$_POST['link'],
            "bing_ap"=>$_POST['bing_ap']
        ];


        $cURLConnection = curl_init($bingurl);
        curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

        $apiResponse = curl_exec($cURLConnection);
        curl_close($cURLConnection);


        $result=json_decode($apiResponse);

        if(@$result->ErrorCode==3){
            $data=[];
           $code=$result->ErrorCode;
            $status="pending";
            $msg='Check Api Key';

        }else {


            $code=200;
            $status="done";
            $msg='Done , Check Bing webmaster tool';

        }





        updatesite($_POST['link'],$uid,$status,$code,'bing');
        updaterequestcount($uid);

       echo json_encode(['type'=>'bing','status'=>$status,'msg'=>$msg,'notification'=>'']);
       exit;





    }

    if($_POST['type']=='google'){




        $uid=validateuser($_POST['email'],$_POST['site']);


            $site =$_POST['link'];

            $google_file=$_POST['google_file'];

        $postRequest = [
            "site" =>$_POST['link'],
            "google_file"=>$_POST['google_file']
        ];

        $cURLConnection = curl_init($googleurl);
        curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

        $apiResponse = curl_exec($cURLConnection);
        curl_close($cURLConnection);


        $result=json_decode($apiResponse);



     //  var_dump($result->status);

        if($result->status==200){
            $data=[];
            $code=200;
            $status="done";
            $msg='Done, Url request sent to Google';

        }else {


            $code=$result->status;
            $status="pending";
            $msg=$result->err;

        }



        updatesite($site,$uid,$status,$code,'google');
        updaterequestcount($uid);

        echo json_encode(['type'=>'google','status'=>$status,'msg'=>$msg,'code'=>$code,'notification'=>'']);
        exit;







    }


}

?>