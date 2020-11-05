<?php 

require_once('config.php');
// include_once('get_id.php');
$_SESSION['db'] = $db;

//  Get Last Item [Id]
$get_lastitem = $_SESSION['db']->query("SELECT max(id) id FROM data");$get_lastitem = $get_lastitem->fetchArray(SQLITE3_ASSOC);
$_SESSION['lastid'] = $lastid = $get_lastitem['id'];


// select func
function select($select_colmun,$table,$where,$c_n){
    $results = $_SESSION['db']->query("SELECT $select_colmun FROM '$table' WHERE $where = $c_n"); while($row = $results->fetchArray(SQLITE3_ASSOC) ) {
        echo $row[$select_colmun];
    }
}


// select last item
function selectlast($select_colmun,$table,$where){
    $id = $_SESSION['lastid'];
    $results = $_SESSION['db']->query("SELECT $select_colmun FROM '$table' WHERE $where = $id"); while($row = $results->fetchArray(SQLITE3_ASSOC) ) {
        echo $row[$select_colmun];
    }
}

//  Get Res Item [json]
if(isset($_POST['item'])){
    @$id_post_method_from_index = $_POST['item'];
    $results = $_SESSION['db']->query("SELECT * FROM 'data' WHERE id = $id_post_method_from_index"); while($row = $results->fetchArray(SQLITE3_ASSOC) ) {
        $F_Data = array(
            "id" => $row['id'],
            "title" => $row['title'],
            "textarea" => $row['textarea'],
            "pic" => $row['pic'],
            "time" => $row['time']
        );
    }

    echo json_encode($F_Data);
}



// remove item 
if(isset($_POST['remove_item'])){
    $id_rm = htmlspecialchars($_POST['remove_item'], ENT_QUOTES);
    $db->exec("DELETE FROM data WHERE id = $id_rm;");
}


// edited item from index page 

if(isset($_POST['title']) && isset($_POST['alldata'])){
    $e_id  = htmlspecialchars($_POST['id'], ENT_QUOTES);
    $e_title = htmlspecialchars($_POST['title'], ENT_QUOTES);
    $e_data  = htmlspecialchars($_POST['alldata'], ENT_QUOTES);
    $db->exec("UPDATE data SET title = '$e_title', textarea = '$e_data' WHERE id =$e_id;");
}