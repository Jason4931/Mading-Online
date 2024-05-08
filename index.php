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
                $_SESSION["Active"]="pengumuman";
                include "header.php";
                include "pengumuman.php";
                break;
            case "kegiatan":
                $_SESSION["Active"]="kegiatan";
                include "header.php";
                include "kegiatan.php";
                break;
            case "event":
                $_SESSION["Active"]="event";
                include "header.php";
                include "event.php";
                break;
            case "pendaftaran":
                $_SESSION["Active"]="pendaftaran";
                include "header.php";
                include "pendaftaran.php";
                break;
            case "informasi":
                $_SESSION["Active"]="informasi";
                include "header.php";
                include "informasi.php";
                break;
            case "riwayat":
                $_SESSION["Active"]="riwayat";
                include "header.php";
                include "riwayat.php";
                break;
            case "admin-createinformasi":
                if(isset($_SESSION["Nama"])) {
                    $_SESSION["Active"]="informasi";
                    include "header.php";
                    include "admin-createinformasi.php";
                } else {
                    $_SESSION["Active"]="dashboard";
                    include "header.php";
                    include "dashboard.php";
                }
                break;
            case "admin-dashboard":
                if(isset($_SESSION["Nama"])) {
                    $_SESSION["Active"]="dashboard";
                    include "header.php";
                    include "admin-dashboard.php";
                } else {
                    $_SESSION["Active"]="dashboard";
                    include "header.php";
                    include "dashboard.php";
                }
                break;
            case "admin-informasi":
                if(isset($_SESSION["Nama"])) {
                    $_SESSION["Active"]="informasi";
                    include "header.php";
                    include "admin-informasi.php";
                } else {
                    $_SESSION["Active"]="dashboard";
                    include "header.php";
                    include "dashboard.php";
                }
                break;
            default:
                $_SESSION["Active"]="dashboard";
                include "header.php";
                include "dashboard.php";
                break;
        }
        include "footer.php";
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>