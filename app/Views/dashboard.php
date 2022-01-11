<?= $this->extend('layouts/main/main') ?>

<?= $this->section('content') ?>

<div class="page-content">
  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
    <div class="col">
      <div class="card radius-10 border-start border-0 border-3 border-info">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Assinaturas</p>
              <h4 class="my-1 text-info"><?= $dd['total_subs'] ?></h4>
              <!-- <p class="mb-0 font-13">+2.5% from last week</p> -->
            </div>
            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                class='bx bxs-cart'></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 border-start border-0 border-3 border-warning">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Clientes</p>
              <h4 class="my-1 text-warning"><?= $dd["total_customers"] ?></h4>
              <!-- <p class="mb-0 font-13">+8.4% from last week</p> -->
            </div>
            <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i
                class='bx bxs-group'></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 border-start border-0 border-3 border-danger">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Semana anterior</p>
              <h4 class="my-1 text-danger"><?= $dd["pago2Week"]["total"] ?></h4>
              <!-- <p class="mb-0 font-13">+5.4% from last week</p> -->
              <p class="mb-0 font-13"><?= $dd["pago2Week"]["start_week"] ?> ~ <?= $dd["pago2Week"]["end_week"] ?></p>
            </div>
            <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i
                class='bx bxs-wallet'></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 border-start border-0 border-3 border-success">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <p class="mb-0 text-secondary">Esta semana</p>
              <h4 class="my-1 text-success"><?= $dd["pago1Week"]["total"] ?> <span
                  class="badge <?=$dd["pago2WeekPercentDs"] ?> rounded-pill"><?=$dd["pago2WeekPercent"] ?></span></h4>
              <p class="mb-0 font-13"><?= $dd["pago1Week"]["start_week"] ?></p>
            </div>
            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                class='bx bxs-bar-chart-alt-2'></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!--end row-->

  <div class="row">
    <div class="col-12 col-lg-8">
      <div class="card radius-10">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <h6 class="mb-0">Resumo de assinaturas</h6>
            </div>
            <!-- <div class="dropdown ms-auto">
              <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                  class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="javascript:;">Action</a>
                </li>
                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                </li>
              </ul>
            </div> -->
          </div>
          <!-- <div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                style="color: #14abef"></i>Sales</span>
            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                style="color: #ffc107"></i>Visits</span>
          </div> -->
          <div class="chart-container-1">
            <canvas id="chart1"></canvas>
          </div>
        </div>
        <!-- <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
          <div class="col">
            <div class="p-3">
              <h5 class="mb-0">24.15M</h5>
              <small class="mb-0">Overall Visitor <span> <i class="bx bx-up-arrow-alt align-middle"></i>
                  2.43%</span></small>
            </div>
          </div>
          <div class="col">
            <div class="p-3">
              <h5 class="mb-0">12:38</h5>
              <small class="mb-0">Visitor Duration <span> <i class="bx bx-up-arrow-alt align-middle"></i>
                  12.65%</span></small>
            </div>
          </div>
          <div class="col">
            <div class="p-3">
              <h5 class="mb-0">639.82</h5>
              <small class="mb-0">Pages/Visit <span> <i class="bx bx-up-arrow-alt align-middle"></i>
                  5.62%</span></small>
            </div>
          </div>
        </div> -->
      </div>
    </div>
    <div class="col-12 col-lg-4">
      <div class="card radius-10">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <h6 class="mb-0">Planos</h6>
            </div>
            <!-- <div class="dropdown ms-auto">
              <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                  class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="javascript:;">Action</a>
                </li>
                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                </li>
              </ul>
            </div> -->
          </div>
          <div class="chart-container-2 mt-4">
            <canvas id="chart2"></canvas>
          </div>
        </div>
        <ul class="list-group list-group-flush">
          <?php foreach($dd["chart2"]['tb'] as $i => $a) : ?>
          <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
            <strong><?= $a['name'] ?> (<?= $a['total_real'] ?>)</strong>
            <!-- <span> </span> -->
            <span class="badge bg-success rounded-pill"><?= count($a['items']) ?></span>
          </li>
          <?php endforeach ?>

        </ul>
        <!-- <div class="row row-group border-top g-0">
                    <div class="col">
                        <div class="p-3 text-center">
                            <h4 class="mb-0 text-danger">$45,216</h4>
                            <p class="mb-0">Clothing</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 text-center">
                            <h4 class="mb-0 text-success">$68,154</h4>
                            <p class="mb-0">Electronic</p>
                        </div>
                    </div>
                </div> -->
      </div>
    </div>
  </div>
  <!--end row-->

  <div class="card radius-10">
    <div class="card-body">
      <div class="d-flex align-items-center">
        <div>
          <h6 class="mb-0">Assinaturas recentes</h6>
        </div>
        <!-- <div class="dropdown ms-auto">
          <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
              class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="javascript:;">Action</a>
            </li>
            <li><a class="dropdown-item" href="javascript:;">Another action</a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="javascript:;">Something else here</a>
            </li>
          </ul>
        </div> -->
      </div>
      <div class="table-responsive">
        <table class="table align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th>Plano</th>
              <th>Cliente</th>
              <th>Status</th>
              <th>Valor</th>
              <th>Data</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($dd["assinaturas_alt"] as $ass) : ?>
            <tr>
              <td><?= $ass["plan_ref"] ?></td>
              <td><?= $ass["customer_ref"] ?></td>
              <td><span class="badge bg-gradient-quepal text-white shadow-sm w-100">Pago</span></td>
              <td><?= $ass["real"] ?></td>
              <td><?= $ass["created_pt"] ?></td>
            </tr>
            <?php endforeach ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>


  <!-- <div class="row">
        <div class="col-12 col-lg-7 col-xl-8 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Recent Orders</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-7 col-xl-8 border-end">
                            <div id="geographic-map-2"></div>
                        </div>
                        <div class="col-lg-5 col-xl-4">

                            <div class="mb-4">
                                <p class="mb-2"><i class="flag-icon flag-icon-us me-1"></i> USA <span class="float-end">70%</span></p>
                                <div class="progress" style="height: 7px;">
                                    <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" style="width: 70%"></div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <p class="mb-2"><i class="flag-icon flag-icon-ca me-1"></i> Canada <span class="float-end">65%</span></p>
                                <div class="progress" style="height: 7px;">
                                    <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: 65%"></div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <p class="mb-2"><i class="flag-icon flag-icon-gb me-1"></i> England <span class="float-end">60%</span></p>
                                <div class="progress" style="height: 7px;">
                                    <div class="progress-bar bg-success progress-bar-striped" role="progressbar" style="width: 60%"></div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <p class="mb-2"><i class="flag-icon flag-icon-au me-1"></i> Australia <span class="float-end">55%</span></p>
                                <div class="progress" style="height: 7px;">
                                    <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" style="width: 55%"></div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <p class="mb-2"><i class="flag-icon flag-icon-in me-1"></i> India <span class="float-end">50%</span></p>
                                <div class="progress" style="height: 7px;">
                                    <div class="progress-bar bg-info progress-bar-striped" role="progressbar" style="width: 50%"></div>
                                </div>
                            </div>

                            <div class="mb-0">
                                <p class="mb-2"><i class="flag-icon flag-icon-cn me-1"></i> China <span class="float-end">45%</span></p>
                                <div class="progress" style="height: 7px;">
                                    <div class="progress-bar bg-dark progress-bar-striped" role="progressbar" style="width: 45%"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-5 col-xl-4 d-flex">
            <div class="card w-100 radius-10">
                <div class="card-body">
                    <div class="card radius-10 border shadow-none">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Likes</p>
                                    <h4 class="my-1">45.6M</h4>
                                    <p class="mb-0 font-13">+6.2% from last week</p>
                                </div>
                                <div class="widgets-icons-2 bg-gradient-cosmic text-white ms-auto"><i class='bx bxs-heart-circle'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card radius-10 border shadow-none">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Comments</p>
                                    <h4 class="my-1">25.6K</h4>
                                    <p class="mb-0 font-13">+3.7% from last week</p>
                                </div>
                                <div class="widgets-icons-2 bg-gradient-ibiza text-white ms-auto"><i class='bx bxs-comment-detail'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card radius-10 mb-0 border shadow-none">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Shares</p>
                                    <h4 class="my-1">85.4M</h4>
                                    <p class="mb-0 font-13">+4.6% from last week</p>
                                </div>
                                <div class="widgets-icons-2 bg-gradient-moonlit text-white ms-auto"><i class='bx bxs-share-alt'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div> -->
  <!--end row-->

  <!-- <div class="row row-cols-1 row-cols-lg-3">
        <div class="col d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <p class="font-weight-bold mb-1 text-secondary">Weekly Revenue</p>
                    <div class="d-flex align-items-center mb-4">
                        <div>
                            <h4 class="mb-0">$89,540</h4>
                        </div>
                        <div class="">
                            <p class="mb-0 align-self-center font-weight-bold text-success ms-2">4.4% <i class="bx bxs-up-arrow-alt mr-2"></i>
                            </p>
                        </div>
                    </div>
                    <div class="chart-container-0">
                        <canvas id="chart3"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Orders Summary</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container-1">
                        <canvas id="chart4"></canvas>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Completed <span class="badge bg-gradient-quepal rounded-pill">25</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Pending <span class="badge bg-gradient-ibiza rounded-pill">10</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Process <span class="badge bg-gradient-deepblue rounded-pill">65</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Top Selling Categories</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container-0">
                        <canvas id="chart5"></canvas>
                    </div>
                </div>
                <div class="row row-group border-top g-0">
                    <div class="col">
                        <div class="p-3 text-center">
                            <h4 class="mb-0 text-danger">$45,216</h4>
                            <p class="mb-0">Clothing</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 text-center">
                            <h4 class="mb-0 text-success">$68,154</h4>
                            <p class="mb-0">Electronic</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
  <!--end row-->

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?php //$this->include('layouts/main/parts/footer') 
?>

