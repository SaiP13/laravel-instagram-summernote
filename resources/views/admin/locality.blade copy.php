<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.6.0/jszip-2.5.0/dt-1.11.3/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/b-print-2.0.1/fc-4.0.0/fh-3.2.0/r-2.2.9/sc-2.0.5/sb-1.2.2/sp-1.4.0/datatables.min.css"/>

        <style>
        </style>

    </head>

    <body>
        <div class="content"><br>
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 10px">S.NO</th>
                        <th>Office Name</th>
                        <th>Pincode</th>
                        <th>Taluk</th>
                        <th>District</th>
                        <th>State</th>
                        <th>State GST</th>
                    </tr>
                </thead>
            </table>
        </div>

    </body>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.6.0/jszip-2.5.0/dt-1.11.3/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/b-print-2.0.1/fc-4.0.0/fh-3.2.0/r-2.2.9/sc-2.0.5/sb-1.2.2/sp-1.4.0/datatables.min.js"></script>

    <script>

        $(document).ready(function(){

                $('#example').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "fixedHeader": true,
                    // "dom": 'Bfrtip',
                    "lengthMenu": [[10, 25, 200, -1], [10, 25, 200, "All"]],
                    // "buttons": [
                    //     'copyHtml5',
                    //     'excelHtml5',
                    //     'csvHtml5',
                    //     'pdfHtml5'
                    // ],
                    "ajax": "{{ url('get_locality') }}",

                    "columns": [
                        { "data": "id" },
                        { "data": "office_name" },
                        { "data": "pincode" },
                        { "data": "taluk" },
                        { "data": "district_name"},
                        { "data": "state_name" },
                        { "data": "state_gst_code" }
                    ],


                });



        });

    </script>

</html>
