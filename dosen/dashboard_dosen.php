<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../aset/css/style.css">
    <title>Dashboard Dosen</title>
    <?php
    session_start();

    require_once('../db_login.php');

    if(!isset($_SESSION['username'])){
        header('Location: ../index.php');
    }
    if($_SESSION['role']=='mahasiswa'){
        header('Location: ../mahasiswa/dashboard_mhs.php');
    } 
    if($_SESSION['role']=='departemen'){
        header('Location: ../departemen');
    }
    if($_SESSION['role']=='operator'){
        header('Location: ../operator/dashboard_op.php');
    } 

    $username = $_GET['username'];

    $query = "SELECT user.username, dosen.* FROM user JOIN dosen ON user.username = dosen.username WHERE user.username = '$username'";
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
                <img src="../aset/img/PPL/note.jpg" style="width:60px;height:auto; border-radius:50%;">
            </div>
            <div class="ddmenu">
                <h3><?=$data['nama']?><br><span><?=$data['prodi']?></span></h3>
                <ul>
                    <li><img src="../aset/img/ppl/logout.png" style="width:50px;height:auto;"><a href="../logout.php"> Logout </a></li>
                </ul>
            </div>
        </div>

        <div class="text">UNIVERSITAS DIPONEGORO</div>
    </div>

    <div class="bar">
        <div class="navbar">
            <a href="dashboard_dosen.php?username=<?=$username?>">Dashboard</a>
            <a href="data_mhs.php?username=<?=$username?>">Data Mahasiswa</a>
            <a href="verif_irs.php?username=<?=$username?>">Data IRS Mahasiswa</a>
            <div class="dropdown">
                <button class="dropbtn">PKL Mahasiswa</button>
                <div class="dropdown-content">
                <a href="data_pkl.php?username=<?=$username?>">Data PKL Mahasiswa</a>
                <a href="data_pkl/daftar_lulus_pkl.php?username=<?=$username?>">Daftar Kelulusan Pkl Mahasiswa</a>
                <a href="data_pkl/rekap_progres_pkl.php?username=<?=$username?>">Daftar Progres PKL Mahasiswa</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Skripsi Mahasiswa</button>
                <div class="dropdown-content">
                <a href="data_skripsi.php?username=<?=$username?>">Data Skripsi Mahasiswa</a>
                <a href="data_skripsi/daftar_lulus_skripsi.php?username=<?=$username?>">Daftar Kelulusan Skripsi Mahasiswa</a>
                <a href="data_skripsi/rekap_progres_skripsi.php?username=<?=$username?>">Daftar Progres Skripsi Mahasiswa</a>
                </div>
            </div>
        </div>
    </div>
    <div class="isi">
        <div class="text-dashboard">Dashboard</div>
        <div class="card card-status">
            <img src="../aset/img/PPL/note.jpg">
            <div class="card-status-mhs">Aktif</div>
            <ul>
                <li style="font-weight: bold;"><?=$data['nama']?></li>
                <li><?=$data['nip']?></li>
                <li><?=$data['email']?></li>
                <li><?=$data['matkul']?></li>
                <li>Universitas Diponegoro</li>
            </ul>
        </div>
        <div class="card card-ipkmhs">
            <p>IPK Mahasiswa</p>
            <div class="ipkmhs-tipe card-ipkmhs-tipe1">
                <a>(1.00 - 2.25)</a>
                <br>
                <b>12,5%</b>
            </div>
            <div class="ipkmhs-tipe card-ipkmhs-tipe2">
                <a>(2.26 - 2.49)</a>
                <br>
                <b>20,3%</b>
            </div>
            <div class="ipkmhs-tipe card-ipkmhs-tipe3">
                <a>(2.50 - 2.99)</a>
                <br>
                <b>25,1%</b>
            </div>
            <div class="ipkmhs-tipe card-ipkmhs-tipe4">
                <a>(ipk > 3.00)</a>
                <br>
                <b>42,1%</b>
            </div>
        </div>

        <div class="card card-perwalian">
            <div class="card-perwalian-text">
                <a>Mahasiswa <br> Perwalian</a>
            </div>
            <div class="card-perwalian-aktif">
                <a>Aktif</a>
                <div class="card-perwalian-aktif-jumlah">
                    1
                </div>
            </div>
            <div class="card-perwalian-lain">
                <a>Lainnya</a>
                <div class="card-perwalian-lain-jumlah">
                    5
                </div>
            </div>
        </div>
    </div>
    <script>
        function menuToggle(){
            const toggleMenu = document.querySelector('.ddmenu');
            toggleMenu.classList.toggle('active')
        }
    </script>

    </script>
</body>
</html>