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

$id = isset($_POST['mahasiswa_id']) ? $_POST['mahasiswa_id'] : ''; 

$alamat = test_input($_POST['alamat']);
if ($alamat == ''){
    $error_alamat = "Address is required";
    $valid = FALSE;
}

$kota = test_input($_POST['kota']);
if ($kota == ''){
    $error_kota = "kota is required";
    $valid = FALSE;
}

$provinsi = test_input($_POST['provinsi']);
if ($provinsi == ''){
    $error_provinsi = "provinsi is required";
    $valid = FALSE;
}
$email = test_input($_POST['email']);
if ($email == ''){
    $error_email = "email is required";
    $valid = FALSE;
}
$no_tlp = test_input($_POST['no_tlp']);
if ($no_tlp == ''){
    $error_no_tlp = "Nomor HP is required";
    $valid = FALSE;
}

if (!isset($_POST["update"])){
    echo "<script>console.log(".$id.")</script>";
    $query = " SELECT * FROM mahasiswa WHERE mahasiswa_id=" .$id. " ";
    //execute the query
    $result = $db->query($query);
    if (!$result){
        die ("Could not the query database: <br />" . $db->error);
    } else {
        while ($row = $result->fetch_object()){
            $id = $row->id;

            $alamat = $row->alamat;
            $kota = $row->kota;
            $provinsi = $row->provinsi;
            $email = $row->email;
            $no_tlp = $row->no_tlp;
        }
    }
} else{
    $valid = TRUE; //flag validasi

    //add data into database
    if ($valid){
        //escape inputs data
        // $alamat = mysqli_real_escape_string($alamat); //menghapus tanda petik
        //asign a query
        $query = " UPDATE mahasiswa SET alamat='".$alamat."', kota='".$kota."', provinsi='".$provinsi."', email='".$email."', no_tlp='".$no_tlp."' WHERE mahasiswa_id=".$id." ";
        //execute the query
        $result = $db->query($query);
        if (!$result){
            die ("Could not the query the database: <br>Query:" .$query);
        }else{
            header("Location: edit_mhs.php?username=$username");
            exit;
        }
    }
}
?>