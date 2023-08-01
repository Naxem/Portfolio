$(document).ready(function() {
    $('#fetchval').on('change', function() {
        var value = $(this).val();
        //alert(value);
        $.ajax({
            url: 'Admin/filter.php',
            type: 'POST',
            data: 'request=' + value,
            beforeSend:function() {
                $(".grille").html("<span> Working... </span>");
            },
            success: function(data) {
                $(".grille").html(data);
            }
        });
    });
});