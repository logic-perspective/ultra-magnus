<template>
    <div class="row">
        <div class="col-md-4">
            <div class="card card-chart">
                <div class="card-header card-header-rose" data-header-animation="true">
                    <div class="ct-chart" id="websiteViewsChart"></div>
                </div>
                <div class="card-body">
                    <div class="card-actions">

                        <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                            <i class="material-icons">refresh</i>
                        </button>
                        <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                            <i class="material-icons">edit</i>
                        </button>
                    </div>
                    <h4 class="card-title">Arrests</h4>
                    <p class="card-category">All arrests throuhgout the year</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">access_time</i> last updated 2 days ago
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-chart">
                <div class="card-header card-header-success" data-header-animation="true">
                    <div class="ct-chart" id="dailySalesChart"></div>
                </div>
                <div class="card-body">
                    <div class="card-actions">
                        <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                            <i class="material-icons">refresh</i>
                        </button>
                        <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                            <i class="material-icons">edit</i>
                        </button>
                    </div>
                    <h4 class="card-title">Offences</h4>
                    <p class="card-category">
                        <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in daily offences.</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">access_time</i> updated 4 minutes ago
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-chart">
                <div class="card-header card-header-info" data-header-animation="true">
                    <div class="ct-chart" id="completedTasksChart"></div>
                </div>
                <div class="card-body">
                    <div class="card-actions">

                        <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                            <i class="material-icons">refresh</i>
                        </button>
                        <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                            <i class="material-icons">edit</i>
                        </button>
                    </div>
                    <h4 class="card-title">Crime Rate</h4>
                    <p class="card-category">Overview of crime rate</p>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">access_time</i> last updated 2 days ago
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "crime-analysis-plot"
    }
</script>
