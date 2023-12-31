/*
 * HSCore
 * @version: 2.0.0 (Mon, 25 Nov 2019)
 * @requires: jQuery v3.0 or later
 * @author: HtmlStream
 * @event-namespace: .HSCore
 * @license: Htmlstream Libraries (https://htmlstream.com/licenses)
 * Copyright 2020 Htmlstream
 */
"use strict";
$.extend({
    HSCore: {
        init: function () {
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip(), $('[data-toggle="popover"]').popover();
            });
        },
        components: {},
    },
}),
    $.HSCore.init(),
    (function (t) {
        t.HSCore.components.HSChartJS = {
            defaults: {
                options: {
                    responsive: !0,
                    maintainAspectRatio: !1,
                    legend: { display: !1 },
                    tooltips: { enabled: !1, mode: "nearest", prefix: "", postfix: "", hasIndicator: !1, indicatorWidth: "8px", indicatorHeight: "8px", transition: "0.2s", lineWithLineColor: null, yearStamp: !0 },
                    gradientPosition: { x0: 0, y0: 0, x1: 0, y1: 0 },
                },
            },
            init: function (e, s) {
                if (e.length) {
                    var a = Object.assign({}, this.defaults),
                        n = e.attr("data-hs-chartjs-options") ? JSON.parse(e.attr("data-hs-chartjs-options")) : {},
                        i = {};
                    (i = t.extend(
                        !0,
                        n.type,
                        a,
                        "line" === n.type
                            ? {
                                  options: {
                                      scales: {
                                          yAxes: [
                                              {
                                                  ticks: {
                                                      callback: function (t, e, s) {
                                                          var a = i.options.scales.yAxes[0].ticks.metric,
                                                              n = i.options.scales.yAxes[0].ticks.prefix,
                                                              o = i.options.scales.yAxes[0].ticks.postfix;
                                                          return a && t > 100 && (t = t < 1e6 ? t / 1e3 + "k" : t / 1e6 + "kk"), n && o ? n + t + o : n ? n + t : o ? t + o : t;
                                                      },
                                                  },
                                              },
                                          ],
                                      },
                                      elements: { line: { borderWidth: 3 }, point: { pointStyle: "circle", radius: 5, hoverRadius: 7, borderWidth: 3, hoverBorderWidth: 3, backgroundColor: "#ffffff", hoverBackgroundColor: "#ffffff" } },
                                  },
                              }
                            : "bar" === n.type
                            ? {
                                  options: {
                                      scales: {
                                          yAxes: [
                                              {
                                                  ticks: {
                                                      callback: function (t, e, s) {
                                                          var a = i.options.scales.yAxes[0].ticks.metric,
                                                              n = i.options.scales.yAxes[0].ticks.prefix,
                                                              o = i.options.scales.yAxes[0].ticks.postfix;
                                                          return a && t > 100 && (t = t < 1e6 ? t / 1e3 + "k" : t / 1e6 + "kk"), n && o ? n + t + o : n ? n + t : o ? t + o : t;
                                                      },
                                                  },
                                              },
                                          ],
                                      },
                                  },
                              }
                            : {}
                    )),
                        "line" ===
                            (i = t.extend(
                                !0,
                                i,
                                {
                                    options: {
                                        tooltips: {
                                            custom: function (t) {
                                                var s = document.getElementById("chartjsTooltip");
                                                if (
                                                    (s ||
                                                        (((s = document.createElement("div")).id = "chartjsTooltip"),
                                                        (s.style.opacity = 0),
                                                        s.classList.add("hs-chartjs-tooltip-wrap"),
                                                        (s.innerHTML = '<div class="hs-chartjs-tooltip"></div>'),
                                                        i.options.tooltips.lineMode ? e.parent(".chartjs-custom").append(s) : document.body.appendChild(s)),
                                                    0 === t.opacity)
                                                )
                                                    return (s.style.opacity = 0), void s.parentNode.removeChild(s);
                                                if ((s.classList.remove("above", "below", "no-transform"), t.yAlign ? s.classList.add(t.yAlign) : s.classList.add("no-transform"), t.body)) {
                                                    var a = t.title || [],
                                                        n = t.body.map(function (t) {
                                                            return t.lines;
                                                        }),
                                                        o = new Date(),
                                                        r = '<header class="hs-chartjs-tooltip-header">';
                                                    a.forEach(function (t) {
                                                        r += i.options.tooltips.yearStamp ? t + ", " + o.getFullYear() : t;
                                                    }),
                                                        (r += '</header><div class="hs-chartjs-tooltip-body">'),
                                                        n.forEach(function (e, s) {
                                                            r += "<div>";
                                                            var a = e[0],
                                                                n = a,
                                                                o = t.labelColors[s].backgroundColor instanceof Object ? t.labelColors[s].borderColor : t.labelColors[s].backgroundColor;
                                                            (r +=
                                                                (i.options.tooltips.hasIndicator
                                                                    ? '<span class="d-inline-block rounded-circle mr-1" style="width: ' +
                                                                      i.options.tooltips.indicatorWidth +
                                                                      "; height: " +
                                                                      i.options.tooltips.indicatorHeight +
                                                                      "; background-color: " +
                                                                      o +
                                                                      '"></span>'
                                                                    : "") +
                                                                i.options.tooltips.prefix +
                                                                (a.length > 3 ? n : e) +
                                                                i.options.tooltips.postfix),
                                                                (r += "</div>");
                                                        }),
                                                        (r += "</div>"),
                                                        (s.querySelector(".hs-chartjs-tooltip").innerHTML = r);
                                                }
                                                var l = this._chart.canvas.getBoundingClientRect();
                                                (s.style.opacity = 1),
                                                    i.options.tooltips.lineMode ? (s.style.left = t.caretX + "px") : (s.style.left = l.left + window.pageXOffset + t.caretX - s.offsetWidth / 2 - 3 + "px"),
                                                    (s.style.top = l.top + window.pageYOffset + t.caretY - s.offsetHeight - 25 + "px"),
                                                    (s.style.pointerEvents = "none"),
                                                    (s.style.transition = i.options.tooltips.transition);
                                            },
                                        },
                                    },
                                },
                                n,
                                i,
                                s
                            )).type &&
                            i.data.datasets.forEach(function (t) {
                                if (Array.isArray(t.backgroundColor)) {
                                    var s = e[0].getContext("2d").createLinearGradient(i.options.gradientPosition.x0, i.options.gradientPosition.y0, i.options.gradientPosition.x1, i.options.gradientPosition.y1);
                                    for (let e = 0; e < t.backgroundColor.length; e++) s.addColorStop(e, t.backgroundColor[e]);
                                    t.backgroundColor = s;
                                }
                            });
                    var o = new Chart(e, i);
                    if ("line" === i.type && i.options.tooltips.lineMode) {
                        var r = o.draw;
                        (o.draw = function (e) {
                            if ((r.call(this, e), this.chart.tooltip._active && this.chart.tooltip._active.length)) {
                                this.chart.tooltip._active[0];
                                var s = t(this.chart.canvas),
                                    a = t(".hs-chartjs-tooltip-wrap"),
                                    n = t("#chartjsTooltipLine"),
                                    o = i.options.tooltips.lineWithLineTopOffset >= 0 ? i.options.tooltips.lineWithLineTopOffset : 7,
                                    l = i.options.tooltips.lineWithLineBottomOffset >= 0 ? i.options.tooltips.lineWithLineBottomOffset : 43;
                                t("#chartjsTooltip #chartjsTooltipLine").length || t("#chartjsTooltip").append('<div id="chartjsTooltipLine"></div>'),
                                    a.css({ top: s.height() / 2 - a.height() }),
                                    n.css({ top: -(a.offset().top - s.offset().top) + o }),
                                    a.offset().left + a.width() > s.offset().left + s.width() - 100
                                        ? t(".hs-chartjs-tooltip").removeClass("hs-chartjs-tooltip-right").addClass("hs-chartjs-tooltip-left")
                                        : t(".hs-chartjs-tooltip").addClass("hs-chartjs-tooltip-right").removeClass("hs-chartjs-tooltip-left"),
                                    n.length &&
                                        n.css({ position: "absolute", width: "2px", height: s.height() - l, backgroundColor: i.options.tooltips.lineWithLineColor, left: 0, transform: "translateX(-50%)", zIndex: 0, transition: "100ms" });
                            }
                        }),
                            e.on("mouseleave", function () {
                                t("#lineTooltipChartJSStyles").attr("media", "max-width: 1px");
                            }),
                            e.on("mouseenter", function () {
                                t("#lineTooltipChartJSStyles").removeAttr("media");
                            }),
                            e.on("mousemove", function (s) {
                                s.pageY - e.offset().top > t(".hs-chartjs-tooltip-wrap").height() / 2 &&
                                    s.pageY - e.offset().top + t(".hs-chartjs-tooltip-wrap").outerHeight() / 2 < e.height() &&
                                    t(".hs-chartjs-tooltip").css({ top: s.pageY + t(".hs-chartjs-tooltip-wrap").height() / 2 - (e.offset().top + e.height() / 2) });
                            });
                    }
                    return o;
                }
            },
        };
    })(jQuery),
    (function (t) {
        t.HSCore.components.HSCircles = {
            defaults: {
                radius: 80,
                duration: 1e3,
                wrpClass: "circles-wrap",
                colors: ["#377dff", "#e7eaf3"],
                debounce: 10,
                rtl: !1,
                isHideValue: !1,
                dividerSpace: null,
                isViewportInit: !1,
                fgStrokeLinecap: null,
                fgStrokeMiterlimit: null,
                additionalTextType: null,
                additionalText: null,
                textFontSize: null,
                textFontWeight: null,
                textColor: null,
                secondaryText: null,
                secondaryTextFontWeight: null,
                secondaryTextFontSize: null,
                secondaryTextColor: null,
            },
            init: function (e, s) {
                if (e.length) {
                    var a = Object.assign({}, this.defaults),
                        n = e.attr("data-hs-circles-options") ? JSON.parse(e.attr("data-hs-circles-options")) : {},
                        i = {
                            id: "circle-" + Math.random().toString().slice(2),
                            value: 0,
                            text: function (t) {
                                return "iconic" === n.type
                                    ? n.icon
                                    : "prefix" === n.additionalTextType
                                    ? n.secondaryText
                                        ? (n.additionalText || "") +
                                          (n.isHideValue ? "" : t) +
                                          '<div style="margin-top: ' +
                                          (n.dividerSpace / 2 + "px" || "0") +
                                          "; margin-bottom: " +
                                          (n.dividerSpace / 2 + "px" || "0") +
                                          ';"></div><div style="font-weight: ' +
                                          n.secondaryTextFontWeight +
                                          "; font-size: " +
                                          n.secondaryTextFontSize +
                                          "px; color: " +
                                          n.secondaryTextColor +
                                          ';">' +
                                          n.secondaryText +
                                          "</div>"
                                        : (n.additionalText || "") + (n.isHideValue ? "" : t)
                                    : n.secondaryText
                                    ? (n.isHideValue ? "" : t) +
                                      (n.additionalText || "") +
                                      '<div style="margin-top: ' +
                                      (n.dividerSpace / 2 + "px" || "0") +
                                      "; margin-bottom: " +
                                      (n.dividerSpace / 2 + "px" || "0") +
                                      ';"></div><div style="font-weight: ' +
                                      n.secondaryTextFontWeight +
                                      "; font-size: " +
                                      n.secondaryTextFontSize +
                                      "px; color: " +
                                      n.secondaryTextColor +
                                      ';">' +
                                      n.secondaryText +
                                      "</div>"
                                    : (n.isHideValue ? "" : t) + (n.additionalText || "");
                            },
                        };
                    (i = t.extend(a, i, n, s)).isViewportInit && (i.value = 0), this.setId(e, i.id);
                    var o = Circles.create(i);
                    return (
                        e.data("circle", o),
                        this.setTextStyles(e, o, i),
                        i.rtl && this.setRtl(e),
                        i.fgStrokeLinecap && this.setStrokeLineCap(e, o, i),
                        i.fgStrokeMiterlimit && this.setStrokeMiterLimit(e, o, i),
                        i.isViewportInit && this.initAppear(o, i),
                        o
                    );
                }
            },
            setId: function (t, e) {
                t.attr("id", e);
            },
            setTextStyles: function (t, e, s) {
                var a = s;
                t.find('[class="' + (a.textClass || e._textClass) + '"]').css({ "font-size": a.textFontSize, "font-weight": a.textFontWeight, color: a.textColor, "line-height": "normal", height: "auto", top: "", left: "" });
            },
            setRtl: function (t) {
                t.find("svg").css("transform", "matrix(-1, 0, 0, 1, 0, 0)");
            },
            setStrokeLineCap: function (t, e, s) {
                var a = s;
                t.find('[class="' + e._valClass + '"]').attr("stroke-linecap", a.fgStrokeLinecap);
            },
            setStrokeMiterLimit: function (t, e, s) {
                var a = s;
                t.find('[class="' + e._valClass + '"]').attr("stroke-miterlimit", a.fgStrokeMiterlimit);
            },
            initAppear: function (e, s) {
                var a = s;
                appear({
                    bounds: a.bounds,
                    debounce: a.debounce,
                    elements: function () {
                        return document.querySelectorAll("#" + a.id);
                    },
                    appear: function (s) {
                        e.update(JSON.parse(t(s).attr("data-hs-circles-options")).value);
                    },
                });
            },
        };
    })(jQuery),
    (function (t) {
        t.HSCore.components.HSClipboard = {
            defaults: { type: null, contentTarget: null, classChangeTarget: null, defaultClass: null, successText: null, successClass: null, originalTitle: null },
            init: function (e, s) {
                if (t(e).length) {
                    var a = t(e),
                        n = Object.assign({}, this.defaults),
                        i = a.attr("data-hs-clipboard-options") ? JSON.parse(a.attr("data-hs-clipboard-options")) : {},
                        o = {
                            shortcodes: {},
                            windowWidth: t(window).width(),
                            defaultText: a.get(0).lastChild.nodeValue,
                            title: a.attr("title"),
                            container: !!i.container && document.querySelector(i.container),
                            text: function (e) {
                                var s = JSON.parse(t(e).attr("data-hs-clipboard-options"));
                                return o.shortcodes[s.contentTarget];
                            },
                        };
                    (o = t.extend(!0, n, i, o, s)), i.contentTarget && this.setShortcodes(a, o);
                    var r = new ClipboardJS(e, o);
                    return (
                        r.on("success", function () {
                            (o.successText || o.successClass) &&
                                (o.successText &&
                                    ("tooltip" === o.type
                                        ? (a.attr("data-original-title", o.successText).tooltip("show"),
                                          a.on("mouseleave", function () {
                                              a.attr("data-original-title", o.title);
                                          }))
                                        : "popover" === o.type
                                        ? (a.attr("data-original-title", o.successText).popover("show"),
                                          a.on("mouseleave", function () {
                                              a.attr("data-original-title", o.title).popover("hide");
                                          }))
                                        : ((a.get(0).lastChild.nodeValue = " " + o.successText + " "),
                                          setTimeout(function () {
                                              a.get(0).lastChild.nodeValue = o.defaultText;
                                          }, 800))),
                                o.successClass &&
                                    (o.classChangeTarget
                                        ? (t(o.classChangeTarget).removeClass(o.defaultClass).addClass(o.successClass),
                                          setTimeout(function () {
                                              t(o.classChangeTarget).removeClass(o.successClass).addClass(o.defaultClass);
                                          }, 800))
                                        : (a.removeClass(o.defaultClass).addClass(o.successClass),
                                          setTimeout(function () {
                                              a.removeClass(o.successClass).addClass(o.defaultClass);
                                          }, 800))));
                        }),
                        r
                    );
                }
            },
            setShortcodes: function (e, s) {
                var a = s;
                t(a.contentTarget).is("input, textarea, select") ? (a.shortcodes[a.contentTarget] = t(a.contentTarget).val()) : (a.shortcodes[a.contentTarget] = t(a.contentTarget).html());
            },
        };
    })(jQuery),
    (function (t) {
        t.HSCore.components.HSDatatables = {
            defaults: {
                paging: !0,
                info: { currentInterval: null, totalQty: null, divider: " to " },
                isSelectable: !1,
                isColumnsSearch: !1,
                isColumnsSearchTheadAfter: !1,
                pagination: null,
                paginationClasses: "pagination datatable-custom-pagination",
                paginationLinksClasses: "page-link",
                paginationItemsClasses: "page-item",
                paginationPrevClasses: "page-item",
                paginationPrevLinkClasses: "page-link",
                paginationPrevLinkMarkup: '<span aria-hidden="true">Prev</span>',
                paginationNextClasses: "page-item",
                paginationNextLinkClasses: "page-link",
                paginationNextLinkMarkup: '<span aria-hidden="true">Next</span>',
                detailsInvoker: null,
                select: null,
            },
            init: function (e, s) {
                if (e.length) {
                    var a = Object.assign({}, this.defaults),
                        n = e.attr("data-hs-datatables-options") ? JSON.parse(e.attr("data-hs-datatables-options")) : {},
                        i = {};
                    i = t.extend(a, i, n, s);
                    var o = e.DataTable(i),
                        r = new t.fn.dataTable.Api(e),
                        l = function () {
                            var s = r.page.info(),
                                a = t("#" + r.context[0].nTable.id + "_paginate"),
                                n = a.find(".paginate_button.previous"),
                                o = a.find(".paginate_button.next"),
                                l = a.find(".paginate_button:not(.previous):not(.next), .ellipsis");
                            n.wrap('<span class="' + i.paginationItemsClasses + '"></span>'),
                                n.addClass(i.paginationPrevLinkClasses).html(i.paginationPrevLinkMarkup),
                                o.wrap('<span class="' + i.paginationItemsClasses + '"></span>'),
                                o.addClass(i.paginationNextLinkClasses).html(i.paginationNextLinkMarkup),
                                n.unwrap(n.parent()).wrap('<li class="paginate_item ' + i.paginationItemsClasses + '"></li>'),
                                n.hasClass("disabled") && (n.removeClass("disabled"), n.parent().addClass("disabled")),
                                o.unwrap(o.parent()).wrap('<li class="paginate_item ' + i.paginationItemsClasses + '"></li>'),
                                o.hasClass("disabled") && (o.removeClass("disabled"), o.parent().addClass("disabled")),
                                l.unwrap(l.parent()),
                                l.each(function () {
                                    t(this).hasClass("current")
                                        ? (t(this).removeClass("current"), t(this).wrap('<li class="paginate_item ' + i.paginationItemsClasses + ' active"></li>'))
                                        : t(this).wrap('<li class="paginate_item ' + i.paginationItemsClasses + '"></li>');
                                }),
                                l.addClass(i.paginationLinksClasses),
                                a.prepend('<ul id="' + r.context[0].nTable.id + '_pagination" class="' + i.paginationClasses + '"></ul>'),
                                a.find(".paginate_item").appendTo("#" + r.context[0].nTable.id + "_pagination"),
                                s.pages <= 1 ? t("#" + i.pagination).hide() : t("#" + i.pagination).show(),
                                i.info.currentInterval && t(i.info.currentInterval).html(s.start + 1 + i.info.divider + s.end),
                                i.info.totalQty && t(i.info.totalQty).html(s.recordsDisplay),
                                i.scrollY && e.find(t(".dataTables_scrollBody thead tr")).css({ visibility: "hidden" });
                        };
                    return (
                        l(),
                        o.on("draw", l),
                        this.customPagination(e, o, i),
                        this.customSearch(e, o, i),
                        i.isColumnsSearch && this.customColumnsSearch(e, o, i),
                        this.customEntries(e, o, i),
                        i.isSelectable && this.rowChecking(e),
                        this.details(e, i.detailsInvoker, o),
                        i.select && this.select(i.select, o),
                        o
                    );
                }
            },
            customPagination: function (e, s, a) {
                t("#" + a.pagination).append(t("#" + s.context[0].nTable.id + "_paginate"));
            },
            customSearch: function (e, s, a) {
                t(a.search).on("keyup", function () {
                    s.search(this.value).draw();
                });
            },
            customColumnsSearch: function (e, s, a) {
                var n = a;
                s.columns().every(function () {
                    var e = this;
                    n.isColumnsSearchTheadAfter && t(".dataTables_scrollFoot").insertAfter(".dataTables_scrollHead"),
                        t("input", this.footer()).on("keyup change", function () {
                            e.search() !== this.value && e.search(this.value).draw();
                        }),
                        t("select", this.footer()).on("change", function () {
                            e.search() !== this.value && e.search(this.value).draw();
                        });
                });
            },
            customEntries: function (e, s, a) {
                t(a.entries).on("change", function () {
                    var e = t(this).val();
                    s.page.len(e).draw();
                });
            },
            rowChecking: function (e) {
                t(e).on("change", "input", function () {
                    t(this).parents("tr").toggleClass("checked");
                });
            },
            format: function (t) {
                return t;
            },
            details: function (e, s, a) {
                if (s) {
                    var n = this;
                    t(e).on("click", s, function () {
                        var e = t(this).closest("tr"),
                            s = a.row(e);
                        s.child.isShown() ? (s.child.hide(), e.removeClass("opened")) : (s.child(n.format(e.data("details"))).show(), e.addClass("opened"));
                    });
                }
            },
            select: function (e, s) {
                t(e.classMap.checkAll).on("click", function () {
                    t(this).is(":checked")
                        ? (s.rows().select(),
                          s
                              .rows()
                              .nodes()
                              .each(function (s) {
                                  t(s).find(e.selector).prop("checked", !0);
                              }))
                        : (s.rows().deselect(),
                          s
                              .rows()
                              .nodes()
                              .each(function (s) {
                                  t(s).find(e.selector).prop("checked", !1);
                              }));
                }),
                    s
                        .on("select", function () {
                            t(e.classMap.counter).text(s.rows(".selected").data().length),
                                s.rows().data().length !== s.rows(".selected").data().length ? t(e.classMap.checkAll).prop("checked", !1) : t(e.classMap.checkAll).prop("checked", !0),
                                0 === s.rows(".selected").data().length ? t(e.classMap.counterInfo).hide() : t(e.classMap.counterInfo).show();
                        })
                        .on("deselect", function () {
                            t(e.classMap.counter).text(s.rows(".selected").data().length),
                                s.rows().data().length !== s.rows(".selected").data().length ? t(e.classMap.checkAll).prop("checked", !1) : t(e.classMap.checkAll).prop("checked", !0),
                                0 === s.rows(".selected").data().length ? t(e.classMap.counterInfo).hide() : t(e.classMap.counterInfo).show();
                        });
            },
        };
    })(jQuery),
    (function (t) {
        t.HSCore.components.HSDaterangepicker = {
            defaults: { nextArrow: '<i class="tio-chevron-right daterangepicker-custom-arrow"></i>', prevArrow: '<i class="tio-chevron-left daterangepicker-custom-arrow"></i>' },
            init: function (e, s, a) {
                if (e.length) {
                    var n = Object.assign({}, this.defaults),
                        i = e.attr("data-hs-daterangepicker-options") ? JSON.parse(e.attr("data-hs-daterangepicker-options")) : {},
                        o = {};
                    (o = t.extend(!0, n, i, o, s, a)).disablePrevDates && (o.minDate = moment().format("MM/DD/YYYY"));
                    var r = e.daterangepicker(o, a);
                    return (
                        r.on("showCalendar.daterangepicker", function (e) {
                            (o.prevArrow || o.nextArrow) && (t(".daterangepicker .prev").html(o.prevArrow), t(".daterangepicker .next").html(o.nextArrow));
                        }),
                        r
                    );
                }
            },
        };
    })(jQuery),
    (function (t) {
        t.HSCore.components.HSDropzone = {
            defaults: {
                url: "http://laravel-8.62-panel.test/panel/image/store",
                thumbnailWidth: 300,
                thumbnailHeight: 300,
                previewTemplate: t(
                    '<div>  <div class="col h-100 px-1 mb-2">    <div class="dz-preview dz-file-preview">      <div class="d-flex justify-content-end dz-close-icon">        <small class="tio-clear" data-dz-remove></small>      </div>      <div class="dz-details media">        <div class="dz-img">         <img class="img-fluid dz-img-inner" data-dz-thumbnail>        </div>        <div class="media-body dz-file-wrapper">         <h6 class="dz-filename">          <span class="dz-title" data-dz-name></span>         </h6>         <div class="dz-size" data-dz-size></div>        </div>      </div>      <div class="dz-progress progress">        <div class="dz-upload progress-bar bg-success" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>      </div>      <div class="d-flex align-items-center">        <div class="dz-success-mark">          <span class="tio-checkmark-circle"></span>        </div>        <div class="dz-error-mark">          <span class="tio-checkmark-circle-outlined"></span>        </div>        <div class="dz-error-message">          <small data-dz-errormessage></small>        </div>      </div>    </div>  </div></div>'
                ).html(),
            },
            init: function (e, s) {
                if (e.length) {
                    var a = t(e),
                        n = Object.assign({}, this.defaults),
                        i = a.attr("data-hs-dropzone-options") ? JSON.parse(a.attr("data-hs-dropzone-options")) : {},
                        o = {
                            init: function () {
                                var e = this,
                                    s = t(e.element).find(".dz-message");
                                e.on("addedfile", function (e) {
                                    "image/" !== String(e.type).slice(0, 6) &&
                                        t(e.previewElement)
                                            .find(".dz-img")
                                            .replaceWith('<span class="dz-file-initials">' + e.name.substring(0, 1).toUpperCase() + "</span>"),
                                        s.hide();
                                }),
                                    e.on("removedfile", function () {
                                        e.files.length <= 0 && s.show();
                                    });
                            },
                        };
                    return (o = t.extend(!0, n, o, i, s)), new Dropzone(e, o);
                }
            },
        };
    })(jQuery),
    (function (t) {
        t.HSCore.components.HSFancyBox = {
            defaults: {
                parentEl: "body",
                baseClass: "fancybox-custom",
                slideClass: "fancybox-slide",
                speed: 2e3,
                animationEffect: "fade",
                slideSpeedCoefficient: 1,
                infobar: !1,
                slideShow: { autoStart: !1, speed: 2e3 },
                transitionEffect: "slide",
                baseTpl:
                    '<div class="fancybox-container" role="dialog" tabindex="-1"><div class="fancybox-bg"></div>  <div class="fancybox-inner">    <div class="fancybox-infobar">      <span data-fancybox-index></span>&nbsp;/&nbsp;<span data-fancybox-count></span>    </div>    <div class="fancybox-toolbar">{{buttons}}</div>    <div class="fancybox-navigation">{{arrows}}</div>    <div class="fancybox-slider-wrap">      <div class="fancybox-stage"></div>    </div>    <div class="fancybox-caption-wrap">      <div class="fancybox-caption">        <div class="fancybox-caption__body"></div>      </div>    </div>  </div></div>',
            },
            init: function (e, s) {
                if (e.length) {
                    var a = t(e),
                        n = Object.assign({}, this.defaults),
                        i = a.attr("data-hs-fancybox-options") ? JSON.parse(a.attr("data-hs-fancybox-options")) : {},
                        o = {
                            beforeShow: function (e) {
                                var s = t(e.$refs.bg[0]),
                                    a = t(e.current.$slide),
                                    n = e.current.opts.$orig[0].dataset.hsFancyboxOptions ? JSON.parse(e.current.opts.$orig[0].dataset.hsFancyboxOptions) : {},
                                    i = !!n.transitionEffectCustom && n.transitionEffectCustom,
                                    o = n.overlayBg,
                                    r = n.overlayBlurBg;
                                i && a.css("visibility", "hidden"), o && s.css({ backgroundColor: o }), r && t("body").addClass("fancybox-blur");
                            },
                            afterShow: function (e) {
                                var s = t(e.current.$slide),
                                    a = void 0 !== e.group[e.prevPos] && t(e.group[e.prevPos].$slide) ? t(e.group[e.prevPos].$slide) : null,
                                    n = e.current.opts.$orig[0].dataset.hsFancyboxOptions ? JSON.parse(e.current.opts.$orig[0].dataset.hsFancyboxOptions) : {},
                                    i = !!n.transitionEffectCustom && n.transitionEffectCustom;
                                i &&
                                    (s.css("visibility", "visible"),
                                    s.hasClass("animated") || s.addClass("animated"),
                                    a && !a.hasClass("animated") && a.addClass("animated"),
                                    t("body").hasClass("fancybox-opened")
                                        ? (s.addClass(i.onShow),
                                          s.on("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function (t) {
                                              s.removeClass(i.onShow);
                                          }),
                                          a &&
                                              (a.addClass(i.onHide),
                                              a.on("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function (t) {
                                                  a.removeClass(i.onHide);
                                              })))
                                        : (s.addClass(i.onShow),
                                          s.on("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function (e) {
                                              s.removeClass(i.onShow), t("body").addClass("fancybox-opened");
                                          })));
                            },
                            beforeClose: function (e) {
                                var s = t(e.current.$slide),
                                    a = e.current.opts.$orig[0].dataset.hsFancyboxOptions ? JSON.parse(e.current.opts.$orig[0].dataset.hsFancyboxOptions) : {},
                                    n = !!a.transitionEffectCustom && a.transitionEffectCustom;
                                a.overlayBlurBg;
                                n && (s.removeClass(n.onShow).addClass(n.onHide), t("body").removeClass("fancybox-opened")), t("body").removeClass("fancybox-blur");
                            },
                        };
                    return (o = t.extend(!0, n, o, i, s)), t(e).fancybox(o);
                }
            },
        };
    })(jQuery),
    (function (t) {
        t.HSCore.components.HSFlatpickr = {
            defaults: {
                mode: "single",
                dateFormat: "d M Y",
                maxDate: !1,
                locale: { firstDayOfWeek: 1, weekdays: { shorthand: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"] }, rangeSeparator: " - " },
                nextArrow: '<i class="tio-chevron-right flatpickr-custom-arrow"></i>',
                prevArrow: '<i class="tio-chevron-left flatpickr-custom-arrow"></i>',
                disableMobile: !0,
            },
            init: function (e, s) {
                if (e.length) {
                    var a = Object.assign({}, this.defaults),
                        n = e.attr("data-hs-flatpickr-options") ? JSON.parse(e.attr("data-hs-flatpickr-options")) : {},
                        i = {};
                    i = t.extend(!0, a, i, n, { appendTo: n ? t(n.appendTo)[0] : this }, s);
                    var o = e.flatpickr(i);
                    return e.css({ width: 7.5 * e.val().length }), o;
                }
            },
        };
    })(jQuery),
    (function (t) {
        t.HSCore.components.HSFullcalendar = {
            defaults: { contentHeight: "auto", dayMaxEventRows: 2 },
            init: function (e, s) {
                if (e.length) {
                    var a = Object.assign({}, this.defaults),
                        n = e.attr("data-hs-fullcalendar-options") ? JSON.parse(e.attr("data-hs-fullcalendar-options")) : {},
                        i = {};
                    i = t.extend(!0, a, i, n, s);
                    var o = new FullCalendar.Calendar(e[0], i);
                    return o.render(), o;
                }
            },
        };
    })(jQuery),
    (function (t) {
        t.HSCore.components.HSIonRangeSlider = {
            defaults: {
                type: "single",
                hide_min_max: !0,
                hide_from_to: !0,
                foreground_target_el: null,
                secondary_target_el: null,
                secondary_val: { steps: null, values: null },
                result_min_target_el: null,
                result_max_target_el: null,
                cusOnChange: null,
            },
            init: function (e, s) {
                if (e.length && void 0 !== e.attr("data-hs-ion-range-slider-options")) {
                    var a = Object.assign({}, this.defaults),
                        n = e.attr("data-hs-ion-range-slider-options") ? JSON.parse(e.attr("data-hs-ion-range-slider-options")) : {},
                        i = {
                            onStart: function (e) {
                                if (i.foreground_target_el) {
                                    var s = 100 - (e.from_percent + (100 - e.to_percent));
                                    t(i.foreground_target_el).css({ left: e.from_percent + "%", width: s + "%" }),
                                        t(i.foreground_target_el + " > *").css({ width: t(i.foreground_target_el).parent().width(), transform: "translateX(-" + e.from_percent + "%)" });
                                }
                                if (
                                    (i.result_min_target_el && "single" === i.type
                                        ? t(i.result_min_target_el).is("input")
                                            ? t(i.result_min_target_el).val(e.from)
                                            : t(i.result_min_target_el).text(e.from)
                                        : (i.result_min_target_el || (i.result_max_target_el && "double" === i.type)) &&
                                          (t(i.result_min_target_el).is("input") ? t(i.result_min_target_el).val(e.from) : t(i.result_min_target_el).text(e.from),
                                          t(i.result_min_target_el).is("input") ? t(i.result_max_target_el).val(e.to) : t(i.result_max_target_el).text(e.to)),
                                    i.grid &&
                                        "single" === i.type &&
                                        t(e.slider)
                                            .find(".irs-grid-text")
                                            .each(function (s) {
                                                var a = t(this);
                                                t(a).text() === e.from && (t(e.slider).find(".irs-grid-text").removeClass("current"), t(a).addClass("current"));
                                            }),
                                    i.secondary_target_el)
                                ) {
                                    i.secondary_val.steps.push(e.max + 1), i.secondary_val.values.push(i.secondary_val.values[i.secondary_val.values.length - 1] + 1);
                                    for (var a = 0; a < i.secondary_val.steps.length; a++)
                                        e.from >= i.secondary_val.steps[a] &&
                                            e.from < i.secondary_val.steps[a + 1] &&
                                            (t(i.secondary_target_el).is("input") ? t(i.secondary_target_el).val(i.secondary_val.values[a]) : t(i.secondary_target_el).text(i.secondary_val.values[a]));
                                }
                            },
                            onChange: function (e) {
                                if (i.foreground_target_el) {
                                    var a = 100 - (e.from_percent + (100 - e.to_percent));
                                    t(i.foreground_target_el).css({ left: e.from_percent + "%", width: a + "%" }),
                                        t(i.foreground_target_el + "> *").css({ width: t(i.foreground_target_el).parent().width(), transform: "translateX(-" + e.from_percent + "%)" });
                                }
                                if (
                                    (i.result_min_target_el && "single" === i.type
                                        ? t(i.result_min_target_el).is("input")
                                            ? t(i.result_min_target_el).val(e.from)
                                            : t(i.result_min_target_el).text(e.from)
                                        : (i.result_min_target_el || (i.result_max_target_el && "double" === i.type)) &&
                                          (t(i.result_min_target_el).is("input") ? t(i.result_min_target_el).val(e.from) : t(i.result_min_target_el).text(e.from),
                                          t(i.result_min_target_el).is("input") ? t(i.result_max_target_el).val(e.to) : t(i.result_max_target_el).text(e.to)),
                                    i.grid &&
                                        "single" === i.type &&
                                        t(e.slider)
                                            .find(".irs-grid-text")
                                            .each(function (s) {
                                                var a = t(this);
                                                t(a).text() === e.from && (t(e.slider).find(".irs-grid-text").removeClass("current"), t(a).addClass("current"));
                                            }),
                                    i.secondary_target_el)
                                )
                                    for (var n = 0; n < i.secondary_val.steps.length; n++)
                                        e.from >= i.secondary_val.steps[n] &&
                                            e.from < i.secondary_val.steps[n + 1] &&
                                            (t(i.secondary_target_el).is("input") ? t(i.secondary_target_el).val(i.secondary_val.values[n]) : t(i.secondary_target_el).text(i.secondary_val.values[n]));
                                s && s.cusOnChange && "function" == typeof s.cusOnChange && s.cusOnChange();
                            },
                        };
                    i = t.extend(!0, a, i, n, s);
                    var o = e.ionRangeSlider(i),
                        r = e.data("ionRangeSlider");
                    return (
                        i.result_min_target_el && "single" === i.type && t(i.result_min_target_el).is("input")
                            ? t(i.result_min_target_el).on("change", function () {
                                  r.update({ from: t(this).val() });
                              })
                            : (i.result_min_target_el || (i.result_max_target_el && "double" === i.type && t(i.result_min_target_el).is("input")) || t(i.result_max_target_el).is("input")) &&
                              (t(i.result_min_target_el).on("change", function () {
                                  r.update({ from: t(this).val() });
                              }),
                              t(i.result_max_target_el).on("change", function () {
                                  r.update({ to: t(this).val() });
                              })),
                        t(window).on("resize", function () {
                            t(i.foreground_target_el + " > *").css({ width: t(i.foreground_target_el).parent().width() });
                        }),
                        o
                    );
                }
            },
        };
    })(jQuery),
    (function (t) {
        t.HSCore.components.HSJVectorMap = {
            defaults: { map: "world_mill_en", zoomOnScroll: !1 },
            init: function (e, s) {
                if (e.length) {
                    var a = Object.assign({}, this.defaults),
                        n = e.attr("data-hs-jvector-map-options") ? JSON.parse(e.attr("data-hs-jvector-map-options")) : {},
                        i = {};
                    (i = t.extend(!0, a, n, i, s)).container = e;
                    var o = new jvm.Map(i);
                    return i.tipCentered ? this.tipCentered(o.tip) : this.fixTipPosition(o.tip), o;
                }
            },
            tipCentered: function (e) {
                t(".jvectormap-container").mousemove(function (t) {
                    var s = e.offset().top - 7,
                        a = t.clientX - e.width() / 2;
                    e.addClass("jvectormap-tip-cntered"), e.css({ top: s, left: a });
                });
            },
            fixTipPosition: function (e) {
                t(".jvectormap-container").mousemove(function (t) {
                    var s = e.offset().left;
                    e.css({ left: s });
                });
            },
        };
    })(jQuery),
    (function (t) {
        t.HSCore.components.HSLeaflet = {
            defaults: {
                map: { coords: [51.505, -0.09], zoom: 13 },
                layer: { token: "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw", id: "mapbox/streets-v11", maxZoom: 18 },
                marker: null,
            },
            init: function (e, s) {
                if (t(e).length) {
                    var a = t(e),
                        n = a.attr("data-hs-leaflet-options") ? JSON.parse(a.attr("data-hs-leaflet-options")) : {},
                        i = {};
                    i = t.extend(!0, this.defaults, n, i, s);
                    var o = L.map(e, i.map);
                    if ((o.setView(i.map.coords, i.map.zoom), L.tileLayer(i.layer.token, i.layer).addTo(o), i.marker))
                        for (var r = 0; r < i.marker.length; r++) {
                            i.marker[r].icon = L.icon(i.marker[r].icon);
                            let t = L.marker(i.marker[r].coords, i.marker[r]).addTo(o);
                            i.marker[r].popup && t.bindPopup(i.marker[r].popup.text);
                        }
                    return o;
                }
            },
        };
    })(jQuery),
    (function (t) {
        t.HSCore.components.HSList = {
            defaults: { searchMenu: !1, searchMenuDelay: 300, searchMenuOutsideClose: !0, searchMenuInsideClose: !0, clearSearchInput: !0, keyboard: !1, empty: !1 },
            init: function (e, s) {
                if (t(e).length) {
                    var a = this,
                        n = t(e),
                        i = Object.assign({}, a.defaults),
                        o = n.attr("data-hs-list-options") ? JSON.parse(n.attr("data-hs-list-options")) : {},
                        r = {};
                    r = t.extend(!0, i, r, o, s);
                    var l = new List(n.attr("id"), r, r.values);
                    return (
                        r.searchMenu && t(l.list).fadeOut(0),
                        l.on("searchComplete", function () {
                            r.searchMenu && (a.searchMenu(n, r, l), a.searchMenuHide(n, r, l)), !r.searchMenu && r.empty && a.emptyBlock(n, r, l);
                        }),
                        r.searchMenu && r.keyboard && a.initializeHover(n, r, l),
                        l
                    );
                }
            },
            initializeHover: function (e, s, a) {
                var n,
                    i = a,
                    o = (t(i.list).find(".list-group-item"), e.find("." + i.searchClass));
                t(o).keydown(function (e) {
                    if (40 === e.which) {
                        if ((e.preventDefault(), 0 == t(i.list).children(".active").length)) n = t(i.list).children().first().addClass("active");
                        else if (t(i.list).children(".active").next().length) {
                            var s = t(i.list).children(".active").next().addClass("active");
                            t(n).removeClass("active"), (n = s), t(i.list).height() < t(i.list).children(".active").position().top && t(i.list).scrollTop(t(i.list).children(".active").position().top + t(i.list).scrollTop());
                        }
                    } else if (38 === e.which) {
                        if ((e.preventDefault(), 0 == t(i.list).children(".active").length)) n = t(i.list).children().first().parent().addClass("active");
                        else if (t(i.list).children(".active").prev().length) {
                            s = t(i.list).children(".active").prev().addClass("active");
                            t(n).removeClass("active"), (n = s), 0 > t(i.list).children(".active").position().top && t(i.list).scrollTop(t(i.list).children(".active").position().top + t(i.list).scrollTop());
                        }
                    } else 13 == e.which && o.val().length > 0 && (e.preventDefault(), window.location.replace(t(n).find("a").first().attr("href")));
                });
            },
            searchMenu: function (e, s, a) {
                var n = s,
                    i = a;
                if (0 === e.find("." + i.searchClass).val().length || (0 === i.visibleItems.length && !n.empty)) t(n.empty).fadeOut(0), t(i.list).fadeOut(n.searchMenuDelay);
                else if ((t(i.list).fadeIn(n.searchMenuDelay), !i.visibleItems.length)) {
                    var o = t(n.empty).clone();
                    t(i.list).html(o), t(o).fadeIn(0);
                }
            },
            searchMenuHide: function (e, s, a) {
                var n = s,
                    i = a,
                    o = e.find("." + i.searchClass);
                n.searchMenuOutsideClose &&
                    t(window).click(function () {
                        t(i.list).fadeOut(n.searchMenuDelay), n.clearSearchInput && o.val("");
                    }),
                    n.searchMenuInsideClose ||
                        t(i.list).click(function (t) {
                            t.stopPropagation(), n.clearSearchInput && o.val("");
                        });
            },
            emptyBlock: function (e, s, a) {
                var n = s,
                    i = a;
                if (0 === e.find("." + i.searchClass).val().length || (0 === i.visibleItems.length && !n.empty)) t(n.empty).fadeOut(0);
                else if ((t(i.list).fadeIn(n.searchMenuDelay), !i.visibleItems.length)) {
                    var o = t(n.empty).clone();
                    t(i.list).html(o), t(o).fadeIn(0);
                }
            },
        };
    })(jQuery),
    (function (t) {
        t.HSCore.components.HSMask = {
            defaults: { template: null },
            init: function (e, s) {
                if (e.length && void 0 !== e.attr("data-hs-mask-options")) {
                    var a = Object.assign({}, this.defaults),
                        n = e.attr("data-hs-mask-options") ? JSON.parse(e.attr("data-hs-mask-options")) : {},
                        i = {};
                    return (i = t.extend(!0, a, i, n, s)), e.mask(i.template, i);
                }
            },
        };
    })(jQuery),
    (function (t) {
        t.HSCore.components.HSPWStrength = {
            defaults: { ui: { verdicts: ["Very Weak", "Weak", "Normal", "Medium", "Strong", "Very Strong"], container: !1, viewports: { progress: !1, verdict: !1 }, progressExtraCssClasses: !1 } },
            init: function (e, s) {
                if (e.length) {
                    var a = Object.assign({}, this.defaults),
                        n = e.attr("data-hs-pwstrength-options") ? JSON.parse(e.attr("data-hs-pwstrength-options")) : {},
                        i = {};
                    return (i = t.extend(!0, a, i, n, s)), e.pwstrength(i);
                }
            },
            methods: function (e) {
                var s = Array.prototype.slice.call(arguments, 1);
                t.fn.pwstrength.apply(e, s);
            },
        };
    })(jQuery),
    (function (t) {
        t.HSCore.components.HSQuill = {
            __proto__: t.fn.quill,
            defaults: { theme: "snow", attach: !1 },
            init: function (e, s) {
                if (t(e).length) {
                    var a = t(e),
                        n = Object.assign({}, this.defaults),
                        i = a.attr("data-hs-quill-options") ? JSON.parse(a.attr("data-hs-quill-options")) : {},
                        o = {};
                    o = Object.assign({}, n, o, i, s);
                    var r = new Quill(e, o);
                    return this.toolbarBottom(r, o), r;
                }
            },
            toolbarBottom: function (e, s) {
                if (s.toolbarBottom) {
                    let a = t(e.container),
                        n = t(e.container).prev(".ql-toolbar");
                    a.parent().addClass("ql-toolbar-bottom"),
                        s.attach
                            ? t(s.attach).on("shown.bs.modal", function (t) {
                                  a.css({ paddingBottom: n.innerHeight() });
                              })
                            : a.css({ paddingBottom: n.innerHeight() }),
                        n.css({ position: "absolute", width: "100%", bottom: 0 });
                }
            },
        };
    })(jQuery),
    (function (t) {
        t.HSCore.components.HSSelect2 = {
            defaults: { data: [], width: "100%", customClass: "custom-select", searchInputPlaceholder: !1, singleMultiple: !1, singleMultipleActiveClass: "active", singleMultiplePostfix: " item(s) selected", singleMultiplePrefix: null },
            init: function (e, s) {
                if (e.length) {
                    var a = this,
                        n = Object.assign({}, a.defaults),
                        i = e.attr("data-hs-select2-options") ? JSON.parse(e.attr("data-hs-select2-options")) : {},
                        o = {
                            templateResult: a.formatData,
                            templateSelection: a.formatData,
                            escapeMarkup: function (t) {
                                return t;
                            },
                        };
                    o = t.extend(!0, n, o, i, s);
                    var r = e.select2(o);
                    return (
                        e.siblings(".select2").find(".select2-selection").removeClass("select2-selection--single").addClass(o.customClass),
                        o.singleMultiple &&
                            (a.singleMultiple(e, o),
                            r.on("select2:select", function (t) {
                                a.singleMultiple(e, o);
                            }),
                            r.on("select2:unselect", function (t) {
                                a.singleMultiple(e, o);
                            })),
                        a.safariAutoWidth(r, o),
                        a.leftOffset(r, o),
                        a.dropdownWidth(r, o),
                        o.searchInputPlaceholder && a.searchPlaceholder(r, o),
                        r
                    );
                }
            },
            dropdownWidth: function (e, s) {
                var a = s;
                e.on("select2:open", function () {
                    t(".select2-container--open").last().css({ width: a.dropdownWidth });
                });
            },
            safariAutoWidth: function (e, s) {
                e.on("select2:open", function () {
                    t(".select2-container--open").css({ top: 0 });
                });
            },
            singleMultiple: function (e, s) {
                var a = s;
                let n = t(e).next(".select2").find(".select2-selection"),
                    i = e.find(":selected").length > 0 ? a.singleMultiplePrefix + e.find(":selected").length + a.singleMultiplePostfix : a.placeholder;
                n.removeClass("select2-selection--multiple"),
                    e.find(":selected").length > 0 ? n.addClass(a.singleMultipleActiveClass) : n.removeClass(a.singleMultipleActiveClass),
                    n
                        .find(".select2-selection__rendered")
                        .replaceWith(
                            '<span class="select2-selection__rendered" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">' +
                                i +
                                '</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>'
                        );
            },
            formatData: function (e) {
                var s,
                    a = e;
                return a.element ? ((s = a.element.dataset.optionTemplate ? a.element.dataset.optionTemplate : "<span>" + a.text + "</span>"), t.parseHTML(s)) : a.text;
            },
            leftOffset: function (e, s) {
                var a = s;
                e.on("select2:open", function () {
                    if (a.leftOffset) {
                        let e = t(".select2-container--open").last();
                        e.css({ opacity: 0 }),
                            setTimeout(function () {
                                e.css({ left: parseInt(e.position().left) + a.leftOffset, opacity: 1 });
                            }, 1);
                    }
                });
            },
            searchPlaceholder: function (e, s) {
                var a = s;
                e.on("select2:open", function () {
                    t(".select2-container--open .select2-search__field").last().attr("placeholder", a.searchInputPlaceholder);
                });
            },
        };
    })(jQuery),
    (function (t) {
        t.HSCore.components.HSSlickCarousel = {
            defaults: {
                infinite: !1,
                pauseOnHover: !1,
                centerPadding: 0,
                lazyLoad: !1,
                prevArrow: null,
                nextArrow: null,
                autoplaySpeed: 3e3,
                speed: 300,
                initialDelay: 600,
                isThumbs: !1,
                isThumbsProgressCircle: !1,
                thumbsProgressContainer: null,
                thumbsProgressOptions: { color: "#000", width: 4 },
                animationIn: null,
                animationOut: null,
                dotsWithIcon: null,
                dotsFromTitles: null,
                dotsAsProgressLine: !1,
                hasDotsHelper: !1,
                counterSelector: null,
                counterDivider: "/",
                counterClassMap: { current: "slick-counter-current", total: "slick-counter-total", divider: "slick-counter-divider" },
            },
            init: function (e, s) {
                if (e.length) {
                    var a = this,
                        n = Object.assign({}, a.defaults),
                        i = e.attr("data-hs-slick-carousel-options") ? JSON.parse(e.attr("data-hs-slick-carousel-options")) : {},
                        o = { id: e.attr("id") };
                    (o = t.extend(n, o, i)),
                        (o = t.extend(
                            o,
                            {
                                customPaging: function (e, s) {
                                    var a = t(e.$slides[s]).data("hs-slick-carousel-slide-title");
                                    return a && o.dotsWithIcon
                                        ? "<span>" + a + "</span>" + o.dotsWithIcon
                                        : o.dotsWithIcon
                                        ? "<span></span>" + o.dotsWithIcon
                                        : a && o.dotsFromTitles
                                        ? "<span>" + a + "</span>"
                                        : a && !o.dotsFromTitles
                                        ? '<span></span><strong class="dot-title">' + a + "</strong>"
                                        : "<span></span>";
                                },
                            },
                            s
                        )),
                        e.find("[data-slide-type]").length && a.videoSupport(e),
                        e.on("init", function (t, s) {
                            a.transformOff(e, o, t, s);
                        }),
                        e.on("init", function (t, e) {
                            a.setCustomAnimation(t, e);
                        }),
                        o.animationIn &&
                            o.animationOut &&
                            e.on("init", function (t, e) {
                                a.setSingleClass(t, e);
                            }),
                        o.dotsAsProgressLine &&
                            e.on("init", function () {
                                a.setCustomLineDots(e, o);
                            }),
                        o.hasDotsHelper &&
                            e.on("init", function (t, e, s) {
                                a.setCustomDots(t, e, s);
                            }),
                        o.isThumbs &&
                            (o.isThumbsProgressCircle &&
                                e.on("init", function (t, s) {
                                    a.setCustomProgressCircle(e, o, t, s);
                                }),
                            t("#" + o.id).on("click", ".slick-slide", function (e) {
                                e.stopPropagation(), a.goToTargetSlide(t(this), o);
                            })),
                        e.on("init", function (t, s) {
                            a.setCustomCurrentClass(e, t, s);
                        }),
                        e.on("init", function (t, e) {
                            a.setInitialCustomAnimation(t, e);
                        }),
                        o.counterSelector &&
                            e.on("init", function (t, e) {
                                a.setCounter(o, t, e);
                            });
                    var r = e.slick(o);
                    return (
                        t(o.asNavFor)[0] && t(o.asNavFor)[0].dataset.hsSlickCarouselOptions && JSON.parse(t(o.asNavFor)[0].dataset.hsSlickCarouselOptions).isThumbsProgress && a.setInitialDelay(e, o),
                        e.on("beforeChange", function (t, s, n, i) {
                            a.setCustomClasses(e, t, s, n, i);
                        }),
                        o.counterSelector &&
                            e.on("beforeChange", function (t, e, s, n) {
                                a.counting(o, t, e, s, n);
                            }),
                        e.on("afterChange", function (t, e) {
                            a.setCustomAnimation(t, e);
                        }),
                        o.animationIn &&
                            o.animationOut &&
                            (e.on("afterChange", function (t, e, s, n) {
                                a.animationIn(o, t, e, s, n);
                            }),
                            e.on("beforeChange", function (t, e, s) {
                                a.animationOut(o, t, e, s);
                            }),
                            e.on("setPosition", function (t, e) {
                                a.setPosition(o, t, e);
                            })),
                        r
                    );
                }
            },
            transformOff: function (e, s, a, n) {
                var i = s;
                t(n.$slides).css("height", "auto"), i.isThumbs && i.slidesToShow >= t(n.$slides).length && e.addClass("slick-transform-off");
            },
            setCustomAnimation: function (e, s) {
                var a = t(s.$slides)[s.currentSlide],
                    n = t(a).find("[data-hs-slick-carousel-animation]");
                t(n).each(function () {
                    var e = t(this).data("hs-slick-carousel-animation"),
                        s = t(this).data("hs-slick-carousel-animation-delay"),
                        a = t(this).data("hs-slick-carousel-animation-duration");
                    t(this).css({ "animation-delay": s + "ms", "animation-duration": a + "ms" }),
                        t(this)
                            .addClass("animated " + e)
                            .css({ opacity: 1 });
                });
            },
            setInitialCustomAnimation: function (e, s) {
                var a = t(s.$slides)[0],
                    n = t(a).find("[data-hs-slick-carousel-animation]");
                t(n).each(function () {
                    var e = t(this).data("hs-slick-carousel-animation");
                    t(this)
                        .addClass("animated " + e)
                        .css("opacity", 1);
                });
            },
            setSingleClass: function (e, s) {
                t(s.$slides).addClass("single-slide");
            },
            setCustomDots: function (t) {
                var e = t.find(".js-dots");
                e.length && e.append('<span class="dots-helper"></span>');
            },
            setCustomLineDots: function (e, s) {
                var a = e.find('[class="' + s.dotsClass + '"]'),
                    n = a.find("li");
                a.length &&
                    (setTimeout(function () {
                        e.addClass("slick-line-dots-ready");
                    }),
                    n.each(function () {
                        t(this).append('<span class="dot-line"><span class="dot-line-helper" style="transition-duration: ' + (s.autoplaySpeed + s.speed) + 'ms;"></span></span>');
                    }));
            },
            setCustomProgressCircle: function (e, s, a, n) {
                var i = s,
                    o = 0,
                    r = t('<style type="text/css"></style>');
                t(n.$slides).each(function (e) {
                    var s = t(
                            '<span class="slick-thumb-progress"><svg version="1.1" viewBox="0 0 160 160"><path class="slick-thumb-progress__path" d="M 79.98452083651917 4.000001576345426 A 76 76 0 1 1 79.89443752470656 4.0000733121155605 Z"></path></svg></span>'
                        ),
                        a = s.find("svg path");
                    (o = parseInt(a[0].getTotalLength())), t(n.$slides[e]).children(i.thumbsProgressContainer).append(s);
                }),
                    r.text(
                        ".slick-thumb-progress .slick-thumb-progress__path {opacity: 0;fill: transparent;stroke: " +
                            i.thumbsProgressOptions.color +
                            ";stroke-width: " +
                            i.thumbsProgressOptions.width +
                            ";stroke-dashoffset: " +
                            o +
                            ";stroke-dashoffset: 0px;}.slick-current .slick-thumb-progress .slick-thumb-progress__path {opacity: 1;-webkit-animation: " +
                            (n.options.autoplaySpeed + n.options.speed) +
                            "ms linear 0ms forwards dash;-moz-animation: " +
                            (n.options.autoplaySpeed + n.options.speed) +
                            "ms linear 0ms forwards dash;-o-animation: " +
                            (n.options.autoplaySpeed + n.options.speed) +
                            "ms linear 0ms forwards dash;animation: " +
                            (n.options.autoplaySpeed + n.options.speed) +
                            "ms linear 0ms forwards dash;}@-webkit-keyframes dash {from {stroke-dasharray: 0 " +
                            o +
                            ";} to {stroke-dasharray: " +
                            o +
                            " " +
                            o +
                            ";}}@-moz-keyframes dash {from {stroke-dasharray: 0 " +
                            o +
                            ";} to {stroke-dasharray: " +
                            o +
                            " " +
                            o +
                            ";}}@-moz-keyframes dash {from {stroke-dasharray: 0 " +
                            o +
                            ";} to {stroke-dasharray: " +
                            o +
                            " " +
                            o +
                            ";}}@keyframes dash {from {stroke-dasharray: 0 " +
                            o +
                            ";} to {stroke-dasharray: " +
                            o +
                            " " +
                            o +
                            ";}}"
                    ),
                    r.appendTo(e);
            },
            goToTargetSlide: function (e, s) {
                var a = s,
                    n = e.data("slick-index");
                t("#" + a.id).slick("slickCurrentSlide") !== n && t("#" + a.id).slick("slickGoTo", n);
            },
            setCustomCurrentClass: function (e) {
                var s = e.find(".js-dots");
                s.length && t(s[0].children[0]).addClass("slick-current");
            },
            setCounter: function (e, s, a) {
                var n = e;
                t(n.counterSelector).html(
                    '<span class="' + n.counterClassMap.current + '">1</span><span class="' + n.counterClassMap.divider + '">' + n.counterDivider + '</span><span class="' + n.counterClassMap.total + '">' + a.slideCount + "</span>"
                );
            },
            setInitialDelay: function (t, e) {
                var s = e;
                t.slick("slickPause"),
                    setTimeout(function () {
                        t.slick("slickPlay");
                    }, s.initialDelay);
            },
            setCustomClasses: function (e, s, a, n, i) {
                var o = t(a.$slides)[i],
                    r = t(a.$slides)[n],
                    l = e.find(".js-dots"),
                    c = t(o).find("[data-hs-slick-carousel-animation]"),
                    d = t(r).find("[data-hs-slick-carousel-animation]");
                t(d).each(function () {
                    var e = t(this).data("hs-slick-carousel-animation");
                    t(this).removeClass("animated " + e);
                }),
                    t(c).each(function () {
                        t(this).css({ opacity: 0 });
                    }),
                    l.length &&
                        (n > i ? (t(l[0].children).removeClass("slick-active-right"), t(l[0].children[i]).addClass("slick-active-right")) : t(l[0].children).removeClass("slick-active-right"),
                        t(l[0].children).removeClass("slick-current"),
                        setTimeout(function () {
                            t(l[0].children[i]).addClass("slick-current");
                        }, 0.25));
            },
            animationIn: function (e, s, a, n, i) {
                var o = e;
                t(a.$slides).removeClass("animated set-position " + o.animationIn + " " + o.animationOut);
            },
            animationOut: function (e, s, a, n) {
                var i = e;
                t(a.$slides[n]).addClass("animated " + i.animationOut);
            },
            setPosition: function (e, s, a) {
                var n = e;
                t(a.$slides[a.currentSlide]).addClass("animated set-position " + n.animationIn);
            },
            counting: function (e, s, a, n, i) {
                var o = e,
                    r = (i || 0) + 1;
                t(o.counterSelector).html(
                    '<span class="' + o.counterClassMap.current + '">' + r + '</span><span class="' + o.counterClassMap.divider + '">' + o.counterDivider + '</span><span class="' + o.counterClassMap.total + '">' + a.slideCount + "</span>"
                );
            },
            videoSupport: function (e) {
                e.length &&
                    e.on("beforeChange", function (e, s, a, n) {
                        var i,
                            o = t(s.$slides[a]).data("slide-type"),
                            r = t(s.$slides[a]).find("iframe").get(0);
                        if ("vimeo" === o) i = { method: "pause", value: "true" };
                        else {
                            if ("youtube" !== o) return !1;
                            i = { event: "command", func: "pauseVideo" };
                        }
                        void 0 !== r && r.contentWindow.postMessage(JSON.stringify(i), "*");
                    });
            },
            initTextAnimation: function (e, s) {
                if (window.TextFx && window.anime && e.length) {
                    var a = e.find(s);
                    a.length &&
                        (a.each(function (e, s) {
                            var a = t(s);
                            a.data("TextFx") || a.data("TextFx", new TextFx(a.get(0)));
                        }),
                        e.on("beforeChange", function (t, e, a, n) {
                            var i = e.$slider.find(".slick-track").children(),
                                o = i.eq(a),
                                r = i.eq(n);
                            (o = o.find(s)), (r = r.find(s)), o.length && o.data("TextFx").hide(o.data("effect") ? o.data("effect") : "fx1"), r.length && r.data("TextFx").show(r.data("effect") ? r.data("effect") : "fx1");
                        }));
                }
            },
        };
    })(jQuery),
    (function (t) {
        t.HSCore.components.HSSortable = {
            defaults: {},
            init: function (e, s) {
                if (e.length) {
                    var a = Object.assign({}, this.defaults),
                        n = e.attr("data-hs-sortable-options") ? JSON.parse(e.attr("data-hs-sortable-options")) : {},
                        i = {};
                    return (i = t.extend(!0, a, i, n, s)), new Sortable(e[0], i);
                }
            },
        };
    })(jQuery),
    (function (t) {
        t.HSCore.components.HSTagify = {
            defaults: { clearBtnSelector: null, hasManualList: !1 },
            init: function (e, s) {
                if (e.length) {
                    var a = Object.assign({}, this.defaults),
                        n = e.attr("data-hs-tagify-options") ? JSON.parse(e.attr("data-hs-tagify-options")) : {},
                        i = {};
                    i = t.extend(!0, a, i, n, s);
                    var o = new Tagify(e[0], i);
                    return (
                        t(i.clearBtnSelector).on("click", o.removeAllTags.bind(o)),
                        i.hasManualList &&
                            (this._renderSuggestionsList(e, o),
                            e.on("add", function () {
                                1 === o.suggestedListItems.length && t(o.DOM.dropdown).empty().fadeOut(0);
                            }),
                            e.on("remove", function () {
                                0 === o.suggestedListItems.length && t(o.DOM.dropdown).fadeIn(0);
                            })),
                        o
                    );
                }
            },
            _renderSuggestionsList: function (t, e) {
                e.dropdown.show.call(e), t.parent()[0].appendChild(e.DOM.dropdown);
            },
        };
    })(jQuery),
    (function (t) {
        t.HSCore.components.HSValidation = {
            defaults: { errorElement: "div", errorClass: "invalid-feedback" },
            init: function (e, s) {
                if (e.length) {
                    var a = Object.assign({}, this.defaults),
                        n = e.attr("data-hs-validation-options") ? JSON.parse(e.attr("data-hs-validation-options")) : {},
                        i = {
                            errorPlacement: this.errorPlacement,
                            highlight: this.highlight,
                            unhighlight: this.unHighlight,
                            submitHandler: this.submitHandler,
                            onkeyup: function (e) {
                                t(e).valid();
                            },
                        };
                    (i = t.extend(!0, a, i, n, s)), e.hasClass("js-step-form") ? t.validator.setDefaults({ ignore: ":hidden:not(.active select)" }) : t.validator.setDefaults({ ignore: ":hidden:not(select)" });
                    var o = e.validate(i);
                    return (
                        e.find("select").length &&
                            e.find("select").change(function () {
                                t(this).valid();
                            }),
                        o
                    );
                }
            },
            rules: function (e) {
                var s = Array.prototype.slice.call(arguments, 1);
                t.fn.rules.apply(e, s);
            },
            errorPlacement: function (e, s) {
                var a = t(s).data("error-msg-classes");
                e.addClass(a), e.appendTo(s.parents(".js-form-message"));
            },
            highlight: function (e) {
                var s = t(e),
                    a = s.data("error-class") ? s.data("error-class") : "is-invalid",
                    n = s.data("success-class") ? s.data("error-class") : "is-valid",
                    i = s.parents(".js-form-message").first(),
                    o = s;
                void 0 !== i.data("validate-state") ? (o = i) : i.find("[data-validate-state]").length && (o = i.find("[data-validate-state]")), o.removeClass(n).addClass(a);
            },
            unHighlight: function (e) {
                var s = t(e),
                    a = s.data("error-class") ? s.data("error-class") : "is-invalid",
                    n = s.data("success-class") ? s.data("error-class") : "is-valid",
                    i = s.parents(".js-form-message").first(),
                    o = s;
                void 0 !== i.data("validate-state") ? (o = i) : i.find("[data-validate-state]").length && (o = i.find("[data-validate-state]")), o.removeClass(a).addClass(n);
            },
            submitHandler: function (t) {
                t.submit();
            },
        };
    })(jQuery);
