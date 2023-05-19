const alertMessage = ( message, type ) => {

    let Toast = Swal.mixin({

        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }

    });

    Toast.fire({
        icon  : type,
        title : message
    });

}

const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success elevation-2 ml-2',
        cancelButton: 'btn btn-danger elevation-2 mr-2'
    },
    buttonsStyling: false
})

const changeIcon = id => {

    if ( $('#headerIconCard' + id).hasClass('bx bx-expand-alt bx-border-circle') ) {

        $('#headerIconCard' + id).removeClass().addClass('bx bx-minus bx-border-circle font-weight-bold');

    } else {

        $('#headerIconCard' + id).removeClass().addClass('bx bx-expand-alt bx-border-circle font-weight-bold');

    }
}

window.initSelectCustomerSelect = () => {

    $('.select2').select2({
        placeholder: 'Selecciona una opción',
        width: '100%'
    });

    $('.select2bs4').select2({
        theme: 'bootstrap4',
        placeholder: 'Selecciona una opción',
        width: '100%'
    });

}

initSelectCustomerSelect();

const tinyEditor = ( url_upload_image, token ) => {

    tinymce.init({
        height : "440",
        selector: '.tiny-editor',
        language: "es_MX",
        plugins: [
            'image code',
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table paste"
        ],
        toolbar:
            "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol",
        forced_root_block: false,
        image_title: true,
        automatic_uploads: true,
        images_upload_url: url_upload_image,
        file_picker_types: 'image',
        images_upload_handler: function(blobInfo, success, failure) {

            let xhr, formData;

            xhr = new XMLHttpRequest();

            xhr.withCredentials = false;

            xhr.open('POST', url_upload_image);

            xhr.setRequestHeader("X-CSRF-Token", token);

            xhr.onload = function() {

                let json;

                if (xhr.status != 200) {

                    failure('HTTP Error: ' + xhr.status);

                    return;

                }

                json = JSON.parse(xhr.responseText);

                console.log("response is ", json)

                if (!json || typeof json.location != 'string') {

                    failure('Invalid JSON: ' + xhr.responseText);

                    return;

                }

                success(json.location);

            };

            formData = new FormData();

            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        },
        paste_data_images: true,
        images_dataimg_filter: function(img) {
            return img.hasAttribute('src') && /^data:image/.test(img.getAttribute('src'));
        },
    });

}

const convertToSlug = ( stringText ) => {
    return stringText.toLowerCase()
        .replace(/ /g, '-')
        .replace(/[^\w-]+/g, '');
}

const generateSlug = ( inputName, inputTarget ) => {

    let stringText = $('#' + inputName).val();

    let slugText   = convertToSlug( stringText );

    $('#' + inputTarget).val( slugText );

}

