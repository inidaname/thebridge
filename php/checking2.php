<?php
require_once 'class/config.php';

if ($_POST['phone2']) {
  $registeration['phone2'] = htmlentities(trim($_POST['phone2']), ENT_QUOTES);
  $stmt = $DB_con->prepare("SELECT * FROM membership WHERE phone='".$registeration['phone2']."' OR phone2='".$registeration['phone2']."'");
  $stmt->execute();
  $row=$stmt->fetch(PDO::FETCH_ASSOC);
  $count =$stmt->rowCount();

  if($count!=0) {
      $data['success'] = false;
      $data['message'] = "<em style='color: red; font-weight:bold;'>We already have this number</em>";
  } else {
    $data['success'] = true;
    $data['message'] = "Useable";
}
echo json_encode($data);

}
?>
