<!DOCTYPE html>
<html lang="en" style="overflow-x: hidden;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mading Online</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            .hover-scale {
                transform: scale(1);
                transition: transform 0.3s ease;
            }
            .hover-scale:hover {
                transform: scale(1.02);
            }
            .hover-scale-sm {
                transform: scale(1);
                transition: transform 0.3s ease;
            }
            .hover-scale-sm:hover {
                transform: scale(1.01);
            }
            .placeholder-h3::-webkit-input-placeholder {
                font-size: 24px!important;
                font-weight: bold;
            }
            .placeholder-h5::-webkit-input-placeholder {
                font-size: 20px!important;
            }
        </style>
        <?php
            date_default_timezone_set("Asia/Jakarta");
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mading_online";
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            };
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            };
        ?>
    </head>
    <?php
    if(isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > (86400 * 7))) {
        session_unset();
        session_destroy();
    };
    $_SESSION['LAST_ACTIVITY'] = time();
    function tgl_indo($date){
        $bulan = array (
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $string = explode('-', $date);
        return $string[2] . ' ' . $bulan[(int)$string[1]] . ' ' . $string[0];
    }
    if(!isset($_SESSION['riwayat'])) {
        $_SESSION['riwayat'] = [];
    }
    if(isset($_POST['Nama']) && isset($_POST['Pass'])) {
        $sql = "SELECT * FROM `akun` WHERE `username`='$_POST[Nama]' AND `password`='$_POST[Pass]'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if (mysqli_num_rows($result)>0) {
            $_SESSION['Nama'] = $_POST['Nama'];
            header("Location: ?menu=admin-dashboard");
        }
        else {
            $fail = "Akun tidak ditemukan atau Password salah!";
        }
    }
    if(isset($_POST['like'])) {
        $name="like".$_POST["id"];
        setcookie($name, 1, time() + (86400 * 7), '/'); // 86400 = 1 day
        $likes=$_POST['likevalue']+1;
        $sql = "UPDATE `informasi` SET `like`='$likes' WHERE `id`='$_POST[id]'";
        $result = $conn->query($sql);
        if ($result) {
            header("Location: ./?menu=informasi&id=$_POST[id]");
        }
    } else if(isset($_POST['dislike'])) {
        $name="like".$_POST["id"];
        setcookie($name, 0, time() - (86400), '/'); // delete
        $likes=$_POST['likevalue']-1;
        $sql = "UPDATE `informasi` SET `like`='$likes' WHERE `id`='$_POST[id]'";
        $result = $conn->query($sql);
        if ($result) {
            header("Location: ./?menu=informasi&id=$_POST[id]");
        }
    }
    if(isset($_POST['comment'])) {
        $today = date("Y-m-d");
        $sql="INSERT INTO `komentar` (`informasi_id`, `nama`, `tanggal`, `komentar`) VALUES ('$_POST[id]', '$_POST[nama]', '$today', '$_POST[comment]')";
        $result = $conn->query($sql);
        if ($result) {
            header("Location: ./?menu=informasi&id=$_POST[id]");
        }
    }
    ?>
    <body class="p-0" style="overflow-x: hidden;">
        <?php
        if(isset($_GET['logout'])) {
            include "logout.php";
        } else if(!isset($_GET['menu'])) {
            $_GET['menu']=null;
        }
        switch ($_GET['menu']) {
            case "pengumuman":
                $active="pengumuman";
                include "header.php";
                include "pengumuman.php";
                break;
            case "kegiatan":
                $active="kegiatan";
                include "header.php";
                include "kegiatan.php";
                break;
            case "event":
                $active="event";
                include "header.php";
                include "event.php";
                break;
            case "pendaftaran":
                $active="pendaftaran";
                include "header.php";
                include "pendaftaran.php";
                break;
            case "informasi":
                $active="informasi";
                include "header.php";
                include "informasi.php";
                break;
            case "riwayat":
                $active="dashboard";
                include "header.php";
                include "riwayat.php";
                break;
            case "admin-createinformasi":
                if(isset($_SESSION["Nama"])) {
                    $active="informasi";
                    include "header.php";
                    include "admin-createinformasi.php";
                } else {
                    header("Location: ./");
                }
                break;
            case "admin-dashboard":
                if(isset($_SESSION["Nama"])) {
                    $active="dashboard";
                    include "header.php";
                    include "admin-dashboard.php";
                } else {
                    header("Location: ./");
                }
                break;
            case "admin-informasi":
                if(isset($_SESSION["Nama"])) {
                    $active="informasi";
                    include "header.php";
                    include "admin-informasi.php";
                } else {
                    header("Location: ./");
                }
                break;
            default:
                $active="dashboard";
                include "header.php";
                include "dashboard.php";
                break;
        }
        include "footer.php";
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>