<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<script src="{{ mix('js/app.js') }}"></script>
<!--   Core JS Files   -->
<script src="js/core/jquery.min.js"></script>
<script src="js/core/popper.min.js"></script>
<script src="js/core/bootstrap-material-design.min.js"></script>
<script src="js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Plugin for the momentJs  -->
<script src="js/plugins/moment.min.js"></script>
<!--  Plugin for Sweet Alert -->
<script src="js/plugins/sweetalert2.js"></script>
<!-- Forms Validations Plugin -->
<script src="js/plugins/jquery.validate.min.js"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="js/plugins/jquery.bootstrap-wizard.js"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="js/plugins/bootstrap-selectpicker.js"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="js/plugins/bootstrap-datetimepicker.min.js"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="js/plugins/jquery.dataTables.min.js"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="js/plugins/bootstrap-tagsinput.js"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="js/plugins/jasny-bootstrap.min.js"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="js/plugins/fullcalendar.min.js"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="js/plugins/jquery-jvectormap.js"></script>

<script src="https://jvectormap.com/js/jquery-jvectormap-us-il-chicago-mill.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="js/plugins/nouislider.min.js"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="js/plugins/arrive.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfcs46jm2KfO8xvTP_RqtY0a39D7770s0"></script>
<!-- Chartist JS -->
<script src="js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="js/demo/demo.js"></script>

<script>
    let gmapsLoaded = false;

    $(document).ready(function() {
        md.initDashboardPageCharts();
        let mapData = {
            // district 1
            32 : 754.79,
            33 : 754.79,
            34 : 754.79,
            35 : 754.79,
            36 : 754.79,
            37 : 754.79,
            38 : 754.79,
            39 : 754.79,
            40 : 754.79,
            41 : 754.79,

            // district 2
            58 : 796.45,
            59 : 796.45,
            60 : 796.45,
            61 : 796.45,
            63 : 796.45,

            // district 3
            42 : 956.61,
            43 : 956.61,
            44 : 956.61,

            // district 4
            45 : 1043.07,
            46 : 1043.07,
            47 : 1043.07,
            48 : 1043.07,
            51 : 1043.07,
            52 : 1043.07,
            55 : 1043.07,

            // district 5
            49 : 824.53,
            50 : 824.53,
            53 : 824.53,
            54 : 824.53,
        };

        $('#worldMap').vectorMap({
            map: 'us-il-chicago_mill',
            backgroundColor: "transparent",
            zoomOnScroll: false,
            regionStyle: {
                initial: {
                    fill: '#e4e4e4',
                    "fill-opacity": 0.9,
                    stroke: 'none',
                    "stroke-width": 0,
                    "stroke-opacity": 0
                }
            },

            series: {
                regions: [{
                    values: mapData,
                    scale: ["#70c4c1", "#5672af", "#ffae6e", "#e45f6b"],
                    normalizeFunction: 'polynomial'
                }]
            },
        });

        try {
            demo.initGoogleMaps();
            gmapsLoaded = true;
        }catch{}
    });

    $( window ).scroll(function() {
        if (! gmapsLoaded) {
            $('.ps__rail-x').hide();
            $('.ps__rail-y').hide();
        } else {
            window.setTimeout(() => {
                $('.ps__rail-x').hide();
                $('.ps__rail-y').hide();
            }, 0);
        }
    });
</script>