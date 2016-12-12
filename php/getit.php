<?php
require_once 'class/config.php';



    $userauth['user_auth'] = htmlentities(trim($_POST['user_auth']), ENT_QUOTES);
      $stmt = $DB_con->prepare("SELECT * FROM user_auth WHERE user_auth='".$userauth['user_auth']."'");
      $stmt->execute();
      $row=$stmt->fetch(PDO::FETCH_ASSOC);
      $count =$stmt->rowCount();

      if ($count != 0) {
        $gstmt = $DB_con->prepare("SELECT * FROM membership WHERE phone='".$row['data']."'");
        $gstmt->execute();
        $grow=$gstmt->fetch(PDO::FETCH_ASSOC);

        $data['success'] = true;
        $data['userdatas'] = $grow;
      } else {
        $data['success'] = false;
      }

    echo json_encode($data);

?>
