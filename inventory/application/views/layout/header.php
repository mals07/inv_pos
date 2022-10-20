<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no, maximum-scale=1, user-scalable=no' name='viewport' />
	<!-- <script src="<?php base_url(); ?>jquery-2.1.1.js"></script>  -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link  href="<?php echo base_url('assets/custom.css'); ?>" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="<?php echo base_url()?>/assets/jquery.redirect.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>


  <link href="<?php echo base_url('assets/css/material-dashboard.css?v=2.1.2'); ?>" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/daterangepicker.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/tagsinput/bootstrap-tagsinput.css'); ?>">

  <script src="<?php echo base_url(); ?>/assets/js/core/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/core/popper.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="<?php echo base_url(); ?>/assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="<?php echo base_url(); ?>/assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="<?php echo base_url(); ?>/assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="<?php echo base_url(); ?>/assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="<?php echo base_url(); ?>/assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="<?php echo base_url(); ?>/assets/js/plugins/bootstrap-datetimepicker.min.js"></script>

  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="<?php echo base_url(); ?>/assets/js/plugins/jquery.dataTables.min.js"></script>
  <link href="<?php echo base_url(); ?>assets/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">


  <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="<?php echo base_url(); ?>/assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="<?php echo base_url(); ?>/assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="<?php echo base_url(); ?>/assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="<?php echo base_url(); ?>/assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="<?php echo base_url(); ?>/assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="<?php echo base_url(); ?>/assets/js/plugins/arrive.min.js"></script>
  <!--  Google Maps Plugin    -->
 
  <!-- Chartist JS -->
  <script src="<?php echo base_url(); ?>/assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="<?php echo base_url(); ?>/assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?php echo base_url(); ?>/assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="<?php echo base_url(); ?>/assets/demo/demo.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.daterangepicker.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.redirect.js"></script>
  
</head>
<body>
    <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="<?php echo base_url(); ?>/assets/img/sidebar-1.jpg">

      <div class="logo"><a href="<?php echo base_url(); ?>" class="simple-text logo-normal">
          APP Budget Tracker
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
           <li class="nav-item <?php echo ($act == 'entry' ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo base_url().'entry'; ?>">
              <i class="material-icons">dashboard</i>
              <p>Entry to APP</p>
            </a>
          </li>



 
          <li class="nav-item <?php echo ($act == 'proc' ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo base_url().'proc'; ?>">
              <i class="material-icons">library_books</i>
              <p>Procurement Projects</p>
            </a>
          </li>
      

 
          <li class="nav-item <?php echo ($act == 'app' ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo base_url().'app'; ?>">
              <i class="material-icons">unarchive</i>
              <p>APP</p>
            </a>
          </li>
        
   
          <li class="nav-item <?php echo ($act == 'report' ? 'active' : ''); ?>">
            <a class="nav-link " href="<?php echo base_url().'reports/summary'; ?>">
              <i class="material-icons">library_books</i>
              <p>Report</p>
            </a>
          </li>
     


        </ul>
      </div>
    </div>
      <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <button class="navbar-toggler navtag" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" id="nav_toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
            </form>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="javascript:;" role="button" aria-haspopup="true" aria-expanded="false"></a>
                <div class="dropdown-menu">
                  <a class="dropdown-item uProf" href="#" id="update_profile" style="font-size:12px;" data-toggle="modal" data-target="#userprofile_edit" ontouchstart="closeNav()"> Update Profile</a>
                  <a class="dropdown-item" href="" id="logout" style="font-size:12px;">Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>