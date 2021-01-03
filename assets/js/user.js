
const loader = $('#loader').html();
const noData = $('#noData').html();
const errData = $('#errData').html();

window.addEventListener('DOMContentLoaded', () => {
    getUserData();
});

$('#reload').on('click', () => {
    $('#datatable').DataTable().clear().destroy();
    getUserData();
});

const getUserData = () => {
    $('#userContent').html(loader);
    const url = `${baseUrl}user/getUser`;
    let dataset = [];
    $.get(url, (res) => {
        res = JSON.parse(res);
        let dataLength = res.length;
        dataLength > 0 ?
        $.each(res, (i, dt) => {
            i += 1;
            let akses = dt.akses == 0 ? 'Admin' : 'Superadmin';
            data = [i, dt.nama, dt.email, akses, generateOpr(dt.id, dt.akses)];
            dataset.push(data);
            i == dataLength &&
            setTimeout(() => userContent(), 600);
            setTimeout(() => showData(dataset, dataLength), 1000);
        }):
        $('#userContent').html(noData);
    });
}

const userContent = () => {
    $('#userContent').html(`
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
        retrieve: true,
        deferRender: true,
        columns: [
            {title: "#"},
            {title: "Nama"},
            {title: "Email"},
            {title: "Akses"},
            {title: "Operasi"},
        ],
    }),
    $('#datatable thead').addClass('thead-dark')):
    $('#userContent').html(errData);
};

const generateOpr = (id, akses) => {
    const setButton = $('#setButton').html();
    let textButton = akses == 1 ? 'Hapus Akses' : 'Beri Akses';
    let opr;
    aAks == 1 ?
        opr = `
        <div class="dropdown open">
            <a href="#" class="btn-opr card-header-action" role="button" id="trigger${id}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ${setButton}
            </a>
            <div class="dropdown-menu p-1" aria-labelledby="trigger${id}">
                <a class="dropdown-item" href="${baseUrl}user/edit/${id}">Edit</a>
                <a class="dropdown-item" onclick="delConfirm('${id}')">Delete</a>
                <a class="dropdown-item" href="${baseUrl}/user/akses/${id}/${akses}" data-id="${id}">${textButton}</a>
            </div>
        </div>
    ` :
        opr = '';
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
    $.get(`${baseUrl}user/delete/${id}`);
}

const toDataTable = () => {
    $('#datatable').DataTable();
}
