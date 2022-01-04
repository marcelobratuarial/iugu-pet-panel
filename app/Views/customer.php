<?= $this->extend('layouts/main/main') ?>

<?= $this->section('content') ?>

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Clientes</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="<?= base_url("/") ?>"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Detalhes do cliente</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <div class="btn-group">
        <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"><i class="bx bx-menu"></i> <span class="visually-hidden">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="reembolsar-fatura-btn dropdown-item" href="javascript:;"><i class="bx bx-money"></i> <span>Reembolsar</span></a>
          <!-- <a class="dropdown-item" href="javascript:;">Another action</a>
          <a class="dropdown-item" href="javascript:;">Something else here</a>
          <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a> -->
        </div>
      </div>
    </div>
  </div>
  <!--end breadcrumb-->
  <?php //print_r($assinatura);exit;
  ?>
  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-column align-items-center text-center">
            <!-- <img src="assets/images/avatars/avatar-2.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110"> -->
            <div class="mt-3">
              <h4><?= $customer["name"] ?></h4>
              <p class="text-secondary mb-1"><?= $customer["email"] ?></p>
              <!-- <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p> -->
              <button class="btn btn-outline-primary">Ver detalhes</button>
            </div>
          </div>
          <hr class="my-4" />
          <!-- <div class="customer-details-loading">
            <div class="d-flex align-items-center justify-content-center"><i
                class="bx bx-loader-alt bx-spin mr-3 font-24"></i> Carregando...</div>
          </div> -->
          <ul class="list-group list-group-flush">
            <li class="customer-name list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <h6 class="mb-0">Nome:</h6>
              <span class="text-secondary"><?= $customer["name"] ?></span>
            </li>
            <li class="customer-address list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <h6 class="mb-0">Endereço: </h6>
              <span class="text-secondary"><?= $customer["street"] ?>, <?= $customer["number"] ?> <?= strlen($customer["complement"]) > 0 ? $customer["complement"] : '' ?></span>
            </li>
            <li class="customer-bairro list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <h6 class="mb-0">Bairro:</h6>
              <span class="text-secondary"><?= $customer["district"] ?></span>
            </li>
            <li class="customer-cidade-uf list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <h6 class="mb-0">Cidade/UF</h6>
              <span class="text-secondary"><?= $customer["city"] ?>/<?= $customer["state"] ?></span>
            </li>

          </ul>
        </div>
      </div>

      <!-- <hr> -->
      <div class="pricing-table">
        <div class="row mb-5 d-flex justify-content-center">
          <div class="col-12">
            <!-- Pets -->
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8">


      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body position-relative">
              <h5 class="d-flex align-items-center mb-3">Pets </h5>

              <!-- <div class="invoice-details-loading">
                <div class="d-flex align-items-center justify-content-center"><i
                    class="bx bx-loader-alt bx-spin mr-3 font-24"></i> Carregando...</div>
              </div> -->
              <!-- <div class="invouce-status-badge py-0 px-4 border border-1 border-success text-success text-center rounded bg-light">
              </div> -->
              <div class="row">
                <?php
                foreach ($customer['pets'] as $pet) :
                  $hasSubs = (isset($pet["assinatura"]));
                ?>
                  <div class="col-md-6">
                    <div class="card ">
                      <!-- <img src="assets/images/gallery/05.png" class="card-img-top" alt="..."> -->
                      <div class="card-body">
                        <h5 class="card-title"><?= $pet["pet_name"] ?></h5>
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                      </div>
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">Nascimento: <strong><?= $pet["nasc_br"] ?></strong></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">Raça: <strong><?= $pet["pet_raca"] ?></strong></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">Peso: <strong><?= $pet["pet_peso"] ?>kg</strong></li>
                      </ul>
                      <div class="card-body">
                        <?php if($hasSubs) : ?>
                          <a class="btn btn-sm btn-info mb-3 radius-10"  data-bs-toggle="collapse" href="#ass-<?= $pet["assinatura"]["id"]?>" role="button" aria-expanded="false" aria-controls="collapseExample"><?= $pet["assinatura"]['plan_ref'] ?> <i class='bx bx-chevron-down'></i></a>
                          <!-- <a href="#" class="card-link">Another link</a> -->
                          <div class="collapse multi-collapse" id="ass-<?=$pet["assinatura"]['id']?>">
                            <div class="card-body">
                              <div class="pricing-table">
                                <div class="row mb-5 d-flex justify-content-center">
                                  <div class="col-12">
                                    <div class="card mb-5 mb-lg-0">
                                      <div class="card-header bg-primary py-3"><?php //print_r($plan) ?>
                                        <h5 class="card-title text-white text-uppercase text-center">
                                          <?php if(strlen($pet["assinatura"]['plan_ref']) > 0) : ?>
                                          <?= $pet["assinatura"]['plan_ref'] ?>
                                          <?php else: ?>
                                            [excluído]
                                          <?php endif ?>
                                        </h5>
                                        <h6 class="card-price text-white text-center"><?= $pet["assinatura"]['real'] ?><span class="term">/mês</span></h6>
                                        <h6 class="text-white text-center"><?=$pet["assinatura"]['periodo']?></h6>
                                      </div>
                                      <div class="card-body">
                                        <?php if(isset($pet["assinatura"]["features"]) && !empty($pet["assinatura"]["features"])) : ?>
                                        <ul class="list-group list-group-flush">
                                          <?php foreach($pet["assinatura"]["features"] as $feature) : ?>
                                          <li class="list-group-item"><i class='bx bx-check me-2 font-18'></i><?= $feature['name'] ?></li>
                                          <?php endforeach ?>
                                        </ul>
                                        <?php else : ?>
                                        Nenhum recurso
                                        <?php endif; ?>
                                        <!-- <div class="d-grid"> <a href="#" class="btn btn-success my-2 radius-30">ASSINAR</a>
                                                              </div> -->
                                      </div>
                                      <div class="card-footer d-flex justify-content-center">
                                        <a href="<?= base_url("assinaturas/details/".$pet["assinatura"]['id']) ?>" class="btn btn-sm btn-info my-2 radius-10">Ver assinatura <i
                                            class='bx bx-detail me-2 font-18'></i></a>
                                        
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                             <?php //print_r($pet["assinatura"]) ?>
                             
                            </div>
                          </div>
                        <?php else : ?>
                          <span class="lead">Sem assinatura</span>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                <?php endforeach ?>
              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<span id="customer_id"><?= $customer["id"] ?></span>
