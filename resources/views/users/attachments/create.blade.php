@extends('layouts.app')

@section('content')


<style>
    .attachment-complete {
        background-color: #e6fffa !important; /* أخضر فاتح */
        border-left: 5px solid #198754; /* Bootstrap green */
    }

    .attachment-pending {
        background-color: #fff3cd !important; /* أصفر */
    }


    .btn-olive {
        background-color:#d4af37 ;   /*#2f3a1f زيتوني غامق */
        border: 1px solid #2f3a1f;
        color: #2f3a1f;              /* ذهبي */
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-olive:hover {
        background-color: #3e4a29;  /* زيتوني أفتح */
        border-color: #d4af37;       /* إطار ذهبي */
        color: #fff;                /* أبيض أنيق */
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(212,175,55,0.35);
    }
    .buttons_container{
        padding-bottom: 4rem;
    }


    .attachment-box input[type="file"] {
    font-size: 13px;
}

.attachment-box .btn {
    padding: 2px 8px;
    font-size: 12px;
}

.selected-file-name {
    font-size: 12px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}



/* container */

.contract-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
    gap:16px;
    background:#f5f5dc;
    padding:15px;
}

/* box */

.contract-box{
    background:white;
    border:1px solid #e5e5e5;
    border-radius:10px;
    padding:15px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    min-height:170px;
    box-shadow:0 2px 6px rgba(0,0,0,0.05);
    transition:0.2s;
}
.edit-btn{
    background: linear-gradient(45deg,#ff9800,#ff5722);
    border: none;
    color: #fff;
    font-weight: bold;
    padding: 6px 14px;
    border-radius: 6px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.25);
    transition: all 0.2s ease;
}

.edit-btn:hover{
    transform: scale(1.05);
    box-shadow: 0 5px 12px rgba(0,0,0,0.35);
}
/* hover */

.contract-box:hover{
    transform:translateY(-2px);
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
}

/* title */

.contract-box span{
    font-weight:600;
    font-size:14px;
    text-align:center;
    margin-bottom:10px;
}

/* buttons */

.contract-box .btn{
    width:100%;
}

</style>
@php
    $type = request('type');
    $isTender = request('mode') === 'tender';
    $isCotractorFiles=request('mode') === 'contractor_files';
    $projectDocuments=request('mode') === 'project_documents';
    $mode=request('mode');
    
@endphp

@php
    $isEdit = isset($attachments) && $attachments->count() > 0;
@endphp


<div class="container" style="background-color: #f5f5dc;">
    <!-- <h3>{{ __('Manage Attachments for') }}: {{ $model->name }}</h3> -->


@if (in_array(auth()->user()->role_id, [1,4,11,12]))
    <div></div>
    <!-- <h3>
        {{ $isEdit ? __('Edit Attachments for') : __('Manage Attachments for') }}
        : {{ $model->name }}
    </h3> -->
@else <h3>
        {{-- المناقصة --}}
    </h3>
@endif
    @include('flash::message')

   



    <!-- @if($type === 'projects')
        <div class="card mb-4">
            <div class="card-header text-white" style="background:#d4af37">
                {{ __('Standard Templates') }}
            </div>

            <div class="card-body" style="background-color: #f5f5dc;">
                <ul>
                    <li>
                        <a href="{{ route('projects.contract.download', $model->id) }}" target="_blank">
                            📄 عقد الاتفاق (PDF)
                        </a>
                    </li>
                    <li><a href="{{ asset('templates/assignment.pdf') }}" download>خطاب التكليف</a></li>
                    <li><a href="{{ asset('templates/form.pdf') }}" download>فورم الفيزا</a></li>
                </ul>
            </div>
        </div>
    @endif -->





@if($type === 'projects')




    @include('projects.partials.project-actions', ['project' => $model])

