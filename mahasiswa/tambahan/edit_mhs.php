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
    <body>
    
    <div class="top">
        <div class="logo_undip">
            <img src="../aset/img/PPL/logo-undip-01.png" alt="logo-undip-01.png">
        </div>

        <div class="ddaction">
            <div class="ddprofile" onclick="menuToggle();">
                <?php
                require 'connection.php';
                
                if(isset($_FILES["image"]["name"])){
                    $id = $_POST["id"];
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
                        $query = "UPDATE tb_user SET image = '$newImageName' WHERE id = $id";
                        mysqli_query($conn, $query);
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
                <img src="img/<?php echo $image; ?>" width = 100% height = 125 title="<?php echo $image; ?>">
            </div>
            <div class="ddmenu">
                <h3>AYAYA <br><span>Informatika S1</span></h3>
                <ul>
                    <li><img src="../aset/img/ppl/edit.png" style="width:50px;height:auto;"><a href="edit_mhs.php"> Edit </a></li>
                    <li><img src="../aset/img/ppl/logout.png" style="width:50px;height:auto;"><a href="../index.php"> Logout </a></li>
                </ul>
            </div>
        </div>
            
        <div class="text">UNIVERSITAS DIPONEGORO</div>
    </div>

    <div class="bar">
        <div class="navbar">
            <a href="dashboard_mhs.php">Dashboard</a>
            <a href="irs_mhs.php">Data IRS</a>
            <a href="khs_mhs.php">Data KHS</a>
            <a href="pkl_mhs.php">PKL</a>
            <a href="skripsi_mhs.php">Skripsi</a>
        </div> 
    </div>

    <div class="edit-board">
        <div class="edit-isi-text">Edit</div>
        <div class="edit-isi">
            <div class="isi-profile">
                <form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
                    <div class="upload">
                        <?php
                        require 'connection.php';
                        $_SESSION["id"] = 1; // User's session
                        $sessionId = $_SESSION["id"];
                        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $sessionId"));
                        ?>
                        <?php
                        $id = $user["id"];
                        $name = $user["name"];
                        $image = $user["image"];
                        ?>
                        <img src="img/<?php echo $image; ?>" width = 100% height = 125 title="<?php echo $image; ?>">
                        <div class="round">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
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
                    $id = $_POST["id"];
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
                        $query = "UPDATE tb_user SET image = '$newImageName' WHERE id = $id";
                        mysqli_query($conn, $query);
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
            <div class="isi-data">    
                <ul for="nama">
                    Nama Lengkap 
                    <small style="color: red; margin-left: 10px">
                    *Tidak dapat diubah</small>
                    <li>
                        Kamisato AYAYA
                    </li>
                </ul>
                <ul for="nim">NIM
                <small style="color: red; margin-left: 10px">
                    *Tidak dapat diubah</small>
                    <li>
                        24060120120120
                    </li>
                </ul>
                <ul for="fakultas">Fakultas
                <small style="color: red; margin-left: 10px">
                    *Tidak dapat diubah</small>
                    <li>
                        Sains dan Matematika
                    </li>
                </ul>
                <ul for="prodi">Prodi
                <small style="color: red; margin-left: 10px">
                    *Tidak dapat diubah</small>
                    <li>
                        Informatika
                    </li>
                </ul>
                <ul for="angkatan">Angkatan
                <small style="color: red; margin-left: 10px">
                    *Tidak dapat diubah</small>
                    <li>
                        2020
                    </li>
                </ul>
                <ul for="alamat">Alamat
                    <ol>
                        <input
                        type="text"
                        name="alamat"
                        id="alamat"
                        value="Kamisato Klan"
                        />
                    </ol>
                </ul> 
                <ul for="kabupaten">Kabupaten/Kota
                    <ol>
                        <input
                        type="text"
                        name="kabupaten"
                        id="kabupaten"
                        value="Inazuma City"
                        />
                    </ol>
                </ul> 
                <ul for="provinsi">Provinsi
                    <ol>
                        <input
                        type="text"
                        name="provinsi"
                        id="provinsi"
                        value="Teyvat"
                        />
                    </ol>
                </ul> 
                <ul for="email">Email
                    <ol>
                        <input
                        type="text"
                        name="alamat"
                        id="alamat"
                        value="KamisatoAyaka@students.undip.ac.id"
                        />
                    </ol>
                </ul> 
                <ul for="nomor">Nomor HP
                    <ol>
                        <input
                        type="text"
                        name="nomor"
                        id="nomor"
                        value="085123564098"
                        />
                    </ol>
                </ul> 
                <a href="#" class="button-edit-data">Update</a>
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
</body>
  
</html>
