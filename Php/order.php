<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
table {
 border-collapse: collapse;
 width: 100%;
}
td {
 text-align: left;
}
tr:nth-child(even) {
    background-color: skyblue;
}
</style>
<body>
    <?php
    echo "<table style = 'width:99%; border:1px black solid;'>";
        echo "<tr><th>YOUR ORDERS</th></tr>";
        class TableRows extends RecursiveIteratorIterator{
            function __construct($values){
                parent::__construct($values, self::LEAVES_ONLY);
            }
            function current() {
                return "<td>".parent::current(). "</td>";
            }
            function beginChildren() {
                echo "<tr>";
                }
                function endChildren() {
                    echo "</tr>" . "\n";
                }
            }
            $server = "localhost";
            $username = "root";
            $password = "";
            $dbname = "freelancing";

            try {
                $ConnectionDB = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
                $ConnectionDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $Statment = $ConnectionDB->prepare("SELECT * FROM `cst`");
                $Statment->execute();
                $result = $Statment->setFetchMode(PDO::FETCH_ASSOC);
                foreach(new TableRows(new RecursiveArrayIterator($Statment->fetchAll())) as $k=>$variable) {
                    echo $variable;
                }
            } catch (PDOException $th) {
                echo "Connection Failed!: ".$th->getMessage();
            }
            $ConnectionDB =  null;
            echo "</table></center><p>";
            ?>
</body>
</html>