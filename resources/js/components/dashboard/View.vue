<template>
    <div class="container-fluid p-0">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="navbar-wrapper">
                <div class="navbar-minimize">
                    <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                        <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                        <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                    </button>
                </div>
                <a class="navbar-brand" href="javascript:;">Dashboard</a>
            </div>
            <div class="container-fluid">
                <div class="collapse navbar-collapse justify-content-end">
                    <form class="navbar-form">
                        <div class="input-group no-border pt-3">
                            <input type="text" value="" class="form-control" placeholder="Search..." aria-label>
                            <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                <i class="material-icons">search</i>
                                <span class="ripple-container"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content p-0">
            <div class="content p-0">
                <div class="container-fluid p-0">
                    <crime-ranked-listing></crime-ranked-listing>
                    <h5>Crime Reports per Category</h5>
                    <crime-category-report></crime-category-report>
                    <h5>Crime Reports Analysis</h5>
                    <crime-analysis-chart></crime-analysis-chart>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import CrimeRankedListing from "./Rank";
    import CrimeAnalysisChart from "./Chart";
    import CrimeCategoryReport from "./Category";

    export default {
        name: "dashboard-view",

        components: {CrimeCategoryReport, CrimeAnalysisChart, CrimeRankedListing},

        mounted() {
            this.setReloadHeatmap(true);

            if (this.reloadDashboard) {
                this.setReloadDashboard(false);
                window.location.reload();
            }
        },
    }
</script>