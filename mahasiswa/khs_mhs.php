<?php
    session_start();
    require_once('../db_login.php');

    if(isset($_POST['proses'])){

    $direktori = "file_khs/";
    $file_name=$_FILES['NamaFile']['name'];
    move_uploaded_file($_FILES['NamaFile']['tmp_name'],$direktori.$file_name);

    mysqli_query($db, "INSERT INTO dokumen_khs SET FILE='$file_name'");

    echo '<script language="javascript">';
    echo 'alert("Berhasil Upload")';
    echo '</script>';
    }
    
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
    $data = mysqli_fetch_array($sql_ppl);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../aset/css/style.css">
    <title>KHS Mahasiswa</title>
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
                <h3><?=$data['nama']?><br><span><?=$data['prodi']?></span></h3>
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
        <div class="card card-khs">
            <div class="text text-KHS" >KHS</div>
            <div class="border-khs">
                <div>Semester Aktif<br></div>
                <div class="form-group khs-form">
                    <div>
                        <input name="smt_aktif" id="smt_aktif" class="form-control" value="<?=$data['semester_aktif']?>"><br> 
                    </div>
                </div>
                <div>Jumlah SKS Semester<br></div>
                <div class="form-group khs-form">
                    <div>
                        <input name="sks_smt" id="sks_smt" class="form-control" value="<?=$data['jml_sks_sms']?>"><br> 
                    </div>
                </div>
                <div>Jumlah SKS Kumulatif<br></div>
                <div class="form-group khs-form">
                    <div>
                        <input name="total_sks" id="total_sks" class="form-control" value="<?=$data['jml_sks_kml']?>"><br> 
                    </div>
                </div>
                <div>IP Semester<br></div>
                <div class="form-group khs-form">
                    <div>
                        <input name="ips" id="ips" class="form-control" value="<?=$data['ip_semester']?>"><br> 
                    </div>
                </div>
                <div>IP Kumulatif<br></div>
                <div class="form-group khs-form">
                    <div>
                        <input name="ipk" id="ipk" class="form-control" value="<?=$data['ip_kumulatif']?>"><br> 
                    </div>
                </div>
            </div>    
            <div class="buttonkhs">
                Upload KHS
            </div>
            <form class="form-khs-action" action="" method="post" enctype="multipart/form-data">
                <input type="file" name="NamaFile">
                <br>
                <input class="button-submit"type="submit" name="proses" value="Upload">
            </form>
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