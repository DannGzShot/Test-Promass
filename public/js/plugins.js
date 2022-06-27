// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.

/*!
 * scrollup v2.4.1
 * Url: http://markgoodyear.com/labs/scrollup/
 * Copyright (c) Mark Goodyear — @markgdyr — http://markgoodyear.com
 * License: MIT
 */
!function(l,o,e){"use strict";l.fn.scrollUp=function(o){l.data(e.body,"scrollUp")||(l.data(e.body,"scrollUp",!0),l.fn.scrollUp.init(o))},l.fn.scrollUp.init=function(r){var s,t,c,i,n,a,d,p=l.fn.scrollUp.settings=l.extend({},l.fn.scrollUp.defaults,r),f=!1;switch(d=p.scrollTrigger?l(p.scrollTrigger):l("<a/>",{id:p.scrollName,href:"#top"}),p.scrollTitle&&d.attr("title",p.scrollTitle),d.appendTo("body"),p.scrollImg||p.scrollTrigger||d.html(p.scrollText),d.css({display:"none",position:"fixed",zIndex:p.zIndex}),p.activeOverlay&&l("<div/>",{id:p.scrollName+"-active"}).css({position:"absolute",top:p.scrollDistance+"px",width:"100%",borderTop:"1px dotted"+p.activeOverlay,zIndex:p.zIndex}).appendTo("body"),p.animation){case"fade":s="fadeIn",t="fadeOut",c=p.animationSpeed;break;case"slide":s="slideDown",t="slideUp",c=p.animationSpeed;break;default:s="show",t="hide",c=0}i="top"===p.scrollFrom?p.scrollDistance:l(e).height()-l(o).height()-p.scrollDistance,n=l(o).scroll(function(){l(o).scrollTop()>i?f||(d[s](c),f=!0):f&&(d[t](c),f=!1)}),p.scrollTarget?"number"==typeof p.scrollTarget?a=p.scrollTarget:"string"==typeof p.scrollTarget&&(a=Math.floor(l(p.scrollTarget).offset().top)):a=0,d.click(function(o){o.preventDefault(),l("html, body").animate({scrollTop:a},p.scrollSpeed,p.easingType)})},l.fn.scrollUp.defaults={scrollName:"scrollUp",scrollDistance:300,scrollFrom:"top",scrollSpeed:300,easingType:"linear",animation:"fade",animationSpeed:200,scrollTrigger:!1,scrollTarget:!1,scrollText:"Scroll to top",scrollTitle:!1,scrollImg:!1,activeOverlay:!1,zIndex:2147483647},l.fn.scrollUp.destroy=function(r){l.removeData(e.body,"scrollUp"),l("#"+l.fn.scrollUp.settings.scrollName).remove(),l("#"+l.fn.scrollUp.settings.scrollName+"-active").remove(),l.fn.jquery.split(".")[1]>=7?l(o).off("scroll",r):l(o).unbind("scroll",r)},l.scrollUp=l.fn.scrollUp}(jQuery,window,document);


/*
 *  Vide - v0.3.5
 *  Easy as hell jQuery plugin for video backgrounds.
 *  http://vodkabears.github.io/vide/
 *
 *  Made by Ilya Makarov
 *  Under MIT License
 */
