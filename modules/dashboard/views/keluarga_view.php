<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?= $breadcrumbs ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div id="infoMessage"><?php echo $message; ?></div>
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><?= $petaDusun->dusun . ', Rw: ' . $petaDusun->rw . ', Rt: ' . $petaDusun->rt ?></h3>
                    <div class="card-tools">
                        <a href="<?= base_url('dashboard/cetak/' . $petaDusun->id) ?>" target="_blank" class="btn btn-xs btn-flat btn-primary">
                            <i class="fas fa-print"></i> Cetak
                        </a>
                    </div>
                </div>
                <div class="card-body" style="text-align:center">
                    <h3><?= $petaDusun->peta_title; ?></h3>
                    <img src="<?= base_url('assets/dist/img/peta/') . $petaDusun->peta_img ?>" width="100%" class="img-responsive" />
                </div>
            </div>

            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Daftar Keluarga</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-xs btn-flat btn-success" onclick="add_keluarga()">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">No KK</th>
                                    <th scope="col">No Rumah</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="data_keluarga">
                                <tr>
                                    <td>Cell</td>
                                    <td>Cell</td>
                                    <td>Cell</td>
                                    <td>Cell</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/. container -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Small Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="form" class="form-horizontal">
                    <!-- id -->
                    <input type="hidden" value="" name="id" />
                    <input type="hidden" value="<?= $petaDusun->id ?>" name="id_peta" />
                    <!-- nama kk -->
                    <div class="form-group">
                        <label class="control-label col-md-3">Nama KK</label>
                        <div class="col-md-9">
                            <input name="nama_kk" placeholder="Nama KK" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!-- no kk -->
                    <div class="form-group">
                        <label class="control-label col-md-3">No. KK</label>
                        <div class="col-md-9">
                            <input name="no_kk" placeholder="No. KK" class="form-control" type="number">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!-- no rumah -->
                    <div class="form-group">
                        <label class="control-label col-md-3">No. Rumah</label>
                        <div class="col-md-9">
                            <input name="no_rumah" placeholder="No. Rumah" class="form-control" type="number">
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="save()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- /.Modal -->