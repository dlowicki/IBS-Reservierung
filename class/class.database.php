<?php
/**
 * Connect Database
 */
class Database
{
  private $sn = "localhost";
  private $un = "shop";
  private $pw = "123456";
  private $db = "ibs";


  public function getConnection(){
    $conn = new mysqli($this->sn, $this->un, $this->pw, $this->db); // Create connection
    if ($conn->connect_error) {   // Check connection
        die("Connection failed: " . $conn->connect_error);
        return false;
    }
    return $conn;
  }

  public function getRaumWithID($id)
  {
    $query = $this->getConnection()->query("SELECT * FROM rsRaum WHERE raumID = '$id'");
    if($query)
    {
      $temp = array();
      foreach ($query as $key) {
        $temp['raumID'] = $key['raumID'];
        $temp['raumName'] = $key['raumName'];
        $temp['raumDatum'] = $key['raumDatum'];
        $temp['raumAktiv'] = $key['raumAktiv'];
      }
      return $temp;
    }
    return false;
  }

  public function getTableWithID($id)
  {
    $query = $this->getConnection()->query("SELECT * FROM rsTische WHERE tischeID='$id'");
    if($query)
    {
      $temp = array();
      foreach ($query as $key) {
        $temp['raumID'] = $key['raumID'];
        $temp['tischeTyp'] = $key['tischeTyp'];
        $temp['tischeWidth'] = $key['tischeWidth'];
        $temp['tischeHeight'] = $key['tischeHeight'];
        $temp['tischeX'] = $key['tischeX'];
        $temp['tischeY'] = $key['tischeY'];
        $temp['tischeFilter'] = $key['tischeFilter'];
        $temp['tischeAktiv'] = $key['tischeAktiv'];
      }
      return $temp;
    }
    return false;
  }

}

?>
