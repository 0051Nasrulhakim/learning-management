<?= $this->extend('template/admin/section')?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css">

<div class="container-fluid">
    <div class="section-content">
        <div class="nama-menu">
            Daftar Siswa
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
            <div class="action" style="margin-bottom: 2%;">
                <div class="tambah">
                    <a href="<?= base_url()?>siswa/formAddSiswa"><button class="btn btn-sm btn-primary" > Tambah Siswa</button></a>
                </div>
                
                <div class="filter">
                    <div class="text" style=" padding: 0.3%;">
                        <strong>TAMPILKAN JURUSAN : </strong>
                    </div>
                    <div class="dropdown" >
                        <select class="form-select form-select-sm" name="daftarKelas" onchange="filter(this)" id="daftarKelas">
                            <option value="">SEMUA</option>
                            <?php foreach($jurusan as $list_jurusan):?>
                                <option value="<?= $list_jurusan['singkatan']?>"><?= $list_jurusan['jurusan']. ' (' . $list_jurusan['singkatan'].')'?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover" id="daftarSiswa">
                <thead>
                    <tr>
                        <td>NIS</td>
                        <td>Nama</td>
                        <td id="ckelas">kelas</td>
                        <td>Nama Ayah</td>
                        <td class="text-center">#</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach($datas as $siswa):?>
                    <tr>
                        <td><?= $siswa['nis']?></td>
                        <td><?= $siswa['nama_siswa']?></td>
                        <td><?= $siswa['kelas']?></td>
                        <td><?= $siswa['nama_ayah']?></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning">Ubah</button>
                            <button class="btn btn-sm btn-danger">hapus</button>
                        </td>
                    </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    let table = new DataTable('#daftarSiswa', {
        // options
        "language": {
            "info"         : "Data Ke ( _START_ - _END_ ) Dari _TOTAL_ Data",
            "zeroRecords"  : "Data Siswa Tidak Ada / Tidak Ditemukan",
            "lengthMenu":     " _MENU_ Baris Data Siswa",
            "infoFiltered":   "(Filter dari _MAX_ total Data)"
            // "paginate"  : {
                // "first": "First page"
                
            // }
        }
    });
    
    
    function filter(element) {
        var value = element.value
        // alert(value)
        table.columns(2)
        table.search( value ).draw();
    }
    // console.log(
    // table
    // .column( 2 )
    // .data()
    // .unique())

</script>

<?= $this->endSection() ?>