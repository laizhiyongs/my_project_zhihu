$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


var editor = new wangEditor('content');
if (editor.config) {
    editor.config.uploadImgUrl = '/posts/image/upload';

// 设置 headers（举例）
    editor.config.uploadHeaders = {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    };

    editor.create();

}

$('.like-button').click(function () {
    var _this = $(this);
    var current_like = _this.attr("like-value");
    var user_id = _this.attr('like-user');
    console.log(current_like)
    if (current_like == 1) {
        //取消关注
        $.ajax({
            url: "/user/" + user_id + "/unfan",
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.status != 1) {
                    alert(data.message);
                    return;
                }
                _this.attr('like-value', 0);
                _this.text('关注');

            }

        }, 'JSON');
    } else {
        $.ajax({
            url: "/user/" + user_id + "/fan",
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.status != 1) {
                    alert(data.message);
                    return;
                }
                _this.attr('like-value', 1);
                _this.text('取消关注');

            }

        }, 'JSON');
    }


});

