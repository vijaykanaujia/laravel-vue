const { usePage } = require("@inertiajs/inertia-vue3");

module.exports = {
    methods: {
        /**
         * Translate the given key.
         */
        __(key, replace = {}) {
            var translation = _.get(usePage().props.value.language, key);
            Object.keys(replace).forEach(function (key) {
                translation = translation.replace(':' + key, replace[key])
            });

            return translation
        },
    },
}