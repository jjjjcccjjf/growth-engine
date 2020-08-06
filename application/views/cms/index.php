<div class="main-panel">
  <div class="content">
    <div class="page-inner">
      <!--       <div class="page-header">
        <h4 class="page-title">Forms</h4>
      </div> -->
      <div class="row">
        <div class="col-md-12">
          <div class="card card-round">
            <div class="card-body">
              <div class="card-title fw-mediumbold">Dashboard</div>
              <div class="card-list">
                  <!-- <div class="item-list" > -->
                    <!-- <h3>Heads up! <i class="fas fa-wrench"></i> The Dashboard is still under construction </h3> -->


 
<script src="<?php echo base_url('public/admin/assets/') ?>code/highcharts.js"></script>
<script src="<?php echo base_url('public/admin/assets/') ?>code/modules/exporting.js"></script>
<script src="<?php echo base_url('public/admin/assets/') ?>code/modules/export-data.js"></script>

 
      <ul class="nav nav-pills nav-primary buttons">
        <li class="nav-item">
          <button class="nav-link" id='2000'>2000</button>
        </li>
        <li class="nav-item">
          <button class="nav-link" id='2004'>2004</button>
        </li>
        <li class="nav-item">
          <button class="nav-link" id='2008'>2008</button>
        </li>
        <li class="nav-item">
          <button class="nav-link" id='2012'>2012</button>
        </li>
        <li class="nav-item">
          <button class="nav-link active" id='2016'>2016</button>
        </li>
      </ul>
 
<!-- 

<div class='buttons'>
  <button id='2000'>
    2000
  </button>
  <button id='2004'>
    2004
  </button>
  <button id='2008'>
    2008
  </button>
  <button id='2012'>
    2012
  </button>
  <button id='2016' class='active'>
    2016
  </button>
</div> -->
<div id="container"></div>



    <script type="text/javascript">
var dataPrev = {
    2016: [
        ['South Korea', 0],
        ['Japan', 0],
        ['Australia', 0],
        ['Germany', 11],
        ['Russia', 24],
        ['China', 38],
        ['Great Britain', 29],
        ['United States', 46]
    ],
    2012: [
        ['South Korea', 13],
        ['Japan', 0],
        ['Australia', 0],
        ['Germany', 0],
        ['Russia', 22],
        ['China', 51],
        ['Great Britain', 19],
        ['United States', 36]
    ],
    2008: [
        ['South Korea', 0],
        ['Japan', 0],
        ['Australia', 0],
        ['Germany', 13],
        ['Russia', 27],
        ['China', 32],
        ['Great Britain', 9],
        ['United States', 37]
    ],
    2004: [
        ['South Korea', 0],
        ['Japan', 5],
        ['Australia', 16],
        ['Germany', 0],
        ['Russia', 32],
        ['China', 28],
        ['Great Britain', 0],
        ['United States', 36]
    ],
    2000: [
        ['South Korea', 0],
        ['Japan', 0],
        ['Australia', 9],
        ['Germany', 20],
        ['Russia', 26],
        ['China', 16],
        ['Great Britain', 0],
        ['United States', 44]
    ]
};

var data = {
    2016: [
        ['South Korea', 0],
        ['Japan', 0],
        ['Australia', 0],
        ['Germany', 17],
        ['Russia', 19],
        ['China', 26],
        ['Great Britain', 27],
        ['United States', 46]
    ],
    2012: [
        ['South Korea', 13],
        ['Japan', 0],
        ['Australia', 0],
        ['Germany', 0],
        ['Russia', 24],
        ['China', 38],
        ['Great Britain', 29],
        ['United States', 46]
    ],
    2008: [
        ['South Korea', 0],
        ['Japan', 0],
        ['Australia', 0],
        ['Germany', 16],
        ['Russia', 22],
        ['China', 51],
        ['Great Britain', 19],
        ['United States', 36]
    ],
    2004: [
        ['South Korea', 0],
        ['Japan', 16],
        ['Australia', 17],
        ['Germany', 0],
        ['Russia', 27],
        ['China', 32],
        ['Great Britain', 0],
        ['United States', 37]
    ],
    2000: [
        ['South Korea', 0],
        ['Japan', 0],
        ['Australia', 16],
        ['Germany', 13],
        ['Russia', 32],
        ['China', 28],
        ['Great Britain', 0],
        ['United States', 36]
    ]
};

