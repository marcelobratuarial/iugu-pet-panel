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
                    <li class="breadcrumb-item" aria-current="page"><a href="<?= base_url("planos") ?>">Planos</a></li>
                    <li class="breadcrumb-item" aria-current="page">Editar</li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $plan["name"] ?></li>
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

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">EDITAR PLANO</h5>
            <hr />
            <?php //print_r($plan); ?>
            <div class="form-body mt-4">
                
                <form action="" id="editPlanForm">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="border position-relative border-3 p-4 rounded">
                                <div class="genericOverlay"></div>
                                <div class="mb-3">
                                    <label for="inputPlanName" class="form-label">Nome do plano</label>
                                    <input type="text" name="name" class="form-control" id="inputPlanName" value="<?= $plan["name"] ?>"
                                        placeholder="Nome do plano">
                                </div>
                                <!-- <div class="mb-3">
                                    <label for="inputPlanDescription" class="form-label">Description</label>
                                    <textarea  class="form-control" id="inputPlanDescription"
                                        rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Imagem do Plano</label>
                                    <input id="image-uploadify" type="file"
                                        accept="image/*" multiple>
                                </div> -->
                                
                                <hr>
                                <div class="row">
                                    <div class="card">
                                        <h5 class="card-header d-flex justify-content-between">
                                            Recursos do plano
                                            <div style="display: none;" class="features-loading"><i class="bx bx-loader-circle bx-spin"></i></div>
                                        </h5>
                                        <div class="card-body features-box">
                                            <ul class="list-group list-group-flush">
                                                
                                                <?php foreach($plan['features'] as $feat) : ?>
                                                    <li data-fid="<?= $feat["id"] ?>" class="feat-item list-group-item d-flex justify-content-between align-items-center">
                                                        <span><?= $feat["name"] ?></span>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <div class="confirm-box" style="display: none;">
                                                                <div class="d-flex justify-content-center align-items-center">
                                                                    Confirmar? 
                                                                    <a class="remove-confirm" href="" data-bs-toggle="tooltip" data-bs-placement="top" title="Remover recurso"><i class="bx bx-check font-20 text-danger"></i></a>
                                                                    <a class="remove-cancel" href="" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar"><i class="bx bx-x-circle font-18 text-success"></i></a>
                                                                </div> 
                                                            </div> 
                                                            <a class="remove-feature" href="javascript:;"><i class="bx bx-trash-alt font-14 text-danger"></i></a>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                                
                                            </ul>
                                            <?php 
                                            if(isset($plan["features"]) && count($plan["features"]) == 0) :  
                                                $nof = '';
                                            else :  
                                                $nof = 'style="display: none"';
                                            endif; ?>
                                            <div <?= $nof; ?> class="no-features alert alert-warning border-0 bg-warning fade show">
                                                <div class="text-dark">Nenhum recurso!</div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <a data-bs-toggle="modal" data-bs-target="#AddFeatureModal" class="btn btn-outline-info btn-sm radius-30" href="javascript:;">Adicionar <i class="bx bx-list-plus font-14"></i></a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="border position-relative border-3 p-4 rounded">
                                <div class="genericOverlay"></div>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="inputPrice" class="form-label">Valor do Plano</label>
                                        <input name="value_cents" type="text" class="form-control" id="inputPrice"
                                        value="<?= $plan['real'] ?>" placeholder="00,00">
                                    </div>
                                    
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-5">
                                        <label for="inputInterval" class="form-label">Intervalo <i class="bx bx-info-circle font-12" data-bs-toggle="tooltip" data-bs-placement="top" title="Ciclo do plano (Número inteiro maior que 0). Intervalo até a próxima cobrança."></i></label>
                                        <input name="interval" type="number" class="form-control" id="inputInterval"
                                            value="<?= $plan['interval'] ?>" placeholder="1">
                                    </div>
                                    <div class="col-7">
                                        <label for="inputProductType" class="form-label">Tipo de intervalo</label>
                                        <select name="interval_type" class="form-select" id="inputProductType">
                                            <option>--</option>
                                            <option <?= $plan['interval_type'] == 'weeks' ? 'selected': '' ?> value="weeks">Semana</option>
                                            <option <?= $plan['interval_type'] == 'months' ? 'selected': '' ?> value="months">Mês</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="inputMaxCycles" class="form-label">Limite do ciclo <i class="bx bx-info-circle font-12" data-bs-toggle="tooltip" data-bs-placement="top" title="Limite de ciclos da assinatura - 0 para indeterminado"></i></label>
                                        <input name="max_cycles" type="number" class="form-control" id="inputMaxCycles"
                                        value="<?= $plan['max_cycles'] ?>"  placeholder="1">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-8">
                                        <label for="inputBillingDays" class="form-label">Dias para faturamento <i class="bx bx-info-circle font-12" data-bs-toggle="tooltip" data-bs-placement="top" title="Dias de faturamento (Quantos dias antes de vencer a assinatura será gerada uma nova fatura)"></i></label>
                                        <input name="billing_days" type="number" class="form-control" id="inputBillingDays"
                                        value="<?= $plan['billing_days'] ?>"  placeholder="1">
                                    </div>
                                </div>
                                <hr>
                                <div class="row g-3">
                                    <input type="hidden" id="h-plan-id" name="h_plan_id" value="<?= $plan['id'] ?>">
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn save-plan-btn btn-primary">Salvar plano</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="AddFeatureModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar recurso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="addFeatureForm">
                    <div class="row">
                        <div class="col-8">
                            <label for="inputFeatureName" class="form-label">Nome do recurso</label>
                            <input name="feature_name" type="text" class="form-control" id="inputFeatureName"
                            value=""  placeholder="Exemplo de recurso">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" style="margin-right: 0" class="btn btn-sm btn-light rounded-0" data-bs-dismiss="modal"><i style="margin-right: 0" class="bx bx-x-circle font-12"></i></button>
                <button type="button" class="btn btn-sm btn-outline-info px-5 add-feature-btn radius-30">Adicionar</button>
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
    $(document).ready(function () {
        $('#image-uploadify').imageuploadify();
        $('[data-bs-toggle="tooltip"]').tooltip();

        $(".features-box").on("click", '.remove-feature', function (e) {
            e.preventDefault()
            $(this).fadeOut(190)
            
            $(this).closest(".feat-item").find(".confirm-box").css("display", "block")
            setTimeout(() => {
                $(this).closest(".feat-item").find(".confirm-box").addClass("show")
            }, 100); 
            console.log($(this).closest("div").find(".confirm-box"))
        })

        $(".features-box").on("blur", ".feat-item span", function(e) {
            e.preventDefault()
            console.log($(this))
            $(this).removeAttr("contentEditable")
            $(this).removeClass("border-1").removeClass('border-primary')
        })

        $(".features-box").on("click", ".feat-item span", function(e) {
            e.preventDefault()

            console.log($(this))
            if($(this).closest('.feat-item').hasClass("_destroy")) {
                return
            }
            $(this).attr("contentEditable", true)
            
            $(this).addClass("border-1").addClass('border-primary')
            $(this).focus()

        })
        $(".features-box").on("click", ".remove-confirm", function(e) {
            e.preventDefault()
            $(this).tooltip('hide')
            $(this).closest(".feat-item").addClass("_destroy")
            $(this).closest(".feat-item").find(".confirm-box").css("display", "none")
            setTimeout(() => {
                $(this).closest(".feat-item").find(".confirm-box").removeClass("show")
                // $(this).closest(".feat-item").find(".remove-feature").fadeIn(400)
                console.log($(this).data("destroy"))
            }, 200); 
        })
        $(".features-box").on("click", ".remove-cancel", function(e) {
            e.preventDefault()
            $(this).tooltip('hide')
            // $(this).closest(".feat-item").find(".confirm-box").removeClass("show")
            $(this).closest(".feat-item").find(".confirm-box").css("display", "none")
            setTimeout(() => {
                $(this).closest(".feat-item").find(".confirm-box").removeClass("show")
                $(this).closest(".feat-item").find(".remove-feature").fadeIn(400)
            }, 200);  
        })

        $(".add-feature-btn").on("click", function(e){
            e.preventDefault()
            var f = $("#inputFeatureName").val()

            const nf = '<li class="feat-item list-group-item d-flex justify-content-between align-items-center">'
                + '<span>' + f + '</span>' +
                '<div class="d-flex justify-content-center align-items-center">'
                    + '<div class="confirm-box" style="display: none;">'
                        +'<div class="d-flex justify-content-center align-items-center">'
                            +'Confirmar? '
                            +'<a class="remove-confirm" href="" data-bs-toggle="tooltip" data-bs-placement="top" title="Remover recurso"><i class="bx bx-check font-20 text-danger"></i></a>'
                            +'<a class="remove-cancel" href="" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar"><i class="bx bx-x-circle font-18 text-success"></i></a>'
                        +'</div>'
                    +'</div>' 
                    +'<a class="remove-feature" href="javascript:;"><i class="bx bx-trash-alt font-14 text-danger"></i></a>'
                +'</div>'
            +'</li>'
            $(nf).appendTo(".features-box > ul")
            
            console.log(f)
            $("#AddFeatureModal").modal("hide")
            setTimeout(() => {
                if($(".features-box > ul li").length > 0) {
                    $(".no-features").slideUp(50)
                } else {
                    $(".no-features").slideDown(50)
                }
            }, 200);
        })
        $("#editPlanForm").on("submit", function(e){
            e.preventDefault()

            $('.save-plan-btn').addClass('disabled')
            $('.save-plan-btn').attr('disabled', true)
            $('.save-plan-btn').html('Salvando... <i class="bx bx-loader-circle bx-spin"></i>')
            $('.features-loading').fadeIn(100)
            $('.genericOverlay').fadeIn(50)
            // $(form).find(".verifyBtn .textPlace").html('Verificando')
            // $(form).find(".verifyBtn .iconPlace").html('<i class="fa fa-circle-o-notch fa-spin fa-1x"></i>')
                   

            var s = $(this).serializeArray()
            // console.log(s)
            var p = {}
            $.each(s, function(i,v) {
                if(v.name == 'h_plan_id') {
                    p['id'] = v.value
                } else if(v.name == 'value_cents') {
                    console.warn(v.value)
                    console.log($("#inputPrice").maskMoney('unmasked'))
                    // let a = v.value 
                    p['value_cents'] = $("#inputPrice").maskMoney('unmasked')[0] * 100
                } else {
                    p[v.name] = v.value
                }
                
                // console.log(i)
                // console.log(v)
            })
            var fs = $(".features-box > ul li").length
            // console.log(fs)
            
            p['features'] = []
            $.each($(".features-box > ul li"), function(i, v) {
                // console.log(v)
                let o = {
                    'name' : $(v).find('span').html(),
                    'identifier' : sl($(v).find('span').html()),
                    'value': 0,
                    'position': i+1           
                }
                console.log($(v).data('fid'))
                if($(v).data('fid') !== 'undefined') {
                    o.id = $(v).data("fid")
                } 
                // console.log($(v).data("destroy"))
                if($(v).closest(".feat-item").hasClass('_destroy')) {
                    // console.log('entra')
                    o['_destroy'] = true
                }
                p.features.push(o)
                $(".no-features").slideUp(50)
            })
            
            
            // console.log(p)

            var url = '<?= base_url('/api') ?>';
            var payload = {
                'call': 'plans/'+$("#h-plan-id").val(),
                'method': 'PUT',
                'payload': p
            }
            console.log(payload);
            // return
            $.ajax({
                type: "POST",
                url: url,
                data: payload,
                fail: function(r){
                    console.log(r)
                },
                success: function (response) {
                    console.log(response)
                    // console.log(typeof response.error)
                    if(response.error) {
                        
                        
                        
                        
                        
                    } else {
                        
                        var features = response.features
                        $(".features-box > ul li").remove()
                        $.each(features, function(i, v) {
                            
                            const nf = '<li data-fid="'+v.id+'"  class="feat-item list-group-item d-flex justify-content-between align-items-center">'
                                + '<span>' + v.name + '</span>' +
                                '<div class="d-flex justify-content-center align-items-center">'
                                    + '<div class="confirm-box" style="display: none;">'
                                        +'<div class="d-flex justify-content-center align-items-center">'
                                            +'Confirmar? '
                                            +'<a class="remove-confirm" href="" data-bs-toggle="tooltip" data-bs-placement="top" title="Remover recurso"><i class="bx bx-check font-20 text-danger"></i></a>'
                                            +'<a class="remove-cancel" href="" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar"><i class="bx bx-x-circle font-18 text-success"></i></a>'
                                        +'</div>'
                                    +'</div>' 
                                    +'<a class="remove-feature" href="javascript:;"><i class="bx bx-trash-alt font-14 text-danger"></i></a>'
                                +'</div>'
                            +'</li>'
                            $(nf).appendTo(".features-box > ul")
                            // console.log(f)
                        })
                        if($(".features-box > ul li").length > 0) {
                            $(".no-features").slideUp(50)
                        } else {
                            $(".no-features").slideDown(50)
                        }
                        $("#SuccessModal").modal("show")
                        setTimeout(() => {
                            $("#SuccessModal").modal("hide")
                            
                        }, 2500);
                    }
                    $('.save-plan-btn').removeClass('disabled')
                    $('.save-plan-btn').removeAttr('disabled')
                    $('.save-plan-btn').html('Salvar plano')
                    $('.features-loading').fadeOut(1000)
                    $('.genericOverlay').fadeOut(1000)
                },
                dataType: 'json',
                headers: {'X-Requested-With': 'XMLHttpRequest'}
            });
            
            // var f = $("#inputFeatureName").val()

            // const nf = '<li class="feat-item list-group-item d-flex justify-content-between align-items-center">'
            //     + '<span>' + f + '</span>' +
            //     '<div class="d-flex justify-content-center align-items-center">'
            //         + '<div class="confirm-box" style="display: none;">'
            //             +'<div class="d-flex justify-content-center align-items-center">'
            //                 +'Confirmar? '
            //                 +'<a class="remove-confirm" href="" data-bs-toggle="tooltip" data-bs-placement="top" title="Remover recurso"><i class="bx bx-check font-20 text-danger"></i></a>'
            //                 +'<a class="remove-cancel" href="" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar"><i class="bx bx-x-circle font-18 text-success"></i></a>'
            //             +'</div>'
            //         +'</div>' 
            //         +'<a class="remove-feature" href="javascript:;"><i class="bx bx-trash-alt font-14 text-danger"></i></a>'
            //     +'</div>'
            // +'</li>'
            // $(nf).appendTo(".features-box > ul")
            // console.log(f)
            // $("#AddFeatureModal").modal("hide")
        })
        
    })
    $("#inputPrice").maskMoney({
        prefix: 'R$ ',
        thousands: '.',
        decimal: ',',
        precision: 2,
        allowZero: true,
        affixesStay: true
    });
    var sl = function(t)
    {
        return t
            .toLowerCase()
            .replace(/[^\w ]+/g,'')
            .replace(/ +/g,'_');
    }
</script>
<?php //$this->include('layouts/main/parts/footer') ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link href="<?= base_url("panel/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css")?>" rel="stylesheet" />
	
<?= $this->endSection() ?>