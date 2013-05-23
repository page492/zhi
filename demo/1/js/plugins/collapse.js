 /* 
  * COLLAPSE CLASS DEFINITION
  * ========================= 
  */

!function ($) {

  var Collapse = function (element, options) {
    this.element = $(element);
    this.options = options;

    this.index = this.options.index || 0;
    this.multiple = this.options.multiple || false;
  }

  Collapse.prototype = {
    initialize: function(){
      var $el = this.element;
          $item = $el.find('.accordion').eq(this.index);
      this.show($item);
      
      this.trigger();
    },

    trigger: function(){
      var self = this,
          $el = this.element;

      $el.on('click', '.accordion-hd', function(e){
          e.preventDefault();

          var $item = $(this).parents('.accordion');

          if($item.hasClass('expand')){
              self.hide($item);
          }else{
              !self.multiple && self.reset();
              self.show($item);
          }
      });

    },

    hide: function(el){
      var $el = el;

      $el.removeClass('expand');
    },

    show: function(el){
      var $el = el;

      $el.addClass('expand');
    },

    reset: function () {
      var $el = this.element;
      $el.find('.accordion').removeClass('expand');
      return this;
    }
  }

  $.fn.collapse = function (option) {
    return this.each(function () {
      var setting = {
          index: 0,
          multiple: false
      }

      var options = $.extend(setting, option);
      var data = new Collapse(this, options)
      data.initialize();
    });
  }  


}(window.jQuery);