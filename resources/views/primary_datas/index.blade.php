@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Primary Datas</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('primaryDatas.create') }}">
                        Add New
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        {{-- This is for flash messages --}}
        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            @include('primary_datas.table')
        </div>
    </div>

@endsection

{{-- SweetAlert2 CDN + Script --}}
@push('scripts')
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: @json(session('success')),
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
            });
        </script>
    @endif





    <script>
        // pdfMake.fonts = {
        //     Amiri: {
        //         normal: 'https://cdnjs.cloudflare.com/ajax/libs/amiri/0.111/amiri-regular.ttf',
        //         bold: 'https://cdnjs.cloudflare.com/ajax/libs/amiri/0.111/amiri-bold.ttf',
        //         italics: 'https://cdnjs.cloudflare.com/ajax/libs/amiri/0.111/amiri-slanted.ttf',
        //         bolditalics: 'https://cdnjs.cloudflare.com/ajax/libs/amiri/0.111/amiri-boldslanted.ttf'
        //     }
        // };
    $(document).ready(function () {
    let table = $('#primary-datas-table').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        pageLength: 10, // Default rows per page
        lengthMenu: [ [5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "الكل"] ],
        buttons: [
            {
                extend: 'copyHtml5',
                className: 'btn btn-secondary'
            },
            {
                extend: 'excelHtml5',
                className: 'btn btn-success',
                title: 'تصدير إلى Excel'
            },
            {
                extend: 'pdfHtml5',
                className: 'btn btn-danger',
                title: 'تصدير إلى PDF',
                orientation: 'landscape',
                pageSize: 'A4'

                // extend: 'pdfHtml5',
                // className: 'btn btn-danger',
                // title: 'تقرير',
                // orientation: 'landscape',
                // pageSize: 'A4',
                // customize: function (doc) {
                //     doc.defaultStyle = {
                //         font: 'Arial',
                //         alignment: 'center'
                //     };
                // }
            },
            {
                text: 'تصدير إلى Word',
                className: 'btn btn-primary',
                action: function (e, dt, node, config) {
                    exportTableToWord('primary-datas-table', 'تقرير');
                }
            },
            {
                extend: 'print',
                className: 'btn btn-info'
            },
            {
                extend: 'colvis',
                className: 'btn btn-dark',
                text: 'عرض الأعمدة'
            }
        ],
        language: {
            search: "بحث:",
            lengthMenu: "عرض _MENU_ صفوف في كل صفحة",  // This updates the label for the dropdown
            info: "عرض _START_ إلى _END_ من أصل _TOTAL_ صف",
            paginate: {
                first: "الأول",
                last: "الأخير",
                next: "التالي",
                previous: "السابق"
            }
        }
    });
});

// Word Export Function
function exportTableToWord(tableID, filename = '') {
    const table = document.getElementById(tableID).cloneNode(true);

    // Add inline styles to table for Word export
    table.style.width = '100%';
    table.style.borderCollapse = 'collapse';
    table.style.tableLayout = 'fixed';

    for (const row of table.rows) {
        for (const cell of row.cells) {
            cell.style.border = '1px solid #000';
            cell.style.padding = '5px';
            cell.style.textAlign = 'center';
            cell.style.wordWrap = 'break-word';
            cell.style.whiteSpace = 'nowrap';
        }
    }

    const html =
    `<html xmlns:o='urn:schemas-microsoft-com:office:office' ` +
    `xmlns:w='urn:schemas-microsoft-com:office:word' ` +
    `xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export</title>` +
    `<style>
        @page { size: A4 landscape; margin: 1cm }
        table { table-layout: fixed; width: 100%; border-collapse: collapse; word-wrap: break-word; }
        td, th { word-wrap: break-word; border: 1px solid #000; padding: 5px; text-align: center; }
    </style></head><body>` +
    table.outerHTML + `</body></html>`;


    const blob = new Blob(['\ufeff', html], { type: 'application/msword' });
    const url = URL.createObjectURL(blob);

    const link = document.createElement('a');
    link.href = url;
    link.download = filename ? filename + '.doc' : 'document.doc';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
}

</script>

@endpush
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
@endpush

