var table;
var save_method;
var getUrl = window.location;
var baseUrl = getUrl.protocol + "//" + getUrl.host;

$(document).ready(function () {
    list_peta();

    $("#dusun").select2({
        theme: 'bootstrap4',
        tags: true,
        placeholder: "Desa/ Dusun"
    }).on('select2:close', function () {
        var element = $(this);
        var new_dusun = $.trim(element.val());

        if (isNaN(parseInt(new_dusun)) && new_dusun != '') {
            $.ajax({
                url: baseUrl + "/dashboard/createDusun",
                method: "POST",
                data: { dusun: new_dusun },
                success: function (data) {
                    fetchDusun(data);
                }
            })
        }
    })
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

function fetchDusun(id = 0) {
    $.ajax({
        url: baseUrl + "/dashboard/dusun",
        method: "GET",
        success: function (data) {
            var cat = [];
            $.each(JSON.parse(data), function (index, val) {
                var result = val.id == id ? true : false;
                cat[index] = {
                    'id': val.id,
                    'text': val.nama,
                    'selected': result
                }
            })

            $("#dusun").empty();
            $("#dusun").select2({
                data: cat,
                tags: true,
                placeholder: "Desa/ Dusun"
            });
        }
    })
}

function list_peta() {
    $.ajax({
        url: baseUrl + "/dashboard/ajax_list/",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('#maps-list').empty();
            result = card(data);
            $('#maps-list').append(result);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function card(data = []) {
    var card = ''
    if (data.length >= 1) {
        for (i = 0; i <= data.length; i++) {
            value = data[i]
            if (typeof value !== 'undefined') {
                card += '<div class="col-sm-12 col-md-4 col-lg-3">'
                card += '<div class="card card-outline card-success">'
                card += '<div class="card-header">'
                card += '<a href="' + baseUrl + '/dashboard/keluarga/' + data[i].id + '" style="text-decoration:none; color:black;">'
                card += '<h3 class="card-title">' + data[i].dusun + ', Rw: ' + data[i].rw + ', Rt: ' + data[i].rt + '</h3>'
                card += '</a>'
                card += '<div class="card-tools">';
                card += '<button type="button" class="btn btn-warning btn-xs btn-flat" onclick="edit_peta(' + data[i].id + ')" ><i class="fas fa-edit"></i>'
                card += '</button>';
                card += '&nbsp;&nbsp;&nbsp;'
                card += '<button type="button" class="btn btn-danger btn-xs btn-flat" onclick="delete_peta(' + data[i].id + ')"><i class="fas fa-trash"></i>'
                card += '</button>';
                card += '</div>'
                card += '</div>'
                card += '<div class="card-body" style="text-align:center">'
                card += '<a href="' + baseUrl + '/dashboard/keluarga/' + data[i].id + '" style="text-decoration:none; color:black;">'
                card += '<h3>' + data[i].peta_title + '</h3>'
                card += '<img src="' + baseUrl + '/assets/dist/img/peta/' + data[i].peta_img + '" class="img-responsive" width="100%">'
                card += '</a>'
                card += '</div>'
                card += '</div>'
                card += '</div>'
            }
        }
    }

    return card;
}

function add_peta() {
    save_method = 'add';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $('#photo-preview').hide();
    $('#label-photo').text('Unggah Peta');

    $('.modal-title').text('Tambah Peta Dusun');
    fetchDusun();
    $('#modal_form').modal('show');
}

function edit_peta(id) {
    save_method = 'update';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    fetchDusun();

    $.ajax({
        url: baseUrl + "/dashboard/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('input[name="id"]').val(data.id); // id peta
            $('#dusun').val(data.id_dusun); // id dusun
            $('#dusun').trigger('change');
            $('input[name="rw"]').val(data.rw); // rw
            $('input[name="rt"]').val(data.rt); // rt
            $('input[name="peta_title"]').val(data.peta_title); // judul peta

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Ubah Peta Dusun'); // Set title to Bootstrap modal title

            $('#photo-preview').show(); // show photo preview modal

            if (data.peta_img) {
                $('#label-photo').text('Ubah Peta'); // label photo upload
                $('#photo-preview div').html('<img src="' + baseUrl + '/assets/dist/img/peta/' + data.peta_img + '" class="img-responsive" width="100%">');
            }
            else {
                $('#label-photo').text('Unggah Peta'); // label photo upload
                $('#photo-preview div').text('(Belum ada Peta)');
            }
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
        url = baseUrl + "/dashboard/ajax_add";
    } else {
        url = baseUrl + "/dashboard/ajax_update";
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
                list_peta();
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

function delete_peta(id) {
    if (confirm('Anda Yakin ?')) {
        $.ajax({
            url: baseUrl + "/dashboard/ajax_delete/" + id,
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                $('#modal_form').modal('hide');
                list_peta();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error deleting data');
            }
        });
    }
}