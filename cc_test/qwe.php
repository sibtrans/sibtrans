
<!DOCTYPE html>
<html>
<head>

    <style>html { font-size: 14px; font-family: Arial, Helvetica, sans-serif; }</style>
    <title></title>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.2.620/styles/kendo.common.min.css"/>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.2.620/styles/kendo.rtl.min.css"/>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.2.620/styles/kendo.silver.min.css"/>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.2.620/styles/kendo.mobile.all.min.css"/>

    <script src="https://kendo.cdn.telerik.com/2018.2.620/js/jquery.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2018.2.620/js/kendo.all.min.js"></script>


</head>
<body>

<div id="example">
    <div class="demo-section k-content">

        <h4>Start time</h4>
        <input id="start" value="8:00" style="width: 100%;" />

        <h4 style="margin-top: 2em;">End time</h4>
        <input id="end" value="15:00" style="width: 100%;" />

    </div>
    <script>
        $(document).ready(function() {
            function startChange() {
                var startTime = start.value();

                if (startTime) {
                    startTime = new Date(startTime);

                    end.max(startTime);

                    startTime.setMinutes(startTime.getMinutes() + this.options.interval);

                    end.min(startTime);
                    end.value(startTime);
                }
            }

            //init start timepicker
            var start = $("#start").kendoTimePicker({
                change: startChange,
                format: "HH:mm"

            }).data("kendoTimePicker");

            //init end timepicker
            var end = $("#end").kendoTimePicker({
                format: "HH:mm"}).data("kendoTimePicker");

            //define min/max range
            start.min("7:00");
            start.max("16:00");

            //define min/max range
            end.min("7:00");
            end.max("16:00");
        });


    </script>

    <style>

    </style>
</div>

</body>
</html>
