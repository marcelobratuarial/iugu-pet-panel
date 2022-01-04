<?= $this->extend('layouts/main/main') ?>

<?= $this->section('content') ?>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Assinaturas</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="<?= base_url("/") ?>"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Todas as assinaturas</li>
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
        <h6 class="mb-0 text-uppercase">GERENCIAR ASSINATURAS</h6>
        <hr/>
        
        <?php if(isset($assinaturas) && !empty($assinaturas)) : ?>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Cliente</th>
                            <th>Plano</th>
                            <th>Status</th>
                            <th>Valor</th>
                            <th>Período</th>
                            <th>Detalhes</th>
                            <!-- <th>Actions</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($assinaturas as $assinatura) : ?>
                        <tr>
                            <td>
                                <?= $assinatura["customer_email"] ?>
                            </td>
                            <td><?= $assinatura['plan_name'] ?></td>
                            <td>
                                <div class="badge rounded-pill <?= ($assinatura["status"] == 'active') ? " text-success bg-light-success" : ' text-danger bg-light-danger' ?> p-2 text-uppercase px-3">
                                <i class='bx bxs-circle me-1'></i><?= ($assinatura["status"] == 'active') ? " Ativo" : ' Suspenso' ?></div></td>
                            <td><?= $assinatura['real'] ?><span class="term">/mês</span></td>
                            <td><?= $assinatura['periodo'] ?></td>
                            <td>
                            <a href="<?= base_url("assinaturas/details/".$assinatura['id']) ?>" class="btn btn-sm btn-info my-0 radius-30">Detalhes <i class='bx bx-detail me-2 font-18'></i></a>
                            </td>
                            <!-- <td>
                                <div class="d-flex order-actions">
                                    <a href="javascript:;" class=""><i class='bx bxs-edit'></i></a>
                                    <a href="javascript:;" class="ms-3"><i class='bx bxs-trash'></i></a>
                                </div>
                            </td> -->
                        </tr>
                        
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
        
    </div>
</div>

<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="DeletePlanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir plano</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <h1 class="display-6">Confirma?</h1>
                <p class="lead">
                Você realmente deseja <strong>excluir</strong> o plano <strong class="modal-plan-name"></strong>?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" style="margin-right: 0" class="cancelar-excluir-plano-btn btn btn-sm btn-outline-success radius-30" data-bs-dismiss="modal"><i style="margin-right: 0" class="bx bx-x-circle"></i> Cancelar</button>
                <form action="" id="confirmDelPlanForm">
                    <input type="hidden" id="h-plan-id" name="plan_id">
                    <input type="hidden" id="h-plan-name" name="plan_name">
                    <button type="submit" class="btn btn-sm btn-outline-danger confirmar-excluir-plano-btn radius-30">Excluir <i style="margin-right: 0" class="bx bx-x"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="SuccessModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content bg-success">
            <!-- <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> -->
            <div class="modal-body text-light text-center">
                <h3 class="text-light"><i style="font-size: 3.5rem" class="bx bx-check"></i> <br>Concluído</h3>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
            </div> -->
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url("panel/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js") ?>"></script>
<script src="<?= base_url("panel/assets/js/jquery.maskMoney.min.js") ?>"></script>
<script>
    $(document).ready(function() {
        $('#image-uploadify').imageuploadify();
        $('[data-bs-toggle="tooltip"]').tooltip();

        $('#DeletePlanModal').on('hidden.bs.modal', function (e) {
            $("#DeletePlanModal .modal-plan-name").html("[...]")
        })
        $(".delete-plan-btn").on("click", function(e) {
            e.preventDefault()
            var plan_name = $(this).data("plan-name")
            var plan_id = $(this).data("plan-id")
            $("#DeletePlanModal .modal-plan-name").html(plan_name)
            $("#DeletePlanModal #h-plan-id").val(plan_id)
            $("#DeletePlanModal #h-plan-name").val(plan_name)
            $("#DeletePlanModal").modal("show")
        })
        $("#DeletePlanModal").on("submit", "#confirmDelPlanForm", function(e) {
            e.preventDefault()

            $('.confirmar-excluir-plano-btn').addClass('disabled')
            $('.confirmar-excluir-plano-btn').attr('disabled', true)
            $('.confirmar-excluir-plano-btn').html('Aguarde... <i class="bx bx-loader-circle bx-spin"></i>')
            
            $('.cancelar-excluir-plano-btn').addClass('disabled')
            $('.cancelar-excluir-plano-btn').attr('disabled', true)
            
            $('.genericOverlay').fadeIn(50)
            var s = $(this).serializeArray()
            // console.log(s)
            // return
            var url = '<?= base_url('/api') ?>';
            var payload = {
                'call': 'plans/'+$("#DeletePlanModal #h-plan-id").val(),
                'method': 'DELETE',
                'payload': {
                    id: $("#DeletePlanModal #h-plan-id").val()
                }
            }
            
            $.ajax({
                type: "POST",
                url: url,
                data: payload,
                fail: function(r) {
                    console.log(r)
                },
                success: function(response) {
                    console.log(response)
                    // console.log(typeof response.error)
                    if (response.error) {





                    } else {

                        
                        $("#SuccessModal").modal("show")
                        setTimeout(() => {
                            $("#SuccessModal").modal("hide")
                            window.location.href = "<?= base_url('/planos') ?>"
                        }, 2500);
                    }
                    $('.save-plan-btn').removeClass('disabled')
                    $('.save-plan-btn').removeAttr('disabled')
                    $('.save-plan-btn').html('Salvar plano')
                    $('.features-loading').fadeOut(1000)
                    $('.genericOverlay').fadeOut(1000)
                },
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

           
        })

    })

    
    $("body").off("paste", "[contenteditable]").on("paste", "[contenteditable]", function(e) {
        e.preventDefault();
        let text = "";
        
        text = e.originalEvent.clipboardData.getData("text/plain");
        document.execCommand("insertHTML", false, text);
    
        if (text !== null && text.trim().length > 0) {
            $(this).siblings( /* Fake Placeholder */ ).hide();
        }
    });


    $("#inputPrice").maskMoney({
        prefix: 'R$ ',
        thousands: '.',
        decimal: ',',
        precision: 2,
        allowZero: true,
        affixesStay: true
    });
    var sl = function(t) {
        return t
            .toLowerCase()
            .replace(/[^\w ]+/g, '')
            .replace(/ +/g, '_');
    }
</script>
<?php //$this->include('layouts/main/parts/footer') 
?>
<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<?= $this->include('layouts/main/parts/footer') ?>
<?= $this->endSection() ?>