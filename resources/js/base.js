import { usePage } from "@inertiajs/inertia-vue3";

export default {
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