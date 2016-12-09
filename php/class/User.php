<?php
/**
 * for the user data
 */
class User
{

  private $db;

  function __construct($DB_con) {
    $this->db = $DB_con;
  }

  public function register($register)
  {
     try
     {
        $columns = '`' . implode("`,`",array_keys($register)) . '`';
        $escaped_values = array_values($register);
        $values  = "'" . implode("','", $escaped_values) . "'";
        $sql = "INSERT INTO `membership`($columns) VALUES ($values)";

         $stmt = $this->db->prepare("$sql");
         $stmt->bindparam(":surname", $register['surname']);
         $stmt->bindparam(":othername", $register['othername']);
         $stmt->bindparam(":dateofbirth", $register['dateofbirth']);
         $stmt->bindparam(":gender", $register['gender']);
         $stmt->bindparam(":marital", $register['marital']);
         $stmt->bindparam(":tribe", $register['tribe']);
         $stmt->bindparam(":stateOrigin", $register['stateOrigin']);
         $stmt->bindparam(":local_govt", $register['lga']);
         $stmt->bindparam(":phone", $register['phone']);
         $stmt->bindparam(":phone2", $register['phone2']);
         $stmt->bindparam(":email", $register['email']);
         $stmt->bindparam(":res_addresss", $register['res_address']);
         $stmt->bindparam(":country", $register['country']);
         $stmt->bindparam(":employment", $register['employment']);
         $stmt->bindparam(":employer", $register['employer']);
         $stmt->bindparam(":designation", $register['designation']);
         $stmt->bindparam(":yearserved", $register['yearserved']);
         $stmt->bindparam(":office_address", $register['office_address']);
         $stmt->execute();

         return $stmt;
     }
     catch(PDOException $e)
     {
         echo $e->getMessage();
     }
  }
   public function confirm($register)
  {
     try
     {
        $columns = '`' . implode("`,`",array_keys($register)) . '`';
        $escaped_values = array_values($register);
        $values  = "'" . implode("','", $escaped_values) . "'";
        $sql = "INSERT INTO `user_auth`($columns) VALUES ($values)";

        $stmt = $this->db->prepare("$sql");
        $stmt->bindparam(":data", $register['data']);
        $stmt->bindparam(":user_auth", $register['user_auth']);
        $stmt->execute();

         return $stmt;
     }
     catch(PDOException $e)
     {
         echo $e->getMessage();
     }
  }
}

?>
