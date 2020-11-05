<?php require_once('nav.html');
require_once('config.php'); ?>
<?php
// Random Str Fun
function RandomStr($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString . "_Mr28";
}
if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['all_text']) && !empty($_POST['all_text'])) {
    $title    = htmlspecialchars($_POST['title'], ENT_QUOTES);
    $all_text = htmlspecialchars($_POST['all_text'], ENT_QUOTES);
    $d = new DateTime("now", new DateTimeZone("Asia/Baghdad"));
    $time = $d->format("Y/m/d  h:i:s A");
    // image Upload
    $target_dir = "DATA/pic/";
    $path = $_FILES["fileToUpload"]["name"];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    if (empty($ext)) {
        $image_name = "NotFound.gif";
        $db->exec("INSERT INTO data (title, textarea,`time`,pic) VALUES ('$title','$all_text','$time','$image_name')");
        $Uploadinfo = "<center><div id='Uploadinfo'>The file has been uploaded. ✅✅</div></center><script>$('#Uploadinfo').fadeOut(1600);</script>";
    }elseif(!empty($ext)){
        $image_name = RandomStr() . "." . $ext;
        $target_file = $target_dir . $image_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (isset($_POST["submit"]) && isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['all_text']) && !empty($_POST['all_text'])) {
            $check = @getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                echo "";
                $uploadOk = 1;
            } else {
                echo "<script>alert('File is not an image.')</script>";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "<script>alert('Sorry, file already exists.')</script>";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 1999999) {
            echo "<script>alert('Sorry, your file is too large.')</script>";
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "<script>alert('Sorry, your file was not uploaded.')</script>";
        } else {
            if ($check_uploaded = @move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $Uploadinfo = "<center><div id='Uploadinfo'>The file has been uploaded. ✅✅</div></center><script>$('#Uploadinfo').fadeOut(1600);</script>";
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
            }
        }
        if (@$check_uploaded == 1) {
            $db->exec("INSERT INTO data (title, textarea,`time`,pic) VALUES ('$title','$all_text','$time','$image_name')");
        }
    }
}
?>
<!-- START HTML -->
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Yasser - NotePad</title>
    <!-- css links -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.5.1.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <br>
    <span id="NavbarBuuton" onclick="openNav()">&#9776; open</span>
    <!-- === Start Body === -->
    <?php if (isset($Uploadinfo)) {
        echo $Uploadinfo;
    } ?>
    <div class="container" style="z-index: 1;">
        <div class="row">
            <div class="col-lg-12">
                <br><br>
                <form method="post" enctype="multipart/form-data">
                    <input type="text" dir="rtl" name="title" id="" maxlength="30" class="form-control" placeholder="الاسم , عنوان الصفحة..." required>
                    <br>
                    <textarea dir="rtl" class="form-control" name="all_text"  id="get_text_from_textarea" cols="140" rows="20" placeholder="اكتب اي شي هنا ...." required></textarea>
                    <br>
                    <label class="btn btn-default btn-secondary">
                        <input name="fileToUpload" id="fileToUpload" type="file" hidden>تحميل صورة
                    </label>
                    <input class="btn btn-default btn-secondary" name="submit" type="submit" value="حفظ" style="margin-bottom: 0.66%;">
                </form>
            </div>
        </div>
    </div>
    <!-- ===  End Body === -->
    <!-- Js links -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/index.js"></script>
</body>
</html>