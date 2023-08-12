<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data Kriteria</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form class="form-material form-horizontal" method="POST" action="<?= $action; ?>" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="hidden" id="id_kriteria" name="id_kriteria" value="<?= $id_kriteria; ?>" class="form-control" placeholder="Ketikkan nis">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="bdate">Atribut</span>
                                    </label>
                                    <div class="col-md-12">
                                        <select name="id_atribut" id="id_atribut" class="form-control">
                                            <option value="" disabled selected>--Pilih--</option>
                                            <?php foreach ($listAtribut as $cek) { ?>
                                                <option value="<?= $cek->id_atribut  ?>" <?= ($id_atribut == $cek->id_atribut) ? "selected" : ""; ?>><?=$cek->kode ?> - <?= $cek->nama_atribut ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-danger"><?= form_error('id_atribut') ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="bdate">Nilai</span>
                                    </label>
                                    <div class="col-md-12">
                                        <input type="text" id="range_nilai" name="range_nilai" value="<?= $range_nilai; ?>" class="form-control" placeholder="Ketikkan nilai kriteria">
                                        <span class="text-danger"><?= form_error('range_nilai') ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="bdate">Bobot</span>
                                    </label>
                                    <div class="col-md-12">
                                        <select name="bobot" id="" class="form-control">
                                            <option value="" disabled selected>--Pilih--</option>
                                            <?php for ($x=1; $x <=5; $x++) { ?>
                                                <option value="<?= $x ?>" <?= ($id_bobot == $x) ? "selected" : ""; ?>><?= $x ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-danger"><?= form_error('bobot') ?></span>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10">Simpan</button>
                                    <a type="button" href="<?= site_url('controllerKriteria'); ?>" class="btn btn-danger waves-effect waves-light">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>