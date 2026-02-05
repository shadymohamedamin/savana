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

    <!-- <a href="{{ route('users.edit', $project->owner_id) }}"
       class="btn btn-sm"
       style="background:#2f3a1f;color:#d4af37;">
        <i class="fas fa-file-signature"></i> {{ __(' المالك') }}
    </a>


    <a href="{{ route('users.edit', $project->contractor_id) }}"
       class="btn btn-sm"
       style="background:#2f3a1f;color:#d4af37;">
        <i class="fas fa-file-signature"></i> {{ __(' المقاول') }}
    </a> -->

    <!-- {{-- Dropdown للإضافات --}}
    <div class="dropdown">
        <button class="btn btn-sm dropdown-toggle"
                style="background:#2f3a1f;color:#d4af37;"
                data-bs-toggle="dropdown">
            <i class="fas fa-cog"></i>
        </button>

        <ul class="dropdown-menu dropdown-menu-end" style="background:#f5f5dc;">
            <li class="dropdown-header text-muted">
                {{ __('مراحل المشروع') }}
            </li>

            <li>
                <a class="dropdown-item"
                   href="{{ url('users/'.$project->id.'/attachments/create?type=projects') }}">
                    <i class="fas fa-folder-open me-1"></i> {{ __('عقود الاستشاري') }}
                </a>
            </li>

            <li>
                <a class="dropdown-item"
                   href="{{ route('users.edit', $project->owner_id) }}">
                    <i class="fas fa-user me-1"></i> {{ __('المالك') }}
                </a>
            </li>

            <li>
                <a class="dropdown-item"
                   href="{{ route('users.edit', $project->contractor_id) }}">
                    <i class="fas fa-hard-hat me-1"></i> {{ __('المقاول') }}
                </a>
            </li>
        </ul>
    </div> -->

</div>
