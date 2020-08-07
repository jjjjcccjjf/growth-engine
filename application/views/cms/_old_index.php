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
<!-- 
 
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
      </ul> -->
 
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
    'Unverified': <?php echo json_encode($sales_unverified_array) ?>
    // ,
    // 2012: [
    //     ['South Korea', 13],
    //     ['Japan', 0],
    //     ['Australia', 0],
    //     ['Germany', 0],
    //     ['Russia', 22],
    //     ['China', 51],
    //     ['Great Britain', 19],
    //     ['United States', 36]
    // ],
    // 2008: [
    //     ['South Korea', 0],
    //     ['Japan', 0],
    //     ['Australia', 0],
    //     ['Germany', 13],
    //     ['Russia', 27],
    //     ['China', 32],
    //     ['Great Britain', 9],
    //     ['United States', 37]
    // ],
    // 2004: [
    //     ['South Korea', 0],
    //     ['Japan', 5],
    //     ['Australia', 16],
    //     ['Germany', 0],
    //     ['Russia', 32],
    //     ['China', 28],
    //     ['Great Britain', 0],
    //     ['United States', 36]
    // ],
    // 2000: [
    //     ['South Korea', 0],
    //     ['Japan', 0],
    //     ['Australia', 9],
    //     ['Germany', 20],
    //     ['Russia', 26],
    //     ['China', 16],
    //     ['Great Britain', 0],
    //     ['United States', 44]
    // ]
};

var data = {
    'Verified' : <?php echo json_encode($sales_verified_array) ?>
    // [
    //     ['South Korea', 0],
    //     ['Japan', 0],
    //     ['Australia', 0],
    //     ['Germany', 17],
    //     ['Russia', 19],
    //     ['China', 26],
    //     ['Great Britain', 27],
    //     ['United States', 46]
    // ]
    // ,
    // 2012: [
    //     ['South Korea', 13],
    //     ['Japan', 0],
    //     ['Australia', 0],
    //     ['Germany', 0],
    //     ['Russia', 24],
    //     ['China', 38],
    //     ['Great Britain', 29],
    //     ['United States', 46]
    // ],
    // 2008: [
    //     ['South Korea', 0],
    //     ['Japan', 0],
    //     ['Australia', 0],
    //     ['Germany', 16],
    //     ['Russia', 22],
    //     ['China', 51],
    //     ['Great Britain', 19],
    //     ['United States', 36]
    // ],
    // 2004: [
    //     ['South Korea', 0],
    //     ['Japan', 16],
    //     ['Australia', 17],
    //     ['Germany', 0],
    //     ['Russia', 27],
    //     ['China', 32],
    //     ['Great Britain', 0],
    //     ['United States', 37]
    // ],
    // 2000: [
    //     ['South Korea', 0],
    //     ['Japan', 0],
    //     ['Australia', 16],
    //     ['Germany', 13],
    //     ['Russia', 32],
    //     ['China', 28],
    //     ['Great Britain', 0],
    //     ['United States', 36]
    // ]
};

var countries = <?php echo json_encode($sales_array) ?>

// [
// {
//     name: 'South Korea',
//     flag: 'Sales1',
//     color: 'rgb(201, 36, 39)'
// }, {
//     name: 'Japan',
//     flag: 'Sales2',
//     color: 'rgb(201, 36, 39)'
// }, {
//     name: 'Australia',
//     flag: 'Sales3',
//     color: 'rgb(0, 82, 180)'
// }, {
//     name: 'Germany',
//     flag: 'Sales4',
//     color: 'rgb(0, 0, 0)'
// }, {
//     name: 'Russia',
//     flag: 'Sales5',
//     color: 'rgb(240, 240, 240)'
// }, {
//     name: 'China',
//     flag: 'Sales6',
//     color: 'rgb(255, 217, 68)'
// }, {
//     name: 'Great Britain',
//     flag: 'Sales7',
//     color: 'rgb(0, 82, 180)'
// }, {
//     name: 'United States',
//     flag: 'Sales8',
//     color: 'rgb(215, 0, 38)'
// }
// ];


function getData(data) {
    return data.map(function (country, i) {
        return {
            name: country[0],
            y: country[1],
            // color: countries[i].color
        };
    });
}

