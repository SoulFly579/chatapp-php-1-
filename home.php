<?php include "db.php"; ?><?php session_start(); ?><?php ob_start(); ?><?php

  if(!isset($_SESSION["id"])){
    header("Location: user/login.php");
    }else{
    
    }


?>
<!DOCTYPE html>
<html>
<head>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script><!--==== Include the above in your HEAD tag ========-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  <title></title>
</head>
<body>
  <div class="container">
    <h3 class="pb-3 mb-4 font-italic border-bottom">AnaSayfa</h3>
    <div class="row">
      <?php
                        $k = 1;

                        $sql_users = "SELECT * FROM users WHERE role= 'student' ";
                        $query_users = mysqli_query($baglan,$sql_users);
                        while($row = mysqli_fetch_assoc($query_users)){
                            $user_id = $row['user_id'];
                            $user_name = $row['user_name'];
                            echo "
                            <div class='col-md-4'>
                            <div class='card mb-4 border-dark'>
                               <img class='card-img-top' src='//placeimg.com/290/180/any' alt='Card image cap'>
                               <div class='card-body'>
                                  <h5 class='card-title'>$user_name</h5>
                                  <p class='card-text'></p>
                                  <a href='/chatapphp/index.php?chat=$user_id' style='float:left;height:35px;' class='btn btn-dark btn-sm'>Mesaj Yaz</a>
                                  <button type='button' class='btn btn-primary' style='float:right;height:35px;' data-toggle='modal' data-target='#exampleModal$k'>
                                    Raporla
                                  </button>
                               </div>
                           </div></div>
                           ";
                        
                   
                   
                   ?>
                   <div class='modal fade' id='exampleModal<?php echo $k;?>' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                           <div class='modal-dialog'>
                             <div class='modal-content'>
                               <div class='modal-header'>
                                 <h5 class='modal-title' id='exampleModalLabel'>Report</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>×</span></button>
                               </div>
                               <div class='modal-body'>
                                 <strong><?php echo $user_name; ?></strong> adlı kullanıcıyı neden raporlayacağınızı seçiniz lütfen!
                               </div>
                               <form action='' method='post'>
                               <div class='form-row align-items-center'>
                                 <div class='col-auto my-1'>
                                   <select class='custom-select mr-sm-2' name='report_reason' style='margin-left:70px;' id='inlineFormCustomSelect'>
                                     <option value='+18 Davranış'>+18 Davranış</option>
                                     <option value='Hakaret'>Hakaret</option>
                                   </select>
                                   <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                 </div></br></br>
                                 <div class='col-auto my-1'>
                                 </div>
                                 <div class='col-auto my-1'>
                                 </div>
                               </div></br>
                               <div class='modal-footer'>
                                 <button type='button' class='btn btn-secondary' data-dismiss='modal'>Kapat</button> <input type='submit' name='report' class='btn btn-primary' value='Gönder'>
                               </div>
                             </form>
                   
                             </div>
                           </div>
                         </div>
                        <?php $k++; }?>
<?php

    if(isset($_POST['report'])){
      $report_reason = $_POST['report_reason'];
      $reported_id = $_POST['user_id'];
      $sql_report = "INSERT INTO reports (report_sender_id, report_receiver_id, report_information) VALUES ('0', '{$reported_id}','{$report_reason}')";
      $query_report = mysqli_query($baglan,$sql_report);
    }

?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script> 
    <script>
    $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
    })
    </script>
  </div>
</body>
</html>