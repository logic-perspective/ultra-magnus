<template>
    <div class="row p-0">
        <div class="col-md-12 p-0">
            <div class="card ">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">analytics</i>
                    </div>
                    <h4 class="card-title">Crime Rate in the First 5 Districts in Chicago, USA</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive table-sales">
                                <table class="table">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>
                                                District Code
                                            </th>
                                            <th>
                                                Rate
                                            </th>
                                            <th>
                                                Map Key
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="dr in districtRates">
                                        <td>{{ dr.district }}</td>
                                        <td>{{ dr.rate }}</td>
                                        <td><span class="btn" disabled v-bind:style="`background-color: ${rateColors[dr.rate]}`"></span> </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 ml-auto mr-auto">
                            <div id="worldMap" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "crime-ranked-listing",

        computed: {
            rateColors() {
                let rates = this.districtRates.map(({rate}) => rate);
                rates.sort((a, b) => { return a - b });
                return _.zipObject(rates, ["#70c4c1","#5f8db5", "#5672af", "#ffae6e", "#e45f6b"]);
            },
        },

        data() {
            return {
                districtRates: [],
            }
        },

        mounted() {
            this.loadDistrictRates();

        },

        methods: {
            loadDistrictRates() {
                axios.get('chicago-crime/district-rates')
                .then(res => {
                    this.districtRates = res.data;
                })
                .catch(() => {
                })
            }
        }
    }
</script>