<main class="bg-body-secondary p-3">
    <?php if($_GET['tipe']=='informasi') { ?>
        <h3 class="d-inline-block">Informasi</h3>
    <?php } else { ?>
        <h3 class="d-inline-block">Komentar</h3>
    <?php } ?>
    <a href="?menu=admin-dashboard" class="float-end ms-3 mt-1 text-decoration-none">Kembali</a>
    <hr class="d-inline-block float-end w-75 d-none d-lg-block">
    <hr class="d-inline-block float-end w-50 d-none d-sm-block d-lg-none">
    <hr class="d-inline-block float-end w-25 d-block d-sm-none">
    <div class="row mb-2">
        <?php
        if($_GET['tipe']=='informasi') {
            $sql = "SELECT * FROM `informasi` WHERE `accept`=1 ORDER BY `tanggal` DESC";
        } else {
            $sql = "SELECT * FROM `komentar` ORDER BY `tanggal` DESC";
        }
        $result = $conn->query($sql);
        if (mysqli_num_rows($result)>0) {
            while($row = $result->fetch_assoc()) {
                if($_GET['tipe']=='informasi') {
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
                } else {
                    ?>
                    <div class="col-12">
                        <div class="d-flex align-items-center border rounded p-2 mb-2 bg-white hover-scale-sm">
                            <div class="ms-3 me-4">
                                <img src="./image/Profile.png" width="60">
                            </div>
                            <div class="mt-2 flex-grow-1">
                                <h5><?=$row['nama']?> - <?=tgl_indo($row['tanggal'])?></h5>
                                <p><?=$row['komentar']?></p>
                            </div>
                            <div class="me-4">
                                <input type="image" src="./image/Trash.svg" alt="trash" width="27" data-bs-toggle="modal" data-bs-target="#exampleModal<?=$row['id']?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal<?=$row['id']?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                <h1 class="modal-title fs-5 text-center w-100" id="ModalLabel">Apakah Anda Yakin?</h1>
                                </div>
                                <div class="modal-footer d-flex justify-content-center border-0">
                                    <button type="button" class="btn text-white w-100 mx-2" data-bs-dismiss="modal" style="background-color: #FF002E; max-width: 150px;">Tidak</button>
                                    <form action="./" method="post" class="w-100" style="max-width: 150px;">
                                        <input type="number" name="id" value="<?=$row['id']?>" hidden>
                                        <input type="text" name="delcomment" hidden>
                                        <input type="submit" class="btn text-white w-100 mx-2" style="background-color: #009900;" value="Ya">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
        } else {
            if($_GET['tipe']=='informasi') { ?>
                <p class="fs-5">Tidak ada informasi.</p>
            <?php } else { ?>
                <p class="fs-5">Tidak ada komentar.</p>
            <?php }
        }
        ?>
    </div>
    <?php
    if($_GET['tipe']=='informasi') {
        $sql = "SELECT * FROM `informasi` WHERE `accept`=0 ORDER BY `tanggal` DESC";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result)>0) {
            ?>
            <h3 class="d-inline-block">Informasi yang belum diterima</h3>
            <hr class="d-inline-block float-end w-50 d-none d-md-block">
            <hr class="d-inline-block float-end w-25 d-none d-sm-block d-md-none">
            <div class="row">
                <?php
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
                ?>
            </div>
            <?php
        }
    }
    ?>
</main>