<div class="card mb-4">
    <!-- <div class="card-header text-white" style="background:#d4af37">
        {{ __('Standard Templates') }}
    </div> -->






    <div class="card-header    d-flex justify-content-between align-items-center" style="background:#d4af37">
        <span style="font-weight: 700;">{{ __('معاينة وطباعة المستندات ') }}</span>
  

        @if($isTender&&in_array(Auth::user()->role_id, [1,4,11,12]))
        <div class="flex justify-start" style="gap: 1rem;">
            
            <a href="{{ route('projects.tender.contractors', $model->id) }}"
                class="btn btn-olive px-4 btn-sm"  
                style="background:#d4af37;color:#2f3a1f;font-weight: 700; margin-right: 1rem;">
                    <i class="fas fa-users"></i> المقاولين المرشحين
            </a>
            <a href="{{ route('projects.owner-requirements.index', [$model, 'context' => 'pricing']) }}"
                class="btn btn-olive px-4 btn-sm"
                style="background:#d4af37;color:#2f3a1f;font-weight: 700;margin-right: 1rem;">
                    <i class="fas fa-file-signature"></i> أسعار توريد التشطيبات
            </a>


            {{-- <a href="{{ route('projects.owner-requirements.index', [$model, 'context' => 'tender']) }}"
                class="btn btn-olive px-4 btn-sm"
                style="background:#d4af37;color:#2f3a1f;font-weight: 700;margin-right: 1rem;">
                    <i class="fas fa-file-signature"></i> حساب الكميات
            </a> --}}
        </div>
        @elseif(!$isCotractorFiles&&!$projectDocuments&&$type='projects'&&in_array(Auth::user()->role_id, [1,4,11,12]))
        <a href="{{ route('projects.owner-requirements.index', ['project' => $model->id]) }}" class="btn btn-olive px-4 btn-sm"
                style="background:#d4af37;color:#2f3a1f; font-weight: 700;margin-right: 1rem;">
                <i class="fas fa-clipboard-list"></i>
                احتياجات المالك
            </a>
        @endif

    </div>

 





    <div class="card-body contract-grid" style="background-color: #f5f5dc;">


        @if($isTender)

            <div class="contract-box">
                <span class="mb-1">{{ __('العقد الاساسي') }}</span>
                <a target="_blank" href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                    👁 {{ __('Preview') }}
                </a>
                <a href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                    ⬇ {{ __('Download') }}
                </a>
                <a target="_blank" href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                    🖨 {{ __('Print') }}
                </a>
            </div>



           <div class="contract-box">
                <span class="mb-1">{{ __('المواصفات الفنية والشروط العامة') }}</span>

                <a target="_blank"
                href="{{ route('projects.contract.specs.pdf', ['id' => $model->id, 'action' => 'preview']) }}"
                class="btn btn-outline-primary btn-sm mb-1">
                    👁 {{ __('Preview') }}
                </a>

                <a href="{{ route('projects.contract.specs.pdf', ['id' => $model->id, 'action' => 'download']) }}"
                class="btn btn-success btn-sm mb-1">
                    ⬇ {{ __('Download') }}
                </a>

                <a target="_blank"
                href="{{ route('projects.contract.specs.pdf', ['id' => $model->id, 'action' => 'print']) }}"
                class="btn btn-warning btn-sm">
                    🖨 {{ __('Print') }}
                </a>
            </div>


            <div class="contract-box">
                <span class="mb-1">{{ __('اسعار التوريد') }}</span>

                <a target="_blank" href="{{ route('projects.contract.pricing.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                    👁 {{ __('Preview') }}
                </a>

                <a href="{{ route('projects.contract.pricing.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                    ⬇ {{ __('Download') }}
                </a>

                <a target="_blank" href="{{ route('projects.contract.pricing.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                    🖨 {{ __('Print') }}
                </a>
            </div>


            <div class="contract-box">
                <span class="mb-1">{{ __(' حساب الكميات') }}</span>


                @if(in_array(Auth::user()->role_id, [1,4,11,12]))
                <a target="_blank" href="{{ route('projects.contract.tender.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                    👁 {{ __('Preview') }}
                </a>

                <a href="{{ route('projects.contract.tender.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                    ⬇ {{ __('Download') }}
                </a>

                <a target="_blank" href="{{ route('projects.contract.tender.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                    🖨 {{ __('Print') }}
                </a>
                @elseif(Auth::user()->role_id==3)
                <a href="{{ route('projects.owner-requirements.index', [
                        'project'=>$model->id,
                        'context'=>'tender',
                        'contractor'=>Auth::user()->id
                    ]) }}" 
                class="btn btn-warning btn-sm mb-1 edit-btn">
                ✏️ {{ __('تعديل') }}
                </a>

                 <a target="_blank" href="{{ route('projects.contract.tender.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                    👁 {{ __('معاينة') }}
                </a>

                <a href="{{ route('projects.contract.tender.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                    🖨 {{ __('تحميل') }}
                </a>
                @endif
            </div>
