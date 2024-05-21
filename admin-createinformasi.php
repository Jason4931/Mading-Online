<main class="bg-body-secondary p-3">
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('showimg');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        var loadFileAttach = function(event) {
            var output = document.getElementById('attach-name');
            output.innerHTML = event.target.files[0].name;
        };
    </script>
    <div class="back mt-1">
        <div class="col">
            <a href="?menu=admin-dashboard" class="btn text-white" style="background-color: #FF002E" tabindex="-1" role="button"
                aria-disabled="true">
                Kembali
            </a>
        </div>
    </div>
    <div class="card mt-3">
        <form action="./" method="post" enctype="multipart/form-data">
            <div class="card-img position-relative">
                <img src="./Image/Gray.png" alt="Foto" id="showimg" class="card-img-top w-100 border-bottom" style="max-height: 300px">
                <div class="card-img-overlay d-flex justify-content-center align-items-center p-0">
                    <input name="gambar" type="file" accept="image/*" id="cameraInput" class="d-none w-100 h-100" onchange="loadFile(event)" required>
                    <label for="cameraInput" class="w-100 h-100 btn cursor-pointer d-flex align-items-center justify-content-center">
                        <img src="./image/Camera.svg" alt="camera" width="50">
                    </label>
                </div>
            </div>
            <div class="card-body">
                <input name="judul" type="text" class="form-control card-title border-0 placeholder-h3" placeholder="Title" maxlength="91" style="padding-top: 12px" required>
                <hr class="w-100">
                <div class="d-flex align-items-center">
                    <div class="mt-2 flex-grow-1 m-2">
                        <textarea name="isi" id="isi" hidden></textarea>
                    </div>
                    <div class="text-end mb-2">
                        <input name="file" type="file" id="attach" class="d-none w-100 h-100" onchange="loadFileAttach(event)">
                        <label for="attach" class="btn cursor-pointer d-flex align-items-center justify-content-center">
                            <img src="./image/Attachment.svg" alt="attachment" width="25">
                        </label>
                        <p id="attach-name"></p>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-0">
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
                                            <input name="penulis" type="text" alt="nama" placeholder="Nama Penulis" class="form-control w-100" required>
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
                                            <select name="kategori" class="form-select w-100" required>
                                                <option selected>Pilih Kategori</option>
                                                <option value="1">Pengumuman</option>
                                                <option value="2">Kegiatan Sekolah</option>
                                                <option value="3">Event & Lomba</option>
                                                <option value="4">Pendaftaran Siswa</option>
                                                <option value="5">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center border border-none">
                            <button type="button" class="btn w-100 text-white mx-2" data-bs-dismiss="modal" style="background-color: #FF002E; max-width: 150px;">Batal</button>
                            <input type="text" name="createinfo" hidden>
                            <input type="submit" class="btn text-white w-100 mx-2" style="background-color: #009900; max-width: 150px;" value="Kirim">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="btn-col text-center">
        <a href="#" class="btn text-white mt-3 w-25" style="background-color: #009900; max-width: 200px;"
            tabindex="-1" role="button" aria-disabled="true" data-bs-toggle="modal"
            data-bs-target="#staticBackdrop">
            Kirim
            <img src="./image/SendWhite.svg" alt="send" width="15">
        </a>
    </div>
    <script>
        ClassicEditor
            .create( document.querySelector( '#isi' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
</main>