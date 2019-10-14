/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */

define([
    'jquery',
    'uiRegistry',
    'Magento_Ui/js/form/element/abstract'
], function ($, uiRegistry, abstract) {
    'use strict';

    return abstract.extend({
        initialize: function () {
            this._super();
            $('.scheduler-event-edit').on('click', '.time-button', function() {
                let startElement = uiRegistry.get('index = start_time');
                let endElement = uiRegistry.get('index = end_time');
                let uid = 'notice-' + endElement.uid;

                if (startElement.value()) {
                    let time = $(this).data('time');
                    if (time !== 'custom') {
                        let date = new Date(startElement.value());
                        date.setMinutes(date.getMinutes() + time);
                        endElement.value(date);
                        $('input[aria-describedby="' + uid +'"').datepicker('setDate', endElement.value());
                    } else { // enable the input
                        endElement.enable();
                    }
                }
            });

            return this;
        },
    });
});
