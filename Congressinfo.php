<html>
<head>
    <style>
        td {
            text-align: center;
        }

        .tab {
            border: 2px solid;
            border-collapse: collapse;

        }

        .tab th, .tab td {
            border: 2px solid;
            text-align: center;
            padding: 5px 15px;

        }

        #init {
            border: 1px solid;
            width: 28%;
        }
    </style>
</head>
<body>
<?php
$database = $chamber = $keyword = $submit = "";
$state['alabama'] = "AL";
$state['alaska'] = "AK";
$state['arizona'] = "AZ";
$state['arkansas'] = "AR";
$state['california'] = "CA";
$state['colorado'] = "CO";
$state['connecticut'] = "CT";
$state['delaware'] = "DE";
$state['district of columbia'] = "DC";
$state['florida'] = "FL";
$state['georgia'] = "GA";
$state['hawaii'] = "HI";
$state['Idaho'] = "ID";
$state['Illinois'] = "IL";
$state['Indiana'] = "IN";
$state['Iowa'] = "IA";
$state['kansas'] = "KS";
$state['kentucky'] = "KY";
$state['louisiana'] = "LA";
$state['maine'] = "ME";
$state['maryland'] = "MD";
$state['massachusetts'] = "MA";
$state['michigan'] = "MI";
$state['minnesota'] = "MN";
$state['mississippi'] = "MS";
$state['missouri'] = "MO";
$state['montana'] = "MT";
$state['nebraska'] = "NE";
$state['nevada'] = "NV";
$state['new hampshire'] = "NH";
$state['new jersey'] = "NJ";
$state['new mexico'] = "NM";
$state['new york'] = "NY";
$state['north carolina'] = "NC";
$state['north dakota'] = "ND";
$state['ohio'] = "OH";
$state['oklahoma'] = "OK";
$state['oregon'] = "OR";
$state['pennsylvania'] = "PA";
$state['rhode island'] = "RI";
$state['south carolina'] = "SC";
$state['south dakota'] = "SD";
$state['tennessee'] = "TN";
$state['texas'] = "TX";
$state['utah'] = "UT";
$state['vermont'] = "VT";
$state['virginia'] = "VA";
$state['washington'] = "WA";
$state['west virginia'] = "WV";
$state['wisconsin'] = "WI";
$state['wyoming'] = "WY";
$PREFIX = 'http://congress.api.sunlightfoundation.com/';

if ($_SERVER["REQUEST_METHOD"] == "POST"):
    $database = $_POST["Database"];
    $chamber = $_POST["Chamber"];
    $keyword = $_POST["Keyword"];
    $submit = $_POST["submit"];

endif;
?>
<script type="text/javascript">
    function oc() {
        if (document.getElementById("db").value == 'legislators') {
            document.getElementById("ky").innerHTML = "State/Representative*"
        }
        if (document.getElementById("db").value == 'committees') {
            document.getElementById("ky").innerHTML = "Committee ID*"
        }
        if (document.getElementById("db").value == 'bills') {
            document.getElementById("ky").innerHTML = "Bill ID*"
        }
        if (document.getElementById("db").value == 'amendments') {
            document.getElementById("ky").innerHTML = "Amendment ID*"
        }
    }

</script>
<div align="center">
    <h2>Congrss Information Search</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="congressinfo" method="POST">
        <div id="init">
            <table border="0">
                <tr>
                    <td>Congress Database</td>
                    <td>
                        <select name="Database" id="db" onchange="oc()">
                            <option>Select your option</option>
                            <option <?php if (isset($database) && $database == "legislators") echo "selected"; ?>
                                value="legislators">Legislators
                            </option>
                            <option <?php if (isset($database) && $database == "committees") echo "selected"; ?>
                                value="committees">Committees
                            </option>
                            <option <?php if (isset($database) && $database == "bills") echo "selected"; ?>
                                value="bills">Bills
                            </option>
                            <option <?php if (isset($database) && $database == "amendments") echo "selected"; ?>
                                value="amendments">Amendments
                            </option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Chamber</td>
                    <td>
                        <input type="radio"
                               name="Chamber" <?php if (($chamber == "") || (isset($chamber) && $chamber == "senate")) echo "checked"; ?>
                               value="senate"> Senate
                        <input type="radio"
                               name="Chamber" <?php if (isset($chamber) && $chamber == "house") echo "checked"; ?>
                               value="house"> House
                    </td>
                </tr>
                <tr>
                    <td id="ky">Keywords</td>
                    <td><input type="text" name="Keyword" value="<?php echo
                        $keyword; ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Search">
                        <input type="button" value="Reset">
                    </td>
                </tr>
            </table>
            <a href="http://sunlightfoundation.com/">Powered by Sunlight Fundation</a>
        </div>

    </form>
</div>


