(function() {
    function $getCookie(name) {
        var reg = new RegExp("(^| )" + name + "(?:=([^;]*))?(;|$)"),
            val = document.cookie.match(reg);
        return val ? (val[2] ? unescape(val[2]) : "") : null;
    }

    function $setCookie(name, value, expires, path, domain, secure) {
        var exp = new Date(),
            expires = arguments[2] || null,
            path = arguments[3] || "/",
            domain = arguments[4] || null,
            secure = arguments[5] || false;
        expires ? exp.setMinutes(exp.getMinutes() + parseInt(expires)) : "";
        document.cookie = name + '=' + escape(value) + (expires ? ';expires=' + exp.toGMTString() : '') + (path ? ';path=' + path : '') + (domain ? ';domain=' + domain : '') + (secure ? ';secure' : '');
    }

    function $getQuery(name, url) {
        var u = arguments[1] || window.location.search,
            reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"),
            r = u.substr(u.indexOf("\?") + 1).match(reg);
        return r != null ? r[2] : "";
    }

    function report(arr4) {
        var img = new Image;
        var ssid = $getCookie('ssid');
        ssid = ssid || makessid();
        $setCookie('ssid', ssid, 43200, '/', '.huishoubao.com');
        var arr0 = wrap(location.host.split('.').reverse(), 'host');
        var arr1 = wrap(location.pathname.split('/'), 'path');
        var arr2 = location.search.replace(/^\?/, '').split('&');
        var arr3 = ['ssid=' + ssid, 'referrer=' + encodeURIComponent(document.referer || document.referrer)];
        var tmp = arr0.concat(arr1).concat(arr2).concat(arr3).concat(arr4 || []);
        var params = [];
        for (var i = 0; i < tmp.length; i++) {
            if (tmp[i]) {
                params.push(tmp[i])
            }
        }
        img.src = '//ping.huishoubao.com/ping.css?' + params.join('_&_');
    }

    function wrap(arr, pre) {
        for (var i = 0; i < arr.length; i++) {
            arr[i] = pre + i + '=' + arr[i];
        }
        return arr;
    }

    function makessid() {
        var ssid = '';
        do {
            ssid += Math.random().toString(36).slice(2);
        } while (ssid.length < 32);
        return ssid.slice(-32);
    }
    setTimeout(report, 3000);
})();