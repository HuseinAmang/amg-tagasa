var table;
var save_method;
var getUrl = window.location;
var baseUrl = getUrl.protocol + "//" + getUrl.host;
var dpath = getUrl.pathname
var path = dpath.split("/");

$(document).ready(function () {
    list_keluarga();
})

function switchLang($lang) {
    $.ajax({
        url: baseUrl + "/index/switch_lang",
        type: "POST",
        data: {
            idiom: $lang
        },
        success: function (data) {
            location.reload();
        }
    });
}

function list_keluarga() {
    $.ajax({
        url: baseUrl + "/dashboard/ajax_list_kel/" + path[3],
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('#data_keluarga').empty();
            result = card(data);
            $('#data_keluarga').append(result);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function card(data = []) {
    var table = ''
    if (data.length >= 1) {
        for (i = 0; i <= data.length; i++) {
            value = data[i]
            if (typeof value !== 'undefined') {
                table += '<tr>'
                table += '<td>' + data[i].nama_kk + '</td>'
                table += '<td>' + data[i].no_kk + '</td>'
                table += '<td>' + data[i].no_rumah + '</td>'
                table += '<td>'
                table += '<div class="btn-group">'
                table += '<button type="button" class="btn btn-warning btn-sm" onclick="edit_keluarga(' + data[i].id + ')"><i class="fas fa-edit"></i></button>'
                table += '<button type="button" class="btn btn-danger btn-sm" onclick="delete_keluarga(' + data[i].id + ')"><i class="fas fa-trash"></i></button>'
                table += '</div>'
                table += '</td>'
                table += '</tr>'
            }
        }
    }

    return table;
}

function add_keluarga() {
    save_method = 'add';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $('.modal-title').text('Tambah Keluarga');
    $('#modal_form').modal('show');
}

function edit_keluarga(id) {
    save_method = 'update';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $.ajax({
        url: baseUrl + "/dashboard/ajax_edit_kel/" + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('input[name="id"]').val(data.id); // id kel
            $('input[name="id_peta"]').val(data.id_peta); // id peta
            $('input[name="no_kk"]').val(data.no_kk); // no kk
            $('input[name="no_rumah"]').val(data.no_rumah); // no rumah
            $('input[name="nama_kk"]').val(data.nama_kk); // nama kk

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Ubah Keluarga'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function save() {
    $('#btnSave').text('Menyimpan ...');
    $('#btnSave').attr('disabled', true);
    var url;

    if (save_method == 'add') {
        url = baseUrl + "/dashboard/ajax_add_kel";
    } else {
        url = baseUrl + "/dashboard/ajax_update_kel";
    }

    var formData = new FormData($('#form')[0]);

    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {
            if (data.status) {
                $('#modal_form').modal('hide');
                list_keluarga();
            }
            else {
                console.log(data);
            }
            $('#btnSave').text('Simpan');
            $('#btnSave').attr('disabled', false);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error adding / update data');
            $('#btnSave').text('Simpan');
            $('#btnSave').attr('disabled', false);
        }
    });
}

function delete_keluarga(id) {
    if (confirm('Anda Yakin ?')) {
        $.ajax({
            url: baseUrl + "/dashboard/ajax_delete_kel/" + id,
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                $('#modal_form').modal('hide');
                list_keluarga();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error deleting data');
            }
        });
    }
}