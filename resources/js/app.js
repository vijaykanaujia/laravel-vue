require('./bootstrap');

import { createApp, h, ref } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
// import mitt from 'mitt';
// const eventBus = mitt();

const appName = window.document.getElementsByTagName('title')[0] ?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        const myApp =  createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } });
            // myApp.config.globalProperties.eventBus = eventBus;
            // myApp.config.globalProperties.modalData = ref({});
            return myApp.mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });