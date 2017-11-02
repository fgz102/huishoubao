
//防止有些pid 的 commonjs  引用的 cdn  没有更新该方法
if (!window.throttle) {

    var throttle = function(fn, delay) {

        var fb = false;
        var ctx = this;

        return function() {
            var arg = arguments;
            if (fb) {
                return;
            }

            fb = true;
            setTimeout(function() {
                fb = false;
                fn.apply(ctx, arg);
            }, delay || 1000);
        };
    };

};


var Model = {
    config: {},
    dom: {},
    myScrollL: null,
    myScroll: null,
    myScrollRst: null,
    init: function() {
        console.log(__CONFIG__);
        this.initParams(__CONFIG__);
        this.initDom();
        this.render();
        this.bindEvent();
    },
    initParams: function(config) {
        $.extend(this.config, config);
        this.config.xhr = null;
        this.config.xhring = false;
        this.config.hasnext = true;
        this.config.hasdata = true;             // 搜索结果是否有值，如果没有就为false
        this.config.next_page = 2;              // 机型结果分页
        this.config.page = 1;
        this.config.pages = Math.ceil(config.total / config.pagesize);
        this.config.ajax = false;
        this.config.localname = 'search-key-list';


        var history = Model.getCookie('search-key-list');

        try {
            this.config.history = history === null ? [] : JSON.parse(history);
        } catch (err) {
            this.config.history = [];
        }
    },
    initDom: function() {

        var dom = this.dom;
        dom.spinner = $('#spinner');                            // 翻页滚动效果
        dom.spinnerEnd = $('#spinnerEnd');                      // 最后一页div
        dom.rstSpiner = $('.rst-circleGBox');                   // 搜索 - 翻页动效
        dom.rstSpinerEnd = $('.rst-end');                       // 搜索 - 最后一页
        dom.rstNone = $('.rst-none');                           // 搜索 - 没有结果
        dom.versionBox = $('#wrapper ul');                      // 型号 UL
        dom.brands = $('.js-m-brands li');                      // 品牌 LI
        dom.moMark = $('.js-mo-mark');                          // 菊花图div
        dom.type = $('.js-type a');                             // 手机、平板分类
        dom.gbodyTemp = $('<div>');                             // 模板

        dom.indexPanel = $('#index-panel');                     // 品牌主面板
        dom.searchPanel = $('#search-panel');                   // 搜索主面板
        dom.searchLabel = $('#search-label');                   // 放大镜-打开搜索
        dom.searchInput = $('#text-search');                    // 搜索框
        dom.searchCancel = $('#search-cancel');                 // 搜索取消
        dom.searchResultPanel = $('#search-result-panel');      // 搜索结果面板
        dom.searchDefaultContainer = $('#g-default-container'); // 默认搜索box
        dom.searchResultContainer = $('#g-result-container');   // 搜索结果box

        dom.historyList = $('.js-history-list');                // 历史记录
        dom.historyClear = $('.clear-history-btn')               // 清除历史记录

        dom.godModle = $('.god');                               // iphone 下点透处理

        this.myScrollL = new IScroll('#wrapperL', {
            scrollbars: 'custom'
        });


        // 品牌wrap
        this.myScroll = new IScroll('#wrapper', {               // 型号wrap
            probeType: 2,
            mouseWheel: true,
            click: true,
            scrollbars: 'custom'
        });
    },

    bindEvent: function() {
        var dom = this.dom,
            that = this,
            brandH = dom.brands.height(),
            brandNum = dom.brands.length;

        dom.brands.on('tap', this.brandsTap);   // 拉取品牌列表
        dom.searchLabel.on('tap', function() {  // 放大镜-打开搜索
            that.domSearchPage();   // 打开搜索box
            window.history.pushState(true, null, null);
        });
        dom.searchCancel.on('tap', function() {
            window.history.back();
            that.domMainPage();     // 回到主面板
            that.myScroll.refresh();
        });

        var inputEv = function() {
            that.firstSearch();         // 进行搜索 - 第一页
            // dom.rstNone.show();

        };

        dom.searchInput.on('input', throttle(inputEv, 1000));
        dom.historyList.on('tap', 'li', function() {     // 选择 历史记录
            // iphone 下点透处理
            dom.godModle.show();

            var indexSpan = $(this).find('.hot-list-index');

            var text = $(this).text().trim();

            if (indexSpan[0]) {
                text = text.split(' ');
                text.shift();
                text = text.join(' ');
            }
            dom.searchInput.val(text);
            that.firstSearch();         // 进行搜索 - 第一页

        });
        dom.historyClear.on('tap', function(e) {    // 清除历史记录
            e.preventDefault();
            that.clearHisttory();
        });
        this.myScroll.on('scrollEnd', this.scrollEnd.bind(this));   // 右侧机型 - 绑定滑动事件
        window.onpopstate = function() {
            var issearch = Util.getQuery('search');
            if (issearch && issearch === 'search') {
                that.domSearchPage();   // 打开搜索box
                return;
            }
            if (window.history.state) {
                that.domSearchPage();   // 打开搜索box
            } else {
                that.domMainPage();     // 回到主面板
            }
        }
        window.onpopstate();
    },
    domSearchPage: function() {     // 打开搜索box
        console.log('searchPanel');
        var dom = this.dom;
        dom.searchPanel.removeClass('f-dn');
        dom.indexPanel.addClass('f-dn');
        dom.searchDefaultContainer.show();
        dom.searchResultContainer.hide();
        dom.searchInput.val('').focus();
    },
    domMainPage: function() {       // 回到主面板
        console.log('indexPanel');
        var dom = this.dom;
        dom.searchInput.val('');
        dom.searchPanel.addClass('f-dn');
        dom.indexPanel.removeClass('f-dn');
    },
    historyWord: function(key, that) {
        if (!key) {
            return;
        }
        var config = that.config;
        var history = config.history;
        var index = history.length;
        while (index--) {
            if (history[index] === key) {
                history.splice(index, 1);
                break;
            }
        }
        history.unshift(key);
        config.history = history.splice(0, 10);

        that.setCookie(config.localname, JSON.stringify(config.history));

        that.render();
    },
    clearHisttory: function() {
        var dom = this.dom,
            config = this.config;

        this.delCookie(config.localname);

        dom.historyList.find('li').remove();
    },
    render: function() {
        var dom = this.dom;
        dom.historyList.find('li').remove();
        this.config.history.forEach(function(key) {
            var historyKey = $('<li>');
            historyKey.text(key);
            dom.historyList.append(historyKey);
        })
    },
    scrollEnd: function() { // 右侧机型 - 绑定滑动事件
        if (this.myScroll.y <= this.myScroll.maxScrollY + 40) {
            this.pullUpAction();
        }
    },
    pullUpAction: function() {
        var dom = this.dom;
        if (this.config.hasnext) {
            dom.spinner.show();
            dom.spinnerEnd.hide();
            this.load_content();    // 右侧机型 - 绑定滑动事件
        } else {
            dom.spinner.hide();
            dom.spinnerEnd.show()
        }
    },
    load_content: function() {  // 右侧机型 - 绑定滑动事件
        var dom = this.dom,
            mid = this.config.mid,
            next_page = this.config.next_page,
            pid = this.config.pid,
            xhr = this.config.xhr,
            that = this;

        if (this.config.jdparam) {
            var jdparam = this.config.jdparam;
        }


        if (this.config.xhr) {
            return;
        }
        xhr = $.get('/api/getVersion/' + mid + '/' + next_page + '?pid=' + pid + jdparam, function(result) {
            that.config.xhr = null;
            if (result.data.data.length == 0) {
                that.config.hasnext = false;
                dom.spinner.hide();
                dom.spinnerEnd.show()
                return;
            }

            if (pid == '1083' || pid == '1084') {

                result.data.data.forEach(function(data, i) {
                    var qb = (next_page - 1) * 30 + i + 1;
                    dom.versionBox.append(
                        '<li class="index-btn-css"><a href="/mobile/getParamsByItemid_' + data.itemid + '.html?pid=' + pid + jdparam + '" data-itemid="' + data.itemid + '"><span>' + qb + '</span>' + data.name + '</a></li>');
                })

            } else {
                result.data.data.forEach(function(data, i) {
                    // var qb = (next_page - 1) * 30 + i + 1;
                    var qb = $('.model-list-wrapper').find('li').length + 1;
                    dom.versionBox.append(
                        '<li><a href="/mobile/getParamsByItemid_' + data.itemid + '.html?pid=' + pid + '" data-itemid="' + data.itemid + '"><span>' + qb + '</span>' + data.name + '</a></li>');
                });
            }

            that.myScroll.refresh();
            that.config.next_page++;
        }, 'json');
    },
    brandsTap: function(event) { // 拉取品牌列表
        var that = Model,
            dom = that.dom,
            pid = that.config.pid;
        dom.spinner.hide();
        dom.spinnerEnd.hide();

        that.config.mid = $(this).data('mid');
        that.config.hasnext = true;
        that.config.next_page = 2;
        that.config.xhr && that.config.xhr.abort();
        that.config.xhr = null;
        var jdparam = that.config.jdparam;

        dom.brands.removeClass('active');
        $(this).addClass('active');
        dom.versionBox.html('');
        
		var key=event.target.text;
		if(key==null)
		{
//			console.log(event.target.firstChild);
			key=event.target.firstChild.text;
		}
		console.log(key);
		arr = t[''+key+''];
//		console.log(arr);
		for(var obj in arr)
		{
			dom.versionBox.append('<li><a href="getParamsByItemid.php?pid='+arr[obj].id+'"><span>'+arr[obj].rank+'</span>'+arr[obj].pName+'</a></li>');
        }
                // that.myScroll.scrollTo(0, 0);
	    that.myScroll.refresh();
	    dom.moMark.hide();
//      $.ajax({
//          type: 'GET',
//          url: '/api/getVersion/' + that.config.mid + '?pid=' + pid,
//          dataType: 'json',
//          beforeSend: function() {
//              dom.moMark.show();
//          },
//          success: function(result) {
//              console.log(result);
//              result.data.data.forEach(function(data, i) {
//                  i += 1;
//                  if (pid == '1083' || pid == '1084') {
//
//                      dom.versionBox.append(
//                      '<li class="index-btn-css"><a href="/mobile/getParamsByItemid_' + data.itemid + '.html?pid=' + pid + jdparam + '" data-itemid="' + data.itemid + '"><span class="z-crt' + i + '">' + i + '</span>' + data.name + '</a></li>');
//
//                  } else {
//                      
//                      if(i <= 3) {
//
//                          dom.versionBox.append('<li><a href="/mobile/getParamsByItemid_' + data.itemid + '.html?pid=' + pid + '" data-itemid="' + data.itemid + '"><span class="z-crt"></span>' + data.name + '</a></li>');
//                      } else {
//                          dom.versionBox.append('<li><a href="/mobile/getParamsByItemid_' + data.itemid + '.html?pid=' + pid + '" data-itemid="' + data.itemid + '"><span>' + i + '</span>' + data.name + '</a></li>');
//
//                      }
//
//                  }
//
//              });
//              // that.myScroll.scrollTo(0, 0);
//              that.myScroll.refresh();
//              dom.moMark.hide();
//          }
//
//      })
    },
    firstSearch: function(){            // 进行搜索 - 第一页
        this.dom.rstSpiner.hide();
        this.dom.rstSpinerEnd.hide();
        // this.dom.rstNone.hide();
        this.config.cur = 1;
        // this.dom.searchResultPanel.html('');
        this.config.hasnext = true;
        this.config.hasdata = true;             // 搜索结果是否有值，如果没有就为false
        this.search();
        this.initScroll();  // 搜索结果为false就不初始化翻页动效了
    },
    initScroll: function(){
        this.myScrollRst = new IScroll('#wrapperRst', {             // 搜索结果wrap
            probeType: 2,
            mouseWheel: true,
            click: true
        });
        this.myScrollRst.on('scrollEnd', this.scrollRstEnd.bind(this)); // 搜索结果 - 绑定滑动事件
        this.myScrollRst.scrollTo(0, 0);
        this.myScrollRst.refresh();
    },
    scrollRstEnd: function() {  // 搜索结果 - 绑定滑动事件
        if (this.myScrollRst.y <= this.myScrollRst.maxScrollY + 40) {
            this.rstPullUp();
        }
    },
    rstPullUp: function() {
        var dom = this.dom;
        if (this.config.hasnext) {
            dom.rstSpiner.show();
            dom.rstSpinerEnd.hide();
            this.rstLoadContent();  // 搜索结果 - 绑定滑动事件
        } else {
            if(this.config.hasdata){    // 搜索结果是否有值，如果没有就为false
                dom.rstSpiner.hide();
                dom.rstSpinerEnd.show();
            }
        }
    },
    rstLoadContent: function() {    // 搜索结果 - 绑定滑动事件
        var $rstTotal = $($('.rst_total')[0]).val();
        var $rstPagesize = $($('.rst_pagesize')[0]).val();

        // console.log($rstTotal);
        // console.log($rstPagesize * this.config.cur);
        // console.log($rstTotal <= $rstPagesize * this.config.cur);
        if($rstTotal <= $rstPagesize * this.config.cur){
            // 没有更多
        }else if(!this.config.xhring){
            this.config.cur = this.config.cur + 1;
            this.search();          // 进行搜索
            this.myScrollRst.refresh();
        }
    },
    search: function() {    // 进行搜索

        var dom = this.dom,
            key = this.config.key = dom.searchInput.val().trim(),
            cur = this.config.cur,
            pid = this.config.pid,
            that = this,
            reg = /^[\u4E00-\u9FA5]+$/;

        setPage ();

        this.search.get && this.search.get.abort();

        function setPage () {


            if (key == '') {

                dom.searchDefaultContainer.show();
                dom.searchResultContainer.hide();
                return false;

            }

            $.get('/mobile/getProductListByKey_' + encodeURIComponent(key) + '.html', {
                pid: pid,
                jdparam : __CONFIG__.jdparam2,
                cur: cur
            }, function(html) {

                // dom.rstNone.hide();
                that.historyWord(key, that);                // 记录搜索history
                dom.searchResultPanel.html(html);     // 把搜索结果 - 填充到html


                var $rstTotal = $($('.rst_total')[0]).val();
                var $rstPagesize = $($('.rst_pagesize')[0]).val();

                if($rstTotal <= 0){
                    // 搜索结果为0的情况
                    dom.rstNone.show();
                    that.config.hasnext = false;
                    that.config.hasdata = false;    // 搜索结果是否有值，如果没有就为false
                    dom.rstSpiner.hide();
                    dom.rstSpinerEnd.hide();
                    // dom.rstNone.show();
                }else {
                    // 没有更多
                    if($rstTotal <= $rstPagesize * that.config.cur) {
                        that.config.hasnext = false;
                    }

                    dom.rstNone.hide();
                }

                dom.searchDefaultContainer.hide();
                dom.searchResultContainer.show();

                that.myScrollRst.refresh();

                // iphone 下点透处理
                setTimeout(function () {

                    dom.godModle.hide();

                }, 300);

            });
        }

        $(window).scroll(function(){

        　　var scrollTop    = $(this).scrollTop(),
                scrollHeight = $(document).height(),
                windowHeight = $(this).height();

            // 滚动到底部程序开始加载
        　　if(scrollTop + windowHeight >= scrollHeight){

                setPage();
        　　}

        });

    },
    getCookie : function (name) {

        var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");

        if (arr = document.cookie.match(reg)) {

            return unescape(arr[2]);
        } else{

            return null;
        }
    },
    setCookie : function (name, value) {
        var Days = 30;
        var exp = new Date();
        exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
        document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
    },
    delCookie : function (name){
        var exp = new Date();
        exp.setTime(exp.getTime() - 1);
        var cval = this.getCookie(name);
        if(cval!=null)
        document.cookie= name + "="+cval+";expires="+exp.toGMTString();
    }
};

$(function() {

    Model.init();

    // 滑动屏幕阻止出现键盘
    $(window).on('touchend touchcancel', function () {

        $('#text-search').blur();
    });

});