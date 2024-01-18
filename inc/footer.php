<html>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/7b92f6b770.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
    $(document).ready(function () {
        // DataTable for example1
        $('#example1').DataTable({
            "dom": '<"datatable-wrapper"frtip>',
            "scrollY": "450px", // Set the desired height here
            // other DataTable options...
        });

        // DataTable for example2
        var table2 = $('#example2').DataTable({
            "dom": '<"datatable-wrapper"frtip>',
            "scrollY": "450px", // Set the desired height here
            // other DataTable options...
        });

        // DataTable for example3
        var table3 = $('#example3').DataTable({
            "dom": '<"datatable-wrapper"frtip>',
            "scrollY": "450px", // Set the desired height here
            // other DataTable options...
        });

        // DataTable for example4
        var table4 = $('#example4').DataTable({
            "dom": '<"datatable-wrapper"frtip>',
            "scrollY": "450px", // Set the desired height here
            // other DataTable options...
        });

        // Handle tab click event to adjust DataTable columns
        $('.nav-link').on('shown.bs.tab', function (e) {
            // Check if the tab is the one with DataTable (example2, example3, or example4 in this case)
            if ($(e.target).attr('id') === 'nav-profile-tab' || $(e.target).attr('id') === 'nav-contact-tab' || $(e.target).attr('id') === 'nav-disabled-tab') {
                if ($(e.target).attr('id') === 'nav-profile-tab') {
                    table2.columns.adjust().draw();
                } else if ($(e.target).attr('id') === 'nav-contact-tab') {
                    table3.columns.adjust().draw();
                } else if ($(e.target).attr('id') === 'nav-disabled-tab') {
                    table4.columns.adjust().draw();
                }
            }
        });
    });
</script>


</body>

</html>
