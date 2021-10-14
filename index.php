<?php
require_once('class/class.database.php');
require_once('class/class.sidebar.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>IBS | Reservierung</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/component.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1> IBS </h1>
                <div class="header-user">
                    <h3> dlowicki </h3>
                </div>
            </div>

            <div class="main">
                <div class="sidebar">
                    <ul>
                        <?php
                            $sidebar = new Sidebar();
                            $db = new Database();
                            $list = $sidebar->loadSidebar();

                            foreach ($list as $key) {
                                echo '<li id="raum-'.$key["raumID"].'">'.$key["raumName"].'<i class="fas fa-chevron-right"></i></li>';
                            }
                        ?>
                    </ul>
                </div>
                <div class="filter-container">
                    <!-- Datum, Uhrzeit, Dockingstation?, Blockzeiten? -->
                    <div class="filter-filter">
                        <div class="filter-header">
                            <h2>Filter</h2>
                            <i class="fas fa-minus" id="dropdown-filter"></i>
                        </div>
                        <div class="filter-dropdown-filter">
                            <div class="filter-filter-date">
                                <input type="date" id="dateFilterFrom" value="<?php echo date('Y-m-d'); ?>"> - <input type="date" id="dateFilterTo">
                            </div>
                            <div class="filter-filter-time">
                                <input type="time" id="timeFilterFrom" value="06:00" min="06:00" max="15:00" pattern="[0-9]{2}:[0-9]{2}">
                                -
                                <input type="time" id="timeFilterTo" value="15:00" min="06:00" max="15:00" pattern="[0-9]{2}:[0-9]{2}">
                            </div>
                            <button id="bt-filter">Bestätigen</button>
                        </div>
                    </div>
                    <hr>
                    <div class="filter-reservieren">
                        <div class="filter-header">
                            <h2>Reservieren</h2>
                            <i class="fas fa-minus" id="dropdown-reservieren"></i>
                        </div>
                        <div class="filter-dropdown-reservieren">
                            <div class="filter-reservieren-date">
                                <input type="date" id="dateFilterFrom" value="<?php echo date('Y-m-d'); ?>"> - <input type="date" id="dateFilterTo">
                            </div>
                            <div class="filter-reservieren-time">
                                <input type="time" id="timeFilterFrom" value="06:00" min="06:00" max="15:00" pattern="[0-9]{2}:[0-9]{2}">
                                -
                                <input type="time" id="timeFilterTo" value="15:00" min="06:00" max="15:00" pattern="[0-9]{2}:[0-9]{2}">
                            </div>
                            <div class="filter-reservieren-data">
                                <input type="text" placeholder="Tisch" disabled>
                                <input type="text" placeholder="Benutzer" disabled>
                            </div>
                            <button>Reservieren</button>
                        </div>
                    </div>
                    <hr>
                    <div class="filter-liste">
                        <div class="filter-header">
                            <h2>Reservierungen</h2>
                            <i class="fas fa-minus" id="dropdown-liste"></i>
                        </div>

                    </div>
                </div>

                    <?php
                    if(isset($_GET['raum']))
                    {
                        echo '<div class="tischplan">';

                        echo '<div id="tischplan-svg">';
                        echo '<div class="tischplan-svg-header">';
                            $raumID = (int) $_GET['raum'];
                            $raumDaten = $db->getRaumWithID($raumID);
                            echo '<h2>'.$raumDaten["raumName"].'</h2>';
                            echo '<div class="tischplan-svg-header-switch">';
                                echo '<h3>Laptop</h3>';
                                echo '<label class="switch"><input type="checkbox"><span class="slider round"></span></label>';
                                echo '<h3>Stand-PC</h3>';
                            echo '</div>';
                        echo '</div>';
                    }
                    ?>
                    <?php
                        if(isset($_GET['raum']))
                        {
                            echo '<svg width="1000" height="700" xmlns="http://www.w3.org/2000/svg" id="tischplan-svg" style="margin-left:auto;margin-right:auto;display:block;border:1px solid black;">';
                            $raumID = (int) $_GET['raum'];
                            $query = $db->getConnection()->query("SELECT * FROM rsTische WHERE raumID='$raumID'");
                            if($query)
                            {
                                foreach ($query as $key) {
                                    if($key['tischeTyp'] == 'horizontal'){
                                        $x = (int) $key['tischeX'];
                                        $y = (int) $key['tischeY'];
                                        echo "<rect xmlns='http://www.w3.org/2000/svg' class='table' id='".$key['tischeID']."' data-type='".$key['tischeFilter']."' height='".$key['tischeHeight']."' width='".$key['tischeWidth']."' y='".$key['tischeY']."' x='".$key['tischeX']."' stroke='#000' fill='white'/>";
                                        echo "<text y='".($y+25)."' x='".($x+60)."' dominant-baseline='middle' text-anchor='middle'>".$key['tischeName']."</text>";
                                    } elseif($key['tischeTyp'] == 'vertikal'){
                                        $x2 = (int) $key['tischeX'];
                                        $y2 = (int) $key['tischeY'];
                                        echo "<rect xmlns='http://www.w3.org/2000/svg' class='table' id='".$key['tischeID']."' data-type='".$key['tischeFilter']."' height='".$key['tischeHeight']."' width='".$key['tischeWidth']."' y='".$key['tischeY']."' x='".$key['tischeX']."' stroke='#000' fill='white'/>";
                                        echo "<text y='".($y2+75)."' x='".($x2+20)."' style='writing-mode: vertical-rl;text-orientation: upright;' dominant-baseline='middle'  text-anchor='middle'>".$key['tischeName']."</text>";
                                    } elseif($key['tischeTyp'] == 'door') {
                                        echo "<rect xmlns='http://www.w3.org/2000/svg' height='".$key['tischeHeight']."' width='".$key['tischeWidth']."' y='".$key['tischeY']."' x='".$key['tischeX']."' stroke='#000' fill='white'/>";
                                        echo "<text y='".((int) $key['tischeY']+17)."' x='".((int) $key['tischeX']+50)."' dominant-baseline='middle' text-anchor='middle'>".$key['tischeName']."</text>";
                                    }
                                }
                            }
                            echo '</svg></div></div>';
                        }
                    ?>
            </div>
        </div>

        <?php
            /*$ldap = ldap_connect("dcibs1.ibs-ka.local");
            if ($bind = ldap_bind($ldap, 'ndingeldein', 'WasdWasd12Wasd/')) {
              echo "logged in";
            } else {
              echo "Fehler!";
            }*/
        ?>
        <script>
            $(document).on('click','.sidebar ul li', function(event){
                var id = event.target.id.split('-')[1];
                window.location.href = '?raum='+id;
            });
            $(document).on('click','#bt-filter',function(){
                var dateFrom = $('.filter-filter-date #dateFilterFrom').val(); var dateTo = $('.filter-filter-date #dateFilterTo').val();
                var timeFrom = $('.filter-filter-time #timeFilterFrom').val(); var timeTo = $('.filter-filter-time #timeFilterTo').val();
                var raumID = "<?php if(isset($_GET['raum'])){echo $_GET['raum']; } ?>";
                var filterType="";
                // Überprüfte Eingabe von Datum
                if(new Date(dateFrom) < new Date(getToday()) || new Date(dateTo) < new Date(getToday()) || new Date(dateFrom) > new Date(dateTo)){
                    alert('Datum kann nicht in der Vergangenheit liegen!'); return;
                }

                var dtTO = new Date(dateFrom + "," + timeTo); var dtFROM = new Date(dateFrom + "," + timeFrom);
                if((dtTO.getHours() > 15 || dtTO.getHours() < 6) || (dtFROM.getHours() > 15 || dtFROM.getHours() < 6)){alert('Zeit zwischen 06:00 Uhr und 15:00 Uhr auswählen!'); return;}
                if(dtFROM.getHours() > dtTO.getHours() || dtFROM.getHours() == dtTO.getHours()) { alert('Zeit '+timeFrom+' Uhr darf nicht größer/gleich '+timeTo+' Uhr sein!'); return; }
                // Get Radio Filter Type
                if($('#type-pc:checked').length > 0){filterType="pc";} else if($('#type-laptop:checked').length > 0){filterType="laptop";}

                // Daten laden mit TischID
                $.ajax({ url: "sync.php", method: "POST", data: { filterRaum: raumID, dtf: dateFrom, dtt: dateTo, ttf: timeFrom, ttt: timeTo, type: filterType},
                    success: function(result) {
                        data = JSON.parse(result);
                        data.forEach((item,i) => {
                            $('#'+item["tischeID"]).attr("fill","red");
                        });
                    }
                });



            });

            function getToday(){
                var today = new Date();
                return today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
            }

        </script>
    </body>
</html>