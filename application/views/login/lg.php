<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/templates/dist/css/adminx.css?v1.1') ?>" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('/assets/css/loader.css') ?>" media="screen" />
    <link rel="shortcut icon" href="<?= base_url('assets/templates/demo/img/icon.ico') ?>" type="image/x-icon">
    <script>
        let baseUrl = "<?= base_url() ?>";
    </script>
</head>

<body>
    <div class="adminx-container d-flex justify-content-center align-items-center pt-0">
        <div class="page-login">
            <div class="text-center">
                <a class="navbar-brand mb-4 h1" href="login.html">
                    <img src="<?= base_url('assets/templates/demo/img/logo.png') ?>" class="navbar-brand-image d-inline-block align-top mr-2" alt="">
                    AdminX
                </a>
            </div>

            <div class="card mb-5">
                <div class="card-body">
                    <h3 class="mb-4 text-center">Login</h3>
                    <hr />
                    <form action="" method="POST">
                        <?php if ($this->session->flashdata('flash')) : ?>
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button><?= $this->session->flashdata('flash'); ?>
                            </div>
                        <?php endif; ?>
                        <input type="hidden" name="url" value="<?= $rURL ?>">
                        <div class="form-group">
                            <input type="username" class="form-control" id="username" name="username" placeholder="Username" autofocus required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control pass-form" id="password" name="password" placeholder="Password" required>
							<div class="input-group-append">
                                <span class="input-group-text pass-view"><span data-feather="eye"></span></span>
							</div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-block btn-primary">Login</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="#" data-toggle="modal" data-target="#pwModal"><small>Lupa password?</small></a>
                </div>
            </div>
            <div class="mb-5"></div>
        </div>
    </div>
    
    <div class="no-display">
        <div class="modal-body justify-content-center text-center" id="loader">
            <div class="loader"></div>
        </div>
		<div class="eye">
		<span data-feather="eye"></span>
		</div>
		<div class="eye-off">
		<span data-feather="eye-off"></span>
		</div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="pwModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lupa Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="my-2" id="cont">
                    
                </div>
            </div>
        </div>
    </div>

    <!-- If you prefer jQuery these are the required scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.4/umd/popper.min.js" integrity="sha512-eUQ9hGdLjBjY3F41CScH3UX+4JDSI9zXeroz7hJ+RteoCaY+GP/LDoM8AO+Pt+DRFw3nXqsjh9Zsts8hnYv8/A==" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/templates/dist/js/vendor.js') ?>"></script>
    <script src="<?= base_url('assets/templates/dist/js/adminx.js') ?>"></script>
    <script src="<?= base_url('assets/js/login.js') ?>"></script>

</body>

</html>