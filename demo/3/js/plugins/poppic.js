 /* 
  * POPPIC CLASS DEFINITION
  * ========================= 
  */


!function ($) {

  var PopPic = function (element, options) {
    this.$element = $(element);
    this.options = options;
    this.timer = null;

    this.$pop = this.$element.find('.pic-pop');
  }

  PopPic.prototype = {
    initialize: function(){
      var self = this;
          $el = this.$element;

      $el.on('mouseenter', '.pic-list img', function(){
          self.fill($(this));
          self.show();
      });

      $el.on('mouseleave', '.pic-pop',function(){
          self.hide();
      });
    },

    fill: function(el){
      this.clear();
      this.$pop.empty();
      el.parent('a').clone().appendTo(this.$pop);
    },

    show: function(){
      var self = this;

      this.timer = setTimeout(function(){
          self.$pop.fadeIn();
          self.$pop.css("z-index",self.options.zIndex);
      }, self.options.delay);

    },

    hide: function(){
      this.clear();
      this.$pop.fadeOut();
    },

    clear: function(){
      clearTimeout(this.timer);
    }
  }

  $.fn.popPic = function (option) {
    return this.each(function () {
      var setting = {
          delay: 500,
          zIndex: 10
      }

      var options = $.extend(setting, option);
      var data = new PopPic(this, options)
      data.initialize();
    });
  }

}(window.jQuery);
