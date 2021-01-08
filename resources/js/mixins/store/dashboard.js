import {mapActions, mapGetters} from "vuex";

export default {
    computed: {
        ...mapGetters({
            reloadDashboard: 'dashboard-store/getReload',
        }),
    },

    methods: {
        ...mapActions({
            setReloadDashboard: 'dashboard-store/setReload',
        }),
    }
}