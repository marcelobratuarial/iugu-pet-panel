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
          <li class="breadcrumb-item active" aria-current="page">Detalhes da assinatura</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <div class="btn-group">
        <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
          data-bs-toggle="dropdown"><i class="bx bx-menu"></i> <span class="visually-hidden">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="reembolsar-fatura-btn dropdown-item"
            href="javascript:;" ><i class="bx bx-money"></i> <span>Reembolsar</span></a>
          <!-- <a class="dropdown-item" href="javascript:;">Another action</a>
          <a class="dropdown-item" href="javascript:;">Something else here</a>
          <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a> -->
        </div>
      </div>
    </div>
  </div>
  <!--end breadcrumb-->
  <?php //print_r($assinatura);exit;?>
  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-column align-items-center text-center">
            <!-- <img src="assets/images/avatars/avatar-2.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110"> -->
            <div class="mt-3">
              <h4><?= $assinatura["customer_name"] ?></h4>
              <p class="text-secondary mb-1"><?= $assinatura["customer_email"] ?></p>
              <!-- <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p> -->
              <a href="<?= base_url("clientes/details/".$assinatura['customer_id']) ?>" class="btn btn-outline-primary">Ver detalhes</a>
            </div>
          </div>
          <hr class="my-4" />
          <div class="customer-details-loading">
            <div class="d-flex align-items-center justify-content-center"><i
                class="bx bx-loader-alt bx-spin mr-3 font-24"></i> Carregando...</div>
          </div>
          <ul class="list-group list-group-flush">
            <li class="customer-name list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <h6 class="mb-0">Nome:</h6>
              <span class="text-secondary"></span>
            </li>
            <li class="customer-address list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <h6 class="mb-0">Endere??o: </h6>
              <span class="text-secondary"></span>
            </li>
            <li class="customer-bairro list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <h6 class="mb-0">Bairro:</h6>
              <span class="text-secondary"></span>
            </li>
            <li class="customer-cidade-uf list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <h6 class="mb-0">Cidade/UF</h6>
              <span class="text-secondary"></span>
            </li>
            
          </ul>
        </div>
      </div>

      <hr>
      <div class="pricing-table">
        <div class="row mb-5 d-flex justify-content-center">
          <div class="col-12">
            <div class="card mb-5 mb-lg-0">
              <div class="card-header bg-primary py-3"><?php //print_r($plan) ?>
                <h5 class="card-title text-white text-uppercase text-center">
                  <?php if(strlen($assinatura['plan_ref']) > 0) : ?>
                  <?= $assinatura['plan_ref'] ?>
                  <?php else: ?>
                    [exclu??do]
                  <?php endif ?>
                </h5>
                <h6 class="card-price text-white text-center"><?= $assinatura['real'] ?><span class="term">/m??s</span></h6>
                <h5 class="text-white text-center"><?=$assinatura['periodo']?></h5>
              </div>
              <div class="card-body">
                <?php if(isset($assinatura["features"]) && !empty($assinatura["features"])) : ?>
                <ul class="list-group list-group-flush">
                  <?php foreach($assinatura["features"] as $feature) : ?>
                  <li class="list-group-item"><i class='bx bx-check me-2 font-18'></i><?= $feature['name'] ?></li>
                  <?php endforeach ?>
                </ul>
                <?php else : ?>
                Nenhum recurso
                <?php endif; ?>
                <!-- <div class="d-grid"> <a href="#" class="btn btn-success my-2 radius-30">ASSINAR</a>
                                      </div> -->
              </div>
              <?php if(isset($assinatura["plan_id"])) : ?>
              <div class="card-footer">
                <a href="<?= base_url("planos/edit/".$assinatura["plan_id"]) ?>" class="btn btn-info my-2 radius-30">Editar <i
                    class='bx bx-edit-alt me-2 font-18'></i></a>
                
              </div>
              <?php endif ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      
      
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body position-relative">
              <h5 class="d-flex align-items-center mb-3">Fatura </h5>
              
              <div class="invoice-details-loading">
                <div class="d-flex align-items-center justify-content-center"><i
                    class="bx bx-loader-alt bx-spin mr-3 font-24"></i> Carregando...</div>
              </div>
              <div class="invouce-status-badge py-0 px-4 border border-1 border-success text-success text-center rounded bg-light">
              </div>
              <h6 class="mb-3 mt-5">Dados da fatura</h6>
              <ul class="list-group list-group-flush">
                <li class="list-group-item lead fatura-created-at">Data: <span></span></li>
                <li class="list-group-item lead fatura-due">Vencimento: <span></span></li>
                <li class="list-group-item lead fatura-paid-at">Pagamento: <span></span></li>
                <li class="list-group-item lead fatura-value">VALOR: <span></span></li>
                <li class="list-group-item"><a class="radius-30 visualizar-fatura-btn btn btn-outline-info btn-sm" target="_blank" href=""> <i
                    class='bx bx-link-external me-2 font-18'></i>Ver fatura</a></li>
                <!--<li class="list-group-item">Vestibulum at eros</li> -->
              </ul>
              <hr>
              <h6 class="mb-3 mt-5">Dados do pagador</h6>
              <ul class="list-group list-group-flush">
                <li class="list-group-item lead fatura-payer-name">Nome: <span></span></li>
                <li class="list-group-item lead fatura-payer-address">Endere??o: <span></span></li>
                <li class="list-group-item lead fatura-payer-bairro">Bairro: <span></span></li>
                <li class="list-group-item lead fatura-payer-cidade-uf">Cidade/UF: <span></span></li>
              </ul>
              <hr>
              <h6 class="mb-3 mt-5"><a class="btn btn-sm btn-outline-info my-0 radius-30" data-bs-toggle="collapse"
                  href="#logsBox" role="button" aria-expanded="false" aria-controls="logsBox">Logs <i
                    class='bx bx-history me-2 font-18'></i></a></h6>
              <div class="collapse multi-collapse" id="logsBox">
                <div class="card card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Data</th>
                        <th scope="col">Descri????o</th>
                        <th scope="col">Nota</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<span id="customer_id"><?= $assinatura["customer_id"] ?></span>
