<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../aset/css/style.css">
    <title>Dashboard Mahasiswa</title>
    <?php
    session_start();
    require_once('../db_login.php');

    if(!isset($_SESSION['username'])){
        header('Location: ../index.php');
    }
    if($_SESSION['role']=='dosen'){
        header('Location: ../dosen/dashboard_dosen.php');
    } 
    if($_SESSION['role']=='departemen'){
        header('Location: ../departemen');
    }
    if($_SESSION['role']=='operator'){
        header('Location: ../operator/dashboard_op.php');
    } 
    
    $username = $_GET['username'];

    $query = "SELECT user.username, mahasiswa.*, irs.*, khs.* FROM user JOIN mahasiswa ON user.user_id = mahasiswa.mahasiswa_id JOIN irs ON irs.irs_id = mahasiswa.irs_id JOIN khs ON khs.khs_id = mahasiswa.khs_id WHERE user.username = '$username'";
    $sql_ppl= mysqli_query($db, $query) or die (mysqli_error($db));
    $data = mysqli_fetch_array ($sql_ppl);
    ?>
</head>
<body>
    <div class="top">
        <div class="logo_undip">
            <img src="../aset/img/PPL/logo-undip-01.png" alt="logo-undip-01.png">
        </div>

        <div class="ddaction">
            <div class="ddprofile" onclick="menuToggle();">
                <img src="../aset/img/ppl/ayaya.jpeg" style="width:60px;height:auto; border-radius:50%;">
            </div>
            <div class="ddmenu">
                <h3><?=$data['nama'] ?><br><span><?=$data['prodi']?></span></h3>
                <ul>
                    <li><img src="../aset/img/ppl/edit.png" style="width:50px;height:auto;"><a href="edit_mhs.php?username=<?=$username?>"> Edit </a></li>
                    <li><img src="../aset/img/ppl/logout.png" style="width:50px;height:auto;"><a href="../logout.php"> Logout </a></li>
                </ul>
            </div>
        </div>
        
        <div class="text">UNIVERSITAS DIPONEGORO</div>
    </div>
    <div class="bar">
        <div class="navbar">
            <a href="dashboard_mhs.php?username=<?=$username?>">Dashboard</a>
            <a href="irs_mhs.php?username=<?=$username?>">Data IRS</a>
            <a href="khs_mhs.php?username=<?=$username?>">Data KHS</a>
            <a href="pkl_mhs.php?username=<?=$username?>">PKL</a>
            <a href="skripsi_mhs.php?username=<?=$username?>">Skripsi</a>
            </div> 
        </div>
    </div>
    <div class="isi">
        <div class="text-dashboard">Dashboard</div>
        <div class="card card-status">
            <img src="../aset/img/PPL/ayaya.jpeg">
            <div class="card-status-mhs"><?=$data['status']?></div>
            <ul>
                <li style="font-weight: bold;"><?=$data['nama']?></li>
                <li><?=$data['nim']?></li>
                <li><?=$data['kota']?></li>
                <li><?=$data['prodi']?></li>
                <li><?=$data['fakultas']?></li>
            </ul>
        </div>
        <div class="card card-prestasi">
            <div class="card-prestasi-text">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
                </svg>
                Prestasi Akademik
            </div>
            <div class="card-prestasi-ipk">
                IPK <br> <?=$data['ip_kumulatif']?>
            </div>
            <div class="card-prestasi-line"></div>
            <div class="card-prestasi-sks">
                SKS <br> <?=$data['jumlah_sks']?>
            </div>
        </div>
        <div class="card card-akademik">
            <div class="card-akademik-text">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                Status Akademik
            </div>
            <?php

            $query =$query = "SELECT user.username, mahasiswa.*, dosen.* FROM user JOIN mahasiswa ON user.user_id = mahasiswa.mahasiswa_id JOIN dosen ON dosen.kode_wali = mahasiswa.kode_wali WHERE user.username = '$username'";

            $sql_ppl= mysqli_query($db, $query) or die (mysqli_error($db));

            $data1 = mysqli_fetch_array ($sql_ppl);
            ?>
            <div class="card-akademik-dosen">
                <a>Dosen Wali</a>
                <li>Nama  : <?=$data1['nama']?></li>
                <li>NIP   : <?=$data1['nip']?></li>
                <li>Email : <?=$data1['email']?></li>
            </div>
            <div class="card-akademik-line"></div>
            <div class="card-akademik-semester">
                <ul>Semester Akademik</ul>
                <li><?=$data['angkatan']?></li>
                <ul>Semester Studi</ul>
                <li><?=$data['semester_aktif']?></li>
                <ul>Status Akademik</ul>
                <li><?=$data['status']?></li>
            </div>
        </div>
    </div>
    <br>
    <br>
    <script>
        function menuToggle(){
            const toggleMenu = document.querySelector('.ddmenu');
            toggleMenu.classList.toggle('active')
        }
    </script>
</body>
</html>