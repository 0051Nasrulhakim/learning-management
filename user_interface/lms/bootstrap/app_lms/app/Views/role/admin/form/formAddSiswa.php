<?= $this->extend('template/admin/section')?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="section-content">
        <div class="nama-menu">
            FORM TAMBAH SISWA
        </div>
        <div class="content">
            <form action="<?= base_url()?>siswa/insertSiswa" method="post" class="form-floating">
            <?= csrf_field() ?>
                <div class="form">
                    <div class="left">

                        <div class="mb-3 row">
                            <label for="nisSiswa" class="col-sm-3 col-form-label">NIS Siswa</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control <?php if (session('error.nis')) : ?> is-invalid <?php endif; ?>" id="nisSiswa" name="nisSiswa" onkeyup="nis()" value="<?= old('nisSiswa') ?>">
                                <div class="text-danger" id="error_nis" 
                                    <?php if (session('error.nis')){echo "";}else{echo "hidden"; }?>
                                >
                                    <?= session('error.nis') ?>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <button type="button" class="btn btn-sm btn-info" onclick="getNim()">Buat NIS</button>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="namaSiswa" class="col-sm-3 col-form-label">Nama Siswa</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control <?php if (session('error.nama_siswa')) : ?> is-invalid <?php endif; ?>" id="namaSiswa" name="namaSiswa" onkeyup="nama_siswa()" value="<?= old('namaSiswa') ?>">
                                <div class="text-danger" id="error_nama_siswa"
                                    <?php if (session('error.nama_siswa')){echo "";}else{echo "hidden"; }?>
                                >
                                    <?= session('error.nama_siswa') ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="jurusan" class="col-sm-3 col-form-label">Jurusan</label>
                            <div class="col-sm-9">
                                <select name="jurusan" class="form-select <?php if (session('error.jurusan')) : ?> is-invalid <?php endif; ?>" id="jurusan" onchange="getKelas(this)">

                                    <option value="">Pilih Jurusan</option>
                                    <?php foreach($jurusan as $jrs):?>
                                        <option value="<?= $jrs['id_jurusan']?>">
                                            <?= $jrs['jurusan']. ' ( '. $jrs['singkatan'] . ' ) ' ?>
                                        </option>
                                    <?php endforeach?>

                                </select>
                                
                                    <div class="text-danger" id="error_jurusan" 
                                        <?php if (session('error.jurusan')){echo "";}else{echo "hidden"; }?>
                                    >
                                        <?= session('error.jurusan') ?>
                                    </div>
                                
                                <!-- <input type="text" class="form-control" id="namaSiswa" name="namaSiswa"> -->
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="kelas" class="col-sm-3 col-form-label">Kelas</label>
                            <div class="col-sm-9">
                                <select class="form-select <?php if (session('error.id_kelas')) : ?> is-invalid <?php endif; ?>" name="kelas" id="kelas" disabled onchange="kelas_err()">
                                    <option value="">Silahkan Pilih Jurusan dahulu</option>
                                    
                                </select>
                                <div class="text-danger" id="error_kelas" 
                                    <?php if (session('error.kelas')){echo "";}else{echo "hidden"; }?>
                                >
                                    <?= session('error.kelas') ?>
                                </div>
                                <!-- <input type="text" class="form-control" id="kelas" name="kelas"> -->
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="jenisKelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <select name="jenisKelamin" class="form-select <?php if (session('error.jenis_kelamin')) : ?> is-invalid <?php endif; ?>" id="jenisKelamin" onchange="jenis_kelamin()">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" <?php if(old('jenisKelamin') == "L"){echo "selected";} ?>>Laki Laki</option>
                                    <option value="P" <?php if(old('jenisKelamin') == "P"){echo "selected";} ?>>Perempuan</option>
                                </select>
                                <div class="text-danger" id="error_jenis_kelamin"
                                    <?php if (session('error.jenis_kelamin')){echo "";}else{echo "hidden"; }?>
                                >
                                    <?= session('error.jenis_kelamin') ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="tahunMasuk" class="col-sm-3 col-form-label">Tahun Masuk</label>
                            <div class="col-sm-9">
                                <select name="tahunMasuk" class="form-select <?php if (session('error.id_tahun')) : ?> is-invalid <?php endif; ?>" id="tahunMasuk" onchange="tahun_masuk() ">

                                    <option value="">Pilih Tahun Masuk</option>
                                    <?php foreach($tahun as $tahun):?>
                                        <option value="<?= $tahun['id']?>" <?php if(old('tahunMasuk') == $tahun['id']){echo "selected";}?>>
                                        <?php 
                                            if($tahun['semester'] == '1'){
                                                echo tahun($tahun['tahun_mulai']).' - ' .tahun($tahun['tahun_mulai'])+1 . ' / Semester '.semester($tahun['semester']);
                                            }elseif($tahun['semester'] == '2'){
                                                echo tahun($tahun['tahun_mulai'])-1 . ' - ' .tahun($tahun['tahun_mulai']). ' / Semester '.semester($tahun['semester']);
                                            }
                                        ?>
                                        </option>
                                    <?php endforeach?>

                                </select>
                                <div class="text-danger" id="error_id_tahun"
                                    <?php if (session('error.id_tahun')){echo "";}else{echo "hidden"; }?>
                                >
                                    <?= session('error.id_tahun') ?>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    <div class="right">
                        
                        <div class="mb-3 row">
                            <label for="tanggalLahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control <?php if (session('error.tgl_lahir')) : ?> is-invalid <?php endif; ?>" id="tanggalLahir" name="tanggalLahir" onchange="tgl_lahir()" value="<?= old('tanggalLahir') ?>">

                                <div class="text-danger" id="error_tgl_lahir"
                                    <?php if (session('error.tgl_lahir')){echo "";}else{echo "hidden"; }?>
                                >
                                    <?= session('error.tgl_lahir') ?>
                                </div>

                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="namaAyah" class="col-sm-3 col-form-label">Nama Ayah</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control <?php if (session('error.nama_ayah')) : ?> is-invalid <?php endif; ?>" id="namaAyah" name="namaAyah" onkeyup="nama_ayah()" value="<?= old('namaAyah') ?>">
                                <div class="text-danger" id="error_nama_ayah"
                                    <?php if (session('error.nama_ayah')){echo "";}else{echo "hidden"; }?>
                                >
                                    <?= session('error.nama_ayah') ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="namaIbu" class="col-sm-3 col-form-label">Nama Ibu</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control <?php if (session('error.nama_ibu')) : ?> is-invalid <?php endif; ?>" id="namaIbu" name="namaIbu" onkeyup="nama_ibu()" value="<?= old('namaIbu') ?>">
                                <div class="text-danger" id="error_nama_ibu"
                                    <?php if (session('error.nama_ibu')){echo "";}else{echo "hidden"; }?>
                                >
                                    <?= session('error.nama_ibu') ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control <?php if (session('error.alamat')) : ?> is-invalid <?php endif; ?>" style="height: 92px" placeholder="tuliskan alamat" name="alamat" id="alamat" onkeyup="alamat_siswa()" value="<?= old('alamat') ?>"></textarea>
                                <!-- <input type="text" class="form-control" id="alamat" name="alamat"> -->
                                <div class="text-danger" id="error_alamat"
                                    <?php if (session('error.alamat')){echo "";}else{echo "hidden"; }?>
                                >
                                    <?= session('error.alamat') ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="status" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-select <?php if (session('error.status')) : ?> is-invalid <?php endif; ?>" name="status" id="status" onchange="stat()">
                                    <option value="">Pilih Status Siswa</option>
                                    <option value="Aktiv" <?php if(old('status')== "Aktiv"){echo "selected";}?>>Aktiv</option>
                                    <option value="Tidak Aktiv" <?php if(old('status')=="Tidak Aktiv"){echo "selected";}?>>Tidak Aktiv</option>
                                </select>
                                <div class="text-danger" id="error_status"
                                <?php if (session('error.status')){echo "";}else{echo "hidden"; }?>
                                >
                                    <?= session('error.status') ?>
                                </div>
                                <!-- <input type="text" class="form-control" id="status" name="status"> -->
                            </div>
                        </div>

                    </div>
                </div>
                <div class="btn-tengah">
                    <div class="simpan padding">
                        <button class="btn btn-danger">Batal</button>
                    </div>
                    <div class="batalkan padding">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function getKelas(element){
        var jurusan = document.getElementById("jurusan")
        var error_jurusan = document.getElementById("error_jurusan")
        error_jurusan.setAttribute('hidden', true)
        jurusan.classList.remove("is-invalid")

        var value = element.value
        var enableKelas = document.getElementById('kelas')
        // alert(typeof(value))
        if(value != '' || value != ""){
            $.ajax({
                url: '<?= base_url()?>kelas/kelas_w_jurusan',
                type: 'POST',
                data: { jurusan: value },
                // dataType: 'json',
                //data: new FormData(this),
                success: function(response) {
                    // your code here
                    if(response != null || response !== '' || response.length > 0 || response !=[] ){
                        // enableKelas.removeAttribute('disabled')
                        setKelas(response)
                        $("#kelas").prop("disabled", false);

                    }else{
                        $(".kelas").prop("disabled", true);
                    }
                }
            });
        }else{
            enableKelas.value = ""
            enableKelas.disabled = true
        }
        
        var kelas = document.getElementById("kelas")
        var error_kelas = document.getElementById("error_kelas")
        
        error_kelas.setAttribute('hidden', true)
        kelas.classList.remove("is-invalid")
    }

    function setKelas(data){
        
        var dropdown = $("#kelas").empty();
        data.forEach(function(item) {
            dropdown.append('<option value="' + item.id_kelas + '">' + item.kelas + '</option>');
        });
    }
    function kelas_err(){
        var kelas = document.getElementById("kelas")
        var error_kelas = document.getElementById("error_kelas")
        
        error_kelas.setAttribute('hidden', true)
        kelas.classList.remove("is-invalid")
    }

    function nis(){
        var nisSiswa = document.getElementById("nisSiswa")
        var error_nis = document.getElementById("error_nis")
        error_nis.setAttribute('hidden', true)
        nisSiswa.classList.remove("is-invalid")
    }
    function nama_siswa(){
        var namaSiswa = document.getElementById("namaSiswa")
        var error_nama_siswa = document.getElementById("error_nama_siswa")
        error_nama_siswa.setAttribute('hidden', true)
        namaSiswa.classList.remove("is-invalid")
    }
    function jenis_kelamin(){
        var jenisKelamin = document.getElementById("jenisKelamin")
        var error_jenis_kelamin = document.getElementById("error_jenis_kelamin")
        error_jenis_kelamin.setAttribute('hidden', true)
        jenisKelamin.classList.remove("is-invalid")
    }
    function tahun_masuk(){
        var tahunMasuk = document.getElementById("tahunMasuk")
        var error_id_tahun = document.getElementById("error_id_tahun")
        error_id_tahun.setAttribute('hidden', true)
        tahunMasuk.classList.remove("is-invalid")
    }
    function tgl_lahir(){
        var tanggalLahir = document.getElementById("tanggalLahir")
        var error_tgl_lahir = document.getElementById("error_tgl_lahir")
        error_tgl_lahir.setAttribute('hidden', true)
        tanggalLahir.classList.remove("is-invalid")
    }
    function nama_ayah(){
        var namaAyah = document.getElementById("namaAyah")
        var error_nama_ayah = document.getElementById("error_nama_ayah")
        error_nama_ayah.setAttribute('hidden', true)
        namaAyah.classList.remove("is-invalid")
    }
    function nama_ibu(){
        var namaIbu = document.getElementById("namaIbu")
        var error_nama_ibu = document.getElementById("error_nama_ibu")
        error_nama_ibu.setAttribute('hidden', true)
        namaIbu.classList.remove("is-invalid")
    }
    function alamat_siswa(){
        var alamat = document.getElementById("alamat")
        var error_alamat = document.getElementById("error_alamat")
        error_alamat.setAttribute('hidden', true)
        alamat.classList.remove("is-invalid")
    }
    function stat(){
        var status = document.getElementById("status")
        var error_status = document.getElementById("error_status")
        error_status.setAttribute('hidden', true)
        status.classList.remove("is-invalid")
    }

    function getNim(){
        var konfirmasi = confirm('Apakah Anda Akan Membuat nim secara otomatis.? Nim otomatis akan otomatis mengurutkan nim berdasarkan nim terakhir.')
        if(konfirmasi == true){
            // alert("tes btn")
            $.ajax({
                url: '<?= base_url()?>siswa/nimOtomatis',
                type: 'GET',
                success: function(response) {
                    // your code here
                    var nisSiswa = document.getElementById("nisSiswa")
                    nisSiswa.value = response
                    // alert(response)
                }
            });
        }
    }

</script>

<?= $this->endSection()?>