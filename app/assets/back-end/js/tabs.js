;
(function (window) {

    'use strict';

    function extend(a, b) {
        for (var key in b) {
            if (b.hasOwnProperty(key)) {
                a[key] = b[key];
            }
        }
        return a;
    }

    function CBPFWTabs(el, options) {
        this.el = el;
        this.options = extend({}, this.options);
        extend(this.options, options);
        this._init();
    }

    CBPFWTabs.prototype.options = {
        start: 0
    };

    CBPFWTabs.prototype._init = function () {
        // tabs elems
        this.tabs = [].slice.call(this.el.querySelectorAll('nav > ul > li'));
        // content items
        this.items = [].slice.call(this.el.querySelectorAll('.content-wrap > section'));
        // current index
        this.current = -1;
        // show current content item
        this._show();
        // init events
        this._initEvents();
    };

    CBPFWTabs.prototype._initEvents = function () {
        var self = this;
        this.tabs.forEach(function (tab, idx) {
            tab.addEventListener('click', function (ev) {
                ev.preventDefault();
                self._show_2(idx);
            });
        });
    };

    CBPFWTabs.prototype._show = function (idx) {
        if (this.current >= 0) {
            this.tabs[ this.current ].className = this.items[ this.current ].className = '';
        }
        var section = this._getUrlVars()["section"];
        if (section !== '') {
            var tab_loc, current, loc_href;
            jQuery('.tabs ul li').each(function () {
                tab_loc = jQuery(this).find('a');
                loc_href = jQuery(tab_loc).attr('href');
                if (loc_href === '#section_' + section) {
                    current = jQuery(tab_loc).parent().index();
                }
            });
        }

        if (typeof current !== 'undefined') {
            this.tabs[ current ].className = 'tab-current';
            this.items[ current ].className = 'content-current';
        } else {
            // change current
            this.current = idx != undefined ? idx : this.options.start >= 0 && this.options.start < this.items.length ? this.options.start : 0;
            this.tabs[ this.current ].className = 'tab-current';
            this.items[ this.current ].className = 'content-current';
            jQuery("html, body").animate({scrollTop: 0}, 1);
        }
    };

    CBPFWTabs.prototype._show_2 = function (idx) {
        jQuery('.tabs ul li').each(function () {
            jQuery(this).removeClass('tab-current');
        });

        jQuery('.tabs div.content-wrap section').each(function () {
            jQuery(this).removeClass('content-current');
        });

        // change current
        this.current = idx != undefined ? idx : this.options.start >= 0 && this.options.start < this.items.length ? this.options.start : 0;
        this.tabs[ this.current ].className = 'tab-current';
        this.items[ this.current ].className = 'content-current';
        jQuery("html, body").animate({scrollTop: 0}, 1);

    };

    CBPFWTabs.prototype._getUrlVars = function () {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    };

    CBPFWTabs.prototype.buildUrl = function (base, key, value) {
        var sep = (base.indexOf('?') > -1) ? '&' : '?';
        //console.log(sep);
        return base + sep + key + '=' + value;
    };
    // add to global namespace
    window.CBPFWTabs = CBPFWTabs;
})(window);