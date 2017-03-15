<html>
    <head>
       <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DairyLogPro</title>
        <link rel="stylesheet" href="<?php echo assets_url();?>/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo assets_url();?>/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo assets_url();?>/css/style.css">
        
        
    </head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="box">
                    <h3>Dairy Log Software</h3>
                    <hr class="divider">
                    <div class="alert" role="alert" style="display:none">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="loginForm" method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon3"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" id="username" name="username" aria-describedby="basic-addon3" placeholder="Username" required>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                            <span class="input-group-addon" id="basic-addon3"><i class="fa fa-key"></i></span>
                            <input type="password" class="form-control" id="password" name="password" aria-describedby="basic-addon3" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" id="login">Login</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo assets_url();?>/js/jquery.min.js"></script>
    <script src="<?php echo assets_url();?>/js/bootstrap.min.js"></script>
    <script src="<?php echo assets_url();?>/js/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#loginForm').submit(function(e){
                e.preventDefault();
                var form = this;

                var data = $("#loginForm").serialize();
                console.log(data);
                $(this).validate({
                    errorElement:"span",
                    rule:{
                        username:{
                            required:true,
                        },
                        password:{
                            required:true
                        }
                    }
                });
                if($(this).valid()){
                $.ajax({
                    url:'<?php echo base_url();?>index.php/login/check',
                    method:'POST',
                    data:data,
                    dataType: 'json',
                    success:function(response){
                      
                        console.log(response.Msg);
                       if(response.Msg == 'error'){
                             $('.alert').addClass('alert-danger');
                            $('.alert').html('<b>Error:</b> Username or Password wrong!');
                            $('.alert').fadeIn("slow").show();

                            setTimeout(function(){
                                $('.alert').fadeToggle("slow").hide();
                            },3000);
                       }else if(response.Msg == 'success'){
                           window.location="<?php echo base_url();?>index.php/dashboard";
                       }else if(response.Msg == 'expire'){
                            window.location="<?php echo base_url();?>index.php/expire";
                       }
                    },
                    error:function(error){
                        console.log('Error '+JSON.stringify(error));
                    }
                });
               }
            });
        });
    </script>
</body>
</html>