<!-- !in_array(auth()->user()->role_id, [1,4,11,12]) && -->
            @if($isTender) 
                @foreach($rows as $row)
                    @php
                        $typeId = $row['type_id'];
                        $att = $row['attachment'];
                        //dd($row);
                    @endphp
                    <div class="contract-box">
                        
                    
                        <span class="mb-2 fw-bold">
                                    {{ $attTypes[$typeId] ?? 'File '.$typeId }}
                                </span>

                                @if($att)
                                <a target="_blank"
                                href="{{ asset($att->web_path) }}"
                                class="btn btn-outline-primary btn-sm mb-1">
                                    👁 معاينة
                                </a>

                                <a href="{{ asset($att->web_path) }}"
                                class="btn btn-success btn-sm mb-1">
                                    ⬇ تعديل
                                </a>

                                <a target="_blank"
                                href="{{ asset($att->web_path) }}"
                                class="btn btn-warning btn-sm">
                                    🖨 طباعة
                                </a>
                                @else <div>غير موجود</div>
                                @endif
                    </div>
                @endforeach


            @endif

                    <!-- @if(!in_array(auth()->user()->role_id, [1,4,11,12]) && $isTender)

                    <div class="card-body d-flex flex-wrap gap-4" style="background:#f5f5dc">

                        @foreach($rows as $row)
                            @php
                                $typeId = $row['type_id'];
                                $att = $row['attachment'];
                                //dd($row);
                            @endphp

                            <div class="d-flex flex-column border p-3 rounded bg-light" style="min-width:200px">

                                <span class="mb-2 fw-bold">
                                    {{ $attTypes[$typeId] ?? 'File '.$typeId }}
                                </span>

                                @if($att)
                                <a target="_blank"
                                href="{{ asset($att->web_path) }}"
                                class="btn btn-outline-primary btn-sm mb-1">
                                    👁 Preview
                                </a>

                                <a href="{{ asset($att->web_path) }}"
                                class="btn btn-success btn-sm mb-1">
                                    ⬇ Download
                                </a>

                                <a target="_blank"
                                href="{{ asset($att->web_path) }}"
                                class="btn btn-warning btn-sm">
                                    🖨 Print
                                </a>
                                @else <div>غير موجود</div>
                                @endif

                            </div>
                        @endforeach

                    </div>

                    @endif -->

        @elseif($isCotractorFiles)
            <div class="contract-box">
                <span class="mb-1">{{ __('العقد الاساسي') }}</span>
                <a target="_blank" href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                    👁 {{ __('Preview') }}
                </a>
                <a href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                    ⬇ {{ __('Download') }}
                </a>
                <a target="_blank" href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                    🖨 {{ __('Print') }}
                </a>
            </div>



            <div class="contract-box">
                <span class="mb-1">{{ __('المواصفات الفنية والشروط العامة') }}</span>

                <a target="_blank"
                href="{{ route('projects.contract.specs.pdf', ['id' => $model->id, 'action' => 'preview']) }}"
                class="btn btn-outline-primary btn-sm mb-1">
                    👁 {{ __('Preview') }}
                </a>

                <a href="{{ route('projects.contract.specs.pdf', ['id' => $model->id, 'action' => 'download']) }}"
                class="btn btn-success btn-sm mb-1">
                    ⬇ {{ __('Download') }}
                </a>

                <a target="_blank"
                href="{{ route('projects.contract.specs.pdf', ['id' => $model->id, 'action' => 'print']) }}"
                class="btn btn-warning btn-sm">
                    🖨 {{ __('Print') }}
                </a>
            </div>


            <div class="contract-box">
                <span class="mb-1">{{ __('اسعار التوريد') }}</span>

                <a target="_blank" href="{{ route('projects.contract.pricing.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                    👁 {{ __('Preview') }}
                </a>

                <a href="{{ route('projects.contract.pricing.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                    ⬇ {{ __('Download') }}
                </a>

                <a target="_blank" href="{{ route('projects.contract.pricing.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                    🖨 {{ __('Print') }}
                </a>
            </div>




            <div class="contract-box">
                <span class="mb-1">{{ __(' حساب الكميات') }}</span>

                <a target="_blank" href="{{ route('projects.contract.tender.pdf', [
    'id' => $model->id, 
    'action' => 'preview',
    'context'=>'tender',
    'contractor'=>$model->contractor_id
]) }}" class="btn btn-outline-primary btn-sm mb-1">
    👁 {{ __('Preview') }}
</a>

<a href="{{ route('projects.contract.tender.pdf', [
    'id' => $model->id, 
    'action' => 'download',
    'contractor'=>$model->contractor_id
]) }}" class="btn btn-success btn-sm mb-1">
    ⬇ {{ __('Download') }}
</a>

<a target="_blank" href="{{ route('projects.contract.tender.pdf', [
    'id' => $model->id, 
    'action' => 'print',
    'contractor'=>$model->contractor_id
]) }}" class="btn btn-warning btn-sm">
    🖨 {{ __('Print') }}
