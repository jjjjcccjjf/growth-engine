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
              <div class="card-title fw-mediumbold">
                Dashboard
                <select class="pull-right btn" name="sale_filter">
                    <option value="">All sales</option>
                    <?php foreach ($sales_people as $value): ?>
                        <option <?php echo ($this->input->get('u') == $value->id) ?'selected' : '' ?> value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                    <?php endforeach ?>
                </select>
              </div>
              <div class="card-list">
                  <!-- <div class="item-list" > -->
                    <?php if (@!$have_sales): ?>
                        
                    <br>
                    <br>
                    <h3><i class="fas fa-exclamation-triangle"></i> No recorded sale yet. </h3>
 
                    <?php endif ?>
<script src="<?php echo base_url('public/admin/assets/') ?>code/highcharts.js"></script>
<script src="<?php echo base_url('public/admin/assets/') ?>code/modules/exporting.js"></script>
<script src="<?php echo base_url('public/admin/assets/') ?>code/modules/export-data.js"></script>
 
 
<br>

<script type="text/javascript">
function getData(data) {
    return data.map(function (country, i) {
        return {
            name: country[0],
            y: country[1],
            // color: countries[i].color
        };
    });
}
</script>


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
 

<?php if ($years_for_verified): ?>
  
      <ul class="nav nav-pills nav-primary buttons2">
        <?php $first_item = 1; foreach ($years_for_verified as $value): ?>
          <li class="nav-item">
            <button class="nav-link <?php echo ($first_item) ? 'active' : '' ?>" id='<?php echo $value ?>_'>
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

<div id="container"></div>

<script type="text/javascript">

var dataPrev = <?php echo json_encode($sales_default_quota) ?>

var data = <?php echo json_encode($sales_quota_met) ?>

var countries = <?php echo json_encode($quarters_array) ?>
 

var chart = Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Total Sales Quota of <?php echo $for_user ?>'
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
            text: 'Sales amount'
        },
        showFirstLabel: false
    }],
    series: [{
        color: 'rgb(158, 159, 163)',
        pointPlacement: -0.2,
        linkedTo: 'main',
        data: dataPrev[<?php echo $first_year ?>].slice(),
        name: 'Quota'
    }, {
        name: 'Total Amount',
        id: 'main',
        // dataSorting: {
        //     enabled: true,
        //     matchByName: true
        // },
        dataLabels: [{
            enabled: true,
            inside: true,
            style: {
                fontSize: '16px'
            }
        }],
        data: getData(data[<?php echo $first_year ?>].slice())
    }],
    exporting: {
        allowHTML: true
    }
});

var years = <?php echo json_encode($years_for_verified) ?>;

years.forEach(function (year) {
    var btn = document.getElementById(year + "_");

    btn.addEventListener('click', function () {

        document.querySelectorAll('.buttons2 button.active').forEach(function (active) {
            active.className = 'nav-link';
        });
        btn.className = 'nav-link active';

        chart.update({
            title: {
                text: 'Total Sales Quota of <?php echo $for_user ?>'
            },
            subtitle: {
                // text: 'Comparing to results from Summer Olympics ' + (year - 4) + ' - Source: <ahref="https://en.wikipedia.org/wiki/' + (year) + '_Summer_Olympics_medal_table">Wikipedia</a>'
            },
            series: [{
                name: 'Quota',
                data: dataPrev[year].slice()
            }, {
                name: 'Total Amount',
                data: getData(data[year]).slice()
            }]
        }, true, false, {
            duration: 800
        });
    });
});

    </script> 


<!-- #############################################/ -->
<!-- #############################################/ -->
<!-- #############################################/ -->
<!-- #############################################/ -->
<!-- #############################################/ -->
<!-- #############################################/ -->
<!-- #############################################/ -->
<!-- #############################################/ -->
<!-- #############################################/ -->
<!-- #############################################/ -->
<!-- #############################################/ -->
<!-- #############################################/ -->
<!-- #############################################/ -->
<!-- #############################################/ -->
<!-- #############################################/ -->
<!-- #############################################/ -->
<!-- #############################################/ -->
<!-- #############################################/ -->
<!-- #############################################/ -->
<!-- #############################################/ -->




<?php if ($years_for_verified): ?>
  
      <ul class="nav nav-pills nav-primary buttons1">
        <?php $first_item = 1; foreach ($years_for_verified as $value): ?>
          <li class="nav-item">
            <button class="nav-link <?php echo ($first_item) ? 'active' : '' ?>" id='<?php echo $value ?>_1'>
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

<div id="container1"></div>

<script type="text/javascript">

var dataPrev1 = <?php echo json_encode($sales_default_quota) ?>

var data1 = <?php echo json_encode($sales_quota_met_verified) ?>

var countries1 = <?php echo json_encode($quarters_array) ?>
 

var chart1 = Highcharts.chart('container1', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Total Verified Sales Quota of <?php echo $for_user ?>'
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
            text: 'Sales amount'
        },
        showFirstLabel: false
    }],
    series: [{
        color: 'rgb(158, 159, 163)',
        pointPlacement: -0.2,
        linkedTo: 'main',
        data: dataPrev1[<?php echo $first_year ?>].slice(),
        name: 'Quota'
    }, {
        name: 'Total Verified Amount',
        id: 'main',
        // dataSorting: {
        //     enabled: true,
        //     matchByName: true
        // },
        dataLabels: [{
            enabled: true,
            inside: true,
            style: {
                fontSize: '16px'
            }
        }],
        data: getData(data1[<?php echo $first_year ?>].slice())
    }],
    exporting: {
        allowHTML: true
    }
});

var years1 = <?php echo json_encode($years_for_verified) ?>;

years1.forEach(function (year) {
    var btn = document.getElementById(year + "_1");

    btn.addEventListener('click', function () {

        document.querySelectorAll('.buttons1 button.active').forEach(function (active) {
            active.className = 'nav-link';
        });
        btn.className = 'nav-link active';

        chart1.update({
            title: {
                text: 'Total Verified Sales Quota of <?php echo $for_user ?>'
            },
            subtitle: {
                // text: 'Comparing to results from Summer Olympics ' + (year - 4) + ' - Source: <ahref="https://en.wikipedia.org/wiki/' + (year) + '_Summer_Olympics_medal_table">Wikipedia</a>'
            },
            series: [{
                name: 'Quota',
                data: dataPrev1[year].slice()
            }, {
                name: 'Total Amount',
                data: getData(data1[year]).slice()
            }]
        }, true, false, {
            duration: 800
        });
    });
});

    </script> 



<script>
    jQuery(document).ready(function($) {
        $('select[name=sale_filter]').on('change', function(){
            let salesperson_id = $(this).val()
            window.location.href = '<?php echo base_url('cms/dashboard') ?>?u=' + salesperson_id
        })
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