<?php if ($database == "legislators"):
    $lkeyword = strtolower($keyword);
    $keyinstate = array_keys($state);

    if (in_array($lkeyword, $keyinstate)) {

        $lkeyword = $state[$lkeyword];

        $context = $database . '?chamber=' . $chamber . '&state=' . $lkeyword . '&apikey=4acd972a599843bd93ea4dba171a483f';
        $url = $PREFIX . $context;

        $html = file_get_contents($url);
        $res = json_decode($html);

        echo "<br>";
        $cout = count($res->results);

        echo "<table class='tab' align='center'><tr><th><strong>Name</strong></th><th><strong>State</strong></th><th><strong>Chamber</strong></th><th><strong>Detail</strong></th></tr> ";
        for ($i = 0; $i < $cout; $i++) {
            $name = $res->results[$i]->first_name . " " . $res->results[$i]->middle_name . " " . $res->results[$i]->last_name;
            $state = $res->results[$i]->state_name;
            $chamber = $res->results[$i]->chamber;
            echo "<tr><td>$name</td><td>$state</td><td>$chamber</td><td><a href=''>View Details</a></td></tr>";
        }
        echo "</table>";
    } else {
        $context = $database . '?chamber=' . $chamber . '&query=' . $keyword . '&apikey=4acd972a599843bd93ea4dba171a483f';
        $url = $PREFIX . $context;

        $html = file_get_contents($url);
        $res = json_decode($html);

        echo "<br>";
        $cout = count($res->results);

        echo "<table class='tab' align='center'><tr><th><strong>Name</strong></th><th><strong>State</strong></th><th><strong>Chamber</strong></th><th><strong>Detail</strong></th></tr> ";
        for ($i = 0; $i < $cout; $i++) {
            $name = $res->results[$i]->first_name . " " . $res->results[$i]->middle_name . " " . $res->results[$i]->last_name;
            $state = $res->results[$i]->state_name;
            $chamber = $res->results[$i]->chamber;
            echo "<tr><td>$name</td><td>$state</td><td>$chamber</td><td><a href=''>View Details</a></td></tr>";
        }
        echo "</table>";
    }

endif; ?>

<?php if ($database == "committees"):

    $context = $database . '?committee_id=' . $keyword . '&chamber=' . $chamber . '&apikey=4acd972a599843bd93ea4dba171a483f';
    $url = $PREFIX . $context;

    $html = file_get_contents($url);
    $res = json_decode($html);

    $cout = count($res->results);

    echo "<table  class='tab' align='center'><tr><th><strong>Committee ID</strong>></th><th><strong>Committee Name</strong></th><th><strong>Chamber</strong></th></tr> ";
    for ($i = 0; $i < $cout; $i++) {
        $committeeid = $res->results[$i]->committee_id;
        $committeename = $res->results[$i]->name;
        $chamber = $res->results[$i]->chamber;
        echo "<tr><td>$committeeid </td><td>$committeename</td><td>$chamber </td></tr>";
    }
    echo "</table>";


endif; ?>

<?php if ($database == "bills"):
    $context = $database . '?bill_id=' . $keyword . '&chamber=' . $chamber . '&apikey=4acd972a599843bd93ea4dba171a483f';
    $url = $PREFIX . $context;


    $html = file_get_contents($url);
    $res = json_decode($html);
    $cout = count($res->results);

    echo "<table class='tab' align='center'><tr><th><strong>Bill ID</strong></th><th><strong>Short Title</strong></th><th><strong>Chamber/strong></th><th><strong>View Detail</strong></th></tr> ";
    for ($i = 0; $i < $cout; $i++) {
        $billid = $res->results[$i]->bill_id;
        $shorttitle = $res->results[$i]->short_title;
        $chamber = $res->results[$i]->chamber;
        echo "<tr><td>$billid</td><td>$shorttitle</td><td>$chamber</td><td><a href=''>View Details</a></td></tr>";
    }
    echo "</table>";


endif; ?>

<?php if ($database == "amendments"):

    $context = $database . '?amendment_id=' . $keyword . '&chamber=' . $chamber . '&apikey=4acd972a599843bd93ea4dba171a483f';
    $url = $PREFIX . $context;

    $html = file_get_contents($url);
    $res = json_decode($html);
    $cout = count($res->results);

    echo "<table  class='tab' align='center'><tr><th>Amendment ID</th><th>Amendment Type</th><th>Chamber</th><th>Introduced on</th></tr> ";
    for ($i = 0; $i < $cout; $i++) {
        $amid = $res->results[$i]->amendment_id;
        $amtype = $res->results[$i]->amendment_type;
        $chamber = $res->results[$i]->chamber;
        $intro = $res->results[$i]->introduced_on;
        echo "<tr><td>$amid</td><td>$amtype</td><td>$chamber</td><td>$intro</td></tr>";
    }
    echo "</table>";


endif; ?>
</body>
</html>