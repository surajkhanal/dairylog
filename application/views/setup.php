<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" width="device-width">
        <title>Admin : Setup Account</title>
        <link rel="stylesheet" href="<?php echo assets_url();?>/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo assets_url();?>/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo assets_url();?>/css/style.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="box">
                        <form  id="setupForm" method="post">
                            <h4>Setup Username and Password</h4>
                            <p>This is for first time.After setup your account you can login.</p>
                            <hr class="divider">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="username">Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <input type="password" id="confirmPassword" name="confirmpassword" class="form-control" placeholder="Retype Password">
                            </div>
                            <button type="submit" class="btn btn-block btn-primary">Save</button>
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
    
          
       
            $('#setupForm').submit(function(e){
                e.preventDefault();
                  $('#setupForm').validate({
                    errorElement:"span",
			        rules : {
                        username:{
                            required:true
                            },
				        password : {
                            required:true,
                            minlength : 5
                            },
                        confirmpassword : {
                            required:true,
                            minlength : 5,
                            equalTo : "#password"
                            }
			        },
                    onsubmit:true
		        });
                var form = this;

            
                 if($('#setupForm').valid()){
                        var data = $("#setupForm").serialize();
                        console.log(data);
                $.ajax({
                    url:'<?php echo base_url();?>index.php/login/setup',
                    method:'POST',
                    data:data,
                    beforeSend: function() {
                        $('.btn').attr('disabled','disabled');
                    },
                    success:function(response){
                        console.log(response);
                       if(response.Msg == true){
                            window.location.reload();
                       }else{
                            $('.alert').addClass('alert-danger');
                            $('.alert').html('<b>Error:</b> Username or Password wrong!');
                            $('.alert').fadeIn("slow").show();
                            setTimeout(function(){
                                $('.alert').fadeToggle("slow").hide();
                            },3000);
                       }
                    },
                    error:function(error){
                        console.log(error);
                    }
                });
                }
            });
        
        });
    </script>
    </body>
</html>