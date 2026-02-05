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

   


</div>
