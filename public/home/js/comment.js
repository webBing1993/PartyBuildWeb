/**
 * Created by 郑竹兵 on 2017/9/25.
 */

$(function () {
    // left_tab
    $(".content_tab li").on("click", function () {
        $(this).addClass("red").siblings("li").removeClass("red");
        $(".content_text").removeClass("hidden").hide();
        $(".content_text").eq($(this).index()).show();
        var html = $(this).children("a").children('span')[1].innerHTML;
        $(".content_title a:last-of-type").html(html);
    });
    // 分页
    $("#page").paging({
        pageNo:4,
        totalPage: 10,
        totalSize: 300,
        callback: function(num) {

        }
    });
});

