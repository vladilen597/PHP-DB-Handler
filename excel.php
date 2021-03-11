<?php
    require_once "PHPExcel.php";
    $excel = PHPExcel_IOFactory::load('pricelist.xls');
    for($i = 2; $i < 30; $i++){
        $count = 0;
        for($i = 2; $i <= 1000; $i++){
            if($i == 23 || $i == 33 || $i == 119 || $i == 129 || $i == 749 || $i == 805 || $i == 871){
                continue;
            }
            echo "<tr>";
            $Acell = $excel->getActiveSheet()->getCell('A'.$i);
            $Bcell = $excel->getActiveSheet()->getCell('B'.$i);
            $Ccell = $excel->getActiveSheet()->getCell('C'.$i);
            $Dcell = $excel->getActiveSheet()->getCell('D'.$i);
            $Ecell = $excel->getActiveSheet()->getCell('E'.$i);
            $Fcell = $excel->getActiveSheet()->getCell('F'.$i);
            $query = "INSERT INTO names VALUES (NULL, "."'".$Acell."'".", ".$Bcell.", ".$Ccell.", ".$Dcell.", ".$Ecell.", "."'".$Fcell."'". ")";
            $result = mysqli_query($link, $query);
            if(!$result){
                echo "Ошибка выполнения";
            }
            // if($count == 0){
            //     echo "<td>Примечание</td>";
            //     $count = 1;
            // } else echo "<td></td>";
            echo "<tr>";
        }
    }
?>