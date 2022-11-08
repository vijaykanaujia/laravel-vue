import './bootstrap';
import '../css/app.css';
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faBell } from '@fortawesome/free-regular-svg-icons';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import Toast from "vue-toastification";
import Base from './base';

library.add(faBell);

const options = {
    // You can set your default options here
};

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        const myApp =  createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy);
            myApp.mixin({ methods: { route } });
            myApp.use(Toast, options);
            myApp.mixin(Base);
            myApp.component('font-awesome-icon', FontAwesomeIcon);
            // myApp.config.globalProperties.eventBus = eventBus;
            // myApp.config.globalProperties.modalData = ref({});
            return myApp.mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
