<template>
    <div class="row p-0">
        <div class="col-md-12 p-0">
            <div class="card ">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">analytics</i>
                    </div>
                    <h4 class="card-title">Crime Rate by Top Locations</h4>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive table-sales">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="flag">
                                                <img src="img/flags/CA.png" alt=""></div>
                                        </td>
                                        <td>Vancouver, Canada</td>
                                        <td class="text-right">
                                            1.300
                                        </td>
                                        <td class="text-right">
                                            53.23%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="flag">
                                                <img src="img/flags/US.png" alt=""> </div>
                                        </td>
                                        <td>Chicago, USA</td>
                                        <td class="text-right">
                                            1.560
                                        </td>
                                        <td class="text-right">
                                            20.43%
                                        </td>
                                    <tr>
                                        <td>
                                            <div class="flag">
                                                <img src="img/flags/DE.png" alt=""></div>
                                        </td>
                                        <td>Germany</td>
                                        <td class="text-right">
                                            1.300
                                        </td>
                                        <td class="text-right">
                                            20.43%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="flag">
                                                <img src="img/flags/AU.png" alt=""> </div>
                                        </td>
                                        <td>Australia</td>
                                        <td class="text-right">
                                            760
                                        </td>
                                        <td class="text-right">
                                            10.35%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="flag">
                                                <img src="img/flags/GB.png" alt=""> </div>
                                        </td>
                                        <td>United Kingdom</td>
                                        <td class="text-right">
                                            690
                                        </td>
                                        <td class="text-right">
                                            7.87%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="flag">
                                                <img src="img/flags/RO.png" alt=""> </div>
                                        </td>
                                        <td>Romania</td>
                                        <td class="text-right">
                                            600
                                        </td>
                                        <td class="text-right">
                                            5.94%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="flag">
                                                <img src="img/flags/BR.png" alt=""> </div>
                                        </td>
                                        <td>Brasil</td>
                                        <td class="text-right">
                                            550
                                        </td>
                                        <td class="text-right">
                                            4.34%
                                        </td>
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
        name: "crime-ranked-listing"
    }
</script>