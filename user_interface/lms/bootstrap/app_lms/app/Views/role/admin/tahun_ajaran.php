<?= $this->extend('template/admin/section')?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

<div class="container-fluid">
    <div class="section-content">
        <div class="nama-menu">
            Halaman Tahun Ajaran
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
            <div class="tahun_aktif">
                <h5>Sekarang Tahun Ajaran :</h5>
            </div>
            <div class="section-dua" style="display: flex;">

                <div class="left" style="width: 60%; padding: 1%; border: 1px solid #D0D4CA; border-radius: 10px; margin-right: 2%; box-shadow: 1px 1px #D0D4CA;" >
                    <!-- table -->
                    <table class="table table-striped table-hover" id="daftarSiswa">
                        <thead>
                            <tr>
                                <td>Kode</td>
                                <td>Tahun ajaran</td>
                                <td>Semester</td>
                                <!-- <td>Selesai</td> -->
                                <td class="text-center">#</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($datas as $tahun):?>
                        <tr>       
                            <td><?= $tahun['id'] ?></td>
                            <td><?php 
                                if($tahun['semester'] == '1'){
                                   echo tahun($tahun['tahun_mulai']).' - ' .tahun($tahun['tahun_mulai'])+1;
                                }elseif($tahun['semester'] == '2'){
                                    echo tahun($tahun['tahun_mulai'])-1 . ' - ' .tahun($tahun['tahun_mulai']);
                                }
                                ?>
                            </td>
                            <td><?= semester($tahun['semester']) ?></td>
                            <!-- <td></td> -->
                            <td style="text-align: right;">
                                <button class="btn btn-primary btn-sm btn-aktivkan" id="btn_aktivkan">Aktivkan</button>
                                <button class="btn btn-primary btn-sm btn-info" id="btn_detail"><i class="fa-solid fa-circle-info"></i></button>
                                <button class="btn btn-warning btn-sm btn-ubah" id="btn_ubah"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn btn-danger btn-sm btn-hapus" id="btn_hapus"><i class="fa-solid fa-trash-can"></i></button>
                            </td>
                        </tr>
                        <?php endforeach?>
                        </tbody>
                    </table>
                </div>

                <div class="right" style="border: 1px solid #D0D4CA; border-radius: 10px; width: 38%; padding: 1%; margin-bottom: 5%; box-shadow: 1px 1px #D0D4CA;">
                    <div class="text text-center" style="margin-bottom: 1.5%;">
                        <strong>
                            <p id="judulForm"> FORM TAMBAH JURUSAN</p>
                        </strong>
                    </div>
                    <!-- form -->
                    <?php if(session()->getFlashdata('failed') != null):?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('failed');?>
                        </div>
                    <?php endif;?>
                    
                    <form action="<?= base_url()?>tahun/insertTahun" method="post" id="form_input">
                        <?= csrf_field() ?>

                        <?php if (session('error.tahun_mulai')) : ?>
                            <div class="text-danger" id="eror_mulai"><?= session('error.tahun_mulai') ?></div>
                        <?php endif; ?>
                        <div class="form-floating mb-2">
                            <input type="date" class="form-control <?php if (session('error.tahun_mulai')) : ?> is-invalid <?php endif; ?>"id="floatingInputMulai" name="tahun_mulai" onchange="rm_sess_mulai(this)" placeholder="akan terisi otomatis" value="<?= old('tahun_mulai') ?>">
                            <label for="floatingInput">Tangal Mulai</label>
                        </div>

                        <?php if (session('error.tahun_selesai')) : ?>
                            <div class="text-danger" id="eror_selesai"><?= session('error.tahun_selesai') ?></div>
                        <?php endif; ?>
                        <div class="form-floating mb-2">
                            <input type="date" class="form-control <?php if (session('error.tahun_selesai')) : ?> is-invalid <?php endif; ?>"id="floatingInputSelesai" name="tahun_selesai" onchange="rm_sess_selesai(this)" placeholder="akan terisi otomatis" value="<?= old('tahun_selesai') ?>">
                            <label for="floatingInput">Tangal Selesai</label>
                        </div>

                        <?php if (session('error.semester')) : ?>
                            <div class="text-danger" id="eror_semester"><?= session('error.semester') ?></div>
                        <?php endif; ?>
                        <div class="form-floating ">
                            <select class="form-select <?php if (session('error.semester')) : ?> is-invalid <?php endif; ?>" id="floatingSemester"  name="semester" onchange="rm_sess_semester(this)" aria-label="Floating label select example">
                                <option value="">Pilih Semester</option>
                                <option value="1" <?php if(old('semester') == "1"){echo "Selected";}?>>1 (Ganjil)</option>
                                <option value="2" <?php if(old('semester') == "2"){echo "Selected";}?>>2 (Genap)</option>
                            </select>
                            <label for="floatingInput">Semester</label>
                        </div>

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
<script>
    
    function rm_sess_kode(){

        
    }
    
    function rm_sess_mulai(e){
        var floatingInputMulai = document.getElementById("floatingInputMulai")
        var eror_mulai = document.getElementById("eror_mulai")
        eror_mulai.setAttribute('hidden', true)
        floatingInputMulai.classList.remove("is-invalid")
    }
    function rm_sess_selesai(e){
        var floatingInputSelesai = document.getElementById("floatingInputSelesai")
        var eror_selesai = document.getElementById("eror_selesai")
        eror_selesai.setAttribute('hidden', true)
        floatingInputSelesai.classList.remove("is-invalid")
    }
    function rm_sess_semester(e){
        var floatingSemester = document.getElementById("floatingSemester")
        var eror_semester = document.getElementById("eror_semester")
        eror_semester.setAttribute('hidden', true)
        floatingSemester.classList.remove("is-invalid")
    }

</script>
<?= $this->endSection() ?>