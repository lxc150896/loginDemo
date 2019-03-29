$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function editUser(button) {
    var id = $(button).attr('value');
    var valueName = $('#user-name' + id).val();
    var valueEmail = $('#user-email' + id).val();
    if (valueName == '') {
        $('#user-name' + id).addClass('border-danger');
    } else if (valueEmail == '') {
        $('#user-email' + id).addClass('border-danger');
    } else {
        $('user-namer' + id).removeClass('border-danger');
        $('user-email' + id).removeClass('border-danger');
        var form = $('#editUser' + id)[0];
        var formData = new FormData(form);
        $.ajax({
            url: '/admin/home/edit/' + id,
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                $('#name-ajax' + id).html(res.name);
                $('#email-ajax' + id).html(res.email);
                $('#myModal' + id).modal('toggle');
            }
        })
    }
}

function deleteUser(button) {
    var id = $(button).attr('value');
    $.ajax({
        url: '/admin/home/delete/' + id,
        method: 'POST',
        success: function(res) {
            console.log($('#user-' + id));
            $('#user-' + id).remove();
        }
    })
}
