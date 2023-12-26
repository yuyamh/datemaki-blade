// プロフィールアイコンの初期値
let initialSrc = $('#preview').attr('src');

// スマホ・タブレット版の場合はモーダルなし
$('#isNotDesktop').on('click', function () {
    let iconInput = $('#iconInput');
    iconInput.click();
});

$('#iconInput').on('change', function (e) {
    if (e.target.files.length > 0) {
        let iconUrl = URL.createObjectURL(e.target.files[0]);
        $('#preview').attr('src', iconUrl);
        $('#preview').trigger('change');
    };
});

// モーダルの表示トグル
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
        $('#preview').trigger('change');
    };
    // TODO:fileReaderの例外処理を記述する
    fileReader.readAsDataURL(e.target.files[0]);
});

//HTML自体にドラッグ＆ドロップしても遷移しないようにする
$(function () {
    $(document).on('dragover drop', function (e) {
        e.preventDefault();
        e.stopPropagation();

        // ドラッグ時のクラス追加
        $('label[for="uploader"]').addClass('border-orange-400 border-4');
    });
});

// プレビューが変わったら「元に戻す」ボタンを表示
$('#preview').on('change', function () {
    $('#cancelBtn').removeClass('hidden').addClass('inline-flex');
});

// 「元に戻す」ボタン押下でプレビュー・ボタンの消去
$('#cancelBtn').on('click', function () {
    $('#preview').attr('src', initialSrc);
    $('#cancelBtn').removeClass('inline-flex').addClass('hidden');
});
