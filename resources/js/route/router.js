import Vue from 'vue';
import VueRouter from 'vue-router';
import Dashboard from '../components/dashboard/View';
import Heatmap from '../components/heatmap/View';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'hash',
    base: '/',
    routes: [
        {
            path: '/dashboard',
            alias: '/',
            name: 'dashboard',
            component: Dashboard,
        },
        {
            path: '/heatmap',
            name: 'heatmap',
            component: Heatmap,
        },
        { path: '/*', redirect: '/' },
    ],
});