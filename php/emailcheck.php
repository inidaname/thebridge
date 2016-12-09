<?php
require_once 'class/config.php';

if ($_POST['email']) {

  $data = array();

  $registeration['email'] = htmlentities(trim($_POST['email']), ENT_QUOTES);
  if (filter_var($registeration['email'], FILTER_VALIDATE_EMAIL)) {
    $stmt = $DB_con->prepare("SELECT * FROM membership WHERE email='".$registeration['email']."'");
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    $count =$stmt->rowCount();

    if($count!=0) {
        $data['success'] = false;
        $data['message'] = "<em style='color: red; font-weight:bold;'>Email Taken Already</em>";
    } else {
      $data['success'] = true;
      $data['message'] = "Useable";
  }
  echo json_encode($data);
}

}
?>
