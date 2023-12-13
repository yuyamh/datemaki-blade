$("#export-users").on('click', function()
{
    let csrf = $('meta[name="csrf-token"]').attr("content");
    $.ajax({
        url: "/users/csv",
        type: "GET",
        cache: false,
        xhrFields: {
            responseType: 'blob',
        },
        beforeSend: function (xhr) {
            xhr.setRequestHeader('X-CSRF-TOKEN', csrf);
        },
    }).done(function(data){
        console.log(data);
        let blob = new Blob([data], {type: "text/csv" });
        let date = new Date().toLocaleDateString("ja-JP", {
            year: "numeric", month: "2-digit", day: "2-digit"
        }).replaceAll('/', '')

        // 擬似リンクの生成
        let link = $('<a>');
        let url = window.URL.createObjectURL(blob);
        link.attr('href', url);
        link.attr('download', `${date}_userList.csv`);
        link[0].click();
        window.URL.revokeObjectURL(url);
    });
});