<?php if(!empty($assinatura["recent_invoices"])) : ?>
<span id="invoice_id"><?= $assinatura["recent_invoices"][0]["id"] ?></span>
<?php endif ?>
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
          Voc?? realmente deseja <strong>excluir</strong> o plano <strong class="modal-plan-name"></strong>?
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" style="margin-right: 0"
          class="cancelar-excluir-plano-btn btn btn-sm btn-outline-success radius-30" data-bs-dismiss="modal"><i
            style="margin-right: 0" class="bx bx-x-circle"></i> Cancelar</button>
        <form action="" id="confirmDelPlanForm">
          <input type="hidden" id="h-plan-id" name="plan_id">
          <input type="hidden" id="h-plan-name" name="plan_name">
          <button type="submit" class="btn btn-sm btn-outline-danger confirmar-excluir-plano-btn radius-30">Excluir <i
              style="margin-right: 0" class="bx bx-x"></i></button>
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
          Voc?? realmente deseja <strong>realizar o reembolso</strong> desta fatura?
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" style="margin-right: 0"
          class="cancelar-reembolso-btn btn btn-sm btn-outline-success radius-30" data-bs-dismiss="modal"><i
            style="margin-right: 0" class="bx bx-x-circle"></i> Cancelar</button>
        <form action="" id="confirmReembolsoFaturaForm">
          <input type="hidden" id="h-fatura-id" name="fatura_id">
          <button type="submit" class="btn btn-sm btn-outline-danger confirmar-reembolso-btn radius-30">Confirmar reembolso <i
              style="margin-right: 0" class="bx bx-x"></i></button>
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
        <h3 class="text-light"><i style="font-size: 3.5rem" class="bx bx-check"></i> <br>Conclu??do</h3>
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
        
        
        var d = JSON.stringify(response)

        var status = response.status
        $(".invouce-status-badge").html(statusList[status])
        if(status == 'refunded') {
          $(".invouce-status-badge").addClass("border-warning").addClass("text-warning").removeClass("border-success").removeClass("text-success")
          $(".reembolsar-fatura-btn").addClass("btn")
          $(".reembolsar-fatura-btn").addClass("btn-light")
          $(".reembolsar-fatura-btn").addClass("disabled")
          $(".reembolsar-fatura-btn").attr("disabled", true)
          $(".reembolsar-fatura-btn span").html("Reembolsado")
          $(".visualizar-fatura-btn").attr("href", response.secure_url)
        }
        

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
    var payload = {
      'call': 'customers/' + cid,
      'method': 'GET',
      'payload': {
        id: cid
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
        $(".customer-details-loading").slideUp(400)
        $(".customer-name span").html(response.name)
        var complement = (response.complement === null) ? "" : ", " + response.complement
        $(".customer-address span").html(response.street + ', ' + response.number + complement)
        $(".customer-bairro span").html(response.district)
        $(".customer-cidade-uf span").html(response.city + '/' + response.state)

        
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