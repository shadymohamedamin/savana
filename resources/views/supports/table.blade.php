<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="supports-table">
            <thead>
            <tr>
                <th>Dat</th>
                <th>Caseid</th>
                <th>Supportrequiredarch</th>
                <th>Supporttype</th>
                <th>Needِamount</th>
                <th>Supportamount</th>
                <th>Note</th>
                <th>Salaryarch</th>
                <th>Incomearch</th>
                <th>Wifesalaryarch</th>
                <th>Offlinesalaryarch</th>
                <th>Socialsalaryarch</th>
                <th>Othersalaryarch</th>
                <th>Childreninarch</th>
                <th>Loanarch</th>
                <th>Rentarch</th>
                <th>Driverarch</th>
                <th>Feesarch</th>
                <th>Servantarch</th>
                <th>Elewaterarch</th>
                <th>Housearch</th>
                <th>Bankarch</th>
                <th>Furnaturearch</th>
                <th>Cararch</th>
                <th>Courtarch</th>
                <th>Childrenoutarch</th>
                <th>Searcherarch</th>
                <th>Casedescription</th>
                <th>Application Date</th>
                <th>Appremarks</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($supports as $support)
                <tr>
                    <td>{{ $support->Dat }}</td>
                    <td>{{ $support->CaseID }}</td>
                    <td>{{ $support->SupportRequiredArch }}</td>
                    <td>{{ $support->SupportType }}</td>
                    <td>{{ $support->NeedِAmount }}</td>
                    <td>{{ $support->SupportAmount }}</td>
                    <td>{{ $support->Note }}</td>
                    <td>{{ $support->SalaryArch }}</td>
                    <td>{{ $support->IncomeArch }}</td>
                    <td>{{ $support->WifeSalaryArch }}</td>
                    <td>{{ $support->OfflineSalaryArch }}</td>
                    <td>{{ $support->SocialSalaryArch }}</td>
                    <td>{{ $support->OtherSalaryArch }}</td>
                    <td>{{ $support->ChildrenInArch }}</td>
                    <td>{{ $support->LoanArch }}</td>
                    <td>{{ $support->RentArch }}</td>
                    <td>{{ $support->DriverArch }}</td>
                    <td>{{ $support->FeesArch }}</td>
                    <td>{{ $support->ServantArch }}</td>
                    <td>{{ $support->EleWaterArch }}</td>
                    <td>{{ $support->HouseArch }}</td>
                    <td>{{ $support->BankArch }}</td>
                    <td>{{ $support->FurnatureArch }}</td>
                    <td>{{ $support->CarArch }}</td>
                    <td>{{ $support->CourtArch }}</td>
                    <td>{{ $support->ChildrenOutArch }}</td>
                    <td>{{ $support->SearcherArch }}</td>
                    <td>{{ $support->CaseDescription }}</td>
                    <td>{{ $support->Application_Date }}</td>
                    <td>{{ $support->AppRemarks }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['supports.destroy', $support->ID], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('supports.show', [$support->ID]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('supports.edit', [$support->ID]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $supports])
        </div>
    </div>
</div>
