<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		setTimeout(function(){ $(".alert-messages").remove(); }, 3000);
		<?php if (isset($dataTables)): ?>
      	var table = $('.datatable').DataTable({
            dom: 'Bfrtip',
            lengthMenu: [
                [ 10, 25, 50, 100, -1 ],
                [ '10', '25', '50', '100', 'All' ]
            ],
            buttons: [
                'pageLength',
                {
                    extend: 'print',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    },
                },
                {
                    extend: 'pdf',
                    pageSize: 'A4',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    },
                },
                {
                    extend: 'copy',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    },
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'colvis'
            ],
            "processing": true,
            "serverSide": true,
            'language': {
                'loadingRecords': '&nbsp;',
                'processing': 'Processing',
                'paginate': {
                    'first': '|',
                    'next': '<i class="fa fa-arrow-circle-right"></i>',
                    'previous': '<i class="fa fa-arrow-circle-left"></i>',
                    'last': '|'
                }
            },
            "order": [],
            "ajax": {
                url: "<?= base_url($dataTables) ?>",
                type: "GET",
                data: function(data) {
                    data.start_date = $('#start-date').val();
                    data.end_date = $('#end-date').val();
                    data.status = $('#status').val();
                },
            },
            "columnDefs": [{
                "targets": 'target',
                "orderable": false,
            },],
            "footerCallback": function ( row, data, start, end, display ) {
                if ("<?= $name ?>" == 'sales' || "<?= $name ?>" == 'purchases') {
                    var api = this.api(), data;
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                    
                    if ("<?= $name ?>" == 'sales' || "<?= $name ?>" == 'purchases') {
                        // Total over this page
                        totalPrice = api
                            .column( 3, { page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
            
                        // Update footer
                        $( api.column( 3 ).footer() ).html(
                            '₹'+(totalPrice).toFixed(0)
                        );
                    }

                    if ("<?= $name ?>" == 'sales') {
                        // Total over this page
                        totalPrice = api
                            .column( 8, { page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
            
                        // Update footer
                        $( api.column( 8 ).footer() ).html(
                            '₹'+(totalPrice).toFixed(0)
                        );
                    }
                }
            }
        });

        $('.status').click(function(){
            $('#status').val($(this).data('value'));
            table.ajax.reload();
        });

        <?php endif ?>

        <?php if (isset($dateFilter)): ?>
        $('.date_filter').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            $('#start-date').val(start.format('YYYY-MM-DD'));
            $('#end-date').val(end.format('YYYY-MM-DD'));
            table.ajax.reload();
        });

        /* $('#create_date').datetimepicker({
            format: 'L'
        }); */
        <?php endif ?>

        if ($('.select-model').length > 0) {
            $('select[name="brand_id"]').change(function() {
                var select = $(this);
                var selected = select.data('value');
                var options = '<option value="">Select Model</option>';

                if (select.val()) {
                    $.ajax({
                        url: "<?= base_url(admin('get-model-list')) ?>",
                        type: 'get',
                        data: { 'brand_id': select.val() },
                        dataType: 'json',
                        cache: false,
                        async: false,
                        success: function(result) {
                            for (var k in result)
                                options += `<option ${result[k].val == selected ? 'selected' : ''} value="${result[k].val}">${result[k].m_name}</option>`;
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            
                        }
                    });
                }

                $('select[name="model_id"]').html(options);
            });

            $('select[name="brand_id"]').trigger('change');
        }
	});

    function remove(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "This will be deleted from your data!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.value) $('#'+id).submit();
      })
    }
</script>