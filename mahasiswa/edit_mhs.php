<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dashboard Mahasiswa</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../aset/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
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
    <body>
    
    <div class="top">
        <div class="logo_undip">
            <img src="../aset/img/PPL/logo-undip-01.png" alt="logo-undip-01.png">
        </div>

        <div class="ddaction">
            <div class="ddprofile" onclick="menuToggle();">
                <?php
                $_SESSION["profile_id"] = 1; // User's session
                $sessionId = $_SESSION["profile_id"];
                $query = "SELECT * FROM tb_user WHERE profile_id = $sessionId";
                $sql_ppl= mysqli_query($db, $query) or die (mysqli_error($db));
                $user = mysqli_fetch_assoc($sql_ppl);
                ?>
                <?php
                $id = $user["profile_id"];
                $name = $user["name"];
                $image = $user["image"];
                ?>
                <img src="img/<?php echo $image; ?>" style="width:60px;height:auto; border-radius:50%;"title="<?php echo $image; ?>">
 
            </div>
            <div class="ddmenu">
                    <h3><?=$data['nama'] ?><br><span><?=$data['prodi']?></span></h3>
                    <ul>
                        <li><img src="../aset/img/ppl/edit.png" style="width:50px;height:auto;"><a href="edit_mhs.php?username=<?=$username?>"> Edit </a></li>
                        <li><img src="../aset/img/ppl/logout.png" style="width:50px;height:auto;"><a href="../logout.php"> Logout </a></li>
                    </ul>
                </div>
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

    <div class="edit-board">
        <div class="edit-isi-text">Edit</div>
        <div class="edit-isi">
            <div class="isi-profile">
                <form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
                    <div class="upload">
                        <?php
                        $_SESSION["profile_id"] = 1; // User's session
                        $sessionId = $_SESSION["profile_id"];
                        $query = "SELECT * FROM tb_user WHERE profile_id = $sessionId";
                        $sql_ppl= mysqli_query($db, $query) or die (mysqli_error($db));
                        $user = mysqli_fetch_assoc($sql_ppl);

                        $id = $user["profile_id"];
                        $name = $user["name"];
                        $image = $user["image"];
                        ?>
                        <img src="img/<?php echo $image; ?>" width = 100% height = 125 title="<?php echo $image; ?>">
                        <div class="round">
                            <input type="hidden" name="profile_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="name" value="<?php echo $name; ?>">
                            <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png">
                            <i class = "fa fa-camera" style = "color: #fff;"></i>
                        </div>
                    </div>
                </form>
                <script type="text/javascript">
                    document.getElementById("image").onchange = function(){
                        document.getElementById("form").submit();
                    };
                </script>
                <?php
                if(isset($_FILES["image"]["name"])){
                    $id = $_POST["profile_id"];
                    $name = $_POST["name"];

                    $imageName = $_FILES["image"]["name"];
                    $imageSize = $_FILES["image"]["size"];
                    $tmpName = $_FILES["image"]["tmp_name"];

                    // Image validation
                    $validImageExtension = ['jpg', 'jpeg', 'png'];
                    $imageExtension = explode('.', $imageName);
                    $imageExtension = strtolower(end($imageExtension));
                    if (!in_array($imageExtension, $validImageExtension)){
                        echo
                        "
                        <script>
                        alert('Invalid Image Extension');
                        document.location.href = 'edit_mhs.php/;
                        </script>
                        ";
                    }
                    elseif ($imageSize > 1200000){
                        echo
                        "
                        <script>
                        alert('Image Size Is Too Large');
                        document.location.href = 'edit_mhs.php/;
                        </script>
                        ";
                    }
                    else{
                        $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
                        $newImageName .= '.' . $imageExtension;
                        $query = "UPDATE tb_user SET image = '$newImageName' WHERE profile_id = $id";
                        mysqli_query($query);
                        move_uploaded_file($tmpName, 'img/' . $newImageName);
                        echo
                        "
                        <script>
                        document.location.href = 'edit_mhs.php/;
                        </script>
                        ";
                    }
                }
                ?>    
            </div>
            <form class="isi-data" action="update-data-by-id.php" method="POST">
                <ul hidden for="mahasiswa_id">
                    <input
                    type="text"
                    name="mahasiswa_id"
                    value="<?=$data['mahasiswa_id']?>"
                    />
                </ul>
                    
                <ul for="nama">Nama Lengkap
                    <small style="color: red; margin-left: 10px" name="nim">*Tidak dapat diubah</small> 
                    <ol>
                        <input disabled
                        type="text"
                        name="nama"
                        value="<?=$data['nama']?>"
                        />
                    </ol>
                </ul>
                <ul for="nim">NIM
                <small style="color: red; margin-left: 10px" name="nim">*Tidak dapat diubah<br></small>
                    <ol>
                        <input disabled
                        type="text"
                        name="nim"
                        value="<?=$data['nim']?>"
                        />
                    </ol>
                </ul>
                <ul for="fakultas">Fakultas
                <small style="color: red; margin-left: 10px" name="fakultas">*Tidak dapat diubah</small>
                    <ol>
                        <input disabled
                        type="text"
                        name="fakultas"
                        value="<?=$data['fakultas']?>"
                        />
                    </ol>
                </ul>
                <ul for="prodi">Prodi
                    <small style="color: red; margin-left: 10px" name="prodi">*Tidak dapat diubah<br></small>
                    <ol>
                        <input disabled
                        type="text"
                        name="prodi"
                        value="<?=$data['prodi']?>"
                        />
                    </ol>
                </ul>
                <ul for="angkatan">Angkatan
                    <small style="color: red; margin-left: 10px">*Tidak dapat diubah</small>
                    <ol>
                        <input disabled
                        type="text"
                        name="angkatan"
                        value="<?=$data['angkatan']?>"
                        />
                    </ol>
                </ul>
                <ul for="alamat" name="alamat">Alamat
                    <ol>
                        <input
                        type="text"
                        name="alamat"
                        value="<?=$data['alamat']?>"
                        />
                    </ol>
                </ul> 
                <ul for="kota" name="kota">Kabupaten/Kota
                    <ol>
                        <input
                        type="text"
                        name="kota"
                        value="<?=$data['kota']?>"
                        />
                    </ol>
                </ul> 
                <ul for="provinsi" name="provinsi">Provinsi
                    <ol>
                        <input
                        type="text"
                        name="provinsi"
                        value="<?=$data['provinsi']?>"
                        />
                    </ol>
                </ul> 
                <ul for="email" name="email">Email
                    <ol>
                        <input
                        type="text"
                        name="email"
                        value="<?=$data['email']?>"
                        />
                    </ol>
                </ul> 
                <ul for="no_tlp" name="no_tlp">Nomor HP
                    <ol>
                        <input
                        type="text"
                        name="no_tlp"
                        value="<?=$data['no_tlp']?>"
                        />
                    </ol>
                </ul> 
                
                <button type="submit" name ="update" class="button-edit-data">Update</button>
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
