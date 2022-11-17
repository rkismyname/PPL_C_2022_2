<!--  $koneksi = mysqli_connect("localhost","root","","ppl"); ?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../aset/bootstrap/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="../Operator/style.css">
    <title>Upload Mahasiswa Baru</title>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../aset/bootstrap/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="../Operator/style.css">
    <title>Dashboard Operator</title>

    <?php
    session_start();
    require_once('../db_login.php');

    if(!isset($_SESSION['role'])){
        header('Location: ../index.php');
    }
    if($_SESSION['role']=='dosen'){
        header('Location: ../dosen/dashboard_dosen.php');
    } 
    if($_SESSION['role']=='departemen'){
        header('Location: ../departemen');
    }
    if($_SESSION['role']=='mahasiswa'){
        header('Location: ../mahasiswa/dashboard_mhs.php');
    }
    //  $role=$_SESSION['operator_mahasiswa'];
    //  $query = "SELECT * FROM operator_mahasiswa
    //              INNER JOIN mahasiswa ON user.role=mahasiswa.role 
    //              WHERE user.role='$role'";

    if(isset( $_POST['submit']))
    {
    $nama = $_POST['namamhs'];
    $nim = $_POST['nimmhs'];
    $angkatan = $_POST['angkatanmhs'];

    // $query = "SELECT * FROM 'operator_mahasiswa' ";
    // $sql_ppl= $db->insert($insert);
    // $data = $sql_ppl->fetch_array(); 
    
    $valid = true;

    // <script>
        if(empty($nama)){ 
        $error_nama = "nama harus diisi";
        $valid = false;
    
        }
        if(empty($nim)){
            $error_nim = "nim tidak boleh kosong";
            $valid = false;
        }
        elseif(is_numeric($nim)== FALSE){
            // return false;
            $error_nim2 = "nim harus angka";
            $valid = false;
        }

        elseif(strlen($nim) != 14){
            $error_nim3 = "nim harus 14 digit!";
            $valid = false;
        }
        
        if(empty($angkatan)){
            $error_angkatan = "tidak boleh kosong!";
            $valid = false;
        }
        elseif(is_numeric($angkatan) == FALSE){
            $error_angkatan2="angkatan harus angka!";
            $valid = false;
        }
        elseif(strlen($angkatan) != 4){
            $error_angkatan3 = "angkatan harus 4 digit!";
            $valid = false;
        }
        
        if($valid == true){
            $insert = mysqli_query($db," INSERT INTO operator_mahasiswa (namamhs, nimmhs, angkatanmhs) VALUES('$nama', '$nim', '$angkatan') ");
        }
           
        }
    
        
    //  </script>
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

    </div>

    <h3>OPERATOR</h3>
    <form class="card card-mhs" method="post"> 
        <h2>Upload Mahasiswa Baru</h2>
        <br />
        NAMA: <input type="text" name = 'namamhs'id = 'namamhs'  maxlength="40"/>
        <div class='errornama'>
            <?php if (isset($error_nama)){
                echo $error_nama;
            }
            ?>
    </div>
        <br />
        NIM: <input type="text"  name = 'nimmhs' id = 'nimmhs'  maxlength="14"/> 
        <div class='errornim'>
            <?php if (isset($error_nim)){
                echo $error_nim;
            }
            elseif (isset($error_nim2)){
                echo $error_nim2;
            }
            elseif (isset($error_nim3)){
                echo $error_nim3;
            }
            ?>
    </div>
         <br />
        Angkatan: <input type="text" name = 'angkatanmhs' id = 'angkatanmhs'  maxlength="4"/>
        <div class='errorangkatan'>
            <?php if (isset($error_angkatan)){
                echo $error_angkatan;
            } else if (isset($error_angkatan2)){
                echo $error_angkatan2;
            }
            else if (isset($error_angkatan3)){
                echo $error_angkatan3;}
            ?>
    </div>

        <br />

        <button type="submit" value = "submit" name="submit">submit</button>

        <!-- <a href="data_mahasiswa.php"></a> -->
        <!-- <button  value="Submit" name = "submit"onclick="validateForm()"></a> -->
    </form>

        

    <div class="botom-line"></div>
</body>
</html>