 /* 
  * DROUPDOWN CLASS DEFINITION
  * ========================= 
  */

!function ($) {

  var Dropdown = function (element, options) {
    this.element = $(element);
    this.options = options;

    this.anim = this.options.anim;
    this.active = this.options.active;
    this.$inner = this.element.find(this.options.inner);
  }

  Dropdown.prototype = {

    initialize: function(){
      var self = this,
          $el = this.element;
      
      $el.hover(function(){
          self.show($(this));
      },function(){
          self.hide($(this));
      });
    },

    hide: function(el){
      var $el = el;

      $el.removeClass(this.active);

      if(this.anim){
        this.$inner.slideUp();
      }
    },

    show: function(el){
      var $el = el;

      $el.addClass(this.active);

      if(this.anim){
        this.$inner.slideDown();
      }
    }
  }

  $.fn.dropdown = function (option) {
    return this.each(function () {
      var setting = {
          anim: false,
          active: 'open',
          inner: '.dropdown-inner'
      }

      var options = $.extend(setting, option);
      var data = new Dropdown(this, options)
      data.initialize();
    });
  }  


}(window.jQuery);