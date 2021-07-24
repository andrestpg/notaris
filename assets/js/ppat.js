const loader = $('#loader').html();
const noData = $('#noData').html();
const errData = $('#errData').html();

window.addEventListener('DOMContentLoaded', () => {
    getPpatData();
});

$('#reload').on('click', () => {
    $('#datatable').DataTable().clear().destroy();
    getPpatData();
});

const getPpatData = () => {
    $('#ppatContent').html(loader);
    const url = baseUrl+'ppat/getPpat';
    globalThis.dataset = [];
    $.get(url).done( async (res) => {
        res = await JSON.parse(res);
        i = 1;
        for(const dt of res){
            try{
                    let pemberi = await getPemberi(dt.id);
                    let penerima = await getPenerima(dt.id);
                    await dataset.push([i, dt.nama_pengorder, dt.hukum, await getDate(dt.tgl_akta),pemberi, penerima, await generateOpr(dt.id)]);
            }catch(err){
                console.log(err);
            }
            i++;
        }
        ppatContent().then((mess) => {mess == "success" && showData(dataset)});
    }).fail(() => {
        $('#ppatContent').html(errData);
    });
}

const ppatContent = () => {
    return new Promise( async (res, rej) => {
        await $('#ppatContent').html(`
            <div class="table-responsive-md no-wrap">
                <table class="table table-actions table-striped table-hover mb-0" id="datatable">
                </table>
            </div>
        `);
        res("success");
    });
}

const showData = async (data) => {
    let dt = await data;
    $.fn.dataTable.moment('DD-MMMM-YYYY');
    $('#datatable').DataTable({
        data: dt,
        deferRender: true,
        retrieve: true,
        columns: [
            {title: "#"},
            {title: "Pengorder"},
            {title: "Hukum"},
            {title: "Tanggal Akta"},
            {title: "Pihak Pemberi"},
            {title: "Pihak Penerima"},
            {title: "Operasi"},
        ],
    });
    $('#datatable thead').addClass('thead-dark');
};

const getPemberi = async (ppat) => {
    let data = '';
    let url = `${baseUrl}ppat/getPemberi/${ppat}`;
    await $.get(url, (res) => {
        res = JSON.parse(res);
        $.each(res, (i, dt) => {
            data += '<a class="btn btn-sm btn-secondary mr-1 mb-1" href="#">'+dt.nama_klien+'</a>'
        });
    });
    return data;
}

const getPenerima = async (ppat) => {
    let data = '';
    let url = `${baseUrl}ppat/getPenerima/${ppat}`;
    await $.get(url, (res) => {
        res = JSON.parse(res);
        $.each(res, (i, dt) => {
            data += '<a class="btn btn-sm btn-success mr-1 mb-1" href="#">'+dt.nama_klien+'</a>'
        });
    });
    return data;
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
                <a class="dropdown-item" href="${baseUrl}ppat/edit/${id}">Edit</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#detailPpatModal" data-id="${id}">Detail</a>
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
    $.get(`${baseUrl}ppat/delete/${id}`);
}

$('#detailPpatModal').on('show.bs.modal', (e) => {
    resetModal();
    let btn = $(e.relatedTarget);
    let id = btn.data('id');
    setTimeout(() => getDetailPpat(id),1000);
});

const resetModal = () => {
    $('#detailTitle').html('');
    $('#detailBody').html(loader);
}

const getDetailPpat = (id) => {
    $.get(`${baseUrl}ppat/getById/${id}`, async (res) => {
        res = JSON.parse(res);
        let pemberi = await getPemberi(res.id);
        let penerima = await getPenerima(res.id);
        $('#detailTitle').html('Detail '+ res.no_akta);
        $('#detailBody').html(`
            <div class="row">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Pemberi</p>
                </div>
                <div class="col-sm-8">
                    ${pemberi}
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3 bg-light">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Penerima</p>
                </div>
                <div class="col-sm-8">
                    ${penerima}
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Pengorder</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.nama_pengorder}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3 bg-light">
                <div class="col-sm-4">
                    <p class="font-weight-bold">No. Akta</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.no_akta}</p>
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
                    <p class="font-weight-bold">Hukum</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.hukum}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Jenis Hak</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.jenis_hak}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3 bg-light">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Letak</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.letak}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Luas Tanah</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.luas_tanah}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3 bg-light">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Luas Bangunan</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.luas_bangunan}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3">
                <div class="col-sm-4">
                    <p class="font-weight-bold">Harga</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.harga}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3 bg-light">
                <div class="col-sm-4">
                    <p class="font-weight-bold">NOP Tahun</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.nop_tahun}</p>
                </div>
            </div>
            <hr class="m-0"/>
            <div class="row pt-3">
                <div class="col-sm-4">
                    <p class="font-weight-bold">NJOP</p>
                </div>
                <div class="col-sm-8">
                    <p>${res.njop}</p>
                </div>
            </div>
            ${getSSData(res.jml_ssb, res.tgl_ssb, 'SSB')}
            ${getSSData(res.jml_ssp, res.tgl_ssp, 'SSP')}
        `);
    });
}

const getSSData = (val, date, text) => {
    let data = '';
    val > 0 &&
    (data = `
    <hr class="m-0"/>
    <div class="row pt-3 bg-light">
        <div class="col-sm-4">
            <p class="font-weight-bold">Jumlah ${text}</p>
        </div>
        <div class="col-sm-8">
            <p>${val}</p>
        </div>
    </div>
    <hr class="m-0"/>
    <div class="row pt-3">
        <div class="col-sm-4">
            <p class="font-weight-bold">Tanggal ${text}</p>
        </div>
        <div class="col-sm-8">
            <p>${getDate(date)}</p>
        </div>
    </div>`);
    return data;
}

const toDataTable = () => {
    $('#datatable').DataTable();
}

$('#year').on('change', () => {
    let year = $('#year').val();
    getMonth(year);
});

const getMonth = (year) => {
    $('#month').html('<option value="">Pilih Bulan</option>');
    year != '' && $.get(`${baseUrl}ppat/getMonth/${year}`, async (res) => {
        res = await res;
        res = JSON.parse(res);
        res.length > 0 && $.each(res, (i , dt) => {
            moment.locale('id');
            let date = moment(`2000-${dt.month}-1`);
            $('#month').append(`<option value="${date.format('M')}">${date.format('MMMM')}</option>`)
        })
    })
}

$('#month').on('change', () => {
    let month = $('#month').val();
    let year = $('#year').val();
    year != '' && month != '' && generateLink(month,year);
});

const generateLink = (month, year) => {
    let url = `${baseUrl}laporan/ppat/${month}/${year}`;
    $('#btnCetak').attr('href', url);
    $('#btnCetak').attr('target', '_BLANK');
}

$('#btnCetak').on('click', () => {
    resetForm();
    resetLink();
});

const resetForm = () => {
    setTimeout(() => {
        $('#month').prop('selectedIndex',0);
        $('#year').prop('selectedIndex',0);
    },100);
}

const resetLink = () => {
    setTimeout(() => {
        $('#btnCetak').attr('href','#');
        $('#btnCetak').removeAttr('target');
    },100);
}
