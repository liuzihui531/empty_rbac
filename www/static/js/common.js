$(function () {
    //底部微信显示
    $("#share-wechat").hover(function () {
        $(".share-wechat-hover-wrap").slideToggle("fast");
    });
    //手机端顶部下拉效果
//    $(document).on("click", ".nav-more", function () {
//        $(".phone-nav-more").slideToggle();
//    });
    $(".nav-more-click").bind("mousedown", function () {
        $(".phone-nav-more").slideToggle();
    });
    $(".to-location").bind("mousedown", function () {
        window.location.href = $(this).attr('data-url');
    });
//    $(document).on("mousedown", "a", function () {
//        var href = $(this).attr('href');
//        if (href && href.indexOf("javascript") == -1 && href.indexOf("#") == -1) {
//            window.location.href = href;
//            return false;
//        }
//    });
});