<?php /*if(!empty($customer["recent_invoices"])) : ?>
<span id="invoice_id"><?= $customer["recent_invoices"][0]["id"] ?></span>
<?php endif */ ?>
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
<div class="modal fade" data-bs-backdrop="static" id="ReembolsarModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reembolsar pagamento</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
        <h1 class="display-6">Confirma?</h1>
        <p class="lead">
          Você realmente deseja <strong>realizar o reembolso</strong> desta fatura?
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" style="margin-right: 0" class="cancelar-reembolso-btn btn btn-sm btn-outline-success radius-30" data-bs-dismiss="modal"><i style="margin-right: 0" class="bx bx-x-circle"></i> Cancelar</button>
        <form action="" id="confirmReembolsoFaturaForm">
          <input type="hidden" id="h-fatura-id" name="fatura_id">
          <button type="submit" class="btn btn-sm btn-outline-danger confirmar-reembolso-btn radius-30">Confirmar reembolso <i style="margin-right: 0" class="bx bx-x"></i></button>
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

<?= $this->section('styles') ?>
<style>
  .invouce-status-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 1.2rem;
    display: inline-block;
    margin-bottom: 30px;
  }
</style>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script src="<?= base_url("panel/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js") ?>"></script>
<script src="<?= base_url("panel/assets/js/jquery.maskMoney.min.js") ?>"></script>
<script>
  $(document).ready(function() {
    var cid = $("#customer_id").html()
    var iid = $("#invoice_id").html()
    var pid = $("#plan_id").html()
    const statusList = {
      'paid': "Pago",
      'refunded': "Reembolsado",
      'pending': "Pendente",
      'expired': "Expirado"
    }
    var url = '<?= base_url('/api') ?>';
    if (iid.length > 0) {
      var payload = {
        'call': 'invoices/' + iid,
        'method': 'GET',
        'payload': {
          id: iid
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
          $(".invoice-details-loading").slideUp(400)
          $(".invouce-status-badge").addClass("border-warning").addClass("text-warning").removeClass("border-success").removeClass("text-success")
          $(".reembolsar-fatura-btn").addClass("btn")
          $(".reembolsar-fatura-btn").addClass("btn-light")
          $(".reembolsar-fatura-btn").addClass("disabled")
          $(".reembolsar-fatura-btn").attr("disabled", true)
          $(".reembolsar-fatura-btn span").html("Reembolsado")
          $(".visualizar-fatura-btn").attr("href", response.secure_url)
          var d = JSON.stringify(response)

          var status = response.status
          $(".invouce-status-badge").html(statusList[status])

          var created_at = new Date(response.created_at_iso);
          $(".fatura-created-at span").html(created_at.toLocaleString('pt-BR'))

          console.log(response.due_date)
          var fatura_due = new Date(response.due_date);
          $(".fatura-due span").html(fatura_due.toLocaleDateString('pt-BR', {
            timeZone: 'UTC'
          }))

          var paid_at = new Date(response.paid_at);
          $(".fatura-paid-at span").html(paid_at.toLocaleString('pt-BR'))


          $(".fatura-value span").html(response.paid)

          $(".fatura-payer-name span").html(response.payer_name)
          var complement = (response.payer_address_complement === null) ? "" : ", " + response
            .payer_address_complement
          $(".fatura-payer-address span").html(response.payer_address_street + ', ' + response
            .payer_address_number + complement)
          $(".fatura-payer-bairro span").html(response.payer_address_district)
          $(".fatura-payer-cidade-uf span").html(response.payer_address_city + '/' + response
            .payer_address_state)

          $.each(response.logs, function(index, i) {
            var tr = '<tr><th scope="row">' + index + '</th>' +
              '<td>' + i.created_at + '</td>' +
              '<td>' + i.description + '</td>' +
              '<td>' + i.notes + '</td></tr>'
            $(tr).appendTo("#logsBox tbody")
          })
          // $(".invoice-details").html(d)
          // console.log(typeof response.error)
          if (response.error) {





          } else {


            // $("#SuccessModal").modal("show")
            // setTimeout(() => {
            // $("#SuccessModal").modal("hide")
            // window.location.href = "<?= base_url('/planos') ?>"
            // }, 2500);
          }
          // $('.save-plan-btn').removeClass('disabled')
          // $('.save-plan-btn').removeAttr('disabled')
          // $('.save-plan-btn').html('Salvar plano')
          // $('.features-loading').fadeOut(1000)
          // $('.genericOverlay').fadeOut(1000)
        },
        dataType: 'json',
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      });


      $(".reembolsar-fatura-btn").on("click", function(e) {
        e.preventDefault()
        $("#ReembolsarModal #h-fatura-id").val(iid)
        $("#ReembolsarModal").modal("show")
      })

      $("#ReembolsarModal").on("submit", "#confirmReembolsoFaturaForm", function(e) {
        e.preventDefault()

        $('.confirmar-reembolso-btn').addClass('disabled')
        $('.confirmar-reembolso-btn').attr('disabled', true)
        $('.confirmar-reembolso-btn').html('Aguarde... <i class="bx bx-loader-circle bx-spin"></i>')

        $('.cancelar-reembolso-btn').addClass('disabled')
        $('.cancelar-reembolso-btn').attr('disabled', true)

        $('.genericOverlay').fadeIn(50)
        var s = $(this).serializeArray()
        console.log(s)
        // return
        var url = '<?= base_url('/api') ?>';
        var payload = {
          'call': 'invoices/' + $("#ReembolsarModal #h-fatura-id").val() + '/refund',
          'method': 'POST',
          'payload': {
            id: $("#ReembolsarModal #h-fatura-id").val()
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
                // window.location.href = "<?= base_url('/planos') ?>"
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
    }

    if (cid.length > 0) {
      // var payload = {
      //   'call': 'customers/' + cid,
      //   'method': 'GET',
      //   'payload': {
      //     id: cid
      //   }
      // }

      // $.ajax({
      //   type: "POST",
      //   url: url,
      //   data: payload,
      //   fail: function(r) {
      //     console.log(r)
      //   },
      //   success: function(response) {
      //     console.log(response)
      //     $(".customer-details-loading").slideUp(400)
      //     $(".customer-name span").html(response.name)
      //     var complement = (response.complement === null) ? "" : ", " + response.complement
      //     $(".customer-address span").html(response.street + ', ' + response.number + complement)
      //     $(".customer-bairro span").html(response.district)
      //     $(".customer-cidade-uf span").html(response.city + '/' + response.state)


      //     // $(".invoice-details").html(d)
      //     // console.log(typeof response.error)
      //     if (response.error) {





      //     } else {


      //       // $("#SuccessModal").modal("show")
      //       // setTimeout(() => {
      //       // $("#SuccessModal").modal("hide")
      //       // window.location.href = "<?= base_url('/planos') ?>"
      //       // }, 2500);
      //     }
      //     // $('.save-plan-btn').removeClass('disabled')
      //     // $('.save-plan-btn').removeAttr('disabled')
      //     // $('.save-plan-btn').html('Salvar plano')
      //     // $('.features-loading').fadeOut(1000)
      //     // $('.genericOverlay').fadeOut(1000)
      //   },
      //   dataType: 'json',
      //   headers: {
      //     'X-Requested-With': 'XMLHttpRequest'
      //   }
      // });
    }

    $('#image-uploadify').imageuploadify();
    $('[data-bs-toggle="tooltip"]').tooltip();

    $('#DeletePlanModal').on('hidden.bs.modal', function(e) {
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
        'call': 'plans/' + $("#DeletePlanModal #h-plan-id").val(),
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