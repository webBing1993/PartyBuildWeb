/**
 * Created by 郑竹兵 on 2017/9/25.
 */

$(function () {
    // nav
    $(".nav-header li").bind("mouseover", function () {
        $(".nav-header li a").removeClass("active");
        $(this).children("a").addClass("active")
    });

    // left_tab
    $(".content_tab li").on("click", function () {
        $(this).addClass("red").siblings("li").removeClass("red");
        $(".content_text").removeClass("hidden").hide();
        $(".content_text").eq($(this).index()).show();
        var html = $(this).children("a").children('span')[0].innerHTML;
        $(".textTitle").html(html);
        $(".content_title a:last-of-type").html(html);
        if (html == "每日一课") {
            $(".page_div").hide();
        }else {
            $(".page_div").show();
        }
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

$(function () {
    // 日期
    function timer() {
        var data = new Date();
        var year = data.getFullYear();
        var month = data.getMonth() + 1;
        var date = data.getDate();
        var day = data.getDay();
        var time = data.getHours() + " : " + data.getMinutes() + " : " + data.getSeconds();
        var Week = ['日','一','二','三','四','五','六'];
        $(".timeNow").html("国家授时中心标准时间：" + year + "年" + month + "月" + date + "日 &nbsp;| &nbsp;" + time + " &nbsp; | &nbsp;星期" + Week[parseInt(day)]);
        $(".now_title .pull-left").html(year + "年" + month + "月" + date + "日");
    }
    timer();
    setInterval(timer,1000);
});

