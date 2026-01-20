<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="project-payments-table">
            <thead>
            <tr>
                <th>Project Id</th>
                <th>Payment No</th>
                <th>Payer Type</th>
                <th>Total Amount</th>
                <th>Vat Amount</th>
                <th>Net Amount</th>
                <th>Payment Date</th>
                <th>Attachment</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projectPayments as $projectPayment)
                <tr>
                    <td>{{ $projectPayment->project_id }}</td>
                    <td>{{ $projectPayment->payment_no }}</td>
                    <td>{{ $projectPayment->payer_type }}</td>
                    <td>{{ $projectPayment->total_amount }}</td>
                    <td>{{ $projectPayment->vat_amount }}</td>
                    <td>{{ $projectPayment->net_amount }}</td>
                    <td>{{ $projectPayment->payment_date }}</td>
                    <td>{{ $projectPayment->attachment }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['projectPayments.destroy', $projectPayment->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('projectPayments.show', [$projectPayment->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('projectPayments.edit', [$projectPayment->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $projectPayments])
        </div>
    </div>
</div>
