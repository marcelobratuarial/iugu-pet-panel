<?= $this->extend('layouts/main/main') ?>

<?= $this->section('content') ?>

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Perfil</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="<?= base_url("/") ?>"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Editar perfil</li>
        </ol>
      </nav>
    </div>
    <!-- <div class="ms-auto">
      <div class="btn-group">
        <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"><i class="bx bx-menu"></i> <span class="visually-hidden">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="reembolsar-fatura-btn dropdown-item" href="javascript:;"><i class="bx bx-money"></i> <span>Reembolsar</span></a>
          <a class="dropdown-item" href="javascript:;">Another action</a>
          <a class="dropdown-item" href="javascript:;">Something else here</a>
          <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
        </div>
      </div>
    </div> -->
  </div>
  <!--end breadcrumb-->
  <?php //print_r($assinatura);exit;
  ?>
  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-column align-items-center text-center">
            <img src="<?= base_url("panel/assets/images/avatars/u-admin.png")?>" alt="Admin" class="rounded-circle p-1" width="110">
            <div class="mt-3">
              <h4>John Doe</h4>
              <p class="text-secondary mb-1">Full Stack Developer</p>
              <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
              <button class="btn btn-primary">Follow</button>
              <button class="btn btn-outline-primary">Message</button>
            </div>
          </div>
          <hr class="my-4">
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
              <span class="text-secondary">https://codervent.com</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github me-2 icon-inline"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>Github</h6>
              <span class="text-secondary">codervent</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter me-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
              <span class="text-secondary">@codervent</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram me-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
              <span class="text-secondary">codervent</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
              <span class="text-secondary">codervent</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-sm-3">
              <h6 class="mb-0">Full Name</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              <input type="text" class="form-control" value="John Doe">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-3">
              <h6 class="mb-0">Email</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              <input type="text" class="form-control" value="john@example.com">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-3">
              <h6 class="mb-0">Phone</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              <input type="text" class="form-control" value="(239) 816-9029">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-3">
              <h6 class="mb-0">Mobile</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              <input type="text" class="form-control" value="(320) 380-4539">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-3">
              <h6 class="mb-0">Address</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              <input type="text" class="form-control" value="Bay Area, San Francisco, CA">
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9 text-secondary">
              <input type="button" class="btn btn-primary px-4" value="Save Changes">
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
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