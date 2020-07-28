<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Growth Engine Login</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <link rel="icon" href="<?php echo base_url('public/admin') ?>/assets/img/icon.ico" type="image/x-icon"/>

  <!-- Fonts and icons -->
  <script src="<?php echo base_url('public/admin') ?>/assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: {"families":["Lato:300,400,700,900"]},
      custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?php echo base_url('public/admin') ?>/assets/css/fonts.min.css']},
      active: function() {
        sessionStorage.fonts = true;
      }
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url('public/admin') ?>/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('public/admin') ?>/assets/css/atlantis.min.css">

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="<?php echo base_url('public/admin') ?>/assets/css/demo.css">
</head>
<body data-background-color="dark">
  <div class="wrapper">
    <div class="main-header">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark2" style="width:100%">
        
        <a href="index.html" class="logo">
          <span style="font-weight:bold;color:#FFF">GROWTH</span> <span style="font-weight:bold;color:lightgreen">ENGINE</span>
         <img src="<?php echo base_url('public/admin/') ?>/assets/img/optimind-logo.png" alt="navbar brand" class="navbar-brand" style="height:25px">
        </a>
    
      </div>
      <!-- End Logo Header -->

      <!-- Navbar Header -->
      <!-- End Navbar -->
    </div>
 

    <div class="main-panel" style="width:100%">
      <div class="content">
        <div class="page-inner">  


          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <div class="card-title" style="text-align:center">Dashboard Login</div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 col-lg-12">
                      <form method="post" action="<?php echo base_url('cms/login/attempt') ?>">
                        
                      <div class="form-group">
                        <label for="email2">Email Address</label>
                        <input name="email" type="email" class="form-control" id="email2" placeholder="Enter Email">
                        <!-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                      </div>
                      <?php if ($login_msg = $this->session->login_msg): ?>
                      <div class="form-group">
                        <label style="color: <?php echo $login_msg['color'] ?>"><?php echo $login_msg['message'] ?></label>
                      </div>
                      <?php endif; ?>
                     </div>
                   </div>
                <div class="card-action">
                  <button class="btn btn-success" type="submit">Login</button>
                  <!-- <button class="btn btn-danger">Forgot Password</button> -->
                </div>
                    </form>

              </div>
            </div>
          </div>


        </div>
      </div> 
    </div>
     
  </div>
  <!--   Core JS Files   -->
  <script src="<?php echo base_url('public/admin') ?>/assets/js/core/jquery.3.2.1.min.js"></script>
  <script src="<?php echo base_url('public/admin') ?>/assets/js/core/popper.min.js"></script>
  <script src="<?php echo base_url('public/admin') ?>/assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery UI -->
  <script src="<?php echo base_url('public/admin') ?>/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  <script src="<?php echo base_url('public/admin') ?>/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="<?php echo base_url('public/admin') ?>/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


  <!-- Chart JS -->
  <script src="<?php echo base_url('public/admin') ?>/assets/js/plugin/chart.js/chart.min.js"></script>

  <!-- jQuery Sparkline -->
  <script src="<?php echo base_url('public/admin') ?>/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

  <!-- Chart Circle -->
  <script src="<?php echo base_url('public/admin') ?>/assets/js/plugin/chart-circle/circles.min.js"></script>

  <!-- Datatables -->
  <script src="<?php echo base_url('public/admin') ?>/assets/js/plugin/datatables/datatables.min.js"></script>

  <!-- Bootstrap Notify -->
  <script src="<?php echo base_url('public/admin') ?>/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

  <!-- jQuery Vector Maps -->
  <script src="<?php echo base_url('public/admin') ?>/assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?php echo base_url('public/admin') ?>/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

  <!-- Sweet Alert -->
  <script src="<?php echo base_url('public/admin') ?>/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

  <!-- Atlantis JS -->
  <script src="<?php echo base_url('public/admin') ?>/assets/js/atlantis.min.js"></script>
 
  <script>
    $('#lineChart').sparkline([102,109,120,99,110,105,115], {
      type: 'line',
      height: '70',
      width: '100%',
      lineWidth: '2',
      lineColor: 'rgba(255, 255, 255, .5)',
      fillColor: 'rgba(255, 255, 255, .15)'
    });

    $('#lineChart2').sparkline([99,125,122,105,110,124,115], {
      type: 'line',
      height: '70',
      width: '100%',
      lineWidth: '2',
      lineColor: 'rgba(255, 255, 255, .5)',
      fillColor: 'rgba(255, 255, 255, .15)'
    });

    $('#lineChart3').sparkline([105,103,123,100,95,105,115], {
      type: 'line',
      height: '70',
      width: '100%',
      lineWidth: '2',
      lineColor: 'rgba(255, 255, 255, .5)',
      fillColor: 'rgba(255, 255, 255, .15)'
    });
  </script>
</body>
</html>