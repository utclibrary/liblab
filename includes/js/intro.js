!function(t) {
    if ("object" == typeof exports && "undefined" != typeof module)
        module.exports = t(),
        module.exports.introJs = function() {
            return console.warn('Deprecated: please use require("intro.js") directly, instead of the introJs method of the function'),
            t().apply(this, arguments)
        }
        ;
    else if ("function" == typeof define && define.amd)
        define([], t);
    else {
        ("undefined" != typeof window ? window : "undefined" != typeof global ? global : "undefined" != typeof self ? self : this).introJs = t()
    }
}(function() {
    function n(t) {
        this._targetElement = t,
        this._introItems = [],
        this._options = {
            nextLabel: '<span class="fas fa-arrow-right" aria-label="next"></span>',
            prevLabel: '<span class="fas fa-arrow-left" aria-label="back"></span>',
            skipLabel: "Exit",
            doneLabel: "Done",
            hidePrev: !1,
            hideNext: !1,
            tooltipPosition: "bottom",
            tooltipClass: "",
            highlightClass: "",
            exitOnEsc: !0,
            exitOnOverlayClick: !0,
            showStepNumbers: !0,
            keyboardNavigation: !0,
            showButtons: !0,
            showBullets: !0,
            showProgress: !1,
            scrollToElement: !0,
            scrollTo: "element",
            scrollPadding: 30,
            overlayOpacity: .8,
            positionPrecedence: ["bottom", "top", "right", "left"],
            disableInteraction: !1,
            helperElementPadding: 10,
            hintPosition: "top-middle",
            hintButtonLabel: "Got it",
            hintAnimation: !0,
            buttonClass: "introjs-button"
        }
    }
    function e(t, i) {
        var e = t.querySelectorAll("*[data-intro]")
          , n = [];
        if (this._options.steps)
            B(this._options.steps, function(t) {
                var e = h(t);
                if (e.step = n.length + 1,
                "string" == typeof e.element && (e.element = document.querySelector(e.element)),
                void 0 === e.element || null === e.element) {
                    var i = document.querySelector(".introjsFloatingElement");
                    null === i && ((i = document.createElement("div")).className = "introjsFloatingElement",
                    document.body.appendChild(i)),
                    e.element = i,
                    e.position = "floating"
                }
                e.scrollTo = e.scrollTo || this._options.scrollTo,
                void 0 === e.disableInteraction && (e.disableInteraction = this._options.disableInteraction),
                null !== e.element && n.push(e)
            }
            .bind(this));
        else {
            var o;
            if (e.length < 1)
                return !1;
            B(e, function(t) {
                if ((!i || t.getAttribute("data-intro-group") === i) && "none" !== t.style.display) {
                    var e = parseInt(t.getAttribute("data-step"), 10);
                    o = void 0 !== t.getAttribute("data-disable-interaction") ? !!t.getAttribute("data-disable-interaction") : this._options.disableInteraction,
                    0 < e && (n[e - 1] = {
                        element: t,
                        intro: t.getAttribute("data-intro"),
                        step: parseInt(t.getAttribute("data-step"), 10),
                        tooltipClass: t.getAttribute("data-tooltipclass"),
                        highlightClass: t.getAttribute("data-highlightclass"),
                        position: t.getAttribute("data-position") || this._options.tooltipPosition,
                        scrollTo: t.getAttribute("data-scrollto") || this._options.scrollTo,
                        disableInteraction: o
                    })
                }
            }
            .bind(this));
            var s = 0;
            B(e, function(t) {
                if ((!i || t.getAttribute("data-intro-group") === i) && null === t.getAttribute("data-step")) {
                    for (; void 0 !== n[s]; )
                        s++;
                    o = void 0 !== t.getAttribute("data-disable-interaction") ? !!t.getAttribute("data-disable-interaction") : this._options.disableInteraction,
                    n[s] = {
                        element: t,
                        intro: t.getAttribute("data-intro"),
                        step: s + 1,
                        tooltipClass: t.getAttribute("data-tooltipclass"),
                        highlightClass: t.getAttribute("data-highlightclass"),
                        position: t.getAttribute("data-position") || this._options.tooltipPosition,
                        scrollTo: t.getAttribute("data-scrollto") || this._options.scrollTo,
                        disableInteraction: o
                    }
                }
            }
            .bind(this))
        }
        for (var l = [], r = 0; r < n.length; r++)
            n[r] && l.push(n[r]);
        return (n = l).sort(function(t, e) {
            return t.step - e.step
        }),
        this._introItems = n,
        function(t) {
            var e = document.createElement("div")
              , i = ""
              , n = this;
            if (e.className = "introjs-overlay",
            t.tagName && "body" !== t.tagName.toLowerCase()) {
                var o = k(t);
                o && (i += "width: " + o.width + "px; height:" + o.height + "px; top:" + o.top + "px;left: " + o.left + "px;",
                e.style.cssText = i)
            } else
                i += "top: 0;bottom: 0; left: 0;right: 0;position: fixed;",
                e.style.cssText = i;
            return t.appendChild(e),
            e.onclick = function() {
                !0 === n._options.exitOnOverlayClick && A.call(n, t)
            }
            ,
            window.setTimeout(function() {
                i += "opacity: " + n._options.overlayOpacity.toString() + ";",
                e.style.cssText = i
            }, 10),
            !0
        }
        .call(this, t) && (E.call(this),
        this._options.keyboardNavigation && u.on(window, "keydown", c, this, !0),
        u.on(window, "resize", a, this, !0)),
        !1
    }
    function a() {
        this.refresh.call(this)
    }
    function c(t) {
        var e = null === t.code ? t.which : t.code;
        if (null === e && (e = null === t.charCode ? t.keyCode : t.charCode),
        "Escape" !== e && 27 !== e || !0 !== this._options.exitOnEsc) {
            if ("ArrowLeft" === e || 37 === e)
                N.call(this);
            else if ("ArrowRight" === e || 39 === e)
                E.call(this);
            else if ("Enter" === e || 13 === e) {
                var i = t.target || t.srcElement;
                i && i.className.match("introjs-prevbutton") ? N.call(this) : i && i.className.match("introjs-skipbutton") ? (this._introItems.length - 1 === this._currentStep && "function" == typeof this._introCompleteCallback && this._introCompleteCallback.call(this),
                A.call(this, this._targetElement)) : i && i.getAttribute("data-stepnumber") ? i.click() : E.call(this),
                t.preventDefault ? t.preventDefault() : t.returnValue = !1
            }
        } else
            A.call(this, this._targetElement)
    }
    function h(t) {
        if (null === t || "object" != typeof t || void 0 !== t.nodeType)
            return t;
        var e = {};
        for (var i in t)
            void 0 !== window.jQuery && t[i]instanceof window.jQuery ? e[i] = t[i] : e[i] = h(t[i]);
        return e
    }
    function E() {
        this._direction = "forward",
        void 0 !== this._currentStepNumber && B(this._introItems, function(t, e) {
            t.step === this._currentStepNumber && (this._currentStep = e - 1,
            this._currentStepNumber = void 0)
        }
        .bind(this)),
        void 0 === this._currentStep ? this._currentStep = 0 : ++this._currentStep;
        var t = this._introItems[this._currentStep]
          , e = !0;
        return void 0 !== this._introBeforeChangeCallback && (e = this._introBeforeChangeCallback.call(this, t.element)),
        !1 === e ? (--this._currentStep,
        !1) : this._introItems.length <= this._currentStep ? ("function" == typeof this._introCompleteCallback && this._introCompleteCallback.call(this),
        void A.call(this, this._targetElement)) : void i.call(this, t)
    }
    function N() {
        if (this._direction = "backward",
        0 === this._currentStep)
            return !1;
        --this._currentStep;
        var t = this._introItems[this._currentStep]
          , e = !0;
        if (void 0 !== this._introBeforeChangeCallback && (e = this._introBeforeChangeCallback.call(this, t.element)),
        !1 === e)
            return ++this._currentStep,
            !1;
        i.call(this, t)
    }
    function A(t, e) {
        var i = !0;
        if (void 0 !== this._introBeforeExitCallback && (i = this._introBeforeExitCallback.call(this)),
        e || !1 !== i) {
            var n = t.querySelectorAll(".introjs-overlay");
            n && n.length && B(n, function(t) {
                t.style.opacity = 0,
                window.setTimeout(function() {
                    this.parentNode && this.parentNode.removeChild(this)
                }
                .bind(t), 500)
            }
            .bind(this));
            var o = t.querySelector(".introjs-helperLayer");
            o && o.parentNode.removeChild(o);
            var s = t.querySelector(".introjs-tooltipReferenceLayer");
            s && s.parentNode.removeChild(s);
            var l = t.querySelector(".introjs-disableInteraction");
            l && l.parentNode.removeChild(l);
            var r = document.querySelector(".introjsFloatingElement");
            r && r.parentNode.removeChild(r),
            q(),
            B(document.querySelectorAll(".introjs-fixParent"), function(t) {
                O(t, /introjs-fixParent/g)
            }),
            u.off(window, "keydown", c, this, !0),
            u.off(window, "resize", a, this, !0),
            void 0 !== this._introExitCallback && this._introExitCallback.call(this),
            this._currentStep = void 0
        }
    }
    function L(t, e, i, n, o) {
        var s, l, r, a, c, h = "";
        if (o = o || !1,
        e.style.top = null,
        e.style.right = null,
        e.style.bottom = null,
        e.style.left = null,
        e.style.marginLeft = null,
        e.style.marginTop = null,
        i.style.display = "inherit",
        null != n && (n.style.top = null,
        n.style.left = null),
        this._introItems[this._currentStep])
            switch (h = "string" == typeof (s = this._introItems[this._currentStep]).tooltipClass ? s.tooltipClass : this._options.tooltipClass,
            e.className = ("introjs-tooltip " + h).replace(/^\s+|\s+$/g, ""),
            e.setAttribute("role", "dialog"),
            "floating" !== (c = this._introItems[this._currentStep].position) && (c = function(t, e, i) {
                var n = this._options.positionPrecedence.slice()
                  , o = b()
                  , s = k(e).height + 10
                  , l = k(e).width + 20
                  , r = t.getBoundingClientRect()
                  , a = "floating";
                r.bottom + s + s > o.height && m(n, "bottom");
                r.top - s < 0 && m(n, "top");
                r.right + l > o.width && m(n, "right");
                r.left - l < 0 && m(n, "left");
                var c = (h = i || "",
                u = h.indexOf("-"),
                -1 !== u ? h.substr(u) : "");
                var h, u;
                i && (i = i.split("-")[0]);
                n.length && (a = "auto" !== i && -1 < n.indexOf(i) ? i : n[0]);
                -1 !== ["top", "bottom"].indexOf(a) && (a += function(t, e, i, n) {
                    var o = e / 2
                      , s = Math.min(i.width, window.screen.width)
                      , l = ["-left-aligned", "-middle-aligned", "-right-aligned"]
                      , r = "";
                    s - t < e && m(l, "-left-aligned");
                    (t < o || s - t < o) && m(l, "-middle-aligned");
                    t < e && m(l, "-right-aligned");
                    r = l.length ? -1 !== l.indexOf(n) ? n : l[0] : "-middle-aligned";
                    return r
                }(r.left, l, o, c));
                return a
            }
            .call(this, t, e, c)),
            r = k(t),
            l = k(e),
            a = b(),
            H(e, "introjs-" + c),
            c) {
            case "top-right-aligned":
                i.className = "introjs-arrow bottom-right";
                var u = 0;
                f(r, u, l, e),
                e.style.bottom = r.height + 20 + "px";
                break;
            case "top-middle-aligned":
                i.className = "introjs-arrow bottom-middle";
                var d = r.width / 2 - l.width / 2;
                o && (d += 5),
                f(r, d, l, e) && (e.style.right = null,
                p(r, d, l, a, e)),
                e.style.bottom = r.height + 20 + "px";
                break;
            case "top-left-aligned":
            case "top":
                i.className = "introjs-arrow bottom",
                p(r, o ? 0 : 15, l, a, e),
                e.style.bottom = r.height + 20 + "px";
                break;
            case "right":
                e.style.left = r.width + 20 + "px",
                r.top + l.height > a.height ? (i.className = "introjs-arrow left-bottom",
                e.style.top = "-" + (l.height - r.height - 20) + "px") : i.className = "introjs-arrow left";
                break;
            case "left":
                o || !0 !== this._options.showStepNumbers || (e.style.top = "15px"),
                r.top + l.height > a.height ? (e.style.top = "-" + (l.height - r.height - 20) + "px",
                i.className = "introjs-arrow right-bottom") : i.className = "introjs-arrow right",
                e.style.right = r.width + 20 + "px";
                break;
            case "floating":
                i.style.display = "none",
                e.style.left = "50%",
                e.style.top = "50%",
                e.style.marginLeft = "-" + l.width / 2 + "px",
                e.style.marginTop = "-" + l.height / 2 + "px",
                null != n && (n.style.left = "-" + (l.width / 2 + 18) + "px",
                n.style.top = "-" + (l.height / 2 + 18) + "px");
                break;
            case "bottom-right-aligned":
                i.className = "introjs-arrow top-right",
                f(r, u = 0, l, e),
                e.style.top = r.height + 20 + "px";
                break;
            case "bottom-middle-aligned":
                i.className = "introjs-arrow top-middle",
                d = r.width / 2 - l.width / 2,
                o && (d += 5),
                f(r, d, l, e) && (e.style.right = null,
                p(r, d, l, a, e)),
                e.style.top = r.height + 20 + "px";
                break;
            default:
                i.className = "introjs-arrow top",
                p(r, 0, l, a, e),
                e.style.top = r.height + 20 + "px"
            }
    }
    function p(t, e, i, n, o) {
        return t.left + e + i.width > n.width ? (o.style.left = n.width - i.width - t.left + "px",
        !1) : (o.style.left = e + "px",
        !0)
    }
    function f(t, e, i, n) {
        return t.left + t.width - e - i.width < 0 ? (n.style.left = -t.left + "px",
        !1) : (n.style.right = e + "px",
        !0)
    }
    function m(t, e) {
        -1 < t.indexOf(e) && t.splice(t.indexOf(e), 1)
    }
    function T(t) {
        if (t) {
            if (!this._introItems[this._currentStep])
                return;
            var e = this._introItems[this._currentStep]
              , i = k(e.element)
              , n = this._options.helperElementPadding;
            d(e.element) ? H(t, "introjs-fixedTooltip") : O(t, "introjs-fixedTooltip"),
            "floating" === e.position && (n = 0),
            t.style.cssText = "width: " + (i.width + n) + "px; height:" + (i.height + n) + "px; top:" + (i.top - n / 2) + "px;left: " + (i.left - n / 2) + "px;"
        }
    }
    function I(t) {
        t.setAttribute("role", "button"),
        t.tabIndex = 0
    }
    function i(o) {
        void 0 !== this._introChangeCallback && this._introChangeCallback.call(this, o.element);
        var t, e, i, n, s = this, l = document.querySelector(".introjs-helperLayer"), r = document.querySelector(".introjs-tooltipReferenceLayer"), a = "introjs-helperLayer";
        if ("string" == typeof o.highlightClass && (a += " " + o.highlightClass),
        "string" == typeof this._options.highlightClass && (a += " " + this._options.highlightClass),
        null !== l) {
            var c = r.querySelector(".introjs-helperNumberLayer")
              , h = r.querySelector(".introjs-tooltiptext")
              , u = r.querySelector(".introjs-arrow")
              , d = r.querySelector(".introjs-tooltip");
            if (i = r.querySelector(".introjs-skipbutton"),
            e = r.querySelector(".introjs-prevbutton"),
            t = r.querySelector(".introjs-nextbutton"),
            l.className = a,
            d.style.opacity = 0,
            d.style.display = "none",
            null !== c) {
                var p = this._introItems[0 <= o.step - 2 ? o.step - 2 : 0];
                (null !== p && "forward" === this._direction && "floating" === p.position || "backward" === this._direction && "floating" === o.position) && (c.style.opacity = 0)
            }
            (n = R(o.element)) !== document.body && V(n, o.element),
            T.call(s, l),
            T.call(s, r),
            B(document.querySelectorAll(".introjs-fixParent"), function(t) {
                O(t, /introjs-fixParent/g)
            }),
            q(),
            s._lastShowElementTimer && window.clearTimeout(s._lastShowElementTimer),
            s._lastShowElementTimer = window.setTimeout(function() {
                null !== c && (c.innerHTML = o.step),
                h.innerHTML = o.intro,
                d.style.display = "block",
                L.call(s, o.element, d, u, c),
                s._options.showBullets && (r.querySelector(".introjs-bullets li > a.active").className = "",
                r.querySelector('.introjs-bullets li > a[data-stepnumber="' + o.step + '"]').className = "active"),
                r.querySelector(".introjs-progress .introjs-progressbar").style.cssText = "width:" + z.call(s) + "%;",
                r.querySelector(".introjs-progress .introjs-progressbar").setAttribute("aria-valuenow", z.call(s)),
                d.style.opacity = 1,
                c && (c.style.opacity = 1),
                null != i && /introjs-donebutton/gi.test(i.className) ? i.focus() : null != t && t.focus(),
                P.call(s, o.scrollTo, o, h)
            }, 350)
        } else {
            var f = document.createElement("div")
              , m = document.createElement("div")
              , b = document.createElement("div")
              , g = document.createElement("div")
              , y = document.createElement("div")
              , v = document.createElement("div")
              , _ = document.createElement("div")
              , w = document.createElement("div");
            f.className = a,
            m.className = "introjs-tooltipReferenceLayer",
            (n = R(o.element)) !== document.body && V(n, o.element),
            T.call(s, f),
            T.call(s, m),
            this._targetElement.appendChild(f),
            this._targetElement.appendChild(m),
            b.className = "introjs-arrow",
            y.className = "introjs-tooltiptext",
            y.innerHTML = o.intro,
            !(v.className = "introjs-bullets") === this._options.showBullets && (v.style.display = "none");
            var C = document.createElement("ul");
            C.setAttribute("role", "tablist");
            var j = function() {
                s.goToStep(this.getAttribute("data-stepnumber"))
            };
            B(this._introItems, function(t, e) {
                var i = document.createElement("li")
                  , n = document.createElement("a");
                i.setAttribute("role", "presentation"),
                n.setAttribute("role", "tab"),
                n.onclick = j,
                e === o.step - 1 && (n.className = "active"),
                I(n),
                n.innerHTML = "&nbsp;",
                n.setAttribute("data-stepnumber", t.step),
                i.appendChild(n),
                C.appendChild(i)
            }),
            v.appendChild(C),
            !(_.className = "introjs-progress") === this._options.showProgress && (_.style.display = "none");
            var k = document.createElement("div");
            k.className = "introjs-progressbar",
            k.setAttribute("role", "progress"),
            k.setAttribute("aria-valuemin", 0),
            k.setAttribute("aria-valuemax", 100),
            k.setAttribute("aria-valuenow", z.call(this)),
            k.style.cssText = "width:" + z.call(this) + "%;",
            _.appendChild(k),
            !(w.className = "introjs-tooltipbuttons") === this._options.showButtons && (w.style.display = "none"),
            g.className = "introjs-tooltip",
            g.appendChild(y),
            g.appendChild(v),
            g.appendChild(_);
            var x = document.createElement("span");
            !0 === this._options.showStepNumbers && (x.className = "introjs-helperNumberLayer",
            x.innerHTML = o.step,
            m.appendChild(x)),
            g.appendChild(b),
            m.appendChild(g),
            (t = document.createElement("a")).onclick = function() {
                s._introItems.length - 1 !== s._currentStep && E.call(s)
            }
            ,
            I(t),
            t.innerHTML = this._options.nextLabel,
            (e = document.createElement("a")).onclick = function() {
                0 !== s._currentStep && N.call(s)
            }
            ,
            I(e),
            e.innerHTML = this._options.prevLabel,
            (i = document.createElement("a")).className = this._options.buttonClass + " introjs-skipbutton ",
            I(i),
            i.innerHTML = this._options.skipLabel,
            i.onclick = function() {
                s._introItems.length - 1 === s._currentStep && "function" == typeof s._introCompleteCallback && s._introCompleteCallback.call(s),
                s._introItems.length - 1 !== s._currentStep && "function" == typeof s._introExitCallback && s._introExitCallback.call(s),
                "function" == typeof s._introSkipCallback && s._introSkipCallback.call(s),
                A.call(s, s._targetElement)
            }
            ,
            w.appendChild(i),
            1 < this._introItems.length && (w.appendChild(e),
            w.appendChild(t)),
            g.appendChild(w),
            L.call(s, o.element, g, b, x),
            P.call(this, o.scrollTo, o, g)
        }
        var S = s._targetElement.querySelector(".introjs-disableInteraction");
        S && S.parentNode.removeChild(S),
        o.disableInteraction && function() {
            var t = document.querySelector(".introjs-disableInteraction");
            null === t && ((t = document.createElement("div")).className = "introjs-disableInteraction",
            this._targetElement.appendChild(t)),
            T.call(this, t)
        }
        .call(s),
        0 === this._currentStep && 1 < this._introItems.length ? (null != i && (i.className = this._options.buttonClass + " introjs-skipbutton"),
        null != t && (t.className = this._options.buttonClass + " introjs-nextbutton"),
        !0 === this._options.hidePrev ? (null != e && (e.className = this._options.buttonClass + " introjs-prevbutton introjs-hidden"),
        null != t && H(t, "introjs-fullbutton")) : null != e && (e.className = this._options.buttonClass + " introjs-prevbutton introjs-disabled"),
        null != i && (i.innerHTML = this._options.skipLabel)) : this._introItems.length - 1 === this._currentStep || 1 === this._introItems.length ? (null != i && (i.innerHTML = this._options.doneLabel,
        H(i, "introjs-donebutton")),
        null != e && (e.className = this._options.buttonClass + " introjs-prevbutton"),
        !0 === this._options.hideNext ? (null != t && (t.className = this._options.buttonClass + " introjs-nextbutton introjs-hidden"),
        null != e && H(e, "introjs-fullbutton")) : null != t && (t.className = this._options.buttonClass + " introjs-nextbutton introjs-disabled")) : (null != i && (i.className = this._options.buttonClass + " introjs-skipbutton"),
        null != e && (e.className = this._options.buttonClass + " introjs-prevbutton"),
        null != t && (t.className = this._options.buttonClass + " introjs-nextbutton"),
        null != i && (i.innerHTML = this._options.skipLabel)),
        e.setAttribute("role", "button"),
        t.setAttribute("role", "button"),
        i.setAttribute("role", "button"),
        null != t && t.focus(),
        function(t) {
            var e;
            if (t.element instanceof SVGElement)
                for (e = t.element.parentNode; null !== t.element.parentNode && e.tagName && "body" !== e.tagName.toLowerCase(); )
                    "svg" === e.tagName.toLowerCase() && H(e, "introjs-showElement introjs-relativePosition"),
                    e = e.parentNode;
            H(t.element, "introjs-showElement");
            var i = M(t.element, "position");
            "absolute" !== i && "relative" !== i && "fixed" !== i && H(t.element, "introjs-relativePosition");
            e = t.element.parentNode;
            for (; null !== e && e.tagName && "body" !== e.tagName.toLowerCase(); ) {
                var n = M(e, "z-index")
                  , o = parseFloat(M(e, "opacity"))
                  , s = M(e, "transform") || M(e, "-webkit-transform") || M(e, "-moz-transform") || M(e, "-ms-transform") || M(e, "-o-transform");
                (/[0-9]+/.test(n) || o < 1 || "none" !== s && void 0 !== s) && H(e, "introjs-fixParent"),
                e = e.parentNode
            }
        }(o),
        void 0 !== this._introAfterChangeCallback && this._introAfterChangeCallback.call(this, o.element)
    }
    function P(t, e, i) {
        var n, o, s;
        if ("off" !== t && (this._options.scrollToElement && (n = "tooltip" === t ? i.getBoundingClientRect() : e.element.getBoundingClientRect(),
        o = e.element,
        !(0 <= (s = o.getBoundingClientRect()).top && 0 <= s.left && s.bottom + 80 <= window.innerHeight && s.right <= window.innerWidth)))) {
            var l = b().height;
            n.bottom - (n.bottom - n.top) < 0 || e.element.clientHeight > l ? window.scrollBy(0, n.top - (l / 2 - n.height / 2) - this._options.scrollPadding) : window.scrollBy(0, n.top - (l / 2 - n.height / 2) + this._options.scrollPadding)
        }
    }
    function q() {
        B(document.querySelectorAll(".introjs-showElement"), function(t) {
            O(t, /introjs-[a-zA-Z]+/g)
        })
    }
    function B(t, e, i) {
        if (t)
            for (var n = 0, o = t.length; n < o; n++)
                e(t[n], n);
        "function" == typeof i && i()
    }
    var o, s = (o = {},
    function(t, e) {
        return o[e = e || "introjs-stamp"] = o[e] || 0,
        void 0 === t[e] && (t[e] = o[e]++),
        t[e]
    }
    ), u = new function() {
        var r = "introjs_event";
        this._id = function(t, e, i, n) {
            return e + s(i) + (n ? "_" + s(n) : "")
        }
        ,
        this.on = function(e, t, i, n, o) {
            var s = this._id.apply(this, arguments)
              , l = function(t) {
                return i.call(n || e, t || window.event)
            };
            "addEventListener"in e ? e.addEventListener(t, l, o) : "attachEvent"in e && e.attachEvent("on" + t, l),
            e[r] = e[r] || {},
            e[r][s] = l
        }
        ,
        this.off = function(t, e, i, n, o) {
            var s = this._id.apply(this, arguments)
              , l = t[r] && t[r][s];
            l && ("removeEventListener"in t ? t.removeEventListener(e, l, o) : "detachEvent"in t && t.detachEvent("on" + e, l),
            t[r][s] = null)
        }
    }
    ;
    function H(e, t) {
        if (e instanceof SVGElement) {
            var i = e.getAttribute("class") || "";
            e.setAttribute("class", i + " " + t)
        } else {
            if (void 0 !== e.classList)
                B(t.split(" "), function(t) {
                    e.classList.add(t)
                });
            else
                e.className.match(t) || (e.className += " " + t)
        }
    }
    function O(t, e) {
        if (t instanceof SVGElement) {
            var i = t.getAttribute("class") || "";
            t.setAttribute("class", i.replace(e, "").replace(/^\s+|\s+$/g, ""))
        } else
            t.className = t.className.replace(e, "").replace(/^\s+|\s+$/g, "")
    }
    function M(t, e) {
        var i = "";
        return t.currentStyle ? i = t.currentStyle[e] : document.defaultView && document.defaultView.getComputedStyle && (i = document.defaultView.getComputedStyle(t, null).getPropertyValue(e)),
        i && i.toLowerCase ? i.toLowerCase() : i
    }
    function d(t) {
        var e = t.parentNode;
        return !(!e || "HTML" === e.nodeName) && ("fixed" === M(t, "position") || d(e))
    }
    function b() {
        if (void 0 !== window.innerWidth)
            return {
                width: window.innerWidth,
                height: window.innerHeight
            };
        var t = document.documentElement;
        return {
            width: t.clientWidth,
            height: t.clientHeight
        }
    }
    function g() {
        var t = document.querySelector(".introjs-hintReference");
        if (t) {
            var e = t.getAttribute("data-step");
            return t.parentNode.removeChild(t),
            e
        }
    }
    function l(t) {
        if (this._introItems = [],
        this._options.hints)
            B(this._options.hints, function(t) {
                var e = h(t);
                "string" == typeof e.element && (e.element = document.querySelector(e.element)),
                e.hintPosition = e.hintPosition || this._options.hintPosition,
                e.hintAnimation = e.hintAnimation || this._options.hintAnimation,
                null !== e.element && this._introItems.push(e)
            }
            .bind(this));
        else {
            var e = t.querySelectorAll("*[data-hint]");
            if (!e || !e.length)
                return !1;
            B(e, function(t) {
                var e = t.getAttribute("data-hintanimation");
                e = e ? "true" === e : this._options.hintAnimation,
                this._introItems.push({
                    element: t,
                    hint: t.getAttribute("data-hint"),
                    hintPosition: t.getAttribute("data-hintposition") || this._options.hintPosition,
                    hintAnimation: e,
                    tooltipClass: t.getAttribute("data-tooltipclass"),
                    position: t.getAttribute("data-position") || this._options.tooltipPosition
                })
            }
            .bind(this))
        }
        (function() {
            var l = this
              , r = document.querySelector(".introjs-hints");
            null === r && ((r = document.createElement("div")).className = "introjs-hints");
            B(this._introItems, function(t, e) {
                if (!document.querySelector('.introjs-hint[data-step="' + e + '"]')) {
                    var i, n = document.createElement("a");
                    I(n),
                    n.onclick = (i = e,
                    function(t) {
                        var e = t || window.event;
                        e.stopPropagation && e.stopPropagation(),
                        null !== e.cancelBubble && (e.cancelBubble = !0),
                        j.call(l, i)
                    }
                    ),
                    n.className = "introjs-hint",
                    t.hintAnimation || H(n, "introjs-hint-no-anim"),
                    d(t.element) && H(n, "introjs-fixedhint");
                    var o = document.createElement("div");
                    o.className = "introjs-hint-dot";
                    var s = document.createElement("div");
                    s.className = "introjs-hint-pulse",
                    n.appendChild(o),
                    n.appendChild(s),
                    n.setAttribute("data-step", e),
                    t.targetElement = t.element,
                    t.element = n,
                    C.call(this, t.hintPosition, n, t.targetElement),
                    r.appendChild(n)
                }
            }
            .bind(this)),
            document.body.appendChild(r),
            void 0 !== this._hintsAddedCallback && this._hintsAddedCallback.call(this)
        }
        ).call(this),
        u.on(document, "click", g, this, !1),
        u.on(window, "resize", r, this, !0)
    }
    function r() {
        B(this._introItems, function(t) {
            void 0 !== t.targetElement && C.call(this, t.hintPosition, t.element, t.targetElement)
        }
        .bind(this))
    }
    function y(t) {
        var e = document.querySelector(".introjs-hints");
        return e ? e.querySelectorAll(t) : []
    }
    function v(t) {
        var e = y('.introjs-hint[data-step="' + t + '"]')[0];
        g.call(this),
        e && H(e, "introjs-hidehint"),
        void 0 !== this._hintCloseCallback && this._hintCloseCallback.call(this, t)
    }
    function _(t) {
        var e = y('.introjs-hint[data-step="' + t + '"]')[0];
        e && O(e, /introjs-hidehint/g)
    }
    function w(t) {
        var e = y('.introjs-hint[data-step="' + t + '"]')[0];
        e && e.parentNode.removeChild(e)
    }
    function C(t, e, i) {
        var n = k.call(this, i);
        switch (t) {
        default:
        case "top-left":
            e.style.left = n.left + "px",
            e.style.top = n.top + "px";
            break;
        case "top-right":
            e.style.left = n.left + n.width - 20 + "px",
            e.style.top = n.top + "px";
            break;
        case "bottom-left":
            e.style.left = n.left + "px",
            e.style.top = n.top + n.height - 20 + "px";
            break;
        case "bottom-right":
            e.style.left = n.left + n.width - 20 + "px",
            e.style.top = n.top + n.height - 20 + "px";
            break;
        case "middle-left":
            e.style.left = n.left + "px",
            e.style.top = n.top + (n.height - 20) / 2 + "px";
            break;
        case "middle-right":
            e.style.left = n.left + n.width - 20 + "px",
            e.style.top = n.top + (n.height - 20) / 2 + "px";
            break;
        case "middle-middle":
            e.style.left = n.left + (n.width - 20) / 2 + "px",
            e.style.top = n.top + (n.height - 20) / 2 + "px";
            break;
        case "bottom-middle":
            e.style.left = n.left + (n.width - 20) / 2 + "px",
            e.style.top = n.top + n.height - 20 + "px";
            break;
        case "top-middle":
            e.style.left = n.left + (n.width - 20) / 2 + "px",
            e.style.top = n.top + "px"
        }
    }
    function j(t) {
        var e = document.querySelector('.introjs-hint[data-step="' + t + '"]')
          , i = this._introItems[t];
        void 0 !== this._hintClickCallback && this._hintClickCallback.call(this, e, i, t);
        var n = g.call(this);
        if (parseInt(n, 10) !== t) {
            var o = document.createElement("div")
              , s = document.createElement("div")
              , l = document.createElement("div")
              , r = document.createElement("div");
            o.className = "introjs-tooltip",
            o.onclick = function(t) {
                t.stopPropagation ? t.stopPropagation() : t.cancelBubble = !0
            }
            ,
            s.className = "introjs-tooltiptext";
            var a = document.createElement("p");
            a.innerHTML = i.hint;
            var c = document.createElement("a");
            c.className = this._options.buttonClass,
            c.setAttribute("role", "button"),
            c.innerHTML = this._options.hintButtonLabel,
            c.onclick = v.bind(this, t),
            s.appendChild(a),
            s.appendChild(c),
            l.className = "introjs-arrow",
            o.appendChild(l),
            o.appendChild(s),
            this._currentStep = e.getAttribute("data-step"),
            r.className = "introjs-tooltipReferenceLayer introjs-hintReference",
            r.setAttribute("data-step", e.getAttribute("data-step")),
            T.call(this, r),
            r.appendChild(o),
            document.body.appendChild(r),
            L.call(this, e, o, l, null, !0)
        }
    }
    function k(t) {
        var e = document.body
          , i = document.documentElement
          , n = window.pageYOffset || i.scrollTop || e.scrollTop
          , o = window.pageXOffset || i.scrollLeft || e.scrollLeft
          , s = t.getBoundingClientRect();
        return {
            top: s.top + n,
            width: s.width,
            height: s.height,
            left: s.left + o
        }
    }
    function R(t) {
        var e = window.getComputedStyle(t)
          , i = "absolute" === e.position
          , n = /(auto|scroll)/;
        if ("fixed" === e.position)
            return document.body;
        for (var o = t; o = o.parentElement; )
            if (e = window.getComputedStyle(o),
            (!i || "static" !== e.position) && n.test(e.overflow + e.overflowY + e.overflowX))
                return o;
        return document.body
    }
    function V(t, e) {
        t.scrollTop = e.offsetTop - t.offsetTop
    }
    function z() {
        return parseInt(this._currentStep + 1, 10) / this._introItems.length * 100
    }
    var x = function(t) {
        var e;
        if ("object" == typeof t)
            e = new n(t);
        else if ("string" == typeof t) {
            var i = document.querySelector(t);
            if (!i)
                throw new Error("There is no element with given selector.");
            e = new n(i)
        } else
            e = new n(document.body);
        return x.instances[s(e, "introjs-instance")] = e
    };
    return x.version = "2.9.3",
    x.instances = {},
    x.fn = n.prototype = {
        clone: function() {
            return new n(this)
        },
        setOption: function(t, e) {
            return this._options[t] = e,
            this
        },
        setOptions: function(t) {
            return this._options = function(t, e) {
                var i, n = {};
                for (i in t)
                    n[i] = t[i];
                for (i in e)
                    n[i] = e[i];
                return n
            }(this._options, t),
            this
        },
        start: function(t) {
            return e.call(this, this._targetElement, t),
            this
        },
        goToStep: function(t) {
            return function(t) {
                this._currentStep = t - 2,
                void 0 !== this._introItems && E.call(this)
            }
            .call(this, t),
            this
        },
        addStep: function(t) {
            return this._options.steps || (this._options.steps = []),
            this._options.steps.push(t),
            this
        },
        addSteps: function(t) {
            if (t.length) {
                for (var e = 0; e < t.length; e++)
                    this.addStep(t[e]);
                return this
            }
        },
        goToStepNumber: function(t) {
            return function(t) {
                this._currentStepNumber = t,
                void 0 !== this._introItems && E.call(this)
            }
            .call(this, t),
            this
        },
        nextStep: function() {
            return E.call(this),
            this
        },
        previousStep: function() {
            return N.call(this),
            this
        },
        exit: function(t) {
            return A.call(this, this._targetElement, t),
            this
        },
        refresh: function() {
            return function() {
                if (T.call(this, document.querySelector(".introjs-helperLayer")),
                T.call(this, document.querySelector(".introjs-tooltipReferenceLayer")),
                T.call(this, document.querySelector(".introjs-disableInteraction")),
                void 0 !== this._currentStep && null !== this._currentStep) {
                    var t = document.querySelector(".introjs-helperNumberLayer")
                      , e = document.querySelector(".introjs-arrow")
                      , i = document.querySelector(".introjs-tooltip");
                    L.call(this, this._introItems[this._currentStep].element, i, e, t)
                }
                return r.call(this),
                this
            }
            .call(this),
            this
        },
        onbeforechange: function(t) {
            if ("function" != typeof t)
                throw new Error("Provided callback for onbeforechange was not a function");
            return this._introBeforeChangeCallback = t,
            this
        },
        onchange: function(t) {
            if ("function" != typeof t)
                throw new Error("Provided callback for onchange was not a function.");
            return this._introChangeCallback = t,
            this
        },
        onafterchange: function(t) {
            if ("function" != typeof t)
                throw new Error("Provided callback for onafterchange was not a function");
            return this._introAfterChangeCallback = t,
            this
        },
        oncomplete: function(t) {
            if ("function" != typeof t)
                throw new Error("Provided callback for oncomplete was not a function.");
            return this._introCompleteCallback = t,
            this
        },
        onhintsadded: function(t) {
            if ("function" != typeof t)
                throw new Error("Provided callback for onhintsadded was not a function.");
            return this._hintsAddedCallback = t,
            this
        },
        onhintclick: function(t) {
            if ("function" != typeof t)
                throw new Error("Provided callback for onhintclick was not a function.");
            return this._hintClickCallback = t,
            this
        },
        onhintclose: function(t) {
            if ("function" != typeof t)
                throw new Error("Provided callback for onhintclose was not a function.");
            return this._hintCloseCallback = t,
            this
        },
        onexit: function(t) {
            if ("function" != typeof t)
                throw new Error("Provided callback for onexit was not a function.");
            return this._introExitCallback = t,
            this
        },
        onskip: function(t) {
            if ("function" != typeof t)
                throw new Error("Provided callback for onskip was not a function.");
            return this._introSkipCallback = t,
            this
        },
        onbeforeexit: function(t) {
            if ("function" != typeof t)
                throw new Error("Provided callback for onbeforeexit was not a function.");
            return this._introBeforeExitCallback = t,
            this
        },
        addHints: function() {
            return l.call(this, this._targetElement),
            this
        },
        hideHint: function(t) {
            return v.call(this, t),
            this
        },
        hideHints: function() {
            return function() {
                B(y(".introjs-hint"), function(t) {
                    v.call(this, t.getAttribute("data-step"))
                }
                .bind(this))
            }
            .call(this),
            this
        },
        showHint: function(t) {
            return _.call(this, t),
            this
        },
        showHints: function() {
            return function() {
                var t = y(".introjs-hint");
                t && t.length ? B(t, function(t) {
                    _.call(this, t.getAttribute("data-step"))
                }
                .bind(this)) : l.call(this, this._targetElement)
            }
            .call(this),
            this
        },
        removeHints: function() {
            return function() {
                B(y(".introjs-hint"), function(t) {
                    w.call(this, t.getAttribute("data-step"))
                }
                .bind(this))
            }
            .call(this),
            this
        },
        removeHint: function(t) {
            return w.call(this, t),
            this
        },
        showHintDialog: function(t) {
            return j.call(this, t),
            this
        }
    },
    x
});
