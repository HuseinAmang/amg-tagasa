<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <?= $title ?>
                        &nbsp;&nbsp;
                        <a href="javascript:void(0)" onclick="add_peta()" class="btn btn-primary btn-sm btn-flat" data-tooltip="tooltip" data-placement="top" title="Tambah Peta">
                            <i class="fa fa-plus"></i> Tambah Peta
                        </a>
                    </h1>
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
            <div class="row" id="maps-list">
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
                    <!-- dusun -->
                    <div class="form-group">
                        <label class="control-label col-md-3">Desa/ Dusun</label>
                        <div class="col-md-9">
                            <select name="id_dusun" class="form-control select2" id="dusun" aria-describedby="dusunHelpBlock">
                                <option value="">options</option>
                            </select>
                            <span class="help-block"></span>
                            <small id="dusunHelpBlock" class="form-text text-muted">
                                Bila Nama Desa/ Dusun Tidak Ada, Silahkan Ketikkan Secara Manual
                            </small>
                        </div>
                    </div>
                    <!-- rw -->
                    <div class="form-group">
                        <label class="control-label col-md-3">No. Rw</label>
                        <div class="col-md-9">
                            <input name="rw" placeholder="No. Rw" class="form-control" type="number">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!-- rt -->
                    <div class="form-group">
                        <label class="control-label col-md-3">No. Rt</label>
                        <div class="col-md-9">
                            <input name="rt" placeholder="No. Rt" class="form-control" type="number">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!-- peta -->
                    <div class="form-group" id="photo-preview">
                        <label class="control-label col-md-3">Peta</label>
                        <div class="col-md-9">
                            (Belum Ada Peta)
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" id="label-photo">Unggah Peta </label>
                        <div class="col-md-9">
                            <input name="peta_img" type="file">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!-- nama peta -->
                    <div class="form-group">
                        <label class="control-label col-md-3">Nama Peta</label>
                        <div class="col-md-9">
                            <input name="peta_title" placeholder="Nama Peta" class="form-control" type="text">
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