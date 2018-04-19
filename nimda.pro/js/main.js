function getcss(e) {
    var t = document.createElement("link");
    t.setAttribute("type", "text/css"), t.setAttribute("rel", "stylesheet"), t.setAttribute("href", e), document.getElementsByTagName("head").item(0).appendChild(t)
}
function cp(e, t, o) {
    var n = "clck/lid=" + e;
    Lego.params.statRoot && (n += "/sid=" + Lego.params.msid);
    try {
        Lego.c(n, t, o)
    } catch (i) {
    }
}
function cpr(e, t, o) {
    try {
        Lego.cred(e, t, o)
    } catch (n) {
    }
}
!function (e) {
    e.getData = function (t, o) {
        var n, i, r, c, a = "export", f = t.split("."), m = f.length;
        if (m > 1) {
            for (i = e[a] || {}, r = 0; m > r; r++)if (n = f[r], i = i[n], "undefined" == typeof i)return "undefined" == typeof i ? o : i;
            return "undefined" == typeof i ? o : i
        }
        return a = "export", c = e && e[a] && e[a][t], "undefined" == typeof c ? o : c
    }
}(home), function () {
    "undefined" != typeof home && (home.lang = {}, home.l10n = function (e) {
        return x.query(e, home.lang) || ""
    })
}(), function (e) {
    function t(e) {
        return e.replace(/^[\w\W]*.yandex./, "")
    }

    e.c = function (e, o, n) {
        var i, r = "yandex." + t(location.host) + "/clck", c = function (e, t, o, n) {
            return t = t.replace("'", "%27"), t.indexOf("/dtype=") > -1 ? t : location.protocol + "//" + r + "/" + o + "/dtype=" + e + "/rnd=" + ((new Date).getTime() + Math.round(100 * Math.random())) + (n ? "/*" + (t.match(/^http/) ? t : location.protocol + "//" + location.host + (t.match("^/") ? t : "/" + t)) : "/*data=" + encodeURIComponent("url=" + encodeURIComponent(t.match(/^http/) ? t : location.protocol + "//" + location.host + (t.match("^/") ? t : "/" + t))))
        }, a = function () {
            var t = document.getElementsByTagName("head")[0] || document.getElementsByTagName("body")[0], o = document.createElement("script");
            o.setAttribute("src", c(e, location.href, "jclck")), t.insertBefore(o, t.firstChild)
        };
        if (o)if (o.className.match(/b-link_pseudo_yes/) || o.href && o.href.match(/^mailto:/) || n && n.noRedirect === !0)a(); else if (o.href)i = o.href, o.href = c(e, i, "redir"), setTimeout(function () {
            o.href = i
        }, 500); else if (o.form)o.type.match(/submit|button|image/) ? (i = o.form.action, o.form.action = c(e, i, "redir", !0), setTimeout(function () {
            o.form.action = i
        }, 500)) : a(); else {
            if (!o.action)throw"counter.js: not link and not form!";
            o.action = c(e, o.action, "redir", !0)
        } else a()
    }, e.cred = function (e, t, o) {
        var n, i = function () {
            var t = document.getElementsByTagName("head")[0] || document.getElementsByTagName("body")[0], o = document.createElement("script");
            o.setAttribute("src", e), t.insertBefore(o, t.firstChild)
        };
        if (t)if (t.className.match(/b-link_pseudo_yes/) || t.href && t.href.match(/^mailto:/) || o && o.noRedirect === !0)i(); else if (t.href)n = t.href, t.href = e, setTimeout(function () {
            t.href = n
        }, 500); else if (t.form)t.type.match(/submit|button|image/) ? (n = t.form.action, t.form.action = e, setTimeout(function () {
            t.form.action = n
        }, 500)) : i(); else {
            if (!t.action)throw"counter.js: not link and not form!";
            t.action = e
        } else i()
    }
}(window.Lego);