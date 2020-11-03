<?php

include('../db.php');


?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container" style="margin-top:150px; margin-left:575px;">
	<div class="row">
	
        
        
       <div class="col-md-7 ">

<div class="panel panel-default">
  <div class="panel-heading">  <h4 >Profil</h4></div>
   <div class="panel-body">
       
    <div class="box box-info">
        
            <div class="box-body">
                     <div class="col-sm-6">
                     <div  align="center"> <img alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive"> 
                
                <!--Upload Image Js And Css-->
           
              
   
                <?php 
                        $user_name__id = $_GET["profile"];
                        $query2 = "SELECT * FROM users WHERE user_id = '$user_name__id' ";
                        $sql_query2 = mysqli_query($baglan,$query2);
                        while($row2 = mysqli_fetch_array($sql_query2)){
                            $user_id = $row2["user_id"];
                            $user_name = $row2["user_name"];
                            $user_role = $row2['role'];
                            $user_school_id = $row2['school_id'];
                            $sql_school = "SELECT * FROM school WHERE school_id='$user_school_id' ";
                            $query_school = mysqli_query($baglan,$sql_school);
                            while($row = mysqli_fetch_array($query_school)){
                                $school_name = $row['school_name'];
                            }
                        }
                    
                ?>
                     </div>
              
              <br>
    
              <!-- /input-group -->
            </div>
            <div class="col-sm-6">
            <h4 style="color:#00b1b1;"><?php echo $user_name;?></h4></span>
              <span><p><?php echo $user_role; ?></p></span>            
            </div</br></br>
             <div class='container'>
                <form action="" method='post'>
                    <input type="radio" name="star" value='1'>1</br>
                    <input type="radio" name="star" value='2'>2</br>
                    <input type="radio" name="star" value='3'>3</br>
                    <input type="radio" name="star" value='4'>4</br>
                    <input type="radio" name="star" value='5'>5</br></br>
                    <button type="submit" name='puanla' class="btn btn-outline-success">Puanla !!</button>
                    <?php
                        if(isset($_POST['puanla'])){
                            $star_level = $_POST['star'];
                            $sql_star = "INSERT INTO stars (star_sender_id,star_receiver_id,star_level) VALUES ('0','{$user_id}','{$star_level}')";
                            $query_star = mysqli_query($baglan,$sql_star);
                        }
                    
                    
                    ?>
                </form>
            </div>
            <div class="clearfix"></div>
            <hr style="margin:5px 0 5px 0;">
                        
              
<div class="col-sm-5 col-xs-6 tital " >Adı:</div><div class="col-sm-7 col-xs-6 "><?php echo $user_name; ?></div>
     <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Okuduğu Okul:</div><div class="col-sm-7"><?php echo $school_name; ?></div>
  <div class="clearfix"></div>
<div class="bot-border"></div>
<?php
$sql_star_average = "SELECT AVG(star_level) FROM stars WHERE star_receiver_id = '$user_id' ;";
$query_star_average = mysqli_query($baglan,$sql_star_average);
while($row3 = mysqli_fetch_assoc($query_star_average)){
    $star_level_avg = $row3['AVG(star_level)'];
}

?>
<div class="col-sm-5 col-xs-6 tital " >Puanı:</div><div class="col-sm-7"><?php echo number_format($star_level_avg,1); ?></div>
  <div class="clearfix"></div>
<div class="bot-border"></div>


  <div class="clearfix"></div>
<div class="bot-border"></div>



            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
       
            
    </div> 
    </div>
</div>  
    <script>
              $(function() {
    $('#profile-image1').on('click', function() {
        $('#profile-image-upload').click();
    });
});       
              </script> 
       
       
       
       
       
       
       
       
       
   </div>
</div>




         