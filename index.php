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
    if(isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > (86400 * 3))) {
        session_unset();
        session_destroy();
        $sql = "SELECT * FROM `kunjungan`";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result)>0) {
            while($row = $result->fetch_assoc()) {
                $pengunjung=$row['jumlah']+1;
                $sqla="UPDATE `kunjungan` SET `jumlah`='$pengunjung'";
                $resulta = $conn->query($sqla);
            }
        }
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
        setcookie($name, 1, time() + (86400 * 3), '/'); // 86400 = 1 day
        $likes=$_POST['likevalue']+1;
        $sql = "UPDATE `informasi` SET `suka`='$likes' WHERE `id`='$_POST[id]'";
        $result = $conn->query($sql);
        if ($result) {
            if(isset($_SESSION["Nama"])) {
                header("Location: ./?menu=admin-informasi&id=$_POST[id]");
            } else {
                header("Location: ./?menu=informasi&id=$_POST[id]");
            }
        }
    } else if(isset($_POST['dislike'])) {
        $name="like".$_POST["id"];
        setcookie($name, 0, time() - 86400, '/'); // delete
        $likes=$_POST['likevalue']-1;
        $sql = "UPDATE `informasi` SET `suka`='$likes' WHERE `id`='$_POST[id]'";
        $result = $conn->query($sql);
        if ($result) {
            if(isset($_SESSION["Nama"])) {
                header("Location: ./?menu=admin-informasi&id=$_POST[id]");
            } else {
                header("Location: ./?menu=informasi&id=$_POST[id]");
            }
        }
    }
    if(isset($_POST['comment'])) {
        $today = date("Y-m-d");
        $sql="INSERT INTO `komentar` (`informasi_id`, `nama`, `tanggal`, `komentar`) VALUES ('$_POST[id]', '$_POST[nama]', '$today', '$_POST[comment]')";
        $result = $conn->query($sql);
        if ($result) {
            if(isset($_SESSION["Nama"])) {
                header("Location: ./?menu=admin-informasi&id=$_POST[id]");
            } else {
                header("Location: ./?menu=informasi&id=$_POST[id]");
            }
        }
    }
    if(isset($_POST['createinfo'])) {
        $today = date("Y-m-d");
        if ($_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $gambar = file_get_contents($_FILES['gambar']['tmp_name']);
        } else {
            echo "Error uploading gambar: " . $_FILES['gambar']['error'];
            exit;
        }
        if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $file = file_get_contents($_FILES['file']['tmp_name']);
            $hasFile = true;
        } else {
            $hasFile = false;
        }
        $sql = "INSERT INTO `informasi` (`judul`, `penulis`, `tanggal`, `gambar`, `isi`, `kategori`, `suka`";
        if ($hasFile) {
            $sql .= ", `file`";
        }
        $sql .= ") VALUES (?,?,?,?,?,?,?";
        if ($hasFile) {
            $sql .= ",?";
        }
        $sql .= ")";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            echo "Error preparing statement: " . $conn->error;
            exit;
        }
        $params = [
            $_POST['judul'],
            $_POST['penulis'],
            $today,
            $gambar,
            $_POST['isi'],
            $_POST['kategori'],
            0
        ];
        if ($hasFile) {
            $params[] = $file;
        }
        $stmt->bind_param(str_repeat("s", count($params)), ...$params);
        if (!$stmt->execute()) {
            echo "Error executing query: " . $stmt->error;
            exit;
        }
        header("Location: ./?menu=admin-dashboard");
        exit;
    }
    if(isset($_POST['delinfo'])) {
        $sql="DELETE FROM `informasi` WHERE `id`='$_POST[id]'";
        $result = $conn->query($sql);
        unset($_SESSION['riwayat'][$_POST['id']]);
        if ($result) {
            header("Location: ./?menu=admin-dashboard");
        }
    }
    if(isset($_POST['delcomment']) || isset($_POST['delcommentinfo'])) {
        $sql="DELETE FROM `komentar` WHERE `id`='$_POST[id]'";
        $result = $conn->query($sql);
        if ($result) {
            if(isset($_POST['delcommentinfo'])) {
                header("Location: ./?menu=admin-informasi&id=$_POST[idinfo]");
            } else {
                header("Location: ./?menu=admin-dashboard-more&tipe=komentar");
            }
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
                $active="informasi";
                include "header.php";
                if(isset($_SESSION["Nama"])) {
                    include "admin-createinformasi.php";
                } else {
                    include "dashboard.php";
                }
                break;
            case "admin-dashboard":
                $active="dashboard";
                include "header.php";
                if(isset($_SESSION["Nama"])) {
                    include "admin-dashboard.php";
                } else {
                    include "dashboard.php";
                }
                break;
            case "admin-informasi":
                $active="informasi";
                include "header.php";
                if(isset($_SESSION["Nama"])) {
                    include "admin-informasi.php";
                } else {
                    include "dashboard.php";
                }
                break;
            case "admin-dashboard-more":
                $active="dashboard";
                include "header.php";
                if(isset($_SESSION["Nama"])) {
                    include "admin-dashboard-more.php";
                } else {
                    include "dashboard.php";
                }
                break;
            default:
                $active="dashboard";
                include "header.php";
                if(isset($_SESSION["Nama"])) {
                    include "admin-dashboard.php";
                } else {
                    include "dashboard.php";
                }
                break;
        }
        include "footer.php";
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>