<?= $this->extend('template/admin/section')?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

<div class="container-fluid">
    <div class="section-content">
        <div class="nama-menu">
            Halaman Jurusan
        </div>
        <?php if (session()->getFlashdata('success') != null) : ?>
            <div class="content" style="margin-bottom: -2%; margin-top: 0%;">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="content">
            <div class="section-dua" style="display: flex;">
                <div class="left" style="width: 55%; padding: 1%; border: 1px solid #D0D4CA; border-radius: 10px; margin-right: 2%; box-shadow: 1px 1px #D0D4CA;" >
                    <table class="table table-striped table-hover" id="daftarSiswa">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Jurusan</td>
                                <td>Singkatan</td>
                                <td class="text-center">#</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($datas as $jurusan):?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $jurusan['jurusan'] ?></td>
                                <td><?=$jurusan['singkatan'] ?></td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm btnUbah" id="btnUbah<?= $jurusan['id_jurusan']?>" onclick="ubahJurusan('<?=$jurusan['id_jurusan']; ?>', '<?=$jurusan['jurusan'] ?>', '<?=$jurusan['singkatan'] ?>')">Ubah</button>

                                    <button class="btn btn-secondary btn-sm btnBatal" id="btnBatal<?= $jurusan['id_jurusan']?>" onclick="batal(<?= $jurusan['id_jurusan']?>)" hidden>Batal</button>
                                    
                                    <a href="<?=base_url()?>jurusan/hapusJurusan/<?=$jurusan['id_jurusan']?>/<?= $jurusan['jurusan']?>" onclick="return confirm('Yakin Ingin Menghapus Jurusan..?')"><button class="btn btn-danger btn-sm btnHapus" id="btnHapus<?= $jurusan['id_jurusan']?>">Hapus</button></a>
                                </td>
                            </tr>
                            <?php endforeach?>
                        </tbody>
                    </table>
                </div>
                <div class="right" style="border: 1px solid #D0D4CA; border-radius: 10px; width: 43%; padding: 1%; margin-bottom: 5%; box-shadow: 1px 1px #D0D4CA;">
                    <div class="text text-center" style="margin-bottom: 1.5%;">
                        <strong>
                            <p id="judulForm"> FORM TAMBAH JURUSAN</p>
                        </strong>
                    </div>
                    <div class="form_jurusan">
                        <form action="<?= base_url()?>jurusan/insertJurusan" method="post" id="form_input">
                        <?= csrf_field() ?>

                        <input type="text" class="form-control" id="floatingInputIdJurusan" name="id_jurusan" placeholder="tes" value="<?= old('id_jurusan') ?>" hidden>

                        <?php if (session('error.jurusan')) : ?>
                            <div class="text-danger" id="eror_jurusan"><?= session('error.jurusan') ?></div>
                        <?php endif; ?>
                        <div class="form-floating">
                            <input type="text" class="form-control <?php if (session('error.jurusan')) : ?> is-invalid <?php endif; ?>"id="floatingInputJurusan" name="jurusan" onkeyup="rm_sess_jurusan()" placeholder="tes" value="<?= old('jurusan') ?>">
                            <label for="floatingInput">Nama Jurusan</label>
                        </div>
                        <?php if (session('error.singkatan')) : ?>
                            <div class="text-danger" id="error_singkatan"><?= session('error.singkatan') ?></div>
                        <?php endif; ?>
                        <div class="form-floating mt-2">
                            <input type="text" class="form-control <?php if (session('error.singkatan')) : ?> is-invalid <?php endif; ?>" id="floatingInputSingkatan" onkeyup="rm_sess_singkatan()" name="singkatan" placeholder="tes" value="<?= old('singkatan') ?>">
                            <label for="floatingInput">Singkatan</label>
                        </div>
                        
                        <!-- OLD DATA -->
                        
                        <div class="form-floating">
                            <input type="text" class="form-control <?php if (session('error.jurusan')) : ?> is-invalid <?php endif; ?>"id="floatingInputJurusan_old" name="old_jurusan" placeholder="tes" value="<?= old('jurusan') ?>" hidden>
                        </div>
                        
                        <div class="form-floating mt-2">
                            <input type="text" class="form-control <?php if (session('error.singkatan')) : ?> is-invalid <?php endif; ?>" id="floatingInputSingkatan_old" name="old_singkatan" placeholder="tes" value="<?= old('singkatan') ?>" hidden>
                        </div>
                        <!-- END OLD DATA -->

                        <div class="lokasi-btn" style="display: flex; justify-content: flex-end; margin-top: 2%;">
                            <div class="batalkan" id="btnFormBatal" hidden>
                                <button type="button" class="btn btn-sm btn-danger" onclick="batalSemua()">Batalkan</button>
                            </div>
                            <div class="ubah" id="btnFormSimpan" style="margin-left: 2%;" hidden>
                                <button type="submit" class="btn btn-sm btn-success">Simpan Perubahan</button>
                            </div>
                            <div class="tambah" id="btnFormTambah" style="margin-left: 2%;">
                                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function rm_sess_jurusan(){
        var floatingInputJurusan = document.getElementById("floatingInputJurusan")
        var eror_jurusan = document.getElementById("eror_jurusan")
        eror_jurusan.setAttribute('hidden', true)
        floatingInputJurusan.classList.remove("is-invalid")
    }

    function rm_sess_singkatan(){
        var floatingInputSingkatan = document.getElementById("floatingInputSingkatan")
        var error_singkatan = document.getElementById("error_singkatan")
        error_singkatan.setAttribute('hidden', true)
        floatingInputSingkatan.classList.remove("is-invalid")
    }

    function ubahJurusan(id, jurusan, singkatan){
        var confirm = window.confirm("Apakah anda ingin mengubah data jurusan "+jurusan+" .?")
        // baris.
        if(confirm){
            var judulForm = document.getElementById('judulForm')
            judulForm.innerText = "FORM UBAH JURUSAN " + singkatan

            var form = document.getElementById('form_input')
            form.action = 'http://localhost:8080/jurusan/editJurusan'

            var inputIdJurusan = document.getElementById('floatingInputIdJurusan');
            var inputJurusan = document.getElementById('floatingInputJurusan');
            var inputSingkatan = document.getElementById('floatingInputSingkatan');
            var inputJurusan_old = document.getElementById('floatingInputJurusan_old');
            var inputSingkatan_old = document.getElementById('floatingInputSingkatan_old');
            inputIdJurusan.value = id
            inputJurusan.value = jurusan
            inputSingkatan.value = singkatan
            inputJurusan_old.value = jurusan
            inputSingkatan_old.value = singkatan

            var btnFormBatal = document.getElementById('btnFormBatal')
            btnFormBatal.removeAttribute('hidden');
            var btnFormSimpan = document.getElementById('btnFormSimpan')
            btnFormSimpan.removeAttribute('hidden');
            var btnFormTambah = document.getElementById('btnFormTambah')
            btnFormTambah.setAttribute('hidden', 'true')

            var btnBatal = document.getElementById('btnBatal' + id);
            var btnHapus = document.getElementById('btnHapus' + id);
            // btnHapus.setAttribute('hidden', 'true')
            var btnUbah = document.getElementById('btnUbah' + id);
            if (btnBatal) {
                btnHapus.setAttribute('hidden', 'true')
                btnBatal.removeAttribute('hidden');
                btnUbah.setAttribute('hidden', 'true');
            }

            // Mengambil semua elemen dengan atribut 'hidden' dan menambahkan kembali atribut 'hidden'
            var btnBatalLain = document.querySelectorAll('.btnBatal');
            var btnUbahLain = document.querySelectorAll('.btnUbah');
            var btnHapusLain = document.querySelectorAll('.btnHapus');
            btnBatalLain.forEach(function(elemen) {
                if (elemen !== btnBatal) {
                    elemen.setAttribute('hidden', 'true');
                }
            });
            btnUbahLain.forEach(function(elemen) {
                if (elemen !== btnUbah) {
                    elemen.removeAttribute('hidden');
                    
                }
            });
            btnHapusLain.forEach(function(elemen) {
                if (elemen !== btnHapus) {
                    elemen.removeAttribute('hidden');
                    
                }
            });
        }   
    }
    function batal(id){
        var judulForm = document.getElementById('judulForm')
        judulForm.innerText = "FORM TAMBAH JURUSAN "

        var inputJurusan = document.getElementById('floatingInputJurusan');
        var inputJurusan_old = document.getElementById('floatingInputJurusan_old');
        var inputIdJurusan = document.getElementById('floatingInputIdJurusan');
        var inputSingkatan = document.getElementById('floatingInputSingkatan');
        var inputSingkatan_old = document.getElementById('floatingInputSingkatan_old');
        inputJurusan.value = ""
        inputJurusan_old.value = ""
        inputIdJurusan.value = ""
        inputSingkatan.value = ""
        inputSingkatan_old.value = ""
        var btnUbah = document.getElementById('btnUbah'+id).removeAttribute('hidden')
        var btnHapus = document.getElementById('btnHapus'+id).removeAttribute('hidden')
        var btnBatal = document.getElementById('btnBatal'+id).setAttribute('hidden', 'true')

        var btnFormBatal = document.getElementById('btnFormBatal')
        btnFormBatal.setAttribute('hidden', 'true');
        var btnFormSimpan = document.getElementById('btnFormSimpan')
        btnFormSimpan.setAttribute('hidden', 'true');
        var btnFormTambah = document.getElementById('btnFormTambah')
        btnFormTambah.removeAttribute('hidden');

        var form = document.getElementById('form_input')
        form.action = 'http://localhost:8080/jurusan/insertJurusan'
    }
    function batalSemua(){
        var judulForm = document.getElementById('judulForm')
        judulForm.innerText = "FORM TAMBAH JURUSAN "

        var inputIdJurusan = document.getElementById('floatingInputIdJurusan');
        var inputJurusan = document.getElementById('floatingInputJurusan');
        var inputJurusan_old = document.getElementById('floatingInputJurusan_old');
        var inputSingkatan = document.getElementById('floatingInputSingkatan');
        var inputSingkatan_old = document.getElementById('floatingInputSingkatan_old');
        inputIdJurusan.value = ""
        inputJurusan.value = ""
        inputSingkatan.value = ""
        inputJurusan_old.value = ""
        inputSingkatan_old.value = ""
        var btnBatalLain = document.querySelectorAll('.btnBatal');
        var btnUbahLain = document.querySelectorAll('.btnUbah');
        var btnHapusLain = document.querySelectorAll('.btnHapus');
        btnBatalLain.forEach(function(elemen) {
            elemen.setAttribute('hidden', 'true');
        });
        btnUbahLain.forEach(function(elemen) {
            elemen.removeAttribute('hidden')
        });
        btnHapusLain.forEach(function(elemen) {
            elemen.removeAttribute('hidden')
        });

        var btnFormBatal = document.getElementById('btnFormBatal')
        btnFormBatal.setAttribute('hidden', 'true');
        var btnFormSimpan = document.getElementById('btnFormSimpan')
        btnFormSimpan.setAttribute('hidden', 'true');
        var btnFormTambah = document.getElementById('btnFormTambah')
        btnFormTambah.removeAttribute('hidden');

        var form = document.getElementById('form_input')
        form.action = 'http://localhost:8080/jurusan/insertJurusan'
    }
</script>
<?= $this->endSection() ?>