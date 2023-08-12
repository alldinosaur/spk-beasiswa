<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data Atribut</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form class="form-material form-horizontal" method="POST" action="<?= $action; ?>" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="hidden" id="id_atribut" name="id_atribut" value="<?= $id_atribut; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="bdate">Kode</span>
                                    </label>
                                    <div class="col-md-12">
                                        <?php if($kode == ""): ?>
                                            <input type="text" id="kode" name="kode" value="<?= $kode; ?>" class="form-control" placeholder="Kode">
                                        <?php else: ?>
                                            <select class="form-control" name="kode">
                                                <option value="" selected disabled>--Pilih--</option>
                                                <option value="C1" <?= ($kode == "C1") ? "selected" : ""; ?>>C1</option>
                                                <option value="C2" <?= ($kode == "C2") ? "selected" : ""; ?>>C2</option>
                                                <option value="C3" <?= ($kode == "C3") ? "selected" : ""; ?>>C3</option>
                                                <option value="C4" <?= ($kode == "C4") ? "selected" : ""; ?>>C4</option>
                                                <option value="C5" <?= ($kode == "C5") ? "selected" : ""; ?>>C5</option>
                                                <option value="C6" <?= ($kode == "C6") ? "selected" : ""; ?>>C6</option>
                                            </select>
                                        <?php endif; ?>
                                            <span class="text-danger"><?= form_error('kode') ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="bdate">Nama Atribut</span>
                                    </label>
                                    <div class="col-md-12">
                                        <input type="text" id="nama_atribut" name="nama_atribut" value="<?= $nama_atribut; ?>" class="form-control" placeholder="Ketikkan nama">
                                        <span class="text-danger"><?= form_error('nama_atribut') ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="bdate">Tipe</span>
                                    </label>
                                    <div class="col-md-12">
                                        <select class="form-control" name="tipe_atribut">
                                            <option value="" selected disabled>--Pilih--</option>
                                            <option value="benefit" <?= ($tipe_atribut == "benefit") ? "selected" : ""; ?>>benefit</option>
                                            <option value="cost" <?= ($tipe_atribut == "cost") ? "selected" : ""; ?>>cost</option>
                                        </select>
                                        <span class="text-danger"><?= form_error('tipe_atribut') ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="bdate">Bobot</span>
                                    </label>
                                    <div class="col-md-12">
                                        <input type="text" id="bobot" name="bobot" value="<?= $bobot; ?>" class="form-control" placeholder="contoh: 0.00">
                                        <span class="text-danger"><?= form_error('bobot') ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10">Simpan</button>
                                    <a type="button" href="<?= site_url('controllerAtribut'); ?>" class="btn btn-danger waves-effect waves-light">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>