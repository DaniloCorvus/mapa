function validate(formData, jqForm, options) {
    var form = jqForm[0];
    if (!form.pdf.value || !form.title.value) {
        toastr.error('los campos marcados (*) son obligatorios')
        return false;
    }
}

(function () {

    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');

    $('#formArchivo').ajaxForm({
        beforeSubmit: validate,

        // async : false,

        beforeSend: function () {
            status.empty();
            var percentVal = '0%';
            var posterValue = $('input[name=pdf]').fieldValue();
            bar.width(percentVal)
            percent.html(percentVal);
        },

        uploadProgress: function (event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);
        },

        success: function (data, status) {
            var percentVal = 'Wait, Saving';
            bar.width(percentVal)
            percent.html(percentVal);
            toastr.info(status, data);
            // console.log(status, data);
            location.reload();
        },

        error: function (data, status) {
            // console.log(data);
            Object.keys(data.responseJSON['errors']).forEach(key =>
                toastr.error(status, data.responseJSON['errors'][key][0])
            )
        },

        complete: function () {}

    });

})();
