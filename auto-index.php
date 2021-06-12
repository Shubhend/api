<?php



include('config.php');

if(isset($_POST['add'])){
    $easydb = new easyfeature();
    $email=$_POST['email'];
    $site=$_POST['site'];
    $ver=$_POST['version'];
    $date=date("Y-m-d h:i:sa");

   
    try{
        
        //user records 
          $sqli="SELECT * FROM autoindexusers Where email='$email'";
		$r=$easydb->checkduplicate($sqli);
        	if($r>0){
        	      $count=$easydb->fetchrow($sqli,'count');
		    $count=$count+1;
		      $sqline="UPDATE  autoindexusers   SET  count='$count',site='$site' WHERE email='$email' ";
		$easydb->insert($sqline);
        	    
		    
        	}else{
        	    
        	       $sqline="INSERT INTO  autoindexusers VALUES(NULL,'$email','$date','1','$site') ";
        	       	$easydb->insert($sqline);
        	}
        
        
        
        
        
        
        $sqli="SELECT * FROM autoindex Where email='$email'";
		$r=$easydb->checkduplicate($sqli);
		if($r>0){
		    $count=$easydb->fetchrow($sqli,'count');
		    $count=$count+1;
		      $sqline="UPDATE  autoindex   SET  version='$ver', count='$count',site='$site',updated_date='$date' WHERE email='$email' ";
		$easydb->insert($sqline);
		    
		    
		}else{
		    
		       $sqline="INSERT INTO  autoindex VALUES(NULL,'$email','1','$date','$site','1','$ver',0,'$date') ";
		$easydb->insert($sqline);
		    
		}
       
    
    
    }catch(\Exception $e){
        var_dump($e->getMessage());
  
       exit;
    }
   
    echo json_encode("done");
    exit;
   
    
}

if(isset($_POST['check'])){
    $easydb = new easyfeature();
    $email=$_POST['email'];
    $ver=$_POST['version'];
     $date=date("Y-m-d h:i:sa");
    $unverfiy=0;
    $freeservice=1;
    if($email){
          $sqli="SELECT * FROM autoindex Where email='$email'";
		$r=$easydb->checkduplicate($sqli);
		if($r>0){
		    $count=$easydb->fetchrow($sqli,'count');
		     $valid=$easydb->fetchrow($sqli,'valid');
		         $valid=$easydb->fetchrow($sqli,'valid');
		           
		     if($valid==0){
		         $unverfiy=1;
		     }
		    $count=$count+1;
		    
		    
		    
		    
		      $sqline="UPDATE  autoindex   SET count='$count', version='$ver',updated_date='$date' WHERE email='$email' ";
		$easydb->insert($sqline);
		
		  $paid=$easydb->fetchrow($sqli,'paid');
		  
		  if($paid==0){
		      
		      if($count>500){
		        $freeservice=0;  
		          
		      }
		      
		      
		  }
		  
		
		    
    }
    } 
    
    
    $data=[]; 
    if($freeservice==0){
        
         $data['s_f']=0;
    $data['s_f_t']="<a style='display:none;' href='https://lovetoreads.com'>Lovetoreads.com</a>";
    $data['s_n']=1;
    $data['s_n_t']='Please Update Your plugin <a href="">Download</a> ';
    $data['un_verified']=1;
    $data['verify_mesg']=' Your Free Limit Exceeds Please pay for increase your request  mail at wopensys@gmail.com or Whatsapp No. +919868969659 ';
    $data['error']=0; 
        
        
    }else{
          $data['s_f']=0;
    $data['s_f_t']="<a style='display:none;' href='https://lovetoreads.com'>Lovetoreads.com</a>";
    $data['s_n']=0;
    $data['s_n_t']='Please Update Your plugin <a href="">Download</a> ';
    $data['un_verified']=$unverfiy;
    $data['verify_mesg']=' You are Blocked Contact Us For your Validation wopensys@gmail.com or Whatsapp No. +919868969659 ';
    $data['error']=0;
    }
    
    
 
  
echo json_encode($data);
exit;
    
}


 echo json_encode("no permission");
    exit;
?>