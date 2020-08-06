<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Growth Engine</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <link rel="icon" href="<?php echo base_url('public/admin/') ?>/assets/img/optimind-logo.png" type="image/x-icon"/>

  <!-- Fonts and icons -->
  <script src="<?php echo base_url('public/admin/') ?>/assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: {"families":["Lato:300,400,700,900"]},
      custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?php echo base_url('public/admin/') ?>/assets/css/fonts.min.css']},
      active: function() {
        sessionStorage.fonts = true;
      }
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url('public/admin/') ?>/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('public/admin/') ?>/assets/css/atlantis.min.css">

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="<?php echo base_url('public/admin/') ?>/assets/css/demo.css">

  <!-- jquery -->
  <script src="<?php echo base_url('public/admin/') ?>/assets/js/core/jquery.3.2.1.min.js"></script>
  <script>
    var base_url = '<?php echo base_url() ?>'
  </script>
  <style>
    .modal-body label {
      color: #fff !important;
    }
    .form-control:disabled {
      color: #000 !important;
      font-weight: bold !important;
    }
  </style>
</head>
<body data-background-color="dark">
  <div class="wrapper">
    <div class="main-header">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark2">
        
        <a href="index.html" class="logo">
         <span style="font-weight:bold;color:#FFF">GROWTH</span> <span style="font-weight:bold;color:lightgreen">ENGINE</span>
         <img src="<?php echo base_url('public/admin/') ?>/assets/img/optimind-logo.png" alt="navbar brand" class="navbar-brand" style="height:25px">
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon">
            <i class="icon-menu"></i>
          </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar">
            <i class="icon-menu"></i>
          </button>
        </div>
      </div>
      <!-- End Logo Header -->

      <!-- Navbar Header -->
      <nav class="navbar navbar-header navbar-expand-lg" data-background-color="dark">
        
        <div class="container-fluid">
        <!--   <div class="collapse" id="search-nav">
            <form class="navbar-left navbar-form nav-search mr-md-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <button type="submit" class="btn btn-search pr-1">
                    <i class="fa fa-search search-icon"></i>
                  </button>
                </div>
                <input type="text" placeholder="Search ..." class="form-control">
              </div>
            </form>
          </div> -->
          <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
       <!--      <li class="nav-item toggle-nav-search hidden-caret">
              <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                <i class="fa fa-search"></i>
              </a>
            </li> -->