</a>
            </div>











                  {{-- Hawya Contract --}}
             <div class="contract-box">
                <span class="mb-1">{{ __('Hawya Contract') }}</span>

             <a target="_blank" href="{{ route('projects.contract.hawya.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                 👁 {{ __('Preview') }}
                </a>

            <a href="{{ route('projects.contract.hawya.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                ⬇ {{ __('Download') }}
            </a>

            <a target="_blank" href="{{ route('projects.contract.hawya.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                🖨 {{ __('Print') }}
            </a>
            </div> 



        
            <div class="contract-box">
            <span class="mb-1">{{ __('Site Delivery Contract') }}</span>

            <a target="_blank" href="{{ route('projects.contract.site_delivery.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                👁 {{ __('Preview') }}
            </a>

            <a href="{{ route('projects.contract.site_delivery.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                ⬇ {{ __('Download') }}
            </a>

            <a target="_blank" href="{{ route('projects.contract.site_delivery.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                🖨 {{ __('Print') }}
            </a>
            </div>





            <div class="contract-box">
            <span class="mb-1">{{ __('Bank Contract') }}</span>

            <a target="_blank" href="{{ route('projects.contract.bank.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                👁 {{ __('Preview') }}
            </a>

            <a href="{{ route('projects.contract.bank.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                ⬇ {{ __('Download') }}
            </a>

            <a target="_blank" href="{{ route('projects.contract.bank.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                🖨 {{ __('Print') }}
            </a>
            </div>







            <div class="contract-box">
            <span class="mb-1">{{ __('كميات البنك') }}</span>

            <a target="_blank" href="{{ route('projects.contract.bank_table.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                👁 {{ __('Preview') }}
            </a>

            <a href="{{ route('projects.contract.bank_table.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                ⬇ {{ __('Download') }}
            </a>

            <a target="_blank" href="{{ route('projects.contract.bank_table.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                🖨 {{ __('Print') }}
            </a>
            </div> 

            











            @foreach($rows as $row)
                    @php
                        $typeId = $row['type_id'];
                        $att = $row['attachment'];
                        //dd($row);
                    @endphp
                    <div class="contract-box">
                        
                    
                        <span class="mb-2 fw-bold">
                                    {{ $attTypes[$typeId] ?? 'File '.$typeId }}
                                </span>

                                @if($att)
                                <a target="_blank"
                                href="{{ asset($att->web_path) }}"
                                class="btn btn-outline-primary btn-sm mb-1">
                                    👁 معاينة
                                </a>

                                <a href="{{ asset($att->web_path) }}"
                                class="btn btn-success btn-sm mb-1">
                                    ⬇ تعديل
                                </a>

                                <a target="_blank"
                                href="{{ asset($att->web_path) }}"
                                class="btn btn-warning btn-sm">
                                    🖨 طباعة
                                </a>
                                @else <div>غير موجود</div>
                                @endif
                    </div>
                @endforeach



        @else
        
                {{--    Owner And Consultant Contract عقد المالك والاستشاري والمقاول --}}
                <!-- <div class="d-flex flex-column">
                    <span class="mb-1">{{ __('Owner And Consultant Contract') }}</span>
                    <a target="_blank" href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                        👁 {{ __('Preview') }}
                    </a>
                    <a href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                        ⬇ {{ __('Download') }}
                    </a>
                    <a target="_blank" href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                        🖨 {{ __('Print') }}
                    </a>
                </div>  -->

                {{-- عقد المالك والاستشاري --}}
                @if(!$projectDocuments)
                    <div class="contract-box">
                        <span class="mb-1">{{ __('Owner And Consultant And Contractor Contract') }}</span>
                        <a target="_blank" href="{{ route('projects.contract.owner_consultant.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                            👁 {{ __('Preview') }}
                        </a>
                        <a href="{{ route('projects.contract.owner_consultant.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                            ⬇ {{ __('Download') }}
                        </a>
                        <a target="_blank" href="{{ route('projects.contract.owner_consultant.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                            🖨 {{ __('Print') }}
                        </a>
                    </div>

                    {{-- خطاب التكليف --}}
                    <div class="contract-box">
                        <span class="mb-1">{{ __('Takleef Contract') }}</span>

                        <a target="_blank"
                        href="{{ route('projects.contract.takleef.pdf', ['id' => $model->id, 'action' => 'preview']) }}"
                        class="btn btn-outline-primary btn-sm mb-1">
                            👁 {{ __('Preview') }}
                        </a>

                        <a href="{{ route('projects.contract.takleef.pdf', ['id' => $model->id, 'action' => 'download']) }}"
                        class="btn btn-success btn-sm mb-1">
                            ⬇ {{ __('Download') }}
                        </a>

                        <a target="_blank"
                        href="{{ route('projects.contract.takleef.pdf', ['id' => $model->id, 'action' => 'print']) }}"
                        class="btn btn-warning btn-sm">
                            🖨 {{ __('Print') }}
                        </a>
                    </div>


                    <div class="contract-box">
                        <span class="mb-1">{{ __('احتياجات المالك') }}</span>

                        <a target="_blank" href="{{ route('projects.contract.owner-requirements.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                            👁 {{ __('Preview') }}
                        </a>

                        <a href="{{ route('projects.contract.owner-requirements.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                            ⬇ {{ __('Download') }}
                        </a>

                        <a target="_blank" href="{{ route('projects.contract.owner-requirements.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                            🖨 {{ __('Print') }}
                        </a>
                    </div>
                @endif








                @foreach($rows as $row)
                    @php
                        $typeId = $row['type_id'];
                        $att = $row['attachment'];
                        //dd($row);
                    @endphp
                    <div class="contract-box">
                        
                    
                        <span class="mb-2 fw-bold">
                                    {{ $attTypes[$typeId] ?? 'File '.$typeId }}
                                </span>

                                @if($att)
                                <a target="_blank"
                                href="{{ asset($att->web_path) }}"
                                class="btn btn-outline-primary btn-sm mb-1">
                                    👁 معاينة
                                </a>

                                <a href="{{ asset($att->web_path) }}"
                                class="btn btn-success btn-sm mb-1">
                                    ⬇ تعديل
                                </a>

                                <a target="_blank"
                                href="{{ asset($att->web_path) }}"
                                class="btn btn-warning btn-sm">
                                    🖨 طباعة
                                </a>
                                @else <div>غير موجود</div>
                                @endif
                    </div>
                @endforeach


          


                <!--{{-- فورم الفيوا --}}
                <div class="d-flex flex-column">
                    <span class="mb-1">{{ __('Fiwa Form') }}</span>
                    <a target="_blank" href="{{ route('projects.contract.owner_consultant.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                        👁 {{ __('Preview') }}
                    </a>
                    <a href="{{ route('projects.contract.owner_consultant.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                        ⬇ {{ __('Download') }}
                    </a>
                    <a target="_blank" href="{{ route('projects.contract.owner_consultant.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                        🖨 {{ __('Print') }}
                    </a>
                </div> -->
    @endif
       
    </div>
