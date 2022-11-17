<?php
session_start();
require_once('../../db_login.php');

if(!isset($_SESSION['username'])){
    header('Location: ../../index.php');
}
if($_SESSION['role']=='mahasiswa'){
    header('Location: ../../mahasiswa/dashboard_mhs.php');
} 
if($_SESSION['role']=='dosen'){
    header('Location: ../../dosen/dashboard_dosen.php');
}
if($_SESSION['role']=='operator'){
    header('Location: ../../operator/dashboard_op.php');
} 

$username=$_GET['username'];

$query = "SELECT user.username, departemen.* FROM user JOIN departemen ON user.username = departemen.username WHERE user.username = '$username'";

$sql_ppl= mysqli_query($db, $query) or die (mysqli_error($db));
$data = mysqli_fetch_array ($sql_ppl);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../aset/css/style.css">
    <title>Dashboard Dosen</title>
</head>
<body>
    <div class="top">
        <div class="logo_undip">
            <img src="../../aset/img/PPL/logo-undip-01.png" alt="logo-undip-01.png">
        </div>

        <div class="ddaction">
            <div class="ddprofile" onclick="menuToggle();">
                <img src="../../aset/img/PPL/account.png" style="width:60px;height:auto; border-radius:50%;">
            </div>
            <div class="ddmenu">
                <h3><?=$data['nama']?><br><span><?=$data['prodi']?></span></h3>
                <ul>
                    <li><img src="../../aset/img/ppl/logout.png" style="width:50px;height:auto;"><a href="../../logout.php"> Logout </a></li>
                </ul>
            </div>
        </div>

        <div class="text">UNIVERSITAS DIPONEGORO</div>
    </div>

    <div class="bar">
        <div class="navbar">
            <a href="../index.php?username=<?=$username?>">Dashboard</a>
            <a href="data_dosen.php?username=<?=$username?>">Data Dosen</a>
            <div class="dropdown">
                <button class="dropbtn">Data Mahasiswa</button>
                <div class="dropdown-content">
                <a href="../data_mhs/data_mhs.php?username=<?=$username?>">Data Mahasiswa</a>
                <a href="../data_mhs/data_pkl_mhs.php?username=<?=$username?>">Data PKL Mahasiswa</a>
                <a href="../data_mhs/data_skripsi_mhs.php?username=<?=$username?>">Data SKRIPSI Mahasiswa</a>
                </div>
            </div>
        </div>
    </div>

    <div class="isi">
        <div class="bgdosen isi-bgmhs">
            <div class="search">
            </div>
            <div class="judul-isi-data">
                Data Dosen Informatika UNDIP
            </div>
            <div class="isi-data-mhs">
                <table>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Matkul</th>
                    </tr>
                    
                    <?php
                        $query = "SELECT user.username, departemen.*, dosen.* FROM user JOIN departemen ON user.username = departemen.username JOIN dosen WHERE user.username = '$username'";

                        $sql_ppl= mysqli_query($db, $query) or die (mysqli_error($db));

                        $i=1;
                        while ($data1 = mysqli_fetch_array($sql_ppl)) :
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?=$data1['nama']?></td>
                            <td><?=$data1['nip']?></td>
                            <td><?=$data1['matkul']?></td>
                        </tr>
                    <?php
                    $i++;
                    endwhile;
                    ?>
                </table>
            </div>
        </div>
    </div>

    <script>
        function menuToggle(){
            const toggleMenu = document.querySelector('.ddmenu');
            toggleMenu.classList.toggle('active')
        }
    </script>

</body>
</html>

