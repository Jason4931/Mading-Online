<main class="bg-body-secondary p-3">
    <div class="row">
        <div class="col">
            <h3 class="d-flex align-items-center mt-2">Data Informasi</h3>
        </div>
        <div class="col text-end">
            <a href="?menu=admin-createinformasi" class="btn text-white m-2" style="background-color: #FF002E" tabindex="-1" role="button"
                aria-disabled="true">
                + Buat Informasi
            </a>
        </div>
    </div>
    <div class="d-flex align-items-center">
        <h6>Informasi yang paling dilike :⠀</h6>
        <h6 class="fw-normal">
            <?php
            $sql = "SELECT MAX(suka) AS max_items FROM informasi";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                $sqla = "SELECT * FROM `informasi` WHERE `suka`='$row[max_items]'";
                $resulta = $conn->query($sqla);
                while($rowa = $resulta->fetch_assoc()) {
                    echo $rowa['judul'];
                }
            }
            ?>
        </h6>
    </div>
    <div class="d-flex align-items-center mt-1">
        <h6>Banyaknya Informasi saat ini :⠀</h6>
        <h6 class="fw-normal">
            <?php
            $sql = "SELECT count(*) AS count FROM `informasi`";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                echo $row['count']." Informasi";
            }
            ?>
        </h6>
        <h6>
        <a class="mx-2 pb-0 fw-normal text-decoration-none" href="?menu=admin-dashboard-more&tipe=informasi">Lihat lebih banyak</a>
        </h6>
    </div>
    <h3 class="d-flex align-items-center mt-3">Data Siswa</h3>
    <div class="d-flex align-items-center">
        <h6>Banyaknya siswa yang telah mengunjungi website :⠀</h6>
        <h6 class="fw-normal">
            <?php
            $sql = "SELECT * FROM `kunjungan`";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                echo $row['jumlah']." Siswa";
            }
            ?>
        </h6>
    </div>
    <div class="d-flex align-items-center mt-1">
        <h6>Banyaknya komentar saat ini :⠀</h6>
        <h6 class="fw-normal">
            <?php
            $sql = "SELECT count(*) AS count FROM `komentar`";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                echo $row['count']." Komentar";
            }
            ?>
        </h6>
        <h6>
        <a class="mx-2 pb-0 fw-normal text-decoration-none" href="?menu=admin-dashboard-more&tipe=komentar">Lihat lebih banyak</a>
        </h6>
    </div>
    <h3 class="d-inline-block mt-3">Informasi Terkini</h3>
    <hr class="d-inline-block float-end w-75 d-none d-lg-block">
    <hr class="d-inline-block float-end w-50 d-none d-sm-block d-lg-none">
    <hr class="d-inline-block float-end w-25 d-block d-sm-none">
    <div class="row mb-3">
        <?php
        $sql = "SELECT * FROM `informasi` ORDER BY `tanggal` ASC LIMIT 20";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result)>0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-2">
                    <a href="?menu=admin-informasi&id=<?=$row['id']?>">
                        <div class="card bg-dark text-white hover-scale">
                            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['gambar']).'" class="card-img" alt="Card image" style="height: 300px;">'; ?>
                            <img class="card-img-overlay p-0 w-100 h-100" src="./Image/DarkEff.png">
                            <div class="card-img-overlay d-flex flex-column justify-content-end">
                                <h5 class="card-title"><?=$row['judul']?></h5>
                                <p class="card-text"><?=$row['penulis']?> - <?=tgl_indo($row['tanggal'])?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
        } else {
            ?><p class="fs-5">Tidak ada informasi untuk saat ini.</p><?php
        }
        ?>
        <!-- <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-2">
            <a href="#">
                <div class="card bg-dark text-white hover-scale">
                    <img class="card-img" src="./Image/Logo-BG.png" alt="Card image" style="height: 300px;">
                    <img class="card-img-overlay p-0 w-100 h-100" src="./Image/DarkEff.png">
                    <div class="card-img-overlay d-flex flex-column justify-content-end">
                        <h5 class="card-title">Peningkatan Layanan Kesehatan Palu Diapresiasi Menkes Budi</h5>
                        <p class="card-text">Jason4931 - 7 Januari 2024</p>
                    </div>
                </div>
            </a>
        </div> -->
    </div>
    <h3 class="d-inline-block">Riwayat</h3>
    <a href="?menu=riwayat" class="float-end ms-3 mt-1 text-decoration-none">Lihat Lebih</a>
    <hr class="d-inline-block float-end w-75 d-none d-lg-block">
    <hr class="d-inline-block float-end w-50 d-none d-sm-block d-lg-none">
    <hr class="d-inline-block float-end w-25 d-block d-sm-none">
    <div class="row">
        <?php
        foreach($_SESSION['riwayat'] as $riwayat) {
            $sql = "SELECT * FROM `informasi` WHERE `id`='$riwayat'";
            $result = $conn->query($sql);
            if (mysqli_num_rows($result)>0) {
                while($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-12 col-lg-4 col-sm-6 mt-2">
                        <a href="?menu=admin-informasi&id=<?=$row['id']?>">
                            <div class="card bg-dark text-white hover-scale">
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['gambar']).'" class="card-img" alt="Card image" style="height: 200px;">'; ?>
                                <img class="card-img-overlay p-0 w-100 h-100" src="./Image/DarkEff.png">
                                <div class="card-img-overlay d-flex flex-column justify-content-end">
                                    <h5 class="card-title"><?=$row['judul']?></h5>
                                    <p class="card-text"><?=$row['penulis']?> - <?=tgl_indo($row['tanggal'])?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            }
        }
        if(empty($_SESSION['riwayat'])) {
            ?><p class="fs-5">Tidak ada riwayat informasi.</p><?php
        }
        ?>
        <!-- <div class="col-12 col-lg-4 col-sm-6 mt-2">
            <a href="#">
                <div class="card bg-dark text-white hover-scale">
                    <img class="card-img" src="./Image/LogoRPL.jpg" alt="Card image" style="height: 200px;">
                    <img class="card-img-overlay p-0 w-100 h-100" src="./Image/DarkEff.png">
                    <div class="card-img-overlay d-flex flex-column justify-content-end">
                        <h5 class="card-title">Peningkatan Layanan Kesehatan Palu Diapresiasi Menkes Budi</h5>
                        <p class="card-text">Jason4931 - 7 Januari 2024</p>
                    </div>
                </div>
            </a>
        </div> -->
    </div>
</main>
