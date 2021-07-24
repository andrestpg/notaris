const loader = $('#loader').html();
const noData = $('#noData').html();
const errData = $('#errData').html();

window.addEventListener('DOMContentLoaded', (e) => {
    getAktaData();
});

$('#reload').on('click', () => {
    $('#datatable').DataTable().clear().destroy();
    getAktaData();
});

const getAktaData = () => {
    $('#aktaContent').html(loader);
    const url = baseUrl+'akta/getAkta';
    let dataset = [];
    $.get(url).done( async (res) => {
        res = await JSON.parse(res);
        await $.each(res, async (i, dt) => {
            i += 1;
            let namaKlien = 'Data Dihapus';
            dt.knama != null && (namaKlien = dt.knama);
            let data = [i, namaKlien, dt.no_berkas, await getDate(dt.tgl_akta),dt.sifat_akta, dt.no_akta, await generateOpr(dt.id)]
            dataset.push(data);
        });
        aktaContent().then((mess) => {mess == "success" && showData(dataset)});
    }).fail(() => {
        $('#aktaContent').html(noData);
    });
}

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
                <a class="dropdown-item" href="${baseUrl}akta/edit/${id}">Edit</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#detailAktaModal" data-id="${id}">Detail</a>
            </div>
        </div>
    `;
    return opr;
}

const aktaContent = () => {
    return new Promise(async (res, rej) => {
        await $('#aktaContent').html(`
            <div class="table-responsive">
                <table class="table" id="datatable">
                </table>
            </div>
        `)
        res("success");
    })
}

const showData = async (data) => {
    let dt = await data;
    $.fn.dataTable.moment('DD-MMMM-YYYY');
    $('#datatable').DataTable({
        data: dt,
        retrieve: true,
        deferRender: true,
        columns: [
            {title: "#"},
            {title: "Nama Klien"},
            {title: "No Berkas"},
            {title: "Tanggal Akta"},
            {title: "Sifat Akta"},
            {title: "No. Akta"},
            {title: "Operasi"},
        ],
    });
    $('#datatable thead').addClass('thead-dark');
};

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
    $.get(baseUrl+'akta/delete/'+id);
}


$('#detailAktaModal').on('show.bs.modal', (e) => {
    resetModal();
    let btn = $(e.relatedTarget);
    let id = btn.data('id');
    setTimeout(() => getDetailAkta(id),1000);
});

const resetModal = () => {
    $('#detailTitle').html('');
    $('#detailBody').html(loader);
}

const getDetailAkta = (id) => {
    $.get(`${baseUrl}akta/getById/${id}`, (res) => {
        res = JSON.parse(res);
        let namaKlien = 'Data Dihapus';
        res.knama != null && (namaKlien = res.knama);
        $('#detailTitle').html('Detail '+ res.no_berkas);
        $('#detailBody').html(`
            <div class="row">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Pengahadap</p>
                </div>
                <div class="col-sm-8">
                    <p>${namaKlien}</p>
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
                    <p class="font-weight-bold">Tanggal Akta</p>
                </div>
                <div class="col-sm-8">
                    <p>${getDate(res.tgl_akta)}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3 bg-light">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Sifat Akta</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.sifat_akta}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3">
                <div class="col-sm-4">
                    <p class="font-weight-bold">No. Akta</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.no_akta}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3 bg-light">
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
    url = `${baseUrl}laporan/akta/${month}/${year}`,
    $('#btnCetak').attr('href', url),
    $('#btnCetak').attr('target', '_BLANK'));
    
});

const getMonth = (year) => {
    $('#month').html('<option value="">Pilih Bulan</option>');
    year != '' && $.get(`${baseUrl}akta/getMonth/${year}`, async (res) => {
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