<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view("admin/partials/head.php") ?>
  <style>
    .tabledata {
        overflow: hidden; /* this is what fixes the expansion */
        text-overflow: ellipsis; /* not supported in all browsers, but I accepted the tradeoff */
        white-space: nowrap;
    }
  </style>
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
            <h1>Student</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin/student/table') ?>">Student</a></li>
              <li class="breadcrumb-item active">Table</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Student Data</h3>
              <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <a href="<?php echo site_url('admin/student/addfile')?>">
                      <button type="button" class="btn btn-default btn-sm"><i class="fa fa-plus-square"></i> Add From File</button>
                    </a>
                  </li>
                  <span>&nbsp;</span>
                  <li class="nav-item">
                    <a href="<?php echo site_url('admin/student/add')?>">
                      <button type="button" class="btn btn-default btn-sm"><i class="fa fa-plus-square"></i> Add Student</button>
                    </a>
                  </li>
                </ul>
              </div>
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
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
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
  var student;

  function delStudent(id){
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "POST",
          data: {id: id},
          url: "<?php echo site_url('admin/API/student/delete')?>",
          dataType: "JSON",
          success: function (data) {
            if (data.status == "success") {
              student.ajax.reload();
              Swal.fire({
                icon: 'success',
                title: 'Success...',
                text: data.message
              });
            } else {
              student.ajax.reload();
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: data.message
              })
            }
          }
        });
      }
    })
  }
  
  function filename(name){
    let current_datetime = new Date()
    let formatted_date = current_datetime.getDate() + "-" + (current_datetime.getMonth() + 1) + "-" + current_datetime.getFullYear()
    return name +' (' + formatted_date + ')';
  }

  $(document).ready(function(){
    student = $("#_student_").DataTable({
      ajax: {
        url: "<?php echo site_url('admin/API/student/data')?>",
        type: "POST",
        dataSrc: ""
      },
      scrollX: true,
      dom: 'Blfrtip',
      buttons: [
        {
          extend      : 'copy',
          // title       : 'Data Student',
          text        : '<i class="far fa-copy"></i> Copy',
          titleAttr   : 'Copy',
          className   : 'btn btn-default btn-sm',
          exportOptions: {
            columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
          },
          title: filename('Data Student'),
        },
        {
          extend      : 'csv',
          title       : 'Data Student',
          text        : '<i class="far fa-file"></i> CSV',
          titleAttr   : 'CSV',
          className   : 'btn btn-default btn-sm',
          exportOptions: {
            columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
          },
          filename: filename('Data Student'),
        },
        {
          extend      : 'excel',
          title       : 'Data Student',
          text        : '<i class="far fa-file-excel"></i> Excel',
          titleAttr   : 'Excel',
          className   : 'btn btn-default btn-sm',
          exportOptions: {
            columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
          },
          filename: filename('Data Student'),
        },
        {
          extend      : 'pdf',
          title       : 'Data Student',
          oriented    : 'potrait',
          pageSize    : 'LEGAL',
          // download    : 'open',
          text        : '<i class="far fa-file-pdf"></i> PDF',
          titleAttr   : 'PDF',
          className   : 'btn btn-default btn-sm',
          exportOptions: {
            columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
          },
          filename: filename('Data Student'),
        },               
        {
          extend      : 'print',
          title       : 'Data Student',
          text        : '<i class="fas fa-print"></i> Print',
          titleAttr   : 'Print',
          className   : 'btn btn-default btn-sm',
          exportOptions: {
            columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
          }
        }
      ],
      columnDefs: [
        { className: "tabledata", targets: "_all"}
      ],
      columns: [
        {
          data: "student_id",
          render: function (data, type, row, meta) {
            // console.log(meta);
            return meta.row + meta.settings._iDisplayStart + 1;
          }
        },
        {data: "student_number"},
        {data: "student_name"},
        {data: "student_gender"},
        {data: "student_bornin"},
        {data: "student_address"},
        {data: "student_majors"},
        {data: "student_email"},
        {
          data: "student_id",
          render: function(data, type, row){
            const setDelStudent = '"'+data+'"';
            return "\
              <a href='<?php echo site_url('admin/student/edit/')?>"+data+"' data-toggle='tooltip' title='Edit'>\
                  <button type='button' class='btn btn-warning'><i class='fa fa-edit'></i></button>\
              </a>\
              <a onclick='delStudent("+setDelStudent+")' data-toggle='tooltip' title='Delete'>\
                  <button type='button' class='btn btn-danger'><i class='fa fa-trash'></i></button>\
              </a>";
          }
        }
      ]
    });

    // ===== How to make a sequence number on a datatable =====
    // student.on( 'order.dt search.dt', function () {
    //   student.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
    //       cell.innerHTML = i+1;
    //   } );
    // } ).draw();

  });
</script>
</body>
</html>
