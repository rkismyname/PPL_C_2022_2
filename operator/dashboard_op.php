<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../aset/bootstrap/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="../aset/css/style4.css">
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
    
    $query = "SELECT * FROM operator_mahasiswa";
    $sql_ppl= $db->query($query);
    $data = $sql_ppl->fetch_array(); 
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
        <div class="logout">
            <a href="../index.php">Logout</a>
        </div>
        <div class="text"; style="float: left;">DATA OPERATOR DEPARTEMEN INFORMATIKA</div>
    </div>
    <div class="box">
        <div class="operator">Operator</div>
        <div class="operator1">Selamat Datang di Sistem Informasi Departemen Informatika</div>
    </div>
    <div class="sum">
        <div class="sumTenaga">
            <div class="sumTenaga-img">
                <img src="../aset/img/PPL/bg remove/logo_orang-removebg-preview.png" alt="logo_orang-removebg-preview.png.png">
                <div class="sumTenagaPendidik">
                    <p>Jumlah Tenaga Pendidik</p>
                </div>
                <div class="sumTenagaPendidik2">
                    <p>25</p>
                </div>
            </div>
            <div class="sumTenaga2">
                <img src="../aset/img/PPL/bg remove/logo_orang_rame-removebg-preview.png" alt="logo_orang_rame-removebg-preview.png">
                <div class="sumJumlahMhs">
                    <p>Jumlah Mahasiswa</p>
                </div>
                <div class="sumJumlahMhs2">
                    <p>2300</p>
                </div>
            </div>



            <div class="isian">
                <div class="dosen">
                    <a href= "data_dosen.php">
                    <img src="../aset/img/PPL/bg remove/logo_dosen-removebg-preview.png" alt="logo_dosen-removebg-preview.png">
                    <p align="center" class="datadosen">Data Dosen</p>
                    </a>
                </div>
                <div class="mhs">
                    <a href="data_mahasiswa.php">
                    <img src="../aset/img/PPL/bg remove/logo_orang_rame-removebg-preview.png" alt="logo_orang_rame-removebg-preview.png">
                    <p align="center" class="datamhs">Data Mahasiswa</p>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <div class="botom-line"></div>
</body>
</html>



