/**
 * @license Highcharts JS v5.0.4 (2016-11-25)
 *
 * (c) 2009-2016 Torstein Honsi
 *
 * License: www.highcharts.com/license
 */
(function(factory) {
    if (typeof module === 'object' && module.exports) {
        module.exports = factory;
    } else {
        factory(Highcharts);
    }
}(function(Highcharts) {
    (function(H) {
        /**
         * (c) 2009-2016 Torstein Honsi
         *
         * License: www.highcharts.com/license
         */

        var defined = H.defined,
            isNumber = H.isNumber,
            inArray = H.inArray,
            isArray = H.isArray,
            merge = H.merge,
            Chart = H.Chart,
            extend = H.extend,
            each = H.each;

        var ALIGN_FACTOR,
            ALLOWED_SHAPES;

        ALLOWED_SHAPES = ['path', 'rect', 'circle'];

        ALIGN_FACTOR = {
            top: 0,
            left: 0,
            center: 0.5,
            middle: 0.5,
            bottom: 1,
            right: 1
        };

        function defaultOptions(shapeType) {
            var shapeOptions,
                options;

            options = {
                xAxis: 0,
                yAxis: 0,
                title: {
                    style: {},
                    text: '',
                    x: 0,
                    y: 0
                },
                shape: {
                    params: {
                        stroke: '#000000',
                        fill: 'transparent',
                        strokeWidth: 2
                    }
                }
            };

            shapeOptions = {
                circle: {
                    params: {
                        x: 0,
                        y: 0
                    }
                }
            };

            if (shapeOptions[shapeType]) {
                options.shape = merge(options.shape, shapeOptions[shapeType]);
            }

            return options;
        }

        function translatePath(d, xAxis, yAxis, xOffset, yOffset) {
            var len = d.length,
                i = 0;

            while (i < len) {
                if (isNumber(d[i]) && isNumber(d[i + 1])) {
                    d[i] = xAxis.toPixels(d[i]) - xOffset;
                    d[i + 1] = yAxis.toPixels(d[i + 1]) - yOffset;
                    i += 2;
                } else {
                    i += 1;
                }
            }

            return d;
        }


        // Define annotation prototype
        var Annotation = function() {
            this.init.apply(this, arguments);
        };
        Annotation.prototype = {
            /* 
             * Initialize the annotation
             */
            init: function(chart, options) {
                var shapeType = options.shape && options.shape.type;

                this.chart = chart;
                this.options = merge({}, defaultOptions(shapeType), options);
            },

            /*
             * Render the annotation
             */
            render: function(redraw) {
                var annotation = this,
                    chart = this.chart,
                    renderer = annotation.chart.renderer,
                    group = annotation.group,
                    title = annotation.title,
                    shape = annotation.shape,
                    options = annotation.options,
                    titleOptions = options.title,
                    shapeOptions = options.shape;

                if (!group) {
                    group = annotation.group = renderer.g();
                }


                if (!shape && shapeOptions && inArray(shapeOptions.type, ALLOWED_SHAPES) !== -1) {
                    shape = annotation.shape = renderer[options.shape.type](shapeOptions.params);
                    shape.add(group);
                }

                if (!title && titleOptions) {
                    title = annotation.title = renderer.label(titleOptions);
                    title.add(group);
                }

                group.add(chart.annotations.group);

                // link annotations to point or series
                annotation.linkObjects();

                if (redraw !== false) {
                    annotation.redraw();
                }
            },

            /*
             * Redraw the annotation title or shape after options update
             */
            redraw: function() {
                var options = this.options,
                    chart = this.chart,
                    group = this.group,
                    title = this.title,
                    shape = this.shape,
                    linkedTo = this.linkedObject,
                    xAxis = chart.xAxis[options.xAxis],
                    yAxis = chart.yAxis[options.yAxis],
                    width = options.width,
                    height = options.height,
                    anchorY = ALIGN_FACTOR[options.anchorY],
                    anchorX = ALIGN_FACTOR[options.anchorX],
                    shapeParams,
                    linkType,
                    series,
                    param,
                    bbox,
                    x,
                    y;

                if (linkedTo) {
                    linkType = (linkedTo instanceof H.Point) ? 'point' :
                        (linkedTo instanceof H.Series) ? 'series' : null;

                    if (linkType === 'point') {
                        options.xValue = linkedTo.x;
                        options.yValue = linkedTo.y;
                        series = linkedTo.series;
                    } else if (linkType === 'series') {
                        series = linkedTo;
                    }

                    if (group.visibility !== series.group.visibility) {
                        group.attr({
                            visibility: series.group.visibility
                        });
                    }
                }


                // Based on given options find annotation pixel position
                x = (defined(options.xValue) ? xAxis.toPixels(options.xValue + xAxis.minPointOffset) - xAxis.minPixelPadding : options.x);
                y = defined(options.yValue) ? yAxis.toPixels(options.yValue) : options.y;

                if (!isNumber(x) || !isNumber(y)) {
                    return;
                }


                if (title) {
                    title.attr(options.title);
                    title.css(options.title.style);
                }

                if (shape) {
                    shapeParams = extend({}, options.shape.params);

                    if (options.units === 'values') {
                        for (param in shapeParams) {
                            if (inArray(param, ['width', 'x']) > -1) {
                                shapeParams[param] = xAxis.translate(shapeParams[param]);
                            } else if (inArray(param, ['height', 'y']) > -1) {
                                shapeParams[param] = yAxis.translate(shapeParams[param]);
                            }
                        }

                        if (shapeParams.width) {
                            shapeParams.width -= xAxis.toPixels(0) - xAxis.left;
                        }

                        if (shapeParams.x) {
                            shapeParams.x += xAxis.minPixelPadding;
                        }

                        if (options.shape.type === 'path') {
                            translatePath(shapeParams.d, xAxis, yAxis, x, y);
                        }
                    }

                    // move the center of the circle to shape x/y
                    if (options.shape.type === 'circle') {
                        shapeParams.x += shapeParams.r;
                        shapeParams.y += shapeParams.r;
                    }

                    shape.attr(shapeParams);
                }

                group.bBox = null;

                // If annotation width or height is not defined in options use bounding box size
                if (!isNumber(width)) {
                    bbox = group.getBBox();
                    width = bbox.width;
                }

                if (!isNumber(height)) {
                    // get bbox only if it wasn't set before
                    if (!bbox) {
                        bbox = group.getBBox();
                    }

                    height = bbox.height;
                }

                // Calculate anchor point
                if (!isNumber(anchorX)) {
                    anchorX = ALIGN_FACTOR.center;
                }

                if (!isNumber(anchorY)) {
                    anchorY = ALIGN_FACTOR.center;
                }

                // Translate group according to its dimension and anchor point
                x = x - width * anchorX;
                y = y - height * anchorY;

                if (defined(group.translateX) && defined(group.translateY)) {
                    group.animate({
                        translateX: x,
                        translateY: y
                    });
                } else {
                    group.translate(x, y);
                }
            },

            /*
             * Destroy the annotation
             */
            destroy: function() {
                var annotation = this,
                    chart = this.chart,
                    allItems = chart.annotations.allItems,
                    index = allItems.indexOf(annotation);

                if (index > -1) {
                    allItems.splice(index, 1);
                }

                each(['title', 'shape', 'group'], function(element) {
                    if (annotation[element]) {
                        annotation[element].destroy();
                        annotation[element] = null;
                    }
                });

                annotation.group = annotation.title = annotation.shape = annotation.chart = annotation.options = null;
            },

            /*
             * Update the annotation with a given options
             */
            update: function(options, redraw) {
                extend(this.options, options);

                // update link to point or series
                this.linkObjects();

                this.render(redraw);
            },

            linkObjects: function() {
                var annotation = this,
                    chart = annotation.chart,
                    linkedTo = annotation.linkedObject,
                    linkedId = linkedTo && (linkedTo.id || linkedTo.options.id),
                    options = annotation.options,
                    id = options.linkedTo;

                if (!defined(id)) {
                    annotation.linkedObject = null;
                } else if (!defined(linkedTo) || id !== linkedId) {
                    annotation.linkedObject = chart.get(id);
                }
            }
        };


        // Add annotations methods to chart prototype
        extend(Chart.prototype, {
            annotations: {
                /*
                 * Unified method for adding annotations to the chart
                 */
                add: function(options, redraw) {
                    var annotations = this.allItems,
                        chart = this.chart,
                        item,
                        len;

                    if (!isArray(options)) {
                        options = [options];
                    }

                    len = options.length;

                    while (len--) {
                        item = new Annotation(chart, options[len]);
                        annotations.push(item);
                        item.render(redraw);
                    }
                },

                /**
                 * Redraw all annotations, method used in chart events
                 */
                redraw: function() {
                    each(this.allItems, function(annotation) {
                        annotation.redraw();
                    });
                }
            }
        });


        // Initialize on chart load
        Chart.prototype.callbacks.push(function(chart) {
            var options = chart.options.annotations,
                group;

            group = chart.renderer.g('annotations');
            group.attr({
                zIndex: 7
            });
            group.add();

            // initialize empty array for annotations
            chart.annotations.allItems = [];

            // link chart object to annotations
            chart.annotations.chart = chart;

            // link annotations group element to the chart
            chart.annotations.group = group;

            if (isArray(options) && options.length > 0) {
                chart.annotations.add(chart.options.annotations);
            }

            // update annotations after chart redraw
            H.addEvent(chart, 'redraw', function() {
                chart.annotations.redraw();
            });
        });

    }(Highcharts));
}));
