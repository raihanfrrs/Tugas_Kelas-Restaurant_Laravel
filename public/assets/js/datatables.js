$(document).ready( function () {
    $('#dataProduct').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'dataProduct',
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
        ajax: 'dataCategory',
        columns: [
            { data: 'id', name: 'id', class: 'lead-text' },
            { data: 'category', name: 'category', class: 'text-muted text-capitalize' },
            { data: 'action', name: 'action' }
        ]
    });

    $('#dataCustomer').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'dataCustomer',
        columns: [
            { data: 'id', name: 'id', class: 'lead-text' },
            { data: 'name', name: 'name', class: 'text-muted text-capitalize' },
            { data: 'action', name: 'action' }
        ]
    });

    $('#dataCashier').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'dataCashier',
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
        ajax: 'dataKitchen',
        columns: [
            { data: 'id', name: 'id', class: 'lead-text' },
            { data: 'name', name: 'name', class: 'text-muted text-capitalize' },
            { data: 'phone', name: 'phone', class: 'text-muted' },
            { data: 'email', name: 'email', class: 'text-muted' },
            { data: 'action', name: 'action' }
        ]
    });
});