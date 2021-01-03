
const loader = $('#loader').html();
const noData = $('#noData').html();
const errData = $('#errData').html();

window.addEventListener('DOMContentLoaded', (e) => {
    getBerkasData();
});

$('#reload').on('click', () => {
    $('#datatable').DataTable().clear().destroy();
    getBerkasData();
});

const getBerkasData = () => {
    $('#berkasContent').html(loader);
    const url = baseUrl+'berkas/getBerkas';
    let dataset = [];
    $.get(url, (res) => {
        res = JSON.parse(res);
        let dataLength = res.length;
        dataLength > 0 ?
        $.each(res, (i, dt) => {
            i += 1;
            let namaKlien = 'Data Dihapus';
            let namaPengorder = 'Data Dihapus';
            dt.nama_klien != null && (namaKlien = dt.nama_klien);
            dt.nama_pengorder != null && (namaPengorder = dt.nama_pengorder);
            dataset.push([i, dt.no_berkas, getDate(dt.tgl), namaKlien, namaPengorder, dt.keterangan, generateOpr(dt.id)]);
            i == dataLength &&
                setTimeout(() => berkasContent(), 600);
                setTimeout(() => showData(dataset, dataLength), 1000);
        }):
        $('#berkasContent').html(noData);
    })
}

const berkasContent = () => {
    $('#berkasContent').html(`
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
            {title: "No. berkas"},
            {title: "Tangal"},
            {title: "Nama Klien"},
            {title: "Nama Pengorder"},
            {title: "Keterangan"},
            {title: "Operasi"},
        ],
    }),
    $('#datatable thead').addClass('thead-dark')):
    $('#berkasContent').html(errData);
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
                <a class="dropdown-item" href="${baseUrl}berkas/edit/${id}">Edit</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#detailBerkasModal" data-id="${id}">Detail</a>
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
    $.get(baseUrl+'berkas/delete/'+id);
}


$('#detailBerkasModal').on('show.bs.modal', (e) => {
    resetModal();
    let btn = $(e.relatedTarget);
    let id = btn.data('id');
    setTimeout(() => getDetailberkas(id),1000);
});

const resetModal = () => {
    $('#detailTitle').html('');
    $('#detailBody').html(loader);
}

const getDetailberkas = (id) => {
    $.get(`${baseUrl}berkas/getById/${id}`, (res) => {
        res = JSON.parse(res);
        let namaKlien = 'Data Dihapus';
        let namaPengorder = 'Data Dihapus';
        let namaPetugas = 'Data Dihapus';
        res.nama_klien != null && (namaKlien = res.nama_klien);
        res.nama_pengorder != null && (namaPengorder = res.nama_pengorder);
        res.nama_admin != null && (namaPetugas = res.nama_admin);
        $('#detailTitle').html('Detail '+ res.no_berkas + ' - ' + res.jenis);
        $('#detailBody').html(`
            <div class="row">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Petugas</p>
                </div>
                <div class="col-sm-8">
                    <a class="btn btn-sm btn-primary mb-1" href="#">${namaPetugas}</a>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3 bg-light">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Pembeli</p>
                </div>
                <div class="col-sm-8">
                    <p>${namaKlien}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3">
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
                    <p class="font-weight-bold">No. Berkas</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.no_berkas}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Tanggal</p>
                </div>
                <div class="col-sm-8">
                    <p>${getDate(res.tgl)}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3 bg-light">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Jenis Pekerjaan</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.jenis}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3">
                <div class="col-sm-4">
                    <p class="font-weight-bold">CEK / PLOTING</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.ploting}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3 bg-light">
                <div class="col-sm-4">
                    <p class="font-weight-bold">PBB</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.pbb}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3">
                <div class="col-sm-4">
                    <p class="font-weight-bold">BPHTB</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.bphtb}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3 bg-light">
                <div class="col-sm-4">
                    <p class="font-weight-bold">PPH</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.pph}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Dokumen Pihak Pertama</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.dok_pertama}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3 bg-light">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Dokumen Pihak kedua</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.dok_kedua}</p>
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
    url = `${baseUrl}laporan/berkas/${month}/${year}`,
    $('#btnCetak').attr('href', url),
    $('#btnCetak').attr('target', '_BLANK'));
    
});

const getMonth = (year) => {
    $('#month').html('<option value="">Pilih Bulan</option>');
    year != '' && $.get(`${baseUrl}berkas/getMonth/${year}`, async (res) => {
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

