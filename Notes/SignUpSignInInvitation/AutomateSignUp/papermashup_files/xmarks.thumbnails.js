/* Copyright 2010, Xmarks, Inc */

(function(){
if(
   /(http:\/\/www\.google\..+\/(.*[?&]q=([^&]+))|$)|(http:\/\/[-a-zA-Z]+\.start3\.mozilla\.com\/search\?.*[?&]q=([^&]+))|(http:\/\/search\.yahoo\.com\/search?.*[?&]p=([^&]+))|(http:\/\/www\.bing\.com\/search?.*[?&]q=([^&]+))/.test(document.location.href)){ 

window.XmarksThumbnails = window.XmarksThumbnails || {
    APIHOST: "api.xmarks.com",
    THUMBHOST: "thumbs.xmarks.com",
    DRIFTHOST: "www.xmarks.com",
    STATICHOST: "static.xmarks.com",
    PID: "xmarks.thumbnails",
    DEBUG: false,
    PREFINTFIELDS: {},
    THUMBURL: "/discover/thumbnail/read?cid=preview&size=Small&url=",

    _getInternetExplorerVersion: function(){
        var rv = -1; // Return value assumes failure.
        if (navigator.appName == 'Microsoft Internet Explorer'){
            var ua = navigator.userAgent;
            var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null){
                rv = parseFloat( RegExp.$1 );
            }
        }
        return rv;
    },

    // If a client has inserted a hidden form field, parse it and update our
    // internal constants
    _updatePrefs: function(prefs){
        var a = prefs.split(';');
        var len = a.length;
        var intfields = this.PREFINTFIELDS;
        for(var x = 0; x < len; x++){
            var vals = a[x].split('=');
            var field = vals[0];
            var val = vals[1];
            if(vals.length){
                if(intfields[field]){
                    val = parseInt(val, 10);
                }
                this[field]=val;
            }
        }
    },
    indexOf: function(obj, s){
        if(obj.indexOf){
            return obj.indexOf(s);
        } else {
            var len = obj.length;
            for(var x = 0; x < len; x++){
                if(obj[x] == s){
                    return x;
                }
            }
        }
        return -1;
    },
    bingAddThumbnails: function(){
        var result = [];
        var atags = document.getElementsByTagName("a");
        var len = atags.length;
        var i;
        if(len == 0){
            this._log("No action tags found");
            return result;
        }
        var hasTagName = function(n, tag){
            return n && n.tagName == tag;
        };
        var hasClassName = function(n, tag){
            return n && n.className == tag;
        };
        var container = document.getElementById('results');
        if(!container){
            return;
        }
        container.style.paddingLeft = "140px";
        var cc = container;
        var offset = 0;
        if(this._getInternetExplorerVersion() != -1){
            while(cc && typeof(cc.offsetTop) == 'number'){
                offset += cc.offsetTop;
                cc = cc.parentNode;
            }
        }
        
        for(var i =0; i < len; i++){
            var item = atags[i];
            if( hasTagName(item.parentNode, 'H3') &&
                hasClassName(item.parentNode.parentNode, 'sb_tlst') &&
                hasClassName(item.parentNode.parentNode.parentNode, 'sa_cc') &&
                hasTagName(item.parentNode.parentNode.parentNode.parentNode, 'LI')){
                var url = item.href;
                item = item.parentNode.parentNode.parentNode.parentNode;


                if(item){
                    var thumb = document.createElement("img");
                    var atag = document.createElement("a");
                    atag.href = url;
                    thumb.src = "http://" + this.THUMBHOST + this.THUMBURL + 
                        encodeURIComponent(url) + "&product=" + this.PID + 
                        (this.MACHINEID ? "&mid=" + this.MACHINEID : "");
                    thumb.style.cssText = "-moz-border-radius: 10px; -moz-box-shadow: 4px 4px 4px #bbc;-webkit-border-radius: 10px; -webkit-box-shadow: 4px 4px 4px #bbc; border: 2px solid #eee; cursor: pointer; width: 120px; height: 90px;";

                    atag.appendChild(thumb);
                    
                    item.style.minHeight = "100px";
                    atag.id = "xmarksthumb."+i;
                    atag.style.position = "absolute";
                    atag.style.top = (item.offsetTop + offset) + "px";
                    atag.style.left = "192px";
                    container.appendChild(atag);
                }
            }
        }

        // Adjust content
        var a = this.getElementsByClassName('sa_cc', 'div', null);
        var len = a.length;
        for(var x = 0; x < len; x++){
            a[x].style.maxWidth = "450px";
        }

        // recalcs at the end so offsets will be off
        window.setTimeout(function(){
            var len = atags.length;
            for(var i =0; i < len; i++){
                var item = atags[i];
                if( hasTagName(item.parentNode, 'H3') &&
                    hasClassName(item.parentNode.parentNode, 'sb_tlst') &&
                    hasClassName(item.parentNode.parentNode.parentNode, 'sa_cc') &&
                    hasTagName(item.parentNode.parentNode.parentNode.parentNode, 'LI')){
                    item = item.parentNode.parentNode.parentNode.parentNode;

                    if(item){
                        var atag = document.getElementById("xmarksthumb."+i);
                        if(atag){
                            atag.style.top = (item.offsetTop + offset) + "px";
                        }
                    }

                }
            }
        }, 1500); // 500 because other scripts are messing with the results too
        return result;

    },
	// Developed by Robert Nyman, http://www.robertnyman.com
	// Code/licensing: http://code.google.com/p/getelementsbyclassname/
        getElementsByClassName: function (className, tag, elm){
	    if (document.getElementsByClassName) {
                    elm = elm || document;
                    var elements = elm.getElementsByClassName(className),
                        nodeName = (tag)? new RegExp("\\b" + tag + "\\b", "i") : null,
                        returnElements = [],
                        current;
                    for(var i=0, il=elements.length; i<il; i+=1){
                        current = elements[i];
                        if(!nodeName || nodeName.test(current.nodeName)) {
                            returnElements.push(current);
                        }
                    }
                    return returnElements;
            } else if (document.evaluate) {
                    tag = tag || "*";
                    elm = elm || document;
                    var classes = className.split(" "),
                        classesToCheck = "",
                        xhtmlNamespace = "http://www.w3.org/1999/xhtml",
                        namespaceResolver = (document.documentElement.namespaceURI === xhtmlNamespace)? xhtmlNamespace : null,
                        returnElements = [],
                        elements,
                        node;
                    for(var j=0, jl=classes.length; j<jl; j+=1){
                        classesToCheck += "[contains(concat(' ', @class, ' '), ' " + classes[j] + " ')]";
                    }
                    try {
                        elements = document.evaluate(".//" + tag + classesToCheck, elm, namespaceResolver, 0, null);
                    } catch (e) {
                        elements = document.evaluate(".//" + tag + classesToCheck, elm, null, 0, null);
                    }
                    while ((node = elements.iterateNext())) {
                        returnElements.push(node);
                    }
                    return returnElements;
            } else {
                    tag = tag || "*";
                    elm = elm || document;
                    var classes = className.split(" "),
                        classesToCheck = [],
                        elements = (tag === "*" && elm.all)? elm.all : elm.getElementsByTagName(tag),
                        current,
                        returnElements = [],
                        match;
                    for(var k=0, kl=classes.length; k<kl; k+=1){
                        classesToCheck.push(new RegExp("(^|\\s)" + classes[k] + "(\\s|$)"));
                    }
                    for(var l=0, ll=elements.length; l<ll; l+=1){
                        current = elements[l];
                        match = false;
                        for(var m=0, ml=classesToCheck.length; m<ml; m+=1){
                            match = classesToCheck[m].test(current.className);
                            if (!match) {
                                break;
                            }
                        }
                        if (match) {
                            returnElements.push(current);
                        }
                    }
                    return returnElements;
            }
        },
    addThumbnails: function(){
        var result = [];
        var a = document.getElementsByTagName("a");
        var len = a.length;
        var i;
        var lastItem = null;
        var self = this;
        var hasGoodSibling = function(n){
            var s = n.nextSibling;
            while(s){
                if(s.className == "s" || s.tagName == 'SPAN'){
                    return true;
                }
                s = s.nextSibling;
            }
            return false;
        };
        var hasClass = function(n, className){
            if(n.className){
                var a = n.className.split(' ');
                return self.indexOf(a,className) != -1;
            }
            return false;
        };
        for(var i =0; i < len; i++){
            var item = a[i];
            var p = item.parentNode;
            if(p && hasClass(item, "l") && hasClass(p, "r") && hasGoodSibling(p)){
                var url = item.href;
                if(this.indexOf(url,"http://www.google.com/url") == 0){
                    var ra = /[?&]q=([^&]*)/.exec(url);
                    if(ra.length > 1)
                        url = ra[1];
                }
                while (item.tagName != "LI") {
                    item = item.parentNode;
                    if (!item){
                        break;
                    }
                }
                if(item){
                    lastItem = item;
                    var cn = item.childNodes;
                    var cnlen = cn.length;
                    for(var y = 0; y < cnlen; y++){
                        if(cn[y].style){
                            cn[y].style.position = 'relative';
                        }
                    }
                    var thumb = document.createElement("img");
                    var atag = document.createElement("a");
                    atag.href = url;
                    thumb.src = "http://" + this.THUMBHOST + this.THUMBURL + 
                        encodeURIComponent(url) + "&product=" + this.PID + 
                        (this.MACHINEID ? "&mid=" + this.MACHINEID : "");
                    thumb.style.cssText = "position: absolute; left: 0px; top: 0px; -moz-border-radius: 10px; -moz-box-shadow: 4px 4px 4px #bbc;-webkit-border-radius: 10px; -webkit-box-shadow: 4px 4px 4px #bbc; border: 2px solid #eee; cursor: pointer; width: 120px; height: 90px;";

                    atag.appendChild(thumb);
                    item.appendChild(atag);
                    item.style.position = "relative";
                    item.style.paddingLeft = "140px";
                    item.style.minHeight = "100px";

                }
            }
        }
        /*
        var mbEnd = document.getElementById('mbEnd');
        if(mbEnd && lastItem){
            lastItem.parentNode.style.width = '70%';
        }
        */

        return result;
    },
    // Logs output to console if DEBUG is enabled
    _log: function(s){
        if(this.DEBUG && window.console){
            window.console.log(s);
        }
    },
    init: function(){
        // check for hidden field, and update ourselves
        //
        var prefs = document.getElementById("foxmarks.thumbnails.prefs");
        if(prefs){
            this._updatePrefs(prefs.value);
        }
        var currDate = new Date();
        this.SESSIONID = currDate.getTime().toString(36);
        if( /http:\/\/www\.bing\.com\/search?.*[?&]q=([^&]+)/.test(document.location.href)){ 
            this.bingAddThumbnails();
        } else {
            this.addThumbnails();
        }

        var img = document.createElement("img");
        img.src = ''.concat(
            'http://tr.xmarks.com/tracking/impressions.gif?mid=',
        //    'http://localhost:8000/tracking/impressions.gif?mid=',
            this.MACHINEID,'&sess=', this.SESSIONID,
            "&product=", this.PID,
            '&app=xmarks.thumbnails', 
            '&page=serp.impression.thumbnails'
        );
        document.body.appendChild(img);

        // if google ajax, need to start monitoring the hash
        this.AJAXY = /http:\/\/www\.google\..+\/(#|$)/.test(document.location.href);
        if(this.AJAXY){
            var snmatch = document.location.href.match(/start=([^&]+)(&|$)/);
            if(snmatch){
                this.startNum = parseInt(snmatch[1]);
            } else {
                this.startNum = 0;
            }
            this.monitorQuery();
        }

        this.init = function(){};
    },
    monitorQuery: function(){
        var self = this;
        var url = document.location.href;
        window.setInterval(
            function(){
                if(url != document.location.href){
                    var querya = document.location.href.match(/q=([^&]+)(&|$)/);
                    var query = "";
                    if(querya && querya.length > 0){
                        query = querya[1].replace(/\+/g, "%20");
                    }

                    if(query != self.query){
                        window.setTimeout(
                            function(){
                                self.addThumbnails();
                            }, 500
                        );
                    } else {
                    // also check for page change
                        var snmatch = document.location.href.match(/start=([^&]+)(&|$)/);
                        var startNum = 0;
                        if(snmatch){
                            startNum = parseInt(snmatch[1]);
                        }

                        if(this.startNum != startNum){
                            window.setTimeout(
                                function(){
                                    self.addThumbnails();
                                }, 500
                            );
                        }
                    }
                    url = document.location.href;
                }
            }, 500);
        this.monitorQuery = function(){};
    }
};

    // let's get the ball rolling
    window.setTimeout(
        function(){
            window.XmarksThumbnails.init();
        },
        (window.XmarksThumbnails._getInternetExplorerVersion() == -1 ?
            0 : 800)
    );
}
})();
