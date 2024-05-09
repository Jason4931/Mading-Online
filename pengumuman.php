<main class="bg-body-secondary p-3">
    <h3 class="d-inline-block">Pengumuman</h3>
    <hr class="d-inline-block float-end w-75 d-none d-lg-block">
    <hr class="d-inline-block float-end w-50 d-none d-sm-block d-lg-none">
    <hr class="d-inline-block float-end w-25 d-block d-sm-none">
    <div class="row mb-3">
        <?php
        $sql = "SELECT * FROM `informasi` WHERE `kategori`='pengumuman' ORDER BY `tanggal` DESC";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result)>0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-2">
                    <a href="?menu=informasi">
                        <div class="card bg-dark text-white hover-scale">
                            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['gambar']).'" alt="Card image" style="height: 300px;">'; ?>
                            <img class="card-img-overlay p-0 w-100 h-100" src="./Image/DarkEff.png">
                            <div class="card-img-overlay d-flex flex-column justify-content-end">
                                <h5 class="card-title"><?=$row['judul']?></h5>
                                <p class="card-text"><?=$row['penulis']?> - <?=$row['tanggal']?></p>
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
    </div>
</main>