(function() {
    this.JST || (this.JST = {});
    this.JST["search/applied_filters"] = (function() {
        this.JST || (this.JST = {});
        this.JST["search/applied_filters"] = Handlebars.template(function(Handlebars, depth0, helpers, partials, data) {
            this.compilerInfo = [2, ">= 1.0.0-rc.3"];
            helpers = helpers || Handlebars.helpers;
            data = data || {};
            var buffer = "",
            stack1,
            functionType = "function",
            escapeExpression = this.escapeExpression;
            buffer += '<li id="applied_filter_';
            if (stack1 = helpers.filter_id) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.filter_id;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '" class="label label-lightblue">\n	';
            if (stack1 = helpers.filter_display_name) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.filter_display_name;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '\n	<a href="#" class="filter_x_container"><i class="icon icon-remove"></i></a>\n</li>\n';
            return buffer
        });
        return this.JST["search/applied_filters"]
        }).call(this)
    }).call(this); (function() {
    this.JST || (this.JST = {});
    this.JST["search/blank_state"] = (function() {
        this.JST || (this.JST = {});
        this.JST["search/blank_state"] = Handlebars.template(function(Handlebars, depth0, helpers, partials, data) {
            this.compilerInfo = [2, ">= 1.0.0-rc.3"];
            helpers = helpers || Handlebars.helpers;
            data = data || {};
            var buffer = "",
            stack1,
            options,
            functionType = "function",
            escapeExpression = this.escapeExpression,
            self = this,
            blockHelperMissing = helpers.blockHelperMissing;
            function program1(depth0, data) {
                var buffer = "",
                stack1;
                buffer += "\n      <li>";
                stack1 = (typeof depth0 === functionType ? depth0.apply(depth0) : depth0);
                if (stack1 || stack1 === 0) {
                    buffer += stack1
                }
                buffer += "</li>\n    ";
                return buffer
            }
            buffer += '<li id="blank_state" class="panel-padding">\n  <h3>';
            if (stack1 = helpers.title) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.title;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '</h3>\n  <ul class="styled-list">\n    ';
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(1, program1, data),
                data: data
            };
            if (stack1 = helpers.tips) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.tips;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.tips) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "\n  </ul>\n</li>\n";
            return buffer
        });
        return this.JST["search/blank_state"]
        }).call(this)
    }).call(this); (function() {
    this.JST || (this.JST = {});
    this.JST["search/blank_state_error"] = (function() {
        this.JST || (this.JST = {});
        this.JST["search/blank_state_error"] = Handlebars.template(function(Handlebars, depth0, helpers, partials, data) {
            this.compilerInfo = [2, ">= 1.0.0-rc.3"];
            helpers = helpers || Handlebars.helpers;
            data = data || {};
            var buffer = "",
            stack1,
            options,
            self = this,
            functionType = "function",
            blockHelperMissing = helpers.blockHelperMissing,
            escapeExpression = this.escapeExpression;
            function program1(depth0, data) {
                return "behaving_badly"
            }
            function program3(depth0, data) {
                return "behaving_badly_wishlists"
            }
            function program5(depth0, data) {
                return "error_message"
            }
            buffer += '  <li id="blank_state">\n    <div id="blank_state_text">\n      <h3>';
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(1, program1, data),
                data: data
            };
            if (stack1 = helpers.t) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.t;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.t) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "</h3>\n      <p>";
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(3, program3, data),
                data: data
            };
            if (stack1 = helpers.t) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.t;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.t) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "</p>\n      <p>";
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(5, program5, data),
                data: data
            };
            if (stack1 = helpers.t) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.t;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.t) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += " ";
            if (stack1 = helpers.message) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.message;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + "</p>\n    </div>\n  </li>\n";
            return buffer
        });
        return this.JST["search/blank_state_error"]
        }).call(this)
    }).call(this); (function() {
    this.JST || (this.JST = {});
    this.JST["search/checkbox"] = (function() {
        this.JST || (this.JST = {});
        this.JST["search/checkbox"] = Handlebars.template(function(Handlebars, depth0, helpers, partials, data) {
            this.compilerInfo = [2, ">= 1.0.0-rc.3"];
            helpers = helpers || Handlebars.helpers;
            data = data || {};
            var buffer = "",
            stack1,
            options,
            functionType = "function",
            escapeExpression = this.escapeExpression,
            self = this,
            blockHelperMissing = helpers.blockHelperMissing;
            function program1(depth0, data) {
                return "disabled"
            }
            function program3(depth0, data) {
                return "disabled="
            }
            function program5(depth0, data) {
                return "checked"
            }
            function program7(depth0, data, depth1) {
                var buffer = "",
                stack1;
                buffer += "\n      <span class='label-recessed label-recessed-skinny position-right'>" + escapeExpression(((stack1 = depth1.facetCount), typeof stack1 === functionType ? stack1.apply(depth0) : stack1)) + "</span>\n    ";
                return buffer
            }
            buffer += "<li>\n  <label class='checkbox ";
            options = {
                hash: {},
                inverse: self.program(1, program1, data),
                fn: self.noop,
                data: data
            };
            if (stack1 = helpers.enabled) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.enabled;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.enabled) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "'>\n    <input type='checkbox' id='";
            if (stack1 = helpers.elementId) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.elementId;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + "' name='";
            if (stack1 = helpers.elementName) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.elementName;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + "' value='";
            if (stack1 = helpers.htmlValue) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.htmlValue;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + "' ";
            options = {
                hash: {},
                inverse: self.program(3, program3, data),
                fn: self.noop,
                data: data
            };
            if (stack1 = helpers.enabled) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.enabled;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.enabled) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += " ";
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(5, program5, data),
                data: data
            };
            if (stack1 = helpers.checked) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.checked;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.checked) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += ">\n    ";
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.programWithDepth(program7, data, depth0),
                data: data
            };
            if (stack1 = helpers.showFacetCount) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.showFacetCount;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.showFacetCount) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "\n    ";
            if (stack1 = helpers.label) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.label;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "\n  </label>\n</li>\n";
            return buffer
        });
        return this.JST["search/checkbox"]
        }).call(this)
    }).call(this); (function() {
    this.JST || (this.JST = {});
    this.JST.review_popover = Handlebars.template(function(Handlebars, depth0, helpers, partials, data) {
        this.compilerInfo = [2, ">= 1.0.0-rc.3"];
        helpers = helpers || Handlebars.helpers;
        data = data || {};
        var buffer = "",
        stack1,
        options,
        functionType = "function",
        escapeExpression = this.escapeExpression,
        self = this,
        blockHelperMissing = helpers.blockHelperMissing;
        function program1(depth0, data) {
            var buffer = "";
            buffer += '\n    <div class="panel-header-gray">\n      <h4>' + escapeExpression((typeof depth0 === functionType ? depth0.apply(depth0) : depth0)) + "</h4>\n    </div>\n  ";
            return buffer
        }
        function program3(depth0, data) {
            var buffer = "",
            stack1,
            options;
            buffer += '\n    <div class="panel-padding">\n      ';
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(4, program4, data),
                data: data
            };
            if (stack1 = helpers.user) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.user;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.user) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += '\n      <div class="speech-bubble position-right">\n        ';
            if (stack1 = helpers.comments) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.comments;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + "\n      </div>\n    </div>\n  ";
            return buffer
        }
        function program4(depth0, data) {
            var buffer = "",
            stack1;
            buffer += '\n        <a href="/users/show/';
            if (stack1 = helpers.id) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.id;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '" class="matte-media-box position-left">\n          <img height="36" width="36" alt="" src="';
            if (stack1 = helpers.thumbnail_url) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.thumbnail_url;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '">\n        </a>\n      ';
            return buffer
        }
        function program6(depth0, data) {
            return "read_all_reviews"
        }
        buffer += '<div class="tooltip tooltip-panel-light fade tooltip-panel-collapse popup popup-wide panel-border">\n  ';
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(1, program1, data),
            data: data
        };
        if (stack1 = helpers.title) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.title;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.title) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += "\n  ";
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(3, program3, data),
            data: data
        };
        if (stack1 = helpers.reviews) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.reviews;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.reviews) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += '\n  <div class="modal-footer modal-footer-short">\n    <a href="/rooms/';
        if (stack1 = helpers.hostingId) {
            stack1 = stack1.call(depth0, {
                hash: {},
                data: data
            })
            } else {
            stack1 = depth0.hostingId;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        buffer += escapeExpression(stack1) + '#reputation-mark">\n      ';
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(6, program6, data),
            data: data
        };
        if (stack1 = helpers.t) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.t;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.t) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += " &rarr;\n    </a>\n  </div>\n</div>\n\n";
        return buffer
    });
    return this.JST.review_popover
}).call(this); (function() {
    this.JST || (this.JST = {});
    this.JST.list_view_item = Handlebars.template(function(Handlebars, depth0, helpers, partials, data) {
        this.compilerInfo = [2, ">= 1.0.0-rc.3"];
        helpers = helpers || Handlebars.helpers;
        data = data || {};
        var buffer = "",
        stack1,
        options,
        functionType = "function",
        escapeExpression = this.escapeExpression,
        self = this,
        blockHelperMissing = helpers.blockHelperMissing;
        function program1(depth0, data) {
            return "alert"
        }
        function program3(depth0, data) {
            var buffer = "",
            stack1;
            buffer += 'data-host-id="';
            if (stack1 = helpers.id) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.id;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '"';
            return buffer
        }
        function program5(depth0, data) {
            var buffer = "",
            stack1,
            options;
            buffer += '\n        <img alt="';
            if (stack1 = helpers.name) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.name;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '" class="lazy search_thumbnail listing-default" width="';
            if (stack1 = helpers.thumbnail_width) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.thumbnail_width;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '" height="';
            if (stack1 = helpers.thumbnail_height) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.thumbnail_height;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '" ';
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(6, program6, data),
                data: data
            };
            if (stack1 = helpers.hosting_preload_src) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.hosting_preload_src;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.hosting_preload_src) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += ' data-original="';
            if (stack1 = helpers.thumbnail_url) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.thumbnail_url;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '" title="';
            if (stack1 = helpers.name) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.name;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '" width="114" height="74">\n      ';
            return buffer
        }
        function program6(depth0, data) {
            var buffer = "",
            stack1;
            buffer += 'src="';
            if (stack1 = helpers.hosting_preload_src) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.hosting_preload_src;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '"';
            return buffer
        }
        function program8(depth0, data) {
            var buffer = "",
            stack1;
            buffer += '\n        <img alt="';
            if (stack1 = helpers.name) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.name;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '" class="lazy search_thumbnail listing-default" width="';
            if (stack1 = helpers.thumbnail_width) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.thumbnail_width;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '" height="';
            if (stack1 = helpers.thumbnail_height) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.thumbnail_height;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '" data-original="';
            if (stack1 = helpers.thumbnail_url) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.thumbnail_url;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '" title="';
            if (stack1 = helpers.name) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.name;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '" width="114" height="74">\n      ';
            return buffer
        }
        function program10(depth0, data) {
            return '<div class="has_video"></div>'
        }
        function program12(depth0, data) {
            var buffer = "",
            stack1;
            buffer += '\n      <a href="/users/show/';
            if (stack1 = helpers.id) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.id;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '" class="inset-media-box">\n        <img alt="';
            if (stack1 = helpers.name) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.name;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '" height="36" class="lazy user-default"  data-original="';
            if (stack1 = helpers.thumbnail_url) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.thumbnail_url;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '" width="36">\n        <div class="shadow"></div>\n      </a>\n    ';
            return buffer
        }
        function program14(depth0, data) {
            return '\n      <span class="new_icon new_icon_bg"></span><span class="new_icon"></span>\n    '
        }
        function program16(depth0, data) {
            return "monthly"
        }
        function program18(depth0, data) {
            var buffer = "",
            stack1,
            options;
            buffer += "\n        ";
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(19, program19, data),
                data: data
            };
            if (stack1 = helpers.t) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.t;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.t) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "\n      ";
            return buffer
        }
        function program19(depth0, data) {
            return "per_month"
        }
        function program21(depth0, data) {
            var buffer = "",
            stack1,
            options;
            buffer += "\n        &nbsp;\n        ";
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(22, program22, data),
                data: data
            };
            if (stack1 = helpers.t) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.t;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.t) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "\n      ";
            return buffer
        }
        function program22(depth0, data) {
            return "per_night"
        }
        function program24(depth0, data) {
            var buffer = "",
            stack1;
            if (stack1 = helpers.room_type) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.room_type;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + " &mdash;";
            return buffer
        }
        function program26(depth0, data) {
            return 'class="max_width"'
        }
        function program28(depth0, data) {
            var buffer = "",
            stack1;
            buffer += '\n        > <span class="neighborhood-link" data-neighborhood-id="';
            if (stack1 = helpers.id) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.id;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '">';
            if (stack1 = helpers.name) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.name;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + "</span>\n      ";
            return buffer
        }
        function program30(depth0, data) {
            var buffer = "",
            stack1,
            options;
            buffer += '&mdash; <span class="distance">' + escapeExpression((typeof depth0 === functionType ? depth0.apply(depth0) : depth0)) + " ";
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(31, program31, data),
                data: data
            };
            if (stack1 = helpers.t) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.t;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.t) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "</span>";
            return buffer
        }
        function program31(depth0, data) {
            return "distance_away"
        }
        function program33(depth0, data) {
            var buffer = "",
            stack1;
            buffer += '\n    <div class="descriptor descriptor-debug">\n      ';
            stack1 = (typeof depth0 === functionType ? depth0.apply(depth0) : depth0);
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "\n    </div>\n  ";
            return buffer
        }
        function program35(depth0, data) {
            var buffer = "",
            stack1,
            options;
            buffer += '\n      <li class="badge badge_type_';
            if (stack1 = helpers.type) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.type;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '">\n        <span class="badge_image">\n          <span class="badge_text ';
            if (stack1 = helpers.type) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.type;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '">\n            ';
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(36, program36, data),
                data: data
            };
            if (stack1 = helpers.text) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.text;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.text) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "\n            ";
            options = {
                hash: {},
                inverse: self.program(38, program38, data),
                fn: self.noop,
                data: data
            };
            if (stack1 = helpers.text) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.text;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.text) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += '\n          </span>\n        </span>\n        <span class="badge_name">';
            if (stack1 = helpers.name) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.name;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + "</span>\n      </li>\n    ";
            return buffer
        }
        function program36(depth0, data) {
            return escapeExpression((typeof depth0 === functionType ? depth0.apply(depth0) : depth0))
            }
        function program38(depth0, data) {
            return "&nbsp;"
        }
        function program40(depth0, data) {
            var buffer = "",
            stack1,
            options;
            buffer += '\n    <a class="instant_book_icon_p2 btn small gray" href="/rooms/';
            if (stack1 = helpers.id) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.id;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '">\n      ';
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(41, program41, data),
                data: data
            };
            if (stack1 = helpers.t) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.t;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.t) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += '<i class="icon sm_instant_book_arrow"></i>\n    </a>\n    ';
            return buffer
        }
        function program41(depth0, data) {
            return "instant_book"
        }
        function program43(depth0, data) {
            return "wishlist_button_tooltip"
        }
        function program45(depth0, data) {
            return "wishlist_capitalized"
        }
        function program47(depth0, data) {
            var buffer = "",
            stack1,
            options;
            buffer += '\n    <div class="room-connections-wrapper">\n      <span class="room-connections-arrow"></span>\n      <div class="room-connections">\n        ';
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(48, program48, data),
                data: data
            };
            if (stack1 = helpers.fbBanner) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.fbBanner;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.fbBanner) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "\n\n        ";
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(69, program69, data),
                data: data
            };
            if (stack1 = helpers.has_relationships) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.has_relationships;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.has_relationships) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "\n\n      </div>\n    </div>\n  ";
            return buffer
        }
        function program48(depth0, data) {
            var buffer = "",
            stack1,
            options;
            buffer += '\n          <div class="fb-connect-bar">\n            <div class="fb-connect-bar-container">\n              <a data-tooltip-el="#fb-tooltip" class="fb-button-small" href="javascript:void(0);" data-ajaxUrl="/users/fbconnect_login" data-tooltip-position="bottom">\n                <span class="fb-button-small-text">';
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(49, program49, data),
                data: data
            };
            if (stack1 = helpers.t) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.t;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.t) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += '</span>\n              </a>\n              <div id="fb-tooltip" class="tooltip-panel tooltip fade">\n                <h4>';
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(51, program51, data),
                data: data
            };
            if (stack1 = helpers.t) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.t;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.t) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "</h4>\n                <p>";
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(53, program53, data),
                data: data
            };
            if (stack1 = helpers.t) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.t;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.t) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "</p>\n                <h4>";
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(55, program55, data),
                data: data
            };
            if (stack1 = helpers.t) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.t;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.t) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "</h4>\n                <p>";
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(57, program57, data),
                data: data
            };
            if (stack1 = helpers.t) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.t;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.t) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "</p>\n                <h4>";
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(59, program59, data),
                data: data
            };
            if (stack1 = helpers.t) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.t;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.t) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "</h4>\n                <p>";
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(61, program61, data),
                data: data
            };
            if (stack1 = helpers.t) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.t;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.t) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "</p>\n                <h4>";
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(63, program63, data),
                data: data
            };
            if (stack1 = helpers.t) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.t;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.t) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "</h4>\n                <p>";
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(65, program65, data),
                data: data
            };
            if (stack1 = helpers.t) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.t;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.t) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += '</p>\n              </div>\n            </div>\n            <div class="fb-connect-message">';
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(67, program67, data),
                data: data
            };
            if (stack1 = helpers.t) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.t;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.t) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "</div>\n          </div>\n        ";
            return buffer
        }
        function program49(depth0, data) {
            return "facebook_connect_with_facebook"
        }
        function program51(depth0, data) {
            return "search_tooltip_known_who_to_ask"
        }
        function program53(depth0, data) {
            return "search_tooltip_see_where_your_friends_have_stayed"
        }
        function program55(depth0, data) {
            return "search_tooltip_faster_to_use"
        }
        function program57(depth0, data) {
            return "search_tooltip_one_click_login_to_airbnb"
        }
        function program59(depth0, data) {
            return "search_tooltip_easier_to_book"
        }
        function program61(depth0, data) {
            return "search_tooltip_completes_your_profile_automatically"
        }
        function program63(depth0, data) {
            return "search_tooltip_dont_worry"
        }
        function program65(depth0, data) {
            return "search_tooltip_we_wont_post_to_facebook_wall"
        }
        function program67(depth0, data) {
            return "search_inline_facebook_connect_tooltip"
        }
        function program69(depth0, data) {
            var buffer = "",
            stack1,
            options;
            buffer += '\n          <ul class="unstyled">\n            ';
            options = {
                hash: {},
                inverse: self.noop,
                fn: self.program(70, program70, data),
                data: data
            };
            if (stack1 = helpers.relationships) {
                stack1 = stack1.call(depth0, options)
                } else {
                stack1 = depth0.relationships;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (!helpers.relationships) {
                stack1 = blockHelperMissing.call(depth0, stack1, options)
                }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "\n          </ul>\n        ";
            return buffer
        }
        function program70(depth0, data) {
            var buffer = "",
            stack1;
            buffer += '\n              <li>\n                <img height="28" width="28" alt="" class="lazy" data-original="';
            if (stack1 = helpers.pic_url_small) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.pic_url_small;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            buffer += escapeExpression(stack1) + '">\n                <div class="room-connections-title">\n                  ';
            if (stack1 = helpers.caption) {
                stack1 = stack1.call(depth0, {
                    hash: {},
                    data: data
                })
                } else {
                stack1 = depth0.caption;
                stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
            }
            if (stack1 || stack1 === 0) {
                buffer += stack1
            }
            buffer += "\n                </div>\n              </li>\n            ";
            return buffer
        }
        buffer += '<li id="room_';
        if (stack1 = helpers.id) {
            stack1 = stack1.call(depth0, {
                hash: {},
                data: data
            })
            } else {
            stack1 = depth0.id;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        buffer += escapeExpression(stack1) + '" class="search_result ';
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(1, program1, data),
            data: data
        };
        if (stack1 = helpers.selected) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.selected;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.selected) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += '" data-hosting-id="';
        if (stack1 = helpers.id) {
            stack1 = stack1.call(depth0, {
                hash: {},
                data: data
            })
            } else {
            stack1 = depth0.id;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        buffer += escapeExpression(stack1) + '" ';
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(3, program3, data),
            data: data
        };
        if (stack1 = helpers.user) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.user;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.user) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += '>\n  <div class="pop_image_small">\n    <a href="/rooms/';
        if (stack1 = helpers.id) {
            stack1 = stack1.call(depth0, {
                hash: {},
                data: data
            })
            } else {
            stack1 = depth0.id;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        buffer += escapeExpression(stack1) + '" class="image_link matte-media-box" title="';
        if (stack1 = helpers.name) {
            stack1 = stack1.call(depth0, {
                hash: {},
                data: data
            })
            } else {
            stack1 = depth0.name;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        buffer += escapeExpression(stack1) + '">\n      ';
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(5, program5, data),
            data: data
        };
        if (stack1 = helpers.preload) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.preload;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.preload) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += "\n      ";
        options = {
            hash: {},
            inverse: self.program(8, program8, data),
            fn: self.noop,
            data: data
        };
        if (stack1 = helpers.preload) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.preload;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.preload) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += "\n      ";
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(10, program10, data),
            data: data
        };
        if (stack1 = helpers.has_video) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.has_video;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.has_video) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += '\n      <div class="map_number">';
        if (stack1 = helpers.result_number) {
            stack1 = stack1.call(depth0, {
                hash: {},
                data: data
            })
            } else {
            stack1 = depth0.result_number;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        buffer += escapeExpression(stack1) + '</div>\n    </a>\n  </div>\n\n  <div class="user_thumb">\n    ';
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(12, program12, data),
            data: data
        };
        if (stack1 = helpers.user) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.user;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.user) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += '\n  </div>\n\n  <h3 class="room_title overflow-ellipsis">\n    <a class="name" href="/rooms/';
        if (stack1 = helpers.id) {
            stack1 = stack1.call(depth0, {
                hash: {},
                data: data
            })
            } else {
            stack1 = depth0.id;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        buffer += escapeExpression(stack1) + '">';
        if (stack1 = helpers.name) {
            stack1 = stack1.call(depth0, {
                hash: {},
                data: data
            })
            } else {
            stack1 = depth0.name;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += "</a>\n    ";
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(14, program14, data),
            data: data
        };
        if (stack1 = helpers.is_new_hosting) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.is_new_hosting;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.is_new_hosting) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += '\n  </h3>\n  <div class="price ';
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(16, program16, data),
            data: data
        };
        if (stack1 = helpers.staggered) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.staggered;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.staggered) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += '">\n    <div class="price_data">\n      <sup>';
        if (stack1 = helpers.currency_symbol_left) {
            stack1 = stack1.call(depth0, {
                hash: {},
                data: data
            })
            } else {
            stack1 = depth0.currency_symbol_left;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += "</sup>";
        if (stack1 = helpers.price) {
            stack1 = stack1.call(depth0, {
                hash: {},
                data: data
            })
            } else {
            stack1 = depth0.price;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        buffer += escapeExpression(stack1) + '<sup class="';
        if (stack1 = helpers.currency_symbol_right_class) {
            stack1 = stack1.call(depth0, {
                hash: {},
                data: data
            })
            } else {
            stack1 = depth0.currency_symbol_right_class;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        buffer += escapeExpression(stack1) + '">';
        if (stack1 = helpers.currency_symbol_right) {
            stack1 = stack1.call(depth0, {
                hash: {},
                data: data
            })
            } else {
            stack1 = depth0.currency_symbol_right;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += '</sup>\n    </div>\n    <div class="price_modifier">\n      ';
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(18, program18, data),
            data: data
        };
        if (stack1 = helpers.staggered) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.staggered;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.staggered) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += "\n\n      \n      ";
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(21, program21, data),
            data: data
        };
        if (stack1 = helpers.not_staggered) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.not_staggered;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.not_staggered) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += '\n    </div>\n  </div>\n  <div class="descriptor descriptor-gray overflow-ellipsis">\n    ';
        options = {
            hash: {},
            inverse: self.program(24, program24, data),
            fn: self.noop,
            data: data
        };
        if (stack1 = helpers.distance) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.distance;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.distance) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += "\n    <address ";
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(26, program26, data),
            data: data
        };
        if (stack1 = helpers.distance) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.distance;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.distance) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += ">";
        if (stack1 = helpers.address) {
            stack1 = stack1.call(depth0, {
                hash: {},
                data: data
            })
            } else {
            stack1 = depth0.address;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        buffer += escapeExpression(stack1) + "\n      ";
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(28, program28, data),
            data: data
        };
        if (stack1 = helpers.neighborhood) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.neighborhood;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.neighborhood) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += "\n    </address>\n    ";
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(30, program30, data),
            data: data
        };
        if (stack1 = helpers.distance) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.distance;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.distance) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += "\n  </div>\n  ";
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(33, program33, data),
            data: data
        };
        if (stack1 = helpers.debug_string) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.debug_string;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.debug_string) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += '\n  <ul class="reputation unstyled">\n    ';
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(35, program35, data),
            data: data
        };
        if (stack1 = helpers.badges) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.badges;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.badges) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += '\n  </ul>\n  <div class="buttons_container">\n    ';
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(40, program40, data),
            data: data
        };
        if (stack1 = helpers.instant_book) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.instant_book;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.instant_book) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += '\n    <a class="wish_list_button not_saved btn small gray" data-hosting_id="';
        if (stack1 = helpers.id) {
            stack1 = stack1.call(depth0, {
                hash: {},
                data: data
            })
            } else {
            stack1 = depth0.id;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        buffer += escapeExpression(stack1) + '" data-img="';
        if (stack1 = helpers.thumbnail_url) {
            stack1 = stack1.call(depth0, {
                hash: {},
                data: data
            })
            } else {
            stack1 = depth0.thumbnail_url;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        buffer += escapeExpression(stack1) + '" data-name="';
        if (stack1 = helpers.name) {
            stack1 = stack1.call(depth0, {
                hash: {},
                data: data
            })
            } else {
            stack1 = depth0.name;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        buffer += escapeExpression(stack1) + '" data-address="';
        if (stack1 = helpers.address) {
            stack1 = stack1.call(depth0, {
                hash: {},
                data: data
            })
            } else {
            stack1 = depth0.address;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        buffer += escapeExpression(stack1) + '" rel="tooltip" title="';
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(43, program43, data),
            data: data
        };
        if (stack1 = helpers.t) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.t;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.t) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += '">\n      <i class="icon icon-product-wishlist pink"></i>\n      <span class="text saved">';
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(45, program45, data),
            data: data
        };
        if (stack1 = helpers.t) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.t;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.t) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += '</span>\n      <span class="text not_saved">';
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(45, program45, data),
            data: data
        };
        if (stack1 = helpers.t) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.t;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.t) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += "</span>\n    </a>\n  </div>\n\n  ";
        options = {
            hash: {},
            inverse: self.noop,
            fn: self.program(47, program47, data),
            data: data
        };
        if (stack1 = helpers.showConnectionsBanner) {
            stack1 = stack1.call(depth0, options)
            } else {
            stack1 = depth0.showConnectionsBanner;
            stack1 = typeof stack1 === functionType ? stack1.apply(depth0) : stack1
        }
        if (!helpers.showConnectionsBanner) {
            stack1 = blockHelperMissing.call(depth0, stack1, options)
            }
        if (stack1 || stack1 === 0) {
            buffer += stack1
        }
        buffer += "\n</li>\n";
        return buffer
    });
    return this.JST.list_view_item
}).call(this); (function($, e, b) {
    var c = "hashchange",
    h = document,
    f,
    g = $.event.special,
    i = h.documentMode,
    d = "on" + c in e && (i === b || i > 7);
    function a(j) {
        j = j || location.href;
        return "#" + j.replace(/^[^#]*#?(.*)$/, "$1")
        }
    $.fn[c] = function(j) {
        return j ? this.bind(c, j) : this.trigger(c)
        };
    $.fn[c].delay = 50;
    g[c] = $.extend(g[c], {
        setup: function() {
            if (d) {
                return false
            }
            $(f.start)
            },
        teardown: function() {
            if (d) {
                return false
            }
            $(f.stop)
            }
    });
    f = (function() {
        var j = {},
        p,
        m = a(),
        k = function(q) {
            return q
        },
        l = k,
        o = k;
        j.start = function() {
            p || n()
            };
        j.stop = function() {
            p && clearTimeout(p);
            p = b
        };
        function n() {
            var r = a(),
            q = o(m);
            if (r !== m) {
                l(m = r, q);
                $(e).trigger(c)
                } else {
                if (q !== m) {
                    location.href = location.href.replace(/#.*/, "") + q
                }
            }
            p = setTimeout(n, $.fn[c].delay)
            }
        $.browser.msie && !d && (function() {
            var q,
            r;
            j.start = function() {
                if (!q) {
                    r = $.fn[c].src;
                    r = r && r + a();
                    q = $('<iframe tabindex="-1" title="empty"/>').hide().one("load", function() {
                        r || l(a());
                        n()
                        }).attr("src", r || "javascript:0").insertAfter("body")[0].contentWindow;
                    h.onpropertychange = function() {
                        try {
                            if (event.propertyName === "title") {
                                q.document.title = h.title
                            }
                        } catch(s) {}
                    }
                }
            };
            j.stop = k;
            o = function() {
                return a(q.location.href)
                };
            l = function(v, s) {
                var u = q.document,
                t = $.fn[c].domain;
                if (v !== s) {
                    u.title = h.title;
                    u.open();
                    t && u.write('<script>document.domain="' + t + '"<\/script>');
                    u.close();
                    q.location.hash = v
                }
            }
        })();
        return j
    })()
    })(jQuery, this); (function(Airbnb, $, window) {
    var FBC = Airbnb.FBConnect = {},
    HASH_TOKEN = "#fbconnect_",
    AJAX_DIALOG_PREFIX = "/users/fbconnect_",
    FIRST_ACTION = "login",
    EVENT_PREFIX = "fbconnect_",
    $document = $(document),
    $window = $(window),
    defaultOptions = {
        onComplete: function() {
            window.location.reload()
            }
    },
    eventsBound = false;
    FBC.documentReady = function() {
        FBC._resetHash()
        };
    FBC.startLoginFlow = function(options) {
        if (typeof FB === "undefined") {
            return
        }
        options = $.extend(options, defaultOptions);
        FB.login(function(response) {
            if (response.authResponse) {
                FBC.trigger("connect_success");
                $.post(AJAX_DIALOG_PREFIX + FIRST_ACTION, function(response) {
                    FBC._colorbox(response);
                    window.location.hash = $(".fbconnect_dialog").attr("id");
                    setTimeout(function() {
                        FBC._bindEvents(options)
                        }, 400)
                    })
                } else {
                FBC.trigger("connect_cancel")
                }
        }, {
            scope: Airbnb.FACEBOOK_PERMS
        })
        };
    FBC._loadDialog = function(action) {
        FBC._beginLoad();
        $.get(AJAX_DIALOG_PREFIX + action, function(response) {
            FBC._finishLoad(response)
            })
        };
    FBC._loadDialogPost = function($form) {
        FBC._beginLoad();
        $.post($form.attr("action"), $form.serialize(), function(response) {
            FBC._finishLoad(response)
            })
        };
    FBC._beginLoad = function() {
        $.colorbox.loading();
        FBC.trigger("load_begin")
        };
    FBC._finishLoad = function(response) {
        FBC._colorbox(response);
        FBC.trigger("load_complete");
        FBC._initAjaxForm();
        if (FBC._isEndOfTheLine()) {
            $.colorbox.noClose()
            }
    };
    FBC._colorbox = function(response) {
        $.colorbox({
            html: response,
            overlayClose: false
        })
        };
    FBC._initAjaxForm = function() {
        $("#colorbox form").submit(function() {
            FBC._loadDialogPost($(this));
            return false
        })
        };
    FBC._bindEvents = function(options) {
        if (!eventsBound) {
            $document.bind("cbox_cleanup", function() {
                if (FBC._isEndOfTheLine()) {
                    options.onComplete();
                    FBC.trigger("complete")
                    } else {
                    FBC.trigger("bail");
                    FBC._resetHash()
                    }
                $window.unbind("hashchange.fbconnect")
                });
            $("#cboxContent a[rel]").live("click", function() {
                var $a = $(this),
                action = $a.attr("href").split(HASH_TOKEN)[1];
                if ($a.attr("rel") === "back") {
                    history.go( - 1);
                    return false
                }
            })
            }
        eventsBound = true;
        $window.bind("hashchange.fbconnect", function() {
            var action = window.location.hash.split(HASH_TOKEN)[1];
            if (action && action.length) {
                FBC._loadDialog(action)
                }
        })
        };
    FBC._isEndOfTheLine = function() {
        return $(".fbconnect_dialog.end_of_the_line").length > 0
    };
    FBC.getUid = function() {
        return FB.getAuthResponse().userID
    };
    FBC.trigger = function(eventName) {
        $document.trigger(EVENT_PREFIX + eventName)
        };
    FBC.bind = function() {
        var args = Array.prototype.slice.call(arguments, 0);
        args[0] = EVENT_PREFIX + args[0];
        $.fn.bind.apply($document, args)
        };
    FBC.one = function() {
        var args = Array.prototype.slice.call(arguments, 0);
        args[0] = EVENT_PREFIX + args[0];
        $.fn.one.apply($document, args)
        };
    FBC._resetHash = function() {
        if (window.location.hash.indexOf("fbconnect_") !== -1) {
            window.location.hash = ""
        }
    };
    $(document).ready(FBC.documentReady)
    })(Airbnb, jQuery, window); (function(window, $) {
    var modal = require("o2-modal");
    var SearchFilters = {
        defaults: {
            callbackFunction: "AirbnbSearch.loadNewResults",
            maxFilters: 4
        },
        has_photo: [],
        host_has_photo: [],
        languages: [],
        property_type_id: [],
        top_neighborhoods: [],
        neighborhoods: [],
        top_amenities: [],
        amenities: [],
        min_bedrooms: [],
        min_beds: [],
        min_bathrooms: [],
        group_ids: [],
        room_types: [[0, [t("private_room"), 0]], [1, [t("shared_room"), 0]], [2, [t("entire_place"), 0]]],
        minPrice: 10,
        maxPrice: 300,
        minPriceMonthly: 150,
        maxPriceMonthly: 5000,
        per_month: false,
        init: function() {
            if (this.initialized) {
                return
            }
            this.$el = $("#search_filters");
            this.$appliedFilters = $("#applied_filters");
            if ($(window).height() < (this.$el.height() + this.$el.offset().top)) {
                this.collapseFilters();
                this.$el.find(".filter_header").first().click()
                }
            $("#results_filters").delegate(".filter_x_container", "click", function(e) {
                SearchFilters.appliedFilterXCallback(this);
                e.preventDefault()
                });
            this.initialized = true;
            this.initExpandMap()
            },
        hasFilters: function() {
            return this.$appliedFilters && this.$appliedFilters.html() !== ""
        },
        initExpandMap: function() {
            var $a = $(".expand_map");
            $a.click(function(e) {
                if (AirbnbSearch.currentViewType === "list") {
                    AirbnbSearch.searchView.displaySearchType("search_type_map")
                    } else {
                    AirbnbSearch.searchView.displaySearchType("search_type_list")
                    }
                e.preventDefault()
                })
            },
        collapseFilters: function() {
            this.$el.find(".search_filter:not(.closed) .filter_header").click()
            },
        initPriceSlider: function() {
            var price_min = AirbnbSearch.params.price_min,
            price_max = AirbnbSearch.params.price_max;
            $("#slider-range").slider({
                range: true,
                min: SearchFilters.minPrice,
                max: SearchFilters.maxPrice,
                step: 5,
                values: [(price_min ? parseInt(price_min, 10) : SearchFilters.minPrice), (price_max ? parseInt(price_max, 10) : SearchFilters.maxPrice)],
                slide: function(event, ui) {
                    SearchFilters.applyPriceSliderChanges(ui)
                    },
                change: function(event) {
                    if (event && event.originalEvent && event.originalEvent.type === "mouseup") {
                        AirbnbSearch.loadNewResults()
                        }
                }
            });
            SearchFilters.applyPriceSliderChanges()
            },
        applyPriceSliderChanges: function(ui) {
            var sliderMax = $("#slider-range").slider("option", "max");
            if (ui !== undefined) {
                $("#slider_user_min").html([AirbnbSearch.currencySymbolLeft, ui.values[0], AirbnbSearch.currencySymbolRight].join(""));
                $("#slider_user_max").html([AirbnbSearch.currencySymbolLeft, ui.values[1], (ui.values[1] === sliderMax) ? "+ ": "", AirbnbSearch.currencySymbolRight].join(""))
                } else {
                $("#slider_user_min").html([AirbnbSearch.currencySymbolLeft, $("#slider-range").slider("values")[0], AirbnbSearch.currencySymbolRight].join(""));
                $("#slider_user_max").html([AirbnbSearch.currencySymbolLeft, $("#slider-range").slider("values")[1], ($("#slider-range").slider("values")[1] === sliderMax) ? "+ ": "", AirbnbSearch.currencySymbolRight].join(""))
                }
        },
        setPriceFilterParams: function(newParams) {
            var $slider = $("#slider-range"),
            sliderAbsoluteMin = $slider.slider("option", "min"),
            sliderAbsoluteMax = $slider.slider("option", "max"),
            sliderMin = $slider.slider("values", 0),
            sliderMax = $slider.slider("values", 1),
            sliderValueChanged;
            newParams.price_min = sliderAbsoluteMin !== sliderMin ? sliderMin: "";
            newParams.price_max = sliderAbsoluteMax !== sliderMax ? sliderMax: ""
        },
        checkPriceFilterLimitChange: function() {
            var json = AirbnbSearch.resultsJson,
            params = AirbnbSearch.params,
            toMonthlyAndIsOutOfBounds,
            toNightlyAndIsOutOfBounds,
            needsReset;
            if (SearchFilters.per_month !== json.per_month) {
                SearchFilters.per_month = json.per_month;
                toMonthlyAndIsOutOfBounds = SearchFilters.per_month === true && (params.price_min < SearchFilters.minPriceMonthly || params.price_max < SearchFilters.minPriceMonthly);
                toNightlyAndIsOutOfBounds = SearchFilters.per_month !== true && (params.price_min > SearchFilters.maxPrice || params.price_max > SearchFilters.maxPrice);
                needsReset = toMonthlyAndIsOutOfBounds || toNightlyAndIsOutOfBounds;
                if (needsReset) {
                    $("#applied_filter_price").remove();
                    if (SearchFilters.hasFilters()) {
                        $("#results_filters").hide()
                        }
                    SearchFilters.setPriceSliderLimits(SearchFilters.per_month, true)
                    } else {
                    SearchFilters.setPriceSliderLimits(SearchFilters.per_month, false)
                    }
            }
        },
        setPriceSliderLimits: function(perMonth, reset) {
            var $slider = $("#slider-range"),
            min,
            max,
            plus;
            if (perMonth === true) {
                min = SearchFilters.minPriceMonthly;
                max = SearchFilters.maxPriceMonthly
            } else {
                min = SearchFilters.minPrice;
                max = SearchFilters.maxPrice
            }
            $slider.slider("option", "min", min);
            $slider.slider("option", "max", max);
            plus = "+ ";
            if (!reset && AirbnbSearch.params.price_min) {
                min = AirbnbSearch.params.price_min
            }
            if (!reset && AirbnbSearch.params.price_max) {
                max = AirbnbSearch.params.price_max;
                plus = ""
            }
            $slider.slider("values", 0, min);
            $slider.slider("values", 1, max);
            $("#slider_user_min").html([AirbnbSearch.currencySymbolLeft, min, AirbnbSearch.currencySymbolRight].join(""));
            $("#slider_user_max").html([AirbnbSearch.currencySymbolLeft, max, plus, AirbnbSearch.currencySymbolRight].join(""))
            },
        update: function(facets) {
            SearchFilters.setFacets(facets);
            SearchFilters.render()
            },
        setFacets: function(facets) {
            SearchFilters.connected = facets.connected || [];
            SearchFilters.room_types = facets.room_type || [];
            SearchFilters.top_neighborhoods = facets.top_neighborhoods || [];
            SearchFilters.neighborhoods = facets.neighborhood_facet || [];
            SearchFilters.top_amenities = facets.top_amenities || [];
            SearchFilters.amenities = facets.hosting_amenity_ids || [];
            SearchFilters.has_photo = facets.has_photo || [];
            SearchFilters.host_has_photo = facets.host_has_photo || [];
            SearchFilters.languages = facets.languages || [];
            SearchFilters.property_type_id = facets.property_type_id || [];
            SearchFilters.group_ids = facets.group_ids || []
            },
        render: function() {
            SearchFilters.init();
            SearchFilters.renderSocialConnections();
            SearchFilters.renderTopRoomTypes();
            SearchFilters.renderRoomTypes();
            SearchFilters.renderAmenities();
            SearchFilters.renderNeighborhoods();
            SearchFilters.renderLanguages();
            SearchFilters.renderGenericLightboxFacet("property_type_id");
            SearchFilters.renderGenericLightboxFacet("group_ids");
            SearchFilters.renderAppliedFilters();
            return true
        },
        setFiltersHeight: function() {
            var $filterContent = $(".search_filter_content");
            $filterContent.css("height", "auto");
            $filterContent.each(function(i, e) {
                var $c = $(e);
                $filterContent.css("height", $c.height())
                })
            },
        APPLIED_FILTER_NAMES: {
            neighborhoods: t("neighborhoods"),
            hosting_amenities: t("amenities"),
            room_types: t("room_type"),
            price: t("price"),
            keywords: t("keywords"),
            property_type_id: t("property_type"),
            min_bedrooms: t("bedrooms"),
            min_bathrooms: t("bathrooms"),
            min_beds: t("beds"),
            languages: t("languages"),
            collection: t("collection"),
            host: t("host"),
            group: t("group"),
            connections: t("connections"),
            unique: t("wishlisted")
            },
        renderAppliedFilters: function() {
            var APPLIED_FILTER_NAMES = this.APPLIED_FILTER_NAMES,
            params = AirbnbSearch.params,
            collectionName,
            label,
            hostLabel,
            groupLabel;
            this.$appliedFilters.empty();
            if (params.neighborhoods && params.neighborhoods.length > 0) {
                this.renderOneAppliedFilter("neighborhoods", APPLIED_FILTER_NAMES.neighborhoods)
                }
            if (params.price_max || params.price_min) {
                this.renderOneAppliedFilter("price", APPLIED_FILTER_NAMES.price)
                }
            if (params.hosting_amenities && params.hosting_amenities.length > 0) {
                this.renderOneAppliedFilter("hosting_amenities", APPLIED_FILTER_NAMES.hosting_amenities)
                }
            if (params.room_types && params.room_types.length > 0) {
                this.renderOneAppliedFilter("room_types", APPLIED_FILTER_NAMES.room_types)
                }
            if (params.keywords && params.keywords.length > 0) {
                this.renderOneAppliedFilter("keywords", APPLIED_FILTER_NAMES.keywords)
                }
            if (params.property_type_id && params.property_type_id.length > 0) {
                this.renderOneAppliedFilter("property_type_id", APPLIED_FILTER_NAMES.property_type_id)
                }
            if (params.min_bedrooms && params.min_bedrooms > 0) {
                this.renderOneAppliedFilter("min_bedrooms", APPLIED_FILTER_NAMES.min_bedrooms)
                }
            if (params.min_beds && params.min_beds > 0) {
                this.renderOneAppliedFilter("min_beds", APPLIED_FILTER_NAMES.min_beds)
                }
            if (params.min_bathrooms && params.min_bathrooms > 0) {
                this.renderOneAppliedFilter("min_bathrooms", APPLIED_FILTER_NAMES.min_bathrooms)
                }
            if (params.languages && params.languages.length > 0) {
                this.renderOneAppliedFilter("languages", APPLIED_FILTER_NAMES.languages)
                }
            if (params.connected) {
                this.renderOneAppliedFilter("connections", APPLIED_FILTER_NAMES.connections)
                }
            if (parseInt(params.sort, 10) === 11) {
                this.renderOneAppliedFilter("wishlisted", APPLIED_FILTER_NAMES.unique)
                }
            if (AirbnbSearch.includeCollectionParam()) {
                collectionName = AirbnbSearch.resultsJson.collection_name;
                label = APPLIED_FILTER_NAMES.collection;
                if (collectionName && collectionName !== "") {
                    label = [label, collectionName].join(": ")
                    }
                this.renderOneAppliedFilter("collections", label)
                }
            if (AirbnbSearch.includeHostParam()) {
                hostLabel = APPLIED_FILTER_NAMES.host;
                if (AirbnbSearch.hostName && AirbnbSearch.hostName !== "") {
                    hostLabel = [hostLabel, AirbnbSearch.hostName].join(": ")
                    }
                this.renderOneAppliedFilter("host", hostLabel)
                }
            if (AirbnbSearch.includeGroupParam()) {
                groupLabel = APPLIED_FILTER_NAMES.group;
                if (AirbnbSearch.groupName && AirbnbSearch.groupName !== "") {
                    groupLabel = [groupLabel, AirbnbSearch.groupName].join(": ")
                    }
                this.renderOneAppliedFilter("group", groupLabel)
                }
            $("#results_filters").toggle(this.hasFilters())
            },
        appliedFilterXCallback: function(xEl) {
            var loadNewResultsAfter = true,
            $appliedFilterLi = $(xEl).closest("li"),
            appliedFilterId = $appliedFilterLi.attr("id").replace("applied_filter_", "");
            switch (appliedFilterId) {
            case "languages":
            case "neighborhoods":
            case "property_type_id":
            case "room_types":
                this.clearCheckbox(appliedFilterId);
                break;
            case "min_bathrooms":
            case "min_bedrooms":
            case "min_beds":
                this.clearTextInput(appliedFilterId);
                break;
            case "price":
                this.clearPrice();
                break;
            case "hosting_amenities":
                this.clearCheckbox("amenities");
                break;
            case "keywords":
                this.clearKeywords();
                break;
            case "collections":
                this.clearCollections();
                break;
            case "host":
                this.clearHost();
                break;
            case "group":
                this.clearGroup();
                break;
            case "connections":
                this.clearCheckbox("connected");
                break;
            case "wishlisted":
                this.clearUniqueSort();
                break;
            default:
                break
            }
            $appliedFilterLi.remove();
            if (loadNewResultsAfter) {
                AirbnbSearch.loadNewResults()
                }
        },
        clearUniqueSort: function() {
            AirbnbSearch.params.sort = $("#sort").val();
            $("#unique-toggle").data("enabled", false)
            },
        clearCollections: function() {
            delete AirbnbSearch.params.collection_id
        },
        clearHost: function() {
            AirbnbSearch.forceHideHost = true
        },
        clearGroup: function() {
            AirbnbSearch.forceHideGroup = true
        },
        clearCheckbox: function(checkboxName) {
            $('input[name="' + checkboxName + '"]').removeAttr("checked")
            },
        clearTextInput: function(textInputId) {
            $("#" + textInputId).val("")
            },
        clearKeywords: function() {
            var keywords = $("#keywords");
            delete AirbnbSearch.params.keywords;
            keywords.val(keywords.attr("defaultValue"))
            },
        clearPrice: function() {
            SearchFilters.setPriceSliderLimits(SearchFilters.per_month, true);
            SearchFilters.applyPriceSliderChanges()
            },
        renderOneAppliedFilter: function(filterId, filterDisplayName) {
            this.$appliedFilters.append(JST["search/applied_filters"]({
                filter_id: filterId,
                filter_display_name: filterDisplayName
            }))
            },
        renderSocialConnections: function() {
            var socialConnections = SearchFilters.connected && SearchFilters.connected[0],
            selector = "#connections-container";
            $(selector).empty();
            if (socialConnections) {
                SearchFilters.buildCheckbox({
                    elementId: "connected",
                    elementName: "connected",
                    htmlValue: "connected",
                    label: t("social_connections"),
                    facetCount: socialConnections[1],
                    forceActive: true,
                    appendToElementSelector: selector,
                    checked: AirbnbSearch.params.connected
                })
                }
            $(selector).append('<li><a href="/social/" target="_blank">' + t("learn_more") + "!</a></li>")
            },
        renderTopRoomTypes: function() {
            $.each(SearchFilters.room_types, function(index, data) {
                var checked,
                checkboxId = ["#room_type_", index].join(""),
                $checkbox = $(checkboxId),
                facetCount = data[1][1];
                if (AirbnbSearch.params.room_types && $.inArray(data[0], AirbnbSearch.params.room_types) > -1) {
                    checked = true
                } else {
                    checked = false
                }
                facetCount = (facetCount > 0 ? facetCount: 0);
                $checkbox.attr("checked", checked);
                $checkbox.siblings("span.label-recessed").html(facetCount)
                })
            },
        renderRoomTypes: function() {
            var $container = $("#room-type-container").empty();
            $("#lightbox_filter_content_room_type").empty();
            $.each(SearchFilters.room_types, function(index, data) {
                var checked = false;
                if (AirbnbSearch.params.room_types && $.inArray(data[0], AirbnbSearch.params.room_types) > -1) {
                    checked = true
                }
                SearchFilters.buildCheckbox({
                    elementId: ["room_type_", index].join(""),
                    elementName: "room_types",
                    htmlValue: data[0],
                    label: data[1][0],
                    facetCount: data[1][1],
                    forceActive: true,
                    appendToElementSelector: "#room-type-container",
                    checked: checked
                });
                SearchFilters.buildCheckbox({
                    elementId: ["lightbox_room_type_", index].join(""),
                    elementName: "room_types",
                    htmlValue: data[0],
                    label: data[1][0],
                    forceActive: true,
                    facetCount: data[1][1],
                    appendToElementSelector: "#lightbox_filter_content_room_type",
                    checked: checked
                })
                });
            SearchFilters.appendShowMoreLink($container)
            },
        renderAmenities: function() {
            var counter = 0,
            $container = $("#amenities-container").empty(),
            amenitiesLength = SearchFilters.amenities ? parseInt(SearchFilters.amenities.length, 10) : 0,
            checked;
            $("#lightbox_container_amenities ul.search_filter_content").empty();
            if (parseInt(SearchFilters.top_amenities.length, 10) > 0) {
                $.each(SearchFilters.top_amenities, function(index, data) {
                    if (AirbnbSearch.params && AirbnbSearch.params.hosting_amenities && $.inArray(data[0].toString(), AirbnbSearch.params.hosting_amenities) > -1) {
                        checked = true
                    } else {
                        checked = false
                    }
                    if (index < SearchFilters.defaults.maxFilters) {
                        SearchFilters.buildCheckbox({
                            elementId: "amenity_" + index,
                            elementName: "amenities",
                            htmlValue: data[0],
                            label: data[1][0],
                            facetCount: data[1][1],
                            checked: checked,
                            appendToElementSelector: "#amenities-container"
                        })
                        }
                    counter++
                })
                }
            if (amenitiesLength > 0 && amenitiesLength > counter) {
                $.each(SearchFilters.amenities, function(index, data) {
                    var col = Math.floor(index * 2 / amenitiesLength),
                    colClass = ".col_" + col;
                    if (AirbnbSearch.params && AirbnbSearch.params.hosting_amenities && $.inArray(data[0].toString(), AirbnbSearch.params.hosting_amenities) > -1) {
                        checked = true
                    } else {
                        checked = false
                    }
                    if (counter === 0) {
                        SearchFilters.buildCheckbox({
                            elementId: "amenity_" + counter,
                            elementName: "amenities",
                            htmlValue: data[0],
                            label: data[1][0],
                            facetCount: data[1][1],
                            checked: checked,
                            appendToElementSelector: "#amenities-container"
                        })
                        }
                    SearchFilters.buildCheckbox({
                        elementId: "lightbox_amenity_" + counter,
                        elementName: "amenities",
                        htmlValue: data[0],
                        label: data[1][0],
                        facetCount: data[1][1],
                        checked: checked,
                        appendToElementSelector: ["#lightbox_container_amenities", colClass, "ul.search_filter_content"].join(" ")
                        });
                    counter++
                });
                if (SearchFilters.amenities.length > SearchFilters.defaults.maxFilters) {
                    SearchFilters.appendShowMoreLink($container)
                    }
            } else {
                $container.hide()
                }
            if (counter > 0) {
                $container.show()
                }
            return true
        },
        renderNeighborhoods: function() {
            var counter = 0,
            neighborhoodsLength = SearchFilters.neighborhoods ? parseInt(SearchFilters.neighborhoods.length, 10) : 0,
            $container = $("#neighborhoods-container").empty(),
            checked;
            $("#lightbox_container_neighborhoods ul.search_filter_content").empty();
            if (SearchFilters.top_neighborhoods && parseInt(SearchFilters.top_neighborhoods.length, 10) > 0) {
                $.each(SearchFilters.top_neighborhoods, function(index, data) {
                    if (AirbnbSearch.params && AirbnbSearch.params.neighborhoods && $.inArray(data[0], AirbnbSearch.params.neighborhoods) > -1) {
                        checked = true
                    } else {
                        checked = false
                    }
                    if (index < SearchFilters.defaults.maxFilters) {
                        SearchFilters.buildCheckbox({
                            elementId: "neighborhood_" + index,
                            elementName: "neighborhoods",
                            htmlValue: data[0],
                            label: data[1][0],
                            facetCount: data[1][1],
                            checked: checked,
                            appendToElementSelector: "#neighborhoods-container"
                        })
                        }
                    counter++
                })
                }
            if (SearchFilters.neighborhoods && neighborhoodsLength > 0 && neighborhoodsLength > counter) {
                $.each(SearchFilters.neighborhoods, function(index, data) {
                    var col,
                    colClass;
                    if (AirbnbSearch.params && AirbnbSearch.params.neighborhoods && $.inArray(data[0], AirbnbSearch.params.neighborhoods) > -1) {
                        checked = true
                    } else {
                        checked = false
                    }
                    if (counter === 0) {
                        SearchFilters.buildCheckbox({
                            elementId: "neighborhood_" + counter,
                            elementName: "neighborhoods",
                            htmlValue: data[0],
                            label: data[1][0],
                            facetCount: data[1][1],
                            checked: checked,
                            appendToElementSelector: "#neighborhoods-container"
                        })
                        }
                    col = Math.floor(index * 2 / neighborhoodsLength);
                    colClass = ".col_" + col;
                    SearchFilters.buildCheckbox({
                        elementId: "lightbox_neighborhood_" + counter,
                        elementName: "neighborhoods",
                        htmlValue: data[0],
                        label: data[1][0],
                        facetCount: data[1][1],
                        checked: checked,
                        appendToElementSelector: ["#lightbox_container_neighborhoods", colClass, "ul.search_filter_content"].join(" ")
                        });
                    counter++
                });
                if (SearchFilters.neighborhoods.length > SearchFilters.defaults.maxFilters) {
                    SearchFilters.appendShowMoreLink($container)
                    }
            } else {
                $container.hide()
                }
            if (counter > 0) {
                $container.show()
                }
            return true
        },
        renderLanguages: function() {
            var facetName = "languages",
            length = SearchFilters[facetName].length,
            checked;
            $([".lightbox_filter_content_", facetName].join("")).empty();
            $.each(SearchFilters[facetName], function(index, data) {
                var col = Math.floor(index * 2 / length),
                colClass = ".col_" + col;
                if (AirbnbSearch.params && AirbnbSearch.params[facetName] && AirbnbSearch.params[facetName] !== undefined && ($.inArray(data[0].toString(), AirbnbSearch.params[facetName]) > -1)) {
                    checked = true
                } else {
                    checked = false
                }
                SearchFilters.buildCheckbox({
                    elementId: ["lightbox_", facetName, "_", index].join(""),
                    elementName: facetName,
                    htmlValue: data[0],
                    label: data[1][0],
                    forceActive: true,
                    facetCount: data[1][1],
                    appendToElementSelector: [colClass, " .lightbox_filter_content_", facetName].join(""),
                    checked: checked
                })
                })
            },
        renderGenericLightboxFacet: function(facetName) {
            var checked;
            $(["#lightbox_filter_content_", facetName].join("")).empty();
            $.each(SearchFilters[facetName], function(index, data) {
                if (AirbnbSearch.params && AirbnbSearch.params[facetName] && AirbnbSearch.params[facetName] !== undefined && ($.inArray(data[0].toString(), AirbnbSearch.params[facetName]) > -1)) {
                    checked = true
                } else {
                    checked = false
                }
                SearchFilters.buildCheckbox({
                    elementId: ["lightbox_", facetName, "_", index].join(""),
                    elementName: facetName,
                    htmlValue: data[0],
                    label: data[1][0],
                    forceActive: true,
                    facetCount: data[1][1],
                    appendToElementSelector: ["#lightbox_filter_content_", facetName].join(""),
                    checked: checked
                })
                })
            },
        buildCheckbox: function(options) {
            var appendToElementSelector = options.appendToElementSelector || "",
            forceActive = options.forceActive,
            facetCount = options.facetCount;
            options = options || {};
            var context = {
                checked: !!options.checked,
                elementName: options.elementName || "",
                elementId: options.elementId || "",
                label: options.label || "",
                htmlValue: options.htmlValue.toString() || "",
                facetCount: facetCount >= 1000 ? "1000+": facetCount,
                showFacetCount: facetCount > 0,
                enabled: facetCount > 0 || options.checked || forceActive
            };
            var html = JST["search/checkbox"](context);
            if (appendToElementSelector) {
                $(appendToElementSelector).append(html)
                }
            return false
        },
        appendShowMoreLink: function(appendToElementSelector) {
            return $(appendToElementSelector).append("<li><a href='javascript:void(0);' class='show_more_link'>" + t("show_more") + "</a></li>")
            },
        openFiltersLightbox: function() {
            modal("#filters_lightbox");
            modal.open()
            },
        closeFiltersLightbox: function() {
            modal.close()
            },
        selectLightboxTab: function(inTab) {
            var tab = inTab || "room_type";
            $(".filters_lightbox_nav_element").removeClass("active");
            $(".lightbox_filter_container").hide();
            $("#lightbox_nav_" + tab).addClass("active");
            $("#lightbox_container_" + tab).show()
            },
        togglePriceFilter: function(show) {
            this.$el.find(".price-filter-container").toggle(show)
            }
    };
    window.SearchFilters = SearchFilters
})(this, jQuery); (function($, Backbone, Airbnb) {
    var AMM;
    var Sidebar = Backbone.View.extend({
        enabled: true,
        el: "#search_filters_wrapper",
        events: {
            "click .panel-header-light": "toggleFilter",
            "click .show_more_link": "openLightbox",
            "click #submit_keyword": "keywordsClick",
            "keyup #keywords": "keywordsSubmit"
        },
        filter: function() {
            this.trigger("filter")
            },
        keywordsClick: function(event) {
            event.preventDefault();
            this.filter()
            },
        keywordsSubmit: function(event) {
            var code = (event.keyCode ? event.keyCode: event.which);
            if (code === 13) {
                this.filter()
                }
        },
        toggle: function(eOrEnable) {
            var enable;
            if (typeof eOrEnable === "boolean") {
                enable = eOrEnable
            } else {
                enable = this.enabled = !this.enabled
            }
            this.$filters.toggle(enable);
            this.$el.toggleClass("collapsed", !enable);
            this.trigger("toggle", enable)
            },
        toggleFilter: function(e) {
            var $target = $(e.target),
            $targetHeader = $target.closest(".panel-header-light");
            $targetHeader.toggleClass("closed");
            $targetHeader.find(".icon").toggleClass("icon-caret-down").toggleClass("icon-caret-left");
            $targetHeader.next(".search_filter_content").toggleClass("closed");
            AirbnbSearch.$.trigger("filtertoggle")
            },
        reset: function() {
            var $filters = this.$filters;
            $filters.removeClass("fixed");
            if ($filters.css("position") === "absolute") {
                $filters.css({
                    position: "",
                    top: "0"
                })
                }
        },
        openLightbox: function(e) {
            var $target = $(e.target);
            var tabToSelect = $target.closest(".search_filter_content").attr("id").replace("-container", "");
            SearchFilters.openFiltersLightbox();
            SearchFilters.selectLightboxTab(tabToSelect)
            },
        initialize: function() {
            AMM = require("search/amm");
            var searchBodyBottom,
            searchBodyHeight,
            searchFiltersOrigTop;
            var $searchBody;
            var self = this;
            var $searchFilters = this.$filters = this.$el.children("#search_filters");
            var searchFiltersHeight = $searchFilters.height();
            if ($(window).height() < searchFiltersHeight) {
                return
            }
            $searchBody = $(this.options.container);
            searchFiltersOrigTop = $searchFilters.position().top;
            function adjustSearchFiltersPosition() {
                var scrollTop = $(window).scrollTop();
                var searchFiltersCurrTop = $searchFilters.offset().top;
                if ((scrollTop >= searchFiltersOrigTop) && (searchFiltersHeight < searchBodyHeight)) {
                    if (!$searchFilters.hasClass("fixed")) {
                        $searchFilters.addClass("fixed")
                        }
                    if (((searchFiltersHeight + searchFiltersCurrTop) >= searchBodyBottom) && scrollTop >= searchFiltersCurrTop) {
                        if ($searchFilters.css("position") !== "absolute") {
                            self.trigger("change:position", "absolute");
                            $searchFilters.css({
                                bottom: 0,
                                position: "absolute",
                                top: "auto"
                            })
                            }
                    } else {
                        if ($searchFilters.css("position") === "absolute") {
                            self.trigger("change:position", "auto");
                            $searchFilters.css({
                                bottom: "",
                                position: "",
                                top: 0
                            })
                            }
                    }
                } else {
                    self.reset()
                    }
            }
            function searchFiltersHeightChange() {
                searchFiltersHeight = $searchFilters.height();
                adjustSearchFiltersPosition();
                adjustSearchFiltersPosition()
                }
            AirbnbSearch.$.bind("finishedrendering", function() {
                searchFiltersOrigTop = $searchBody.offset().top;
                searchFiltersHeight = $searchFilters.height();
                searchBodyHeight = $searchBody.height();
                searchBodyBottom = $searchBody.offset().top + searchBodyHeight;
                if ((searchBodyHeight > searchFiltersHeight) && AirbnbSearch.currentViewType !== "map") {
                    $(window).scroll(adjustSearchFiltersPosition).scroll();
                    AirbnbSearch.$.bind("filtertoggle", searchFiltersHeightChange)
                    } else {
                    $(window).unbind("scroll", adjustSearchFiltersPosition);
                    AirbnbSearch.$.unbind("filtertoggle", searchFiltersHeightChange);
                    self.reset()
                    }
            })
            }
    });
    Airbnb.Sidebar = Sidebar
})(jQuery, Backbone, Airbnb); (function(Backbone, Airbnb) {
    var Hosting = Backbone.Model.extend({
        initialize: function() {
            var relationships = this.get("relationships");
            this.initBadges();
            this.set({
                showConnectionsBanner: relationships && (relationships.length > 0)
                })
            },
        initBadges: function() {
            var user;
            var badges = [];
            var other_review_count = this.get("other_review_count"),
            review_count = this.get("review_count");
            if (review_count > 0) {
                badges.push({
                    type: ((review_count > 99) ? "reviews-bubble-long": "reviews-bubble"),
                    text: review_count > 99 ? "99+": review_count,
                    name: t("review_with_smart_count", {
                        smart_count: review_count
                    })
                    })
                }
            if (other_review_count > 0) {
                badges.push({
                    type: (other_review_count > 99) ? "other-reviews-long": "other-reviews",
                    text: other_review_count > 99 ? "99+": other_review_count,
                    name: t("other_review_with_smart_count", {
                        smart_count: other_review_count
                    })
                    })
                }
            user = this.get("user");
            if (user && user.is_superhost) {
                badges.push({
                    type: "superhost",
                    name: t("superhost")
                    })
                }
            this.set({
                badges: badges
            })
            }
    });
    Airbnb.Hosting = Hosting
})(Backbone, Airbnb); ! function(Backbone, Airbnb) {
    var HostingList = Backbone.Collection.extend({
        model: Airbnb.Hosting
    });
    Airbnb.HostingList = HostingList
} (Backbone, Airbnb); ! function(window, Backbone, Airbnb) {
    var HostingListView = Backbone.View.extend({
        FB_BANNER_FREQUENCY: 0.333,
        TEMPLATE: "list_view_item",
        REVIEW_POPOVER_FADE_TIMEOUT: 200,
        el: "#results",
        events: {
            "mouseover .badge_type_other-reviews": "showOtherReviewsSummary",
            "mouseover .badge_type_other-reviews-long": "showOtherReviewsSummary",
            "mouseout .badge_type_other-reviews": "hideReviewsSummary",
            "mouseout .badge_type_other-reviews-long": "hideReviewsSummary",
            "mouseover .badge_type_reviews-bubble": "showThisReviewsSummary",
            "mouseover .badge_type_reviews-bubble-long": "showThisReviewsSummary",
            "mouseout .badge_type_reviews-bubble": "hideReviewsSummary",
            "mouseout .badge_type_reviews-bubble-long": "hideReviewsSummary"
        },
        hideReviewsSummary: function(e) {
            var that = this;
            this.reviewPopoverTimeout = setTimeout(function() {
                if (that.reviewPopover) {
                    that.reviewPopover.hide()
                    }
            }, this.REVIEW_POPOVER_FADE_TIMEOUT)
            },
        showThisReviewsSummary: function(e) {
            var $target = $(e.currentTarget);
            var $li = $target.closest(".search_result");
            clearTimeout(this.reviewPopoverTimeout);
            this.reviewPopover.showReviews($target, $li.data("host-id"), $li.data("hosting-id"))
            },
        showOtherReviewsSummary: function(e) {
            var $target = $(e.currentTarget);
            var $li = $target.closest(".search_result");
            clearTimeout(this.reviewPopoverTimeout);
            this.reviewPopover.showOtherReviews($target, $li.data("host-id"), $li.data("hosting-id"))
            },
        destroy: function() {
            this.undelegateEvents();
            this.hideOverlays()
            },
        hideOverlays: function() {
            if (this.reviewPopover) {
                this.reviewPopover.destroy()
                }
        },
        initialize: function() {
            this.$el.toggleClass("mini_prices", this.options.miniPrices);
            this.reviewPopover = new Airbnb.ReviewPopover()
            },
        render: function() {
            var viewOptions = this.options;
            var template = window.JST[this.TEMPLATE];
            var content = [];
            Handlebars.registerHelper("staggered", function(options) {
                if (this.staggered) {
                    return options.fn(this)
                    }
            });
            Handlebars.registerHelper("not_staggered", function(options) {
                if (this.not_staggered) {
                    return options.fn(this)
                    }
            });
            if (this.options.showFbBanner && (typeof this.options.fbBannerIndex === "undefined") && (Math.random() < this.FB_BANNER_FREQUENCY)) {
                this.options.fbBannerIndex = 0
            }
            this.collection.each(function(el, i) {
                var h = el.toJSON();
                h.currency_symbol_left = viewOptions.currency_symbol_left;
                h.currency_symbol_right = viewOptions.currency_symbol_right;
                h.fbBanner = (i === viewOptions.fbBannerIndex);
                h.result_number = (i + 1);
                h.showConnectionsBanner = h.showConnectionsBanner || h.fbBanner;
                h.thumbnail_height = viewOptions.thumbnail_height;
                h.thumbnail_width = viewOptions.thumbnail_width;
                h.has_relationships = !!(h.relationships && h.relationships.length);
                content.push(template(h))
                });
            this.$el.html(content.join(""));
            return {}
        }
    });
    Airbnb.HostingListView = HostingListView
} (this, Backbone, Airbnb); (function($, Backbone, Airbnb, HostingListView) {
    var AMM;
    function setThumbnails(style, dimensions) {
        this.$(".search_thumbnail").each(function(i, thumb) {
            var $thumb = $(thumb);
            var src = $thumb.attr("src");
            var original = $thumb.data("original");
            var updated = original.replace(AirbnbSearch.thumbnailRegex, "/" + style + ".jpg");
            $thumb.data("original", updated);
            if (src === original) {
                $thumb.attr("src", updated)
                }
            $thumb.attr("height", dimensions[0]);
            $thumb.attr("width", dimensions[1])
            })
        }
    function setActiveSearchTypeButton(button) {
        this.$activeSearchTypeButton.removeClass("active blue").addClass("gray");
        this.$activeSearchTypeButton = $(button).addClass("active blue").removeClass("gray")
        }
    var SearchView = Backbone.View.extend({
        el: "#v3_search",
        events: {
            "click .search_type_option": "displayView",
            "click #search_filters_toggle": "toggleFilters",
            "submit #search_form": "loadNewResults"
        },
        initialize: function() {
            AMM = require("search/amm");
            var $el = this.$el;
            var sidebar = this.sidebar = new Airbnb.Sidebar({
                container: "#search_body"
            });
            this.$activeSearchTypeButton = this.$(".search_type_option.active");
            this.$mapWrapper = this.$("#map_wrapper");
            this.$filterToggle = this.$("#search_filters_toggle");
            sidebar.on("change:position", function(position) {
                if (position === "absolute") {
                    $el.css({
                        position: "relative"
                    })
                    } else {
                    $el.css({
                        position: ""
                    })
                    }
            });
            sidebar.on("filter", function() {
                AirbnbSearch.loadNewResults()
                });
            $el.find("input").placeholder()
            },
        toggleFilters: function() {
            if (AirbnbSearch.currentViewType === "map") {
                this.sidebar.toggle();
                if (this.sidebar.enabled) {
                    this.$mapWrapper.removeClass("span12 span12-margined").addClass("span9 offset3").find("#search_map").width(740)
                    } else {
                    this.$mapWrapper.addClass("span12 span12-margined").removeClass("span9 offset3").find("#search_map").width(970)
                    }
                this.$filterToggle.find(".icon").toggleClass("icon-caret-left", this.sidebar.enabled).toggleClass("icon-caret-right", !this.sidebar.enabled);
                google.maps.event.trigger(AMM.map, "resize")
                }
        },
        setHostingList: function(options) {
            var result,
            oldListView;
            var self = this;
            var skipRender = options.skipRender;
            delete options.skipRender;
            oldListView = this.hostingListView;
            this.hostingListView = new HostingListView(options);
            this.hostingListView.on("datechange", function(data) {
                self.trigger("datechange", data)
                });
            if (oldListView) {
                oldListView.destroy()
                }
            if (!skipRender) {
                result = this.hostingListView.render()
                }
            this.$("img.lazy").removeClass("lazy").lazyload()
            },
        displaySearchType: function(searchTypeString, renderResults) {
            var thumbnailStyle,
            el = {
                mapWrapper: $("#map_wrapper"),
                mapMessage: $("#map_message"),
                mapOptions: $("#map_options"),
                searchBody: $("#search_body"),
                searchFilters: $("#search_filters")
                };
            el.mapMessage.hide();
            renderResults = (typeof(renderResults) === "undefined") ? true: renderResults;
            var changingFromType = AirbnbSearch.currentViewType,
            newType = searchTypeString.replace("search_type_", "");
            if (changingFromType === newType) {
                return false
            }
            $(".expand_map_container").removeClass(changingFromType).addClass(newType);
            AirbnbSearch.changing_display_type = true;
            var center = AMM.map.getCenter();
            var bounds = AMM.map.getBounds();
            var zoom = AMM.map.getZoom();
            if (searchTypeString === "search_type_photo") {
                AirbnbSearch.currentViewType = "photo";
                this.$el.removeClass("list_view map_view").addClass("photo_view");
                thumbnailStyle = "small";
                el.mapWrapper.removeClass("span9 offset3")
                } else {
                if (searchTypeString === "search_type_list") {
                    AirbnbSearch.currentViewType = "list";
                    this.$el.removeClass("map_view photo_view").addClass("list_view");
                    thumbnailStyle = "x_small";
                    el.mapWrapper.removeClass("span9 offset3")
                    } else {
                    if (searchTypeString === "search_type_map") {
                        AirbnbSearch.currentViewType = "map";
                        AirbnbSearch.hideBannerForRemainderOfSession = true;
                        AirbnbSearch.loadNewResults();
                        this.$el.removeClass("list_view photo_view").addClass("map_view");
                        $("#results_filters").insertAfter("#top_banner");
                        $("#results_save").insertAfter("#applied_filters");
                        el.mapWrapper.insertAfter(el.searchBody).addClass("span9 offset3");
                        el.mapOptions.prependTo(el.searchFilters);
                        AMM.clearOverlays();
                        $.each(AirbnbSearch.resultsJson.properties, function(i, hosting) {
                            AMM.queue.push(hosting.id)
                            });
                        AMM.showOverlays();
                        google.maps.event.addListenerOnce(AMM.map, "resize", function() {
                            if (bounds != null) {
                                AMM.map.fitBounds(bounds)
                                }
                            AMM.map.setCenter(center);
                            AMM.map.setZoom(zoom + 2)
                            });
                        google.maps.event.trigger(AMM.map, "resize")
                        }
                }
            }
            setActiveSearchTypeButton.call(this, this.$("#" + searchTypeString));
            if (searchTypeString === "search_type_list" || searchTypeString === "search_type_photo") {
                if (renderResults) {
                    AMM.closeInfoWindow()
                    }
                setThumbnails.call(this, thumbnailStyle, AirbnbSearch.thumbnailStyles[thumbnailStyle]);
                if (changingFromType === "map") {
                    $("#results_filters").insertAfter("#results_header");
                    $("#results_save").appendTo("#results_header");
                    if (renderResults) {
                        AirbnbSearch.loadNewResults()
                        }
                    el.mapWrapper.appendTo("#map-container");
                    el.mapOptions.prependTo(el.searchFilters);
                    google.maps.event.addListenerOnce(AMM.map, "resize", function() {
                        if (bounds != null) {
                            AMM.map.fitBounds(bounds)
                            }
                        AMM.map.setCenter(center);
                        AMM.map.setZoom(AMM.map.getZoom() + 1)
                        });
                    google.maps.event.trigger(AMM.map, "resize")
                    } else {
                    AirbnbSearch.setParamsFromDom();
                    AirbnbSearch.markUrlAsModified()
                    }
            }
            this.sidebar.toggle(true);
            AirbnbSearch.$.trigger("finishedrendering");
            AirbnbSearch.changing_display_type = false
        },
        displayView: function(e) {
            var targetSearchTypeButton = e.target;
            setActiveSearchTypeButton.call(this, targetSearchTypeButton);
            this.displaySearchType(targetSearchTypeButton.id);
            e.preventDefault()
            },
        hideOverlays: function() {
            if (this.hostingListView) {
                this.hostingListView.hideOverlays()
                }
        },
        loadNewResults: function(e) {
            AirbnbSearch.loadNewResults();
            e.preventDefault()
            }
    });
    Airbnb.SearchView = SearchView
})(jQuery, Backbone, Airbnb, Airbnb.HostingListView); ! function(window, $, Backbone, Airbnb) {
    var Router = Backbone.Router.extend({
        ROOT: window.history && window.history.pushState ? "/s/": window.location.pathname,
        routes: {
            "*path": "search"
        },
        initialize: function() {
            var newLoc;
            var history = window.history,
            loc = window.location;
            if (history && history.pushState && loc.hash) {
                newLoc = "";
                if (loc.search) {
                    newLoc += loc.search.substr(1) + "&"
                }
                newLoc += loc.hash.substr(1);
                history.replaceState({}, document.title, loc.origin + loc.pathname + "?" + newLoc)
                }
        },
        search: function() {
            var params = $.query.load(window.location.href).keys;
            if (! ("location" in params)) {
                params.location = Airbnb.SearchUtils.get_location_from_pathname(window.location)
                }
            AirbnbSearch.params = $.extend({}, AirbnbSearch.DEFAULT_PARAMS, params);
            AirbnbSearch.loadNewResults({
                pushState: true
            })
            }
    });
    Airbnb.Router = Router
} (this, jQuery, Backbone, Airbnb); ! function(window, require, Backbone, Airbnb) {
    var Tooltip = require("o2-tooltip");
    var SHOW_TIMEOUT = 150;
    var Cache = {
        MAX_SIZE: 5,
        get: function(key) {
            var i = _.indexOf(this.keysAccessed, key);
            if (i >= 0) {
                this.keysAccessed.splice(i, 1);
                this.keysAccessed.push(key)
                }
            return this.store[key]
            },
        set: function(key, value) {
            var deadKey;
            this.store[key] = value;
            this.keysAccessed.push(key);
            if (this.keysAccessed.length > this.MAX_SIZE) {
                deadKey = this.keysAccessed.splice(0, 1);
                delete this.store[deadKey]
                }
        },
        reset: function() {
            this.keysAccessed = [];
            this.store = {}
        },
        keysAccessed: [],
        store: {}
    };
    function show(element, userId, hostingId, url, options) {
        var el = element[0];
        var that = this;
        options = options || {};
        options.hostingId = hostingId;
        if (this.visible && (el === this.el)) {
            return
        } else {
            this.persist = false;
            this.hide()
            }
        this.setElement(el);
        this.showTimeout = setTimeout(function() {
            var cached;
            var replacedUrl = url.replace(":id", userId).replace(":hostingId", hostingId);
            var icon = element.find(".badge_image");
            var offset = icon.offset();
            var left = offset.left + (icon.width() / 2) - 2;
            that.hide();
            cached = Cache.get(replacedUrl);
            if (cached) {
                that.render(left, offset.top, cached)
                } else {
                that.activeRequest = $.getJSON(replacedUrl, function(data) {
                    var extendedData = _.extend(data, options);
                    Cache.set(replacedUrl, extendedData);
                    that.render(left, offset.top, extendedData)
                    })
                }
        }, SHOW_TIMEOUT)
        }
    var ReviewPopover = Backbone.View.extend({
        TEMPLATE: "review_popover",
        destroy: function() {
            this.persist = false;
            this.hide();
            Cache.reset()
            },
        hide: function() {
            if (this.persist) {
                return
            }
            $(document).unbind(".review_popover");
            if (this.tooltip) {
                this.tooltip.remove()
                }
            if (this.activeRequest) {
                this.activeRequest.abort();
                this.activeRequest = null
            }
            if (this.showTimeout) {
                clearTimeout(this.showTimeout);
                this.showTimeout = null
            }
            this.visible = false
        },
        render: function(left, top, data) {
            var that = this;
            var tooltip = this.tooltip = new Tooltip($(window.JST[this.TEMPLATE](data)), {
                x: left,
                y: top,
                position: "top"
            });
            tooltip.fadeIn(function() {
                that.visible = true;
                tooltip._$tooltip.one("mouseover", function() {
                    that.persist = true;
                    $(document).bind("mouseover.review_popover", function(e) {
                        if (!$(e.target).closest(".tooltip").length) {
                            that.persist = false;
                            that.hide()
                            }
                    })
                    })
                })
            },
        showReviews: function(element, userId, hostingId) {
            show.call(this, element, userId, hostingId, "/users/:id/reviews_summary?hosting_id=:hostingId", {
                title: t("reviews_of_this")
                })
            },
        showOtherReviews: function(element, userId, hostingId) {
            show.call(this, element, userId, hostingId, "/users/:id/reviews_summary?exclude_hosting_id=:hostingId", {
                title: t("reviews_of_others")
                })
            }
    });
    Airbnb.ReviewPopover = ReviewPopover
} (window, require, Backbone, Airbnb); (function() {
    var MapIcons = {
        centerPoint: false,
        numbered: [],
        numberedHover: [],
        numberedStarred: [],
        numberedStarredHover: [],
        numberedVisited: [],
        numberedVisitedHover: [],
        numberedVisitedStarred: [],
        numberedVisitedStarredHover: [],
        small: false,
        smallHover: false,
        smallStarred: false,
        smallStarredHover: false,
        smallVisited: false,
        smallVisitedHover: false,
        smallVisitedStarred: false,
        smallVisitedStarredHover: false,
        shadowStandard: false,
        shadowSmall: false,
        shadowCenterPoint: false,
        init: function() {
            var iconSize = new google.maps.Size(9, 9),
            pinSize = new google.maps.Size(22, 34),
            spritePath = AirbnbSearch.MAP_ICONS_SPRITE_PATH;
            MapIcons.centerPoint = new google.maps.MarkerImage(spritePath, new google.maps.Size(15, 36), new google.maps.Point(280, 0));
            MapIcons.small = new google.maps.MarkerImage(spritePath, iconSize, new google.maps.Point(176, 0));
            MapIcons.smallHover = new google.maps.MarkerImage(spritePath, iconSize, new google.maps.Point(185, 0));
            MapIcons.smallStarred = new google.maps.MarkerImage(spritePath, iconSize, new google.maps.Point(176, 9));
            MapIcons.smallStarredHover = new google.maps.MarkerImage(spritePath, iconSize, new google.maps.Point(185, 9));
            MapIcons.smallVisited = new google.maps.MarkerImage(spritePath, iconSize, new google.maps.Point(194, 0));
            MapIcons.smallVisitedHover = new google.maps.MarkerImage(spritePath, iconSize, new google.maps.Point(203, 0));
            MapIcons.smallVisitedStarred = new google.maps.MarkerImage(spritePath, iconSize, new google.maps.Point(194, 9));
            MapIcons.smallVisitedStarredHover = new google.maps.MarkerImage(spritePath, iconSize, new google.maps.Point(203, 9));
            for (var i = 0; i < 21; i++) {
                MapIcons.numbered[i + 1] = new google.maps.MarkerImage(spritePath, pinSize, new google.maps.Point(0, (i * 34)));
                MapIcons.numberedHover[i + 1] = new google.maps.MarkerImage(spritePath, pinSize, new google.maps.Point(44, (i * 34)));
                MapIcons.numberedStarred[i + 1] = new google.maps.MarkerImage(spritePath, pinSize, new google.maps.Point(22, (i * 34)));
                MapIcons.numberedStarredHover[i + 1] = new google.maps.MarkerImage(spritePath, pinSize, new google.maps.Point(66, (i * 34)));
                MapIcons.numberedVisited[i + 1] = new google.maps.MarkerImage(spritePath, pinSize, new google.maps.Point(88, (i * 34)));
                MapIcons.numberedVisitedHover[i + 1] = new google.maps.MarkerImage(spritePath, pinSize, new google.maps.Point(132, (i * 34)));
                MapIcons.numberedVisitedStarred[i + 1] = new google.maps.MarkerImage(spritePath, pinSize, new google.maps.Point(110, (i * 34)));
                MapIcons.numberedVisitedStarredHover[i + 1] = new google.maps.MarkerImage(spritePath, pinSize, new google.maps.Point(154, (i * 34)))
                }
            MapIcons.shadowCenterPoint = new google.maps.MarkerImage(spritePath, new google.maps.Size(35, 27), new google.maps.Point(212, 0), new google.maps.Point(4, 27));
            MapIcons.shadowSmall = new google.maps.MarkerImage(spritePath, new google.maps.Size(11, 11), new google.maps.Point(295, 0), new google.maps.Point(5, 9));
            MapIcons.shadowStandard = new google.maps.MarkerImage(spritePath, new google.maps.Size(33, 26), new google.maps.Point(247, 0), new google.maps.Point(5, 23))
            }
    };
    provide("search/map_icons", MapIcons)
    })(); (function() {
    var MapIcons = require("search/map_icons");
    var AMM = {
        map: "",
        isFirstMapInteraction: true,
        redoSearchPromptTimeout: false,
        overlay: false,
        mapLoaded: false,
        new_bounds: false,
        currentBounds: false,
        currentHighestZIndex: 0,
        activeInfoWindow: null,
        activeInfoWindowMarker: false,
        queue: [],
        activeHostingIds: [],
        markers: {},
        defaultMapOptions: {},
        centerLat: false,
        centerLng: false,
        centerMarker: false,
        geocodePrecision: false,
        initMapOnce: function(mapId) {
            if (!AMM.mapLoaded) {
                if (window.google && window.google.maps) {
                    $("#map_options").show();
                    $("#map_wrapper").show();
                    AMM.defaultMapOptions = {
                        zoom: 6,
                        center: new google.maps.LatLng(40.7442, -73.9861),
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        disableDefaultUI: true,
                        navigationControl: true,
                        navigationControlOptions: {
                            position: google.maps.ControlPosition.LEFT
                        },
                        scaleControl: true,
                        scrollwheel: false
                    };
                    AMM.map = new google.maps.Map(document.getElementById(mapId), AMM.defaultMapOptions);
                    AMM.autocomplete = new google.maps.places.Autocomplete(document.getElementById("location"), {
                        types: ["geocode"]
                        });
                    AMM.autocomplete.bindTo("bounds", AMM.map);
                    AMM.overlay = new google.maps.OverlayView();
                    AMM.overlay.draw = function() {};
                    AMM.overlay.setMap(AMM.map);
                    MapIcons.init();
                    AMM.mapLoaded = true
                } else {
                    $("#map_options").hide();
                    $("#map_wrapper").hide()
                    }
            }
        },
        add: function(location, hosting) {
            if (!AMM.markers[hosting.id]) {
                AMM.markers[hosting.id] = {
                    location: location,
                    details: hosting,
                    active: false
                }
            }
            AMM.queue.push(hosting.id)
            },
        drawCenterMarker: function() {
            var pinZIndex,
            centerPoint,
            marker,
            bounds;
            AMM.clearCenterMarker();
            if (AMM.mapLoaded && AMM.centerLat && AMM.centerLng) {
                pinZIndex = 1;
                if (AMM.geocodePrecision) {
                    if (AMM.geocodePrecision === "address") {
                        pinZIndex = 100
                    }
                }
                centerPoint = new google.maps.LatLng(AMM.centerLat, AMM.centerLng);
                marker = new google.maps.Marker({
                    position: centerPoint,
                    map: AMM.map,
                    icon: MapIcons.centerPoint,
                    shadow: MapIcons.shadowCenterPoint,
                    title: t("you_are_here"),
                    zIndex: pinZIndex
                });
                AMM.centerMarker = marker;
                bounds = AMM.currentBounds;
                if (bounds === false) {
                    bounds = new google.maps.LatLngBounds()
                    }
                bounds.extend(centerPoint)
                }
        },
        clearCenterMarker: function() {
            if (AMM.centerMarker !== false) {
                AMM.centerMarker.setMap(null);
                AMM.centerMarker = false
            }
        },
        clearOverlays: function(forceAll) {
            if (AMM.markers) {
                $.each(AMM.markers, function(hostingId) {
                    if ($.inArray(parseInt(hostingId, 10), AMM.queue) === -1 || forceAll === true) {
                        AMM.removeOverlay(hostingId)
                        }
                })
                }
        },
        openInfoWindow: function(content, marker) {
            var win = AMM.activeInfoWindow;
            AMM.activeInfoWindowMarker = marker;
            if (win) {
                win.setContent(content);
                win.open(AMM.map, marker)
                } else {
                win = AMM.activeInfoWindow = new google.maps.InfoWindow({
                    content: content,
                    maxWidth: 241
                });
                google.maps.event.addListenerOnce(win, "closeclick", function() {
                    win = AMM.activeInfoWindow = AMM.activeInfoWindowMarker = null
                });
                win.open(AMM.map, marker)
                }
        },
        closeInfoWindow: function() {
            if (AMM.activeInfoWindow) {
                google.maps.event.clearInstanceListeners(AMM.activeInfoWindow);
                AMM.activeInfoWindow.close();
                AMM.activeInfoWindow = AMM.activeInfoWindowMarker = null;
                return true
            } else {
                return false
            }
        },
        removeOverlay: function(hostingId) {
            var marker = AMM.markers[hostingId];
            if (marker.active === true) {
                if (marker.infoWindow) {
                    google.maps.event.clearInstanceListeners(marker.infoWindow);
                    marker.infoWindow = null
                }
                google.maps.event.clearInstanceListeners(marker.marker);
                marker.marker.setMap(null);
                marker.marker = null;
                marker.active = false
            }
        },
        showOverlays: function() {
            var NUMBERED_PINS = 21,
            queueSize = AMM.queue.length;
            $.each(AMM.queue, function(i, hostingId) {
                var hostMarker = AMM.markers[hostingId],
                details,
                icon,
                marker,
                visited;
                if (hostMarker && !hostMarker.active) {
                    details = hostMarker.details;
                    visited = $.inArray(hostingId.toString(), AirbnbSearch.viewedIds) !== -1;
                    if (i < NUMBERED_PINS) {
                        if (visited) {
                            icon = MapIcons.numberedVisited[i + 1]
                            } else {
                            icon = MapIcons.numbered[i + 1]
                            }
                        hostMarker.numbered_pin = i;
                        marker = new google.maps.Marker({
                            position: hostMarker.location,
                            map: AMM.map,
                            icon: icon,
                            shadow: MapIcons.shadowStandard,
                            title: [(i + 1), ". ", details.name].join(""),
                            zIndex: (queueSize - i)
                            })
                        } else {
                        if (visited) {
                            icon = MapIcons.smallVisited
                        } else {
                            icon = MapIcons.small
                        }
                        hostMarker.numbered_pin = false;
                        marker = new google.maps.Marker({
                            position: hostMarker.location,
                            map: AMM.map,
                            icon: icon,
                            shadow: MapIcons.shadowSmall,
                            title: details.name,
                            zIndex: (queueSize - i)
                            })
                        }
                    if (AirbnbSearch.currentViewType === "map") {
                        var reviewWord = (details.review_count === 1 ? t("review") : t("reviews")),
                        contentString;
                        contentString = ['<div class="map_info_window">', '<a class="map_info_window_link_image" href="/rooms/', hostingId, '">', '<img width="210" height="140" class="map_info_window_thumbnail" src="', details.thumbnail_url.replace(AirbnbSearch.thumbnailRegex, "/small.jpg"), '">', "</a>", '<p class="map_info_window_details">', '<a class="map_info_window_link" href="/rooms/', hostingId, '">', details.name, "</a>", '<span class="map_info_window_review_count">', details.review_count, " ", reviewWord, "</span>", '<span class="map_info_window_price">', AirbnbSearch.currencySymbolLeft, details.price, AirbnbSearch.currencySymbolRight, "</span>", "</p>", "</div>"].join("");
                        google.maps.event.addListener(marker, "click", function() {
                            AMM.openInfoWindow(contentString, marker, hostingId)
                            })
                        } else {
                        google.maps.event.addListener(marker, "mouseover", function() {
                            AirbnbSearch.hoverListResult(hostingId)
                            });
                        google.maps.event.addListener(marker, "mouseout", function() {
                            AirbnbSearch.unHoverListResult(hostingId)
                            });
                        google.maps.event.addListener(marker, "click", function() {
                            var icon;
                            AirbnbSearch.viewedIds.push(hostingId.toString());
                            icon = MapIcons.numberedVisitedHover[hostMarker.numbered_pin + 1];
                            hostMarker.marker.setIcon(icon);
                            window.location = ["/rooms/", hostingId].join("")
                            })
                        }
                    hostMarker.marker = marker;
                    hostMarker.active = true
                }
            });
            AMM.clearQueue()
            },
        clearQueue: function() {
            AMM.queue = []
            },
        turnMapListenersOn: function() {
            AMM.listenForMapChanges()
            },
        turnMapListenersOff: function() {
            if (AMM.mapLoaded) {
                google.maps.event.clearListeners(AMM.map, "idle")
                }
        },
        listenForMapChanges: function() {
            if (AMM.mapLoaded) {
                google.maps.event.addListener(AMM.map, "idle", function() {
                    AMM.mapListenerCallback()
                    })
                }
        },
        fitBounds: function(bounds) {
            if (AMM.mapLoaded) {
                AMM.map.fitBounds(bounds)
                }
        },
        mapListenerCallback: function() {
            if (AMM.isFirstMapInteraction) {
                var $firstTimeMapQuestion = $("#first_time_map_question"),
                cookieDontShowQuestion = amplify.store("dont_show_first_time_map_question");
                AMM.isFirstMapInteraction = false;
                if (!redoSearchInMapIsChecked() && !cookieDontShowQuestion) {
                    AMM.redoSearchPromptTimeout = setTimeout(function() {
                        $firstTimeMapQuestion.fadeOut(2000)
                        }, 14000);
                    $firstTimeMapQuestion.show();
                    return false
                }
            }
            if (AMM.activeInfoWindow && AMM.activeInfoWindowMarker) {
                var containerPixel = AMM.overlay.getProjection().fromLatLngToContainerPixel(AMM.activeInfoWindowMarker.getPosition()),
                x = containerPixel.x,
                y = containerPixel.y,
                xBias = 82,
                mapContainerDiv = $("#search_map"),
                mapContainerWidth = mapContainerDiv.width(),
                mapContainerHeight = mapContainerDiv.height(),
                approxOverlayHeight = 260,
                approxOverlayWidth = 250,
                yOffset = approxOverlayHeight / 2,
                xOffset = approxOverlayWidth / 2;
                if (redoSearchInMapIsChecked()) {
                    if ((x < xOffset) || (y < yOffset) || (x > (mapContainerWidth - (xOffset) + (xBias / 2))) || (y > (mapContainerHeight + (yOffset * 1.33)))) {
                        AMM.closeInfoWindow()
                        }
                } else {
                    if (x < 0 || y < 0 || x > (mapContainerWidth + xBias) || y > (mapContainerHeight + approxOverlayHeight)) {
                        AMM.closeInfoWindow()
                        }
                }
            }
            if (!AMM.activeInfoWindow) {
                AirbnbSearch.resultsChangedByMapAction = true;
                AirbnbSearch.loadNewResults()
                }
        }
    };
    provide("search/amm", AMM)
    })(); (function() {
    var Connections = {
        init: function(name, el) {
            var $b = Connections.$b = $(el);
            Connections.name = name;
            $b.find(".fb-button, .fb-button-small").click(Connections.connectButtonClickHandler);
            $b.show();
            _gaq.push(["_trackEvent", Connections.name, "View"])
            },
        connectButtonClickHandler: function() {
            var LOADER_CLASS = "loading";
            var $a = $(this).addClass(LOADER_CLASS);
            _gaq.push(["_trackEvent", "Authenticate", "FacebookClick", Connections.name]);
            Airbnb.FBConnect.startLoginFlow();
            Airbnb.FBConnect.one("connect_success", function() {
                _gaq.push(["_trackEvent", "Authenticate", "FacebookLogin", Connections.name]);
                Connections.trackEvent("page2FbConnect")
                });
            Airbnb.FBConnect.one("connect_cancel", function() {
                _gaq.push(["_trackEvent", "Authenticate", "FacebookDeny", Connections.name]);
                Connections.trackEvent("page2FbCancel");
                $a.removeClass(LOADER_CLASS)
                });
            Airbnb.FBConnect.one("bail", function() {
                Connections.trackEvent("page2FbBail");
                $a.removeClass(LOADER_CLASS)
                });
            Airbnb.FBConnect.one("complete", function() {
                Connections.trackEvent("page2FbComplete")
                });
            return false
        },
        trackEvent: function(event) {
            _gaq.push(["_trackEvent", "SocialConnections", event])
            }
    };
    provide("search/connections", Connections)
    })(); ! function(window, $, Airbnb, I18n, JSCookie, JST) {
    var AMM = require("search/amm"),
    Connections = require("search/connections"),
    MapIcons = require("search/map_icons");
    window.redoSearchInMapIsChecked = function() {
        return $("#redo_search_in_map").is(":checked")
        };
    function showLoadingOverlays() {
        clearTimeout(AirbnbSearch.loadingMessageTimeout);
        AirbnbSearch.searchView.hideOverlays();
        AirbnbSearch.loadingMessageTimeout = setTimeout(function() {
            if (window.google && window.google.maps) {
                $("#small_map_loading").show()
                }
            $("#list_view_loading, #map_view_loading").show()
            }, 250)
        }
    function hideLoadingOverlays() {
        clearTimeout(AirbnbSearch.loadingMessageTimeout);
        $("#small_map_loading, #list_view_loading, #map_view_loading").hide()
        }
    function resetParamsToDefaults() {
        AirbnbSearch.locationHasChanged = false;
        AirbnbSearch.resultsChangedByMapAction = false;
        $("#page").val("1")
        }
    function renderResultsOncomplete(json, options) {
        options = options || {};
        if (AirbnbSearch.showFbConnectionsBanner) {
            Connections.init("FacebookConnectionsBanner", ".fb-connect-bar")
            }
        AMM.centerLat = false;
        AMM.centerLng = false;
        AMM.geocodePrecision = false;
        if (json.center_lat && json.center_lng) {
            AMM.centerLat = json.center_lat;
            AMM.centerLng = json.center_lng;
            if (json.geocode_precision) {
                AMM.geocodePrecision = json.geocode_precision
            }
            AirbnbSearch.enableDistanceSort()
            } else {
            AirbnbSearch.disableDistanceSort()
            }
        AMM.drawCenterMarker();
        resetParamsToDefaults();
        setTimeout(function() {
            AMM.turnMapListenersOn()
            }, 2000);
        AirbnbSearch.activeRequest = null;
        AirbnbSearch.initialLoadComplete = true;
        AirbnbSearch.$.trigger("finishedrendering")
        }
    function makeBanner(json) {
        if (json.present_standby_option && json.present_standby_option === true && json.standby_url) {
            BannerFactory.createBanner("airmatch", json.standby_url)
            } else {
            if (AirbnbSearch.showSearchIndexDelayBanner) {
                BannerFactory.createBanner("index_delay")
                } else {
                if (AirbnbSearch.showVanityBanner) {
                    BannerFactory.createBanner("vanity")
                    } else {
                    AirbnbSearch.initNeighborhoodsBanner()
                    }
            }
        }
    }
    function createNeighborhoodsPopover() {
        var NeighborhoodsPopover = require("neighborhoods/neighborhoods_popover"),
        NeighborhoodsPopoverCollection = require("neighborhoods/neighborhoods_popover_collection"),
        NeighborhoodsPopoverModel = require("neighborhoods/neighborhoods_popover_model"),
        $neighborhoodLinks,
        i,
        length,
        model,
        neighborhoodCollection,
        neighborhoodId,
        neighborhoodLink;
        $neighborhoodLinks = $("[data-neighborhood-id]");
        length = $neighborhoodLinks.length;
        if (length === 0) {
            return
        }
        neighborhoodCollection = new NeighborhoodsPopoverCollection();
        for (i = 0; i < length; i++) {
            neighborhoodLink = $neighborhoodLinks.get(i);
            neighborhoodId = $(neighborhoodLink).attr("data-neighborhood-id");
            if (neighborhoodId !== "") {
                model = neighborhoodCollection.get(neighborhoodId);
                if (!model) {
                    model = new NeighborhoodsPopoverModel({
                        id: neighborhoodId
                    });
                    neighborhoodCollection.add(model)
                    }
            }
        }
        neighborhoodCollection.fetch({
            success: function(collection) {
                var i,
                length,
                model;
                $neighborhoodLinks = $("[data-neighborhood-id]");
                for (i = 0, length = $neighborhoodLinks.length; i < length; i++) {
                    neighborhoodLink = $neighborhoodLinks.get(i);
                    neighborhoodId = $(neighborhoodLink).attr("data-neighborhood-id");
                    model = collection.get(neighborhoodId);
                    if (neighborhoodId && model.get("launched")) {
                        $(neighborhoodLink).addClass("enabled");
                        new NeighborhoodsPopover({
                            el: neighborhoodLink,
                            model: model
                        })
                        }
                }
            }
        })
        }
    function renderResults(json, overrideBounds, options) {
        var viewExperiment = AirbnbSearch.showView,
        $mapMessage,
        bounds,
        hostingList,
        thumbnailDims,
        thumbnailStyle,
        view_type;
        AMM.turnMapListenersOff();
        if (window.google && window.google.maps && (arguments.length === 1 || overrideBounds.ea === undefined)) {
            bounds = new google.maps.LatLngBounds()
            } else {
            bounds = overrideBounds
        }
        document.title = json.title;
        $(".results_count").html(json.results_count_html);
        $("#results_count_top").html(json.results_count_top_html);
        $("#results_pagination").html(json.results_pagination_html);
        $("#sort").val(json.sort);
        AMM.clearQueue();
        view_type = json.view_type;
        if (view_type) {
            AirbnbSearch.searchView.displaySearchType("search_type_" + AirbnbSearch.viewTypes[view_type], false);
            AirbnbSearch.currentViewType = AirbnbSearch.viewTypes[view_type];
            AirbnbSearch.params.search_view = view_type
        }
        if (AirbnbSearch.isActiveDisaster) {
            AirbnbSearch.isSearchInDisasterZone(json)
            }
        makeBanner(json);
        if (AirbnbSearch.currentViewType === "list") {
            thumbnailStyle = "x_small"
        } else {
            thumbnailStyle = "small"
        }
        thumbnailDims = AirbnbSearch.thumbnailStyles[thumbnailStyle];
        hostingList = new Airbnb.HostingList();
        $.each(json.properties, function(i, hosting) {
            var ll;
            if (window.google && window.google.maps) {
                ll = new google.maps.LatLng(hosting.lat, hosting.lng);
                AMM.add(ll, hosting);
                if (bounds !== overrideBounds) {
                    bounds.extend(ll)
                    }
            }
            if (AirbnbSearch.currentViewType === "list" || AirbnbSearch.currentViewType === "photo") {
                hosting.thumbnail_url = hosting.thumbnail_url.replace(AirbnbSearch.thumbnailRegex, "/" + thumbnailStyle + ".jpg");
                hostingList.add(hosting)
                }
        });
        AirbnbSearch.searchView.on("datechange", function(data) {
            $("#checkin").val(data.checkin);
            $("#checkout").val(data.checkout);
            AirbnbSearch.nonPathParams = {
                selected_hosting: data.hostingId
            };
            AirbnbSearch.selectedHostingId = data.hostingId;
            AirbnbSearch.loadNewResults()
            });
        AirbnbSearch.selectedHostingId = null;
        $mapMessage = $("#map_message");
        if (AirbnbSearch.currentViewType === "map") {
            if ((json.properties && json.properties.length === AirbnbSearch.params.per_page) || !redoSearchInMapIsChecked()) {
                if (redoSearchInMapIsChecked()) {
                    $mapMessage.html(["<h4>", t("zoom_in_to_see_more_properties"), "</h4>"].join(""))
                    } else {
                    $mapMessage.html(["<h3>", t("zoom_in_to_see_more_properties"), "</h3>", '<span id="redo_search_in_map_tip">', t("redo_search_in_map_tip"), "</span>"].join(""))
                    }
                $mapMessage.show()
                } else {
                if (! (json.properties) || json.properties.length === 0) {
                    $mapMessage.html(["<h3>", t("your_search_was_too_specific"), "</h3>", "<h4>", t("we_suggest_unchecking_a_couple_filters"), "</h4>"].join(""));
                    $mapMessage.show()
                    } else {
                    $mapMessage.hide()
                    }
            }
        } else {
            $mapMessage.hide()
            }
        AirbnbSearch.searchView.setHostingList({
            skipRender: AirbnbSearch.initial,
            collection: hostingList,
            currency_symbol_left: AirbnbSearch.currencySymbolLeft,
            currency_symbol_right: AirbnbSearch.currencySymbolRight,
            fbBannerIndex: options.fbBannerIndex,
            selectedHostingId: AirbnbSearch.selectedHostingId,
            showFbBanner: (AirbnbSearch.showFbConnectionsBanner && !json.social_enabled),
            miniPrices: !!json.mini_prices,
            thumbnail_height: thumbnailDims[0],
            thumbnail_width: thumbnailDims[1]
            });
        createNeighborhoodsPopover();
        AMM.currentBounds = bounds;
        AMM.clearOverlays(true);
        AMM.showOverlays();
        if ((json.properties && json.properties.length > 0) && (AirbnbSearch.resultsChangedByMapAction === false || AirbnbSearch.changing_display_type) && (!redoSearchInMapIsChecked() || AirbnbSearch.locationHasChanged)) {
            AMM.fitBounds(bounds)
            }
        if (json.properties && json.properties.length > 0) {
            $("#results_footer").show()
            } else {
            AirbnbSearch.showBlankState()
            }
        hideLoadingOverlays();
        return true
    } (function(window) {
        var AirbnbSearch = {
            REPLACE_PARAMS: ["sw_lat", "sw_lng", "ne_lat", "ne_lng"],
            DEFAULT_PARAMS: {
                checkin: "",
                checkout: "",
                collection_id: "",
                guests: "1",
                keywords: "",
                min_bathrooms: "0",
                min_bedrooms: "0",
                min_beds: "0",
                ne_lat: "",
                ne_lng: "",
                page: "1",
                price_max: "",
                price_min: "",
                search_by_map: "",
                search_view: 1,
                sort: "0",
                sw_lat: "",
                sw_lng: "",
                unique: ""
            },
            thumbnailRegex: /\/[^\/]*\.jpg$/,
            thumbnailStyles: {
                x_small: [74, 114],
                small: [144, 216]
                },
            hideBannerForRemainderOfSession: false,
            code: false,
            eventId: false,
            hostId: false,
            hostName: "",
            forceHideHost: false,
            groupId: false,
            groupName: "",
            forceHideGroup: false,
            viewTypes: {
                "1": "list",
                "2": "photo",
                "3": "map"
            },
            loadingMessageTimeout: false,
            currentViewType: "list",
            resultsChangedByMapAction: false,
            changing_display_type: false,
            shareLightbox: false,
            params: {},
            currencySymbolLeft: "$",
            currencySymbolRight: "",
            initialLoadComplete: false,
            resultsJson: false,
            locationHasChanged: false,
            viewedIds: [],
            init: function(opts) {
                var dateFormat,
                defaultCalendarOptions,
                checkinCalendarOptions,
                checkoutCalendarOptions,
                forceBounds,
                sw,
                ne;
                this.$results = $("#results");
                this.$resultsFooter = $("#results_footer");
                AirbnbSearch.initial = true;
                AirbnbSearch.options = opts;
                AirbnbSearch.viewedIds = AirbnbSearch.getViewedPage3Ids();
                if (opts.min_bathrooms) {
                    $("#min_bathrooms").val(opts.min_bathrooms)
                    }
                if (opts.min_bedrooms) {
                    $("#min_bedrooms").val(opts.min_bedrooms)
                    }
                if (opts.min_beds) {
                    $("#min_beds").val(opts.min_beds)
                    }
                if (opts.page) {
                    $("#page").val(opts.page);
                    AirbnbSearch.params.page = opts.page
                }
                if (opts.sort) {
                    if (opts.sort !== "11") {
                        $("#sort").val(opts.sort)
                        }
                    AirbnbSearch.params.sort = opts.sort
                }
                if (opts.neighborhoods) {
                    AirbnbSearch.params.neighborhoods = opts.neighborhoods
                }
                if (opts.hosting_amenities) {
                    AirbnbSearch.params.hosting_amenities = opts.hosting_amenities
                }
                if (opts.room_types) {
                    AirbnbSearch.params.room_types = opts.room_types
                }
                if (opts.property_type_id) {
                    AirbnbSearch.params.property_type_id = opts.property_type_id
                }
                if (opts.connected) {
                    AirbnbSearch.params.connected = "true"
                }
                if (opts.guests) {
                    $("#guests").val(opts.guests);
                    AirbnbSearch.params.guests = opts.guests
                }
                if (opts.price_min) {
                    AirbnbSearch.params.price_min = opts.price_min
                }
                if (opts.price_max) {
                    AirbnbSearch.params.price_max = opts.price_max
                }
                if (opts.deb) {
                    AirbnbSearch.params.deb = opts.deb
                }
                if (opts.opts) {
                    AirbnbSearch.params.opts = opts.opts
                }
                if (opts.exps) {
                    AirbnbSearch.params.exps = opts.exps
                }
                if (opts.ib) {
                    AirbnbSearch.params.ib = opts.ib
                }
                if (opts.keywords) {
                    $("#keywords").val(opts.keywords).blur()
                    }
                if (AirbnbSearch.remarketing_side !== null && (typeof dataLayer !== "undefined")) {
                    googleTagAB(dataLayer)
                    }
                AirbnbSearch.searchView = new Airbnb.SearchView({
                    el: document.getElementById("v3_search")
                    });
                $(".share-button").on("click", function(e) {
                    var shareView = new AIR.Views.Shared.ShareDropdownView({
                        analyticsCategory: "Search",
                        tweetText: I18n.t("search_tweet_text", {
                            location: AirbnbSearch.params.location
                        }),
                        url: window.location.href
                    });
                    $(e.currentTarget).after(shareView.render().el);
                    e.preventDefault()
                    });
                $("#redo_search_in_map_link_on").live("click", function(e) {
                    $("#redo_search_in_map").attr("checked", true);
                    if (AMM.redoSearchPromptTimeout) {
                        clearTimeout(AMM.redoSearchPromptTimeout);
                        AMM.redoSearchPromptTimeout = false
                    }
                    $("#first_time_map_question").fadeOut(500);
                    AMM.closeInfoWindow();
                    AirbnbSearch.resultsChangedByMapAction = true;
                    AirbnbSearch.loadNewResults();
                    e.preventDefault()
                    });
                $("#redo_search_in_map_link_off").live("click", function(e) {
                    amplify.store("dont_show_first_time_map_question", true);
                    if (AMM.redoSearchPromptTimeout) {
                        clearTimeout(AMM.redoSearchPromptTimeout);
                        AMM.redoSearchPromptTimeout = false
                    }
                    $("#first_time_map_question").fadeOut(500);
                    e.preventDefault()
                    });
                $("#share_url").live("focus", function() {
                    $(this).select()
                    });
                if (opts.location) {
                    $("#location").val(opts.location).addClass("active").blur()
                    }
                if (!AirbnbSearch.initialLoadComplete) {
                    dateFormat = $.datepicker._defaults.dateFormat;
                    defaultCalendarOptions = {
                        minDate: 0,
                        maxDate: "+3Y",
                        nextText: "",
                        prevText: "",
                        numberOfMonths: 1,
                        closeText: I18n.t("clear_dates", "Clear Dates"),
                        showButtonPanel: true
                    };
                    checkinCalendarOptions = $.extend(true, {}, defaultCalendarOptions);
                    checkoutCalendarOptions = $.extend(true, {}, defaultCalendarOptions);
                    if (opts.checkin && opts.checkin !== dateFormat && opts.checkout && opts.checkout !== dateFormat) {
                        $("#checkin").val(opts.checkin).blur();
                        $("#checkout").val(opts.checkout).blur();
                        checkinCalendarOptions = $.extend(checkinCalendarOptions, {
                            defaultDate: opts.checkin
                        });
                        checkoutCalendarOptions = $.extend(checkoutCalendarOptions, {
                            defaultdate: opts.checkout
                        })
                        }
                    $("#search_form").airbnbInputDateSpan({
                        defaultsCheckin: checkinCalendarOptions,
                        defaultsCheckout: checkoutCalendarOptions,
                        onSuccess: function() {
                            AirbnbSearch.loadNewResults()
                            }
                    });
                    $(".collapsable_filters li input:checkbox, #lightbox_filters input:checkbox").live("click", function() {
                        var performSearch = false,
                        id = $(this).attr("id"),
                        checkboxSelector;
                        if (id.indexOf("lightbox") === -1) {
                            id = ["#lightbox_", id].join("");
                            performSearch = true
                        } else {
                            id = ["#", id.replace("lightbox_", "")].join("")
                            }
                        if ($(id)) {
                            checkboxSelector = ['input:checkbox[name="', $(this).attr("name"), '"][value="', $(this).attr("value"), '"]'].join("");
                            $(checkboxSelector).attr("checked", $(this).is(":checked"))
                            }
                        if (performSearch) {
                            AirbnbSearch.loadNewResults()
                            }
                    });
                    $("#lightbox_search_button").live("click", function() {
                        AirbnbSearch.loadNewResults()
                        });
                    $(".filters_lightbox_nav_element").live("click", function() {
                        var tabToSelect = $(this).attr("id").replace("lightbox_nav_", "");
                        SearchFilters.selectLightboxTab(tabToSelect)
                        });
                    $("#sort, #guests").change(function() {
                        AirbnbSearch.loadNewResults()
                        });
                    $("#unique-toggle").live("click", function(e) {
                        var $this = $(this),
                        enabled = $this.data("enabled");
                        $this.data("enabled", !enabled);
                        $this.toggleClass("hidden", !enabled);
                        AirbnbSearch.params.sort = $this.data("sort-mode");
                        AirbnbSearch.loadNewResults();
                        e.preventDefault()
                        });
                    $(".search_result").live("mouseenter", function(event) {
                        AirbnbSearch.hoverListResult((event.currentTarget.id).split("_")[1])
                        }).live("mouseleave", function(event) {
                        AirbnbSearch.unHoverListResult((event.currentTarget.id).split("_")[1])
                        });
                    SearchFilters.initPriceSlider();
                    AMM.initMapOnce("search_map");
                    if (window.google && window.google.maps && opts.search_by_map && opts.ne_lng && opts.ne_lat && opts.sw_lng && opts.sw_lat) {
                        forceBounds = {
                            sw_lat: opts.sw_lat,
                            sw_lng: opts.sw_lng,
                            ne_lat: opts.ne_lat,
                            ne_lng: opts.ne_lng
                        };
                        AirbnbSearch.params.forceBounds = forceBounds;
                        sw = new google.maps.LatLng(forceBounds.sw_lat, forceBounds.sw_lng);
                        ne = new google.maps.LatLng(forceBounds.ne_lat, forceBounds.ne_lng);
                        AMM.fitBounds(new google.maps.LatLngBounds(sw, ne));
                        google.maps.event.addListenerOnce(AMM.map, "bounds_changed", function() {
                            AMM.map.setZoom(map.getZoom() + 1)
                            });
                        $("#redo_search_in_map").attr("checked", true);
                        AirbnbSearch.params = opts
                    }
                    $("#redo_search_in_map").bind("change", function() {
                        if (AMM.redoSearchPromptTimeout) {
                            clearTimeout(AMM.redoSearchPromptTimeout);
                            AMM.redoSearchPromptTimeout = false;
                            $("#first_time_map_question").fadeOut(250)
                            }
                        if (redoSearchInMapIsChecked()) {
                            AMM.closeInfoWindow();
                            AirbnbSearch.resultsChangedByMapAction = true;
                            AirbnbSearch.loadNewResults()
                            } else {
                            AMM.turnMapListenersOff()
                            }
                    });
                    AirbnbSearch.router = new Airbnb.Router();
                    Backbone.history.start({
                        pushState: true,
                        root: AirbnbSearch.router.ROOT,
                        silent: true
                    });
                    AirbnbSearch.params = opts;
                    if (AirbnbSearch.resultsJson && !window.location.hash) {
                        AirbnbSearch.loadNewResultsCallback(AirbnbSearch.resultsJson, {
                            fbBannerIndex: opts.fbBannerIndex
                        })
                        } else {
                        AirbnbSearch.loadNewResults({
                            fbBannerIndex: opts.fbBannerIndex
                        })
                        }
                    AirbnbSearch.initial = false
                }
                AirbnbSearch.initPagination()
                },
            fetchNeighborhoodsBanner: function() {
                this.bannerModel.fetch({
                    success: function(model) {
                        var neighborhoodName = model.get("name"),
                        neighborhoodMessage = I18n.t("neighborhood_banner_text", {
                            location_name: neighborhoodName
                        });
                        if (model.get("launched")) {
                            BannerFactory.createBanner("neighborhood", neighborhoodMessage, model.get("url"))
                            }
                    }
                })
                },
            initNeighborhoodsBanner: function() {
                var NeighborhoodBannerModel = require("neighborhoods/neighborhood_banner_model"),
                CityBannerModel = require("neighborhoods/city_banner_model"),
                results = AirbnbSearch.resultsJson,
                precision = results.geocode_precision,
                lat,
                lng;
                if (!precision) {
                    return
                }
                lat = results.center_lat;
                lng = results.center_lng;
                if (precision === "city") {
                    this.bannerModel = new CityBannerModel({
                        lat: lat,
                        lng: lng
                    })
                    } else {
                    this.bannerModel = new NeighborhoodBannerModel({
                        lat: lat,
                        lng: lng
                    })
                    }
                this.fetchNeighborhoodsBanner()
                },
            abortActiveRequests: function() {
                var activeRequest = this.activeRequest;
                if (activeRequest) {
                    activeRequest.abort();
                    this.activeRequest = null;
                    hideLoadingOverlays()
                    }
            },
            initPagination: function() {
                $(".pagination a").live("click", function(event) {
                    var pageNumber,
                    $el = $(this),
                    rel = $el.attr("rel");
                    if (rel === "next") {
                        pageNumber = parseInt($(".pagination .active").text(), 10) + 1
                    } else {
                        if (rel === "prev") {
                            pageNumber = parseInt($(".pagination .active").text(), 10) - 1
                        } else {
                            pageNumber = parseInt($el.html(), 10)
                            }
                    }
                    if (isNaN(pageNumber) || pageNumber < 1) {
                        pageNumber = 1
                    }
                    $("#page").val(pageNumber);
                    AirbnbSearch.loadNewResults();
                    event.preventDefault()
                    })
                },
            setParamsFromDom: function() {
                var oldParams = AirbnbSearch.params,
                newParams = AirbnbSearch.params = {},
                $loc,
                locationVal,
                $uniqueToggle,
                sw,
                ne;
                newParams.deb = oldParams.deb;
                newParams.opts = oldParams.opts;
                newParams.exps = oldParams.exps;
                newParams.ib = oldParams.ib;
                if (AirbnbSearch.eventId) {
                    newParams.event_id = AirbnbSearch.eventId
                }
                AMM.new_bounds = AMM.mapLoaded ? (redoSearchInMapIsChecked() && AMM.map.getBounds() || false) : false;
                switch (AirbnbSearch.currentViewType) {
                case "photo":
                    newParams.search_view = 2;
                    break;
                case "map":
                    newParams.search_view = 3;
                    break;
                default:
                    newParams.search_view = 1
                }
                newParams.min_bedrooms = $("#min_bedrooms").val() || "0";
                newParams.min_bathrooms = $("#min_bathrooms").val() || "0";
                newParams.min_beds = $("#min_beds").val() || "0";
                newParams.page = $("#page").val() || "1";
                $loc = $("#location");
                locationVal = $loc.val();
                if (locationVal !== $loc.attr("defaultValue")) {
                    newParams.location = locationVal || ""
                }
                if (!oldParams || (oldParams.location !== newParams.location)) {
                    AirbnbSearch.locationHasChanged = true;
                    AirbnbSearch.hideBannerForRemainderOfSession = false;
                    $("#redo_search_in_map").attr("checked", false)
                    }
                newParams.collection_id = oldParams.collection_id;
                if (AirbnbSearch.includeHostParam()) {
                    newParams.host_id = AirbnbSearch.hostId
                } else {
                    SearchFilters.clearHost()
                    }
                if (AirbnbSearch.includeGroupParam()) {
                    newParams.group_id = AirbnbSearch.groupId
                } else {
                    SearchFilters.clearGroup()
                    }
                newParams.checkin = $("#checkin").val() || "";
                newParams.checkout = $("#checkout").val() || "";
                newParams.guests = $("#guests").val() || "1";
                newParams.room_types = [];
                $("input[name='room_types']").each(function(i, el) {
                    if ($(el).is(":checked")) {
                        newParams.room_types.push($(el).val())
                        }
                });
                newParams.property_type_id = [];
                $("input[name='property_type_id']").each(function(i, el) {
                    if ($(el).is(":checked")) {
                        newParams.property_type_id.push($(el).val())
                        }
                });
                newParams.hosting_amenities = [];
                $("input[name='amenities']").each(function(i, el) {
                    if ($(el).is(":checked")) {
                        newParams.hosting_amenities.push($(el).val())
                        }
                });
                if ($("input[name='connected']").is(":checked")) {
                    newParams.connected = true
                }
                newParams.languages = [];
                $("input[name='languages']").each(function(i, el) {
                    if ($(el).is(":checked")) {
                        newParams.languages.push($(el).val())
                        }
                });
                newParams.neighborhoods = [];
                if (!AirbnbSearch.initialLoadComplete) {
                    $.extend(newParams, oldParams)
                    }
                if (!AirbnbSearch.locationHasChanged) {
                    $uniqueToggle = $("#unique-toggle");
                    if ($uniqueToggle.data("enabled")) {
                        newParams.sort = $uniqueToggle.data("sort-mode")
                        } else {
                        newParams.sort = $("#sort").val() || "0"
                    }
                    $("input[name='neighborhoods']").each(function(i, el) {
                        var $el = $(el);
                        if ($el.is(":checked")) {
                            newParams.neighborhoods.push($el.val())
                            }
                    })
                    }
                newParams.hosting_amenities = _.uniq(newParams.hosting_amenities);
                newParams.neighborhoods = _.uniq(newParams.neighborhoods);
                newParams.room_types = _.uniq(newParams.room_types);
                newParams.keywords = $("#keywords").val();
                SearchFilters.setPriceFilterParams(newParams);
                if (AirbnbSearch.locationHasChanged || !redoSearchInMapIsChecked()) {
                    newParams.sw_lat = AirbnbSearch.DEFAULT_PARAMS.sw_lat;
                    newParams.sw_lng = AirbnbSearch.DEFAULT_PARAMS.sw_lng;
                    newParams.ne_lat = AirbnbSearch.DEFAULT_PARAMS.ne_lat;
                    newParams.ne_lng = AirbnbSearch.DEFAULT_PARAMS.ne_lng;
                    newParams.search_by_map = AirbnbSearch.DEFAULT_PARAMS.search_by_map
                } else {
                    if (redoSearchInMapIsChecked()) {
                        if (AMM.new_bounds) {
                            newParams.sw_lat = AMM.new_bounds.getSouthWest().lat();
                            newParams.sw_lng = AMM.new_bounds.getSouthWest().lng();
                            newParams.ne_lat = AMM.new_bounds.getNorthEast().lat();
                            newParams.ne_lng = AMM.new_bounds.getNorthEast().lng();
                            newParams.search_by_map = true
                        } else {
                            if (oldParams && oldParams.forceBounds) {
                                newParams.sw_lat = oldParams.forceBounds.sw_lat;
                                newParams.sw_lng = oldParams.forceBounds.sw_lng;
                                newParams.ne_lat = oldParams.forceBounds.ne_lat;
                                newParams.ne_lng = oldParams.forceBounds.ne_lng;
                                sw = new google.maps.LatLng(oldParams.forceBounds.sw_lat, oldParams.forceBounds.sw_lng);
                                ne = new google.maps.LatLng(oldParams.forceBounds.ne_lat, oldParams.forceBounds.ne_lng);
                                AMM.new_bounds = new google.maps.LatLngBounds(sw, ne);
                                AMM.fitBounds(AMM.new_bounds);
                                newParams.search_by_map = true
                            }
                        }
                    }
                }
                if (AirbnbSearch.currentViewType === "map") {
                    newParams.per_page = 80
                } else {
                    newParams.per_page = AirbnbSearch.DEFAULT_PARAMS.per_page
                }
                return newParams
            },
            markUrlAsModified: function() {
                var searchParams = $.query.load(window.location.href).keys,
                hashParams = {},
                navigateParams = {},
                locationFromPathname,
                searchedLocation,
                params,
                destination,
                key,
                queryParams,
                value;
                delete searchParams.type;
                delete searchParams.collection_id;
                locationFromPathname = Airbnb.SearchUtils.get_location_from_pathname(window.location);
                searchedLocation = searchParams.location || locationFromPathname;
                params = AirbnbSearch.params;
                for (key in params) {
                    if (params.hasOwnProperty(key)) {
                        value = params[key];
                        if (key === "location" || AirbnbSearch.DEFAULT_PARAMS[key] === value) {
                            delete searchParams[key]
                            } else {
                            hashParams[key] = params[key];
                            if (!navigateParams.replace && _.include(AirbnbSearch.REPLACE_PARAMS, key) && searchParams[key] !== hashParams[key]) {
                                navigateParams.replace = true
                            }
                        }
                    }
                }
                if (Backbone.history._hasPushState) {
                    destination = Airbnb.SearchUtils.location_to_url_parameter(params.location);
                    queryParams = $.param($.extend(searchParams, hashParams));
                    if (queryParams) {
                        destination += "?" + queryParams
                    }
                    AirbnbSearch.router.navigate(destination, navigateParams)
                    } else {
                    if (params.location !== searchedLocation) {
                        destination = "/s/" + Airbnb.SearchUtils.location_to_url_parameter(params.location);
                        queryParams = $.param($.extend(searchParams, hashParams));
                        if (queryParams) {
                            destination += "?" + queryParams
                        }
                        window.location.href = destination
                    } else {
                        AirbnbSearch.router.navigate($.param(hashParams), navigateParams)
                        }
                }
            },
            loadNewResultsCallback: function(json, options) {
                var opts = options || {},
                params = AirbnbSearch.params;
                if (!json) {
                    AirbnbSearch.resultsJson = false;
                    hideLoadingOverlays();
                    return false
                }
                AirbnbSearch.resultsJson = json;
                AirbnbSearch.nonPathParams = null;
                if (renderResults(json, AMM.new_bounds, opts)) {
                    if (json.params) {
                        SearchFilters.update(json.params)
                        } else {
                        if (json.facets) {
                            SearchFilters.update(json.facets)
                            } else {
                            SearchFilters.render()
                            }
                    }
                    SearchFilters.togglePriceFilter(!json.collection_id || (json.collection_id != 7046134));
                    if (params.guests) {
                        $("#guests").val(params.guests)
                        }
                    $("#location").val(params.location);
                    $("#checkin").val(params.checkin);
                    $("#checkout").val(params.checkout);
                    SearchFilters.checkPriceFilterLimitChange();
                    renderResultsOncomplete(json, opts)
                    }
            },
            loadNewResults: function(options) {
                var opts = options || {},
                $loc,
                params,
                newParams,
                scrollOffsetFromTop;
                AMM.initMapOnce("search_map");
                $loc = $("#location");
                if (AirbnbSearch.locationHasChanged || (AirbnbSearch.resultsChangedByMapAction && !redoSearchInMapIsChecked())) {
                    resetParamsToDefaults();
                    setTimeout(function() {
                        AMM.turnMapListenersOn()
                        }, 2000);
                    return true
                }
                this.abortActiveRequests();
                SearchFilters.closeFiltersLightbox();
                scrollOffsetFromTop = $(window).scrollTop();
                if (scrollOffsetFromTop > 129) {
                    $("html, body").animate({
                        scrollTop: $("#search_params").offset().top
                    }, "fast")
                    }
                showLoadingOverlays();
                if (!opts.pushState) {
                    AirbnbSearch.setParamsFromDom()
                    }
                if (!opts.pushState && AirbnbSearch.initialLoadComplete) {
                    AirbnbSearch.markUrlAsModified()
                    }
                params = AirbnbSearch.nonPathParams ? _.extend({}, AirbnbSearch.params, AirbnbSearch.nonPathParams) : AirbnbSearch.params;
                newParams = this.removeDefaultParams(params);
                AirbnbSearch.activeRequest = $.getJSON("/search/ajax_get_results", newParams).done(function(data) {
                    AirbnbSearch.loadNewResultsCallback(data, opts)
                    }).fail(function(data) {
                    if (data.status > 0) {
                        hideLoadingOverlays();
                        AirbnbSearch.showBlankState(data.status)
                        }
                });
                return true
            },
            removeDefaultParams: function(params) {
                var key,
                value,
                newParams;
                newParams = _.clone(params);
                for (key in newParams) {
                    if (newParams.hasOwnProperty(key)) {
                        value = newParams[key];
                        if (value === AirbnbSearch.DEFAULT_PARAMS[key]) {
                            delete newParams[key]
                            }
                    }
                }
                return newParams
            },
            hoverListResult: function(hostingId) {
                var parentId = "#room_" + hostingId,
                marker = AMM.markers[hostingId],
                icon;
                $(parentId).addClass("hover");
                if (marker && (typeof marker.numbered_pin !== "undefined")) {
                    if ($.inArray(hostingId.toString(), AirbnbSearch.viewedIds) !== -1) {
                        icon = MapIcons.numberedVisitedHover[marker.numbered_pin + 1]
                        } else {
                        icon = MapIcons.numberedHover[marker.numbered_pin + 1]
                        }
                    marker.marker.setIcon(icon)
                    }
            },
            unHoverListResult: function(hostingId) {
                var marker = AMM.markers[hostingId],
                icon;
                $("#room_" + hostingId).removeClass("hover");
                if (marker && (typeof marker.numbered_pin !== "undefined")) {
                    if ($.inArray(hostingId.toString(), AirbnbSearch.viewedIds) !== -1) {
                        icon = MapIcons.numberedVisited[marker.numbered_pin + 1]
                        } else {
                        icon = MapIcons.numbered[marker.numbered_pin + 1]
                        }
                    marker.marker.setIcon(icon)
                    }
            },
            showBlankState: function(message) {
                var templateMessages;
                this.$resultsFooter.hide();
                if (message) {
                    this.$results.html(JST["search/blank_state_error"]({
                        message: message
                    }))
                    } else {
                    if (SearchFilters.hasFilters()) {
                        templateMessages = {
                            title: I18n.t("too_many_filters"),
                            tips: [I18n.t("remove_filters"), I18n.t("search_specific"), I18n.t("browse_wishlists")]
                            }
                    } else {
                        templateMessages = {
                            title: I18n.t("too_specific"),
                            tips: [I18n.t("expand_search"), I18n.t("search_specific"), I18n.t("browse_wishlists")]
                            }
                    }
                    this.$results.html(JST["search/blank_state"](templateMessages))
                    }
            },
            getViewedPage3Ids: function() {
                var commaSeparatedPage3Ids = window.localStorage && localStorage.getItem("viewed_page3_ids"),
                ids;
                if (commaSeparatedPage3Ids) {
                    ids = commaSeparatedPage3Ids.split(",");
                    ids = _.uniq(ids)
                    }
                return ids || []
                },
            includeCollectionParam: function() {
                return !! AirbnbSearch.params.collection_id
            },
            includeHostParam: function() {
                return AirbnbSearch.hostId && !AirbnbSearch.forceHideHost && (!(AirbnbSearch.params.location) || AirbnbSearch.params.location === "")
                },
            includeGroupParam: function() {
                return AirbnbSearch.groupId && !AirbnbSearch.forceHideGroup && (!(AirbnbSearch.params.location) || AirbnbSearch.params.location === "")
                },
            disableDistanceSort: function() {
                if (!this.distanceOption) {
                    this.distanceOption = $("#sort").find('option[value="2"]').detach()
                    }
            },
            enableDistanceSort: function() {
                if (this.distanceOption) {
                    $("#sort").find("option").first().after(this.distanceOption);
                    this.distanceOption = null
                }
            },
            isSearchInDisasterZone: function(json) {
                var lat = json.center_lat,
                lng = json.center_lng;
                $.ajax({
                    type: "POST",
                    url: "/disaster/lookup",
                    data: {
                        lat: lat,
                        lng: lng
                    },
                    success: function(data) {
                        if (data.disaster) {
                            AirbnbSearch.displayDisasterRooster(data.disaster.disaster)
                            }
                    },
                    dataType: "json"
                })
                },
            displayDisasterRooster: function(disaster) {
                Airbnb.Rooster.prototype.template = JST.rooster_disaster_response({
                    disasterName: disaster.name,
                    collectionId: disaster.collection_id,
                    id: disaster.id
                });
                new Airbnb.Rooster(".rooster-root", "disaster_rooster", "has_disaster_rooster")
                },
            $: $(window)
            };
        window.AirbnbSearch = AirbnbSearch
    })(window);
    var BannerFactory = {
        banners: {
            airmatch: function(url) {
                return new Banner({
                    el: "#top_banner",
                    url: url,
                    message: I18n.t("airmatch_banner_text")
                    })
                },
            index_delay: function() {
                return new Banner({
                    el: "#top_banner",
                    message: I18n.t("index_delay_banner_text"),
                    type: "alert"
                })
                },
            vanity: function() {
                return new Banner({
                    el: "#top_banner",
                    message: I18n.t("vanity_banner_text"),
                    type: "alert"
                })
                },
            neighborhood: function(message, url) {
                return new Banner({
                    el: "#top_banner",
                    message: message,
                    url: url
                })
                }
        },
        createBanner: function(bannerType) {
            var bannerConstructor = this.banners[bannerType],
            banner,
            args;
            if (typeof bannerConstructor !== "function") {
                return false
            }
            args = Array.prototype.slice.call(arguments, 1);
            banner = bannerConstructor.apply(this, args);
            banner.show();
            return banner
        }
    };
    var Banner = Backbone.View.extend({
        classNames: ["alert-info", "alert-error", "alert-facebook", "alert-success"],
        initialize: function(options) {
            this.$link = this.$el.find("#banner_link");
            this.allClasses = this.classNames.join(" ");
            if (options.url) {
                this.setMessage(options.message);
                this.setUrl(options.url)
                } else {
                this.setMessageNoLink(options.message)
                }
            this.setClass(options.type)
            },
        hide: function() {
            return this.$el.hide()
            },
        isVisible: function() {
            return this.$el.is(":visible")
            },
        show: function() {
            return this.$el.show()
            },
        setMessageNoLink: function(message) {
            this.$el.html(message);
            return this
        },
        setMessage: function(message) {
            this.$link.html(message);
            return this
        },
        setClass: function(className) {
            var classNames = this.allClasses;
            if (!className) {
                return
            }
            this.$el.removeClass(classNames);
            if (classNames.indexOf(className) !== -1) {
                this.$el.addClass(className)
                }
        },
        setUrl: function(url) {
            if (!url) {
                this.$link.removeAttr("href")
                } else {
                this.$link.attr("href", url)
                }
            return this
        }
    });
    function googleTagAB(dataLayer) {
        var google_tag_params = {
            a_b_test_side: AirbnbSearch.remarketing_side,
            language: AirbnbSearch.remarketing_language
        };
        dataLayer.push({
            google_tag_params: google_tag_params
        })
        }
} (window, jQuery, Airbnb, I18n, JSCookie, JST); (function() {
    this.JST || (this.JST = {});
    this.JST["wishlists/logged_out_modal"] = (function() {
        this.JST || (this.JST = {});
        this.JST["wishlists/logged_out_modal"] = Handlebars.template(function(Handlebars, depth0, helpers, partials, data) {
            this.compilerInfo = [2, ">= 1.0.0-rc.3"];
            helpers = helpers || Handlebars.helpers;
            data = data || {};
            var buffer = "",
            stack1,
            options,
            helperMissing = helpers.helperMissing,
            escapeExpression = this.escapeExpression;
            buffer += '<div class="modal" id="modal-log-in">\n  <div class="modal-header">\n    <h3>';
            options = {
                hash: {},
                data: data
            };
            buffer += escapeExpression(((stack1 = helpers.t), stack1 ? stack1.call(depth0, "must_log_in", options) : helperMissing.call(depth0, "t", "must_log_in", options))) + '</h3>\n  </div>\n  <div class="modal-body">\n    <p>';
            options = {
                hash: {},
                data: data
            };
            buffer += escapeExpression(((stack1 = helpers.t), stack1 ? stack1.call(depth0, "log_in_to_save", options) : helperMissing.call(depth0, "t", "log_in_to_save", options))) + '</p>\n  </div>\n  <div class="modal-footer">\n    <button class="btn remove login">';
            options = {
                hash: {},
                data: data
            };
            buffer += escapeExpression(((stack1 = helpers.t), stack1 ? stack1.call(depth0, "shared.Log_in", options) : helperMissing.call(depth0, "t", "shared.Log_in", options))) + '</button>\n    <button class="btn gray cancel">';
            options = {
                hash: {},
                data: data
            };
            buffer += escapeExpression(((stack1 = helpers.t), stack1 ? stack1.call(depth0, "shared.Cancel", options) : helperMissing.call(depth0, "t", "shared.Cancel", options))) + "</button>\n  </div>\n</div>\n";
            return buffer
        });
        return this.JST["wishlists/logged_out_modal"]
        }).call(this)
    }).call(this); ! function() {
    var CityBannerModel = Backbone.Model.extend({
        parse: function(resp) {
            return resp.city
        },
        url: function() {
            return ["/locations/api/city_by_point?", "point[lat]=", this.get("lat"), "&point[lon]=", this.get("lng")].join("")
            }
    });
    var NeighborhoodBannerModel = Backbone.Model.extend({
        parse: function(resp) {
            if (resp.length > 0) {
                return resp[0]
                }
            return resp
        },
        url: function() {
            return ["/locations/api/neighborhood_tiles_by_point.json?", "point[lat]=", this.get("lat"), "&point[lon]=", this.get("lng")].join("")
            }
    });
    provide("neighborhoods/neighborhood_banner_model", NeighborhoodBannerModel);
    provide("neighborhoods/city_banner_model", CityBannerModel)
    } ();