</div>
<!-- END wrapper -->



<script>
    var resizefunc = [];
</script>
<script src="{{url('/design/admin')}}/assets/plugins/switchery/switchery.min.js"></script>
<!-- jQuery  -->
<script src="{{url('/design/admin')}}/assets/js/jquery.min.js"></script>
<script src="{{url('/design/admin')}}/assets/js/bootstrap-rtl.min.js"></script>
<script src="{{url('/design/admin')}}/assets/js/detect.js"></script>
<script src="{{url('/design/admin')}}/assets/js/fastclick.js"></script>
<script src="{{url('/design/admin')}}/assets/js/jquery.blockUI.js"></script>
<script src="{{url('/design/admin')}}/assets/js/waves.js"></script>
<script src="{{url('/design/admin')}}/assets/js/jquery.nicescroll.js"></script>
<script src="{{url('/design/admin')}}/assets/js/jquery.slimscroll.js"></script>
<script src="{{url('/design/admin')}}/assets/js/jquery.scrollTo.min.js"></script>

<!-- KNOB JS -->
<!--[if IE]>
<script type="text/javascript" src="{{url('/design/admin')}}/assets/plugins/jquery-knob/excanvas.js"></script>
<![endif]-->
<script src="{{url('design/admin')}}/assets/plugins/jquery-knob/jquery.knob.js"></script>

<!--Morris Chart-->
<script src="{{url('design/admin')}}/assets/plugins/morris/morris.min.js"></script>
<script src="{{url('design/admin')}}/assets/plugins/raphael/raphael-min.js"></script>

<!-- Dashboard init -->
<script src="{{url('design/admin')}}/assets/pages/jquery.dashboard.js"></script>

<script src="{{url('/design/admin')}}/assets/plugins/fileuploads/js/dropify.min.js"></script>

<!-- file uploads js -->
<!-- Datatables-->
<script src="{{url('/design/admin')}}/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('/design/admin')}}/assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="{{url('/design/admin')}}/assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="{{url('/design/admin')}}/assets/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="{{url('/design/admin')}}/assets/plugins/datatables/jszip.min.js"></script>
<script src="{{url('/design/admin')}}/assets/plugins/datatables/pdfmake.min.js"></script>
<script src="{{url('/design/admin')}}/assets/plugins/datatables/vfs_fonts.js"></script>
<script src="{{url('/design/admin')}}/assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="{{url('/design/admin')}}/assets/plugins/datatables/buttons.print.min.js"></script>
<script src="{{url('/design/admin')}}/assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
<script src="{{url('/design/admin')}}/assets/plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="{{url('/design/admin')}}/assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="{{url('/design/admin')}}/assets/plugins/datatables/responsive.bootstrap.min.js"></script>
<script src="{{url('/design/admin')}}/assets/plugins/datatables/dataTables.scroller.min.js"></script>

<!-- Datatable init js -->
<script src="{{url('/design/admin')}}/assets/pages/datatables.init.js"></script>

<!--form wysiwig js-->
<script src="{{url('/design/admin')}}/assets/plugins/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $(".phone").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
        $('#datatable').DataTable({
            lengthChange: true,
            "language": {
                "sProcessing": "جارٍ التحميل...",
                "sLengthMenu": "أظهر _MENU_ مدخلات",
                "sZeroRecords": "لم يعثر على أية سجلات",
                "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                "sInfoPostFix": "",
                "sSearch": "ابحث:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "الأول",
                    "sPrevious": "السابق",
                    "sNext": "التالي",
                    "sLast": "الأخير"
                }
            }
        });

        $('#datatable2').DataTable({
            lengthChange: true,
            "language": {
                "sProcessing": "جارٍ التحميل...",
                "sLengthMenu": "أظهر _MENU_ مدخلات",
                "sZeroRecords": "لم يعثر على أية سجلات",
                "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                "sInfoPostFix": "",
                "sSearch": "ابحث:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "الأول",
                    "sPrevious": "السابق",
                    "sNext": "التالي",
                    "sLast": "الأخير"
                }
            }
        });

        $('#datatable-keytable').DataTable( { keys: true } );
        $('#datatable-responsive').DataTable();
        $('#datatable-scroller').DataTable( { ajax: "{{url('/design/admin')}}/assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
        var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
    } );
    TableManageButtons.init();

</script>

<!-- Modal-Effect -->
<script src="{{url('/design/admin')}}/assets/plugins/custombox/dist/custombox.min.js"></script>
<script src="{{url('/design/admin')}}/assets/plugins/custombox/dist/legacy.min.js"></script>
{{--<script src="{{url('/design/admin')}}/assets/plugins/fileuploads/js/dropify.min.js"></script>--}}

<script>
    $('.dropify').dropify({
        messages: {
            'default': 'اسحب وافلت الصورة او قم بالضغط',
            'replace': 'اسحب وافلت الصورة او قم بالضغط لتغير الصورة',
            'remove': 'حذف',
            'error': 'Ooops, هناك خطأ'
        },
        error: {
            'fileSize': 'حجم الصورة كير جدا'
        }
    });

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    function changeColor() {
        $("#map-header").css("background-color", getRandomColor());
    }

    function myMap() {
        var mapProp= {
            center:new google.maps.LatLng(51.508742,-0.120850),
            zoom:5,
        };
        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
    }

</script>

<!-- App js -->
<script src="{{url('design/admin')}}/assets/js/jquery.core.js"></script>
<script src="{{url('design/admin')}}/assets/js/jquery.app.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5Xz9rMq52xAtXTjm6v_cMeppcxWnm0-M&callback=initMap">
</script>
{{--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5Xz9rMq52xAtXTjm6v_cMeppcxWnm0-M&callback=myMap"></script>--}}

<script>
    var myVar;

    function myFunction() {
        myVar = setTimeout(showPage, 2500);
    }

    function showPage() {
        document.getElementById("boxLoader").style.display = "none";
        document.getElementById("Content").style.display = "block";
    }
</script>
@yield('script')

</body>
</html>