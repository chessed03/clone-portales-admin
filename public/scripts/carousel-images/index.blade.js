const uploadImage = ( url_upload_image, token ) => {

    let btnClass = $('.btn-file');

    let btnFile  = $('.btn-file :file');

    btnFile.on('change', function () {

        let input      = $(this);

        let countFiles = input.get(0).files ? input.get(0).files.length : 1;

        let label      = input.val().replace(/\\/g,'/').replace(/.*\//,'');

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

        let files        = $('#upload_image')[0].files[0];

        let action       = $(btnClass).data('action');

        let inputUrl     = $(btnClass).data('input-url');

        let previewImage = $(btnClass).data('preview-image');

        $('.' + action).addClass('bx bx-fw bx-cloud-upload bx-flashing');
        console.log(inputUrl)
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
