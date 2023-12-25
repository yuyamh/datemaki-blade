$('#isNotDesktop').on('click', function () {
    let iconInput = $('#iconInput');
    iconInput.click();
});

$('#iconInput').on('change', function (e) {
    if (e.target.files.length > 0) {
        let iconUrl = URL.createObjectURL(e.target.files[0]);
        $('#preview').attr('src', iconUrl);
    };
});

$('#isDesktop').on('click', function () {
    if ($('#modal').hasClass('hidden')) {
        $('#modal').removeClass('hidden');
    }
});

// ドラッグ&ドロップ
$(document).on('drop', '#dropzone', function (e) {
    $(this).find('#uploader')[0].files = e.originalEvent.dataTransfer.files;
    $(this).find('#uploader').trigger('change');
});

// モーダルから呼び出し元へデータの受け渡し
$(document).on('change', '#uploader', function (e) {
    let fileReader = new FileReader();
    fileReader.onload = function () {
        $('#iconInput').prop('files', e.target.files);
        $('#preview').attr('src', fileReader.result);
        $('#modal').addClass('hidden');
    };

    fileReader.readAsDataURL(e.target.files[0]);
});

$(function () {
    $(document).on('dragover drop', function (e) {
        //HTML自体にドラッグ＆ドロップしても遷移しないようにする
        e.preventDefault();
        e.stopPropagation();

        // ドラッグ時のクラス追加
        $('label[for="uploader"]').addClass('border-orange-400 border-4');
    });
});
