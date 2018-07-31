<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registration-CI Login Registration</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" title="no title">


  </head>
  <body>

<span style="background-color:red;">
  <div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
      <div class="row"><!-- row class is used for grid system in Bootstrap-->
          <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
              <div class="login-panel panel panel-success">
                  <div class="panel-heading">
                      <h3 class="panel-title">Registration</h3>
                  </div>
                  <div class="panel-body">

                  <?php
                  $error_msg=$this->session->flashdata('error_msg');
                  if($error_msg){
                    echo $error_msg;
                  }
                   ?>

                      <form role="form" method="post" action="<?php echo base_url('index.php/user/register_user'); ?>">
                          <fieldset>
                              <div class="form-group">
                                  <input class="form-control" placeholder="First name" name="user_first_name" type="text" autofocus required>
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Last name" name="user_last_name" type="text" autofocus required>
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="E-mail" name="user_email" type="email" autofocus required>
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Company name" name="user_company_name" type="text" value="" required>
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Password" name="user_password" type="password" value="" required>
                              </div>
                              <div class="form-group">
                                  <input class="form-control" placeholder="Phone number" name="user_phone" type="number" value="" required>
                              </div>
                                <div class="radio" style="white-space:nowrap overflow:hidden">
                                    <ul style="padding-left: 0px !important">
                                    <li>License type:</li>
                                    <li><label><input type="radio" name="license_type" checked="checked" value="trail"> Proefabbonement voor 3 maanden.</label></li>
                                    <li><label><input type="radio" name="license_type" value="paid"> Betalend abbonement.</label></li>
                                    </ul>
                               </div>
                              <input class="btn btn-lg btn-success btn-block" type="submit" value="Register" name="register" >

                          </fieldset>
                      </form>
                      <center><b>Already registered ?</b> <br></b><a href="<?php echo base_url('index.php/user/login_view'); ?>">Login here</a></center><!--for centered text-->
                  </div>
              </div>
          </div>
      </div>
  </div>





</span>




  </body>
</html>