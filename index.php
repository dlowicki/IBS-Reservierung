<!DOCTYPE html>
<html>
    <head>
        <title>IBS | Reservierung</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
        <script src="js/jquery.min.js"></script>
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
                        <li>20% Prozent <i class="fas fa-chevron-right"></i></li>
                        <li>Pneumatik <i class="fas fa-chevron-right"></i></li>
                        <li>QS <i class="fas fa-chevron-right"></i></li>
                        <li>Glaskasten <i class="fas fa-chevron-right"></i></li>
                    </ul>
                </div>
                <div class="filter-container">
                    <!-- Datum, Uhrzeit, Dockingstation?, Blockzeiten? -->
                    <div class="filter-filter">
                        <h2>Filter</h2>
                        <div class="filter-filter-date">
                            <input type="date" id="dateFilterFrom"> - <input type="date" id="dateFilterTo">
                        </div>
                        <div class="filter-filter-time">
                            <input type="time" id="timeFilterFrom" min="06:00" max="15:00" pattern="[0-9]{2}:[0-9]{2}">
                            -
                            <input type="time" id="timeFilterFrom" min="06:00" max="15:00" pattern="[0-9]{2}:[0-9]{2}">
                        </div>
                    </div>
                    <hr>
                    <div class="filter-reservieren">
                        <h2>Reservieren</h2>
                    </div>
                </div>
                <div class="tischplan">
                    <div id="tischplan-svg">

                    </div>
                </div>
            </div>
        </div>

        <?php
            /*$ldap = ldap_connect("ldap.dcibs1.de");
            if ($bind = ldap_bind($ldap, 'ndingeldein', 'WasdWasd12Wasd/')) {
              echo "logged in";
            } else {
              echo "Fehler!";
            }*/
        ?>
        <script>
            $(document).ready({
                (async() => { await loadTables('04.10.2021','08:00','12:00'); })();
            });
              

            async function loadTables(date, timeFrom, timeTO) {
                let result;
                try {
                    var data = "";
                    $.ajax({ url: "json/load.tables.php", method: "GET", data: { d: date, tf: timeForm, tt: timeTo }, success: function(result) {
                        console.log(result);
                        $('#tischplan-svg').empty();
                        data = JSON.parse(result);
                        data.forEach((item, i) => {
                        if(item['tableActive'] == 'open'){ item['tableActive'] = 'rgba(60, 179, 113,0.5)'; } else { item['tableActive'] = 'rgba(255, 0, 0,0.5)'; }
                        var xml = jQuery.parseXML('<rect xmlns="http://www.w3.org/2000/svg" class="table" id="tisch-'+item["tableID"]+'" height="'+item["height"]+'" width="'+item["width"]+'" y="'+item["y"]+'" x="'+item["x"]+'" stroke="#000" fill="'+item["tableActive"]+'"/>');
                        $('#tischplan-svg').append(xml.documentElement);
                        });
                    } });
                    return true;
                } catch (e) {
                    console.log("Error loadTables: " + e);
                }
            }

        </script>
    </body>
</html>