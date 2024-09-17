<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Siswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        $nis = $nama = $kelas = $jenis_kelamin = "";
        $ekstrakurikuler = [];
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validasi NIS
            if (empty($_POST["nis"])) {
                $errors["nis"] = "NIS harus diisi";
            } elseif (!preg_match("/^[0-9]{10}$/", $_POST["nis"])) {
                $errors["nis"] = "NIS harus terdiri dari 10 angka";
            } else {
                $nis = test_input($_POST["nis"]);
            }

            // Validasi Nama
            if (empty($_POST["nama"])) {
                $errors["nama"] = "Nama harus diisi";
            } else {
                $nama = test_input($_POST["nama"]);
            }

            // Validasi Kelas
            if (empty($_POST["kelas"])) {
                $errors["kelas"] = "Kelas harus dipilih";
            } else {
                $kelas = test_input($_POST["kelas"]);
            }

            // Validasi Jenis Kelamin
            if (empty($_POST["jenis_kelamin"])) {
                $errors["jenis_kelamin"] = "Jenis kelamin harus dipilih";
            } else {
                $jenis_kelamin = test_input($_POST["jenis_kelamin"]);
            }

            // Validasi Ekstrakurikuler untuk kelas X dan XI
            if ($kelas == "X" || $kelas == "XI") {
                if (empty($_POST["ekstrakurikuler"])) {
                    $errors["ekstrakurikuler"] = "Pilih minimal 1 ekstrakurikuler";
                } elseif (count($_POST["ekstrakurikuler"]) > 3) {
                    $errors["ekstrakurikuler"] = "Pilih maksimal 3 ekstrakurikuler";
                } else {
                    $ekstrakurikuler = $_POST["ekstrakurikuler"];
                }
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>

    <div class="container">
        <h2>Formulir Pendaftaran Siswa</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="studentForm">
            NIS: <input type="text" name="nis" value="<?php echo $nis; ?>">
            <span class="error"><?php echo isset($errors["nis"]) ? $errors["nis"] : ""; ?></span>
            <br><br>
            
            Nama: <input type="text" name="nama" value="<?php echo $nama; ?>">
            <span class="error"><?php echo isset($errors["nama"]) ? $errors["nama"] : ""; ?></span>
            <br><br>
            
            Kelas:
            <select name="kelas" id="kelas" onchange="toggleEkstrakurikuler()">
                <option value="">Pilih Kelas</option>
                <option value="X" <?php echo ($kelas == "X") ? "selected" : ""; ?>>X</option>
                <option value="XI" <?php echo ($kelas == "XI") ? "selected" : ""; ?>>XI</option>
                <option value="XII" <?php echo ($kelas == "XII") ? "selected" : ""; ?>>XII</option>
            </select>
            <span class="error"><?php echo isset($errors["kelas"]) ? $errors["kelas"] : ""; ?></span>
            <br><br>
            
            Jenis Kelamin:
            <div class="vertical-group">
                <label><input type="radio" name="jenis_kelamin" value="Laki-laki" <?php echo ($jenis_kelamin == "Laki-laki") ? "checked" : ""; ?>> Pria</label>
                <label><input type="radio" name="jenis_kelamin" value="Perempuan" <?php echo ($jenis_kelamin == "Perempuan") ? "checked" : ""; ?>> Wanita</label>
            </div>
            <span class="error"><?php echo isset($errors["jenis_kelamin"]) ? $errors["jenis_kelamin"] : ""; ?></span>
            <br><br>
            
            <div id="ekstrakurikulerDiv" style="display: <?php echo ($kelas == "X" || $kelas == "XI") ? "block" : "none"; ?>">
                Ekstrakurikuler (pilih 1-3):
                <div class="vertical-group">
                    <label><input type="checkbox" name="ekstrakurikuler[]" value="Pramuka" <?php echo in_array("Pramuka", $ekstrakurikuler) ? "checked" : ""; ?>> Pramuka</label>
                    <label><input type="checkbox" name="ekstrakurikuler[]" value="Seni Tari" <?php echo in_array("Seni Tari", $ekstrakurikuler) ? "checked" : ""; ?>> Seni Tari</label>
                    <label><input type="checkbox" name="ekstrakurikuler[]" value="Sinematografi" <?php echo in_array("Sinematografi", $ekstrakurikuler) ? "checked" : ""; ?>> Sinematografi</label>
                    <label><input type="checkbox" name="ekstrakurikuler[]" value="Basket" <?php echo in_array("Basket", $ekstrakurikuler) ? "checked" : ""; ?>> Basket</label>
                </div>
                <span class="error"><?php echo isset($errors["ekstrakurikuler"]) ? $errors["ekstrakurikuler"] : ""; ?></span>
            </div>
            <br>

            <div class="btn-group">
                <input type="submit" name="submit" value="Submit">
                <input type="reset" value="Reset" onclick="resetForm()">
            </div>
        </form>
    </div>

    <script>
        function toggleEkstrakurikuler() {
            var kelas = document.getElementById("kelas").value;
            var ekstrakurikulerDiv = document.getElementById("ekstrakurikulerDiv");
            if (kelas === "X" || kelas === "XI") {
                ekstrakurikulerDiv.style.display = "block";
            } else {
                ekstrakurikulerDiv.style.display = "none";
            }
        }

        function resetForm() {
            // Reset form inputs
            document.getElementById("studentForm").reset();
            
            // Hide the ekstrakurikuler section
            document.getElementById("ekstrakurikulerDiv").style.display = "none";
        }
    </script>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)) {
            echo "<h3>Data yang disubmit:</h3>";
            echo "NIS: " . $nis . "<br>";
            echo "Nama: " . $nama . "<br>";
            echo "Kelas: " . $kelas . "<br>";
            echo "Jenis Kelamin: " . $jenis_kelamin . "<br>";
            if ($kelas == "X" || $kelas == "XI") {
                echo "Ekstrakurikuler: " . implode(", ", $ekstrakurikuler) . "<br>";
            }
        }
    ?>

</body>
</html>