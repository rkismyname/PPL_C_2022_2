<?php
session_start();

require_once('../../db_login.php');

if(!isset($_SESSION['username'])){
    header('Location: ../../index.php');
}
if($_SESSION['role']=='mahasiswa'){
    header('Location: ../../mahasiswa/dashboard_mhs.php');
} 
if($_SESSION['role']=='departemen'){
    header('Location: ../../departemen');
}
if($_SESSION['role']=='operator'){
    header('Location: ../../operator/dashboard_op.php');
} 

$username = $_GET['username'];

$query = "SELECT * FROM dosen";
$sql_ppl= mysqli_query($db, $query) or die (mysqli_error($db));
$data = mysqli_fetch_array ($sql_ppl);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../aset/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Data Mahasiswa</title>
</head>
<body>
    <div class="top">
        <div class="logo_undip">
            <img src="../../aset/img/PPL/logo-undip-01.png" alt="logo-undip-01.png">
        </div>

        <div class="ddaction">
            <div class="ddprofile" onclick="menuToggle();">
                <img src="../../aset/img/PPL/note.jpg" style="width:60px;height:auto; border-radius:50%;">
            </div>
            <div class="ddmenu">
                <h3><?=$data['nama']?><br><span><?=$data['prodi']?></span></h3>
                <ul>
                    <li><img src="../../aset/img/ppl/logout.png" style="width:50px;height:auto;"><a href="../../logout.php"> Logout </a></li>
                </ul>
            </div>
        </div>

        <div class="text">UNIVERSITAS DIPONEGORO</div>
    </div>

    <div class="bar">
        <div class="navbar">
            <a href="../dashboard_dosen.php?username=<?=$username?>">Dashboard</a>
            <a href="../data_mhs.php?username=<?=$username?>">Data Mahasiswa</a>
            <a href="../verif_irs.php?username=<?=$username?>">Data IRS Mahasiswa</a>
            <div class="dropdown">
                <button class="dropbtn">PKL Mahasiswa</button>
                <div class="dropdown-content">
                <a href="../data_pkl.php?username=<?=$username?>">Data PKL Mahasiswa</a>
                <a href="../data_pkl/daftar_lulus_pkl.php?username=<?=$username?>">Daftar Kelulusan Pkl Mahasiswa</a>
                <a href="../data_pkl/rekap_progres_pkl.php?username=<?=$username?>">Daftar Progres PKL Mahasiswa</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Skripsi Mahasiswa</button>
                <div class="dropdown-content">
                <a href="../data_skripsi.php?username=<?=$username?>">Data Skripsi Mahasiswa</a>
                <a href="../data_skripsi/daftar_lulus_skripsi.php?username=<?=$username?>">Daftar Kelulusan Skripsi Mahasiswa</a>
                <a href="../data_skripsi/rekap_progres_skripsi.php?username=<?=$username?>">Daftar Progres Skripsi Mahasiswa</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    $query = "SELECT * FROM mahasiswa";
    $sql_ppl= mysqli_query($db, $query) or die (mysqli_error($db));
    $data = mysqli_fetch_array ($sql_ppl);
    $nbsp = ', '

    ?>
    <div class="isi">
        <div class="bgdosen isi-bgmhs isi-bgmhs-in">
            <h2 style="text-align:center;padding-bottom:10px;">Data Mahasiswa</h2>
            <div class="isi-datadiri">
                <div class="isi-datadiri-foto">
                    <img src="../../aset/img/ppl/ayaya.jpeg">
                </div>
                <div class="isi-datadiri-text">
                    <ul>
                        <li style="font-weight: bold;text-align:center; font-size: 18px;"><?=$data['nama']?></li>
                        <li><?=$data['nim']?></li>
                        <li><?=$data['alamat'], $nbsp, $data['kota']?></li>
                        <li><?=$data['prodi']?></li>
                        <li>Universitas Diponegoro</li>
                    </ul>
                </div>
            </div>

            <div class="isi-dataakademik">
                <div class="isi-dataakademik-smt">
                    <!-- Semester 1 -->
                    <form action="semester_1.php">
                        <input type="submit" class="semester semester-1" value="Semester 1" />
                    </form>
                    <!-- Semester 2 -->
                    <form action="semester_2.php">
                        <input type="submit" class="semester semester-2" value="Semester 2" />
                    </form>
                    <!-- Semester 3 -->
                    <form action="semester_3.php">
                        <input type="submit" class="semester semester-3" value="Semester 3" />
                    </form>
                    <!-- Semester 4 -->
                    <form action="semester_4.php">
                        <input type="submit" class="semester semester-4" value="Semester 4" />
                    </form>
                    <!-- Semester 5 -->
                    <form action="semester_5.php">
                        <input type="submit" class="semester semester-5" value="Semester 5" />
                    </form>
                    <!-- Semester 6 -->
                    <form action="semester_6.php">
                        <input type="submit" class="semester semester-6" value="Semester 6" />
                    </form>
                    <!-- Semester 7 -->
                    <form action="semester_7.php">
                        <input type="submit" class="semester semester-7" value="Semester 7" />
                    </form>
                    <!-- Semester 8 -->
                    <form action="semester_8.php">
                        <input type="submit" class="semester semester-8" value="Semester 8" />
                    </form>
                    <!-- Semester 9 -->
                    <form action="semester_9.php">
                        <input type="submit" class="semester semester-9" value="Semester 9" />
                    </form>
                    <!-- Semester 10 -->
                    <form action="semester_10.php">
                        <input type="submit" class="semester semester-10" value="Semester 10" />
                    </form>
                    <!-- Semester 11 -->
                    <form action="semester_11.php">
                        <input type="submit" class="semester semester-11" value="Semester 11" />
                    </form>
                    <!-- Semester 12 -->
                    <form action="semester_12.php">
                        <input type="submit" class="semester semester-12" value="Semester 12" />
                    </form>
                    <!-- Semester 13 -->
                    <form action="semester_13.php">
                        <input type="submit" class="semester semester-13" value="Semester 13" />
                    </form>
                    <!-- Semester 14 -->
                    <form action="semester_14.php">
                        <input type="submit" class="semester semester-14" value="Semester 14" />
                    </form>

                </div>
                <div class="isi-dataakademik-nilai">
                    <div class="isi-dataakademik-nilai-data">
                        <div style="display:flex;">
                            <div class="nilai-data nilai-data-irs">
                                IRS
                                <br>
                                <div style="margin: 25px 0;font-size: 20px;"> berapa SKS </div>
                                <form action="#">
                                    <input type="submit" style="border-radius:5px; border: 0.5px solid; background: #42C9C980;" 
                                    value="Lihat Dokumen" />
                                </form>
                            </div>
                            <div class="nilai-data nilai-data-khs">
                                KHS
                                <div style="text-align:left; font-size:14px; margin:5px;">
                                    <div>SKS Semester : </div>
                                    <div>IP Semester : </div>
                                    <div>SKS kumulatif : </div>
                                    <div>IP kumulatif :</div>
                                </div>
                                <form action="#">
                                    <input type="submit" style="border-radius:5px; border: 0.5px solid;  background: #42C9C980;"
                                    value="Lihat Dokumen" />
                                </form>
                            </div>
                        </div>
                        <div style="display:flex;">
                            <div class="nilai-data nilai-data-pkl">
                                PKL
                                <div style="display:flex; font-size:16px; margin:15px 10px;">
                                    <div style="margin: 0 auto 0 10px;">
                                        Nilai
                                        <br>
                                        -
                                    </div>
                                    <div style="margin: 0 10px 0 auto;">
                                        Status
                                        <br>
                                        -
                                    </div>
                                </div>
                                <form action="#">
                                    <input type="submit" style="border-radius:5px; border: 0.5px solid;  background: #42C9C980;"
                                    value="Lihat Dokumen" />
                                </form>
                            </div>
                            <div class="nilai-data nilai-data-skripsi">
                                SKRIPSI
                                <div style="display:flex; font-size:16px; margin:15px 10px;">
                                    <div style="margin: 0 auto 0 10px;">
                                        Nilai
                                        <br>
                                        -
                                    </div>
                                    <div style="margin: 0 10px 0 auto;">
                                        Status
                                        <br>
                                        -
                                    </div>
                                </div>
                                <form action="#">
                                    <input type="submit" style="border-radius:5px; border: 0.5px solid;  background: #42C9C980;"
                                    value="Lihat Dokumen" />
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="isi-dataakademik-nilai-des">
                        <div style="display:flex;">
                            <div class="des-b">
                                <div class="des-box des-box-b"></div>
                                Sudah diisikan (IRS dan KHS)
                            </div>
                            <div class="des-r">
                                <div class="des-box des-box-r"></div>
                                Belum diisi atau tidak digunakan
                            </div>
                        </div>
                        <div style="display:flex;">
                            <div class="des-g">
                                <div class="des-box des-box-g"></div>
                                Sudah lulus skripsi
                            </div>
                            <div class="des-y">
                                <div class="des-box des-box-y"></div>
                                Sudah lulus PKL
                            </div>
                        </div>
                    </div>
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