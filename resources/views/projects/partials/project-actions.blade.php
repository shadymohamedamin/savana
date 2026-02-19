
<script>


    .owner-box {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        margin: 10px 0 15px auto; /* يخليه في اليسار */
        background: #2f3a1f;
        color: #d4af37;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        width: fit-content;
    }

    .owner-box i {
        font-size: 16px;
    }

    .owner-box span {
        opacity: 0.8;
    }

</script>



<div class="owner-box" style="margin-right:2rem;width:100%;">
    <i class="fas fa-user-tie"></i>
    <span>اسم المالك:</span>
    <strong>{{ optional($project->ownerUser)->name }}</strong>
</div>

<div class="d-flex flex-wrap gap-2 m-3">

    {{-- زر تعديل المشروع --}}
    <a href="{{ route('projects.edit', $project->id) }}"
       class="btn btn-sm"
       style="background:#2f3a1f;color:#d4af37;">
        <i class="far fa-edit"></i> {{ __('Edit Project') }}
    </a>

    {{-- اعتمادات البلدية --}}
    <a href="{{ route('projects.baladya-approvals.index', ['project' => $project->id]) }}"
       class="btn btn-sm"
       style="background:#2f3a1f;color:#d4af37;">
        <i class="fas fa-file-signature"></i> {{ __('اعتمادات البلدية') }}
    </a>

    {{-- دفعات المشروع --}}
    <a href="{{ route('projects.project-payments.index', ['project' => $project->id]) }}"
       class="btn btn-sm"
       style="background:#2f3a1f;color:#d4af37;">
        <i class="fas fa-money-check-alt"></i> {{ __('دفعات المشروع') }}
    </a>

    {{-- احتياجات المالك --}}
    <a href="{{ route('projects.owner-requirements.index', ['project' => $project->id]) }}"
       class="btn btn-sm"
       style="background:#2f3a1f;color:#d4af37;">
        <i class="fas fa-file-signature"></i> {{ __('احتياجات المالك') }}
    </a>



    <a  href="{{ url('users/'.$project->id.'/attachments/create?type=projects') }}"
       class="btn btn-sm"
       style="background:#2f3a1f;color:#d4af37;">
        <i class="fas fa-file-signature"></i> {{ __('عقود الاستشاري') }}
    </a>


    <a href="{{ url('users/'.$project->id.'/attachments/create?type=projects&mode=tender') }}"
            class="btn btn-sm"
            style="background:#2f3a1f;color:#d4af37;">
        <i class="fas fa-file-signature"></i> {{ __('المناقصة') }}
    </a>

   <a href="{{ route('projects.owner-requirements.index', [$project, 'context' => 'pricing']) }}"
        class="btn btn-sm"
        style="background:#2f3a1f;color:#d4af37;">
            <i class="fas fa-file-signature"></i> أسعار توريد التشطيبات
    </a>


    <a href="{{ route('projects.owner-requirements.index', [$project, 'context' => 'tender']) }}"
        class="btn btn-sm"
        style="background:#2f3a1f;color:#d4af37;">
            <i class="fas fa-file-signature"></i> حساب الكميات
    </a>


  
    <a  href="{{ url('#') }}"
       class="btn btn-sm"
       style="background:#2f3a1f;color:#d4af37;">
        <i class="fas fa-file-signature"></i> {{ __('الاشراف') }}
    </a>

    <a  href="{{ url('#') }}"
       class="btn btn-sm"
       style="background:#2f3a1f;color:#d4af37;">
        <i class="fas fa-file-signature"></i> {{ __('التصميم') }}
    </a>

   


</div>
