<html>
    <head>
        <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DairyLogPro</title>
        <link rel="stylesheet" href="<?php echo assets_url();?>/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo assets_url();?>/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo assets_url();?>/themes/material/easyui.css">
        <link rel="stylesheet" href="<?php echo assets_url();?>/themes/icon.css">
        <link rel="stylesheet" href="<?php echo assets_url();?>/css/dashboard.css">
        <link rel="stylesheet" href="<?php echo assets_url();?>/nepali.datepicker.v2.1.min.css">
        
    </head>
<body>

 <nav class="navbar navbar-default">
   <div class="container">
     <!-- Brand and toggle get grouped for better mobile display -->
     <div class="navbar-header">
       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </button>
       <a class="navbar-brand" href="#"></a>
     </div>

     <!-- Collect the nav links, forms, and other content for toggling -->
     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
       <ul class="nav navbar-nav">
            <li <?php if($activation_key == 1){echo ' class="active"';}?>><a href="<?php echo base_url();?>index.php/dashboard">Home</a></li>
            <li <?php if($activation_key == 2){echo ' class="active"';}?>><a href="<?php echo base_url();?>index.php/dashboard/register">कृषक दर्ता</a></li>
            <li <?php if($activation_key == 3){echo ' class="active"';}?>><a href="<?php echo base_url();?>index.php/dashboard/entry">Entry</a></li>
            <li <?php if($activation_key == 4){echo ' class="active"';}?>><a href="<?php echo base_url();?>index.php/dashboard/report">रिपोर्ट</a></li>
            <li <?php if($activation_key == 5){echo ' class="active"';}?>><a href="<?php echo base_url();?>index.php/dashboard/payment">Payment</a></li>
            <li<?php if($activation_key == 6){echo ' class="active"';}?>><a href="<?php echo base_url();?>index.php/dashboard/settings">Settings</a></li>
            <li class="navbar-right"><a href="<?php echo base_url();?>index.php/logout">Logout</a></li>
      
       </ul>
         
     </div><!-- /.navbar-collapse -->
   </div><!-- /.container-fluid -->
 </nav>

       