<?= $this->extend('template/admin/section')?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

<div class="container-fluid">
    <div class="section-content">
        <div class="nama-menu">
            Halaman Kelas
        </div>
        <?php if(session()->getFlashdata('success') != null) : ?>
            <div class="content" style="margin-bottom: -2%; margin-top: 0%;">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="content">
            <div class="section-dua" style="display: flex;">
                <div class="left" style="width: 60%; padding: 1%; border: 1px solid #D0D4CA; border-radius: 10px; margin-right: 2%; box-shadow: 1px 1px #D0D4CA;" >
                    <table class="table table-striped table-hover" id="daftarKelas">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Kelas</td>
                                <td>Jurusan</td>
                                <td class="text-center">#</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($datas['kelas'] as $kelas):?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $kelas['kelas'] ?></td>
                                <td><?=$kelas['jurusan'] ?></td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm btnUbah" id="btnUbah<?= $kelas['id_kelas']?>" onclick="ubahKelas('<?=$kelas['id_kelas']; ?>', '<?=$kelas['kelas'] ?>', '<?=$kelas['id_jurusan'] ?>')">Ubah</button>

                                    <button class="btn btn-secondary btn-sm btnBatal" id="btnBatal<?= $kelas['id_kelas']?>" onclick="batal(<?= $kelas['id_kelas']?>)" hidden>Batal</button>
                                    
                                    <a href="<?=base_url()?>kelas/hapuskelas/<?=$kelas['id_kelas']?>/<?= $kelas['kelas']?>" onclick="return confirm('Yakin Ingin Menghapus kelas..?')"><button class="btn btn-danger btn-sm btnHapus" id="btnHapus<?= $kelas['id_kelas']?>">Hapus</button></a>
                                </td>
                            </tr>
                            <?php endforeach?>
                        </tbody>
                    </table>
                </div>
                <div class="right" style="width: 40%; border: 1px solid #D0D4CA; border-radius: 10px; padding: 1%; margin-bottom: 5%; box-shadow: 1px 1px #D0D4CA; height: max-content;">
                    <div class="text text-center" style="margin-bottom: 1.5%;">
                        <strong>
                            <p id="judulForm"> FORM TAMBAH KELAS</p>
                        </strong>
                    </div>

                    <?php if(session()->getFlashdata('error') != null){ $error = session()->getFlashdata('error');
                        
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            <?php foreach($error as $e):?>
                            <li><?= $e?></li>
                            <?php endforeach?>
                        </ul>
                    </div>
                    <?php }?>

                    <?php if(session()->getFlashdata('failed') != null):?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('failed');?>
                        </div>
                    <?php endif;?>
                    
                    <div class="form_kelas" >
                        <form action="<?= base_url()?>kelas/insertKelas" method="post" id="form_input" >
                        <?= csrf_field() ?>

                        <input type="text" class="form-control" id="floatingInputIdKelas" name="id_kelas" placeholder="tes" value="<?= old('id_kelas') ?>" hidden>

                        <div class="form-floating">
                            <select class="form-select tingkatKelas" name="tingkatanKelas" id="floatingSelectTingkatKelas" aria-label="Floating label select example">
                                <option value="">Pilih Tingkatan Kelas</option>
                                <option value="10" <?php if(old('tingkatanKelas')== "10"){echo "selected";} ?>>10</option>
                                <option value="11" <?php if(old('tingkatanKelas')== "11"){echo "selected";} ?>>11</option>
                                <option value="12" <?php if(old('tingkatanKelas')== "12"){echo "selected";} ?>>12</option>
                            </select>
                            <label for="floatingSelect">Tingkatan Kelas</label>
                        </div>

                        <div class="form-floating mt-2">
                            <input type="text" class="form-control "id="floatingInputRombel" name="rombel" onkeyup="rm_sess_rombel()" placeholder="tes" value="<?= old('rombel') ?>">
                            <label for="floatingInputRombel">Rombongan Belajar</label>
                        </div>

                        <div class="form-floating mt-2">
                            <select class="form-select jurusan" name="jurusan" id="floatingSelectJurusan" aria-label="Floating label select example" value="<?= old('jurusan') ?>">
                                <option value="">Pilih Jurusan</option>
                                <?php foreach($datas['jurusan'] as $jurusan):?>
                                    <option value="<?= $jurusan['id_jurusan']?>" <?php if(old('jurusan') == $jurusan['id_jurusan']){echo "selected";} ?>><?= $jurusan['jurusan']?></option>
                                <?php endforeach?>
                            </select>
                            <label for="floatingSelect">Tingkatan Kelas</label>
                        </div>
                        
                        <!-- OLD DATA -->
                        
                        <input type="text" name="old_tingkat_kelas" id="old_tingkat_kelas" value="<?= old('tingkatanKelas') ?>" hidden>
                        <input type="text" name="old_rombel" id="old_rombel" value="<?= old('rombel') ?>" hidden>
                        <input type="text" name="old_jurusan" id="old_jurusan" value="<?= old('jurusan') ?>" hidden>
                        
                        
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
    let table = new DataTable('#daftarKelas', {
        // options
        "language": {
            "info"         : "Data Ke ( _START_ - _END_ ) Dari _TOTAL_ Data",
            "zeroRecords"  : "Data Siswa Tidak Ada / Tidak Ditemukan",
            "lengthMenu":     " _MENU_ Baris Data Kelas",
            "infoFiltered":   "(Filter dari _MAX_ total Data)"
            // "paginate"  : {
                // "first": "First page"
                
            // }
        }
    });
    function rm_sess_rombel(){
        var floatingInputRombel = document.getElementById("floatingInputRombel")
        var error_rombel = document.getElementById("eror_rombel")
        error_rombel.setAttribute('hidden', true)
        floatingInputRombel.classList.remove("is-invalid")
    }

    function rm_sess_jurusan(){
        var floatingInputJurusan = document.getElementById("floatingInputJurusan")
        var error_jurusan = document.getElementById("error_jurusan")
        error_jurusan.setAttribute('hidden', true)
        floatingInputJurusan.classList.remove("is-invalid")
    }

    function ubahKelas(id, kelas, id_jurusan){
        var confirm = window.confirm("Apakah anda ingin mengubah data jurusan "+kelas+" .?")
        // baris.
        if(confirm){
            var rombel = kelas.substring(kelas.length - 1);
            var judulForm = document.getElementById('judulForm')
            judulForm.innerText = "FORM UBAH KELAS " + kelas

            var form = document.getElementById('form_input')
            form.action = 'http://localhost:8080/kelas/editKelas'

            //tingkat kelas
            var floatingSelectTingkatKelas = document.getElementById('floatingSelectTingkatKelas')
            var floatingSelectJurusan = document.getElementById('floatingSelectJurusan')
            
            // alert(tes)
            floatingSelectTingkatKelas.value = kelas.slice(0, 2)
            floatingSelectJurusan.value = id_jurusan

            var inputIdKelas = document.getElementById('floatingInputIdKelas');
            var inputRombel = document.getElementById('floatingInputRombel');
            // var inputJurusan = document.getElementById('floatingInputJurusan');
            var old_rombel = document.getElementById('old_rombel');
            var old_jurusan = document.getElementById('old_jurusan');
            var old_tingkat_kelas = document.getElementById('old_tingkat_kelas');
            inputIdKelas.value = id
            // inputJurusan.value = jurusan
            inputRombel.value = rombel
            old_jurusan.value = id_jurusan
            old_tingkat_kelas.value = kelas.slice(0, 2)
            old_rombel.value = rombel

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
        var floatingSelectTingkatKelas = document.getElementById('floatingSelectTingkatKelas')
        var floatingSelectJurusan = document.getElementById('floatingSelectJurusan')
        floatingSelectJurusan.selectedIndex = 0
        floatingSelectTingkatKelas.selectedIndex = 0

        var judulForm = document.getElementById('judulForm')
        judulForm.innerText = "FORM TAMBAH KELAS "

        
        var inputIdKelas = document.getElementById('floatingInputIdKelas');
        var floatingInputRombel = document.getElementById('floatingInputRombel')

        var old_rombel = document.getElementById('old_rombel');
        var old_jurusan = document.getElementById('old_jurusan');
        var old_tingkat_kelas = document.getElementById('old_tingkat_kelas');
        old_jurusan.value = ""
        old_rombel.value = ""
        old_tingkat_kelas.value = ""

        floatingInputRombel.value = ""
        inputIdKelas.value = ""
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
        form.action = 'http://localhost:8080/kelas/insertKelas'
    }

    function batalSemua(){
        var judulForm = document.getElementById('judulForm')
        judulForm.innerText = "FORM TAMBAH KELAS "

        var old_rombel = document.getElementById('old_rombel');
        var old_jurusan = document.getElementById('old_jurusan');
        var old_tingkat_kelas = document.getElementById('old_tingkat_kelas');
        var floatingInputRombel = document.getElementById('floatingInputRombel')
        floatingInputRombel.value = ""
        old_jurusan.value = ""
        old_rombel.value = ""
        old_tingkat_kelas.value = ""

        var floatingSelectTingkatKelas = document.getElementById('floatingSelectTingkatKelas')
        var floatingSelectJurusan = document.getElementById('floatingSelectJurusan')
        floatingSelectJurusan.selectedIndex = 0
        floatingSelectTingkatKelas.selectedIndex = 0

        var inputIdKelas = document.getElementById('floatingInputIdKelas');
        inputIdKelas.value = ""
        
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
        form.action = 'http://localhost:8080/kelas/insertKelas'
    }
</script>
<?= $this->endSection() ?>