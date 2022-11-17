<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../aset/bootstrap/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="../aset/css/style4.css">
    <title>Upload Data Dosen </title>

    <?php
    session_start();
    require_once('../db_login.php');

    if (!isset($_SESSION['role'])) {
        header('Location: ../index.php');
    }
    if ($_SESSION['role'] == 'dosen') {
        header('Location: ../dosen/dashboard_dosen.php');
    }
    if ($_SESSION['role'] == 'departemen') {
        header('Location: ../departemen');
    }
    if ($_SESSION['role'] == 'mahasiswa') {
        header('Location: ../mahasiswa/dashboard_mhs.php');
    }

    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $nip = $_POST['nip'];
        $email = $_POST['email'];
        $matkul = $_POST['matkul'];
        $username = $_POST['uname'];
        $password = $_POST['psw'];
        $email = $_POST['email'];
    


        $valid = true;

        if (empty($nama)) {
            $error_nama = "nama harus diisi!";
            $valid = false;
        }
        if (empty($nip)) {
            $error_nip = "nip tidak boleh kosong!";
            $valid = false;
        } elseif (is_numeric($nip) == FALSE) {
            $error_nip2 = "nip harus angka!";
            $valid = false;
        } elseif (strlen($nip) != 14) {
            $error_nip3 = "nip harus 14 digit!";
            $valid = false;
        }

        if (empty($email)) {
            $error_email = "email tidak boleh kosong!";
            $valid = false;
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error_email2 = "format salah!";
            $valid = false;
        }

        if (empty($matkul)) {
            $error_matkul= "matkul tidak boleh kosong!";
            $valid = false;
        }

        if ($valid == true) {
            $insert = mysqli_query($db, " INSERT INTO operator_dosen (nama, nip, email, matkul) VALUES('$nama', '$nip', '$email', '$matkul') ") && $insert = mysqli_query($db,"INSERT INTO user (username,password,email,role) VALUES ('$username',MD5('$password'),'$email','dosen')  ");;
        }
     
    }


    $db->close();
    ?>
       </head>


       <body>
    <div class="top">
        <div class="logo_undip">
            <img src="../aset/img/PPL/logo-undip-01.png" alt="logo-undip-01.png">
        </div>
        <div class="logo_profile">
            <img src="../aset/img/PPL/bg remove/logo profile bg remove.png" alt="profile">
        </div>
        <div class="text">UNIVERSITAS DIPONEGORO</div>
    </div>
    <div class="bar">
        <div class="navbar">
            <a href="dashboard_op.php">Dashboard</a>
            <a href="data_mahasiswa.php">Data Mahasiswa</a>
            <a href="data_dosen.php">Data Dosen</a>
        </div>
    </div>

    <div class="bar">

    </div>

    <b class="operator">OPERATOR</b>
    <form class="card card-mhs" method="post">
        <h2>Upload Mahasiswa Dosen</h2>
        <br />
        NAMA: <input type="text" name='nama' id='nama' maxlength="40" />
        <div class='errornama'>
            <?php if (isset($error_nama)) {
                echo $error_nama;
            }
            ?>
        </div>
        <br />
        NIP: <input type="text" name='nip' id='nip' maxlength="14" />
        <div class='errornip'>
            <?php if (isset($error_nip)) {
                echo $error_nip;
            } elseif (isset($error_nip2)) {
                echo $error_nip2;
            } elseif (isset($error_nip3)) {
                echo $error_nip3;
            }
            ?>
        </div>
        <br />

        <br />
        Password: <input type="text" name = 'psw' id = 'psw'  minlength ="4"/>
    <br />
    email: <input type="text" name='email' id='email' maxlength="40" />
        <div class='erroremail'>
            <?php if (isset($error_email)) {
                echo $error_email;
            }
            ?>
    <br />
        Username: <input type="text" name = 'uname' id = 'uname'  minlength ="4"/>
    

    
        </div>
        <br />

        <div class='erroremail2'>
            <?php if (isset($error_email2)) {
                echo $error_email2;
            }
            ?>
        </div>
        <br />

        MATA KULIAH: <input type="text" name='matkul' id='matkul' maxlength="40" />
        <div class='errormatkul'>
            <?php if (isset($error_matkul)) {
                echo $error_matkul;
            }
            ?>
        </div>
        <br />

        <button type="submit" value="submit" name="submit">submit</button>

    </form>



    <div class="botom-line"></div>
</body>

</html>