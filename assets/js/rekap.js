
const loader = $('#loader').html();
const noData = $('#noData').html();
const errData = $('#errData').html();

window.addEventListener('DOMContentLoaded', (e) => {
    getRekapData();
});

$('#reload').on('click', () => {
    $('#datatable').DataTable().clear().destroy();
    getRekapData();
});

const getRekapData = () => {
    $('#rekapContent').html(loader);
    const url = baseUrl+'rekap/getRekap';
    let dataset = [];
    $.get(url, (res) => {
        res = JSON.parse(res);
        let dataLength = res.length;
        dataLength > 0 ?
        $.each(res, (i, dt) => {
            i += 1;
            let namaPengorder = 'Data Dihapus';
            dt.nama_pengorder != null && (namaPengorder = dt.nama_pengorder);
            let data = [i, namaPengorder, dt.no_urut, getDate(dt.tgl_masuk), getDate(dt.tgl_keluar), dt.status, generateOpr(dt.id)]
            dataset.push(data);
            i == dataLength &&
                setTimeout(() => rekapContent(), 600);
                setTimeout(() => showData(dataset, dataLength), 1000);
        }):
        $('#rekapContent').html(noData);
    })
}

const rekapContent = () => {
    $('#rekapContent').html(`
        <div class="table-responsive">
            <table class="table" id="datatable">
            </table>
        </div>
    `)
}

const showData = async (data, dataLength) => {
    let dt = await data;
    dt.length == dataLength ?
    ($.fn.dataTable.moment('DD-MMMM-YYYY'),
    $('#datatable').DataTable({
        data: data,
        retrieve: true,
        deferRender: true,
        columns: [
            {title: "#"},
            {title: "Pengorder"},
            {title: "No. Urut Sertifikat"},
            {title: "Tanggal Masuk"},
            {title: "Tanggal Keluar"},
            {title: "Status"},
            {title: "Operasi"},
        ],
    }),
    $('#datatable thead').addClass('thead-dark')):
    $('#rekapContent').html(errData);
};

const getDate = (date) => {
    moment.locale('id');
    let dateParsing = moment(date).format('DD-MMMM-YYYY');
    return dateParsing;
}

const generateOpr = (id) => {
    let opr = '';
    let setButton = $('#setButton').html() ;
    opr +=`
        <div class="dropdown open">
            <a href="#" class="btn-opr card-header-action" role="button" id="trigger${id}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ${setButton}
            </a>
            <div class="dropdown-menu p-1" aria-labelledby="trigger${id}">`;
    aAks == 1 && (
    opr += `
                <a class="dropdown-item" onclick="delConfirm('${id}')">Delete</a>`);
    opr += `    
                <a class="dropdown-item" href="${baseUrl}rekap/edit/${id}">Edit</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#detailRekapModal" data-id="${id}">Detail</a>
            </div>
        </div>
    `;
    return opr;
}

const delConfirm = (id) => {
    swal({
        title: 'Hapus Data',
        text: 'Apakah anda yakin ingin menghapus data ini?',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    }).then(result => {
        result && (
            delData(id),
            swal(
                'Berhasil',
                'Data Berhasil Dihapus',
                'success'
            ),
            $('#datatable').DataTable().row($(`a[data-id="${id}"]`).parents('tr')).remove().draw()
        );
    });
}

const delData = (id) => {
    $.get(baseUrl+'rekap/delete/'+id);
}


$('#detailRekapModal').on('show.bs.modal', (e) => {
    resetModal();
    let btn = $(e.relatedTarget);
    let id = btn.data('id');
    setTimeout(() => getDetailrekap(id),1000);
});

const resetModal = () => {
    $('#detailTitle').html('');
    $('#detailBody').html(loader);
}

const getDetailrekap = (id) => {
    $.get(`${baseUrl}rekap/getById/${id}`, (res) => {
        res = JSON.parse(res);
        let namaPengorder = 'Data Dihapus';
        res.nama_pengorder != null && (namaPengorder = res.nama_pengorder);
        $('#detailTitle').html('Detail '+ res.data_sertifikat);
        $('#detailBody').html(`
            <div class="row">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Pengorder</p>
                </div>
                <div class="col-sm-8">
                    <p>${namaPengorder}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3 bg-light">
                <div class="col-sm-4">
                    <p class="font-weight-bold">No. Urut Sertifikat</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.no_urut}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Data Sertifikat</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.data_sertifikat}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3 bg-light">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Status</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.status}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Tanggal Masuk</p>
                </div>
                <div class="col-sm-8">
                    <p>${getDate(res.tgl_masuk)}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3 bg-light">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Tanggal Keluar</p>
                </div>
                <div class="col-sm-8">
                    <p>${getDate(res.tgl_keluar)}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Keterangan</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.keterangan}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3 bg-light">
                <div class="col-sm-4">
                    <p class="font-weight-bold">NB</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.nb}</p>
                </div>
            </div>
        `);
    });
}

const toDataTable = () => {
    $('#datatable').DataTable();
}

$('#year').on('change', () => {
    let year = $('#year').val();
    getMonth(year);
});

$('#month').on('change', () => {
    let month = $('#month').val();
    let year = $('#year').val();
    let url = '';
    year != '' && month != '' && (
    url = `${baseUrl}laporan/rekap/${month}/${year}`,
    $('#btnCetak').attr('href', url),
    $('#btnCetak').attr('target', '_BLANK'));
    
});

const getMonth = (year) => {
    $('#month').html('<option value="">Pilih Bulan</option>');
    year != '' && $.get(`${baseUrl}rekap/getMonth/${year}`, async (res) => {
        res = await res;
        res = JSON.parse(res);
        res.length > 0 && $.each(res, (i , dt) => {
            moment.updateLocale('id');
            let date = moment(`2000-${dt.month}-1`);
            $('#month').append(`<option value="${date.format('M')}">${date.format('MMMM')}</option>`)
        })
    })
}

$('#btnCetak').on('click', () => {
    setTimeout(() => {
        $('#month').prop('selectedIndex',0);
        $('#year').prop('selectedIndex',0);
        $('#btnCetak').attr('href','#');
        $('#btnCetak').removeAttr('target');
    },100);
});

