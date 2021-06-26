require('./bootstrap');

// Import modules...
import Vue from 'vue';
import store from './store/'
import './registerServiceWorker'
import './plugins/vuetify'
import './theme/default.sass'

import vuetify from './plugins/vuetify'
import i18n from './plugins/i18n'
import '@mdi/font/css/materialdesignicons.css'
import 'jodit/build/jodit.css'

import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import PortalVue from 'portal-vue';

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
    vuetify,
    store: store,
    i18n
}).$mount(app);
