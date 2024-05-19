<header class="mb-1">
    <!-- <div class="w-100 p-4" style="background-color: #5227CC"></div> -->
    <?php if(isset($fail)) { ?>
        <div class="border border-danger bg-danger rounded p-2 m-3 mb-0 text-white text-center"><?=$fail?></div>
    <?php } ?>
    <div class="row">
        <div class="col">
        </div>
        <div class="col text-center">
            <img src="./Image/Logo.png" alt="logo" width="200" class="img-fluid">
        </div>
        <div class="col text-end">
            <?php if(!isset($_SESSION['Nama'])) { ?>
                <button type="button" class="btn text-white m-3" style="background-color: #FF002E" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Login
                </button>
                <div class="modal fade p-0" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered p-0">
                        <div class="modal-content">
                            <form action="./" method="post">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Login</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-3 text-start mt-1">
                                            Username:
                                        </div>
                                        <div class="col-9">
                                            <input type="text" class="form-control" name="Nama" placeholder="Username" required>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-3 text-start mt-1">
                                            Password:
                                        </div>
                                        <div class="col-9">
                                            <input type="password" class="form-control" name="Pass" placeholder="Password" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <input type="submit" class="btn text-white" style="background-color: #FF002E" value="Login">
                                    <!-- <a href="?menu=admin-dashboard" class="btn text-white" style="background-color: #FF002E">Login</a> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <a href="?logout" class="btn text-white m-3" style="background-color: #FF002E">Logout</a>
            <?php } ?>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg pt-0">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <?php
                    $dashboard = '';
                    $pengumuman = '';
                    $kegiatan = '';
                    $event = '';
                    $pendaftaran = '';
                    if($active == 'dashboard') {
                        $dashboard = 'active';
                    } else if($active == 'pengumuman') {
                        $pengumuman = 'active';
                    } else if($active == 'kegiatan') {
                        $kegiatan = 'active';
                    } else if($active == 'event') {
                        $event = 'active';
                    } else if($active == 'pendaftaran') {
                        $pendaftaran = 'active';
                    }
                    ?>
                    <li class="nav-item">
                        <?php if(isset($_SESSION['Nama'])) { ?>
                            <a class="nav-link mx-2 pb-0 <?=$dashboard?>" href="?menu=admin-dashboard">Beranda</a>
                        <?php } else { ?>
                            <a class="nav-link mx-2 pb-0 <?=$dashboard?>" href="./">Beranda</a>
                        <?php } ?>
                        <?php if($active == 'dashboard') { ?>
                            <div class="border border-0 rounded-pill" style="background-color: #2791CC; height: 3px"></div>
                        <?php } ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 pb-0 <?=$pengumuman?>" href="?menu=pengumuman">Pengumuman</a>
                        <?php if($active == 'pengumuman') { ?>
                            <div class="border border-0 rounded-pill" style="background-color: #2791CC; height: 3px"></div>
                        <?php } ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 pb-0 <?=$kegiatan?>" href="?menu=kegiatan">Kegiatan Sekolah</a>
                        <?php if($active == 'kegiatan') { ?>
                            <div class="border border-0 rounded-pill" style="background-color: #2791CC; height: 3px"></div>
                        <?php } ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 pb-0 <?=$event?>" href="?menu=event">Event & Lomba</a>
                        <?php if($active == 'event') { ?>
                            <div class="border border-0 rounded-pill" style="background-color: #2791CC; height: 3px"></div>
                        <?php } ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2 pb-0 <?=$pendaftaran?>" href="?menu=pendaftaran">Pendaftaran Siswa</a>
                        <?php if($active == 'pendaftaran') { ?>
                            <div class="border border-0 rounded-pill" style="background-color: #2791CC; height: 3px"></div>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>