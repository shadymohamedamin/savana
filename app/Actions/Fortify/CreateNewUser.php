<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    /*
    
    
    {{-- Income Section --}}
        <!-- <div class="col-md-12 mb-4">
            <div class="card border-success shadow-sm">
                <div class="card-header bg-success text-white">Income</div>
                <div class="card-body row g-3">
                    @foreach ([
                        'SalaryArch' => 'Salary',
                        'IncomeArch' => 'Income',
                        'WifeSalaryArch' => 'Wife Salary',
                        'OfflineSalaryArch' => 'Offline Salary',
                        'SocialSalaryArch' => 'Social Salary',
                        'OtherSalaryArch' => 'Other Salary',
                        'ChildrenInArch' => 'Children Income',
                    ] as $field => $label)
                        <div class="col-md-4">
                            {!! Form::label($field, $label) !!}
                            {!! Form::number($field, null, [
                                'class' => 'form-control' . ($errors->has($field) ? ' is-invalid' : '')
                            ]) !!}
                            @error($field) <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    @endforeach
                </div>
            </div>
        </div> -->

        {{-- Outcome Section --}}
        <!-- <div class="col-md-12 mb-4">
            <div class="card border-danger shadow-sm">
                <div class="card-header bg-danger text-white">Outcome</div>
                <div class="card-body row g-3">
                    @foreach ([
                        'LoanArch' => 'Loan',
                        'RentArch' => 'Rent',
                        'DriverArch' => 'Driver',
                        'FeesArch' => 'Fees',
                        'ServantArch' => 'Servant',
                        'EleWaterArch' => 'Electricity & Water',
                        'HouseArch' => 'House',
                        'BankArch' => 'Bank',
                        'FurnatureArch' => 'Furniture',
                        'CarArch' => 'Car',
                        'CourtArch' => 'Court',
                        'ChildrenOutArch' => 'Children Expenses',
                    ] as $field => $label)
                        <div class="col-md-4">
                            {!! Form::label($field, $label) !!}
                            {!! Form::number($field, null, [
                                'class' => 'form-control' . ($errors->has($field) ? ' is-invalid' : '')
                            ]) !!}
                            @error($field) <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    @endforeach
                </div>
            </div>
        </div> -->
    
    
    */
    public function create(array $input): User
    {
        //dd($input); // Debugging line, remove in production
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'uae_id' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'uae_id' => $input['uae_id'],
            'mobile' => $input['mobile'],
            'password' => Hash::make($input['password']),
            'RoleID' => 6,
            'Active' => true,
            'is_admin' => false,
            'role' => 'public_user',
            'sex' => $input['sex'],
        ]);
    }
}
