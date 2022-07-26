/**
 * DataTables Basic
 */

// DataTable with buttons
// --------------------------------------------------------------------

$('.datatables').DataTable({

    // Actions
    dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    displayLength:10,
    lengthMenu: [10, 25, 50, 75, 100],
    language: {
        oPaginate: {
           Next: '<i class="fa fa-forward"></i>',
           Previous: '<i class="fa fa-backward"></i>',
           First: '<i class="fa fa-step-backward"></i>',
           Last: '<i class="fa fa-step-forward"></i>'
        }
      },
    buttons: [{
        extend: 'collection',
        className: 'btn btn-outline-secondary dropdown-toggle mr-2',
        text: feather.icons['share'].toSvg({ class: 'font-small-4 mr-50' }) + 'Export',
        buttons: [{
                extend: 'print',
                text: feather.icons['printer'].toSvg({ class: 'font-small-4 mr-50' }) + 'Print',
                className: 'dropdown-item',
                exportOptions: { columns: [3, 4, 5, 6, 7] }
            },
            {
                extend: 'csv',
                text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Csv',
                className: 'dropdown-item',
                exportOptions: { columns: [3, 4, 5, 6, 7] }
            },
            {
                extend: 'excel',
                text: feather.icons['file'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel',
                className: 'dropdown-item',
                exportOptions: { columns: [3, 4, 5, 6, 7] }
            },
            {
                extend: 'pdf',
                text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 mr-50' }) + 'Pdf',
                className: 'dropdown-item',
                exportOptions: { columns: [3, 4, 5, 6, 7] }
            },
            {
                extend: 'copy',
                text: feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) + 'Copy',
                className: 'dropdown-item',
                exportOptions: { columns: [3, 4, 5, 6, 7] }
            }
        ],
        init: function(api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function() {
                $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
        }
    }, ]
});

$('.delete-confirm').on('click', function(e) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});
$("#checkAll").click(function() {
    $('input:checkbox').not(this).prop('checked', this.checked);
});

$("input#myInput").keyup(function() {
    var value = $(this).val();
    $("#myDropdown a").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });

});
