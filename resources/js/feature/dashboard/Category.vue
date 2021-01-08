<template>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">pan_tool</i>
                    </div>
                    <p class="card-category">Violent Crime</p>
                    <h3 class="card-title">184</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons text-danger">warning</i>
                        <a href="#">There is an increase in reports.</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">home</i>
                    </div>
                    <p class="card-category">Property Crime</p>
                    <h3 class="card-title">75</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">local_offer</i> The is a decrease in property crimes.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">work</i>
                    </div>
                    <p class="card-category">Organised Crime</p>
                    <h3 class="card-title">12</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">date_range</i> Reported 6 months ago.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">accessibility</i>
                    </div>
                    <p class="card-category">Consensual Crime</p>
                    <h3 class="card-title">245</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">update</i> Just Updated.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "crime-category-report"
    }
</script>