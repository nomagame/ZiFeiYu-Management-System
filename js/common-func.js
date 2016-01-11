function setCookie(a, b, c, d, e) {
	var f = new Date;
	f.setDate(f.getDate() + c);
	document.cookie = a + "=" + escape(b) + (null == c ? "" : ";expires=" + f.toGMTString()) + (d  ==  null ? "" : ";path=" + d) + (e  ==  null ? "" : ";domain=" + e);
}
/////////////////
function getCookie(a) {
	return 0 < document.cookie.length && (c_start = document.cookie.indexOf(a + "="), -1 != c_start) ? (c_start = c_start + a.length + 1, c_end = document.cookie.indexOf(";", c_start), -1 == c_end && (c_end = document.cookie.length), unescape(document.cookie.substring(c_start, c_end))) : ""
}
/////////////////
function checkCookie(a, b, c) {
	c_value = getCookie(a);
	if (null != c_value && "" != c_value) return c_value;
	setCookie(a, b, c);
	return b
}
/////////////////
function updateTips(t, o) {
	o = o ? o : '#Tips';
	$(o).html(t).addClass("ui-state-highlight");
	setTimeout(function() {
		$(o).removeClass("ui-state-highlight", 1500)
	}, 500)
}
//////////////////
function checkLength(o, n, min, max, t) {
	if (o.val().length > max || o.val().length < min) {
		o.addClass("ui-state-error").focus();
		updateTips( n + " 长度范围必须在 " + min + " 和 " + max + " 之间.", t);
		return false
	} else {
		return true
	}
}
//////////////////
function checkRegexp(o, regexp, n, t) {
	if (!(regexp.test(o.val()))) {
		o.addClass("ui-state-error").focus();
		updateTips(n, t);
		return false
	} else {
		return true
	}
}
//////////////////
function codecharu(a, b) {
	if (document.selection) a.focus(), document.selection.createRange().text = b;
	else if ("number" === typeof a.selectionStart && "number" === typeof a.selectionEnd) {
		var d = a.selectionEnd,
			c = a.value;
		a.value = c.substring(0, a.selectionStart) + b + c.substring(d, c.length)
	} else a.value += b
}
//////////////////
function htmlspecialchars(a) {
	a = a.replace(/&/img, '&amp;');
	a = a.replace(/"/img, '&quot;');
	a = a.replace(/'/img, '&#039;');
	a = a.replace(/</img, '&lt;');
	a = a.replace(/>/img, '&gt;');
	return a
}