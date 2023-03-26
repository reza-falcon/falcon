/**
 * DataTables Advanced
 */

'use strict';

// Advanced Search Functions Starts
// --------------------------------------------------------------------


// Datepicker for advanced filter
var separator = ' - ',
    rangePickr = $('.flatpickr-range'),
    dateFormat = 'MM/DD/YYYY';
var options = {
    autoUpdateInput: false,
    autoApply: true,
    locale: {
        format: dateFormat,
        separator: separator
    },
    opens: $('html').attr('data-textdirection') === 'rtl' ? 'left' : 'right'
};

//
if (rangePickr.length) {
    rangePickr.flatpickr({
        mode: 'range',
        dateFormat: 'm/d/Y',
        onClose: function (selectedDates, dateStr, instance) {
            var startDate = '',
                endDate = new Date();
            if (selectedDates[0] != undefined) {
                startDate =
                    selectedDates[0].getMonth() + 1 + '/' + selectedDates[0].getDate() + '/' + selectedDates[0].getFullYear();
                $('.start_date').val(startDate);
            }
            if (selectedDates[1] != undefined) {
                endDate =
                    selectedDates[1].getMonth() + 1 + '/' + selectedDates[1].getDate() + '/' + selectedDates[1].getFullYear();
                $('.end_date').val(endDate);
            }
            $(rangePickr).trigger('change').trigger('keyup');
        }
    });
}

// Advance filter function
// We pass the column location, the start date, and the end date
var filterByDate = function (column, startDate, endDate) {
    // Custom filter syntax requires pushing the new filter to the global filter array
    $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
        var rowDate = normalizeDate(aData[column]),
            start = normalizeDate(startDate),
            end = normalizeDate(endDate);

        // If our date from the row is between the start and end
        if (start <= rowDate && rowDate <= end) {
            return true;
        } else if (rowDate >= start && end === '' && start !== '') {
            return true;
        } else if (rowDate <= end && start === '' && end !== '') {
            return true;
        } else {
            return false;
        }
    });
};

// converts date strings to a Date object, then normalized into a YYYYMMMDD format (ex: 20131220). Makes comparing dates easier. ex: 20131220 > 20121220
var normalizeDate = function (dateString) {
    var date = new Date(dateString);
    var normalized =
        date.getFullYear() + '' + ('0' + (date.getMonth() + 1)).slice(-2) + '' + ('0' + date.getDate()).slice(-2);
    return normalized;
};
// Advanced Search Functions Ends
$.fn.z_datatable = function (options) {
    var settings = $.extend({
        filter: false,
        url: '',
        columns: [],
        paginate: false,
        order_col: 0,
        order_dir: 'desc',
        form_el: '.filter-form',
        button_filter: '.btn-filter',
        button_reset: '.btn-reset',

    }, options);
    // enble rtl
    var isRtl = $('html').attr('data-textdirection') === 'rtl';
    var $this = this;
    var datatable;
    if (this.length) {
        datatable = this.DataTable({
            "processing": true,
            serverSide: true,
            columns: settings.columns,
            "searching": false,
            lengthChange: false,
            order: [[settings.order_col, settings.order_dir]],
            ajax: {
                url: settings.url,
                data: function (d) {

                    $(settings.form_el + ' input, ' + settings.form_el + ' select').each(
                        function (index, obj) {
                            let input_name = $(obj).attr('name');
                            d[input_name] = $(obj).val();
                        }
                    );
                }
            },
            columnDefs: [
                {
                    className: 'control',
                    orderable: true,
                    targets: 0
                },
                {
                    // Label
                    targets: -1,
                    render: function (data, type, full, meta) {
                        var $status_number = full['status'];
                        var $status = {
                            1: { title: 'Current', class: 'badge-light-primary' },
                            2: { title: 'Professional', class: ' badge-light-success' },
                            3: { title: 'Rejected', class: ' badge-light-danger' },
                            4: { title: 'Resigned', class: ' badge-light-warning' },
                            5: { title: 'Applied', class: ' badge-light-info' }
                        };
                        if (typeof $status[$status_number] === 'undefined') {
                            return data;
                        }
                        return (
                            '<span class="badge rounded-pill ' +
                            $status[$status_number].class +
                            '">' +
                            $status[$status_number].title +
                            '</span>'
                        );
                    }
                }
            ],
            dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            orderCellsTop: true,

            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return 'Details of ' + data['full_name'];
                        }
                    }),
                    type: 'column',
                    renderer: function (api, rowIdx, columns) {
                        var data = $.map(columns, function (col, i) {
                            return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                                ? '<tr data-dt-row="' +
                                col.rowIdx +
                                '" data-dt-column="' +
                                col.columnIndex +
                                '">' +
                                '<td>' +
                                col.title +
                                ':' +
                                '</td> ' +
                                '<td>' +
                                col.data +
                                '</td>' +
                                '</tr>'
                                : '';
                        }).join('');

                        return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
                    }
                }
            },
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            drawCallback: function (settings) {
                feather.replace();
            }
        });
        // click filter button
        $(document).on('click', settings.button_filter, function () {
            datatable.draw();
        })
        $(document).on("click", settings.button_reset, function () {
            $(settings.form_el).trigger('reset');
            datatable.draw();
        })
        return datatable;
    }
}
// Responsive Table
// --------------------------------------------------------------------



// Filter form control to default size for all tables
$('.dataTables_filter .form-control').removeClass('form-control-sm');
$('.dataTables_length .form-select').removeClass('form-select-sm').removeClass('form-control-sm');
