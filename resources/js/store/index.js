import Vue from 'vue';
import Vuex from 'vuex';
import {createStore} from 'vuex-extensions';
import createPersistedState from "vuex-persistedstate";
import DashboardStore from './dashboard';
import Mixins from '../feature/mixins/store';

Vue.use(Vuex);
Mixins.forEach(mixin => Vue.mixin(mixin));

const store = createStore(Vuex.Store, {
    strict: process.env.NODE_ENV !== 'production',
    plugins: [createPersistedState()],
});

store.registerModule('dashboard-store', DashboardStore);

export default store;