<?php
require_once('class.database.php');
class Sidebar extends Database
{
    public function loadSidebar() 
    {
        $query = $this->getConnection()->query('SELECT raumID,raumName FROM rsRaum WHERE raumAktiv = "1"');
        if($query)
        {
            $temp = array(); $r=0;
            foreach ($query as $key) {
                $temp[$r]['raumID'] = $key['raumID'];
                $temp[$r]['raumName'] = $key['raumName'];
                $r++;
            }
            return $temp;
        }
        return false;
    }
}

?>