
<?php
$school_id_session = $_SESSION["school_id"];

$school_name_sql = "SELECT * FROM school WHERE school_id = '$school_id_session'";
$school_name_query = mysqli_query($baglan,$school_name_sql);


$sql_student = "SELECT * FROM users WHERE role = 'student' AND school_id = '$school_id_session' ";
$query_student = mysqli_query($baglan,$sql_student);



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

<h1 class="h3 mb-2 text-gray-800">Öğrenci Listeleri</h1>
<p class="mb-4">Tüm öğrenciler burda listelenecektir.</p>



<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
  <?php 
        while($school_row = mysqli_fetch_assoc($school_name_query)){
            $school_row_name = $school_row["school_name"];
            echo "<h6 class='m-0 font-weight-bold text-primary'>{$school_row_name}'nde Kayıtlı Öğrenciler</h6>";
        }
?>
    
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Adı</th>
            <th>Email Adresi</th>
            <th>Durum</th>
            <th>Görüşme Sayısı</th>
            <th>Puan</th>
          </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Adı</th>
                <th>Email Adresi</th>
                <th>Durum</th>
                <th>Görüşme Sayısı</th>
                <th>Puan</th>
            </tr>
        </tfoot>
        <tbody>
            <?php 
            while($row_student = mysqli_fetch_assoc($query_student)){
                $student_user_id = $row_student["user_id"];
                $student_user_username = $row_student["user_name"];
                $student_user_email = $row_student["user_email"];
                $student_status = $row_student["status"];
                $sql_student_interview = "SELECT DISTINCT receiver_id FROM chat WHERE sender_id = '$student_user_id' ";
                $query_student_interview = mysqli_query($baglan,$sql_student_interview);
                $query_student_interview_num_rows = mysqli_num_rows($query_student_interview);
                $sql_star_average = "SELECT AVG(star_level) FROM stars WHERE star_receiver_id = '$student_user_id' ;";
                $query_star_average = mysqli_query($baglan,$sql_star_average);
                while($row3 = mysqli_fetch_assoc($query_star_average)){
                    $star_level_avg = $row3['AVG(star_level)'];
                }
                $star_avg= number_format($star_level_avg,1);

                  echo "<tr>
                  <td>{$student_user_id}</td>
                  <td>{$student_user_username}</td>
                  <td>{$student_user_email}</td>
                  <td>{$student_status}</td>
                  <td>{$query_student_interview_num_rows}</td>
                  <td>{$star_avg}</td>
                  </tr>";
              }
            
            
            ?>
          
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