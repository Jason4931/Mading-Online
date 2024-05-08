<main class="bg-body-secondary p-3">
    <div class="back mt-1">
        <div class="col">
            <a href="?menu=admin-dashboard" class="btn text-white" style="background-color: #FF002E" tabindex="-1" role="button"
                aria-disabled="true">
                Kembali
            </a>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-img" style="position: relative;">
            <img src="./image/Gray.png" alt="Foto" class="card-img-top w-100" style="max-height: 300px">
            <div class="card-img-overlay d-flex justify-content-center align-items-center p-0">
                <input type="file" accept="image/*" id="cameraInput" class="d-none w-100 h-100">
                <label for="cameraInput" class="w-100 h-100 btn cursor-pointer d-flex align-items-center justify-content-center">
                    <img src="./image/Camera.svg" alt="camera" width="50">
                </label>
            </div>
        </div>
        <div class="card-body">
            <input type="text" class="form-control card-title border border-0 placeholder-h3" placeholder="Title" maxlength="91">
            <hr class="w-100">
            <div class="d-flex align-items-center">
                <div class="mt-2 flex-grow-1 m-2">
                    <textarea class="form-control card-title border border-0 placeholder-h5" rows="4" placeholder="Text"></textarea>
                </div>
                <div class="text-end mb-2">
                    <input type="file" accept="image/*" id="attach" class="d-none w-100 h-100">
                    <label for="attach" class="btn cursor-pointer d-flex align-items-center justify-content-center">
                        <img src="./image/Attachment.svg" alt="attachment" width="25">
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="btn-col text-center">
        <a href="#" class="btn text-white mt-3 w-25" style="background-color: #009900; max-width: 200px;"
            tabindex="-1" role="button" aria-disabled="true" data-bs-toggle="modal"
            data-bs-target="#staticBackdrop">
            Kirim
            <img src="./image/SendWhite.svg" alt="send" width="15">
        </a>
    </div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="border: none;">
                    <h1 class="modal-title fs-5 text-center w-100" id="staticBackdropLabel">FINISHING</h1>
                </div>
                <div class="modal-body" style="border: none;">
                    <div class="d-flex align-items-center w-100 mt-2">
                        <div class="row w-100">
                            <div class="col-md-auto">
                                <h5 class=" me-2 mt-1" style="font-weight: normal;">Nama :</h5>
                            </div>
                            <div class="col">
                                <div class="w-100">
                                    <input type="text" alt="nama" placeholder="Nama Pubisher" class="form-control w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center w-100 mt-3 mb-3">
                        <div class="row w-100">
                            <div class="col-md-auto">
                                <h5 class="me-2 mt-1" style="font-weight: normal;">Kategori :</h5>
                            </div>
                            <div class="col">
                                <div class="w-100">
                                    <select class="form-select w-100">
                                        <option selected>Pilih Kategori</option>
                                        <option value="1">Pengumuman</option>
                                        <option value="2">Kegiatan Sekolah</option>
                                        <option value="3">Event & Lomba</option>
                                        <option value="4">Pendaftaran Siswa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center border border-none">
                        <button type="button" class="btn w-100 text-white me-4" data-bs-dismiss="modal" style="background-color: #FF002E; max-width: 150px;">Batal</button>
                        <button type="button" class="btn w-100 text-white" style="background-color: #009900; max-width: 150px;">Kirim
                            <img src="./image/SendWhite.svg" alt="send" width="15">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>