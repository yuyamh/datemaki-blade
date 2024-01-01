$(function () {
    // ドロップゾーンに入ったときCSSの指定を追加
    $('#form-dropzone').on('dragenter dragover', function () {
        $(this).addClass('bg-gray-50 border-orange-400 border-4');
    });

    // ドロップゾーンから離れたときに追加したCSS指定を削除
    $('#form-dropzone').on('dragleave', function () {
        $(this).removeClass('bg-gray-50 border-orange-400 border-4');
    });

    // ドロップされたファイルを取得する
    $('#form-dropzone').on('drop', function (e) {
        $('#form-upload-input')[0].files = e.originalEvent.dataTransfer.files;
        // changeイベントの発火
        $('#form-upload-input').trigger('change');
    });

    // ファイルが選択されたら、ファイル名を表示する
    $('#form-upload-input').on('change', function () {
        let fileName = $(this)[0].files[0].name;
        let fileType = $(this)[0].files[0].type;

        // ファイルタイプからファイルアイコンを判別する
        let fileIcon = '';
        if (fileType === 'image/png' || fileType === 'image/jpeg') {
            fileIcon = '<i class="mr-1 text-gray-900 fa-regular fa-file-image"></i>';
        } else if (fileType === 'application/zip') {
            fileIcon = '<i class="mr-1 text-gray-900 fa-regular fa-file-zipper"></i>';
        } else if (fileType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
            fileIcon = '<i class="mr-1 text-gray-900 fa-regular fa-file-word"></i>';
        } else if (fileType === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            fileIcon = '<i class="mr-1 text-gray-900 fa-regular fa-file-excel"></i>';
        } else if (fileType === 'application/pdf') {
            fileIcon = '<i class="mr-1 text-gray-900 fa-regular fa-file-pdf"></i>';
        } else {
            fileIcon = '<i class="mr-1 text-gray-800 fa-solid fa-file-circle-question"></i>';
        }

        let fileName_html = `
                ${fileIcon}${fileName}<i class="ml-1 text-gray-900 hover:text-gray-300 fa-solid fa-xmark" id="upload-close-btn"></i>
            `;
        $('#dropped-filename').html(fileName_html);
    });

    // ファイル名横の「ｘ」ボタン押下で、ドラッグ&ドロップしたファイル消去
    $('#dropped-filename').on('click', '#upload-close-btn', function () {
        // ファイル名の非表示
        $('#dropped-filename').empty();
        // ファイルをInputから削除
        $('#form-upload-input').val('');
    });

    // デフォルトの挙動をキャンセルする
    $(document).on('dragover drop', function (e) {
        e.preventDefault();
        e.stopPropagation();
    });
});
