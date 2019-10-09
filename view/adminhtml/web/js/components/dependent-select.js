/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */

/**
 * Select component that has dependent inputs that can be hidden
 * or displayed depending on which select option is chosen.
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
         * Matches specified value with existing options
         * or, if value is not specified, returns value of the first option.
         *
         * @returns {*}
         */
        normalizeData: function () {
            var value = this._super(),
                option;

            if (value !== '') {
                option = this.getOption(value);

                // run our custom function here is there is a preset value.
                this.toggleDependency(value);

                return option && option.value;
            }

            if (!this.caption()) {
                return findFirst(this.options);
            }
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
