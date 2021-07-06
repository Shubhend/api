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

        $dirsite=str_replace('https://','',$site);
        $dirsite=str_replace('http://','',$dirsite);

        if (!file_exists('temp/'.$dirsite)) {
            mkdir('temp/'.$dirsite, 0777, true);
        }


        $json = file_get_contents(base64_decode($google_file));
        $path='temp/'.$dirsite.'/google.json';

        file_put_contents($path,$json);


        $client = new Google_Client();

        $client->setAuthConfig($path);
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

        $date=date("Y-m-d");


        file_put_contents('logs/'.$date.'-logs.log', json_encode($e->getMessage()) . "\n", FILE_APPEND);

        echo json_encode(['response'=>'','msg'=>'Please Check Your Json File or url','status'=>'0','err'=>$e->getMessage()]);
        exit;



    }




}

?>