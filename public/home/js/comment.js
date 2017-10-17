/**
 * Created by 郑竹兵 on 2017/9/25.
 */

$(function () {

    // 监听滚轮事件
    $(window).off("scroll" ).on("scroll",function (e) {
        var scrollTop = $(this).scrollTop();
        if (scrollTop >= 106) {
            $(".nav").css({
                position: "fixed",
                top: 0,
                left: 0,
                zIndex: 100,
                width: "100%",
                marginTop: 0
            });
            $(".top").show();
            $(".erweima").css({
                top: scrollTop
            });
        }else {
            $(".nav").css({
                position: "relative",
                marginTop: "4px"
            });
            $(".erweima").css({
                top: "10%"
            });
            $(".top").hide();
        }
    });

    // nav
    $(".nav-header li").bind("mouseover", function () {
        $(".nav-header li a").removeClass("active");
        $(this).children("a").addClass("active")
    }).bind("click", function () {
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
        if (html == "红色音乐") {
            $(".content_text").eq($(this).index()).css("borderBottom",0);
            $(".page_div").hide();
            $(".textTitle").css("marginBottom",0);
        }else {
            $(".page_div").show();
        }
        pag($(this).index());
    });

    // 分页
    pag(0);
    function pag(b) {
        var len = $(".content_text").eq(b).find("li").length;
        // 向上取整
        var page = Math.ceil(len / 12);
        $("#page").paging({
            pageNo:1,
            totalPage: page,
            totalSize: 300,
            callback: function(num) {
                console.log(num);
                $.ajax({
                    type: "post",
                    //url: ,
                    date: {
                        type: num
                    },
                    success: function (date) {

                    }
                })
            }
        });
    }
    
});

$(function () {
    // 日期
    function timer() {
        var data = new Date();
        var year = data.getFullYear();
        var month = data.getMonth() + 1;
        if (month < 10) {
            month = "0" + month;
        }
        var date = data.getDate();
        var day = data.getDay();
        if (day < 10) {
            day = "0" + day;
        }
        var hour = data.getHours();
        var minutes = data.getMinutes();
        var seconds = data.getSeconds();
        if (hour < 10) {
            hour = "0" + hour;
        }
        if (minutes < 10) {
            minutes = "0" + minutes;
        }
        if (seconds < 10) {
            seconds = "0" + seconds;
        }
        var time = hour + " : " + minutes + " : " + seconds;
        var Week = ['日','一','二','三','四','五','六'];
        $(".timeNow").html("国家授时中心标准时间：" + year + "年" + month + "月" + date + "日 &nbsp;| &nbsp;" + time + " &nbsp; | &nbsp;星期" + Week[parseInt(day)]);
        $(".now_title .pull-left").html(year + "年" + month + "月" + date + "日");
    }
    timer();
    setInterval(timer,1000);
});

