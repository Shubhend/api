<?php



include('config.php');

try{
    if(isset($_POST['logs'])){

        $easydb = new easyfeature();
        $email=$_POST['email'];
        $sqli="SELECT * FROM autoindexusers Where email='$email'";
        $r=$easydb->checkduplicate($sqli);
        if($r>0) {

            $id = $easydb->fetchrow($sqli, 'id');

        }

        //user records
        $sqli="SELECT * FROM requesturl WHERE user='$id' ";

        $datas=$easydb->fetch($sqli);
        $data=[];

        foreach($datas as $row) {
            // var_dump($row);
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