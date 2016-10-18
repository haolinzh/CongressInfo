<html>
<head>
    <title>Forecast</title>
    <style>
        body {
            font-family: "Times New Roman";
        }

        td {
            text-align: center;
        }

        h3 {
            text-align: center;
        }

        .tab {
            border: 2px solid;
            border-collapse: collapse;

        }

        .tab th, .tab td {
            border: 2px solid;
            text-align: center;
            padding: 2px 25px;

        }

        .tab td:first-child {
            text-align: left;
        }

        #init {
            border: 1px solid;
            display: inline-block;
            padding: 5px;
        }

        #biotable, #billtable {
            border: 2px solid;
            padding: 25px 100px;

        }

        #biotable .left {
            text-align: left;
            padding-left: 50px;
        }

        #biotable .right {
            text-align: left;
            padding-left: 200px;
        }

        #billtable .left {
            text-align: left;
            padding-left: 50px;
        }

        #billtable .right {
            text-align: left;
            padding-left: 50px;
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

$map[''] = "keyword*";
$map['legislators'] = "State/Representative*";
$map['committees'] = "Committee ID*";
$map['bills'] = "Bill ID*";
$map['amendments'] = "Amendment ID*";

if (isset($_POST["TYPE"])):
    $database = $_POST["Database"];
    $chamber = $_POST["Chamber"];
    $keyword = $_POST["Keyword"];
    $keyword = trim($keyword);
endif;


?>
<script type="text/javascript">
    function oc() {
        if (document.getElementById("db").value == 'legislators') {
            document.getElementById("ky").innerHTML = "State/Representative*";
        }
        if (document.getElementById("db").value == 'committees') {
            document.getElementById("ky").innerHTML = "Committee ID*";
        }
        if (document.getElementById("db").value == 'bills') {
            document.getElementById("ky").innerHTML = "Bill ID*";
        }
        if (document.getElementById("db").value == 'amendments') {
            document.getElementById("ky").innerHTML = "Amendment ID*";
        }
    }

    function rst() {
        window.location.assign(window.location.href);
    }
    function formcheck() {
        if (document.getElementById("db").value == "noinput" && document.getElementById("kys").value == "") {
            alert("Please enter the following missing information: Congress database, Keyword");
            return false;
        }

        else if (document.getElementById("db").value == "noinput") {
            alert("Please enter the following missing information: Congress database");
            return false;
        }
        else if (document.getElementById("kys").value == "") {
            alert("Please enter the following missing information: Keyword");
            return false;
        }
        else {
            return true;
        }
    }

    function biodetail(biochamber, bioid, state, database, keyword) {
        var formbioid = document.getElementById("bioid");
        formbioid.value = bioid;

        var formstate = document.getElementById("biostate");
        formstate.value = state;

        var formchamber = document.getElementById("biochamber");
        formchamber.value = biochamber;

        var formdb = document.getElementById("biodatabase");
        formdb.value = database;

        var formky = document.getElementById("biokeyword");
        formky.value = keyword;

        document.getElementById('detailinfo').submit();

    }

    function billdetail(billid, shorttitle, sponser, Intron, lastactionwidate, billurl, database, chamber, keyword) {
        var formbillid = document.getElementById("billid");
        formbillid.value = billid;

        var formshorttitle = document.getElementById("shorttitle");
        formshorttitle.value = shorttitle;

        var formsponser = document.getElementById("sponser");
        formsponser.value = sponser;

        var formIntron = document.getElementById("Intron");
        formIntron.value = Intron;

        var formLAWD = document.getElementById("lastactionwidate");
        formLAWD.value = lastactionwidate;

        var formbillurl = document.getElementById("billurl");
        formbillurl.value = billurl;

        var formchamber = document.getElementById("billchamber");
        formchamber.value = chamber;

        var formdb = document.getElementById("billdatabase");
        formdb.value = database;

        var formky = document.getElementById("billkeyword");
        formky.value = keyword;

        document.getElementById('billinfo').submit();
    }


