function validate(formData, jqForm, options) {
    var form = jqForm[0];
    if (!form.link.value || !form.title.value) {
        toastr.error('los campos marcados (*) son obligatorios')
        return false;
    }
}

(function () {

    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');

    $('#formVideoCreate').ajaxForm({
        beforeSubmit: validate,

        beforeSend: function () {
        },

        success: function (data) {

            toastr.info('Enviando archivos a servidor!')
        },

        error: function (errors) {
            toastr.error('Los datos enviados no son validos!', errors)
        },

        complete: function () {
            location.reload();
        },

    });

})();
