<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="<?= base_url("panel/assets/images/favicon-32x32.png") ?>" type="image/png" />
    <!--plugins-->
    <link href="<?= base_url("panel/assets/plugins/simplebar/css/simplebar.css") ?>" rel="stylesheet" />
    <link href="<?= base_url("panel/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css") ?>" rel="stylesheet" />
    <link href="<?= base_url("panel/assets/plugins/metismenu/css/metisMenu.min.css") ?>" rel="stylesheet" />
    <!-- loader-->
    <link href="<?= base_url("panel/assets/css/pace.min.css") ?>" rel="stylesheet" />
    <script src="<?= base_url("panel/assets/js/pace.min.js") ?>"></script>
    <!-- Bootstrap CSS -->
    <link href="<?= base_url("panel/assets/css/bootstrap.min.css") ?>" rel="stylesheet">
    <link href="<?= base_url("panel/assets/css/bootstrap-extended.css") ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="<?= base_url("panel/assets/css/app.css") ?>" rel="stylesheet">
    <link href="<?= base_url("panel/assets/css/icons.css") ?>" rel="stylesheet">
    <title>AUTH - IUGU PET PANEL</title>
</head>

<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">
    <?= $this->renderSection('content') ?>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="<?= base_url("panel/assets/js/bootstrap.bundle.min.js") ?>"></script>
    <!--plugins-->
    <script src="<?= base_url("panel/assets/js/jquery.min.js") ?>"></script>
    <script src="<?= base_url("panel/assets/plugins/simplebar/js/simplebar.min.js") ?>"></script>
    <script src="<?= base_url("panel/assets/plugins/metismenu/js/metisMenu.min.js") ?>"></script>
    <script src="<?= base_url("panel/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js") ?>"></script>
    <!--Password show & hide js -->
    <?= $this->renderSection('scripts') ?>
    
    <!--app JS-->
    <script src="<?= base_url("panel/assets/js/app.js") ?>"></script>
</body>

</html>


