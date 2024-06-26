<main class="bg-body-secondary p-3">
    <h3 class="d-inline-block">
        <?php
        if($_GET['tipe'] == "pengumuman") { 
            echo "Pengumuman";
        } else if($_GET['tipe'] == "kegiatan") {
            echo "Kegiatan Sekolah";
        } else if($_GET['tipe'] == "event") {
            echo "Event & Lomba";
        } else if($_GET['tipe'] == "pendaftaran") {
            echo "Pendaftaran Siswa";
        } else if($_GET['tipe'] == "lainnya") {
            echo "Lainnya";
        }
        ?>
    </h3>
    <hr class="d-inline-block float-end w-75 d-none d-lg-block">
    <hr class="d-inline-block float-end w-50 d-none d-sm-block d-lg-none">
    <hr class="d-inline-block float-end w-25 d-block d-sm-none">
    <div class="row mb-3">
        <?php
        $sql = "SELECT * FROM `informasi` WHERE `kategori`='$_GET[tipe]' AND `accept`=1 ORDER BY `tanggal` ASC";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result)>0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-2">
                    <?php if(isset($_SESSION["Nama"])) { ?>
                        <a href="?menu=admin-informasi&id=<?=$row['id']?>">
                            <div class="card bg-dark text-white hover-scale">
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['gambar']).'" alt="Card image" style="height: 300px;">'; ?>
                                <img class="card-img-overlay p-0 w-100 h-100" src="./Image/DarkEff.png">
                                <div class="card-img-overlay d-flex flex-column justify-content-end">
                                    <h5 class="card-title"><?=$row['judul']?></h5>
                                    <p class="card-text"><?=$row['penulis']?> - <?=$row['tanggal']?></p>
                                </div>
                            </div>
                        </a>
                    <?php } else { ?>
                        <a href="?menu=informasi&id=<?=$row['id']?>">
                            <div class="card bg-dark text-white hover-scale">
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['gambar']).'" alt="Card image" style="height: 300px;">'; ?>
                                <img class="card-img-overlay p-0 w-100 h-100" src="./Image/DarkEff.png">
                                <div class="card-img-overlay d-flex flex-column justify-content-end">
                                    <h5 class="card-title"><?=$row['judul']?></h5>
                                    <p class="card-text"><?=$row['penulis']?> - <?=$row['tanggal']?></p>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
                <?php
            }
        } else {
            ?><p class="fs-5">Tidak ada informasi untuk saat ini.</p><?php
        }
        ?>
    </div>
</main>