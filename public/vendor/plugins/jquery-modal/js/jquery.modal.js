/*
    A simple jQuery modalCtm (http://github.com/kylefox/jquery-modalCtm)
    Version 0.9.2
*/

(function (factory) {
    // Making your jQuery plugin work better with npm tools
    // http://blog.npmjs.org/post/112712169830/making-your-jquery-plugin-work-better-with-npm
    if (typeof module === "object" && typeof module.exports === "object") {
        factory(require("jquery"), window, document);
    } else {
        factory(jQuery, window, document);
    }
}(function ($, window, document, undefined) {
    var modalCtms = [],
        getCurrent = function () {
            return modalCtms.length ? modalCtms[modalCtms.length - 1] : null;
        },
        selectCurrent = function () {
            var i,
                selected = false;
            for (i = modalCtms.length - 1; i >= 0; i--) {
                if (modalCtms[i].$blocker) {
                    modalCtms[i].$blocker.toggleClass('current', !selected).toggleClass('behind', selected);
                    selected = true;
                }
            }
        };

    // var myModalCtm = $.fn.modalCtm.noConflict()
    // $.fn.bsModalCtm = myModalCtm

    $.modalCtm = function (el, options) {
        var remove, target;
        this.$body = $('body');
        this.options = $.extend({}, $.modalCtm.defaults, options);
        this.options.doFade = !isNaN(parseInt(this.options.fadeDuration, 10));
        this.$blocker = null;
        if (this.options.closeExisting)
            while ($.modalCtm.isActive())
                $.modalCtm.close(); // Close any open modalCtms.
        modalCtms.push(this);
        if (el.is('a')) {
            target = el.attr('href');
            this.anchor = el;
            //Select element by id from href
            if (/^#/.test(target)) {
                this.$elm = $(target);
                if (this.$elm.length !== 1) return null;
                this.$body.append(this.$elm);
                this.open();
                //AJAX
            } else {
                this.$elm = $('<div>');
                this.$body.append(this.$elm);
                remove = function (event, modalCtm) {
                    modalCtm.elm.remove();
                };
                this.showSpinner();
                el.trigger($.modalCtm.AJAX_SEND);
                $.get(target).done(function (html) {
                    if (!$.modalCtm.isActive()) return;
                    el.trigger($.modalCtm.AJAX_SUCCESS);
                    var current = getCurrent();
                    current.$elm.empty().append(html).on($.modalCtm.CLOSE, remove);
                    current.hideSpinner();
                    current.open();
                    el.trigger($.modalCtm.AJAX_COMPLETE);
                }).fail(function () {
                    el.trigger($.modalCtm.AJAX_FAIL);
                    var current = getCurrent();
                    current.hideSpinner();
                    modalCtms.pop(); // remove expected modalCtm from the list
                    el.trigger($.modalCtm.AJAX_COMPLETE);
                });
            }
        } else {
            this.$elm = el;
            this.anchor = el;
            this.$body.append(this.$elm);
            this.open();
        }
    };

    $.modalCtm.prototype = {
        constructor: $.modalCtm,

        open: function () {
            var m = this;
            this.block();
            this.anchor.blur();
            if (this.options.doFade) {
                setTimeout(function () {
                    m.show();
                }, this.options.fadeDuration * this.options.fadeDelay);
            } else {
                this.show();
            }
            $(document).off('keydown.modalCtm').on('keydown.modalCtm', function (event) {
                var current = getCurrent();
                if (event.which === 27 && current.options.escapeClose) current.close();
            });
            if (this.options.clickClose)
                this.$blocker.click(function (e) {
                    if (e.target === this)
                        $.modalCtm.close();
                });
        },

        close: function () {
            modalCtms.pop();
            this.unblock();
            this.hide();
            if (!$.modalCtm.isActive())
                $(document).off('keydown.modalCtm');
        },

        block: function () {
            this.$elm.trigger($.modalCtm.BEFORE_BLOCK, [this._ctx()]);
            this.$body.css('overflow', 'hidden');
            // This add extra padding when modal is opened
            this.$body.css('padding-right', '17px');
            this.$blocker = $('<div class="' + this.options.blockerClass + ' blocker current"></div>').appendTo(this.$body);
            selectCurrent();
            if (this.options.doFade) {
                this.$blocker.css('opacity', 0).animate({opacity: 1}, this.options.fadeDuration);
            }
            this.$elm.trigger($.modalCtm.BLOCK, [this._ctx()]);
        },

        unblock: function (now) {
            if (!now && this.options.doFade)
                this.$blocker.fadeOut(this.options.fadeDuration, this.unblock.bind(this, true));
            else {
                this.$blocker.children().appendTo(this.$body);
                this.$blocker.remove();
                this.$blocker = null;
                selectCurrent();
                if (!$.modalCtm.isActive())
                    this.$body.css('overflow', '');
            }
        },

        show: function () {
            this.$elm.trigger($.modalCtm.BEFORE_OPEN, [this._ctx()]);
            if (this.options.showClose) {
                this.closeButton = $('<a href="#close-modalCtm" rel="modalCtm:close" class="close-modalCtm ' + this.options.closeClass + '">' + this.options.closeText + '</a>');
                this.$elm.append(this.closeButton);
            }
            this.$elm.addClass(this.options.modalCtmClass).appendTo(this.$blocker);
            if (this.options.doFade) {
                this.$elm.css({opacity: 0, display: 'inline-block'}).animate({opacity: 1}, this.options.fadeDuration);
            } else {
                this.$elm.css('display', 'inline-block');
            }
            this.$elm.trigger($.modalCtm.OPEN, [this._ctx()]);
        },

        hide: function () {
            this.$elm.trigger($.modalCtm.BEFORE_CLOSE, [this._ctx()]);
            if (this.closeButton) this.closeButton.remove();
            // This hides padding from body when modal is closed
            this.$body.css('padding-right', '');
            this.$body.css('overflow', '');
            // Removes error message when modal hides
            // livewire.emit('refreshErrors')
            var _this = this;
            if (this.options.doFade) {
                this.$elm.fadeOut(this.options.fadeDuration, function () {
                    _this.$elm.trigger($.modalCtm.AFTER_CLOSE, [_this._ctx()]);
                });
            } else {
                this.$elm.hide(0, function () {
                    _this.$elm.trigger($.modalCtm.AFTER_CLOSE, [_this._ctx()]);
                });
            }
            this.$elm.trigger($.modalCtm.CLOSE, [this._ctx()]);
        },

        showSpinner: function () {
            if (!this.options.showSpinner) return;
            this.spinner = this.spinner || $('<div class="' + this.options.modalCtmClass + '-spinner"></div>')
                .append(this.options.spinnerHtml);
            this.$body.append(this.spinner);
            this.spinner.show();
        },

        hideSpinner: function () {
            if (this.spinner) this.spinner.remove();
        },

        //Return context for custom events
        _ctx: function () {
            return {
                elm: this.$elm,
                $elm: this.$elm,
                $blocker: this.$blocker,
                options: this.options,
                $anchor: this.anchor
            };
        }
    };

    $.modalCtm.close = function (event) {
        if (!$.modalCtm.isActive()) return;
        if (event) event.preventDefault();
        var current = getCurrent();
        current.close();
        return current.$elm;
    };

    // Returns if there currently is an active modalCtm
    $.modalCtm.isActive = function () {
        return modalCtms.length > 0;
    };

    $.modalCtm.getCurrent = getCurrent;

    $.modalCtm.defaults = {
        closeExisting: true,
        escapeClose: true,
        clickClose: true,
        closeText: 'Close',
        closeClass: '',
        modalCtmClass: "modalCtm",
        blockerClass: "jquery-modalCtm",
        spinnerHtml: '<div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div>',
        showSpinner: true,
        showClose: true,
        fadeDuration: null,   // Number of milliseconds the fade animation takes.
        fadeDelay: 1.0        // Point during the overlay's fade-in that the modalCtm begins to fade in (.5 = 50%, 1.5 = 150%, etc.)
    };

    // Event constants
    $.modalCtm.BEFORE_BLOCK = 'modalCtm:before-block';
    $.modalCtm.BLOCK = 'modalCtm:block';
    $.modalCtm.BEFORE_OPEN = 'modalCtm:before-open';
    $.modalCtm.OPEN = 'modalCtm:open';
    $.modalCtm.BEFORE_CLOSE = 'modalCtm:before-close';
    $.modalCtm.CLOSE = 'modalCtm:close';
    $.modalCtm.AFTER_CLOSE = 'modalCtm:after-close';
    $.modalCtm.AJAX_SEND = 'modalCtm:ajax:send';
    $.modalCtm.AJAX_SUCCESS = 'modalCtm:ajax:success';
    $.modalCtm.AJAX_FAIL = 'modalCtm:ajax:fail';
    $.modalCtm.AJAX_COMPLETE = 'modalCtm:ajax:complete';

    $.fn.modalCtm = function (options) {
        if (this.length === 1) {
            new $.modalCtm(this, options);
        }
        return this;
    };

    // Automatically bind links with rel="modalCtm:close" to, well, close the modalCtm.
    $(document).on('click.modalCtm', 'a[rel~="modalCtm:close"]', $.modalCtm.close);
    $(document).on('click.modalCtm', 'a[rel~="modalCtm:open"]', function (event) {
        event.preventDefault();
        $(this).modalCtm();
    });
}));
