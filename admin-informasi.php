<main class="bg-body-secondary p-3">
    <?php $profile = [
        "./Image/Profile/Guest.png",
        "./Image/Profile/Coder.png",
        "./Image/Profile/Profile1.png",
        "./Image/Profile/Profile2.png",
        "./Image/Profile/Profile3.png",
        "./Image/Profile/Profile4.png",
        "./Image/Profile/Profile5.png",
        "./Image/Profile/Profile6.png",
        "./Image/Profile/Profile7.png",
        "./Image/Profile/Profile8.png",
        "./Image/Profile/Profile9.png",
        "./Image/Profile/Profile10.png",
        "./Image/Profile/Profile11.png",
        "./Image/Profile/Profile12.png",
        "./Image/Profile/Profile13.png",
        "./Image/Profile/Profile14.png",
        "./Image/Profile/Profile15.png",
        "./Image/Profile/Profile16.png",
        "./Image/Profile/Profile17.png",
        "./Image/Profile/Profile18.png",
        "./Image/Profile/Profile19.png",
        "./Image/Profile/Profile20.png",
        "./Image/Profile/Profile21.png",
        "./Image/Profile/Profile22.png",
        "./Image/Profile/Profile23.png",
        "./Image/Profile/Profile24.png",
        "./Image/Profile/Profile25.png",
        "./Image/Profile/Profile26.png",
        "./Image/Profile/Profile27.png",
        "./Image/Profile/Profile28.png"
    ]; ?>
    <div class="card mb-2">
        <?php
        $_SESSION['riwayat'][$_GET['id']]=$_GET['id'];
        if(isset($_GET['id'])) {
            $sql = "SELECT * FROM `informasi` WHERE `id`='$_GET[id]'";
            $result = $conn->query($sql);
            if (mysqli_num_rows($result)>0) {
                while($row = $result->fetch_assoc()) {
                    $accept=$row['accept'];
                    ?>
                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['gambar']).'" class="card-img-top w-100" alt="Foto">'; ?>
                    <div class="card-body">
                        <h3 class="card-title"><?=$row['judul']?></h3>
                        <div class="row">
                            <div class="col-8 align-items-center d-flex">
                                <h5 class="card-subtitle text-body-secondary"><?=$row['penulis']?> - <?=tgl_indo($row['tanggal'])?></h5>
                            </div>
                            <div class="col-4">
                                <?php if($accept == 1) { ?>
                                    <div class="float-end d-inline-block align-items-center d-flex">
                                        <p class="fs-5 mb-0 me-1 d-inline-block"><?=$row['suka']?></p>
                                        <?php $name = "like".$_GET['id'];
                                        if(isset($_COOKIE[$name])) { ?>
                                            <form action="./" method="post">
                                                <input type="number" name="id" value="<?=$_GET['id']?>" hidden>
                                                <input type="number" name="likevalue" value="<?=$row['suka']?>" hidden>
                                                <input type="text" name="dislike" hidden>
                                                <input type="image" src="./image/LikeFill.svg" alt="like" width="25" class="me-3">
                                            </form>
                                        <?php } else { ?>
                                            <form action="./" method="post">
                                                <input type="number" name="id" value="<?=$_GET['id']?>" hidden>
                                                <input type="number" name="likevalue" value="<?=$row['suka']?>" hidden>
                                                <input type="text" name="like" hidden>
                                                <input type="image" src="./image/Like.svg" alt="like" width="25" class="me-3">
                                            </form>
                                        <?php } ?>
                                        <button class="border-0 bg-white" data-bs-toggle="modal" data-bs-target="#info">
                                            <img src="./image/Trash.svg" alt="trash" width="27">
                                        </button>
                                        <div class="modal fade" id="info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header border-0">
                                                    <h1 class="modal-title fs-5 text-center w-100" id="exampleModalLabel">Apakah Anda Yakin?</h1>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-center border-0">
                                                        <button type="button" class="btn text-white w-100 mx-2" data-bs-dismiss="modal" style="background-color: #FF002E; max-width: 150px;">Tidak</button>
                                                        <form action="./" method="post" class="w-100" style="max-width: 150px;">
                                                            <input type="number" name="id" value="<?=$_GET['id']?>" hidden>
                                                            <input type="text" name="delinfo" hidden>
                                                            <input type="submit" class="btn text-white w-100 mx-2" style="background-color: #009900;" value="Ya">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <hr class="w-100">
                        <p class="card-text">
                            <?=$row['isi']?>
                        </p>
                        <?php if($row['file'] != NULL) {
                            // function is_image($file) {
                            //     $imageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                            //     return in_array(mime_content_type($file), $imageTypes);
                            // } ?>
                            <hr class="w-100">
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-md-6 col-sm-9 col-12">
                                    <?php
                                    // if (is_image($row['file'])) {
                                    echo '<img src="data:image/jpeg;base64,'.base64_encode($row['file']).'" class="w-100" alt="File">';
                                    // } else {
                                    //     print_r(is_image($row['file']));
                                    //     $filename = 'file_' . time() . '.' . pathinfo($row['file'], PATHINFO_EXTENSION);
                                    //     $fileContent = base64_decode(stream_get_contents($row['file']));
                                    //     file_put_contents($filename, $fileContent);
                                    //     echo '<a href="' . $filename . '" class="w-100" download>' . basename($row['file']) . '</a>';
                                    //     unlink($filename);
                                    // }
                                    ?>
                                </div>
                                <div class="col"></div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php
                }
            } else {
                ?><p class="fs-5 m-3">Tidak ada informasi di sini.</p><?php
            }
        } else {
            ?><p class="fs-5 m-3">Tidak ada informasi di sini.</p><?php
        }
        ?>
    </div>
    <?php if($accept == 1) { ?>
        <div class="row">
            <form action="./?menu=informasi&id=<?=$_GET['id']?>" method="post">
                <div class="col d-flex align-items-center">
                    <h3 class="p-1 me-2">Komentar</h3>
                    <div class="col-md-10 d-flex align-items-center">
                        <input type="text" class="form-control w-100 w-sm-100 w-50" name="comment" required>
                        <button type="button" class="btn text-white m-3" data-bs-toggle="modal" data-bs-target="#komentar">
                            <img src="./image/Send.svg" alt="Send" width="25">
                        </button>
                        <div class="modal fade p-0" id="komentar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered p-0">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <h1 class="modal-title fs-5 w-100 ms-4" id="exampleModalLabel">Nama</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="number" name="id" value="<?=$_GET['id']?>" hidden>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama Anda" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn text-white" style="background-color: #009900">
                                            Kirim <img src="./image/SendWhite.svg" alt="send" width="15">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row mt-1">
            <?php
            $sql = "SELECT * FROM `komentar` WHERE `informasi_id`='$_GET[id]' ORDER BY `tanggal` DESC LIMIT 10";
            $result = $conn->query($sql);
            if (mysqli_num_rows($result)>0) {
                while($row = $result->fetch_assoc()) {
                    // $random = $profile[array_rand($profile)];
                    $arrayrand = array_rand($profile);
                    $random = $profile[$arrayrand];
                    unset($profile[$arrayrand]);
                    ?>
                    <div class="col-12">
                        <div class="d-flex align-items-center border rounded p-2 mb-2 bg-white hover-scale-sm">
                            <div class="ms-3 me-4">
                                <img src="<?= $random ?>" width="60">
                            </div>
                            <div class="mt-2 flex-grow-1">
                                <h5><?=$row['nama']?> - <?=tgl_indo($row['tanggal'])?></h5>
                                <p><?=htmlspecialchars($row['komentar'])?></p>
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
                                        <input type="number" name="idinfo" value="<?=$_GET['id']?>" hidden>
                                        <input type="text" name="delcommentinfo" hidden>
                                        <input type="submit" class="btn text-white w-100 mx-2" style="background-color: #009900;" value="Ya">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?><p class="fs-5">Tidak ada komentar.</p><?php
            }
            ?>
        </div>
    <?php } else { ?>
        <div class="text-center mb-1">
            <form action="./" method="post" class="w-100 d-inline-block mx-2" style="max-width: 150px;">
                <input type="number" name="id" value="<?=$_GET['id']?>" hidden>
                <input type="text" name="delinfo" hidden>
                <input type="submit" class="btn text-white w-100 mx-2" style="background-color: #FF002E;" value="Hapus">
            </form>
            <form action="./" method="post" class="w-100 d-inline-block mx-2" style="max-width: 150px;">
                <input type="number" name="id" value="<?=$_GET['id']?>" hidden>
                <input type="text" name="acceptinfo" hidden>
                <input type="submit" class="btn text-white w-100 mx-2" style="background-color: #009900;" value="Publikasi">
            </form>
        </div>
    <?php } ?>
    <h3 class="d-inline-block">Lihat Informasi Lainnya</h3>
    <hr class="d-inline-block float-end w-50 d-none d-sm-block">
    <hr class="d-inline-block float-end w-25 d-block d-sm-none">
    <div class="row mb-3">
        <?php
        $sql = "SELECT * FROM `informasi` WHERE `accept`=1 LIMIT 20";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result)>0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-2">
                    <a href="?menu=admin-informasi&id=<?=$row['id']?>">
                        <div class="card bg-dark text-white hover-scale">
                            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['gambar']).'" alt="Card image" style="height: 300px;">'; ?>
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
    </div>
</main>