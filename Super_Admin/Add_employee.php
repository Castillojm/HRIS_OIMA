   <?php include 'header/head.php';?>
   <?php include 'sidebar/sidebar_menu.php';?>

    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              
              <div class="card-header">
                <h3 class="card-title" style="float: right;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-overlay">
                  Add Employee
                </button></h3>
                <?php include 'modal/addemployee_modal.php';?>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Company ID</th>
                    <th>Employee Image</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Branches DateFrom</th>
                    <th>Branches RecentDate</th>
                    <th>Department</th>
                    <th>Branches</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                       include('include/access/connector.php');
                      $result = $phdb->query("SELECT * FROM `employee_table` ORDER BY employee_id DESC");
                      // if($result->num_rows === 0) echo'<div class="alert alert-warning" role="alert">No Record Found!!!</div>';
                       while ($row = $result->fetch_array()){
                        $image_path = strip_tags($row['employee_image']);
                          if(!is_file("image_upload/".$image_path)){
                            $npath = str_replace("../","/",$image_path);
                            if(is_file("../Admin_Dashboard".$npath)) $image_path = "../Admin_Dashboard". $npath;
                          }else{
                            $image_path= "image_upload/".$image_path;
                          }
                          
                      ?>
                      <tr>

                        <td><?php echo $row['employee_companyid'];?></td>
                         <td><img src="<?php echo $image_path ?>" height="80" width="80"></td>
                        <td><?php echo $row['employee_firstname'];?></td>
                        <td><?php echo $row['employee_lastname'];?></td>
                        <td><?php echo date('M-d-Y', strtotime(htmlentities($row['branches_datefrom'])));?></td>
                        <td><?php echo date('M-d-Y', strtotime(htmlentities($row['branches_recentdate'])));?></td>
                        <td><?php echo $row['employee_department'];?></td>
                        <td><?php echo $row['employee_branches'];?></td>
                        <td style="width: 10%"><i data-toggle="modal" data-target="#modal-edits<?php echo $row['employee_id'];?>" class="fa fa-edit" style="color: green" title="Edit Employee"></i> | <i data-toggle="modal" data-target="#modal-delete3<?php echo $row['employee_id'];?>" class="fa fa-trash" style="color: red" title="Delete Employee"></i> | <object data="../pdf/sample-3pp.pdf#page=2" type="application/pdf" width="100%" height="100%"><a href="file_upload/<?php echo $row['employee_file201'];?>" title="Download File 201" ><i class="fa fa-download"></i> </a>
                        </object>
                        </td>
                         <?php include 'modal/editemployee_modal.php';?>
                         <?php include 'modal/deleteemployee_modal.php';?>
                      </tr>

                     <?php  } ?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
  </div>
  <footer class="main-footer">
      <strong>Created by &copy; JMCastillo <a href="#">HRMIS-OIMA</a>.</strong>
     
      <div class="float-right d-none d-sm-inline-block">
          <b>Sample</b> 0.1
      </div>
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
<script src="/pdf_js/pdfobject.js"></script>
<script>PDFObject.embed("/pdf_js/sample-3pp.pdf", "#example1");</script>

<script src="../Admin_Dashboard/plugins/jquery/jquery.min.js"></script>
<script src="../Admin_Dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../Admin_Dashboard/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../Admin_Dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../Admin_Dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../Admin_Dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
