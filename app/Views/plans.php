<?= $this->extend('layouts/main/main') ?>

<?= $this->section('content') ?>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Planos</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="<?= base_url("/") ?>"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Todos os planos</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="pricing-table">
        <h6 class="mb-0 text-uppercase">GERENCIAR PLANOS</h6>
        <hr/>
        <div class="row row-cols-1 row-cols-lg-3">
            <?php if(isset($plans) && !empty($plans)) : ?>
                <?php foreach($plans as $plan) : ?>
                    <div class="col">
                        <div class="card mb-5 mb-lg-0">
                            <div class="card-header bg-primary py-3"><?php //print_r($plan) ?>
                                <h5 class="card-title text-white text-uppercase text-center"><?= $plan['name'] ?></h5>
                                <h6 class="card-price text-white text-center"><?= $plan['real'] ?><span class="term">/mês</span></h6>
                            </div>
                            <div class="card-body">
                                <?php if(isset($plan["features"]) && !empty($plan["features"])) : ?>
                                    <ul class="list-group list-group-flush">
                                        <?php foreach($plan["features"] as $feature) : ?>
                                        <li class="list-group-item"><i class='bx bx-check me-2 font-18'></i><?= $feature['name'] ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                <?php else : ?>
                                    Nenhum recurso
                                <?php endif; ?>
                                <!-- <div class="d-grid"> <a href="#" class="btn btn-success my-2 radius-30">ASSINAR</a>
                                </div> -->
                            </div>
                            <div class="card-footer">
                                <a href="<?= base_url("planos/edit/".$plan['id']) ?>" class="btn btn-info my-2 radius-30">Editar <i class='bx bx-edit-alt me-2 font-18'></i></a>
                                <a href="#" class="btn btn-danger my-2 radius-30">Deletar <i class='bx bx-trash me-2 font-18'></i></a>
                                <!-- <div class="d-grid">
                                </div> -->
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            
        </div>
        <!--end row-->
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<?= $this->include('layouts/main/parts/footer') ?>
<?= $this->endSection() ?>