$("#advanced").click(function(){
    $(this).prev().toggle();
    if ($(this).prev().is(':hidden')) {
        $(this).text('显示高级设置');
    } else{
        $(this).text('隐藏高级设置');
    };
});