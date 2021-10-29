<html>
    <head>
        <style>
        .error {color: #FF0000;}
        </style>
    </head>
    <body>
    <?php
    // define variables and set to empty values
    $nimErr= $namaErr = $alamatErr = $jkelErr = $tgllhrErr = "";
    $nim = $nama = $alamat = $jkel = $tgllhr = "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["nim"])) {
            $nimErr = "NIM harus diisi";
        }else {
            $nim = test_input($_POST["nim"]);
        }

        if (empty($_POST["nama"])) {
            $namaErr = "Nama harus diisi";
        }else {
            $nama = test_input($_POST["nama"]);
        }
    
        if (empty($_POST["alamat"])) {
            $alamat = "";
        }else {
            $alamat = test_input($_POST["alamat"]);
        }   
        
        if (empty($_POST["jkel"])) {
            $jkelErr = "Gender harus dipilih";
        }else {
            $jkel = test_input($_POST["jkel"]);
        }

        if (empty($_POST["Tgllhr"])) {
            $tgllhrErr = "Tanggal Lahir harus diisi";
        }else {
            $tgllhr = test_input($_POST["tgllhr"]);
        }
        
    }
    $fp=fopen("datavalidasi.txt","a+");
    fputs($fp,"$nim|$nama|$jkel|$alamat|$tgllhr\n");
    fclose($fp);

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <h2 align="center">GuestBook </h2>
    
    <p align="center"><span class = "error">* Harus Diisi.</span></p>
    
    <form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <table align="center">
        <tr>
            <td>Nim:</td>
            <td><input type = "text" name = "nim">
            <span class = "error">* <?php echo $nimErr;?></span>
            </td>
        </tr>
        <tr>
            <td>Nama:</td>
            <td><input type = "text" name = "nama">
            <span class = "error">* <?php echo $namaErr;?></span>
            </td>
        </tr>
        <tr>
            <td>Alamat:</td>
            <td> <input type = "text" name = "alamat">
            <span class = "error"><?php echo $alamatErr;?></span>
            </td>
        </tr>
    
        <tr>
            <td>Gender:</td>
            <td>
            <input type = "radio" name = "jkel" value = "L">Laki-Laki
            <input type = "radio" name = "jkel" value = "P">Perempuan
            <span class = "error">* <?php echo $jkelErr;?></span>
            </td>
        </tr>

        <tr>
            <td>Tanggal lahir:</td>
            <td><input type= "date" name="tgllhr">
            <span class = "error">* <?php echo $tgllhrErr;?></span>
        </td>
        </tr>
        
            <td>
            <input type = "submit" name = "submit" value = "Submit"> 
            </td>
    </table>
    </form>
    
    <?php
    echo "<h2 align=center>Data yang anda isi:</h2>";
    $fp = fopen("datavalidasi.txt","r");
    echo "<table align=center border=1";
    while ($isi = fgets($fp, 80)){
        $pisah = explode("|",$isi);
        echo "<tr><td> NIM </td><td>: $pisah[0]</td></tr>";
        echo "<tr><td> Nama </td><td>: $pisah[1]</td></tr>";
        echo "<tr><td> Alamat </td><td>: $pisah[2]</td></tr>";
        echo "<tr><td> Gender </td><td>: $pisah[3]</td></tr>";
        echo "<tr><td> Tanggal Lahir </td><td>: $pisah[4]</td></tr>
        <tr><td> &nbsp; <hr></td> <td> &nbsp; <hr></td></tr>";
      }
      echo "</table>";
        // include database connection file
        include_once("koneksi.php");
        // Insert user data into table
        $result = mysqli_query($con, "INSERT INTO mahasiswa(nim,nama,jkel,alamat,tgllhr)
        VALUES('$nim','$nama', '$jkel','$alamat','$tgllhr')");
    ?>  
    </body>
</html>