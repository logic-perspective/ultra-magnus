import {mapActions, mapGetters} from "vuex";

export default {
    computed: {
        ...mapGetters({
            reloadHeatmap: 'heatmap-store/getReload',
        }),
    },

    methods: {
        ...mapActions({
            setReloadHeatmap: 'heatmap-store/setReload',
        }),
    }
}