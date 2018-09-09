</div>
<!-- END wrapper -->



<script>
    var resizefunc = [];
</script>
<script src="{{url('/public/design/admin')}}/assets/plugins/switchery/switchery.min.js"></script>
<!-- jQuery  -->
<script src="{{url('/public/design/admin')}}/assets/js/jquery.min.js"></script>
<script src="{{url('/public/design/admin')}}/assets/js/bootstrap-rtl.min.js"></script>
<script src="{{url('/public/design/admin')}}/assets/js/detect.js"></script>
<script src="{{url('/public/design/admin')}}/assets/js/fastclick.js"></script>
<script src="{{url('/public/design/admin')}}/assets/js/jquery.blockUI.js"></script>
<script src="{{url('/public/design/admin')}}/assets/js/waves.js"></script>
<script src="{{url('/public/design/admin')}}/assets/js/jquery.nicescroll.js"></script>
<script src="{{url('/public/design/admin')}}/assets/js/jquery.slimscroll.js"></script>
<script src="{{url('/public/design/admin')}}/assets/js/jquery.scrollTo.min.js"></script>

<!-- KNOB JS -->
<!--[if IE]>
<script type="text/javascript" src="{{url('/public/design/admin')}}/assets/plugins/jquery-knob/excanvas.js"></script>
<![endif]-->
<script src="{{url('public/design/admin')}}/assets/plugins/jquery-knob/jquery.knob.js"></script>

<!--Morris Chart-->
<script src="{{url('public/design/admin')}}/assets/plugins/morris/morris.min.js"></script>
<script src="{{url('public/design/admin')}}/assets/plugins/raphael/raphael-min.js"></script>

<!-- Dashboard init -->
<script src="{{url('public/design/admin')}}/assets/pages/jquery.dashboard.js"></script>

<script src="{{url('/public/design/admin')}}/assets/plugins/fileuploads/js/dropify.min.js"></script>

<!-- file uploads js -->
<!-- Datatables-->
<script src="{{url('/public/design/admin')}}/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('/public/design/admin')}}/assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="{{url('/public/design/admin')}}/assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="{{url('/public/design/admin')}}/assets/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="{{url('/public/design/admin')}}/assets/plugins/datatables/jszip.min.js"></script>
<script src="{{url('/public/design/admin')}}/assets/plugins/datatables/pdfmake.min.js"></script>
<script src="{{url('/public/design/admin')}}/assets/plugins/datatables/vfs_fonts.js"></script>
<script src="{{url('/public/design/admin')}}/assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="{{url('/public/design/admin')}}/assets/plugins/datatables/buttons.print.min.js"></script>
<script src="{{url('/public/design/admin')}}/assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
<script src="{{url('/public/design/admin')}}/assets/plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="{{url('/public/design/admin')}}/assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="{{url('/public/design/admin')}}/assets/plugins/datatables/responsive.bootstrap.min.js"></script>
<script src="{{url('/public/design/admin')}}/assets/plugins/datatables/dataTables.scroller.min.js"></script>

<!-- Datatable init js -->
<script src="{{url('/public/design/admin')}}/assets/pages/datatables.init.js"></script>

<!--form wysiwig js-->
<script src="{{url('/public/design/admin')}}/assets/plugins/tinymce/tinymce.min.js"></script>
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
        $('#datatable-scroller').DataTable( { ajax: "{{url('/public/design/admin')}}/assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
        var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
    } );
    TableManageButtons.init();

</script>

