<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Part1</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background-color: #222;
            color: #fff;
        }

        td {
            height: 30px;
            width: 500px;
            border: 1px solid #fff;
        }

        td:first-child {
            width: 15px;
        }

        form,
        select {
            font-size: 20px;
        }

        input {
            width: 100px;
            font-size: 20px;
        }

        #confirmBtn {
            width: 150px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <form action="/index.php" method="GET">
        <label>Показать товары у которых: </label>
        <select id="selectPrice" name="selectPrice">
            <option value="1">Розничная цена</option>
            <option value="2">Оптовая цена</option>
        </select>
        <label>от</label>
        <input type="text" id="from" name="from">
        <label>до</label>
        <input type="text" id="to">
        <label>рублей на складе</label>
        <!-- <select id="selectQuantity">
            <option value="more">Больше</option>
            <option value="less">Меньше</option>
        </select>
        <input type="text" id="quantity">
        <label>штук.</label> -->
        <input type="submit" id="confirmBtn" value="Показать товары">
    </form>
    <br><br>
    <?php
    $link = mysqli_connect("localhost", "vladilen", "zapusta", "pricelist");

    if ($link == false) {
        echo "Ошибка подключения к базе данных!";
    } else {
        if (isset($_GET['from']) && isset($_GET['to'])) {
            $fromFilter =  $_GET['from'];
            $toFilter =  $_GET['to'];
            $selectPrice = $_GET['selectPrice'];
        }
        $count = 0;
        $query = "SELECT * FROM names";
        $result = mysqli_query($link, $query);
        $sum1 = 0;
        $maxRozn = -1;
        $minOpt = 500000;
        if ($result) {
            echo "<table><tr><th>Id</th><th>Название</th><th>Цена</th><th>Цена опт.</th><th>Наличие на складе 1</th><th>Наличие на складе 2</th><th>Производитель</th><th>Примечание</th></tr>";
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
                $sum1 += $row[4];
                $sum2 += $row[5];
                $meanRozn += $row[3];
                $meanOpt += $row[2];
                echo "</tr>";
                if ($maxRozn < $row[2]) {
                    $maxRozn = $row[2];
                }
                if ($minOpt > $row[3]) {
                    $minOpt = $row[3];
                }
            }
            echo "</table>";
            $max = mysqli_fetch_row($result);
            $meanRozn /= $rows;
            $meanOpt /= $rows;
            echo "Общее количество товаров на Складе 1 = " . $sum1 . "<br>";
            echo "Общее количество товаров на Складе 2 = " . $sum2 . "<br>";
            echo "Средняя розничная стоимость = " . $meanRozn . "<br>";
            echo "Средняя оптовая стоимость = " . $meanOpt . "<br>";
            echo "Максимальная розничная цена = " . $maxRozn . "<br>";
            echo "Минимальная оптовая цена = " . $minOpt;
        }
    }
    mysqli_close($link);
    ?>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="script.js"></script>
</body>

</html>