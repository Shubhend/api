<?php




if(isset($_POST['bing_ap']) ) {

    $site =$_POST['site'];
            $link=$_POST['link'];
            $bing_ap=$_POST['bing_ap'];
    $ul="https://lovetoreads.com";
    $content = '{
               
                    "siteUrl" : "' . $site . '",
                    "url" : "' . $link . '"
                }';


// c7c54aac12134f90941f983ff08e0c9b

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://ssl.bing.com/webmaster/api.svc/json/SubmitUrl?apikey=" . base64_decode($bing_ap));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
    $result = curl_exec($ch);

  echo $result;
  exit;
}

?>