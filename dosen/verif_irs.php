<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../aset/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Data Mahasiswa</title>
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
    $data1 = mysqli_fetch_array ($sql_ppl);

    

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
                <h3><?=$data1['nama']?><br><span><?=$data1['prodi']?></span></h3>
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
        <div class="bgdosen isi-bgmhs">
            <div class="search">
            </div>
            <div class="judul-isi-data judul-data-irs">
                Data IRS Mahasiswa
            </div>
            <div class="isi-data-mhs">
                <table>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Status IRS</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $query = "SELECT user.username, dosen.*, mahasiswa.*, irs.* FROM user join dosen ON user.username = dosen.username JOIN mahasiswa ON mahasiswa.kode_wali = dosen.kode_wali JOIN irs ON irs.irs_id = mahasiswa.irs_id WHERE user.username = '$username'";
                        
                        $sql_ppl= mysqli_query($db, $query) or die (mysqli_error($db));
                        
                        $i=1;
                        while ($data = mysqli_fetch_array($sql_ppl)) :
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?=$data['nama']?></td>
                            <td><?=$data['nim']?></td>
                            <td><?=$data['status_irs']?></td>
                            <td> <button style="padding:auto; width:fit-content;height:fit-content;">verif</button></td>
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