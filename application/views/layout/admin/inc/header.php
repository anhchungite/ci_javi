
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo TEMPLATE_ADMIN ?>/img/favicon.png">

    <title><?php if(isset($title)){echo $title;}?></title>
	<link href="http://bootstrap-confirmation.js.org/assets/css/docs.min.css" rel="stylesheet">
  	<link href="http://bootstrap-confirmation.js.org/assets/css/style.css" rel="stylesheet">
    <!-- Bootstrap CSS -->

	<link href="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="<?php echo TEMPLATE_ADMIN ?>/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="<?php echo TEMPLATE_ADMIN ?>/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="<?php echo TEMPLATE_ADMIN ?>/css/font-awesome.min.css" rel="stylesheet" />
    <!-- full calendar css-->
    <link href="<?php echo TEMPLATE_ADMIN ?>/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
	<link href="<?php echo TEMPLATE_ADMIN ?>/assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="<?php echo TEMPLATE_ADMIN ?>/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- owl carousel -->
    <link rel="stylesheet" href="<?php echo TEMPLATE_ADMIN ?>/css/owl.carousel.css" type="text/css">
	<link href="<?php echo TEMPLATE_ADMIN ?>/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <!-- Custom styles -->
	<link rel="stylesheet" href="<?php echo TEMPLATE_ADMIN ?>/css/fullcalendar.css">
	<link href="<?php echo TEMPLATE_ADMIN ?>/css/widgets.css" rel="stylesheet">
    <link href="<?php echo TEMPLATE_ADMIN ?>/css/style.css" rel="stylesheet">
    <link href="<?php echo TEMPLATE_ADMIN ?>/css/style-responsive.css" rel="stylesheet" />
	<link href="<?php echo TEMPLATE_ADMIN ?>/css/xcharts.min.css" rel=" stylesheet">
	<link href="<?php echo TEMPLATE_ADMIN ?>/css/jquery-ui-1.10.4.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="<?php echo TEMPLATE_ADMIN ?>/js/html5shiv.js"></script>
      <script src="<?php echo TEMPLATE_ADMIN ?>/js/respond.min.js"></script>
      <script src="<?php echo TEMPLATE_ADMIN ?>/js/lte-ie7.js"></script>
    <![endif]-->

  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">


      <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>
            <!--logo start-->
            <a href="<?php echo base_url('admin')?>" class="logo">Javi <span class="lite">Admin</span></a>
            <!--logo end-->



            <div class="top-nav notification-row">
                <!-- notificatoin dropdown start-->
                <ul class="nav pull-right top-menu">

                    <!-- user login dropdown start-->
                    <?php
                    if($this->session->userdata('ss_UserInfo')){
                    	$arrUser = $this->session->userdata('ss_UserInfo');
                    	$id_user  = $arrUser['id_user'];
                    	$fullname = $arrUser['fullname'];
                    	$email    = $arrUser['email'];
                    	$gravatar = md5(strtolower(trim($email)));

                    }
                    ?>

                    <li class="dropdown">
                        <a href="<?php echo base_url().'admin/admin_user/edit/'?><?php if(isset($id_user))echo $id_user?>">
                            <span class="profile-ava">
                                <img alt="" src="https://www.gravatar.com/avatar/<?php if(isset($gravatar))echo $gravatar?>.jpg" width="34px" height="34px">
                            </span>
                            <span class="username"><?php if(isset($fullname))echo $fullname?></span>

                        </a>

                    </li>
                    <li id="alert_notificatoin_bar" class="dropdown">
                        <a href="<?php echo base_url().'login/logout'?>">
                            <i class="fa fa-sign-out"></i>
                        </a>
                    </li>

                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>
      </header>
      <!--header end-->