const uploadImage = () => {

    let btnClass         = $('.btn-file');

    let btnFile          = $('.btn-file :file');

    let inputUploadImage = '';

    btnFile.on('change', function () {

        let input        = $(this);

        inputUploadImage = input.attr('id');

        let countFiles   = input.get(0).files ? input.get(0).files.length : 1;

        let label        = input.val().replace(/\\/g,'/').replace(/.*\//,'');

        input.trigger('fileselect',[ countFiles, label ]);

    });

    btnFile.on('fileselect',function(event,numFiles,label){

        let input = $(this).parents('.input-group').find(':text');

        let log   = numFiles > 1 ? numFiles + ' files selected' : label;

        if (input.length) {

            input.val(log);

        } else {

            if (log) console.log(log);

        }

        let form         = new FormData();

        let files        = $('#' + inputUploadImage)[0].files[0];

        let action       = $(btnClass).data('action');

        let inputUrl     = $(btnClass).data('input-url');

        let previewImage = $(btnClass).data('preview-image');

        $('.' + action).addClass('bx bx-fw bx-cloud-upload bx-flashing');

        form.append('file',files);

        $.ajax({
            url         : url_upload_image,
            method      : 'post',
            headers     : { 'X-CSRF-TOKEN': token },
            data        : form,
            contentType : false,
            processData : false,
            success: function(response){

                $('#' + inputUrl).val(response.location);

                $('.' + action).removeClass('bx-flashing');

                $('#' + previewImage).fadeOut('slow', function() {

                    $(this).attr('src', response.location).fadeIn('slow');

                });

            }
        });

    });

}

const uploadImageOne = () => {

    let btnClass         = $('.btnFileOne');

    let btnFile          = $('.btnFileOne :file');

    let inputUploadImage = '';

    btnFile.on('change', function () {

        let input        = $(this);

        inputUploadImage = input.attr('id');

        let countFiles   = input.get(0).files ? input.get(0).files.length : 1;

        let label        = input.val().replace(/\\/g,'/').replace(/.*\//,'');

        input.trigger('fileselect',[ countFiles, label ]);

    });

    btnFile.on('fileselect',function(event,numFiles,label){

        let input = $(this).parents('.input-group').find(':text');

        let log   = numFiles > 1 ? numFiles + ' files selected' : label;

        if (input.length) {

            input.val(log);

        } else {

            if (log) console.log(log);

        }

        let form         = new FormData();

        let files        = $('#' + inputUploadImage)[0].files[0];

        let action       = $(btnClass).data('action');

        let inputUrl     = $(btnClass).data('input-url');

        let previewImage = $(btnClass).data('preview-image');

        $('.' + action).addClass('bx bx-fw bx-cloud-upload bx-flashing');

        form.append('file',files);

        $.ajax({
            url         : url_upload_image,
            method      : 'post',
            headers     : { 'X-CSRF-TOKEN': token },
            data        : form,
            contentType : false,
            processData : false,
            success: function(response){

                $('#' + inputUrl).val(response.location);

                $('#' + previewImage).attr('src', response.location);

                $('.' + action).removeClass('bx-flashing');

            }
        });

    });

}

const uploadImageTwo = () => {

    let btnClass         = $('.btnFileTwo');

    let btnFile          = $('.btnFileTwo :file');

    let inputUploadImage = '';

    btnFile.on('change', function () {

        let input        = $(this);

        inputUploadImage = input.attr('id');

        let countFiles   = input.get(0).files ? input.get(0).files.length : 1;

        let label        = input.val().replace(/\\/g,'/').replace(/.*\//,'');

        input.trigger('fileselect',[ countFiles, label ]);

    });

    btnFile.on('fileselect',function(event,numFiles,label){

        let input = $(this).parents('.input-group').find(':text');

        let log   = numFiles > 1 ? numFiles + ' files selected' : label;

        if (input.length) {

            input.val(log);

        } else {

            if (log) console.log(log);

        }

        let form         = new FormData();

        let files        = $('#' + inputUploadImage)[0].files[0];

        let action       = $(btnClass).data('action');

        let inputUrl     = $(btnClass).data('input-url');

        let previewImage = $(btnClass).data('preview-image');

        $('.' + action).addClass('bx bx-fw bx-cloud-upload bx-flashing');

        form.append('file',files);

        $.ajax({
            url         : url_upload_image,
            method      : 'post',
            headers     : { 'X-CSRF-TOKEN': token },
            data        : form,
            contentType : false,
            processData : false,
            success: function(response){

                $('#' + inputUrl).val(response.location);

                $('#' + previewImage).attr('src', response.location);

                $('.' + action).removeClass('bx-flashing');

            }
        });

    });

}

const uploadImageThree = () => {

    let btnClass         = $('.btnFileThree');

    let btnFile          = $('.btnFileThree :file');

    let inputUploadImage = '';

    btnFile.on('change', function () {

        let input        = $(this);

        inputUploadImage = input.attr('id');

        let countFiles   = input.get(0).files ? input.get(0).files.length : 1;

        let label        = input.val().replace(/\\/g,'/').replace(/.*\//,'');

        input.trigger('fileselect',[ countFiles, label ]);

    });

    btnFile.on('fileselect',function(event,numFiles,label){

        let input = $(this).parents('.input-group').find(':text');

        let log   = numFiles > 1 ? numFiles + ' files selected' : label;

        if (input.length) {

            input.val(log);

        } else {

            if (log) console.log(log);

        }

        let form         = new FormData();

        let files        = $('#' + inputUploadImage)[0].files[0];

        let action       = $(btnClass).data('action');

        let inputUrl     = $(btnClass).data('input-url');

        let previewImage = $(btnClass).data('preview-image');

        $('.' + action).addClass('bx bx-fw bx-cloud-upload bx-flashing');

        form.append('file',files);

        $.ajax({
            url         : url_upload_image,
            method      : 'post',
            headers     : { 'X-CSRF-TOKEN': token },
            data        : form,
            contentType : false,
            processData : false,
            success: function(response){

                $('#' + inputUrl).val(response.location);

                $('#' + previewImage).attr('src', response.location);

                $('.' + action).removeClass('bx-flashing');

            }
        });

    });

}

$('.datetime-input').datetimepicker({

    icons: { time: 'far fa-clock' }

});

$(function () {
    bsCustomFileInput.init();
});

$('.custom-upload-file').change(function(){

    let file_size = this.files[0].size;

    if (file_size > 20000000) {

        let size_file = $(this).data('size');

        $('.custom-message-file').text("El archivo no debe ser mayor que " + size_file + " kilobytes.");

        $(this).val('').addClass('is-invalid');

    } else {

        $('.custom-message-file').text("");

        $(this).removeClass('is-invalid');

    }

});