<!--             <li class="nav-item dropdown hidden-caret">
              <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-envelope"></i>
              </a>
              <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                <li>
                  <div class="dropdown-title d-flex justify-content-between align-items-center">
                    Messages                  
                    <a href="#" class="small">Mark all as read</a>
                  </div>
                </li>
                <li>
                  <div class="message-notif-scroll scrollbar-outer">
                    <div class="notif-center">
                      <a href="#">
                        <div class="notif-img"> 
                          <img src="<?php echo base_url('public/admin/') ?>/assets/img/jm_denis.jpg" alt="Img Profile">
                        </div>
                        <div class="notif-content">
                          <span class="subject">Jimmy Denis</span>
                          <span class="block">
                            How are you ?
                          </span>
                          <span class="time">5 minutes ago</span> 
                        </div>
                      </a>
                      <a href="#">
                        <div class="notif-img"> 
                          <img src="<?php echo base_url('public/admin/') ?>/assets/img/chadengle.jpg" alt="Img Profile">
                        </div>
                        <div class="notif-content">
                          <span class="subject">Chad</span>
                          <span class="block">
                            Ok, Thanks !
                          </span>
                          <span class="time">12 minutes ago</span> 
                        </div>
                      </a>
                      <a href="#">
                        <div class="notif-img"> 
                          <img src="<?php echo base_url('public/admin/') ?>/assets/img/mlane.jpg" alt="Img Profile">
                        </div>
                        <div class="notif-content">
                          <span class="subject">Jhon Doe</span>
                          <span class="block">
                            Ready for the meeting today...
                          </span>
                          <span class="time">12 minutes ago</span> 
                        </div>
                      </a>
                      <a href="#">
                        <div class="notif-img"> 
                          <img src="<?php echo base_url('public/admin/') ?>/assets/img/talha.jpg" alt="Img Profile">
                        </div>
                        <div class="notif-content">
                          <span class="subject">Talha</span>
                          <span class="block">
                            Hi, Apa Kabar ?
                          </span>
                          <span class="time">17 minutes ago</span> 
                        </div>
                      </a>
                    </div>
                  </div>
                </li>
                <li>
                  <a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i> </a>
                </li>
              </ul>
            </li> -->
            <li class="nav-item dropdown hidden-caret">
                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-bell"></i>
                  <?php if (@$notifications_count): ?>
                      <span class="notification"><?php echo $notifications_count ?></span>
                  <?php endif ?>
                </a>
              <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                <li>
                  <div class="dropdown-title">You have <?php echo $notifications_count ?: "no" ?> new notification(s)</div>
                </li>
                <li>
                  <div class="notif-scroll scrollbar-outer">
                    <div class="notif-center">
                      <!-- <a href="#">
                        <div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
                        <div class="notif-content">
                          <span class="block">
                            New user registered
                          </span>
                          <span class="time">5 minutes ago</span> 
                        </div>
                      </a>
                      <a href="#">
                        <div class="notif-icon notif-success"> <i class="fa fa-comment"></i> </div>
                        <div class="notif-content">
                          <span class="block">
                            Rahmad commented on Admin
                          </span>
                          <span class="time">12 minutes ago</span> 
                        </div>
                      </a>
                      <a href="#">
                        <div class="notif-img"> 
                          <img src="<?php echo base_url('public/admin/') ?>/assets/img/profile2.jpg" alt="Img Profile">
                        </div>
                        <div class="notif-content">
                          <span class="block">
                            Reza send messages to you
                          </span>
                          <span class="time">12 minutes ago</span> 
                        </div>
                      </a>
                      <a href="#">
                        <div class="notif-icon notif-danger"> <i class="fa fa-heart"></i> </div>
                        <div class="notif-content">
                          <span class="block">
                            Farrah liked Admin
                          </span>
                          <span class="time">17 minutes ago</span> 
                        </div>
                      </a> -->

                      <?php if(@$new_notifs): foreach ($new_notifs as $value): ?>
                      <a href="<?php echo $value->link ?>">
                        <div class="notif-icon notif-primary"> <i class="<?php echo $value->icon ?>"></i> </div>
                        <div class="notif-content">
                          <span class="block">
                            <?php echo $value->header ?>
                          </span>
                          <span class="time"><?php echo $value->body ?></span> 
                          <!-- <span class="time">17 minutes ago</span>  -->
                        </div>
                      </a>
                      <?php endforeach; else: ?>
                      <a href="javascript:void(0)">
                        <div class="notif-icon notif-primary"> <i class="fas fa-smile-beam"></i> </div>
                        <div class="notif-content">
                          <span class="block">
                            All caught up! 
                          </span>
                          <span class="time">There are no new notifications <i class="fa fa-bell"></i></span> 
                          <!-- <span class="time">17 minutes ago</span>  -->
                        </div> 
                      </a>
                      <?php endif ?>
                    </div>
                  </div>
                </li>
                <li>
                  <a class="see-all" href="<?php echo base_url('cms/notifications') ?>">See all notifications<i class="fa fa-angle-right"></i> </a>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown hidden-caret">
              <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fas fa-layer-group"></i>
              </a>
              <div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
                <div class="quick-actions-header">
                  <span class="title mb-1">Quick Actions</span>
                  <span class="subtitle op-8">Shortcuts</span>
                </div>
                <div class="quick-actions-scroll scrollbar-outer">
                  <div class="quick-actions-items">
                    <div class="row m-0">
                      <a class="col-6 col-md-4 p-0" href="#">
                        <div class="quick-actions-item">
                          <i class="flaticon-file-1"></i>
                          <span class="text">Generated Report</span>
                        </div>
                      </a>
                      <a class="col-6 col-md-4 p-0" href="#">
                        <div class="quick-actions-item">
                          <i class="flaticon-database"></i>
                          <span class="text">Create New Database</span>
                        </div>
                      </a>
                      <a class="col-6 col-md-4 p-0" href="#">
                        <div class="quick-actions-item">
                          <i class="flaticon-pen"></i>
                          <span class="text">Create New Post</span>
                        </div>
                      </a>
                      <a class="col-6 col-md-4 p-0" href="#">
                        <div class="quick-actions-item">
                          <i class="flaticon-interface-1"></i>
                          <span class="text">Create New Task</span>
                        </div>
                      </a>
                      <a class="col-6 col-md-4 p-0" href="#">
                        <div class="quick-actions-item">
                          <i class="flaticon-list"></i>
                          <span class="text">Completed Tasks</span>
                        </div>
                      </a>
                      <a class="col-6 col-md-4 p-0" href="#">
                        <div class="quick-actions-item">
                          <i class="flaticon-file"></i>
                          <span class="text">Create New Invoice</span>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown hidden-caret">
              <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                <div class="avatar-sm">
                  <img src="<?php echo $this->session->profile_pic_path ?>" onerror="this.src='<?php echo base_url('public/admin/') ?>/assets/img/optimind-logo.png'" alt="..." class="avatar-img rounded-circle">
                </div>
              </a>
              <ul class="dropdown-menu dropdown-user animated fadeIn">
                <div class="dropdown-user-scroll scrollbar-outer">
                  <li>
                    <div class="user-box">
                      <div class="avatar-lg"><img src="<?php echo $this->session->profile_pic_path ?>" onerror="this.src='<?php echo base_url('public/admin/') ?>/assets/img/optimind-logo.png'" alt="image profile" class="avatar-img rounded"></div>
                      <div class="u-text">
                        <h4><?php echo $this->session->name ?></h4>
                        <p class="text-muted"><?php echo ucwords($this->session->role) ?></p><a href="<?php echo base_url('cms/profile') ?>" class="btn btn-xs btn-secondary btn-sm">My Profile</a>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo base_url('cms/profile') ?>">My Profile</a>
                    <!-- <a class="dropdown-item" href="#">My Balance</a> -->
                    <a class="dropdown-item" href="<?php echo base_url('cms/notifications') ?>">Notifications</a>
                    <div class="dropdown-divider"></div>
                    <!-- <a class="dropdown-item" href="#">Account Setting</a> -->
                    <!-- <div class="dropdown-divider"></div> -->
                    <a class="dropdown-item" href="<?php echo base_url('cms/login/logout') ?>">Logout</a>
                  </li>
                </div>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
      <!-- End Navbar -->
    </div>
