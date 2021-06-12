<?php

try{
    require_once('vendor/autoload.php');
} catch (Exception $e){

  return true;
}



if(isset($_POST['google_file']) ) {

    $site =$_POST['site'];
    $google_file=$_POST['google_file'];
    try{


        $client = new Google_Client();

        $client->setAuthConfig(base64_decode($google_file));
        $client->addScope('https://www.googleapis.com/auth/indexing');

        // Get a Guzzle HTTP Client
        $httpClient = $client->authorize();
        $endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

        // Define contents here. The structure of the content is described in the next step.
        $content = '{
                    "url" : "'.$site.'",
                    "type" : "URL_UPDATED"
                }';

        //var_dump($content);exit;
        $response = $httpClient->post($endpoint, [ 'body' => $content ]);

        $status_code = $response->getStatusCode();

        if($status_code==200){

            echo json_encode(['response'=>$response,'msg'=>'Done','status'=>$status_code]);
            exit;




        }else{

            echo json_encode(['response'=>$response,'msg'=>'Please Check Your Json File or url','status'=>$status_code,'err'=>'Please Check Your Json File or url']);
            exit;



        }

    }
    catch (Exception $e){

        echo json_encode(['response'=>'','msg'=>'Please Check Your Json File or url','status'=>'0','err'=>$e->getMessage()]);
        exit;



    }




}

?>