</div>
@endif




@if(in_array(auth()->user()->role_id, [3]))
<div style="border:2px solid #0d6efd; background:#f8fbff; padding:20px; border-radius:10px; margin-bottom:20px;">
    
    <h3 style="margin-bottom:15px; color:#0d6efd; text-align: center;">
        توضيح طريقة التسعير
    </h3>

    <ol style="line-height:1.9; padding-right:20px; font-size:17px;">
        
        <li>
            حرصًا من مكتب سافانا على التطوير المستمر وتحسين جودة خدماته، فقد تم اعتماد نظام المناقصات عبر السيستم الداخلي للمكتب، وذلك بهدف تنظيم العمل وتسهيل إجراءات الاطلاع والتسعير.
        </li>

        <li>
            بعد استلام المقاول اسم المستخدم وكلمة المرور الخاصة به، يمكنه الدخول إلى صفحة المناقصة عبر النظام، حيث ستظهر له جميع مستندات المناقصة.
        </li>

        <li>
            جميع المستندات متاحة للاطلاع والتحميل فقط، باستثناء مستند الكميات، حيث يكون متاحًا للتعديل.
        </li>

        <li>
            يقوم المقاول بالدخول إلى مستند الكميات، ويكون مخولًا بإدخال الاسعار و الكميات فقط، بالإضافة إلى إمكانية إضافة الملاحظات إن وجدت.
        </li>

        <li>
            بعد الانتهاء من إدخال الأسعار والملاحظات، يقوم المقاول بحفظ الملف، وبذلك تكون عملية التسعير قد اكتملت.
        </li>

        <li> يلتزم المقاول بالاطلاع الكامل والدقيق على جميع عناصر ومستندات المناقصة.</li>

    </ol>

</div>
@endif

@if(in_array(auth()->user()->role_id, [1,4,11,12]))
    {{-- Upload attachments --}}
    <form action="{{ route('users.attachments.store', ['id' => $model->id, 'type' => $type]) }}"
      method="POST"
      enctype="multipart/form-data">

    

