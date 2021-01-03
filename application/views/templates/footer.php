<div class="no-display">
    <div id="loader">
        <div class="text-center my-2">
            <div class="loader"></div>
            <p>Memuat Data</p>
        </div>
    </div>
    <div id="setButton">
        <i data-feather="settings"></i>
    </div>
    <div id="noData">
        <div class="my-3 text-center">
            <p class="btn btn-secondary">Tidak ada data !</p>
        </div>
    </div>
    <div id="errData">
        <div class="my-3 text-center">
            <p class="text-danger">Terjadi kesalahan, silahkan tekan tombol refresh kembali atau refresh halaman ini! </p>
        </div>
    </div>
    <div class="eye">
    <span data-feather="eye"></span>
    </div>
    <div class="eye-off">
    <span data-feather="eye-off"></span>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js" integrity="sha512-OQlawZneA7zzfI6B1n1tjUuo3C5mtYuAWpQdg+iI9mkDoo7iFzTqnQHf+K5ThOWNJ9AbXL4+ZDwH7ykySPQc+A==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment-with-locales.min.js" integrity="sha512-EATaemfsDRVs6gs1pHbvhc6+rKFGv8+w4Wnxk4LmkC0fzdVoyWb+Xtexfrszd1YuUMBEhucNuorkf8LpFBhj6w==" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.19/sorting/datetime-moment.js"></script>
<script src="<?= base_url('assets/templates/dist/js/vendor.js') ?>"></script>
<script src="<?= base_url('assets/templates/dist/js/adminx.js') ?>"></script>

<?php if (isset($script)) : ?>
    <script src="<?= base_url('/assets/js/'.$script.'.js') ?>"></script>
<?php endif; ?>

<script>
    $('#saveKlien').on('click', () => {
        $('#namaKlien').val() != '' &&
            $.post(`${baseUrl}klien/addKlien`, {
                'nama': $('#namaKlien').val(),
                'hp': $('#hpKlien').val()
            }, (data) => location.reload());
    });

    $('#savePengorder').on('click', () => {
        $('#namaPengorder').val() != '' &&
            $.post(`${baseUrl}pengorder/addPengorder`, {
                'nama': $('#namaPengorder').val(),
                'hp': $('#hpPengorder').val()
            }, (data) => location.reload());
    });

    let eye = $('.eye').html(), eyeOff = $('.eye-off').html();

    $('.pass-view').on('click', () => {
        $('.pass-form').attr('type') == 'password' 
        ?
        ($('.pass-form').attr('type', 'text'),
        $('.pass-view').html(eyeOff))
        :
        ($('.pass-form').attr('type', 'password'),
        $('.pass-view').html(eye));
    });
    
    <?php if(isset($choice)): ?>
    const element = document.querySelector('.js-choice');
    const element1 = document.getElementById('first-option');
    const element2 = document.getElementById('second-option');
    const element3 = document.getElementById('klienBerkas');
    const element4 = document.getElementById('pengorderBerkas');
    const choices = new Choices(element);
    const choices3 = new Choices(element3);
    const choices4 = new Choices(element4);
    const choices1 = new Choices(element1, { removeItemButton: true});
    const choices2 = new Choices(element2, { removeItemButton: true});
    <?php endif; ?>

    <?php if ($this->session->flashdata('flash')) : ?>
        window.addEventListener('DOMContentLoaded', () => {
            swal(
                'Berhasil',
                '<?= $this->session->flashdata('flash'); ?>',
                'success'
            );
        });
    <?php endif; ?>

    <?php if ($this->session->flashdata('notif')) : ?>
        const notification = new window.notifications();
        notification.fire('<?= $this->session->flashdata('notif') ?>', {
            autoHide: true,
            playSound: false,
            duration: 3000,
            style: 'secondary',
        });
    <?php endif; ?>
</script>

</body>

</html>