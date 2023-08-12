<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Hasil Klasifikasi</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                            <div class="col-md-12" style="margin-top: 40px;">
                                <h2>Hasil Klasifikasi</h2>
                                <div class="table-responsive">
                                    <table id="mytable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>Mahasiswa</th>
                                                <?php
                                                $dt_atribut = $this->db->order_by('id_atribut', 'ASC')->get("atribut")->result();
                                                $no_c = 1;
                                                foreach ($dt_atribut as $value) {
                                                    $c = "C";
                                                    $nilai_c = $c . "" . $no_c++
                                                ?>
                                                    <th style="text-align: center;"><?= $value->nama_atribut . "<br>( " . $nilai_c . " )" ?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-12" style="margin-top: 40px;">
                                <h2>Normalisasi</h2>
                                <div class="table-responsive">
                                    <table id="mytable_normalisasi" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>Mahasiswa</th>
                                                <?php
                                                $dt_atribut = $this->db->order_by('id_atribut', 'ASC')->get("atribut")->result();
                                                $no_c = 1;
                                                foreach ($dt_atribut as $value) {
                                                    $c = "C";
                                                    $nilai_c = $c . "" . $no_c++
                                                ?>
                                                    <th style="text-align: center;"><?= $value->nama_atribut . "<br>( " . $nilai_c . " )" ?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-12" style="margin-top: 40px;">
                                <h2>Perankingan</h2>
                                <div class="table-responsive">
                                    <table id="mytable_ranking" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>Mahasiswa</th>
                                                <th>Nilai</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<script src="<?= base_url('vendor') ?>/plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var t = $("#mytable").dataTable({
            "processing": true,
            "serverSide": true,
            "oLanguage": {
                sProcessing: "Loading. . ."
            },
            "ajax": {
                "url": "<?= site_url('ControllerHasil/json_klasifikasi') ?>",
                "type": "POST"
            },
            "columns": [{
                    "data": "id_klasifikasi",
                    "orderable": false,
                    "className": "text-center"
                },
                {
                    "data": "nama_lengkap"
                },
                {
                    "data": "c1",
                    "className": "text-center"
                },
                {
                    "data": "c2",
                    "className": "text-center"
                },
                {
                    "data": "c3",
                    "className": "text-center"
                },
                {
                    "data": "c4",
                    "className": "text-center"
                },
                {
                    "data": "c5",
                    "className": "text-center"
                },
                {
                    "data": "c6",
                    "className": "text-center"
                }
            ],
            order: [
                [0, 'desc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        var w = $("#mytable_normalisasi").dataTable({
            "processing": true,
            "serverSide": true,
            "oLanguage": {
                sProcessing: "Loading. . ."
            },
            "ajax": {
                "url": "<?= site_url('ControllerHasil/json_normalisasi') ?>",
                "type": "POST"
            },
            "columns": [{
                    "data": "nim",
                    "orderable": false,
                    "className": "text-center"
                },
                {
                    "data": "nama_lengkap"
                },
                {
                    "data": "c1",
                    "className": "text-center"
                },
                {
                    "data": "c2",
                    "className": "text-center"
                },
                {
                    "data": "c3",
                    "className": "text-center"
                },
                {
                    "data": "c4",
                    "className": "text-center"
                },
                {
                    "data": "c5",
                    "className": "text-center"
                },
                {
                    "data": "c6",
                    "className": "text-center"
                }
            ],
            order: [
                [0, 'desc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        var u = $("#mytable_ranking").dataTable({
            "processing": true,
            "serverSide": true,
            "oLanguage": {
                sProcessing: "Loading. . ."
            },
            "ajax": {
                "url": "<?= site_url('ControllerHasil/json_ranking') ?>",
                "type": "POST"
            },
            "columns": [{
                    "data": "nim",
                    "orderable": false,
                    "className": "text-center"
                },
                {
                    "data": "nama_lengkap"
                },
                {
                    "data": "nilai"
                },
                {
                    "data": "keterangan"
                },
            ],
            order: [
                [2, 'desc']
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
    });
</script>