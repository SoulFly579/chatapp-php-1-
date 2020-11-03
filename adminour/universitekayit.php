<?php

    include('includes/header.php');
    include('includes/nav.php');
    include('../db.php');

    if(isset($_POST["add_school"])){
        $school_name_add = $_POST["school_name"];
        $sql_school_add = "INSERT INTO school (school_name) VALUES ('{$school_name_add}')";
        $query_school_add = mysqli_query($baglan,$sql_school_add);
    }

?>
<div class='box' style='display:flex; flex-direction:column;margin-bottom:650px;'>
        <form action='' method='post' enctype="multipart/form-data">
        <span style='margin-left:30px;'><strong>Kolay üyelik için üniversite seçin.</strong></span></br>
            <select class="custom-select mr-sm-2" name='school' id="inlineFormCustomSelect" style='margin-bottom:20px; width:500px;margin-left:30px;'>
                <?php
                    $school_sql = "SELECT * FROM school";
                    $school_query = mysqli_query($baglan,$school_sql);
                    while($row_school = mysqli_fetch_assoc($school_query)){
                        $school_id = $row_school['school_id'];
                        $school_name = $row_school['school_name'];
                        echo "<option value='$school_id'>$school_name</option>";
                    }
                
                
                ?>
            </select></br>
            <span style='margin-left:30px;'><strong>Kolay üyelik için excel dosyasını uploadlayınız.</strong></span></br>
            <div class="input-group" style='margin-left:30px;width:500px;float:left;'>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name='file' id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                </div>
                <div class="input-group-append">
                    <input class="btn btn-outline-secondary" type="submit" name='easy_add' id="inputGroupFileAddon04">
                </div>
            </div>
        </form>
</div></br></br></br>
<?php

        $baglan->set_charset("utf8");
        require_once('excel/php-excel-reader/excel_reader2.php');
        require_once('excel/SpreadsheetReader.php');
        
        if (isset($_POST["easy_add"]))
        {
            $school = $_POST["school"];
        
            $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        
            if(in_array($_FILES["file"]["type"],$allowedFileType)){
        
                $targetPath = '../easyadd/'.$_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
                $Reader = new SpreadsheetReader($targetPath);
        
                $sheetCount = count($Reader->sheets());
                for($i=0;$i<$sheetCount;$i++)
                {
        
                    $Reader->ChangeSheet($i);
        
                    foreach ($Reader as $Row)
                    {
        
                        $username = "";
                        if(isset($Row[0])) {
                            $username = mysqli_real_escape_string($baglan,$Row[0]);
                        }
        
                        $password = "";
                        if(isset($Row[1])) {
                            $password = mysqli_real_escape_string($baglan,$Row[1]);
                        }
        
                        $email = "";
                        if(isset($Row[2])) {
                            $email = mysqli_real_escape_string($baglan,$Row[2]);
                        }
                        $role = "";
                        if(isset($Row[3])) {
                            $role = mysqli_real_escape_string($baglan,$Row[3]);
                        }
        
        
                        if (!empty($username) || !empty($password) || !empty($email)|| !empty($role)) {
                            $query = "INSERT INTO users (user_name,user_password,user_email,role,school_id) VALUES('{$username}','{$password}','{$email}','{$role}','{$school}')";
                            $result = mysqli_query($baglan, $query);
        
                            if (! empty($result)) {
                                $type = "success";
                                $message = "Excel Verileri Başarıyla Aktarıldı";
                            } else {
                                $type = "error";
                                $message = "Hata Oluştu Veriler Aktarılamadı";
                            }
                        }
                    }
        
                }
            }
            else
            { 
                $type = "error";
                $message = "Excel Dosyası Seçilmedi. Lütfen Dosyayı Kontrol Edin";
            }
        }


?>


<?php

include('includes/footer.php'); 


?>