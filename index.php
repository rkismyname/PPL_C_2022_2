<?php
session_start();
require_once('db_login.php');

if(isset($_POST['login'])){
    $valid = TRUE;

    if($valid){
        $username = $_POST['uname'];
        $password = $_POST['psw'];

        $login = mysqli_query($db, "SELECT * FROM user WHERE username = '".$username."' AND password = '".md5($password)."'");
        $hitung = mysqli_num_rows($login);
         
        if($hitung>0){
            //kalo data ditemukan
            $data = mysqli_fetch_assoc($login);
    
            if($data['role'] == 'mahasiswa'){
                $_SESSION['username'] = $username;
                $_SESSION['role'] = 'mahasiswa';
                header("location:mahasiswa/dashboard_mhs.php?username=$username");
                exit;
                
            }else if($data['role'] == 'dosen'){
                $_SESSION['username'] = $username;
                $_SESSION['role'] = 'dosen';
                header("location:dosen/dashboard_dosen.php?username=$username");
                exit;
                
            }else if($data['role'] == 'departemen'){
                $_SESSION['username'] = $username;
                $_SESSION['role'] = 'departemen';
                header("location:departemen/index.php?username=$username");
                exit;

            }else if($data['role'] == 'operator'){
                $_SESSION['username'] = $username;
                $_SESSION['role'] = 'operator';
                header('location:operator/dashboard_op.php');
                exit;

            }
        }else{
            header("location:index.php?pesan=gagal");
        }
        $db->close();
    }
}
?>
    
<!DOCTYPE html>
<html lang="en">
    <head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="aset/css/style.css">
    
    </head>
    <body style="font-family: Arial, Helvetica, sans-serif;
                background-image: url('aset/img/ppl/download/vector.jpg');
                background-size:cover;">
        <div class="index_bg">
            <div class="index_logo">
                <h2 align="center" style="padding-top:50px;color:black;font-weight: 700;">Selamat Datang</h2>
                <form method="post">
                <div class="imgcontainer">
                    <img src="undip.png" alt="Avatar" class="avatar" style="width:75%;height:auto;">
                </div>
            </div>
            <div class="index_login">
                <h2 align="center" style="padding-bottom:10px; font-weight:bold;">Login</h2>      
                <label for="uname" style="margin-left: 30px;"><b>Username</b></label> <br>
                <input type="text" placeholder="Enter Username" name="uname" id="uname" required style="margin-left: 30px;padding-left: 10px;"> <br>
                <br>
                <label for="psw" style="margin-left: 30px;"><b>Password</b></label> <br>
                <input type="password" placeholder="Enter Password" name="psw" id="psw" required style="margin-left: 30px;padding-left: 10px;"><br>
                <br>
                <button type="submit" name="login">Login</button>
            </div>
        </div>
    </body>
</html>
