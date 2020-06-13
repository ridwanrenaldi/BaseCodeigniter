<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view("admin/partials/head.php") ?>
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
                <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <a href="<?php echo base_url('uploads/file/format_student.xlsx')?>">
                      <button type="button" class="btn btn-default btn-sm"><i class="fa fa-plus-square"></i> Download Format</button>
                    </a>
                  </li>
                </ul>
              </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo site_url('admin/student/addfile') ?>" class="form-horizontal" enctype="multipart/form-data" method="post">
                <div class="card-body">

                  <div class="form-group row">
                    <label for="_file_" class="col-sm-3 col-form-label" style="text-align: right;">File Excel</label>
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="_file_" name="_file_" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                          <label class="custom-file-label" for="customFile" id="filename" style="overflow: hidden;">Choose file</label>
                        </div>
                      </div>
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

        <?php if (isset($notif["faileddata"]) && !empty($notif["faileddata"])) { ?>
        <div class="row">
          <div class="col-12">

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Student Data</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="_student_" class="table table-bordered table-hover table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>StudentID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>BornIn</th>
                    <th>Address</th>
                    <th>Majors</th>
                    <th>Email</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sheet = $notif["faileddata"];
                      foreach ($sheet as $key => $col) {
                        // var_dump($col);
                        $html = "<tr>";
                        $html .= "<td>".($key+1)."</td>";
                        $html .= (strval($col[1]) === "" || strval($col[1]) == null)? "<td style='background: #E07171;'>".$col[1]."</td>" : "<td>".$col[1]."</td>";
                        $html .= (strval($col[2]) === "" || strval($col[2]) == null)? "<td style='background: #E07171;'>".$col[2]."</td>" : "<td>".$col[2]."</td>";
                        $html .= (strval($col[3]) === "" || strval($col[3]) == null)? "<td style='background: #E07171;'>".$col[3]."</td>" : "<td>".$col[3]."</td>";
                        $html .= (strval($col[4]) === "" || strval($col[4]) == null)? "<td style='background: #E07171;'>".$col[4]."</td>" : "<td>".$col[4]."</td>";
                        $html .= (strval($col[5]) === "" || strval($col[5]) == null)? "<td style='background: #E07171;'>".$col[5]."</td>" : "<td>".$col[5]."</td>";
                        $html .= (strval($col[6]) === "" || strval($col[6]) == null)? "<td style='background: #E07171;'>".$col[6]."</td>" : "<td>".$col[6]."</td>";
                        $html .= (strval($col[7]) === "" || strval($col[7]) == null)? "<td style='background: #E07171;'>".$col[7]."</td>" : "<td>".$col[7]."</td>";
                        $html .= "</tr>";
                        echo $html;
                      }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <?php } ?>


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
<script>
  function goBack() {
    window.history.back();
  }

  $(document).ready(function(){
    // If you upload an image
    $("#_file_").on("change", function() {
      var type = [".csv", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.ms-excel"]
      var files = $(this).get(0).files;
      var eks = (files[0].name).split('.')[1];
      // console.log(files);

      // Check extension type
      if ($.inArray(files[0].type, type)) {
        $("#filename").text(files[0].name);
      } else {
        $("#filename").text("");
        $("#_file_").val("");
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          html: 'The filetype you are attempting to upload is not allowed'
        });
      }
    });

    // ===== Reset button is clicked =====
    $("#_reset_").on("click", function(){
      $("#filename").text("Choose file");
      $("#img-preview").attr("src","<?php echo base_url('uploads/account/default.png')?>");
    });

    //  ===== Data table =====
    $("#_student_").DataTable();

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
