<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title"><?=$aksi ?> Data Klasifikasi</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form class="form-material form-horizontal" method="POST" action="<?= $action; ?>" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="hidden" id="id_klasifikasi" name="id_klasifikasi" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="bdate">Mahasiswa</span>
                                    </label>
                                    <div class="col-md-12">
                                        <select name="nim" id="nim" class="form-control">
                                            <option value="" disabled selected>--Pilih--</option>
                                            <?php foreach ($listMahasiswa as $value) { ?>
                                                <option value="<?= $value->nim ?>" <?= ($nim == $value->nim) ? "selected" : ""; ?>><?= $value->nama_lengkap ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-danger"><?= form_error('nim') ?></span>
                                    </div>
                                </div>
                                <?php
                                $dt_atribut = $this->db->order_by('id_atribut', 'ASC')->get("atribut")->result();
                                $c = 1;
                                foreach ($dt_atribut as $value) {
                                    $nilai_c = "c".$c++;
                                ?>
                                    <label class="col-md-12" for="bdate"><?= $value->nama_atribut ?></span>
                                    </label>
                                    <div class="col-md-12">
                                        <select name="<?= $nilai_c ?>" id="<?= $nilai_c ?>" class="form-control" required>
                                            <option value="" disabled selected>--Pilih--</option>
                                            <?php foreach ($listKriteria as $absensi) { ?>
                                                <option value="<?= $absensi->bobot  ?>"><?= $absensi->nama_atribut . " - " . $absensi->range_nilai ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="col-md-6" style="padding-top: 20px;">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10">Simpan</button>
                                    <a type="button" href="<?= site_url('ControllerKlasifikasi'); ?>" class="btn btn-danger waves-effect waves-light">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>