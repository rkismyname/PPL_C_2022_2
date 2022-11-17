<?php
    session_start();
    require_once('../db_login.php');

    if(isset($_POST['proses'])){

    $direktori = "file_pkl/";
    $file_name=$_FILES['NamaFile']['name'];
    move_uploaded_file($_FILES['NamaFile']['tmp_name'],$direktori.$file_name);

    mysqli_query($db, "INSERT INTO dokumen_pkl SET FILE='$file_name'");

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

    $query = "SELECT user.username, mahasiswa.*, irs.*, khs.*, pkl.* FROM user JOIN mahasiswa ON user.user_id = mahasiswa.mahasiswa_id JOIN irs ON irs.irs_id = mahasiswa.irs_id JOIN khs ON khs.khs_id = mahasiswa.khs_id JOIN pkl ON pkl.pkl_id = mahasiswa.pkl_id WHERE user.username = '$username'";

    $sql_ppl= mysqli_query($db, $query) or die (mysqli_error($db));
    $data = mysqli_fetch_array ($sql_ppl);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../aset/css/style.css">
    <title>PKL Mahasiswa</title>
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
        <div class="card card-pkl">
            <div class="text text-PKL">PKL</div>
            <div class="border-pkl">
                <div>Status PKL</div>
                <div class="form-group pkl-form">
                    <div>
                    <input name="status_PKL" id="status_PKL" class="form-control" value="<?=$data['status_pkl']?>">
                    </div>
                </div>
                <div> Nilai PKL</div>
                <div class="form-group pkl-form">
                    <div>
                    <input name="nilai_PKL" id="nilai_PKL" class="form-control" value="<?=$data['nilai_pkl']?>">
                    </div>
                </div>
                <div class="buttonpkl">
                    <div class="buttonpkl-txt">
                        PKL
                    </div>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="NamaFile">
                    <input class="button-submit submit-pkl"type="submit" name="proses" value="Upload">
                </form>
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