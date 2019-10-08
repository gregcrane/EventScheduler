/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */

define([
    'Magento_Ui/js/form/element/select',
    'uiRegistry',
], function (Select, uiRegistry) {
    'use strict';

    /**
     * Create the custom hide/display functionality for dependent form fields.
     */
    return Select.extend({
        /**
         * On select update call the toggle function passing in the value.
         *
         * @param value
         */
        onUpdate: function (value) {
            this.toggleDependency(value);
        },

        /**
         * Toggle the visibility of inputs.
         *
         * These inputs are passed in via xml arguments. This will hide the inputs if the
         * trigger value us selected.
         *
         * @param value
         */
        toggleDependency: function (value) {
            let dependentFields = this.dependentFields;
            dependentFields= dependentFields.split(',');
            if (value === this.triggerValue) {
                dependentFields.forEach(element => {
                    uiRegistry.get('index = ' + element).hide().disable();
                });
            } else {
                dependentFields.forEach(element => {
                    uiRegistry.get('index = ' + element).show().enable();
                });
            }
        }
    });
});
