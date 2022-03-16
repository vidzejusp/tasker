<script>
    tinymce.remove();
</script>

<div
    x-data="{ value: @entangle($attributes->wire('model')) }"
    x-init="
        tinymce.init({
            target: $refs.tinymce,
            selector: '#tinymce',
            themes: 'modern',
            height: 400,
            menubar: false,
            deprecation_warnings: false,
            content_style: 'img {max-width: 100%; height: auto;}',
            image_class_list: [
                {title: 'Responsive', value: 'object-contain'}
            ],
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount image paste'
            ],
            paste_data_images: true,
            toolbar: 'link image | undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            setup: function(editor) {
                editor.on('blur', function(e) {
                    value = editor.getContent()
                })

                editor.on('init', function (e) {
                    if (value != null) {
                        editor.setContent(value)
                    }
                })

                function putCursorToEnd() {
                    editor.selection.select(editor.getBody(), true);
                    editor.selection.collapse(false);
                }

                $watch('value', function (newValue) {
                    if (newValue !== editor.getContent()) {
                        editor.resetContent(newValue || '');
                        putCursorToEnd();
                    }
                });
            },

            image_title: true,
            automatic_uploads: true,
            images_upload_url: '/upload/tinymce',
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                };
                input.click();
            }
        })
    "
    wire:ignore
>
    <div>
        <textarea
            x-ref="tinymce"
            id="tinymce"
            {{ $attributes->whereDoesntStartWith('wire:model') }}
        ></textarea>
    </div>
</div>
