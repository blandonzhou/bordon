/**
 * Created with JetBrains WebStorm.
 * User: wangjw
 * Date: 13-10-08
 * Time: 下午4:55
 * To change this template use File | Settings | File Templates.
 */

$.fn.extend({
    fadeSlider: function (options){
        options=options||{};
        options.ev=options.ev||'click';
        options.auto=options.auto||false;

        var aBtn=this.find('ol li');
        var aLi=this.find('ul li');

        var now=0;


        aBtn.bind(options.ev, function()
        {
            now=$(this).index();
            tab();
        });

        function tab()
        {
            aBtn.removeClass('checked');
            aLi.stop().animate({opacity:0});
            aLi.css('zIndex', '1')

            aBtn.eq(now).addClass('checked');
            aLi.eq(now).stop().animate({opacity:1});
            aLi.eq(now).css('zIndex', '2')
        };

        if(options.auto)
        {
            function fnMove()
            {
                now++;
                if(now==aBtn.length)
                {
                    now=0;
                };
                tab();
            };

            timer=setInterval(fnMove, 5000);

            for(var i=0;i<aLi.length;i++)
            {
                aLi[i].onmouseover=function()
                {
                    clearInterval(timer)
                };
                aLi[i].onmouseout=function()
                {
                    timer=setInterval(fnMove, 5000);
                };
            };
        };
    }
});