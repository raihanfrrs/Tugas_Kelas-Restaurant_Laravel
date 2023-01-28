$(document).ready( function () {
    $('#dataProduct').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataProduct',
        columns: [
            { data: 'id', name: 'id', class: 'lead-text' },
            { data: 'product_name', name: 'product_name', class: 'text-muted text-capitalize' },
            { data: 'price', name: 'price', class: 'text-muted' },
            { data: 'action', name: 'action' }
        ]
    });

    $('#dataCategory').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataCategory',
        columns: [
            { data: 'id', name: 'id', class: 'lead-text' },
            { data: 'category', name: 'category', class: 'text-muted text-capitalize' },
            { data: 'action', name: 'action' }
        ]
    });

    $('#dataCustomer').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataCustomer',
        columns: [
            { data: 'id', name: 'id', class: 'lead-text' },
            { data: 'name', name: 'name', class: 'text-muted text-capitalize' },
            { data: 'action', name: 'action' }
        ]
    });

    $('#dataCashier').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataCashier',
        columns: [
            { data: 'id', name: 'id', class: 'lead-text' },
            { data: 'name', name: 'name', class: 'text-muted text-capitalize' },
            { data: 'phone', name: 'phone', class: 'text-muted' },
            { data: 'email', name: 'email', class: 'text-muted' },
            { data: 'action', name: 'action' }
        ]
    });

    $('#dataKitchen').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataKitchen',
        columns: [
            { data: 'id', name: 'id', class: 'lead-text' },
            { data: 'name', name: 'name', class: 'text-muted text-capitalize' },
            { data: 'phone', name: 'phone', class: 'text-muted' },
            { data: 'email', name: 'email', class: 'text-muted' },
            { data: 'action', name: 'action' }
        ]
    });

    $('#dataTax').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataTax',
        columns: [
            { data: 'tax', name: 'tax', class: 'text-muted text-capitalize' },
            { data: 'status', name: 'status', class: 'text-muted text-capitalize' },
            { data: 'action', name: 'action' }
        ]
    });

    $('#dataInvoice').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataInvoice',
        columns: [
            { data: 'id', name: 'id', class: 'lead-text text-center' },
            { data: 'customer' , name: 'customer', class: 'text-muted text-capitalize text-center' },
            { data: 'total_amount', name: 'total_amount', class: 'text-muted text-capitalize text-center' },
            { data: 'grand_total', name: 'grand_total', class: 'text-muted text-capitalize text-center' },
            { data: 'date', name: 'date', class: 'text-muted text-capitalize text-center' },
            { data: 'status', name: 'status', class: 'text-muted text-capitalize text-center' },
            { data: 'kitchen', name: 'kitchen', class: 'text-muted text-capitalize text-center' },
            { data: 'action', name: 'action', class: 'text-muted text-capitalize text-center' }
        ],
        order: [ [0, 'desc'] ]
    });

    $('#dataSales').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataSales',
        dom: "Blfrtip",
        buttons: [
            {
                text: 'csv',
                extend: 'csvHtml5',
                title: 'Sales',
                exportOptions: {
                    columns: ':visible:not(.not-export-col)'
                }
            },
            {
                text: 'excel',
                extend: 'excelHtml5',
                title: 'Sales',
                exportOptions: {
                    columns: ':visible:not(.not-export-col)'
                }
            },
            {
                text: 'pdf',
                extend: 'pdfHtml5',
                title: 'Sales',
                exportOptions: {
                    columns: ':visible:not(.not-export-col)'
                }
            },
            {
                text: 'print',
                extend: 'print',
                title: 'Sales',
                exportOptions: {
                    columns: ':visible:not(.not-export-col)'
                }
            },  
        ],
        columns: [
            { data: 'id', name: 'id', class: 'lead-text text-center' },
            { data: 'customer' , name: 'customer', class: 'text-muted text-capitalize text-center' },
            { data: 'total_amount', name: 'total_amount', class: 'text-muted text-capitalize text-center' },
            { data: 'grand_total', name: 'grand_total', class: 'text-muted text-capitalize text-center' },
            { data: 'date', name: 'date', class: 'text-muted text-capitalize text-center' },
            { data: 'status', name: 'status', class: 'text-muted text-capitalize text-center' },
            { data: 'cashier', name: 'cashier', class: 'text-muted text-capitalize text-center' },
            { data: 'kitchen', name: 'kitchen', class: 'text-muted text-capitalize text-center' },
            { data: 'action', name: 'action', class: 'text-muted text-capitalize text-center' }
        ]
    });

    $('#dataPerformanceCashier').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataPerformanceCashier',
        dom: "Blfrtip",
        buttons: [
            {
                text: 'csv',
                extend: 'csvHtml5',
                title: 'Cashier Performances',
                exportOptions: {
                    columns: ':visible:not(.not-export-col)'
                }
            },
            {
                text: 'excel',
                extend: 'excelHtml5',
                title: 'Cashier Performances',
                exportOptions: {
                    columns: ':visible:not(.not-export-col)'
                }
            },
            {
                text: 'pdf',
                extend: 'pdfHtml5',
                title: 'Cashier Performances',
                exportOptions: {
                    columns: ':visible:not(.not-export-col)'
                }
            },
            {
                text: 'print',
                extend: 'print',
                title: 'Cashier Performances',
                exportOptions: {
                    columns: ':visible:not(.not-export-col)'
                }
            },  
        ],
        columns: [
            { data: 'id', name: 'id', class: 'lead-text text-center' },
            { data: 'cashier' , name: 'cashier', class: 'text-muted text-capitalize text-center' },
            { data: 'total_orders', name: 'total_orders', class: 'text-muted text-capitalize text-center' },
            { data: 'products_sell', name: 'products_sell', class: 'text-muted text-capitalize text-center' },
            { data: 'total_earnings', name: 'total_earnings', class: 'text-muted text-capitalize text-center' },
            { data: 'status', name: 'status', class: 'text-muted text-capitalize text-center' },
            { data: 'action', name: 'action', class: 'text-muted text-capitalize text-center' }
        ]
    });

    $('#dataPerformanceKitchen').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataPerformanceKitchen',
        dom: "Blfrtip",
        buttons: [
            {
                text: 'csv',
                extend: 'csvHtml5',
                title: 'Kitchen Performances',
                exportOptions: {
                    columns: ':visible:not(.not-export-col)'
                }
            },
            {
                text: 'excel',
                extend: 'excelHtml5',
                title: 'Kitchen Performances',
                exportOptions: {
                    columns: ':visible:not(.not-export-col)'
                }
            },
            {
                text: 'pdf',
                extend: 'pdfHtml5',
                title: 'Kitchen Performances',
                exportOptions: {
                    columns: ':visible:not(.not-export-col)'
                }
            },
            {
                text: 'print',
                extend: 'print',
                title: 'Kitchen Performances',
                exportOptions: {
                    columns: ':visible:not(.not-export-col)'
                }
            },  
        ],
        columns: [
            { data: 'id', name: 'id', class: 'lead-text text-center' },
            { data: 'kitchen' , name: 'kitchen', class: 'text-muted text-capitalize text-center' },
            { data: 'total_received', name: 'total_received', class: 'text-muted text-capitalize text-center' },
            { data: 'total_rejected', name: 'total_rejected', class: 'text-muted text-capitalize text-center' },
            { data: 'products_cooked', name: 'products_cooked', class: 'text-muted text-capitalize text-center' },
            { data: 'status', name: 'status', class: 'text-muted text-capitalize text-center' },
            { data: 'action', name: 'action', class: 'text-muted text-capitalize text-center' }
        ]
    });

    
    $('#dataSalesTax').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataSalesTax',
        dom: "Blfrtip",
        buttons: [
            {
                text: 'csv',
                extend: 'csvHtml5',
                title: 'Taxes',
                exportOptions: {
                    columns: ':visible:not(.not-export-col)'
                }
            },
            {
                text: 'excel',
                extend: 'excelHtml5',
                title: 'Taxes',
                exportOptions: {
                    columns: ':visible:not(.not-export-col)'
                }
            },
            {
                text: 'pdf',
                extend: 'pdfHtml5',
                title: 'Taxes',
                exportOptions: {
                    columns: ':visible:not(.not-export-col)'
                }
            },
            {
                text: 'print',
                extend: 'print',
                title: 'Taxes',
                exportOptions: {
                    columns: ':visible:not(.not-export-col)'
                }
            },  
        ],
        columns: [
            { data: 'tax' , name: 'tax', class: 'text-muted text-capitalize text-center' },
            { data: 'totalSalesTax', name: 'totalSalesTax', class: 'text-muted text-capitalize text-center' },
            { data: 'action', name: 'action', class: 'text-muted text-capitalize text-center' }
        ]
    });

    $('#dataDetailTax').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataDetailTax/' + $('#dataDetailTax').data("id"),
        dom: "Blfrtip",
        buttons: [
            {
                text: 'csv',
                extend: 'csvHtml5',
                title: 'Detail Taxes'
            },
            {
                text: 'excel',
                extend: 'excelHtml5',
                title: 'Detail Taxes'
            },
            {
                text: 'pdf',
                extend: 'pdfHtml5',
                title: 'Detail Taxes'
            },
            {
                text: 'print',
                extend: 'print',
                title: 'Detail Taxes'
            },  
        ],
        columns: [
            { data: 'tax' , name: 'tax', class: 'text-muted text-capitalize text-center' },
            { data: 'total_income', name: 'total_income', class: 'text-muted text-capitalize text-center' },
            { data: 'month', name: 'month', class: 'text-muted text-capitalize text-center' },
            { data: 'year', name: 'year', class: 'text-muted text-capitalize text-center' }
        ]
    });
});