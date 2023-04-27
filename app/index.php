<?php
    $err = isset($_GET["error"]) ? $_GET["error"] : "";
    if($err == "no_input") {
        echo "Zadejte číslo";
    } else if($err == "two_inputs") {
        echo "Zadejte jen jedno číslo";
    } else if($err == "invalid_input") {
        echo "Zadejte binární číslo ve správném formátu";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        $dec = isset($_POST["decimal"]) ? $_POST["decimal"] : "";
        $bin = isset($_POST["binary"]) ? $_POST["binary"] : "";

        if($dec == "" && $bin == "") {
            header("location: ./?error=no_input");
        } else if ($dec && $bin) {
            header("location: ./?error=two_inputs");
        } else if($bin) {
            binToDec($bin);
        } else decToBIn($dec);         
    }

    echo '<form action="./" method="post">
            <label for="binary">Binary</label>
            <input type="number" name="binary">
            <label for="decimal">Decimal</label>
            <input type="number" name="decimal">
            <input type="submit" value="Calculate">
        </form>';

    function binToDec($bin) {
        $arr = binToArray($bin); 
        $res = 0;
        for ($i = 0; $i < sizeof($arr); $i++) {
            $res += pow(2, $i) * $arr[$i];
            echo pow(2, $i);
            echo " * ";
            echo $arr[$i];
            if($i == sizeof($arr) - 1) {
                echo "<br>";
            } else echo " + ";
        }
        echo $res;
    }

    function binToArray($bin) : array {
        $num = $bin;
        $newArr = array();
        $i = 0;
        while ($num >= 1) {
            $mod = $num % 10;
            if($mod != 0 && $mod != 1) {
                header("location: ./?error=invalid_input");
            }
            $newArr[$i] = $mod;
            $num = $num / 10;
            $i++;
        }

        return $newArr;
    }

    function decToBin($dec) {
        $num = $dec;
        $finalArr = array();
        $i = 0;
        while ($num >= 1) {
            $mod = $num % 2;
            echo $num . " % 2  = " . $mod . " , ";
            $finalArr[$i] = $mod;
            $num = $num / 2;
            $num = floor($num);
            $i++;
        }
        echo "<br>";
        $res = array_reverse($finalArr);    
        for ($i = 0; $i < sizeof($res); $i++) {
            echo $res[$i];
        }
    }
?>

