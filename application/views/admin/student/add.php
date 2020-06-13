<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view("admin/partials/head.php") ?>
  <!-- bootstrap-datetimepicker -->
  <link href="<?php echo base_url('assets/adminlte/plugins/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')?>" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini pace-primary">
<!-- Site wrapper -->
<div class="wrapper">
  <?php $this->load->view("admin/partials/navbar.php") ?>

  <?php $this->load->view("admin/partials/sidebar.php") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Student</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin/student/table') ?>">Student</a></li>
              <li class="breadcrumb-item active">Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Input</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo site_url('admin/student/add') ?>" class="form-horizontal" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="_number_" class="col-sm-3 col-form-label" style="text-align: right;">Number</label>
                    <div class="col-sm-6">
                      <input type="text" name="_number_" class="form-control" id="_number_" placeholder="Number" value="<?php echo set_value('_number_'); ?>" required="required" minlength="10" maxlength="10">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_name_" class="col-sm-3 col-form-label" style="text-align: right;">Name</label>
                    <div class="col-sm-6">
                      <input type="text" name="_name_" class="form-control" id="_name_" placeholder="Name" value="<?php echo set_value('_name_'); ?>" required="required" minlength="2" maxlength="50">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_gender_" class="col-sm-3 col-form-label" style="text-align: right;">Gender</label>
                    <div class="col-sm-6">
                    <select name="_gender_" id="_gender_" class="form-control" required="required">
                        <option selected disabled hidden>- Choose Gender -</option>
                        <option value="Male" <?php echo  set_select('_gender_', "Male"); ?>>Male</option>
                        <option value="Female" <?php echo  set_select('_gender_', "Female"); ?>>Female</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_bornin_" class="col-sm-3 col-form-label" style="text-align: right;">Date of birth</label>
                    <div class="col-sm-6">
                      <div class="input-group date" id="datepicker">
                      <input type="text" name="_bornin_" placeholder="Date of birth" class="form-control" value="<?php echo set_value('_bornin_'); ?>" required="required"/>
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_address_" class="col-sm-3 col-form-label" style="text-align: right;">Address</label>
                    <div class="col-sm-6">
                      <input type="text" name="_address_" class="form-control" id="_address_" placeholder="Address" value="<?php echo set_value('_address_'); ?>" required="required" minlength="2" maxlength="50">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_majors_" class="col-sm-3 col-form-label" style="text-align: right;">Majors</label>
                    <div class="col-sm-6">
                      <input type="text" name="_majors_" class="form-control" id="_majors_" placeholder="Majors" value="<?php echo set_value('_majors_'); ?>" required="required" minlength="2" maxlength="50">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="_email_" class="col-sm-3 col-form-label" style="text-align: right;">Email</label>
                    <div class="col-sm-6">
                      <input type="email" name="_email_" class="form-control" id="_email_" placeholder="Email" value="<?php echo set_value('_email_'); ?>" required="required" minlength="2" maxlength="50">
                    </div>
                  </div>


                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <div class="form-group row">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                      <button type="button" class="btn btn-warning" onclick="goBack()">Cancel</button>
                      <button type="reset" class="btn btn-info" id="_reset_">Reset</button>
                      <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                  </div>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view("admin/partials/footer.php") ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php $this->load->view("admin/partials/javascript.php") ?>
<!-- bootstrap-datetimepicker -->    
<script src="<?php echo base_url('assets/adminlte/plugins/bootstrap-datetimepicker/build/js/moment.js')?>"></script>
<script src="<?php echo base_url('assets/adminlte/plugins/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')?>"></script>
<script>
  function goBack() {
    window.history.back();
  }

  $(document).ready(function(){
    $('#datepicker').datetimepicker({
      format: 'YYYY-MM-DD',
      ignoreReadonly: true,
      allowInputToggle: true,
    });

    $("#datepicker").on("dp.change", function(e) {
      $('#datepicker').data("DateTimePicker").maxDate(e.date);
    });

    // ===== Notification alert =====
    var notif = {
      status:"<?php if(isset($notif["status"])) { echo $notif["status"]; } ?>", 
      message:"<?php if(isset($notif["message"])) { echo $notif["message"]; } ?>"
    };

    if (notif.status == "error" && notif.message != "") {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        html: notif.message
      });
    } else if(notif.status == "success" && notif.message != ""){
      Swal.fire({
        icon: 'success',
        title: 'Success...',
        html: notif.message,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Check Data',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.value) {
          window.location.replace("<?php echo site_url('admin/student/table') ?>");
        }
      });
    }

  });
</script>
</body>
</html>
