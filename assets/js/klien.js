const loader = $('#loader').html();
const noData = $('#noData').html();
const errData = $('#errData').html();

window.addEventListener('DOMContentLoaded', (e) => {
    getKlienData();
});

$('#reload').on('click', () => {
    $('#datatable').DataTable().clear().destroy();
    getKlienData();
});

const getKlienData = () => {
    $('#klienContent').html(loader);
    const url = `${baseUrl}klien/getKlien`;
    let dataset = [];
    $.get(url, (res) => {
        res = JSON.parse(res);
        let dataLength = res.length;
        dataLength > 0 ?
        $.each(res, (i, dt) => {
            i += 1;
            let data = [i,dt.nama, dt.alamat, dt.hp, generateOpr(dt.id)];
            dataset.push(data);
            i == dataLength &&
                setTimeout(() => klienContent(), 600);
                setTimeout(() => showData(dataset, dataLength), 1000);
        }):
        $('#klienContent').html(noData);
    })
    
}

const klienContent = () => {
    $('#klienContent').html(`
        <div class="table-responsive">
            <table class="table" id="datatable">
            </table>
        </div>
    `)
}

const showData = async (data, dataLength) => {
    let dt = await data;
    dt.length == dataLength ?
    ($('#datatable').DataTable({
        data: data,
        deferRender: true,
        retrieve: true,
        columns: [
            {title: "#"},
            {title: "Nama"},
            {title: "Alamat"},
            {title: "Hp"},
            {title: "Operasi"},
        ],
    }),
    $('#datatable thead').addClass('thead-dark')):
    $('#klienContent').html(errData);
};

const generateOpr = (id) => {
    let opr = `
        <div class="dropdown open">
            <a href="#" class="btn-opr card-header-action" role="button" id="trigger${id}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ` + $('#setButton').html() + `
            </a>
            <div class="dropdown-menu p-1" aria-labelledby="trigger${id}">`;
    aAks == 1 && (
        opr += `<a class="dropdown-item" onclick="delConfirm('${id}')" data-id="${id}">Delete</a>`
    );
    opr += `
                <a class="dropdown-item" href="${baseUrl}klien/edit/${id}">Edit</a>
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
    $.get(`${baseUrl}klien/delete/${id}`);
}

const toDataTable = () => {
    $('#datatable').DataTable();
}