</script>
<div align="center">
    <h2>Congrss Information Search</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="congressinfo" method="POST" onsubmit="return formcheck();">
        <div id="init">
            <table border="0">
                <tr>
                    <td>Congress Database</td>
                    <td>
                        <select name="Database" id="db" onchange="oc()">
                            <option value="noinput">Select your option</option>
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
                    <td id="ky"><?php echo $map[$database] ?></td>
                    <td><input type="text" id="kys" name="Keyword" value="<?php echo
                        $keyword; ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Search">
                        <input type="button" value="Reset" onclick="rst()">
                    </td>
                </tr>
            </table>
            <a href="http://sunlightfoundation.com/" target="_blank">Powered by Sunlight Foundation</a>
        </div>
        <input style="display: none" type="text" name="TYPE" value="1">

    </form>

    <form style="display: none" action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="detailinfo" method="POST">
        <input type="text" name="bioid" id="bioid">
        <input type="text" name="biostate" id="biostate">
        <input type="text" name="Chamber" id="biochamber">
        <input type="text" name="Database" id="biodatabase">
        <input type="text" name="Keyword" id="biokeyword">
        <input type="text" name="TYPE" value="2">
    </form>

    <form style="display: none" action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="billinfo" method="POST">
        <input type="text" name="billid" id="billid">
        <input type="text" name="shorttitle" id="shorttitle">
        <input type="text" name="sponser" id="sponser">
        <input type="text" name="Intron" id="Intron">
        <input type="text" name="lastactionwidate" id="lastactionwidate">
        <input type="text" name="billurl" id="billurl">
        <input type="text" name="Chamber" id="billchamber">
        <input type="text" name="Database" id="billdatabase">
        <input type="text" name="Keyword" id="billkeyword">
        <input type="text" name="TYPE" value="3">
    </form>

</div>


<?php if ((isset($_POST["TYPE"]) && $_POST["TYPE"] == 1) && $database == "legislators"):
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

        if ($cout == 0) {
            echo "<h3>The API returned zero results for the request.</h3>";
        } else {
            echo "<table class='tab' align='center'><tr><th><strong>Name</strong></th><th><strong>State</strong></th><th><strong>Chamber</strong></th><th><strong>Detail</strong></th></tr> ";
            for ($i = 0; $i < $cout; $i++) {
                $name = $res->results[$i]->first_name . " " . $res->results[$i]->last_name;
                $state = $res->results[$i]->state_name;
                $chamber = $res->results[$i]->chamber;
                $bioid = $res->results[$i]->bioguide_id;
                $state2 = $res->results[$i]->state;
                echo "<tr><td>$name</td><td>$state</td><td>$chamber</td><td><a href = \"javascript:biodetail('$chamber','$bioid','$state2','$database','$keyword');\">View Details</a></td></tr>";
            }
            echo "</table>";
        }
    } else {
        $splname = explode(" ", $keyword);


        if (sizeof($splname) == 1) {
            $context = $database . '?chamber=' . $chamber . '&query=' . $keyword . '&apikey=4acd972a599843bd93ea4dba171a483f';
            $url = $PREFIX . $context;


            $html = file_get_contents($url);
            $res = json_decode($html);

            echo "<br>";
            $cout = count($res->results);
            if ($cout == 0) {
                echo "<h3>The API returned zero results for the request.</h3>";
            } else {

                echo "<table class='tab' align='center'><tr><th><strong>Name</strong></th><th><strong>State</strong></th><th><strong>Chamber</strong></th><th><strong>Detail</strong></th></tr> ";
                for ($i = 0; $i < $cout; $i++) {
                    $name = $res->results[$i]->first_name . " " . $res->results[$i]->last_name;
                    $state = $res->results[$i]->state_name;
                    $chamber = $res->results[$i]->chamber;
                    $bioid = $res->results[$i]->bioguide_id;
                    $state2 = $res->results[$i]->state;
                    echo "<tr><td>$name</td><td>$state</td><td>$chamber</td><td><a href = \"javascript:biodetail('$chamber','$bioid','$state2','$database','$keyword');\">View Details</a></td></tr>";
                }
                echo "</table>";
            }
        } elseif (sizeof($splname) == 2) {
            $firstname = $splname[0];
            $lastname = $splname[1];

            $context = $database . '?chamber=' . $chamber . '&first_name=' . $firstname . '&last_name=' . $lastname . '&apikey=4acd972a599843bd93ea4dba171a483f';
            $url = $PREFIX . $context;

            $html = file_get_contents($url);
            $res = json_decode($html);

            echo "<br>";
            $cout = count($res->results);
            if ($cout == 0) {
                echo "<h3>The API returned zero results for the request.</h3>";
            } else {

                echo "<table class='tab' align='center'><tr><th><strong>Name</strong></th><th><strong>State</strong></th><th><strong>Chamber</strong></th><th><strong>Detail</strong></th></tr> ";
                for ($i = 0; $i < $cout; $i++) {
                    $name = $res->results[$i]->first_name . " " . $res->results[$i]->last_name;
                    $state = $res->results[$i]->state_name;
                    $chamber = $res->results[$i]->chamber;
                    $bioid = $res->results[$i]->bioguide_id;
                    $state2 = $res->results[$i]->state;
                    echo "<tr><td>$name</td><td>$state</td><td>$chamber</td><td><a href = \"javascript:biodetail('$chamber','$bioid','$state2','$database','$keyword');\">View Details</a></td></tr>";
                }
                echo "</table>";
            }
        } else {
            echo "You can search by 'state name', 'firstname', 'lastname' or 'firstname and lastname', please retry.";
        }
    }