<!-- Modal-Effect -->
<script src="{{url('/public/design/admin')}}/assets/plugins/custombox/dist/custombox.min.js"></script>
<script src="{{url('/public/design/admin')}}/assets/plugins/custombox/dist/legacy.min.js"></script>
{{--<script src="{{url('/public/design/admin')}}/assets/plugins/fileuploads/js/dropify.min.js"></script>--}}

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

    jQuery(document).ready(function() {

        //advance multiselect start
        $('#my_multi_select3').multiSelect({
            selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
            selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
            afterInit: function (ms) {
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function (e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function (e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function () {
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function () {
                this.qs1.cache();
                this.qs2.cache();
            }
        });

        // Select2
        $(".select2").select2();

        $(".select2-limiting").select2({
            maximumSelectionLength: 2
        });

    });

    //Bootstrap-TouchSpin
    $(".vertical-spin").TouchSpin({
        verticalbuttons: true,
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary",
        verticalupclass: 'ti-plus',
        verticaldownclass: 'ti-minus'
    });
    var vspinTrue = $(".vertical-spin").TouchSpin({
        verticalbuttons: true
    });
    if (vspinTrue) {
        $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
    }

    $("input[name='demo1']").TouchSpin({
        min: 0,
        max: 100,
        step: 0.1,
        decimals: 2,
        boostat: 5,
        maxboostedstep: 10,
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary",
        postfix: '%'
    });
    $("input[name='demo2']").TouchSpin({
        min: -1000000000,
        max: 1000000000,
        stepinterval: 50,
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary",
        maxboostedstep: 10000000,
        prefix: '$'
    });
    $("input[name='demo3']").TouchSpin({
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary"
    });
    $("input[name='demo3_21']").TouchSpin({
        initval: 40,
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary"
    });
    $("input[name='demo3_22']").TouchSpin({
        initval: 40,
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary"
    });

    $("input[name='demo5']").TouchSpin({
        prefix: "pre",
        postfix: "post",
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary"
    });
    $("input[name='demo0']").TouchSpin({
        buttondown_class: "btn btn-primary",
        buttonup_class: "btn btn-primary"
    });

    // Time Picker
    jQuery('#timepicker').timepicker({
        defaultTIme : false
    });
    jQuery('#timepicker2').timepicker({
        showMeridian : false
    });
    jQuery('#timepicker3').timepicker({
        minuteStep : 15
    });

    //colorpicker start

    $('.colorpicker-default').colorpicker({
        format: 'hex'
    });
    $('.colorpicker-rgba').colorpicker();

    // Date Picker
    jQuery('#datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#datepicker-inline').datepicker();
    jQuery('#datepicker-multiple-date').datepicker({
        format: "mm/dd/yyyy",
        clearBtn: true,
        multidate: true,
        multidateSeparator: ","
    });
    jQuery('#date-range').datepicker({
        toggleActive: true
    });

    //Date range picker
    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-default',
        cancelClass: 'btn-primary'
    });
    $('.input-daterange-timepicker').daterangepicker({
        timePicker: true,
        format: 'MM/DD/YYYY h:mm A',
        timePickerIncrement: 30,
        timePicker12Hour: true,
        timePickerSeconds: false,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-default',
        cancelClass: 'btn-primary'
    });
    $('.input-limit-datepicker').daterangepicker({
        format: 'MM/DD/YYYY',
        minDate: '06/01/2016',
        maxDate: '06/30/2016',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-default',
        cancelClass: 'btn-primary',
        dateLimit: {
            days: 6
        }
    });

    $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

    $('#reportrange').daterangepicker({
        format: 'MM/DD/YYYY',
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2016',
        maxDate: '12/31/2016',
        dateLimit: {
            days: 60
        },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        drops: 'down',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-success',
        cancelClass: 'btn-default',
        separator: ' to ',
        locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Cancel',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        }
    }, function (start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });

    //Bootstrap-MaxLength
    $('input#defaultconfig').maxlength()

    $('input#thresholdconfig').maxlength({
        threshold: 20
    });

    $('input#moreoptions').maxlength({
        alwaysShow: true,
        warningClass: "label label-success",
        limitReachedClass: "label label-danger"
    });

    $('input#alloptions').maxlength({
        alwaysShow: true,
        warningClass: "label label-success",
        limitReachedClass: "label label-danger",
        separator: ' out of ',
        preText: 'You typed ',
        postText: ' chars available.',
        validate: true
    });

    $('textarea#textarea').maxlength({
        alwaysShow: true
    });

    $('input#placement').maxlength({
        alwaysShow: true,
        placement: 'top-left'
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
@yield('script')


<!-- App js -->
<script src="{{url('public/design/admin')}}/assets/js/jquery.core.js"></script>
<script src="{{url('public/design/admin')}}/assets/js/jquery.app.js"></script>
{{--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5Xz9rMq52xAtXTjm6v_cMeppcxWnm0-M&callback=myMap"></script>--}}

<script>
    function hideImg() {
        $(".user-img img").toggle();
        $(".user-img .user-status").toggle();
        $('.user-box .zmdi-power').css('margin-left', '-6px');
    }
    var myVar;

    function myFunction() {
        myVar = setTimeout(showPage, 2500);
    }

    function showPage() {
        document.getElementById("boxLoader").style.display = "none";
        document.getElementById("Content").style.display = "block";
    }
</script>

</body>
</html>