var countries = [{
    name: 'South Korea',
    flag: 'Sales1',
    color: 'rgb(201, 36, 39)'
}, {
    name: 'Japan',
    flag: 'Sales2',
    color: 'rgb(201, 36, 39)'
}, {
    name: 'Australia',
    flag: 'Sales3',
    color: 'rgb(0, 82, 180)'
}, {
    name: 'Germany',
    flag: 'Sales4',
    color: 'rgb(0, 0, 0)'
}, {
    name: 'Russia',
    flag: 'Sales5',
    color: 'rgb(240, 240, 240)'
}, {
    name: 'China',
    flag: 'Sales6',
    color: 'rgb(255, 217, 68)'
}, {
    name: 'Great Britain',
    flag: 'Sales7',
    color: 'rgb(0, 82, 180)'
}, {
    name: 'United States',
    flag: 'Sales8',
    color: 'rgb(215, 0, 38)'
}];


function getData(data) {
    return data.map(function (country, i) {
        return {
            name: country[0],
            y: country[1],
            color: countries[i].color
        };
    });
}

var chart = Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Summer Olympics 2016 - Top 5 countries by Gold medals'
    },
    subtitle: {
        text: 'Comparing to results from Summer Olympics 2012 - Source: <ahref="https://en.wikipedia.org/wiki/2016_Summer_Olympics_medal_table">Wikipedia</a>'
    },
    plotOptions: {
        series: {
            grouping: false,
            borderWidth: 0
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        shared: true,
        headerFormat: '<span style="font-size: 15px">{point.point.name}</span><br/>',
        pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y} medals</b><br/>'
    },
    xAxis: {
        type: 'category',
        max: 8,
        labels: {
            useHTML: true,
            animate: true,
            formatter: function () {
                var value = this.value,
                    output;

                countries.forEach(function (country) {
                    if (country.name === value) {
                        output = country.flag;
                    }
                });

                return output;
            }
        }
    },
    yAxis: [{
        title: {
            text: 'Gold medals'
        },
        showFirstLabel: false
    }],
    series: [{
        color: 'rgb(158, 159, 163)',
        pointPlacement: -0.2,
        linkedTo: 'main',
        data: dataPrev[2016].slice(),
        name: '2012'
    }, {
        name: '2016',
        id: 'main',
        dataSorting: {
            enabled: true,
            matchByName: true
        },
        dataLabels: [{
            enabled: true,
            inside: true,
            style: {
                fontSize: '16px'
            }
        }],
        data: getData(data[2016]).slice()
    }],
    exporting: {
        allowHTML: true
    }
});

var years = [2016, 2012, 2008, 2004, 2000];

