<div class="container mt-4">
    {{-- Personal Info --}}
    <div class="card mb-4 border-primary shadow-sm">
        <div class="card-header bg-primary text-white">
            <strong>Personal Information</strong>
        </div>
        <div class="card-body row">
            <div class="col-md-6 mb-3"><strong>Name:</strong> {{ $primaryData->Nam }}</div>
            <div class="col-md-6 mb-3"><strong>English Name:</strong> {{ $primaryData->NamEn }}</div>
            <div class="col-md-6 mb-3"><strong>Date of Birth:</strong> {{ $primaryData->DateOfBirth }}</div>
            <div class="col-md-6 mb-3"><strong>Sex:</strong> {{ $primaryData->sex?->Sex ?? 'N/A' }}</div>
            <div class="col-md-6 mb-3"><strong>Nationality:</strong> {{ $primaryData->nationality?->Nationality ?? 'N/A' }}</div>
            <div class="col-md-6 mb-3"><strong>Marital Status:</strong> {{ $primaryData->maritalStatus?->MaritalStatus ?? 'N/A' }}</div>
            <div class="col-md-6 mb-3"><strong>Family Count:</strong> {{ $primaryData->FamilyCount }}</div>
        </div>
    </div>

    {{-- Contact Info --}}
    <div class="card mb-4 border-success shadow-sm">
        <div class="card-header bg-success text-white">
            <strong>Contact Information</strong>
        </div>
        <div class="card-body row">
            <div class="col-md-6 mb-3"><strong>Email:</strong> {{ $primaryData->Email }}</div>
            <div class="col-md-6 mb-3"><strong>Mobile:</strong> {{ $primaryData->mob }}</div>
            <div class="col-md-6 mb-3"><strong>Telephone 1:</strong> {{ $primaryData->Tel1 }}</div>
            <div class="col-md-6 mb-3"><strong>Telephone 2:</strong> {{ $primaryData->Tel2 }}</div>
        </div>
    </div>

    {{-- Spouse Info --}}
    <div class="card mb-4 border-warning shadow-sm">
        <div class="card-header bg-warning text-dark">
            <strong>Spouse Information</strong>
        </div>
        <div class="card-body row">
            <div class="col-md-6 mb-3"><strong>Wife Name:</strong> {{ $primaryData->WifeName }}</div>
            <div class="col-md-6 mb-3"><strong>Wife Career:</strong> {{ $primaryData->wifecareer?->Career ?? 'N/A' }}</div>
            <div class="col-md-6 mb-3"><strong>Wife Address:</strong> {{ $primaryData->WifeAddress }}</div>
            <div class="col-md-6 mb-3"><strong>Wife Nationality:</strong> {{ $primaryData->wifenationality?->Nationality ?? 'N/A' }}</div>
        </div>
    </div>

    {{-- Location Info --}}
    <div class="card mb-4 border-info shadow-sm">
        <div class="card-header bg-info text-white">
            <strong>Location & Region</strong>
        </div>
        <div class="card-body row">
            <div class="col-md-6 mb-3"><strong>Region:</strong> {{ $primaryData->region?->Region ?? 'N/A' }}</div>
            <div class="col-md-6 mb-3"><strong>House Type:</strong> {{ $primaryData->housetype?->HouseType ?? 'N/A' }}</div>
            <div class="col-md-6 mb-3"><strong>Address (Career):</strong> {{ $primaryData->CareerAddress }}</div>
        </div>
    </div>

    {{-- Career Info --}}
    <div class="card mb-4 border-secondary shadow-sm">
        <div class="card-header bg-secondary text-white">
            <strong>Career Details</strong>
        </div>
        <div class="card-body row">
            <div class="col-md-6 mb-3"><strong>Career:</strong> {{ $primaryData->career?->Career ?? 'N/A' }}</div>
            <div class="col-md-6 mb-3"><strong>In School:</strong> {{ $primaryData->InSchool }}</div>
        </div>
    </div>

    {{-- Government Info --}}
    <div class="card mb-4 border-danger shadow-sm">
        <div class="card-header bg-danger text-white">
            <strong>Official Details</strong>
        </div>
        <div class="card-body row">
            <div class="col-md-6 mb-3"><strong>File Number:</strong> {{ $primaryData->FileNo }}</div>
            <div class="col-md-6 mb-3"><strong>ID Number:</strong> {{ $primaryData->IDNo }}</div>
            <div class="col-md-6 mb-3"><strong>ID Expiry:</strong> {{ $primaryData->IDExpiry }}</div>
            <div class="col-md-6 mb-3"><strong>IBAN:</strong> {{ $primaryData->IBAN }}</div>
            <div class="col-md-6 mb-3"><strong>Permission Number:</strong> {{ $primaryData->Permission_No }}</div>
            <div class="col-md-6 mb-3"><strong>Permission Date:</strong> {{ $primaryData->Permission_Date }}</div>
            <div class="col-md-6 mb-3"><strong>Renew Date:</strong> {{ $primaryData->Renew_Date }}</div>
        </div>
    </div>

    {{-- Administration Info --}}
    <div class="card mb-4 border-dark shadow-sm">
        <div class="card-header bg-dark text-white">
            <strong>Administrative Details</strong>
        </div>
        <div class="card-body row">
            <div class="col-md-6 mb-3"><strong>Approved:</strong> {{ $primaryData->Approved == 1 ? 'yes':'no'}}</div>
            <div class="col-md-6 mb-3"><strong>Cancelled:</strong> {{ $primaryData->Cancel == 1 ? 'yes':'no'}}</div>
            <div class="col-md-6 mb-3"><strong>Revised:</strong> {{ $primaryData->Revised == 1 ? 'yes':'no'}}</div>
            <div class="col-md-6 mb-3"><strong>Section:</strong> {{ $primaryData->Section == 1 ? 'مواطن':'وافد'}}</div>
            <div class="col-md-6 mb-3"><strong>Case Date:</strong> {{ $primaryData->CaseDate }}</div>
            <div class="col-md-6 mb-3"><strong>Head Remarks:</strong> {{ $primaryData->HeadRemarks }}</div>
            <div class="col-md-6 mb-3"><strong>Accommodation:</strong> {{ $primaryData->Accomodation == 1 ? 'yes':'no'}}</div>
            <div class="col-md-6 mb-3"><strong>Trustee:</strong> {{ $primaryData->Trustee }}</div>
            <div class="col-md-6 mb-3"><strong>Trustee EN:</strong> {{ $primaryData->TrusteeEn }}</div>
            <div class="col-md-6 mb-3"><strong>Last Update:</strong> {{ $primaryData->LastUpdate }}</div>
            <div class="col-md-6 mb-3"><strong>Added By:</strong> {{ $primaryData->userAdd?->name ?? 'N/A' }}</div>
            <div class="col-md-6 mb-3"><strong>Edited By:</strong> {{ $primaryData->userEdit?->name ?? 'N/A' }}</div>
        </div>
    </div>
</div> 