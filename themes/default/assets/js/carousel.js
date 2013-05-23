 /* 
  * CAROUSEL CLASS DEFINITION
  * ========================= 
  */

!function ($) {

  var Carousel = function (element, options) {
    this.$element = $(element);
    this.options = options;

    this.Width = this.$element.width();
    this.index = this.options.index || 0;
    this.timer = 0;

    this.$indicators = this.$element.find('.carousel-indicators');
    this.$inner = this.$element.find('.carousel-inner');
  }

  Carousel.prototype = {
    initialize: function(){
      this.setSize();
      this.control();
      this.trigger();

      var self = this;
      $(window).resize(function(){
          self.setSize();
      });
    },

    setSize: function(){
      var len = this.getLen();

      this.Width = this.$element.width();
      
      this.$inner.css('width', this.Width*len);
      this.$inner.find('li, img').css('width', this.Width);
    },

    control: function(){
      var self = this,
          len = self.getLen();
      if(!self.$element.find('.carousel-control').length) return false;

      self.$element.on('click', '.prev',function(e){
          e.preventDefault();
          self.index -= 1;
          if(self.index == -1) {self.index = len - 1;}
          self.to(self.index);
      });

      self.$element.on('click', '.next',function(e){
          e.preventDefault();
          self.index += 1;
          if(self.index == len) {self.index = 0;}
          self.to(self.index);
      });
    },

    trigger: function(){
      var self = this,
          $el = self.$indicators.find('span');

      $el.mouseenter(function() {
          self.index = $el.index(this);
          self.to(self.index);
      }).eq(this.index).trigger("mouseenter");

      this.$element.hover(function() {
          self.pause();
      },function() {
          self.play();
      }).trigger("mouseleave");
    },

    getLen: function(){
      var $item = this.$inner.find('li');
      return $item.length;
    },

    to: function (pos) {
      var nowLeft = -pos*this.Width;
      this.$inner.stop(true,false).animate({'left': nowLeft},300);

      var $dot = this.$indicators.find('span');
      $dot.stop(true,false).removeClass('active');
      $dot.eq(pos).stop(true,false).addClass('active');
    },

    play: function(){
      var self = this,
          len = self.getLen();

      this.timer = setInterval(function() {
          self.to(self.index);
          self.index++;
          if(self.index == len) {
              self.index = 0;
          }
      },self.options.interval);
    },

    pause: function(){
        clearInterval(this.timer);
    }      
  }

  $.fn.carousel = function (option) {
    return this.each(function () {
      var setting = {
          index: 0,
          interval: 4000
      }

      var options = $.extend(setting, option);
      var data = new Carousel(this, options)
      data.initialize();
    });
  }

}(window.jQuery);
