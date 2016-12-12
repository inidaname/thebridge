<?php
require_once 'class/config.php';



// now try to submit the data


   $registeration = array(
     'picture' => $_POST["passport"],
     'surname' => htmlentities(trim($_POST['surname']), ENT_QUOTES),
     'othername' => htmlentities(trim($_POST['othername']), ENT_QUOTES),
     'gender' => htmlentities(trim($_POST['gender']), ENT_QUOTES),
     'marital' => htmlentities(trim($_POST['marital']), ENT_QUOTES),
     'tribe' => htmlentities(trim($_POST['tribe']), ENT_QUOTES),
     'stateOrigin' => htmlentities(trim($_POST['stateOrigin']), ENT_QUOTES),
     'dateofbirth' => htmlentities(trim($_POST['dateofbirth']), ENT_QUOTES),
     'local_govt' => htmlentities(trim($_POST['local_govt']), ENT_QUOTES),
     'phone' => htmlentities(trim($_POST['phone']), ENT_QUOTES),
     'phone2' => htmlentities(trim($_POST['phone2']), ENT_QUOTES),
     'email' => htmlentities(trim($_POST['email']), ENT_QUOTES),
     'country' => htmlentities(trim($_POST['country']), ENT_QUOTES),
     'res_address' => htmlentities(trim($_POST['res_address']), ENT_QUOTES),
     'employment' => htmlentities(trim($_POST['employment']), ENT_QUOTES),
     'employer' => htmlentities(trim($_POST['employer']), ENT_QUOTES),
     'designation' => htmlentities(trim($_POST['designation']), ENT_QUOTES),
     'yearserved' => htmlentities(trim($_POST['yearserved']), ENT_QUOTES),
     'office_address' => htmlentities(trim($_POST['office_address']), ENT_QUOTES),
     'locatthem'    => htmlentities(trim($_POST['locatthem']), ENT_QUOTES),
      'accuracy'  => htmlentities(trim($_POST['accuracy']), ENT_QUOTES),
      'UserAgent' => htmlentities(trim($_POST['UserAgent']), ENT_QUOTES)
    );




   if(empty($registeration['surname'])) {
      $error[] = "Please provide your Surname !";
   }

   if(empty($registeration['othername'])) {
      $error[] = "Please provide Other Name !";
   }

   if(!empty($registeration['email']) && !filter_var($registeration['email'], FILTER_VALIDATE_EMAIL)) {
      $error[] = 'Please enter a valid email address !';
   }

   if(empty($registeration['stateOrigin'])) {
      $error[] = "Please provide your state of origin !";
   }

   if(empty($registeration['phone'])) {
      $error[] = "Please provide your phone Number !";
   }
   $stmt = $DB_con->prepare("SELECT * FROM membership WHERE phone='".$registeration['phone']."' OR phone2='".$registeration['phone2']."' OR  phone='".$registeration['phone2']."' OR phone2='".$registeration['phone']."' OR email='".$registeration['email']."'");
   $stmt->execute();
   $row=$stmt->fetch(PDO::FETCH_ASSOC);
   $count =$stmt->rowCount();

   if($count!=0) {
     if ($registeration['phone'] == $row['phone'] || $registeration['phone'] == $row['phone2']) {
       $error[] = "sorry that phone number ". $registeration['phone'] ." already exist!";
     } elseif ($registeration['phone2'] == $row['phone2'] || $registeration['phone2'] == $row['phone']) {
       $error[] = "sorry that phone number ". $registeration['phone2'] ." already exist!";
     } elseif ($registeration['email'] == $row['email']) {
       $error[] ="Sorry that email " . $registeration['email'] . " already exist in our database.";
     }
   }
   if (!empty($error)) {
     $data['success'] = false;
     $data['error'] = $error;
   } else if(empty($error)) {
     try {
       $user->register($registeration);
     } catch(PDOException $e) {

       echo $e->getMessage();

     }
     $data['success'] = true;
     $data['message'] = 'Thank You, You have been Successfully registered!';
     $data['user']  = md5($registeration['phone'] . microtime());
     $authdata['data'] = $registeration['phone'];
     $authdata['user_auth'] = $data['user'];
     $user->confirm($authdata);
  }

echo json_encode($data);
?>
