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
            { data: 'customer' , name: 'customr', class: 'text-muted text-capitalize text-center' },
            { data: 'total_amount', name: 'total_amount', class: 'text-muted text-capitalize text-center' },
            { data: 'grand_total', name: 'grand_total', class: 'text-muted text-capitalize text-center' },
            { data: 'cashier', name: 'cashier', class: 'text-muted text-capitalize text-center' },
            { data: 'date', name: 'date', class: 'text-muted text-capitalize text-center' },
            { data: 'action', name: 'action', class: 'text-muted text-capitalize text-center' },
        ]
    });


});