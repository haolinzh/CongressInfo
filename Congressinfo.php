<html>
<body>
<div align="center" >
    <h2>Congrss Information Search</h2>
    <form id="congressinfo" method="get">
        <div border='1'>
            <table>
                <tr>
                    <td>Congress DataBase</td>
                    <td>
                        <select name="Database">
                            <option value="null">Select your option</option>
                            <option value="legislators">Legislators</option>
                            <option value="committees">Committees</option>
                            <option value="bills">Bills</option>
                            <option value="amendments">Amendments</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Chamber</td>
                    <td>
                        <input type="radio" name="Chamber" value="senate"> Senate
                        <input type="radio" name="Chamber" value="house"> House
                    </td>
                </tr>
                <tr>
                    <td>Keywords</td>
                    <td><input type="text" name="Keyword"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Search">
                        <button type="button" onclick="clear()">clear</button>
                    </td>
                </tr>
            </table>
            <a href="http://sunlightfoundation.com/">Powered by Sunlight Fundation</a>
        </div>

    </form>
</div>

<?php if ($_GET["submit"] && $_GET["Database"] == "legislators"):


    $PREFIX = 'http://congress.api.sunlightfoundation.com/';

    $context = $_GET["Database"] . '?chamber=' . $_GET["Chamber"] . '&state=' . $_GET["Keyword"] . '&apikey=4acd972a599843bd93ea4dba171a483f';
    $url = $PREFIX . $context;

    $html = file_get_contents($url);
    $res = json_decode($html);

    echo "<br>";
    $cout = count($res->results);

    $person1 = $res->results[0];
    echo "<table border='1' align='center'><tr><th>Name</th><th>State</th><th>Chamber</th><th>Detail</th></tr> ";
    for ($i = 0; $i < $cout; $i++) {
        $name = $res->results[$i]->first_name . " " . $res->results[$i]->middle_name . " " . $res->results[$i]->last_name;
        $state = $res->results[$i]->state_name;
        $chamber = $res->results[$i]->chamber;
        echo "<tr><td>$name</td><td>$state</td><td>$chamber</td><td><a href=''>View Details</a></td></tr>";
    }
    echo "</table>";


endif; ?>

</body>
</html>