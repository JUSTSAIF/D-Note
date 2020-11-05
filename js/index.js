window.onload = function () {
    var modal = document.getElementById('myModal');
    var img = document.getElementById('myImg');
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }
    // var span = document.getElementsByClassName("close")[0];
    // span.onclick = function () {
    //     modal.style.display = "none";
    // }

    $('.close').click(function(){
        modal.style.display = "none";
    });
};


function getidItem(GG) {
    var id = $(GG).data("id");
    $.post("Api.php", {
        item: id,
    },
        function (data) {
            var js_data = JSON.parse(data);
            $('#form-title-page').text(js_data['title']);
            $('#AllData').text(js_data['textarea']);
            $('#myImg').attr("src", "DATA/pic/" + js_data['pic']);
            $('#delete_item').val(js_data['id']);
            $('#edit_item').val(js_data['id']);
        });

};

function Remove_Item() {
    var id_rm = $('#delete_item').val();
    console.log(id_rm)
    $.post("Api.php", {
        remove_item: id_rm,
    },
        function () {
            location.reload(true);
        });
}

// edit from index page
$(document).ready(function () {
    $("#edit_item").click(function () {
        $('#AllData').removeAttr('disabled');
        $('#form-title-page').text("");
        $('#form-title-page').html("<input maxlength='30' class='form-control' dir='rtl' placeholder='الاسم , عنوان الصفحة...' type='text' id='edited_title'>");
        $('#edit_item_save').show();
        $('#edit_item').slideToggle();
    });

//  save edit from index page
$("#edit_item_save").click(function () {
    var edit_title = $('#edited_title').val()
    var edit_data = $('#AllData').val()
    var id = $('#edit_item').val()

    $.post('Api.php', {
        id: id,
        title: edit_title,
        alldata: edit_data
    }, function () {
        $('#edited_title').val(edit_title)
        $('#AllData').text(edit_data)
        $('#AllData').before("<center><div style='margin-bottom:30px' id='Uploadinfo'>The File Has Been Edited. ✅✅</div></center><script>$('#Uploadinfo').fadeOut(2000);</script>");
        $("#edit_item_save").hide('slow')
        $("#edit_item").show('slow',function(){
            $('#Uploadinfo').remove();
        })
    });
});
});
