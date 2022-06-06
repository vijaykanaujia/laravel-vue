require('./bootstrap');

import { createApp, h, ref } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
// import mitt from 'mitt';
// const eventBus = mitt();
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

const options = {
    // You can set your default options here
};

const appName = window.document.getElementsByTagName('title')[0] ?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        const myApp =  createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } });
            myApp.use(Toast, options);
            myApp.mixin(require('./base'))
            // myApp.config.globalProperties.eventBus = eventBus;
            // myApp.config.globalProperties.modalData = ref({});
            return myApp.mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });