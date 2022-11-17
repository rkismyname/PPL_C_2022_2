<?php
$koneksi = mysqli_connect("localhost","root","","ppl");
?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../aset/bootstrap/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="../aset/css/style4.css">
    <title>data_mahasiswa</title>

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
    // $role=$_SESSION['role'];
    // $query = "SELECT * FROM user 
    //             INNER JOIN mahasiswa ON user.role=mahasiswa.role 
    //             WHERE user.role='$role'";

    
    $query = "SELECT * FROM operator_mahasiswa" ;
    $results= $db->query($query) ; 
    $query2 = "SELECT * FROM user";
    $results2 = $db->query($query2);
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
    <h2>DATA MAHASISWA</h2>
    <div class="card card-mhs">


    <label>urutkan berdasarkan : </label>

    <div class="option">
    <select>
        <option>No</option>
        <option>NIM</option>
        <option>Angkatan</option>
        <option>Status</option>

    </select>
    </div>

        <div class="tabel" style= "width 100%;height80%;overflow-y: scroll;margin-bottom : 2rem">
        <table class="table" style="width:100%;height:50%;border:0px solid;">
            <tr style="background-color: #add;border:0px solid;">
            <th>NO</th>
            <th>NIM</th>
            <th>NAMA</th>
            <th>Angkatan</th>
            <th>Status</th>
            <th>Email</th>
            </tr>

        <tr style="background-color: white; border:0px solid;">

            <?php $i=1; ?>
            <?php foreach ($results as $result): ?>
                <tr>
                    <td><?= $i ;?></td>
                    <td><?= $result["nimmhs"]; ?></td>
                    <td><?= $result["namamhs"]; ?></td>
                    <td><?= $result["angkatanmhs"]; ?></td>
                    <td><?= $result["statusmhs"]; ?></td>
                    


                </tr>
                <?php $i++ ;?>
            <?php endforeach;?>

        </table>
        </div>        

        <a href="upload_mahasiswa.php" >
        <button type="button" class="btn btn-primary" style="width: 6rem; height: 2rem; margin-bottom: 1rem; left 40rem;">Upload
        </button>
            </a>


            </div>
    </div>


    <div class="botom-line"></div>
</body>
</html>