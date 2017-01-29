<?php
require_once 'class/config.php';

if ($_POST['phone']) {
  $registeration['phone'] = htmlentities(trim($_POST['phone']), ENT_QUOTES);
  $stmt = $DB_con->prepare("SELECT * FROM membership WHERE phone='".$registeration['phone']."' OR phone2='".$registeration['phone']."'");
  $stmt->execute();
  $row=$stmt->fetch(PDO::FETCH_ASSOC);
  $count =$stmt->rowCount();

  if($count!=0) {
      $data['success'] = false;
      $data['message'] = "<em style='color: red; font-weight:bold;'>We already have this number</em>";
  } else {
    $data['success'] = true;
    $data['message'] = "<strong style='color: green;'>Useable</strong>";
}
echo json_encode($data);
}
?>
