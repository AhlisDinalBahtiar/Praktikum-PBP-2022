<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once('function.php');

        function print_mhs($array_mhs) {
            echo "<table border='1'>";
            echo "<tr>
                    <th>Nama</th>
                    <th>Nilai 1</th>
                    <th>Nilai 2</th>
                    <th>Nilai 3</th>
                    <th>Rata-rata</th>
                </tr>";
            
            foreach ($array_mhs as $nama => $nilai) {
                echo "<tr>";
                echo "<td>$nama</td>";
    
                foreach ($nilai as $n) {
                    echo "<td>$n</td>";
                }
                
                $rata2 = hitung_rata($nilai);
                echo "<td>" . $rata2 . "</td>";
                
                echo "</tr>";
            }
            
            echo "</table>";
        }

        $array_mhs = array(
            'Abdul' => array(89, 90, 54),
            'Budi' => array(98, 65, 74),
            'Nina' => array(67, 56, 84)
        );

        print_mhs($array_mhs);
    ?>
</body>
</html>