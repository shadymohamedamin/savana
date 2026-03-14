<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="owner-requirment-tender-totals-table">
            <thead>
            <tr>
                <th>Project Id</th>
                <th>Owner Requirement Id</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
                <th>Notes</th>
                <th>Context</th>
                <th>Tender User Id</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ownerRequirmentTenderTotals as $ownerRequirmentTenderTotal)
                <tr>
                    <td>{{ $ownerRequirmentTenderTotal->project_id }}</td>
                    <td>{{ $ownerRequirmentTenderTotal->owner_requirement_id }}</td>
                    <td>{{ $ownerRequirmentTenderTotal->quantity }}</td>
                    <td>{{ $ownerRequirmentTenderTotal->unit_price }}</td>
                    <td>{{ $ownerRequirmentTenderTotal->total_price }}</td>
                    <td>{{ $ownerRequirmentTenderTotal->notes }}</td>
                    <td>{{ $ownerRequirmentTenderTotal->context }}</td>
                    <td>{{ $ownerRequirmentTenderTotal->tender_user_id }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['ownerRequirmentTenderTotals.destroy', $ownerRequirmentTenderTotal->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('ownerRequirmentTenderTotals.show', [$ownerRequirmentTenderTotal->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('ownerRequirmentTenderTotals.edit', [$ownerRequirmentTenderTotal->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $ownerRequirmentTenderTotals])
        </div>
    </div>
</div>
