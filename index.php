<?php require_once('nav.html');
require_once('config.php');
require_once('Api.php'); 
?>
<!-- HTML START -->
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> D - NotePad </title>
    <!-- css links -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="css\fonts\ar\ar-font.css">
    <script src="js/index.js"></script>
</head>
<body>
    <!-- Navbar -->
    <br>
    <span id="NavbarBuuton" onclick="openNav()">&#9776; open</span>
    <!-- === Start Body === -->
    <div class="container-fluid">
        <div class="row">
            <!-- pic Form -->
            <div class="col-lg-2">
                <img src="DATA/pic/<?php echo selectlast("pic","data","id"); ?>" class="img-responsive rounded" id="myImg" width="300px" height="300px">
                <br><br>
                <button class="btn btn-danger" data-toggle="modal" data-target="#RemoveI"> Remove</button>
                <button class="btn btn-primary" id="edit_item" value="<?php echo selectlast("id","data","id");?>"> Edit</button>
                <button style="display: none" class="btn btn-success" id="edit_item_save"> Save Changes</button>
            </div>
                <!-- Delete Item Form -->
                <div class="modal" id="RemoveI" style="z-index: 9999999999">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Remove Item</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    Are you sure you want to delete this item?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="Remove_Item();" id="delete_item" value="<?php echo selectlast("id","data","id");?>" data-dismiss="modal">Remove</button>
                    </div>
                </div>
                </div>
            </div>
            <!-- End Delete Item Form -->
            <!-- Tilte ,info... -->
            <div class="col-lg-6">
                <h3 id="form-title-page"><?php echo selectlast("title","data","id"); ?></h3>
                <hr id="hr-index" color="red">
                <textarea dir="rtl" id="AllData" disabled><?php echo selectlast("textarea","data","id"); ?></textarea>
            </div>
            <!-- Browse Data -->
            <div class="col-lg-4">
                <div id="res-loop-allTitles">
                    <?php $results = $db->query("SELECT title,id FROM 'data'");
                    while ($row = $results->fetchArray(SQLITE3_ASSOC)) { ?>
                        <div class="btn btn-primary card card-block" id="Item" onclick="getidItem(this);" data-id="<?php echo $row['id'] ?>"><?php echo $row['title'] ?></div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- ===  End Body === -->
    <!-- Image Modal -->
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>
    <!-- Js links -->
    <script src="js/bootstrap.min.js"></script>
    <!-- <script src="js/index.js"></script> -->
</body>
</html>