<input type="hidden" name="type" value="{{ $type }}">

        @csrf

        <!-- <div class="alert alert-info text-right">
            <strong>{{ __('Instructions') }}:</strong><br>
            - {{ __('Maximum 10 files') }}.<br>
            - {{ __('Maximum 10 MB per file') }}.<br>
            - {{ __('Allowed types') }}: PDF, JPG, PNG.<br>
            - {{ __('You can add notes for each file') }}.<br>
            - {{ __('Click the X button to remove any attachment') }}.
        </div> -->


        <div class="card mb-4" style="background:#d4af37">
            <div class="card-header    d-flex justify-content-between align-items-center" style="background:#d4af37">
                <span>{{ __('Upload Attachments') }}</span>
                <button type="button" id="addAttachment" class="btn btn-olive px-4 btn-sm" style="font-weight: 700;">
                    {{ __('Add Attachment') }}
                </button>

            </div>
            
            <div class="card-body" id="attachmentContainer" style="background-color: #f5f5dc;">
                
            
                @foreach($rows as $i => $row)
                @php
                    $att = $row['attachment'];
                @endphp

                <div class="card mb-3 shadow-sm">
                    <div class="card-body row" style="background-color:#f5f5dc;">

                        {{-- existing attachment id --}}
                        @if($att)
                            <input type="hidden" name="attachments[{{ $i }}][id]" value="{{ $att->id }}">
                        @endif

                        {{-- type --}}
                        <div class="col-md-2">
                            <select name="attachments[{{ $i }}][attachment_type_id]" class="form-control">
                                @foreach($attTypes as $id => $name)
                                    <option value="{{ $id }}"
                                        {{ $row['type_id'] == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- file --}}
                        <div class="col-md-3">
                            <div class="border rounded p-2 small bg-light">

                                <input type="file"
                                    name="attachments[{{ $i }}][file]"
                                    class="form-control form-control-sm mb-1">
                                <input type="hidden"
                                            class="delete-flag"
                                            name="attachments[{{ $i }}][delete]"
                                            value="0">
                                @if($att)
                                    <div class="text-truncate">
                                        📄 {{ $att->file_name }}
                                    </div>

                                    @if(!empty($att->web_path))
                                        <a href="{{ asset($att->web_path) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-primary w-100 mt-1">
                                            👁 View
                                        </a>

                                        
                                        <button type="button" class="btn btn-danger removeAttachment">🗑</button>
                                    @endif
                                @else
                                    <div class="text-muted">
                                        {{ __('Not uploaded yet') }}
                                    </div>
                                @endif

                            </div>
                        </div>




                        

                        {{-- expiration --}}
                        <div class="col-md-3">
                            <input type="date"
                                name="attachments[{{ $i }}][expiration_date]"
                                value="{{ optional($att?->expiration_date)->format('Y-m-d') }}"
                                class="form-control">
                        </div>

                        {{-- notes --}}
                        <div class="col-md-3">
                            <input type="text"
                                name="attachments[{{ $i }}][notes]"
                                value="{{ $att->notes ?? '' }}"
                                placeholder="{{ __('Notes') }}"
                                class="form-control">
                        </div>

                        {{-- remove --}}
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger removeAttachment">X</button>
                        </div>

                    </div>
                </div>
                @endforeach

            
            
            
            
            
            
            
            
       
            </div>
        </div>

        <!-- <div class="text-center">
            <button type="submit" class="btn btn-success px-5">Save Attachments</button>
        </div> -->


        <div class="buttons_container text-center mt-4 d-flex justify-content-center gap-3">

            {{-- Save --}}
<button type="submit"
        name="action"
        value="save"
        class="btn btn-olive px-4">
    💾 {{ __('حفظ') }}
</button>

{{-- Show ONLY when type != projects --}}
@if ($type !== 'projects' && !$isAdminFiles)
    <button type="submit"
            name="action"
            value="save_create_project"
            class="btn btn-olive px-4">
        ➕ {{ __('Save & Create Project') }}
    </button>
@endif

{{-- Cancel Button --}}
<a href="{{ $type === 'projects'
            ? route('projects.index')
            : route('users.index') }}"
   class="btn btn-secondary px-4">
    ✖ {{ __('Cancel') }}
</a>



        </div>
    </form>

@endif
</div>
@endsection





@push('scripts')



<script>





document.addEventListener('click', function(e){

    if(e.target.classList.contains('removeAttachment')){

        const card = e.target.closest('.card');

        const deleteFlag = card.querySelector('.delete-flag');
        const idInput = card.querySelector('input[name*="[id]"]');

        if(idInput){

            deleteFlag.value = 1;

            card.style.opacity = "0.5";
            e.target.style.display = "none";

            const msg = document.createElement("div");
            msg.innerHTML = "File will be deleted after save";
            msg.style.color = "red";

            card.querySelector('.border').appendChild(msg);

        }else{
            card.remove();
        }

    }

});






