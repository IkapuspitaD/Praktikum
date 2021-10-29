<html>
    <head>
        <style>
        .error {color: #FF0000;}
        </style>
    </head>
    <body>
    <?php
    // define variables and set to empty values
    $namaErr = $alamatErr = $emailErr = $genderErr = $commentErr = "";
    $nama = $alamat = $email = $gender = $comment = "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["nama"])) {
            $namaErr = "Nama harus diisi";
        }else {
            $nama = test_input($_POST["nama"]);
        }
    
        if (empty($_POST["alamat"])) {
            $website = "";
        }else {
            $website = test_input($_POST["alamat"]);
        }   

        if (empty($_POST["email"])) {
            $emailErr = "Email harus diisi";
        }else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Email tidak sesuai format"; 
            }
        }
        
        if (empty($_POST["gender"])) {
            $genderErr = "Gender harus dipilih";
        }else {
            $gender = test_input($_POST["gender"]);
        }

        if (empty($_POST["comment"])) {
            $comment = "";
        }else {
            $comment = test_input($_POST["comment"]);
        }
        
    }
    $fp=fopen("guestbook.txt","a+");
    fputs($fp,"$nama|$alamat|$email|$gender|$comment\n");
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
            <td>E-mail: </td>
            <td><input type = "text" name = "email">
            <span class = "error">* <?php echo $emailErr;?></span>
            </td>
        </tr>
    
        <tr>
            <td>Gender:</td>
            <td>
            <input type = "radio" name = "gender" value = "L">Laki-Laki
            <input type = "radio" name = "gender" value = "P">Perempuan
            <span class = "error">* <?php echo $genderErr;?></span>
            </td>
        </tr>

        <tr>
            <td>Komentar:</td>
            <td> <textarea name = "comment" rows = "5" cols = "40"></textarea></td>
        </tr>
        
            <td>
            <input type = "submit" name = "submit" value = "Submit"> 
            </td>
    </table>
    </form>
    
    <?php
    echo "<h2 align=center>Data yang anda isi:</h2>";
    $fp = fopen("guestbook.txt","r");
    echo "<table align=center border=1";
    while ($isi = fgets($fp, 80)){
        $pisah = explode("|",$isi);
        echo "<tr><td> Nama </td><td>: $pisah[0]</td></tr>";
        echo "<tr><td> Alamat </td><td>: $pisah[1]</td></tr>";
        echo "<tr><td> Email </td><td>: $pisah[2]</td></tr>";
        echo "<tr><td> Gender </td><td>: $pisah[3]</td></tr>";
        echo "<tr><td> Komentar </td><td>: $pisah[4]</td></tr>
        <tr><td> &nbsp; <hr></td> <td> &nbsp; <hr></td></tr>";
      }
      echo "</table>";
    ?>  
    </body>
</html>