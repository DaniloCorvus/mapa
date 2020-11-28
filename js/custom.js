
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.delete-archivo', function () {
        var data_id = $(this).data("id");
        console.log(data_id);
        toastr.options.preventDuplicates = true;
        toastr.info("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-warning m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
            allowHtml: true,
            onclick: function (toast) {
                value = toast.target.value
                if (value == 'yes') {
                    $.ajax({
                        type: 'get',
                        url: SITEURL + "/file/eliminar/" + data_id,
                        success: function (data) {
                            location.reload()
                            // console.log(data);
        
                        },
                        error: function (errors) {
                            console.log(errors);
                        }
                    });
                }else{
                    toastr.remove()
                }
            }

        })

    });

});
