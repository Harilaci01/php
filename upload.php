<?php 
if(isset($_FILES["fileToUpload"])&&isset($_FILES["fileToUpload2"])){
    $target_dir="uploads/";
    $target_file=$target_dir.basename($_FILES["fileToUpload"]["name"]);
   $target_file2=$target_dir.basename($_FILES["fileToUpload2"]["name"]);
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
        echo "File 1 has been uploaded.";
    }
    if(move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file2)){
        echo " <br> File 2 has been uploaded.";
    }

}
?>
<!DOCTYPE html>
<html>
    <body>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="file" name="fileToUpload2" id="fileToUpload2">
            <input type="submit" value="Upload Image" name="submit">
        </form>
    </body>
</html>