endif; ?>

<?php if ((isset($_POST["TYPE"]) && $_POST["TYPE"] == 1) && $database == "committees"):
    $keyword = strtoupper($keyword);
    $context = $database . '?committee_id=' . $keyword . '&chamber=' . $chamber . '&apikey=4acd972a599843bd93ea4dba171a483f';
    $url = $PREFIX . $context;

    $html = file_get_contents($url);
    $res = json_decode($html);

    $cout = count($res->results);
    if ($cout == 0) {
        echo "<h3>The API returned zero results for the request.</h3>";
    } else {

        echo "<table  class='tab' align='center'><tr><th><strong>Committee ID</strong></th><th><strong>Committee Name</strong></th><th><strong>Chamber</strong></th></tr> ";
        for ($i = 0; $i < $cout; $i++) {
            $committeeid = $res->results[$i]->committee_id;
            $committeename = $res->results[$i]->name;
            $chamber = $res->results[$i]->chamber;
            echo "<tr><td>$committeeid </td><td>$committeename</td><td>$chamber </td></tr>";
        }
        echo "</table>";
    }

endif; ?>

<?php if ((isset($_POST["TYPE"]) && $_POST["TYPE"] == 1) && $database == "bills"):
    $keyword = strtolower($keyword);
    $context = $database . '?bill_id=' . $keyword . '&chamber=' . $chamber . '&apikey=4acd972a599843bd93ea4dba171a483f';
    $url = $PREFIX . $context;


    $html = file_get_contents($url);
    $res = json_decode($html);
    $cout = count($res->results);
    if ($cout == 0) {
        echo "<h3>The API returned zero results for the request.</h3>";
    } else {

        echo "<table class='tab' align='center'><tr><th><strong>Bill ID</strong></th><th><strong>Short Title</strong></th><th><strong>Chamber</strong></th><th><strong>View Detail</strong></th></tr> ";
        for ($i = 0; $i < $cout; $i++) {
            $billid = $res->results[$i]->bill_id;
            $shorttitle = $res->results[$i]->short_title;
            $chamber = $res->results[$i]->chamber;
            $title = $res->results[$i]->sponsor->title;
            $firstname = $res->results[$i]->sponsor->first_name;
            $lastname = $res->results[$i]->sponsor->last_name;
            $sponser = $title . " " . $firstname . " " . $lastname;
            $Intron = $res->results[$i]->introduced_on;
            $versionname = $res->results[$i]->last_version->version_name;
            $lastacat = $res->results[$i]->last_action_at;
            $lastactionwidate = $versionname . ', ' . $lastacat;
            $billurl = $res->results[$i]->last_version->urls->pdf;
            if ($shorttitle == "")
                $shorttitle = "N.A.";


            echo "<tr><td>$billid</td><td>$shorttitle</td><td>$chamber</td><td><a href = \"javascript:billdetail('$billid', '$shorttitle',
 '$sponser','$Intron','$lastactionwidate','$billurl','$database','$chamber','$keyword');\">View Details</a></td></tr>";
        }
        echo "</table>";
    }

endif; ?>

