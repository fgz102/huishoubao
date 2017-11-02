

/**
 * [onerror description]
 * @return {[type]} [description]
 */
window.onerror = function () {};


!(function(window, undefined) {
  /**
   * 拦截ajax, tmq 2017-05-08
   */

  var _prototype_ = XMLHttpRequest.prototype;
  var send = _prototype_.send;

  /**
   * [test description]
   * @return {[type]} [description]
   */
  // var test = function () {

  //   var xhr = new XMLHttpRequest();

  //   xhr.open('get', '/xxx');
  //   xhr.send();
  //   xhr.onreadystatechange = function () {
  //     console.log('hi');
  //   }

  // }

  // _prototype_.send = function () {

  //   var that = this;

  //   setTimeout(function () {

  //     var onreadystatechange = that.onreadystatechange;

  //     that.onreadystatechange = function () {

  //       onreadystatechange && onreadystatechange.call(that);

  //       if (that.readyState == 4 && that.status === 404) {
  //         console.log(that.status);
  //         //to do
  //       }
  //     };

  //   }, 1);

  //   send.apply(this, arguments);
  // };



})(window);



/*================================================================*/
/*                         template engine                        */
/*================================================================*/
(function(){
    var cache = {};
    this.tmpl = function tmpl(str, data){
        var fn = !/\W/.test(str) ?
            cache[str] = cache[str] ||
                tmpl(document.getElementById(str).innerHTML) :
            new Function("obj",
                "var p=[],print=function(){p.push.apply(p,arguments);};" +
                "with(obj){p.push('" +
                str
                    .replace(/[\r\t\n]/g, " ")
                    .split("<%").join("\t")
                    .replace(/((^|%>)[^\t]*)'/g, "$1\r")
                    .replace(/\t=(.*?)%>/g, "',$1,'")
                    .split("\t").join("');")
                    .split("%>").join("p.push('")
                    .split("\r").join("\\'")
                + "');}return p.join('');");
        return data ? fn( data ) : fn;
    };
})();





/**
 * desc: 提示框
 * @param desc 描述文字
 * @param delay 延迟时间
 */
var Util = {

    showTip: function (opt) {
        if(typeof opt !== 'object') {
            opt = {
                desc: opt,
            };
        }

        if(!typeof opt.delay == 'number') {
            throw new Error('property delay must be Number')
        }

        var ele = $('.toast');
        if (ele.length) return;
        var tip = $('<div class="tip">' + opt.desc + '</div>');
        tip.css({
            position: 'fixed',
            zIndex: 1,
            left: '50%',
            top: '30%',
            width: '300px',
            height: '53px',
            lineHeight: '53px',
            marginLeft: '-150px',
            color: '#fff',
            textAlign: 'center',
            backgroundColor: 'rgba(0,0,0,.7)',
            boxShadow: 'rgba(0, 0, 0, 0.1) 0px 8px 30px 0px',
            fontSize: '14px'
        });
        $('body').append(tip);
        setTimeout(function () {
            tip.hide();
            tip.remove();
        }, opt.delay || 1500)
    },

    getQuery: function (name, url) {
        var u = url || location.search,
            reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"),
            r = u.substr(u.indexOf("\?") + 1).match(reg);
        return r != null ? r[2] : "";
    },

    getCookie: function (name) {
        var reg = new RegExp("(^| )" + name + "(?:=([^;]*))?(;|$)"),
            val = document.cookie.match(reg);
        return val ? (val[2] ? unescape(val[2]) : "") : null;
    },
    setCookie: function (name, value, expires, path, domain, secure) {
        var exp = new Date(),
            expires = arguments[2] || null,
            path = arguments[3] || "/",
            domain = arguments[4] || null,
            secure = arguments[5] || false;
        expires ? exp.setMinutes(exp.getMinutes() + parseInt(expires)) : "";
        document.cookie = name + '=' + escape(value) + (expires ? ';expires=' + exp.toGMTString() : '') + (path ? ';path=' + path : '') + (domain ? ';domain=' + domain : '') + (secure ? ';secure' : '');
    },
    delCookie: function (name, path, domain, secure) {
        var value = $getCookie(name);
        if (value != null) {
            var exp = new Date();
            exp.setMinutes(exp.getMinutes() - 1000);
            path = path || "/";
            document.cookie = name + '=;expires=' + exp.toGMTString() + (path ? ';path=' + path : '') + (domain ? ';domain=' + domain : '') + (secure ? ';secure' : '');
        }
    },
    fen2yuan: function(fen) {
        fen = parseInt(fen, 10);
        return (fen / 100);
    },

    isWX: (function() {
        var ua = window.navigator.userAgent.toLowerCase();
        if(ua.match(/MicroMessenger/i) == 'micromessenger'){
            return true;
        }else{
            return false;
        }
    })()

};


/**
 * 弹出层 2017 TMQ
 * @param  {[type]} ) {               var css [description]
 * @return {[type]}   [description]
 */
$(function () {


    var MoveFns = {
      /**
       * 线性运动1
       * @param  {[type]}   f  [description]
       * @param  {[type]}   d  [description]
       * @param  {[type]}   sT [description]
       * @param  {[type]}   t  [description]
       * @return {Function}    [description]
       */
      even : function (f, d, sT, t) {

          var dt = new Date().getTime() - sT;

          return f + (d - f) * dt / t;
      },

    };

    /**
     * 滚动、
     * @param  {number} dist   [description]
     * @param  {Object} option options
     * @return {null}        [description]
     */
    $.fn.scrollTo = function (dist, option) {

        dist = Number(dist);
        if (!dist) {
            dist = 0;
        }

        var _default = {

            /**
             * 线性运动1
             * @param  {[type]}   f  [description]
             * @param  {[type]}   d  [description]
             * @param  {[type]}   sT [description]
             * @param  {[type]}   t  [description]
             * @return {Function}    [description]
             */
            fn : MoveFns.even,

            timing : 500
        }

        option = $.extend(_default, option);

        var that = this;
        var startPostion = that.scrollTop();

        var startTime = new Date().getTime();

        var step = function () {


            setTimeout(function () {

                var position = option.fn(startPostion, dist, startTime, option.timing);

                that.scrollTop(position);

                if (option.timing <= new Date().getTime() - startTime) {
                    that.scrollTop(dist);
                    return;
                } else {
                    step();
                }

            }, 16);
        }

        step();
    };




});


$(function() {

    $('.js-service li').on('tap', function() {

        var index = $(this).index();
        $(this).addClass('active').siblings().removeClass('active');
        $('.js-service-panel').eq(index).show().siblings('.js-service-panel').hide();

    });


});

function convertTimes(date) {
    var date = date.split('-');
    d = new Date();
    d.setMonth(parseInt(date[0]) - 1);
    d.setDate(parseInt(date[1]));
    d.setHours('0');
    d.setMinutes('0');
    d.setSeconds('0');
    return Date.parse(d) / 1000;
}

/**
 * 倒计时插件
 * @Author   TMQ
 * @DateTime 2017-05-27T17:15:27+0800
 * @param    {[type]}                 ) {             var getReTime [description]
 * @return   {[type]}                   [description]
 *
 * $('.ex').LimitTime(options);
 */
$(function () {

  /**
   * 获取当前时间和限时高价活动开始时间
   * @type {[type]}
   */
  var nowTime = Number($('body').attr('data-now')) || (new Date()).getTime();
  // var activeStartTime = Number($('body').attr('start-time')) || new Date('2017-05-27').getTime();

  var getReTime = function (time) {

    var endTime = (new Date(time)).getTime();
    // var nowTime =  (new Date()).getTime();

    nowTime += 1000;
    var t = endTime - nowTime;

    if (t <= 0) {
      return {d : 0, h : 0, m: 0, s: 0};
    }

    return {
      d : Math.floor(t / 1000 / 60 / 60 / 24),
      h : Math.floor(t / 1000 / 60 / 60 % 24),
      m : Math.floor(t / 1000 / 60 % 60),
      s : Math.floor(t / 1000 % 60)
    };
  };


    /**
   * 活动倒计时，
   * @Author   TMQ
   * @DateTime 2017-05-26T11:24:26+0800
   * @param    {Document}                 dom dom应该包含相关data数据
   *
   *  data-endtime    结束时间应该写在需要倒计时的dom节点上
   *
   */
  var LimitTime = function (dom, options) {
    this.init(dom, options);
  };

  LimitTime.prototype.init = function (dom, options) {

    this.dom = dom;
    this.options = options || {};
    this.getData();
    // this.injectActive();
    this.timing(getReTime(this.endTime));
  };

  LimitTime.prototype.getData = function () {

    var priceDom = this.dom;
    this.endTime = Number(priceDom.attr('data-endtime'));
  };

  LimitTime.prototype.timing = function (time) {


    this.options.onUpdate && this.options.onUpdate(time);

    if (time.d ==0 && time.h == 0 && time.m == 0 && time.s == 0) {

      this.destoryActive();
      return;
    }

    var that = this;
    var time = setTimeout(function () {

      that.timing(getReTime(that.endTime));

    }, 1000);
  };

  LimitTime.prototype.destoryActive = function () {

  };

  LimitTime.prototype.injectActive = function () {

  };

  $.fn.LimitTime = function (options) {

    this.each(function (i, item) {
      new LimitTime($(item), options);
    });

    return this;
  };

})

function isMobile(tel) {
    return /^1\d{10}$/.test(tel);
}

function fen2yuan(fen) {
    fen = parseInt(fen, 10);
    return (fen / 100);
}

function yuan2fen(yuan) {
    yuan = parseFloat(yuan, 10);
    return parseInt(yuan * 100);
}

/**
 * PopupManger and Popup
 *
 * 弹窗组件，需要
 * @Author   TMQ
 * @DateTime 2017-06-06T16:20:36+0800
 * @param    {[type]}                 window    [description]
 * @param    {[type]}                 document  [description]
 * @param    {[type]}                 undefined [description]
 * @return   {[type]}                           [description]
 */
(function (window, document, undefined) {


var trim = function(string) {
  return (string || '').replace(/^[\s\uFEFF]+|[\s\uFEFF]+$/g, '');
};

function hasClass(el, cls) {
  if (!el || !cls) return false;
  if (cls.indexOf(' ') !== -1) throw new Error('className should not contain space.');
  if (el.classList) {
    return el.classList.contains(cls);
  } else {
    return (' ' + el.className + ' ').indexOf(' ' + cls + ' ') > -1;
  }
};

/* istanbul ignore next */
function addClass(el, cls) {
  if (!el) return;
  var curClass = el.className;
  var classes = (cls || '').split(' ');

  for (var i = 0, j = classes.length; i < j; i++) {
    var clsName = classes[i];
    if (!clsName) continue;

    if (el.classList) {
      el.classList.add(clsName);
    } else {
      if (!hasClass(el, clsName)) {
        curClass += ' ' + clsName;
      }
    }
  }
  if (!el.classList) {
    el.className = curClass;
  }
};

/* istanbul ignore next */
function removeClass(el, cls) {
  if (!el || !cls) return;
  var classes = cls.split(' ');
  var curClass = ' ' + el.className + ' ';

  for (var i = 0, j = classes.length; i < j; i++) {
    var clsName = classes[i];
    if (!clsName) continue;

    if (el.classList) {
      el.classList.remove(clsName);
    } else {
      if (hasClass(el, clsName)) {
        curClass = curClass.replace(' ' + clsName + ' ', ' ');
      }
    }
  }
  if (!el.classList) {
    el.className = trim(curClass);
  }
};

'use strict';

var hasModal = false;
var idSeed = 1;

var getModal = function getModal() {
  var modalDom = PopupManager.modalDom;
  if (modalDom) {
    hasModal = true;
  } else {
    hasModal = false;
    modalDom = document.createElement('div');
    PopupManager.modalDom = modalDom;

    modalDom.addEventListener('touchmove', function (event) {
      event.preventDefault();
      event.stopPropagation();
    });

    modalDom.addEventListener('click', function () {
      PopupManager.doOnModalClick && PopupManager.doOnModalClick();
    });
  }

  return modalDom;
};

var instances = {};

var PopupManager = {
  zIndex: 2000,

  modalFade: true,

  getInstance: function getInstance(id) {
    return instances[id];
  },

  register: function register(instance) {

    var id = idSeed++;
    if (instance) {
      instances[id] = instance;
    }

    return id;
  },

  deregister: function deregister(id) {
    if (id) {
      instances[id] = null;
      delete instances[id];
    }
  },

  nextZIndex: function nextZIndex() {
    return PopupManager.zIndex++;
  },

  modalStack: [],

  doOnModalClick: function doOnModalClick() {
    var topItem = PopupManager.modalStack[PopupManager.modalStack.length - 1];
    if (!topItem) return;

    var instance = PopupManager.getInstance(topItem.id);
    if (instance && instance.closeOnClickModal) {
      instance.close();
    }
  },

  openModal: function openModal(id, zIndex, dom, modalClass, modalFade) {
    if (!id || zIndex === undefined) return;
    this.modalFade = modalFade;

    var modalStack = this.modalStack;

    for (var i = 0, j = modalStack.length; i < j; i++) {
      var item = modalStack[i];
      if (item.id === id) {
        return;
      }
    }

    var modalDom = getModal();

    addClass(modalDom, 'v-modal');
    if (this.modalFade && !hasModal) {
      addClass(modalDom, 'v-modal-enter');
    }
    if (modalClass) {
      var classArr = modalClass.trim().split(/\s+/);
      classArr.forEach(function (item) {
        return addClass(modalDom, item);
      });
    }
    setTimeout(function () {
      removeClass(modalDom, 'v-modal-enter');
    }, 200);

    if (dom && dom.parentNode && dom.parentNode.nodeType !== 11) {
      dom.parentNode.appendChild(modalDom);
    } else {
      document.body.appendChild(modalDom);
    }

    if (zIndex) {
      modalDom.style.zIndex = zIndex;
    }
    modalDom.style.display = '';

    this.modalStack.push({ id: id, zIndex: zIndex, modalClass: modalClass });
  },

  closeModal: function closeModal(id) {
    var modalStack = this.modalStack;
    var modalDom = getModal();

    if (modalStack.length > 0) {
      var topItem = modalStack[modalStack.length - 1];
      if (topItem.id === id) {
        if (topItem.modalClass) {
          var classArr = topItem.modalClass.trim().split(/\s+/);
          classArr.forEach(function (item) {
            return removeClass(modalDom, item);
          });
        }

        modalStack.pop();
        if (modalStack.length > 0) {
          modalDom.style.zIndex = modalStack[modalStack.length - 1].zIndex;
        }
      } else {
        for (var i = modalStack.length - 1; i >= 0; i--) {
          if (modalStack[i].id === id) {
            modalStack.splice(i, 1);
            break;
          }
        }
      }
    }

    if (modalStack.length === 0) {
      if (this.modalFade) {
        addClass(modalDom, 'v-modal-leave');
      }
      setTimeout(function () {
        if (modalStack.length === 0) {
          if (modalDom.parentNode) modalDom.parentNode.removeChild(modalDom);
          modalDom.style.display = 'none';
          PopupManager.modalDom = undefined;
        }
        removeClass(modalDom, 'v-modal-leave');
      }, 200);
    }
  }
};

var Popup = function Popup(options) {

  this.init(options);
  this.popID = PopupManager.register(this);
};

Popup.prototype.init = function (options) {

  this.closeOnClickModal = options.closeOnClickModal === false ? false : true;
  this.modal = options.modal === false ? false : true;
  this.onClose = options.onClose;
  this.onOpen = options.onOpen;
  this.dom = options.el;
};

Popup.prototype.close = function () {

  this.dom.style.display = 'none';

  this.visible = false;
  this.onClose && this.onClose();
  PopupManager.closeModal(this.popID);
};

Popup.prototype.open = function () {

  var dom = this.dom;
  dom.style.display = '';
  this.visible = true;

  if (this.modal) {
    PopupManager.openModal(this.popID, PopupManager.nextZIndex());
  }

  dom.style.zIndex = PopupManager.nextZIndex();
  this.onOpen && this.onOpen();
};

window.util = window.util || {};

window.util.Popup = Popup;


})(window, document)


$.fn.upTextAmazing = (function () {

    var animateFn = function (t,b,c,d) {

        return c*(t/=d)*t + b;
    };


    return function (n, time, formater) {

        time = Number(time) || 500;
        var sd =  parseInt(this.text());
        var st = +new Date();
        n = parseInt(n);
        var cd = n - sd;
        var that = this;

        var text = function (v) {
            if (formater) {
                that.text(formater(v));
            } else {
                that.text(v);
            }
        }

        var step = function () {
            var lostTime = +new Date() - st;
            var newV = Math.ceil(animateFn(lostTime, sd, cd,time));

            text(newV);
            if (newV - n >= 0 || lostTime >= time) {
                text(n);
                return;
            }


            setTimeout(function () {
                step();
            }, 16);
        };

        step();

    }

})();