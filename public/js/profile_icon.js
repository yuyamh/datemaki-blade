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