<script>
$(document).ready(function() {
  // chart 1

  var ctx = document.getElementById("chart1").getContext('2d');

  var colorList = [
    {
        f: "#6078ea",
        t: '#17c5ea'
    }, {
        f: "#ff8359",
        t: '#ffdf40'
    }, {
        f: "#84e973",
        t: '#84e973'
    }, {
        f: "#e662ba",
        t: '#c40d87'
    }, {
        f: "#af36f2",
        t: '#7e11bb'
    }, {
        f: "#e2d845",
        t: '#aea410'
    }, {
        f: "#8282f0",
        t: '#4647bd'
    }
  ]
  var colorss = []
  colorList.shift()
  colorList.shift()
  colorList.shift()
  for (let index = 0; index < <?= $dd["chart_1_data_plans"] ?>; index++) {
    if (typeof colorList[index] !== 'undefined') {
      color = colorList[index]
      var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke1.addColorStop(0, color.f);
      gradientStroke1.addColorStop(1, color.t);
      colorss.push(gradientStroke1)
    }


  }
  console.log(colorss)

  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [<?= $dd["chart_1_months"] ?>],
      datasets: [<?php $c = 0; foreach($dd["chart_1_data"] as $d) : ?> {
        label: "<?= $d["P"] ?>",
        data: [<?= $d["T"] ?>],
        borderColor: colorss[<?=$c?>],
        backgroundColor: colorss[<?=$c?>],
        hoverBackgroundColor: colorss[<?=$c?>],
        pointRadius: 1,
        fill: true,
        // borderSkipped: 1,
        // hoverRadius: 10,
        // hitRadius: 1,
        borderWidth: 0,
      }, <?php $c++; endforeach ?>]
    },

    options: {
      //   barThickness: ,
      //   maxBarThickness: 4,
      //   barPercentage: 0.5,
      maintainAspectRatio: false,
      legend: {
        position: 'top',
        display: true,
        labels: {
          boxWidth: 8
        }
      },

      layout: {
        padding: {
          left: 0,
          right: 0,
          top: 0,
          bottom: 0
        }
      },
      tooltips: {
        displayColors: false,
      },
      scales: {
        xAxes: [{
          gridLines: {
            offsetGridLines: true
          }
        }]
      }
    }
  });





  // chart 2

  var ctx = document.getElementById("chart2").getContext('2d');

  var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
  gradientStroke1.addColorStop(0, '#fc4a1a');
  gradientStroke1.addColorStop(1, '#f7b733');

  var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
  gradientStroke2.addColorStop(0, '#4776e6');
  gradientStroke2.addColorStop(1, '#8e54e9');


  var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
  gradientStroke3.addColorStop(0, '#ee0979');
  gradientStroke3.addColorStop(1, '#ff6a00');

  var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);
  gradientStroke4.addColorStop(0, '#42e695');
  gradientStroke4.addColorStop(1, '#3bb2b8');

  var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: [<?= $dd["chart2"]['js']['labels'] ?>],
      datasets: [{
        backgroundColor: [
          gradientStroke1,
          gradientStroke2,
          gradientStroke3,
          gradientStroke4
        ],
        hoverBackgroundColor: [
          gradientStroke1,
          gradientStroke2,
          gradientStroke3,
          gradientStroke4
        ],
        data: [<?= $dd["chart2"]['js']['data'] ?>],
        borderWidth: [1, 1, 1, 1]
      }]
    },
    options: {
      maintainAspectRatio: false,
      // cutoutPercentage: 75,
      legend: {
        position: 'bottom',
        display: false,
        labels: {
          boxWidth: 8
        }
      },
      tooltips: {
        displayColors: false,
      }
    }
  });
})
</script>
<!-- custom -->
<script src="<?= base_url("panel/assets/js/index.js?" . time()) ?>"></script>
<?= $this->endSection() ?>