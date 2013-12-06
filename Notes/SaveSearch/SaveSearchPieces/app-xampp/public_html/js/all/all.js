__d("sdk.RPC", ["Assert", "JSONRPC", "Queue"], function (a, b, c, d, e, f) {
    var g = b('Assert'),
        h = b('JSONRPC'),
        i = b('Queue'),
        j = new i(),
        k = new h(function (m) {
            j.enqueue(m);
        }),
        l = {
            local: k.local,
            remote: k.remote,
            stub: ES5(k.stub, 'bind', true, k),
            setInQueue: function (m) {
                g.isInstanceOf(i, m);
                m.start(function (n) {
                    k.read(n);
                });
            },
            getOutQueue: function () {
                return j;
            }
        };
    e.exports = l;
});
__d("emptyFunction", ["copyProperties"], function (a, b, c, d, e, f) {
    var g = b('copyProperties');

    function h(j) {
        return function () {
            return j;
        };
    }
    function i() {}
    g(i, {
        thatReturns: h,
        thatReturnsFalse: h(false),
        thatReturnsTrue: h(true),
        thatReturnsNull: h(null),
        thatReturnsThis: function () {
            return this;
        },
        thatReturnsArgument: function (j) {
            return j;
        },
        mustImplement: function (j, k) {
            return function () {};
        }
    });
    e.exports = i;
});
__d("Flash", ["DOMWrapper", "QueryString", "UserAgent", "copyProperties", "guid"], function (a, b, c, d, e, f) {
    var g = b('DOMWrapper'),
        h = b('QueryString'),
        i = b('UserAgent'),
        j = b('copyProperties'),
        k = b('guid'),
        l = {}, m, n = g.getWindow().document;

    function o(t) {
        var u = n.getElementById(t);
        if (u) u.parentNode.removeChild(u);
        delete l[t];
    }
    function p() {
        for (var t in l) if (l.hasOwnProperty(t)) o(t);
    }
    function q(t) {
        return t.replace(/\d+/g, function (u) {
            return '000'.substring(u.length) + u;
        });
    }
    function r(t) {
        if (!m) {
            if (i.ie() >= 9) window.attachEvent('onunload', p);
            m = true;
        }
        l[t] = t;
    }
    var s = {
        embed: function (t, u, v, w) {
            var x = k();
            t = encodeURI(t);
            v = j({
                allowscriptaccess: 'always',
                flashvars: w,
                movie: t
            }, v || {});
            if (typeof v.flashvars == 'object') v.flashvars = h.encode(v.flashvars);
            var y = [];
            for (var z in v) if (v.hasOwnProperty(z) && v[z]) y.push('<param name="' + encodeURI(z) + '" value="' + encodeURI(v[z]) + '">');
            var aa = n.createElement('div'),
                ba = '<object ' + (i.ie() ? 'classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" ' : 'type="application/x-shockwave-flash"') + 'data="' + t + '" ' + 'id="' + x + '">' + y.join('') + '</object>';
            aa.innerHTML = ba;
            var ca = u.appendChild(aa.firstChild);
            r(x);
            return ca;
        },
        remove: o,
        getVersion: function () {
            var t = 'Shockwave Flash',
                u = 'application/x-shockwave-flash',
                v = 'ShockwaveFlash.ShockwaveFlash',
                w;
            if (navigator.plugins && typeof navigator.plugins[t] == 'object') {
                var x = navigator.plugins[t].description;
                if (x && navigator.mimeTypes && navigator.mimeTypes[u] && navigator.mimeTypes[u].enabledPlugin) w = x.match(/\d+/g);
            }
            if (!w) try {
                    w = (new ActiveXObject(v)).GetVariable('$version').match(/(\d+),(\d+),(\d+),(\d+)/);
                    w = Array.prototype.slice.call(w, 1);
            } catch (y) {}
            return w;
        },
        checkMinVersion: function (t) {
            var u = s.getVersion();
            if (!u) return false;
            return q(u.join('.')) >= q(t);
        },
        isAvailable: function () {
            return !!s.getVersion();
        }
    };
    e.exports = s;
});
__d("dotAccess", [], function (a, b, c, d, e, f) {
    function g(h, i, j) {
        var k = i.split('.');
        do {
            var l = k.shift();
            h = h[l] || j && (h[l] = {});
        } while (k.length && h);
        return h;
    }
    e.exports = g;
});
__d("GlobalCallback", ["DOMWrapper", "dotAccess", "guid", "wrapFunction"], function (a, b, c, d, e, f) {
    var g = b('DOMWrapper'),
        h = b('dotAccess'),
        i = b('guid'),
        j = b('wrapFunction'),
        k, l, m = {
            setPrefix: function (n) {
                k = h(g.getWindow(), n, true);
                l = n;
            },
            create: function (n, o) {
                if (!k) this.setPrefix('__globalCallbacks');
                var p = i();
                k[p] = j(n, 'entry', o || 'GlobalCallback');
                return l + '.' + p;
            },
            remove: function (n) {
                var o = n.substring(l.length + 1);
                delete k[o];
            }
        };
    e.exports = m;
});
__d("XDM", ["DOMEventListener", "DOMWrapper", "emptyFunction", "Flash", "GlobalCallback", "guid", "Log", "UserAgent", "wrapFunction"], function (a, b, c, d, e, f) {
    var g = b('DOMEventListener'),
        h = b('DOMWrapper'),
        i = b('emptyFunction'),
        j = b('Flash'),
        k = b('GlobalCallback'),
        l = b('guid'),
        m = b('Log'),
        n = b('UserAgent'),
        o = b('wrapFunction'),
        p = {}, q = {
            transports: []
        }, r = h.getWindow();

    function s(u) {
        var v = {}, w = u.length,
            x = q.transports;
        while (w--) v[u[w]] = 1;
        w = x.length;
        while (w--) {
            var y = x[w],
                z = p[y];
            if (!v[y] && z.isAvailable()) return y;
        }
    }
    var t = {
        register: function (u, v) {
            m.debug('Registering %s as XDM provider', u);
            q.transports.push(u);
            p[u] = v;
        },
        create: function (u) {
            if (!u.whenReady && !u.onMessage) {
                m.error('An instance without whenReady or onMessage makes no sense');
                throw new Error('An instance without whenReady or ' + 'onMessage makes no sense');
            }
            if (!u.channel) {
                m.warn('Missing channel name, selecting at random');
                u.channel = l();
            }
            if (!u.whenReady) u.whenReady = i;
            if (!u.onMessage) u.onMessage = i;
            var v = u.transport || s(u.blacklist || []),
                w = p[v];
            if (w && w.isAvailable()) {
                m.debug('%s is available', v);
                w.init(u);
                return v;
            }
        }
    };
    t.register('fragment', (function () {
        var u = false,
            v, w = location.protocol + '//' + location.host;

        function x(y) {
            var z = document.createElement('iframe');
            z.src = 'javascript:false';
            var aa = g.add(z, 'load', function () {
                aa.remove();
                setTimeout(function () {
                    z.parentNode.removeChild(z);
                }, 5000);
            });
            v.appendChild(z);
            z.src = y;
        }
        return {
            isAvailable: function () {
                return true;
            },
            init: function (y) {
                m.debug('init fragment');
                var z = {
                    send: function (aa, ba, ca, da) {
                        m.debug('sending to: %s (%s)', ba + y.channelPath, da);
                        x(ba + y.channelPath + aa + '&xd_rel=parent.parent&relation=parent.parent&xd_origin=' + encodeURIComponent(w));
                    }
                };
                if (u) {
                    y.whenReady(z);
                    return;
                }
                v = y.root;
                u = true;
                y.whenReady(z);
            }
        };
    })());
    t.register('flash', (function () {
        var u = false,
            v, w = false,
            x = 15000,
            y;
        return {
            isAvailable: function () {
                return j.checkMinVersion('8.0.24');
            },
            init: function (z) {
                m.debug('init flash: ' + z.channel);
                var aa = {
                    send: function (da, ea, fa, ga) {
                        m.debug('sending to: %s (%s)', ea, ga);
                        v.postMessage(da, ea, ga);
                    }
                };
                if (u) {
                    z.whenReady(aa);
                    return;
                }
                var ba = z.root.appendChild(r.document.createElement('div')),
                    ca = k.create(function () {
                        k.remove(ca);
                        clearTimeout(y);
                        m.info('xdm.swf called the callback');
                        var da = k.create(function (ea, fa) {
                            ea = decodeURIComponent(ea);
                            fa = decodeURIComponent(fa);
                            m.debug('received message %s from %s', ea, fa);
                            z.onMessage(ea, fa);
                        }, 'xdm.swf:onMessage');
                        v.init(z.channel, da);
                        z.whenReady(aa);
                    }, 'xdm.swf:load');
                v = j.embed(z.flashUrl, ba, null, {
                    protocol: location.protocol.replace(':', ''),
                    host: location.host,
                    callback: ca,
                    log: w
                });
                y = setTimeout(function () {
                    m.warn('The Flash component did not load within %s ms - ' + 'verify that the container is not set to hidden or invisible ' + 'using CSS as this will cause some browsers to not load ' + 'the components', x);
                }, x);
                u = true;
            }
        };
    })());
    t.register('postmessage', (function () {
        var u = false;
        return {
            isAvailable: function () {
                return !!r.postMessage;
            },
            init: function (v) {
                m.debug('init postMessage: ' + v.channel);
                var w = '_FB_' + v.channel,
                    x = {
                        send: function (y, z, aa, ba) {
                            if (r === aa) {
                                m.error('Invalid windowref, equal to window (self)');
                                throw new Error();
                            }
                            m.debug('sending to: %s (%s)', z, ba);
                            var ca = function () {
                                aa.postMessage('_FB_' + ba + y, z);
                            };
                            if (n.ie() == 8) {
                                setTimeout(ca, 0);
                            } else ca();
                        }
                    };
                if (u) {
                    v.whenReady(x);
                    return;
                }
                g.add(r, 'message', o(function (event) {
                    var y = event.data,
                        z = event.origin || 'native';
                    if (typeof y != 'string') {
                        m.warn('Received message of type %s from %s, expected a string', typeof y, z);
                        return;
                    }
                    m.debug('received message %s from %s', y, z);
                    if (y.substring(0, w.length) == w) y = y.substring(w.length);
                    v.onMessage(y, z);
                }, 'entry', 'onMessage'));
                v.whenReady(x);
                u = true;
            }
        };
    })());
    e.exports = t;
});
__d("sdk.XD", ["sdk.Content", "sdk.createIframe", "sdk.Event", "guid", "Log", "QueryString", "Queue", "resolveURI", "resolveWindow", "sdk.RPC", "sdk.Runtime", "UrlMap", "URL", "wrapFunction", "XDM", "XDConfig"], function (a, b, c, d, e, f) {
    var g = b('sdk.Content'),
        h = b('sdk.createIframe'),
        i = b('sdk.Event'),
        j = b('guid'),
        k = b('Log'),
        l = b('QueryString'),
        m = b('Queue'),
        n = b('resolveURI'),
        o = b('resolveWindow'),
        p = b('sdk.RPC'),
        q = b('sdk.Runtime'),
        r = b('UrlMap'),
        s = b('URL'),
        t = b('wrapFunction'),
        u = c('XDConfig'),
        v = b('XDM'),
        w = new m(),
        x = new m(),
        y = new m(),
        z, aa, ba = j(),
        ca = j(),
        da = location.protocol + '//' + location.host,
        ea, fa = false,
        ga = 'Facebook Cross Domain Communication Frame',
        ha = {}, ia = new m();
    p.setInQueue(ia);

    function ja(pa) {
        k.info('Remote XD can talk to facebook.com (%s)', pa);
        q.setEnvironment(pa === 'canvas' ? q.ENVIRONMENTS.CANVAS : q.ENVIRONMENTS.PAGETAB);
    }
    function ka(pa, qa) {
        if (!qa) {
            k.error('No senderOrigin');
            throw new Error();
        }
        var ra = /^https?/.exec(qa)[0];
        switch (pa.xd_action) {
        case 'proxy_ready':
            var sa, ta;
            if (ra == 'https') {
                sa = y;
                ta = aa;
            } else {
                sa = x;
                ta = z;
            } if (pa.registered) {
                ja(pa.registered);
                w = sa.merge(w);
            }
            k.info('Proxy ready, starting queue %s containing %s messages', ra + 'ProxyQueue', sa.getLength());
            sa.start(function (va) {
                ea.send(typeof va === 'string' ? va : l.encode(va), qa, ta.contentWindow, ca + '_' + ra);
            });
            break;
        case 'plugin_ready':
            k.info('Plugin %s ready, protocol: %s', pa.name, ra);
            ha[pa.name] = {
                protocol: ra
            };
            if (m.exists(pa.name)) {
                var ua = m.get(pa.name);
                k.debug('Enqueuing %s messages for %s in %s', ua.getLength(), pa.name, ra + 'ProxyQueue');
                (ra == 'https' ? y : x).merge(ua);
            }
            break;
        }
        if (pa.data) la(pa.data, qa);
    }
    function la(pa, qa) {
        if (qa && qa !== 'native' && !s(qa).isFacebookURL()) return;
        if (typeof pa == 'string') {
            if (/^FB_RPC:/.test(pa)) {
                ia.enqueue(pa.substring(7));
                return;
            }
            if (pa.substring(0, 1) == '{') {
                try {
                    pa = ES5('JSON', 'parse', false, pa);
                } catch (ra) {
                    k.warn('Failed to decode %s as JSON', pa);
                    return;
                }
            } else pa = l.decode(pa);
        }
        if (!qa) if (pa.xd_sig == ba) qa = pa.xd_origin;
        if (pa.xd_action) {
            ka(pa, qa);
            return;
        }
        if (pa.access_token) q.setSecure(/^https/.test(da));
        if (pa.cb) {
            var sa = oa._callbacks[pa.cb];
            if (!oa._forever[pa.cb]) delete oa._callbacks[pa.cb];
            if (sa) sa(pa);
        }
    }
    function ma(pa, qa) {
        if (pa == 'facebook') {
            qa.relation = 'parent.parent';
            w.enqueue(qa);
        } else {
            qa.relation = 'parent.frames["' + pa + '"]';
            var ra = ha[pa];
            if (ra) {
                k.debug('Enqueuing message for plugin %s in %s', pa, ra.protocol + 'ProxyQueue');
                (ra.protocol == 'https' ? y : x).enqueue(qa);
            } else {
                k.debug('Buffering message for plugin %s', pa);
                m.get(pa).enqueue(qa);
            }
        }
    }
    p.getOutQueue().start(function (pa) {
        ma('facebook', 'FB_RPC:' + pa);
    });

    function na(pa, qa) {
        if (fa) return;
        var ra = pa ? /\/\/.*?(\/[^#]*)/.exec(pa)[1] : location.pathname + location.search;
        ra += (~ES5(ra, 'indexOf', true, '?') ? '&' : '?') + 'fb_xd_fragment#xd_sig=' + ba + '&';
        var sa = g.appendHidden(document.createElement('div')),
            ta = v.create({
                root: sa,
                channel: ca,
                channelPath: '/' + u.XdUrl + '#',
                flashUrl: u.Flash.path,
                whenReady: function (ua) {
                    ea = ua;
                    var va = {
                        channel: ca,
                        origin: location.protocol + '//' + location.host,
                        channel_path: ra,
                        transport: ta,
                        xd_name: qa
                    }, wa = '/' + u.XdUrl + '#' + l.encode(va),
                        xa = u.useCdn ? r.resolve('cdn', false) : 'http://www.facebook.com',
                        ya = u.useCdn ? r.resolve('cdn', true) : 'https://www.facebook.com';
                    if (q.getSecure() !== true) z = h({
                            url: xa + wa,
                            name: 'fb_xdm_frame_http',
                            id: 'fb_xdm_frame_http',
                            root: sa,
                            'aria-hidden': true,
                            title: ga,
                            'tab-index': -1
                        });
                    aa = h({
                        url: ya + wa,
                        name: 'fb_xdm_frame_https',
                        id: 'fb_xdm_frame_https',
                        root: sa,
                        'aria-hidden': true,
                        title: ga,
                        'tab-index': -1
                    });
                },
                onMessage: la
            });
        if (ta === 'fragment') window.FB_XD_onMessage = t(la, 'entry', 'XD:fragment');
        fa = true;
    }
    var oa = {
        rpc: p,
        _callbacks: {},
        _forever: {},
        _channel: ca,
        _origin: da,
        onMessage: la,
        recv: la,
        init: na,
        sendToFacebook: ma,
        inform: function (pa, qa, ra, sa) {
            ma('facebook', {
                method: pa,
                params: ES5('JSON', 'stringify', false, qa || {}),
                behavior: sa || 'p',
                relation: ra
            });
        },
        handler: function (pa, qa, ra, sa) {
            var ta = u.useCdn ? r.resolve('cdn', location.protocol == 'https:') : location.protocol + '//www.facebook.com';
            return ta + '/' + u.XdUrl + '#' + l.encode({
                cb: this.registerCallback(pa, ra, sa),
                origin: da + '/' + ca,
                domain: location.hostname,
                relation: qa || 'opener'
            });
        },
        registerCallback: function (pa, qa, ra) {
            ra = ra || j();
            if (qa) oa._forever[ra] = true;
            oa._callbacks[ra] = pa;
            return ra;
        }
    };
    (function () {
        var pa = location.href.match(/[?&]fb_xd_fragment#(.*)$/);
        if (pa) {
            document.documentElement.style.display = 'none';
            var qa = l.decode(pa[1]),
                ra = o(qa.xd_rel);
            k.debug('Passing fragment based message: %s', pa[1]);
            ra.FB_XD_onMessage(qa);
            document.open();
            document.close();
        }
    })();
    i.subscribe('init:post', function (pa) {
        na(pa.channelUrl ? n(pa.channelUrl) : null, pa.xdProxyName);
    });
    e.exports = oa;
});
__d("sdk.Auth", ["sdk.Cookie", "copyProperties", "sdk.createIframe", "DOMWrapper", "sdk.getContextType", "guid", "Log", "ObservableMixin", "QueryString", "sdk.Runtime", "sdk.SignedRequest", "UrlMap", "URL", "sdk.XD"], function (a, b, c, d, e, f) {
    var g = b('sdk.Cookie'),
        h = b('copyProperties'),
        i = b('sdk.createIframe'),
        j = b('DOMWrapper'),
        k = b('sdk.getContextType'),
        l = b('guid'),
        m = b('Log'),
        n = b('ObservableMixin'),
        o = b('QueryString'),
        p = b('sdk.Runtime'),
        q = b('sdk.SignedRequest'),
        r = b('UrlMap'),
        s = b('URL'),
        t = b('sdk.XD'),
        u, v, w = new n();

    function x(da, ea) {
        var fa = p.getUserID(),
            ga = '';
        if (da) if (da.userID) {
                ga = da.userID;
            } else if (da.signedRequest) {
            var ha = q.parse(da.signedRequest);
            if (ha && ha.user_id) ga = ha.user_id;
        }
        var ia = p.getLoginStatus(),
            ja = (ia === 'unknown' && da) || (p.getUseCookie() && p.getCookieUserID() !== ga),
            ka = fa && !da,
            la = da && fa && fa != ga,
            ma = da != u,
            na = ea != (ia || 'unknown');
        p.setLoginStatus(ea);
        p.setAccessToken(da && da.accessToken || null);
        p.setUserID(ga);
        u = da;
        var oa = {
            authResponse: da,
            status: ea
        };
        if (ka || la) w.inform('logout', oa);
        if (ja || la) w.inform('login', oa);
        if (ma) w.inform('authresponse.change', oa);
        if (na) w.inform('status.change', oa);
        return oa;
    }
    function y() {
        return u;
    }
    function z(da, ea, fa) {
        return function (ga) {
            var ha;
            if (ga && ga.access_token) {
                var ia = q.parse(ga.signed_request);
                ea = {
                    accessToken: ga.access_token,
                    userID: ia.user_id,
                    expiresIn: parseInt(ga.expires_in, 10),
                    signedRequest: ga.signed_request
                };
                if (p.getUseCookie()) {
                    var ja = ea.expiresIn === 0 ? 0 : ES5('Date', 'now', false) + ea.expiresIn * 1000,
                        ka = g.getDomain();
                    if (!ka && ga.base_domain) g.setDomain('.' + ga.base_domain);
                    g.setSignedRequestCookie(ga.signed_request, ja);
                }
                ha = 'connected';
                x(ea, ha);
            } else if (fa === 'logout' || fa === 'login_status') {
                if (ga.error && ga.error === 'not_authorized') {
                    ha = 'not_authorized';
                } else ha = 'unknown';
                x(null, ha);
                if (p.getUseCookie()) g.clearSignedRequestCookie();
            }
            if (ga && ga.https == 1) p.setSecure(true);
            if (da) da({
                    authResponse: ea,
                    status: p.getLoginStatus()
                });
            return ea;
        };
    }
    function aa(da) {
        var ea;
        if (v) {
            clearTimeout(v);
            v = null;
        }
        var fa = z(da, u, 'login_status'),
            ga = s(r.resolve('www', true) + '/dialog/oauth').setSearch(o.encode({
                client_id: p.getClientID(),
                response_type: 'token,signed_request,code',
                display: 'none',
                domain: location.hostname,
                origin: k(),
                redirect_uri: t.handler(function (ha) {
                    ea.parentNode.removeChild(ea);
                    if (fa(ha)) v = setTimeout(function () {
                            aa(function () {});
                        }, 1200000);
                }, 'parent'),
                sdk: 'joey'
            }));
        ea = i({
            root: j.getRoot(),
            name: l(),
            url: ga.toString(),
            style: {
                display: 'none'
            }
        });
    }
    var ba;

    function ca(da, ea) {
        if (!p.getClientID()) {
            m.warn('FB.getLoginStatus() called before calling FB.init().');
            return;
        }
        if (da) if (!ea && ba == 'loaded') {
                da({
                    status: p.getLoginStatus(),
                    authResponse: y()
                });
                return;
            } else w.subscribe('FB.loginStatus', da);
        if (!ea && ba == 'loading') return;
        ba = 'loading';
        var fa = function (ga) {
            ba = 'loaded';
            w.inform('FB.loginStatus', ga);
            w.clearSubscribers('FB.loginStatus');
        };
        aa(fa);
    }
    h(w, {
        getLoginStatus: ca,
        fetchLoginStatus: aa,
        setAuthResponse: x,
        getAuthResponse: y,
        parseSignedRequest: q.parse,
        xdResponseWrapper: z
    });
    e.exports = w;
});
__d("hasArrayNature", [], function (a, b, c, d, e, f) {
    function g(h) {
        return ( !! h && (typeof h == 'object' || typeof h == 'function') && ('length' in h) && !('setInterval' in h) && (Object.prototype.toString.call(h) === "[object Array]" || ('callee' in h) || ('item' in h)));
    }
    e.exports = g;
});
__d("createArrayFrom", ["hasArrayNature"], function (a, b, c, d, e, f) {
    var g = b('hasArrayNature');

    function h(i) {
        if (!g(i)) return [i];
        if (i.item) {
            var j = i.length,
                k = new Array(j);
            while (j--) k[j] = i[j];
            return k;
        }
        return Array.prototype.slice.call(i);
    }
    e.exports = h;
});
__d("sdk.DOM", ["Assert", "createArrayFrom", "sdk.domReady", "UserAgent"], function (a, b, c, d, e, f) {
    var g = b('Assert'),
        h = b('createArrayFrom'),
        i = b('sdk.domReady'),
        j = b('UserAgent'),
        k = {};

    function l(z, aa) {
        var ba = (z.getAttribute(aa) || z.getAttribute(aa.replace(/_/g, '-')) || z.getAttribute(aa.replace(/-/g, '_')) || z.getAttribute(aa.replace(/-/g, '')) || z.getAttribute(aa.replace(/_/g, '')) || z.getAttribute('data-' + aa) || z.getAttribute('data-' + aa.replace(/_/g, '-')) || z.getAttribute('data-' + aa.replace(/-/g, '_')) || z.getAttribute('data-' + aa.replace(/-/g, '')) || z.getAttribute('data-' + aa.replace(/_/g, '')));
        return ba ? String(ba) : null;
    }
    function m(z, aa) {
        var ba = l(z, aa);
        return ba ? /^(true|1|yes|on)$/.test(ba) : null;
    }
    function n(z, aa) {
        g.isTruthy(z, 'element not specified');
        g.isString(aa);
        try {
            return String(z[aa]);
        } catch (ba) {
            throw new Error('Could not read property ' + aa + ' : ' + ba.message);
        }
    }
    function o(z, aa) {
        g.isTruthy(z, 'element not specified');
        g.isString(aa);
        try {
            z.innerHTML = aa;
        } catch (ba) {
            throw new Error('Could not set innerHTML : ' + ba.message);
        }
    }
    function p(z, aa) {
        g.isTruthy(z, 'element not specified');
        g.isString(aa);
        var ba = ' ' + n(z, 'className') + ' ';
        return ES5(ba, 'indexOf', true, ' ' + aa + ' ') >= 0;
    }
    function q(z, aa) {
        g.isTruthy(z, 'element not specified');
        g.isString(aa);
        if (!p(z, aa)) z.className = n(z, 'className') + ' ' + aa;
    }
    function r(z, aa) {
        g.isTruthy(z, 'element not specified');
        g.isString(aa);
        var ba = new RegExp('\\s*' + aa, 'g');
        z.className = ES5(n(z, 'className').replace(ba, ''), 'trim', true);
    }
    function s(z, aa, ba) {
        g.isString(z);
        aa = aa || document.body;
        ba = ba || '*';
        if (aa.querySelectorAll) return h(aa.querySelectorAll(ba + '.' + z));
        var ca = aa.getElementsByTagName(ba),
            da = [];
        for (var ea = 0, fa = ca.length; ea < fa; ea++) if (p(ca[ea], z)) da[da.length] = ca[ea];
        return da;
    }
    function t(z, aa) {
        g.isTruthy(z, 'element not specified');
        g.isString(aa);
        aa = aa.replace(/-(\w)/g, function (da, ea) {
            return ea.toUpperCase();
        });
        var ba = z.currentStyle || document.defaultView.getComputedStyle(z, null),
            ca = ba[aa];
        if (/backgroundPosition?/.test(aa) && /top|left/.test(ca)) ca = '0%';
        return ca;
    }
    function u(z, aa, ba) {
        g.isTruthy(z, 'element not specified');
        g.isString(aa);
        aa = aa.replace(/-(\w)/g, function (ca, da) {
            return da.toUpperCase();
        });
        z.style[aa] = ba;
    }
    function v(z, aa) {
        var ba = true;
        for (var ca = 0, da; da = aa[ca++];) if (!(da in k)) {
                ba = false;
                k[da] = true;
            }
        if (ba) return;
        if (!j.ie()) {
            var ea = document.createElement('style');
            ea.type = 'text/css';
            ea.textContent = z;
            document.getElementsByTagName('head')[0].appendChild(ea);
        } else try {
                document.createStyleSheet().cssText = z;
        } catch (fa) {
            if (document.styleSheets[0]) document.styleSheets[0].cssText += z;
        }
    }
    function w() {
        var z = (document.documentElement && document.compatMode == 'CSS1Compat') ? document.documentElement : document.body;
        return {
            scrollTop: z.scrollTop || document.body.scrollTop,
            scrollLeft: z.scrollLeft || document.body.scrollLeft,
            width: window.innerWidth ? window.innerWidth : z.clientWidth,
            height: window.innerHeight ? window.innerHeight : z.clientHeight
        };
    }
    function x(z) {
        g.isTruthy(z, 'element not specified');
        var aa = 0,
            ba = 0;
        do {
            aa += z.offsetLeft;
            ba += z.offsetTop;
        } while (z = z.offsetParent);
        return {
            x: aa,
            y: ba
        };
    }
    var y = {
        containsCss: p,
        addCss: q,
        removeCss: r,
        getByClass: s,
        getStyle: t,
        setStyle: u,
        getAttr: l,
        getBoolAttr: m,
        getProp: n,
        html: o,
        addCssRules: v,
        getViewportInfo: w,
        getPosition: x,
        ready: i
    };
    e.exports = y;
});
__d("sdk.feature", ["SDKConfig"], function (a, b, c, d, e, f) {
    var g = c('SDKConfig');

    function h(i, j) {
        if (g.features && i in g.features) {
            var k = g.features[i];
            if (typeof k === 'object' && typeof k.rate === 'number') {
                if (k.rate && Math.floor(Math.random() * 100) + 1 <= k.rate) {
                    return k.value || true;
                } else return k.value ? null : false;
            } else return k;
        }
        return typeof j !== 'undefined' ? j : null;
    }
    e.exports = h;
});
__d("sdk.Scribe", ["UrlMap", "QueryString"], function (a, b, c, d, e, f) {
    var g = b('UrlMap'),
        h = b('QueryString');

    function i(k, l) {
        (new Image()).src = h.appendToUrl(g.resolve('www', true) + '/common/scribe_endpoint.php', {
            c: k,
            m: ES5('JSON', 'stringify', false, l)
        });
    }
    var j = {
        log: i
    };
    e.exports = j;
});
__d("sdk.ErrorHandling", ["sdk.feature", "ManagedError", "sdk.Runtime", "sdk.Scribe", "UserAgent", "wrapFunction"], function (a, b, c, d, e, f) {
    var g = b('sdk.feature'),
        h = b('ManagedError'),
        i = b('sdk.Runtime'),
        j = b('sdk.Scribe'),
        k = b('UserAgent'),
        l = b('wrapFunction'),
        m = g('error_handling', false),
        n = '';

    function o(u) {
        var v = u._originalError;
        delete u._originalError;
        j.log('jssdk_error', {
            appId: i.getClientID(),
            error: u.name || u.message,
            extra: u
        });
        throw v;
    }
    function p(u) {
        var v = {
            line: u.lineNumber || u.line,
            message: u.message,
            name: u.name,
            script: u.fileName || u.sourceURL || u.script,
            stack: u.stackTrace || u.stack
        };
        v._originalError = u;
        if (k.chrome() && /([\w:\.\/]+\.js):(\d+)/.test(u.stack)) {
            v.script = RegExp.$1;
            v.line = parseInt(RegExp.$2, 10);
        }
        for (var w in v)(v[w] == null && delete v[w]);
        return v;
    }
    function q(u, v) {
        return function () {
            if (!m) return u.apply(this, arguments);
            try {
                n = v;
                return u.apply(this, arguments);
            } catch (w) {
                if (w instanceof h) throw w;
                var x = p(w);
                x.entry = v;
                var y = ES5(Array.prototype.slice.call(arguments), 'map', true, function (z) {
                    var aa = Object.prototype.toString.call(z);
                    return (/^\[object (String|Number|Boolean|Object|Date)\]$/).test(aa) ? z : z.toString();
                });
                x.args = ES5('JSON', 'stringify', false, y).substring(0, 200);
                o(x);
            } finally {
                n = '';
            }
        };
    }
    function r(u) {
        if (!u.__wrapper) u.__wrapper = function () {
                try {
                    return u.apply(this, arguments);
                } catch (v) {
                    window.setTimeout(function () {
                        throw v;
                    }, 0);
                    return false;
                }
        };
        return u.__wrapper;
    }
    function s(u, v) {
        return function (w, x) {
            var y = v + ':' + (n || '[global]') + ':' + (w.name || '[anonymous]' + (arguments.callee.caller.name ? '(' + arguments.callee.caller.name + ')' : ''));
            return u(l(w, 'entry', y), x);
        };
    }
    if (m) {
        setTimeout = s(setTimeout, 'setTimeout');
        setInterval = s(setInterval, 'setInterval');
        l.setWrapper(q, 'entry');
    }
    var t = {
        guard: q,
        unguard: r
    };
    e.exports = t;
});