years.forEach(function (year) {
    var btn = document.getElementById(year);

    btn.addEventListener('click', function () {

        document.querySelectorAll('.buttons button.active').forEach(function (active) {
            active.className = 'nav-link';
        });
        btn.className = 'nav-link active';

        chart.update({
            title: {
                text: 'Summer Olympics ' + year + ' - Top 5 countries by Gold medals'
            },
            subtitle: {
                text: 'Comparing to results from Summer Olympics ' + (year - 4) + ' - Source: <ahref="https://en.wikipedia.org/wiki/' + (year) + '_Summer_Olympics_medal_table">Wikipedia</a>'
            },
            series: [{
                name: year - 4,
                data: dataPrev[year].slice()
            }, {
                name: year,
                data: getData(data[year]).slice()
            }]
        }, true, false, {
            duration: 800
        });
    });
});

    </script>
                  <!-- </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- <div class="main-panel">
  <div class="content">
    <div class="page-inner">
      <div class="mt-2 mb-4">
        <h2 class="text-white pb-2">Welcome back, Hizrian!</h2>
        <h5 class="text-white op-7 mb-4">Yesterday I was clever, so I wanted to change the world. Today I am wise, so I am changing myself.</h5>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="card card-dark bg-primary-gradient">
            <div class="card-body pb-0">
              <div class="h1 fw-bold float-right">+5%</div>
              <h2 class="mb-2">17</h2>
              <p>Users online</p>
              <div class="pull-in sparkline-fix chart-as-background">
                <div id="lineChart"><canvas width="327" height="70" style="display: inline-block; width: 327px; height: 70px; vertical-align: top;"></canvas></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-dark bg-secondary-gradient">
            <div class="card-body pb-0">
              <div class="h1 fw-bold float-right">-3%</div>
              <h2 class="mb-2">27</h2>
              <p>New Users</p>
              <div class="pull-in sparkline-fix chart-as-background">
                <div id="lineChart2"><canvas width="327" height="70" style="display: inline-block; width: 327px; height: 70px; vertical-align: top;"></canvas></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-dark bg-success2">
            <div class="card-body pb-0">
              <div class="h1 fw-bold float-right">+7%</div>
              <h2 class="mb-2">213</h2>
              <p>Transactions</p>
              <div class="pull-in sparkline-fix chart-as-background">
                <div id="lineChart3"><canvas width="327" height="70" style="display: inline-block; width: 327px; height: 70px; vertical-align: top;"></canvas></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <div class="card-head-row">
                <div class="card-title">User Statistics</div>
                <div class="card-tools">
                  <a href="#" class="btn btn-info btn-border btn-round btn-sm mr-2">
                    <span class="btn-label">
                      <i class="fa fa-pencil"></i>
                    </span>
                    Export
                  </a>
                  <a href="#" class="btn btn-info btn-border btn-round btn-sm">
                    <span class="btn-label">
                      <i class="fa fa-print"></i>
                    </span>
                    Print
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="chart-container" style="min-height: 375px">
                <canvas id="statisticsChart"></canvas>
              </div>
              <div id="myChartLegend"></div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-secondary">
            <div class="card-header">
              <div class="card-title">Daily Sales</div>
              <div class="card-category">March 25 - April 02</div>
            </div>
            <div class="card-body pb-0">
              <div class="mb-4 mt-2">
                <h1>$4,578.58</h1>
              </div>
              <div class="pull-in">
                <canvas id="dailySalesChart"></canvas>
              </div>
            </div>
          </div>
          <div class="card card-primary bg-primary-gradient">
            <div class="card-body">
              <h4 class="mb-1 fw-bold">Tasks Progress</h4>
              <div id="task-complete" class="chart-circle mt-4 mb-3"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="row row-card-no-pd">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-head-row">
                <h4 class="card-title">Users Geolocation</h4>
                <div class="card-tools">
                  <button class="btn btn-icon btn-link btn-primary btn-xs"><span class="fa fa-angle-down"></span></button>
                  <button class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card"><span class="fa fa-sync-alt"></span></button>
                  <button class="btn btn-icon btn-link btn-primary btn-xs"><span class="fa fa-times"></span></button>
                </div>
              </div>
              <p class="card-category">
              Map of the distribution of users around the world</p>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="table-responsive table-hover table-sales">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>
                            <div class="flag">
                              <img src="<?php echo base_url('public/admin/') ?>/assets/img/flags/id.png" alt="indonesia">
                            </div>
                          </td>
                          <td>Indonesia</td>
                          <td class="text-right">
                            2.320
                          </td>
                          <td class="text-right">
                            42.18%
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="flag">
                              <img src="<?php echo base_url('public/admin/') ?>/assets/img/flags/us.png" alt="united states">
                            </div>
                          </td>
                          <td>USA</td>
                          <td class="text-right">
                            240
                          </td>
                          <td class="text-right">
                            4.36%
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="flag">
                              <img src="<?php echo base_url('public/admin/') ?>/assets/img/flags/au.png" alt="australia">
                            </div>
                          </td>
                          <td>Australia</td>
                          <td class="text-right">
                            119
                          </td>
                          <td class="text-right">
                            2.16%
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="flag">
                              <img src="<?php echo base_url('public/admin/') ?>/assets/img/flags/ru.png" alt="russia">
                            </div>
                          </td>
                          <td>Russia</td>
                          <td class="text-right">
                            1.081
                          </td>
                          <td class="text-right">
                            19.65%
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="flag">
                              <img src="<?php echo base_url('public/admin/') ?>/assets/img/flags/cn.png" alt="china">
                            </div>
                          </td>
                          <td>China</td>
                          <td class="text-right">
                            1.100
                          </td>
                          <td class="text-right">
                            20%
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="flag">
                              <img src="<?php echo base_url('public/admin/') ?>/assets/img/flags/br.png" alt="brazil">
                            </div>
                          </td>
                          <td>Brasil</td>
                          <td class="text-right">
                            640
                          </td>
                          <td class="text-right">
                            11.63%
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mapcontainer">
                    <div id="map-example" class="vmap"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Top Products</div>
            </div>
            <div class="card-body pb-0">
              <div class="d-flex">
                <div class="avatar">
                  <img src="<?php echo base_url('public/admin/') ?>/assets/img/logoproduct.svg" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="flex-1 pt-1 ml-2">
                  <h6 class="fw-bold mb-1">CSS</h6>
                  <small class="text-muted">Cascading Style Sheets</small>
                </div>
                <div class="d-flex ml-auto align-items-center">
                  <h3 class="text-info fw-bold">+$17</h3>
                </div>
              </div>
              <div class="separator-dashed"></div>
              <div class="d-flex">
                <div class="avatar">
                  <img src="<?php echo base_url('public/admin/') ?>/assets/img/logoproduct.svg" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="flex-1 pt-1 ml-2">
                  <h6 class="fw-bold mb-1">J.CO Donuts</h6>
                  <small class="text-muted">The Best Donuts</small>
                </div>
                <div class="d-flex ml-auto align-items-center">
                  <h3 class="text-info fw-bold">+$300</h3>
                </div>
              </div>
              <div class="separator-dashed"></div>
              <div class="d-flex">
                <div class="avatar">
                  <img src="<?php echo base_url('public/admin/') ?>/assets/img/logoproduct3.svg" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="flex-1 pt-1 ml-2">
                  <h6 class="fw-bold mb-1">Ready Pro</h6>
                  <small class="text-muted">Bootstrap 4 Admin Dashboard</small>
                </div>
                <div class="d-flex ml-auto align-items-center">
                  <h3 class="text-info fw-bold">+$350</h3>
                </div>
              </div>
              <div class="separator-dashed"></div>
              <div class="pull-in">
                <canvas id="topProductsChart"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title fw-mediumbold">Suggested People</div>
              <div class="card-list">
                <div class="item-list">
                  <div class="avatar">
                    <img src="<?php echo base_url('public/admin/') ?>/assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle">
                  </div>
                  <div class="info-user ml-3">
                    <div class="username">Jimmy Denis</div>
                    <div class="status">Graphic Designer</div>
                  </div>
                  <button class="btn btn-icon btn-primary btn-round btn-xs">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
                <div class="item-list">
                  <div class="avatar">
                    <img src="<?php echo base_url('public/admin/') ?>/assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle">
                  </div>
                  <div class="info-user ml-3">
                    <div class="username">Chad</div>
                    <div class="status">CEO Zeleaf</div>
                  </div>
                  <button class="btn btn-icon btn-primary btn-round btn-xs">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
                <div class="item-list">
                  <div class="avatar">
                    <img src="<?php echo base_url('public/admin/') ?>/assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle">
                  </div>
                  <div class="info-user ml-3">
                    <div class="username">Talha</div>
                    <div class="status">Front End Designer</div>
                  </div>
                  <button class="btn btn-icon btn-primary btn-round btn-xs">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
                <div class="item-list">
                  <div class="avatar">
                    <img src="<?php echo base_url('public/admin/') ?>/assets/img/mlane.jpg" alt="..." class="avatar-img rounded-circle">
                  </div>
                  <div class="info-user ml-3">
                    <div class="username">John Doe</div>
                    <div class="status">Back End Developer</div>
                  </div>
                  <button class="btn btn-icon btn-primary btn-round btn-xs">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
                <div class="item-list">
                  <div class="avatar">
                    <img src="<?php echo base_url('public/admin/') ?>/assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle">
                  </div>
                  <div class="info-user ml-3">
                    <div class="username">Talha</div>
                    <div class="status">Front End Designer</div>
                  </div>
                  <button class="btn btn-icon btn-primary btn-round btn-xs">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
                <div class="item-list">
                  <div class="avatar">
                    <img src="<?php echo base_url('public/admin/') ?>/assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle">
                  </div>
                  <div class="info-user ml-3">
                    <div class="username">Jimmy Denis</div>
                    <div class="status">Graphic Designer</div>
                  </div>
                  <button class="btn btn-icon btn-primary btn-round btn-xs">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-primary bg-primary-gradient">
            <div class="card-body">
              <h4 class="mt-3 b-b1 pb-2 mb-4 fw-bold">Active user right now</h4>
              <h1 class="mb-4 fw-bold">17</h1>
              <h4 class="mt-3 b-b1 pb-2 mb-5 fw-bold">Page view per minutes</h4>
              <div id="activeUsersChart"></div>
              <h4 class="mt-5 pb-3 mb-0 fw-bold">Top active pages</h4>
              <ul class="list-unstyled">
                <li class="d-flex justify-content-between pb-1 pt-1"><small>/product/readypro/index.html</small> <span>7</span></li>
                <li class="d-flex justify-content-between pb-1 pt-1"><small>/product/atlantis/demo.html</small> <span>10</span></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Feed Activity</div>
            </div>
            <div class="card-body">
              <ol class="activity-feed">
                <li class="feed-item feed-item-secondary">
                  <time class="date" datetime="9-25">Sep 25</time>
                  <span class="text">Responded to need <a href="#">"Volunteer opportunity"</a></span>
                </li>
                <li class="feed-item feed-item-success">
                  <time class="date" datetime="9-24">Sep 24</time>
                  <span class="text">Added an interest <a href="#">"Volunteer Activities"</a></span>
                </li>
                <li class="feed-item feed-item-info">
                  <time class="date" datetime="9-23">Sep 23</time>
                  <span class="text">Joined the group <a href="single-group.php">"Boardsmanship Forum"</a></span>
                </li>
                <li class="feed-item feed-item-warning">
                  <time class="date" datetime="9-21">Sep 21</time>
                  <span class="text">Responded to need <a href="#">"In-Kind Opportunity"</a></span>
                </li>
                <li class="feed-item feed-item-danger">
                  <time class="date" datetime="9-18">Sep 18</time>
                  <span class="text">Created need <a href="#">"Volunteer Opportunity"</a></span>
                </li>
                <li class="feed-item">
                  <time class="date" datetime="9-17">Sep 17</time>
                  <span class="text">Attending the event <a href="single-event.php">"Some New Event"</a></span>
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <div class="card-head-row">
                <div class="card-title">Support Tickets</div>
                <div class="card-tools">
                  <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link" id="pills-today" data-toggle="pill" href="#pills-today" role="tab" aria-selected="true">Today</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" id="pills-week" data-toggle="pill" href="#pills-week" role="tab" aria-selected="false">Week</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="pills-month" data-toggle="pill" href="#pills-month" role="tab" aria-selected="false">Month</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex">
                <div class="avatar avatar-online">
                  <span class="avatar-title rounded-circle border border-white bg-info">J</span>
                </div>
                <div class="flex-1 ml-3 pt-1">
                  <h6 class="text-uppercase fw-bold mb-1">Joko Subianto <span class="text-warning pl-3">pending</span></h6>
                  <span class="text-muted">I am facing some trouble with my viewport. When i start my</span>
                </div>
                <div class="float-right pt-1">
                  <small class="text-muted">8:40 PM</small>
                </div>
              </div>
              <div class="separator-dashed"></div>
              <div class="d-flex">
                <div class="avatar avatar-offline">
                  <span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
                </div>
                <div class="flex-1 ml-3 pt-1">
                  <h6 class="text-uppercase fw-bold mb-1">Prabowo Widodo <span class="text-success pl-3">open</span></h6>
                  <span class="text-muted">I have some query regarding the license issue.</span>
                </div>
                <div class="float-right pt-1">
                  <small class="text-muted">1 Day Ago</small>
                </div>
              </div>
              <div class="separator-dashed"></div>
              <div class="d-flex">
                <div class="avatar avatar-away">
                  <span class="avatar-title rounded-circle border border-white bg-danger">L</span>
                </div>
                <div class="flex-1 ml-3 pt-1">
                  <h6 class="text-uppercase fw-bold mb-1">Lee Chong Wei <span class="text-muted pl-3">closed</span></h6>
                  <span class="text-muted">Is there any update plan for RTL version near future?</span>
                </div>
                <div class="float-right pt-1">
                  <small class="text-muted">2 Days Ago</small>
                </div>
              </div>
              <div class="separator-dashed"></div>
              <div class="d-flex">
                <div class="avatar avatar-offline">
                  <span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
                </div>
                <div class="flex-1 ml-3 pt-1">
                  <h6 class="text-uppercase fw-bold mb-1">Peter Parker <span class="text-success pl-3">open</span></h6>
                  <span class="text-muted">I have some query regarding the license issue.</span>
                </div>
                <div class="float-right pt-1">
                  <small class="text-muted">2 Day Ago</small>
                </div>
              </div>
              <div class="separator-dashed"></div>
              <div class="d-flex">
                <div class="avatar avatar-away">
                  <span class="avatar-title rounded-circle border border-white bg-danger">L</span>
                </div>
                <div class="flex-1 ml-3 pt-1">
                  <h6 class="text-uppercase fw-bold mb-1">Logan Paul <span class="text-muted pl-3">closed</span></h6>
                  <span class="text-muted">Is there any update plan for RTL version near future?</span>
                </div>
                <div class="float-right pt-1">
                  <small class="text-muted">2 Days Ago</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer">
    <div class="container-fluid">
      <nav class="pull-left">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="https://www.themekita.com">
              ThemeKita
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              Help
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              Licenses
            </a>
          </li>
        </ul>
      </nav>
      <div class="copyright ml-auto">
        2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a>
      </div>        
    </div>
  </footer>
</div>
 -->