<?php if ((isset($_POST["TYPE"]) && $_POST["TYPE"] == 1) && $database == "amendments"):
    $keyword = strtolower($keyword);
    $context = $database . '?amendment_id=' . $keyword . '&chamber=' . $chamber . '&apikey=4acd972a599843bd93ea4dba171a483f';
    $url = $PREFIX . $context;

    $html = file_get_contents($url);
    $res = json_decode($html);
    $cout = count($res->results);
    if ($cout == 0) {
        echo "<h3>The API returned zero results for the request.</h3>";
    } else {

        echo "<table  class='tab' align='center'><tr><th>Amendment ID</th><th>Amendment Type</th><th>Chamber</th><th>Introduced on</th></tr> ";
        for ($i = 0; $i < $cout; $i++) {
            $amid = $res->results[$i]->amendment_id;
            $amtype = $res->results[$i]->amendment_type;
            $chamber = $res->results[$i]->chamber;
            $intro = $res->results[$i]->introduced_on;
            echo "<tr><td>$amid</td><td>$amtype</td><td>$chamber</td><td>$intro</td></tr>";
        }
        echo "</table>";

    }
endif; ?>


<?php if (isset($_POST["TYPE"]) && $_POST["TYPE"] == 2):
    $biochamber = $_POST["Chamber"];
    $bioid = $_POST["bioid"];
    $biostate = $_POST["biostate"];

    $context = 'legislators?chamber=' . $biochamber . '&state=' . $biostate . "&bioguide_id=" . $bioid . '&apikey=4acd972a599843bd93ea4dba171a483f';
    $url = $PREFIX . $context;

    $html = file_get_contents($url);
    $res = json_decode($html);

    $bioguide_id = $res->results[0]->bioguide_id;
    $name = $res->results[0]->title . " " . $res->results[0]->first_name . " " . $res->results[0]->last_name;
    $flinkname = $res->results[0]->first_name . " " . $res->results[0]->last_name;
    $tlinkname = $res->results[0]->first_name . " " . $res->results[0]->last_name;
    $termend = $res->results[0]->term_end;
    $website = $res->results[0]->website;
    $office = $res->results[0]->office;
    $fbid = $res->results[0]->facebook_id;
    $twid = $res->results[0]->twitter_id;


    $photo = 'https://theunitedstates.io/images/congress/225x275/' . $bioguide_id . '.jpg';

    if ($fbid == "")
        $flinkname = "N.A.";

    if ($twid == "")
        $tlinkname = "N.A.";

    $fblink = 'https://www.facebook.com/' . $fbid;

    $twlink = 'https://twitter.com/' . $twid;


    if ($website == "")
        $website = "N.A.";


    echo "<table id='biotable' align='center'> <tr><td colspan='2' style='text-align: center'><img src=\"$photo\"></td></tr><tr><td class='left'>Full Name</td><td class='right'>$name</td></tr>
<tr><td class='left'>Term Ends on</td><td class='right'>$termend</td></tr><tr><td class='left'>Website</td><td class='right'><a href=\"$website\" target=\"_blank\">$website</a></td></tr>
<tr><td class='left'>Office</td><td class='right'>$office</td></tr><tr><td class='left'>Facebook</td><td class='right'><a href=\"$fblink\" target=\"_blank\">$flinkname</a></td></tr> 
        <tr><td class='left'>Twitter</td><td class='right'><a href=\"$twlink\" target=\"_blank\">$tlinkname</a></td></tr></table>";
endif; ?>

<?php if (isset($_POST["TYPE"]) && $_POST["TYPE"] == 3):
    $billid = $_POST["billid"];
    $shorttitle = $_POST["shorttitle"];
    $billurltitle = $shorttitle;
    $sponser = $_POST["sponser"];
    $Intron = $_POST["Intron"];
    $lastactionwidate = $_POST["lastactionwidate"];
    $billurl = $_POST["billurl"];
    if ($billurltitle == "N.A.")
        $billurltitle = $billid;

    echo "<table id='billtable' align='center'><tr><td class='left'>Bill ID</td><td class='right'>$billid</td></tr>
<tr><td class='left'>Bill Title</td><td class='right'>$shorttitle</td></tr><tr><td class='left'>Sponsor</td><td class='right'>$sponser</td></tr>
<tr><td class='left'>Introduced On</td><td class='right'>$Intron</td></tr><tr><td class='left'>Last action with date</td><td class='right'>$lastactionwidate</td></tr>
        <tr><td class='left'>Bill URL</td><td class='right'><a href=\"$billurl\" target=\"_blank\">$billurltitle</a></td></tr></table>";
endif; ?>
</body>
</html>