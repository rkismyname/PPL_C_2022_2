<!--  $koneksi = mysqli_connect("localhost","root","","ppl"); ?> -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../aset/bootstrap/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="../aset/css/style4.css">
    <title>Upload Mahasiswa Baru</title>


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
    //  $role=$_SESSION['operator_mahasiswa'];
    //  $query = "SELECT * FROM operator_mahasiswa
    //              INNER JOIN mahasiswa ON user.role=mahasiswa.role 
    //              WHERE user.role='$role'";

    if(isset( $_POST['submit']))
    {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $angkatan = $_POST['angkatan'];
    $status = $_POST['status'];
    $username = $_POST['uname'];
    $password = $_POST['psw'];
    $email = $_POST['email'];
    $kode_wali = $_POST['kode_wali'];
    $prodi = $_POST['status'];
    // $fakultas = $_POST['fakultas'];


    
    // $query = "SELECT * FROM 'operator_mahasiswa' ";
    // $sql_ppl= $db->insert($insert);
    // $data = $sql_ppl->fetch_array(); 
    
    $valid = true;

    // <script>
        if(empty($nama)){ 
        $error_nama = "nama harus diisi";
        $valid = false;
    
        }
        if(empty($nim)){
            $error_nim = "nim tidak boleh kosong";
            $valid = false;
        }
        elseif(is_numeric($nim)== FALSE){
            // return false;
            $error_nim2 = "nim harus angka";
            $valid = false;
        }

        elseif(strlen($nim) != 14){
            $error_nim3 = "nim harus 14 digit!";
            $valid = false;
        }
        
        if(empty($angkatan)){
            $error_angkatan = "tidak boleh kosong!";
            $valid = false;
        }
        elseif(is_numeric($angkatan) == FALSE){
            $error_angkatan2="angkatan harus angka!";
            $valid = false;
        }
        elseif(strlen($angkatan) != 4){
            $error_angkatan3 = "angkatan harus 4 digit!";
            $valid = false;
        }
        
        if($status == ''){
            $error_status = "pilih status mahasiswa!";
            $valid = false;
        }



        if($valid == true){
            $insert = mysqli_query($db,"INSERT INTO user (username,password,email,role) VALUES ('$username',MD5('$password'),'$email','mahasiswa')  ") && $insert = mysqli_query($db,"INSERT INTO mahasiswa (nim, nama, kode_wali, angkatan, status, prodi, fakultas) VALUES ('$nim', '$nama', '$kode_wali', '$angkatan', '$status', 'informatika', 'Fakultas Sains dan Matematika')");
        }
       
    
        }
    
        
    //  </script>
    $db->close();
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

    <h3>OPERATOR</h3>
    <form class="card card-mhs" method="post"> 
        <h2>Upload Mahasiswa Baru</h2>
        <br />
        NAMA: <input type="text" name = 'nama'id = 'nama'  maxlength="40"/>
        <div class='errornama'>
            <?php if (isset($error_nama)){
                echo $error_nama;
            }
            ?>
    </div>
        <br />
        NIM: <input type="text"  name = 'nim' id = 'nim'  maxlength="14"/> 
        <div class='errornim'>
            <?php if (isset($error_nim)){
                echo $error_nim;
            }
            elseif (isset($error_nim2)){
                echo $error_nim2;
            }
            elseif (isset($error_nim3)){
                echo $error_nim3;
            }
            ?>
    </div>
         <br />
        Angkatan: <input type="text" name = 'angkatan' id = 'angkatan'  maxlength="4"/>
        <div class='errorangkatan'>
            <?php if (isset($error_angkatan)){
                echo $error_angkatan;
            } else if (isset($error_angkatan2)){
                echo $error_angkatan2;
            }
            else if (isset($error_angkatan3)){
                echo $error_angkatan3;}
            ?>
        
        <br />
        Kode Wali: <input type="text" name = 'kode_wali' id = 'kode_wali'  maxlength="4"/>
        
    </div>

        <br />
        Status: <select name =  "status">
            <option value = ''>--Status Mahasiswa--</option>
            <option value = 'aktif'>Aktif</option>
            <option value = 'cuti'>Cuti</option>
            <option value = 'tidakaktif'>Tidak Aktif</option>
            </select>
            
     <div class='errorstatus'>
            <?php if (isset($error_status)){
                echo $error_status;
            }
            ?>
            
    <br />
        Password: <input type="text" name = 'psw' id = 'psw'  minlength ="4"/>
    <br />
    email: <input type="text" name='email' id='email' maxlength="40" />
        <div class='erroremail'>
            <?php if (isset($error_email)) {
                echo $error_email;
            }
            ?>
    <br />
        Username: <input type="text" name = 'uname' id = 'uname'  minlength ="4"/>
    

        </div>


    <!-- </div> -->

        <br />
        <button type="submit" class="btn btn-success" name="submit" value ="submit" style="width: 6rem; height: 2rem; margin-bottom: 1rem; left 40rem;">Submit
        <a href="data_mahasiswa.php" >
        <button type="button" class="btn btn-primary" style="width: 6rem; height: 2rem; margin-bottom: 1rem; left 40rem;">Back
        </button>
            </a>

        <!-- <a href="data_mahasiswa.php"></a> -->
        <!-- <button  value="Submit" name = "submit"onclick="validateForm()"></a> -->
    </form>
        </div>
        

    <div class="botom-line"></div>
</body>
</html>