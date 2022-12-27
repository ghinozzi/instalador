$(document).ready(function () {
    $('.cpf').mask('000.000.000-00', {reverse: true});
    var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };

    $('.phone').mask(SPMaskBehavior, spOptions);
    $(document).on('click', '.form-delete', function () {
        Swal.fire({
            title: 'Tem certeza?',
            text: "Essa ação não pode ser desfeita!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#868e96',
            confirmButtonText: 'Apagar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: $(this).attr('href'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (result) {
                        if (result) {
                            $('#table-list').load(window.location.href + ' #table-list');
                            Swal.fire(
                                'Pronto!',
                                'Registro apagado com sucesso.',
                                'success'
                            )
                        }
                    }
                });
            }
        })
    });
});
const image_upload_handler_callback = (blobInfo, progress) => new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.withCredentials = false;
    xhr.open('POST', tinyuploadroute);
    xhr.upload.onprogress = (e) => {
        progress(e.loaded / e.total * 100);
    };
    xhr.onload = () => {
        if (xhr.status === 403) {
            reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
            return;
        }
        if (xhr.status < 200 || xhr.status >= 300) {
            reject('HTTP Error: ' + xhr.status);
            return;
        }
        const json = JSON.parse(xhr.responseText);
        if (!json || typeof json.location != 'string') {
            reject('Invalid JSON: ' + xhr.responseText);
            return;
        }
        resolve(json.location);
    };
    xhr.onerror = () => {
    reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
    };
    const formData = new FormData();
    formData.append('file', blobInfo.blob(), blobInfo.filename());
    xhr.send(formData);
});
tinymce.init({
    selector: '.htmleditor',
    plugins: 'image',
    promotion: false,
    toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | image',
    // without images_upload_url set, Upload tab won't show up
    images_upload_url: tinyuploadroute,
    // override default upload handler to simulate successful upload
    images_upload_handler: image_upload_handler_callback
});
