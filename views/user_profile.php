<?php
$user_id=$this->session->userdata('user_id');

if(!$user_id){

  redirect('/user/login_view');
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>User Profile Dashboard-CodeIgniter Login Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      
    <!-- Google jquery CDN link -->  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      
    <!-- Hello-week -->
    <script src="/application/node_modules/hello-week/dist/helloweek.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/node_modules/hello-week/dist/helloweek.min.css" media="all"/>      
  </head>

  <body>

<div class="container">
    <div class="col-md-12">

      <table class="table table-bordered table-striped">


        <tr>
          <th colspan="2"><h4 class="text-center">User Info</h3></th>

        </tr>
          <tr>
            <td>Welcome </td>
            <td><?php echo $this->session->userdata('user_first_name'); ?> <?php echo $this->session->userdata('user_last_name'); ?></td>
          </tr>
      </table>
        
    </div>
      <div class="col-md-12">
              <div class="hello-week">
            <div class="hello-week__header">
                <button class="hello-week__prev">Prev</button>
                <div class="hello-week__label"></div>
                <button class="hello-week__next">Next</button>
            </div>
            <div class="hello-week__week"></div>
            <div class="hello-week__month"></div>
        </div>
  </div>
<a href="<?php echo base_url('user/user_logout');?>" >  <button type="button" class="btn-primary">Logout</button></a>
</div>
  </body>
    <script>
    const calendar = new HelloWeek({
        selector: '.hello-week',
        lang: 'en',
        langFolder: '/application/node_modules/hello-week/dist/langs/',
        format: 'YYYY-MM-DD',
        weekShort: true,
        monthShort: false,
        multiplePick: false,
        defaultDate: false,
        todayHighlight: true,
        disablePastDays: false,
        disabledDaysOfWeek: false,
        disableDates: false,
        weekStart: 1,
        daysHighlight: false,
        range: false,
        minDate: false,
        maxDate: false,
        nav: ['◀', '▶'],
        onLoad: () => { /** callback function */ },
        onChange: () => { /** callback function */ },
        onSelect: () => { /** callback function */ },
        onClear: () => { /** callback function */ }
    });
    </script>
</html>