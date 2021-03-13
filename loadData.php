<?php
    include "dbhandler.php";

    $newSelectedOption = $_POST['newSelectedOption'];
    $newFrom = $_POST['newFrom'];
    $newTo = $_POST['newTo'];
    $newSelectedQuantity = $_POST['newSelectedQuantity'];
    $newQuantity = $_POST['newQuantity'];

    if($newSelectedOption == 1){
        $newSelectedOption = 'price';
    } else $newSelectedOption = 'priceopt'; 

    $query = "SELECT * FROM names WHERE " . $newSelectedOption . " > " . $newFrom . " AND (" . $newSelectedOption . " < " . $newTo . ") AND (quantity1 " . $newSelectedQuantity . " " . $newQuantity . " OR quantity2 " . $newSelectedQuantity . " " . $newQuantity . ");";
    echo $query;
    $result = mysqli_query($link, $query);
    if ($result) {
        $rows = mysqli_num_rows($result);
        
        for ($i = 0; $i < $rows; $i++) {
            $row = mysqli_fetch_row($result);
            echo "<tr>";
            for ($j = 0; $j < 7; ++$j) {
                echo "<td>" . $row[$j] . "</td>";
            }
            if ($row[4] < 20 && $row[5] < 20) {
                echo "<td>Осталось мало!! Срочно докупите!!!</td>";
            } else echo "<td></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else echo "Записи не найдены";
    mysqli_close($link);
?>