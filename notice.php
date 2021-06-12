<?php



include('config.php');

try{
    $easydb = new easyfeature();
    //user records
    $sqli="SELECT * FROM notice ";

        $datas=$easydb->fetch($sqli);
        $data=[];

    foreach($datas as $row) {
       // var_dump($row);
            array_push($data,['date'=>$row['date'],'info'=>$row['info']]);

        }




}catch(\Exception $e){
    var_dump($e->getMessage());

    exit;
}

echo json_encode($data);
exit;



?>