$(function () {

    /**
     * 检测某个成员是否存在数组中
     * @param value
     * @param arr
     * @returns {boolean}
     */
    var isInCache = function (value, arr) {
        var result = false;
        for (var i = 0; i < arr.length; i++) {
            if (arr[i] === value) {
                result = true
            }
        }
        return result;
    };

    /**
     * 获取query字段
     * @returns {*}
     */
    var getQueryParams = function () {
        var temp,
            key,
            value,
            result = {},
            search = decodeURIComponent(window.location.search);
        if (!search.length) return [];
        var searchArr = search.substr(1, search.length - 1).split('&');
        searchArr.map(function (item) {
            temp = item.split('=');
            key = temp[0];
            value = temp[1];
            result[key] = value;
        });
        return result;
    };

    var evaluate = {
        initDom: function () {
            this.baseOptions = $('.base-options');
            this.funcOptions = $('.func-options');
            this.submittBtn = $('.button-submit');
            this.progressWrap = $('.progress-wrap');
            this.radio = $('.ratio');
            this.cover = $('.cover');
            this.params = {};
            this.cache = [];
            this.scroll = new IScroll('.scroll-wrap', {mouseWheel: true, click: true});
            this.bindEvent();
            this.reEvaluate();
        },
        reEvaluate: function () {
            var element,
                query = getQueryParams();
            len = this.baseOptions.find('.evaluate-item');
            if (query.action !== undefined) {
                this.baseOptions.find('.evaluate-item').addClass('open');
                this.funcOptions.addClass('open');
                this.submittBtn.removeAttr('disabled');
                this.cover.css({ width: '100%' });
                this.progressWrap.addClass('full');
                this.radio.html('100%');
                this.scroll.refresh();
                for (var i = 0; i < len.length; i++) {
                    this.cache.push(i);
                }
                for (var key in query) {
                    if (query.hasOwnProperty(key)) {
                        if (key.indexOf('qst_') === 0) {
                            element = $('.base-option[data-value="' + query[key] + '"]');
                            if(element.length) {
                                element.addClass('checked');
                            }
                            element = $('.func-option[data-value="' + query[key] + '"]');
                            if(element.length !== 0) {
                                if(!element.hasClass('default')) {
                                    element.parent().addClass('checked');
                                }
                            }
                        }
                    }
                }
            }
        },
        baseOptionClickHandler: function (element) {
            var $this = $(element),
                index = $this.parents('.evaluate-item').index();//index()在所选元素中排序位置
                cid = $(element).attr("data-cid");
            if (cid == 82) {
                hsb.toast({
                    desc: '对未解锁 iPhone，我们将不予回收',
                    delay: 1500
                });
                return false;
            }
            $this.addClass('checked').siblings().removeClass('checked');
            if (!isInCache(index, this.cache)) {
                this.cache.push(index);
            }
            this.cacheChanged();
        },
        funcOptionClickHandler: function (element) {
            var $this = $(element);
            $this.toggleClass('checked');
        },
        cacheChanged: function () {

            var _this = this,
                element = null,
                baseOptions = this.baseOptions.find('.evaluate-item'),
                len = baseOptions.length;
            cacheLength = _this.cache.length;

            var radio = parseInt(cacheLength / len * 100) + "%";
            this.radio.html( radio);
            this.cover.css({ width: radio });

            if (cacheLength === baseOptions.length) {
                this.progressWrap.addClass('full');
                this.submittBtn.removeAttr('disabled');
                element = this.funcOptions;
                element.addClass('open');
                setTimeout(function () {
                    _this.scroll.refresh();
                    _this.scroll.scrollToElement(element.get(0))
                }, 0);
            }
            if (cacheLength < len) {
                element = baseOptions.eq(cacheLength);
                element.addClass('open');
                setTimeout(function () {
                    _this.scroll.refresh();
                    _this.scroll.scrollToElement(element.get(0))
                }, 0);
            }
        },
        bindEvent: function () {
            var _this = this,
                baseOptionList = this.baseOptions.find('.eva-option'),
                funcOptionList = this.funcOptions.find('.eva-option');
            baseOptionList.bind('click', function () {
                _this.baseOptionClickHandler(this)
            });
            funcOptionList.bind('click', function () {
                _this.funcOptionClickHandler(this);
            });
            this.submittBtn.bind('click', function () {
                _this.submitHandler();
            })
        },
        getParams: function () {
            var params = {};
            var key, value ,text;

            // 基本选项
            var baseOptions = this.baseOptions.find('.eva-option.checked');
            baseOptions.each(function (index, element) {
                key = $(element).attr('data-key');
                value = $(element).attr('data-value');
//              text =$(element).text();
//              text =text.replace(/[\r\n]/g,"");//去掉回车换行 
//              text=text.replace(/[ ]/g,"");    //去掉空格
//              var tmp = {};
//              tmp['index']=value;
//              tmp['text']=encodeURI(text);
                params[key] = value;
            });

            // 功能选项
            var funcOptions = this.funcOptions.find('.eva-option');
            funcOptions.each(function (index, element) {
                if ($(element).hasClass('checked')) {
                    key = $(element).attr('data-key');
                	value = $(element).attr('data-value');
//              	text =$(element).text();
//              	text =text.replace(/[\r\n]/g,"");//去掉回车换行 
//              	text=text.replace(/[ ]/g,"");    //去掉空格
//	                var tmp = {};
//	                tmp['index']=value;
//	                tmp['text']=encodeURI(text);
	                params[key+'_'+value] = value;
                }
                
            });
            return params;
        },
        submitHandler: function () {
            var params = this.getParams(),
                form = document.createElement('form');
            string = '';
            form.method = 'POST';
            form.action = 'evaluate.php?pid=' + m_pid;
			string += '<input type="hidden" name="pid" value="' + m_pid + '">';
			string += '<input type="hidden" name="pName" value="' + m_pName + '">';
			string += '<input type="hidden" name="iPrice" value="' + m_iPrice + '">';
            string += '<input type="hidden" name="terms" value=\'' + JSON.stringify(params) + '\'>';
            
            form.innerHTML = string;
//          console.log(string);
            document.body.appendChild(form);
            $(form).submit();
        }
    };
    evaluate.initDom();
});
