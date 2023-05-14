<div
    x-data=""
    x-init="
    tinymce.init({
        target: $refs.tinymce,
        menubar: false,
        plugins: 'autoresize image',
        menubar: 'insert',
        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | image | help',
        images_upload_url : '/upload',
        automatic_uploads : true,
        image_title: true,
        relative_urls : true,
        file_picker_callback: function(callback, value, meta) {
            let fileInput = document.createElement('input');
            fileInput.setAttribute('type', 'file');
            fileInput.setAttribute('accept', 'image/*');
            fileInput.onchange = function() {
                var file = this.files[0];

                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function () {
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    callback(blobInfo.blobUri(), { title: file.name });
                };
            };
            input.click();
        }
    })
"
>
    <div>
        <x-label :label="'Post content'" :for="'body'"></x-label>
        <input
            id="body"
            x-ref="tinymce"
            type="textarea"
            {{ $attributes }}
        >
    </div>
</div>
