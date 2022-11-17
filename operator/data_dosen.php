<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../aset/bootstrap/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="../aset/css/style4.css">
    <title>Dashboard Mahasiswa</title>


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

    //ganti nama dbnya
    $query = "SELECT * FROM operator_dosen";
    $results= $db->query($query); 
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
    <h2>DATA DOSEN</h2>
    <div class="card">
        


    <label>urutkan berdasarkan : </label>

    <div class="option">
    <select>
        <option>No</option>
        <option>NIP</option>
        <option>Nama</option>
        <option>Mata Kuliah</option>


    </select>
    </div>


        <table class="table" style="width:100%;border:1px solid; top: 10px;padding: top 10px;">
            <tr style="background-color: #add;border:1px solid;">
            <th>NO</th>
            <th>NIP</th>
            <th>NAMA</th>
            <th>E-MAIL</th>
            <th>MATA KULIAH</th>
            </tr>

            <tr style="background-color: white; border:1px solid;">
            <?php $i=1; ?>
            <?php foreach ($results as $result) :?>
                <tr>
                    <!-- samain sama nama tabel di db dosennya -->
                    <td><?= $i ;?></td>
                    <td><?= $result["nip"]; ?></td>
                    <td><?= $result["nama"]; ?></td>
                    <td><?= $result["email"]; ?></td>
                    <td><?= $result["matkul"]; ?></td>

                </tr>
                <?php $i++ ;?>
            <?php endforeach ;?>
            </tr>

        </table>



        <a href="upload_dosen.php" >
        <button type="button" class="btn btn-primary" style="width: 6rem; height: 2rem; margin-bottom: 1rem; left 40rem;">Upload
        </button>
            </a>



    </div>


    <div class="botom-line"></div>
</body>
</html>