require('./bootstrap');

import Vue from 'vue';
import router from './route/router';
import store from './store';
import {BootstrapVue, BootstrapVueIcons} from 'bootstrap-vue';
import {CommonBands, MediaQueries} from 'vue-media-queries';
import IdleVue from 'idle-vue';

const idleVueOptions = {
    eventEmitter: new Vue(),
    idleTime: 240000
};

const mediaQueries = new MediaQueries({
    bands: CommonBands.Bootstrap4
});

Vue.prototype.$eventHub = new Vue();

Vue.use(BootstrapVue);
Vue.use(BootstrapVueIcons);
Vue.use(mediaQueries);
Vue.use(IdleVue, idleVueOptions);

Vue.component('navigation-sidebar', require('./feature/components/Sidebar').default);


const app = new Vue({
    el: '#app',
    mediaQueries: mediaQueries,
    mixins: [CommonBands.Bootstrap4.mixin],
    router,
    store,
    onIdle() {
        location.reload();
    }
});
