<?php



include('config.php');

try{
    if(isset($_POST['logs'])){

        $easydb = new easyfeature();
        $email=$_POST['email'];


        $sqlivd="SELECT * FROM autoindex Where email='$email' ";
        $userid=$easydb->fetchrow($sqlivd,'id');


        $sqli="SELECT * FROM autoindexusers Where email='$userid'";
        $r=$easydb->checkduplicate($sqli);
        if($r>0) {

            $id = $easydb->fetchrow($sqli, 'id');

        }

        //user records


        $sqli="SELECT * FROM requesturl WHERE `user`='$userid' ";

        $datas=$easydb->fetch($sqli);
        $data=[];

        foreach($datas as $row) {

            array_push($data,$row);

        }


    }






}catch(\Exception $e){
    var_dump($e->getMessage());

    exit;
}

echo json_encode($data);
exit;



?>