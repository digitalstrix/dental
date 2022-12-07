
</main> <!-- main -->
</div> <!-- .wrapper -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/simplebar.min.js')}}"></script>
<script src='{{asset('js/daterangepicker.js')}}'></script>
<script src='{{asset('js/jquery.stickOnScroll.js')}}'></script>
<script src="{{asset('js/tinycolor-min.js')}}"></script>
<script src="{{asset('js/config.js')}}"></script>
<script src="{{asset('js/d3.min.js')}}"></script>
<script src="{{asset('js/topojson.min.js')}}"></script>
<script src="{{asset('js/datamaps.all.min.js')}}"></script>
<script src="{{asset('js/datamaps-zoomto.js')}}"></script>
<script src="{{asset('js/datamaps.custom.js')}}"></script>
<script src="{{asset('js/Chart.min.js')}}"></script>
<script>
/* defind global options */
Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
Chart.defaults.global.defaultFontColor = colors.mutedColor;
</script>
<script src="{{asset('js/gauge.min.js')}}"></script>
<script src="{{asset('js/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('js/apexcharts.min.js')}}"></script>
<script src="{{asset('js/apexcharts.custom.js')}}"></script>
<script src="{{asset('js/apps.js')}}"></script>
<script src='{{asset('js/jquery.dataTables.min.js')}}'></script>
<script src='{{asset('js/dataTables.bootstrap4.min.js')}}'></script>
<script>
$('#dataTable-1').DataTable({
    autoWidth: true,
    "lengthMenu": [
        [16, 32, 64, -1],
        [16, 32, 64, "All"]
    ]
});
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->

</body>

</html>