document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.attachment-input').forEach(input => {

        input.addEventListener('change', function () {
            const file = this.files[0];
            const box = this.closest('.attachment-box');
            const fileNameEl = box.querySelector('.selected-file-name');
            const previewBtn = box.querySelector('.preview-file');
            const storedBtn = box.querySelector('.stored-file');

            if (!file) return;

            // show file name
            fileNameEl.textContent = file.name;
            fileNameEl.classList.remove('d-none');

            // hide stored file button if exists
            if (storedBtn) storedBtn.classList.add('d-none');

            // create temp url
            const fileURL = URL.createObjectURL(file);

            previewBtn.href = fileURL;
            previewBtn.classList.remove('d-none');
        });

    });

});
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.attachment-box').forEach(box => {

        const input      = box.querySelector('.attachment-input');
        const fileName   = box.querySelector('.selected-file-name');
        const previewBtn = box.querySelector('.preview-file');
        const storedBtn  = box.querySelector('.stored-file');
        const removeBtn  = box.querySelector('.remove-file');
        const deleteFlag = box.querySelector('.delete-flag');

        // when select file
        input?.addEventListener('change', function () {
            if (!this.files.length) return;

            const file = this.files[0];

            fileName.textContent = '📄 ' + file.name;
            fileName.classList.remove('d-none');

            const url = URL.createObjectURL(file);
            previewBtn.href = url;
            previewBtn.classList.remove('d-none');

            if (storedBtn) storedBtn.classList.add('d-none');
            deleteFlag.value = 0;
        });

        // remove file
        removeBtn?.addEventListener('click', function () {

            // clear input
            if (input) input.value = '';

            // hide preview + name
            previewBtn?.classList.add('d-none');
            fileName?.classList.add('d-none');

            // if there was stored file → mark delete
            if (storedBtn) {
                storedBtn.classList.add('d-none');
                deleteFlag.value = 1;
            }
        });

    });

});
</script>



<script>
let attachmentIndex = 3; // start after default 3
const maxAttachments = 10;
const maxSizeMB = 10;

// Add remove functionality
function addRemove(button) {
    button.addEventListener('click', function() {
        button.closest('.attachment-card').remove();
        attachmentIndex--;
    });
}

// Attach remove to default 3 cards
document.querySelectorAll('.removeAttachment').forEach(btn => addRemove(btn));

// Add new attachment dynamically
document.getElementById('addAttachment').addEventListener('click', function () {
    if (attachmentIndex >= maxAttachments) { alert("{{ __('Maximum 10 files') }}"); return; }

    const card = document.createElement('div');
    card.className = 'card mb-3 shadow-sm attachment-card';
    card.querySelector('.attachment-row')?.classList.add('attachment-pending');

    /*.innerHTML = `
        <div class="card-body row">
            <div class="form-group col-md-6">
                <label>File</label>
                <input type="file" name="attachments[${attachmentIndex}][file]" class="form-control attachment-file" required>
            </div>
            <div class="form-group col-md-5">
                <label>Notes</label>
                <input type="text" name="attachments[${attachmentIndex}][notes]" class="form-control">
            </div>
            <div class="form-group col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-danger removeAttachment">X</button>
            </div>
        </div>
    `;*/

//     card.innerHTML = `
// <div class="card-body row" style="background-color: #f5f5dc;">

//     <div class="form-group col-md-2">
//         <select name="attachments[${attachmentIndex}][attachment_type_id]" class="form-control" required>
//             <option value="">{{ __('-- Select Type --') }}</option>
//             @foreach($attTypes as $id => $name)
//                 <option value="{{ $id }}">{{ $name }}</option>
//             @endforeach
//         </select>
//     </div>

//     <div class="form-group col-md-3">

//         <div class="col-md-3">
//             <div class="border rounded p-2 small bg-light attachment-box">

//                 <input type="hidden"
//                     name="attachments[${attachmentIndex}][delete]"
//                     value="0"
//                     class="delete-flag">

//                 <input type="file"
//                     name="attachments[${attachmentIndex}][file]"
//                     class="form-control form-control-sm attachment-input mb-1">

//                 <div class="text-truncate selected-file-name d-none"></div>

//                 <a href="#"
//                     target="_blank"
//                     class="btn btn-sm btn-outline-success w-100 mt-1 preview-file d-none">
//                     👁 Preview
//                 </a>

//                 <button type="button"
//                     class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">
//                     🗑 Remove
//                 </button>

//             </div>
//         </div>

//     </div>

//     <div class="form-group col-md-3">
//         <input type="date"
//             name="attachments[${attachmentIndex}][expiration_date]"
//             class="form-control">
//     </div>

//     <div class="form-group col-md-3">
//         <input type="text"
//             name="attachments[${attachmentIndex}][notes]"
//             class="form-control"
//             placeholder="{{ __('Notes') }}">
//     </div>

//     <div class="form-group col-md-1 d-flex align-items-end">
//         <button type="button" class="btn btn-danger removeAttachment">X</button>
//     </div>
// </div>
// `;






card.innerHTML = `
<div class="card-body row" style="background-color: #f5f5dc;">

    <div class="form-group col-md-2">
        <select name="attachments[${attachmentIndex}][attachment_type_id]" class="form-control" required>
            <option value="">{{ __('-- Select Type --') }}</option>
            @foreach($attTypes as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <div class="border rounded p-2 small bg-light attachment-box">

            <input type="hidden"
                name="attachments[${attachmentIndex}][delete]"
                value="0"
                class="delete-flag">

            <input type="file"
                name="attachments[${attachmentIndex}][file]"
                class="form-control form-control-sm attachment-input mb-1">

            <div class="text-truncate selected-file-name d-none"></div>

            <a href="#"
                target="_blank"
                class="btn btn-sm btn-outline-success w-100 mt-1 preview-file d-none">
                👁 Preview
            </a>

            <button type="button"
                class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">
                🗑 Remove
            </button>
        </div>
    </div>

    <div class="form-group col-md-3">
        <input type="date"
            name="attachments[${attachmentIndex}][expiration_date]"
            class="form-control">
    </div>

    <div class="form-group col-md-3">
        <input type="text"
            name="attachments[${attachmentIndex}][notes]"
            class="form-control"
            placeholder="{{ __('Notes') }}">
    </div>

    <div class="form-group col-md-1 d-flex align-items-end">
        <button type="button" class="btn btn-danger removeAttachment">X</button>
    </div>

</div>
`;





document.getElementById('attachmentContainer').appendChild(card);
    initAttachmentBox(card);

    function initAttachmentBox(scope) {
        scope.querySelectorAll('.attachment-box').forEach(box => {

            const input      = box.querySelector('.attachment-input');
            const fileName   = box.querySelector('.selected-file-name');
            const previewBtn = box.querySelector('.preview-file');
            const removeBtn  = box.querySelector('.remove-file');
            const deleteFlag = box.querySelector('.delete-flag');

            input?.addEventListener('change', function () {
                if (!this.files.length) return;

                const file = this.files[0];
                fileName.textContent = '📄 ' + file.name;
                fileName.classList.remove('d-none');

                const url = URL.createObjectURL(file);
                previewBtn.href = url;
                previewBtn.classList.remove('d-none');

                deleteFlag.value = 0;
            });

            removeBtn?.addEventListener('click', function () {
                input.value = '';
                previewBtn.classList.add('d-none');
                fileName.classList.add('d-none');
                deleteFlag.value = 1;
            });
        });
    }

    addRemove(card.querySelector('.removeAttachment'));

    const fileInput = card.querySelector('.attachment-file');
    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        if (file.size > maxSizeMB * 1024 * 1024) {
           aalert("{{ __('File too big') }}"); this.value = '';
        }
    });

    attachmentIndex++;
});
</script>




