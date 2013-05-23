 /* 
  * HOLDSCROLL CLASS DEFINITION
  * ====================== 
  */

(function($) {    
  $.fn.holdScroll = function(options) {     

    var setting = $.extend({}, $.fn.holdScroll.defaults, options);   

    return this.each(function() {  
      var $_this=$(this);
      var _autoPlay='';

      function autoPlayHandle(){
        clearTimeout(_autoPlay);
        var li = $_this.find(setting.children),
            len = li.length;
        var _t = li.eq(len-1).outerHeight();
        var $cl = li.eq(len-1).clone();
        
        $cl.css({opacity:0,filter:'alpha(opacity=0)'});
        $_this.prepend($cl);    
        $_this.css('top',-_t + 'px');
        
        if(!$_this.is(":animated")){
          $_this.animate({"top":0},600,function(){
            $_this.find(setting.children+":last").remove();
            
            $cl.animate({"opacity":1},600,function(){
              play();
            });
          });            
        }    
      }

      function play(){
        _autoPlay = setTimeout(autoPlayHandle,setting.playTime);
      }

      $_this.mouseover(function(){
        clearTimeout(_autoPlay);
      }).mouseleave(function(){
        play();
      });

      play();
        
    });
  };
    
 
  $.fn.holdScroll.defaults = {     
    children: 'li',
    playTime: 2000
  };     
  
})(jQuery);