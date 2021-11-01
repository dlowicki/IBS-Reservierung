<?php
require_once('class/class.database.php');

if(isset($_POST['table']))
{
    $db = new Database();
    echo json_encode($db->getTableWithID($_POST['table']));
    return;
}

if(isset($_POST['filterRaum']) && isset($_POST['dtf']) && isset($_POST['dtt'])&& isset($_POST['ttf'])&& isset($_POST['ttt'])&& isset($_POST['type']))
{
    $raumID = $_POST['filterRaum']; $dateFrom = $_POST['dtf']; $dateTo = $_POST['dtt']; $timeFrom = $_POST['ttf']; $timeTo = $_POST['ttt']; $filterType=$_POST['type'];
    $dtFROM = new DateTime($timeFrom); $dtTO = new DateTime($timeTo);
    if(($dtFROM < new DateTime('06:00') || $dtFROM > new DateTime('15:00')) || ($dtTO > new DateTime('15:00') || $dtTO < new DateTime('07:00'))){echo '72'; return;}

    $db = new Database();
    // Alle Reservierungen zwischen dateFrom und dateTo in der ausgewählten Zeit, die aktiv sind
    $query = $db->getConnection()->query("SELECT * FROM rsReservierung WHERE reservierungDatum BETWEEN '$dateFrom' AND '$dateTo' AND (reservierungVon >= '$timeFrom' OR reservierungBis <= '$timeTo') AND reservierungStatus = 1");
    if($query)
    {
        $ar = array(); $r=0;
        foreach ($query as $key) {
            $datenbankSTART = new DateTime($key['reservierungVon']); $datenbankENDE = new DateTime($key['reservierungBis']);
            // Wenn ausgewählte Start Zeit kleiner als DatenbankStart und ausgewählte End Zeit kleiner als Datenbank Start (ausgewählte Zeit unter Datenbank Zeit)
            // Wenn ausgewählte Start Zeit größer als Datenbank End Zeit und ausgewählte End Zeit größer als Datenbank End Zeit
            if(($dtFROM < $datenbankSTART && $dtTO <= $datenbankSTART) == false && ($dtFROM > $datenbankENDE && $dtTO >= $datenbankENDE) == false){
                $ar[$r]['reservierungID'] = $key['reservierungID'];
                $ar[$r]['svgID'] = $key['svgID'];
                $ar[$r]['clientID'] = $key['clientID'];
                $ar[$r]['raumID'] = $key['raumID'];
                $ar[$r]['reservierungDatum'] = $key['reservierungDatum'];
                $ar[$r]['reservierungVon'] = $key['reservierungVon'];
                $ar[$r]['reservierungBis'] = $key['reservierungBis'];
                $r++;
            }
        }
        echo json_encode($ar); return;
    }
    return false;
}

if(isset($_GET['loadOverview']))
{
    $id = $_GET['loadOverview'];
    $db = new Database();
    // Alle Reservierungen zwischen dateFrom und dateTo in der ausgewählten Zeit, die aktiv sind
    $query = $db->getConnection()->query("SELECT * FROM rsSvg WHERE svgTyp='$id' and svgAktiv='1'");
    if($query)
    {
        $temp = array(); $r=0;
        foreach ($query as $key) {
                $temp[$r]['raumID'] = $key['raumID'];
                $temp[$r]['svgName'] = $key['svgName'];
                $temp[$r]['svgTyp'] = $key['svgTyp'];
                $temp[$r]['svgWidth'] = $key['svgWidth'];
                $temp[$r]['svgHeight'] = $key['svgHeight'];
                $temp[$r]['svgX'] = $key['svgX'];
                $temp[$r]['svgY'] = $key['svgY'];
                $temp[$r]['svgFilter'] = $key['svgFilter'];
                $temp[$r]['svgAktiv'] = $key['svgAktiv'];
            $r++;
        }
        echo json_encode($temp); return;
    }
    return false;
}

?>