<script>




/*document.addEventListener('change', function (e) {
    if (e.target.classList.contains('attachment-file')) {

        const fileInput = e.target;
        const row = fileInput.closest('.attachment-row');

        const previewBtn = row.querySelector('.preview-file');
        const fileNameText = row.querySelector('.selected-file-name');

        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];

            // show row as completed
            row.classList.remove('attachment-pending');
            row.classList.add('attachment-complete');

            // show file name
            fileNameText.textContent = file.name;
            fileNameText.classList.remove('d-none');

            // create preview URL
            const fileURL = URL.createObjectURL(file);

            previewBtn.href = fileURL;
            previewBtn.classList.remove('d-none');
        } else {
            // remove highlight
            row.classList.remove('attachment-complete');
            row.classList.add('attachment-pending');

            fileNameText.classList.add('d-none');
            previewBtn.classList.add('d-none');
        }
    }
});*/






    
document.addEventListener('change', function (e) {
    if (e.target.classList.contains('attachment-file')) {
        const row = e.target.closest('.attachment-row');

        if (e.target.files.length > 0) {
            row.classList.remove('attachment-pending');
            row.classList.add('attachment-complete');
        } else {
            row.classList.remove('attachment-complete');
            row.classList.add('attachment-pending');
        }
    }
});
</script>

<script>
document.addEventListener('change', function (e) {
    if (e.target.type === 'file') {
        const fileInput = e.target;
        const row = fileInput.closest('.attachment-row');

        const previewBtn = row.querySelector('.preview-file');
        const storedBtn  = row.querySelector('.stored-file');

        if (fileInput.files.length > 0) {
            const fileURL = URL.createObjectURL(fileInput.files[0]);

            previewBtn.href = fileURL;
            previewBtn.classList.remove('d-none');

            if (storedBtn) {
                storedBtn.classList.add('d-none');
            }
        }
    }
});
</script>



@if (session('success'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    initAttachmentBox(document);

    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true
    });
});
</script>
@endif



@endpush










