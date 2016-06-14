define([
    'jquery',
    'ko',
    'uiComponent'
], function ($, ko, Component) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'SR_DeliveryDate/delivery-date-block'
        },
        initialize: function () {
            this._super();
            var disabled = window.checkoutConfig.shipping.delivery_date.disabled;
            var noday = window.checkoutConfig.shipping.delivery_date.noday;
            var disabledDay = disabled.split(",").map(function(item) {
                return parseInt(item, 10);
            });
            
            ko.bindingHandlers.datepicker = {
                init: function (element, valueAccessor, allBindingsAccessor) {
                    var $el = $(element);

                    //initialize datepicker with some optional options
                    if(noday) {
                        var options = {
                            minDate: 0
                        };
                    } else {
                        var options = {
                            minDate: 0,
                            beforeShowDay: function(date) {
                                var day = date.getDay();
                                if(disabledDay.indexOf(day) > -1) {
                                    return [false];
                                } else {
                                    return [true];
                                }
                            }
                        };
                    }

                    $el.datepicker(options);

                    var writable = valueAccessor();
                    if (!ko.isObservable(writable)) {
                        var propWriters = allBindingsAccessor()._ko_property_writers;
                        if (propWriters && propWriters.datepicker) {
                            writable = propWriters.datepicker;
                        } else {
                            return;
                        }
                    }
                    writable($(element).datepicker("getDate"));
                },
                update: function (element, valueAccessor) {
                    var widget = $(element).data("DateTimePicker");
                    //when the view model is updated, update the widget
                    if (widget) {
                        var date = ko.utils.unwrapObservable(valueAccessor());
                        widget.date(date);
                    }
                }
            };

            return this;
        }
    });
});
