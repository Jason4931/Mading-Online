<main class="bg-body-secondary p-3">
    <h3 class="d-inline-block">Riwayat</h3>
    <a href="?menu=dashboard" class="float-end ms-3 mt-1 text-decoration-none">Kembali</a>
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
                        <a href="?menu=informasi&id=<?=$row['id']?>">
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
    </div>
</main>