!(function(root, factory) {
    if (typeof define === 'function' && define.amd) {
      define(['jquery'], factory);
    } else if (typeof exports === 'object') {
      factory(require('jquery'));
    } else {
      factory(root.jQuery);
    }
  })(this, function($) {
  
    'use strict';
  
    /**
     * Name of the plugin
     * @private
     * @const
     * @type {String}
     */
    var PLUGIN_NAME = 'vide';
  
    /**
     * Default settings
     * @private
     * @const
     * @type {Object}
     */
    var DEFAULTS = {
      volume: 1,
      playbackRate: 1,
      muted: true,
      loop: true,
      autoplay: true,
      position: '50% 50%',
      posterType: 'detect',
      resizing: true,
      bgColor: 'transparent',
      className: ''
    };
  
    /**
     * Not implemented error message
     * @private
     * @const
     * @type {String}
     */
    var NOT_IMPLEMENTED_MSG = 'Not implemented';
  
    /**
     * Parse a string with options
     * @private
     * @param {String} str
     * @returns {Object|String}
     */
    function parseOptions(str) {
      var obj = {};
      var delimiterIndex;
      var option;
      var prop;
      var val;
      var arr;
      var len;
      var i;
  
      // Remove spaces around delimiters and split
      arr = str.replace(/\s*:\s*/g, ':').replace(/\s*,\s*/g, ',').split(',');
  
      // Parse a string
      for (i = 0, len = arr.length; i < len; i++) {
        option = arr[i];
  
        // Ignore urls and a string without colon delimiters
        if (
          option.search(/^(http|https|ftp):\/\//) !== -1 ||
          option.search(':') === -1
        ) {
          break;
        }
  
        delimiterIndex = option.indexOf(':');
        prop = option.substring(0, delimiterIndex);
        val = option.substring(delimiterIndex + 1);
  
        // If val is an empty string, make it undefined
        if (!val) {
          val = undefined;
        }
  
        // Convert a string value if it is like a boolean
        if (typeof val === 'string') {
          val = val === 'true' || (val === 'false' ? false : val);
        }
  
        // Convert a string value if it is like a number
        if (typeof val === 'string') {
          val = !isNaN(val) ? +val : val;
        }
  
        obj[prop] = val;
      }
  
      // If nothing is parsed
      if (prop == null && val == null) {
        return str;
      }
  
      return obj;
    }
  
    /**
     * Parse a position option
     * @private
     * @param {String} str
     * @returns {Object}
     */
    function parsePosition(str) {
      str = '' + str;
  
      // Default value is a center
      var args = str.split(/\s+/);
      var x = '50%';
      var y = '50%';
      var len;
      var arg;
      var i;
  
      for (i = 0, len = args.length; i < len; i++) {
        arg = args[i];
  
        // Convert values
        if (arg === 'left') {
          x = '0%';
        } else if (arg === 'right') {
          x = '100%';
        } else if (arg === 'top') {
          y = '0%';
        } else if (arg === 'bottom') {
          y = '100%';
        } else if (arg === 'center') {
          if (i === 0) {
            x = '50%';
          } else {
            y = '50%';
          }
        } else {
          if (i === 0) {
            x = arg;
          } else {
            y = arg;
          }
        }
      }
  
      return { x: x, y: y };
    }
  
    /**
     * Search a poster
     * @private
     * @param {String} path
     * @param {Function} callback
     */
    function findPoster(path, callback) {
      var onLoad = function() {
        callback(this.src);
      };
  
      $('<img src="' + path + '.gif">').on('load', onLoad);
      $('<img src="' + path + '.jpg">').on('load', onLoad);
      $('<img src="' + path + '.jpeg">').on('load', onLoad);
      $('<img src="' + path + '.png">').on('load', onLoad);
    }
  
    /**
     * Vide constructor
     * @param {HTMLElement} element
     * @param {Object|String} path
     * @param {Object|String} options
     * @constructor
     */
    function Vide(element, path, options) {
      this.$element = $(element);
  
      // Parse path
      if (typeof path === 'string') {
        path = parseOptions(path);
      }
  
      // Parse options
      if (!options) {
        options = {};
      } else if (typeof options === 'string') {
        options = parseOptions(options);
      }
  
      // Remove an extension
      if (typeof path === 'string') {
        path = path.replace(/\.\w*$/, '');
      } else if (typeof path === 'object') {
        for (var i in path) {
          if (path.hasOwnProperty(i)) {
            path[i] = path[i].replace(/\.\w*$/, '');
          }
        }
      }
  
      this.settings = $.extend({}, DEFAULTS, options);
      this.path = path;
  
      // https://github.com/VodkaBears/Vide/issues/110
      try {
        this.init();
      } catch (e) {
        if (e.message !== NOT_IMPLEMENTED_MSG) {
          throw e;
        }
      }
    }
  
    /**
     * Initialization
     * @public
     */
    Vide.prototype.init = function() {
      var vide = this;
      var path = vide.path;
      var poster = path;
      var sources = '';
      var $element = vide.$element;
      var settings = vide.settings;
      var position = parsePosition(settings.position);
      var posterType = settings.posterType;
      var $video;
      var $wrapper;
  
      // Set styles of a video wrapper
      $wrapper = vide.$wrapper = $('<div>')
        .addClass(settings.className)
        .css({
          position: 'absolute',
          'z-index': -1,
          top: 0,
          left: 0,
          bottom: 0,
          right: 0,
          overflow: 'hidden',
          '-webkit-background-size': 'cover',
          '-moz-background-size': 'cover',
          '-o-background-size': 'cover',
          'background-size': 'cover',
          'background-color': settings.bgColor,
          'background-repeat': 'no-repeat',
          'background-position': position.x + ' ' + position.y
        });
  
      // Get a poster path
      if (typeof path === 'object') {
        if (path.poster) {
          poster = path.poster;
        } else {
          if (path.mp4) {
            poster = path.mp4;
          } else if (path.webm) {
            poster = path.webm;
          } else if (path.ogv) {
            poster = path.ogv;
          }
        }
      }
  
      // Set a video poster
      if (posterType === 'detect') {
        findPoster(poster, function(url) {
          $wrapper.css('background-image', 'url(' + url + ')');
        });
      } else if (posterType !== 'none') {
        $wrapper.css('background-image', 'url(' + poster + '.' + posterType + ')');
      }
  
      // If a parent element has a static position, make it relative
      if ($element.css('position') === 'static') {
        $element.css('position', 'relative');
      }
  
      $element.prepend($wrapper);
  
      if (typeof path === 'object') {
        if (path.mp4) {
          sources += '<source src="' + path.mp4 + '.mp4" type="video/mp4">';
        }
  
        if (path.webm) {
          sources += '<source src="' + path.webm + '.webm" type="video/webm">';
        }
  
        if (path.ogv) {
          sources += '<source src="' + path.ogv + '.ogv" type="video/ogg">';
        }
  
        $video = vide.$video = $('<video>' + sources + '</video>');
      } else {
        $video = vide.$video = $('<video>' +
          '<source src="' + path + '.mp4" type="video/mp4">' +
          '<source src="' + path + '.webm" type="video/webm">' +
          '<source src="' + path + '.ogv" type="video/ogg">' +
          '</video>');
      }
  
      // https://github.com/VodkaBears/Vide/issues/110
      try {
        $video
  
          // Set video properties
          .prop({
            autoplay: settings.autoplay,
            loop: settings.loop,
            volume: settings.volume,
            muted: settings.muted,
            defaultMuted: settings.muted,
            playbackRate: settings.playbackRate,
            defaultPlaybackRate: settings.playbackRate
          });
      } catch (e) {
        throw new Error(NOT_IMPLEMENTED_MSG);
      }
  
      // Video alignment
      $video.css({
        margin: 'auto',
        position: 'absolute',
        'z-index': -1,
        top: position.y,
        left: position.x,
        '-webkit-transform': 'translate(-' + position.x + ', -' + position.y + ')',
        '-ms-transform': 'translate(-' + position.x + ', -' + position.y + ')',
        '-moz-transform': 'translate(-' + position.x + ', -' + position.y + ')',
        transform: 'translate(-' + position.x + ', -' + position.y + ')',
  
        // Disable visibility, while loading
        visibility: 'hidden',
        opacity: 0
      })
  
      // Resize a video, when it's loaded
      .one('canplaythrough.' + PLUGIN_NAME, function() {
        vide.resize();
      })
  
      // Make it visible, when it's already playing
      .one('playing.' + PLUGIN_NAME, function() {
        $video.css({
          visibility: 'visible',
          opacity: 1
        });
        $wrapper.css('background-image', 'none');
      });
  
      // Resize event is available only for 'window'
      // Use another code solutions to detect DOM elements resizing
      $element.on('resize.' + PLUGIN_NAME, function() {
        if (settings.resizing) {
          vide.resize();
        }
      });
  
      // Append a video
      $wrapper.append($video);
    };
  
    /**
     * Get a video element
     * @public
     * @returns {HTMLVideoElement}
     */
    Vide.prototype.getVideoObject = function() {
      return this.$video[0];
    };
  
    /**
     * Resize a video background
     * @public
     */
    Vide.prototype.resize = function() {
      if (!this.$video) {
        return;
      }
  
      var $wrapper = this.$wrapper;
      var $video = this.$video;
      var video = $video[0];
  
      // Get a native video size
      var videoHeight = video.videoHeight;
      var videoWidth = video.videoWidth;
  
      // Get a wrapper size
      var wrapperHeight = $wrapper.height();
      var wrapperWidth = $wrapper.width();
  
      if (wrapperWidth / videoWidth > wrapperHeight / videoHeight) {
        $video.css({
  
          // +2 pixels to prevent an empty space after transformation
          width: wrapperWidth + 2,
          height: 'auto'
        });
      } else {
        $video.css({
          width: 'auto',
  
          // +2 pixels to prevent an empty space after transformation
          height: wrapperHeight + 2
        });
      }
    };
  
    /**
     * Destroy a video background
     * @public
     */
    Vide.prototype.destroy = function() {
      delete $[PLUGIN_NAME].lookup[this.index];
      this.$video && this.$video.off(PLUGIN_NAME);
      this.$element.off(PLUGIN_NAME).removeData(PLUGIN_NAME);
      this.$wrapper.remove();
    };
  
    /**
     * Special plugin object for instances.
     * @public
     * @type {Object}
     */
    $[PLUGIN_NAME] = {
      lookup: []
    };
  
    /**
     * Plugin constructor
     * @param {Object|String} path
     * @param {Object|String} options
     * @returns {JQuery}
     * @constructor
     */
    $.fn[PLUGIN_NAME] = function(path, options) {
      var instance;
  
      this.each(function() {
        instance = $.data(this, PLUGIN_NAME);
  
        // Destroy the plugin instance if exists
        instance && instance.destroy();
  
        // Create the plugin instance
        instance = new Vide(this, path, options);
        instance.index = $[PLUGIN_NAME].lookup.push(instance) - 1;
        $.data(this, PLUGIN_NAME, instance);
      });
  
      return this;
    };
  
    $(document).ready(function() {
      var $window = $(window);
  
      // Window resize event listener
      $window.on('resize.' + PLUGIN_NAME, function() {
        for (var len = $[PLUGIN_NAME].lookup.length, i = 0, instance; i < len; i++) {
          instance = $[PLUGIN_NAME].lookup[i];
  
          if (instance && instance.settings.resizing) {
            instance.resize();
          }
        }
      });
  
      // https://github.com/VodkaBears/Vide/issues/68
      $window.on('unload.' + PLUGIN_NAME, function() {
        return false;
      });
  
      // Auto initialization
      // Add 'data-vide-bg' attribute with a path to the video without extension
      // Also you can pass options throw the 'data-vide-options' attribute
      // 'data-vide-options' must be like 'muted: false, volume: 0.5'
      $(document).find('[data-' + PLUGIN_NAME + '-bg]').each(function(i, element) {
        var $element = $(element);
        var options = $element.data(PLUGIN_NAME + '-options');
        var path = $element.data(PLUGIN_NAME + '-bg');
  
        $element[PLUGIN_NAME](path, options);
      });
    });
  
  });
  