var chart = Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Verified Sales'
    },
    subtitle: {
        // text: 'Comparing to results from Summer Olympics 2012 - Source: <ahref="https://en.wikipedia.org/wiki/2016_Summer_Olympics_medal_table">Wikipedia</a>'
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
        pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y}</b><br/>'
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
            text: 'Verified projects'
        },
        showFirstLabel: false
    }],
    series: [{
        color: 'rgb(158, 159, 163)',
        pointPlacement: -0.2,
        linkedTo: 'main',
        data: dataPrev['Unverified'],
        name: 'Unverified'
    }, {
        name: 'Verified',
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
        data: getData(data['Verified'])
    }],
    exporting: {
        allowHTML: true
    }
});

// var years = [2016, 2012, 2008, 2004, 2000];

// years.forEach(function (year) {
//     var btn = document.getElementById(year);

//     btn.addEventListener('click', function () {

//         document.querySelectorAll('.buttons button.active').forEach(function (active) {
//             active.className = 'nav-link';
//         });
//         btn.className = 'nav-link active';

//         chart.update({
//             title: {
//                 text: 'Verified Sales'
//             },
//             subtitle: {
//                 // text: 'Comparing to results from Summer Olympics ' + (year - 4) + ' - Source: <ahref="https://en.wikipedia.org/wiki/' + (year) + '_Summer_Olympics_medal_table">Wikipedia</a>'
//             },
//             series: [{
//                 name: year - 4,
//                 data: dataPrev[year].slice()
//             }, {
//                 name: year,
//                 data: getData(data[year]).slice()
//             }]
//         }, true, false, {
//             duration: 800
//         });
//     });
// });

    </script>












 
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////quota graph/////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->
 <!-- /////////////////////////////////////////////////////////////////////////// -->



<br>
<br>
<br>




<!-- 
 
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
      </ul> -->
 

<?php if ($years): ?>
  
      <ul class="nav nav-pills nav-primary buttons">
        <?php $first_item = 1; foreach ($years as $value): ?>
          <li class="nav-item">
            <button class="nav-link <?php echo ($first_item) ? 'active' : '' ?>" id='<?php echo $value ?>'>
            <?php echo $value ?>
            </button>
          </li>
        <?php 
        if ($first_item) {
          $first_year = $value;
        }

        $first_item = 0; endforeach ?>
        </li>
      </ul> 
<?php endif ?>

<div id="container2"></div>



    <script type="text/javascript">
var dataPrev2 = <?php echo json_encode($sales_default_quota) ?>

var data2 = <?php echo json_encode($sales_quota_met) ?>
 

var countries2 = <?php echo json_encode($sales_array) ?>
 

var chart = Highcharts.chart('container2', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Sales Quota'
    },
    subtitle: {
        // text: 'Comparing to results from Summer Olympics 2012 - Source: <ahref="https://en.wikipedia.org/wiki/2016_Summer_Olympics_medal_table">Wikipedia</a>'
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
        pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y}</b><br/>'
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

                countries2.forEach(function (country) {
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
            text: 'Sales amount'
        },
        showFirstLabel: false
    }],
    series: [{
        color: 'rgb(158, 159, 163)',
        pointPlacement: -0.2,
        linkedTo: 'main',
        data: dataPrev2[<?php echo $first_year ?>].slice(),
        name: 'Quota'
    }, {
        name: 'Current Amount',
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
        data: getData(data2[<?php echo $first_year ?>].slice())
    }],
    exporting: {
        allowHTML: true
    }
});

var years = <?php echo json_encode($years) ?>;

years.forEach(function (year) {
    var btn = document.getElementById(year);

    btn.addEventListener('click', function () {

        document.querySelectorAll('.buttons button.active').forEach(function (active) {
            active.className = 'nav-link';
        });
        btn.className = 'nav-link active';

        chart.update({
            title: {
                text: 'Sales Quota'
            },
            subtitle: {
                // text: 'Comparing to results from Summer Olympics ' + (year - 4) + ' - Source: <ahref="https://en.wikipedia.org/wiki/' + (year) + '_Summer_Olympics_medal_table">Wikipedia</a>'
            },
            series: [{
                name: 'Quota',
                data: dataPrev2[year].slice()
            }, {
                name: 'Current Amount',
                data: getData(data2[year]).slice()
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
