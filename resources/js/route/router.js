import Vue from 'vue';
import VueRouter from 'vue-router';
import Dashboard from '../feature/dashboard/View';
import Heatmap from '../feature/heatmap/View';

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