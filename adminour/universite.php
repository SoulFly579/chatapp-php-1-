<?php

    include('includes/header.php');
    include('includes/nav.php');

    if(isset($_POST["add_school"])){
        $school_name_add = $_POST["school_name"];
        $sql_school_add = "INSERT INTO school (school_name) VALUES ('{$school_name_add}')";
        $query_school_add = mysqli_query($baglan,$sql_school_add);
    }

?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <!-- Content Row -->
        <div class="row">
                <!-- Begin Page Content -->
                <div class="container-fluid">

                <h1 class="h3 mb-2 text-gray-800">Üniversite Kayıt</h1>
                <p class="mb-4">Kaydetmek istedğiniz üniversite bilgilerini giriniz.</p>
                <form action='' method='post'>
                    <input class="form-control" type="text" name='school_name' placeholder="Kayıt etmek istediğiniz üniversiteyi yazınız..."></br>
                    <input class="btn btn-primary" type="submit" name='add_school' value="Submit">
                </form></br>

<h1 class="h3 mb-2 text-gray-800">Üniversite Listeleri</h1>
<p class="mb-4">Tüm üniversiteler burda listelenecektir.</p>

<!-- Google Charts  -->
<div class='row'>
    <div class='col-md-6'>
    <div id="columnchart_material" style="width: 800px; height: 500px;"></div></br></br>
  </div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Kayıtlı Üniversiteler</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Id</th>
            <th>Üniversite Adı</th>
            <th>Üniversiteye Kayıtlı Öğrenci</th>
          </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Üniversite Adı</th>
                <th>Üniversiteye Kayıtlı Öğrenci</th>
            </tr>
        </tfoot>
        <tbody>
        <?php

        $sql_sorgu_school = "SELECT * FROM school";
        $query_sorgu_school = mysqli_query($baglan,$sql_sorgu_school);
        while($row_school = mysqli_fetch_assoc($query_sorgu_school)){
            $school_id = $row_school['school_id'];
            $school_sql = "SELECT * FROM users WHERE school_id = '$school_id' AND role = 'student'";
            $school_query = mysqli_query($baglan,$school_sql);
            $count_school_student = mysqli_num_rows($school_query);
            $school_name = $row_school['school_name'];
            echo "<tr>
            <td>$school_id</td>
            <td>$school_name</td>
            <td>$count_school_student</td>
          </tr>
          </tr>";
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Reportlanan Öğrenciler</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Id</th>
            <th>Öğrenci Adı</th>
            <th></th>
          </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Id</th>
            <th>Öğrenci Adı</th>
            <th></th>
          </tr>
        </tfoot>
        <tbody>
        <?php
        $k = 1 ;
        $sql_sorgu_reports = "SELECT DISTINCT report_receiver_id FROM reports";
        $query_sorgu_reports = mysqli_query($baglan,$sql_sorgu_reports);
          while($row_reports = mysqli_fetch_assoc($query_sorgu_reports)){
              $user_id = $row_reports['report_receiver_id'];
              $user_sql2= "SELECT * FROM users WHERE user_id = '$user_id' ";
              $user_query2 = mysqli_query($baglan,$user_sql2);
              while($row_user = mysqli_fetch_assoc($user_query2)){
                $user_name = $row_user['user_name'];
              }  
              $at_least_three_reports = "SELECT * FROM reports WHERE report_receiver_id = '$user_id' ";
              $at_least_three_reports_query = mysqli_query($baglan,$at_least_three_reports);
              $three_times_report = mysqli_num_rows($at_least_three_reports_query);
              if($three_times_report > 2){
                echo "<tr>
                <td>$user_id</td>
                <td>$user_name</td>
                <td><button type='button' class='btn btn-primary' style='float:right;height:35px;' data-toggle='modal' data-target='#exampleModal$k'>
                Görüntüle
              </button></td>
              </tr>
              </tr>";}
        ?>
                           <div class='modal fade' id='exampleModal<?php echo $k;?>' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                           <div class='modal-dialog'>
                             <div class='modal-content'>
                               <div class='modal-header'>
                                 <h5 class='modal-title' id='exampleModalLabel'>Bilgilendirme</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>×</span></button>
                               </div>
                               <div class='modal-body'>
                                 <strong><?php echo $user_name; ?></strong> adlı kullanıcıyı neden raporlandığını görüntülüyorsunuz.</br></br>
                                 <ul class="list-group">
                                 <?php 
                                    $sql_detay_report = "SELECT DISTINCT report_information FROM reports WHERE report_receiver_id = '$user_id'";
                                    $query_detay_report = mysqli_query($baglan,$sql_detay_report);
                                    while($row_detay = mysqli_fetch_assoc($query_detay_report)){
                                      $report_information = $row_detay['report_information'];
                                      $report_information_sql_count = "SELECT * FROM reports WHERE report_information = '$report_information' AND report_receiver_id = '$user_id' ";
                                      $report_information_query_count = mysqli_query($baglan,$report_information_sql_count);
                                      $report_information_count = mysqli_num_rows($report_information_query_count);
                                      echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                                      $report_information
                                      <span class='badge badge-primary badge-pill'>$report_information_count</span></li>";
                                    }
                                 
                                 
                                 ?>
                                </ul>
                               </div>
                              </br>
                               <div class='modal-footer'>
                                 <button type='button' class='btn btn-secondary' data-dismiss='modal'>Kapat</button>
                               </div>
                   
                             </div>
                           </div>
                         </div>
                        <?php $k++; }?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

        </div>
        <!-- /.container-fluid -->
        </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script> 
    <script>
    $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
    })
    </script>

<?php

include('includes/footer.php'); 


?>