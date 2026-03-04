
<style>


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
        font-size: 22px;
    }

    .owner-box span {
        opacity: 0.8;
    }












    /* ===== PROJECT PANEL DESIGN ===== */

.project-panel {
    border: 2px solid #000;
    background-color: #f5f5dc;
    margin: 20px;
}

.project-panel-header {
    background-color:#d4af37;
    color:  #2f3a1f;
    padding: 14px 20px;
    font-weight: 600;
    font-size: 16px;
    border-bottom: 2px solid #000;
}

.project-panel-body {
    padding: 20px;
}

/* Owner Box */

.owner-box {
    display: flex;
    align-items: center;
    gap: 15px;
    background-color: #ffffff;
    border: 1px solid #000;
    padding: 15px;
    margin-bottom: 25px;
}

.owner-box i {
    font-size: 28px;
    color: #2f3a1f;
}

.owner-label {
    font-size: 13px;
    color: #555;
}

.owner-name {
    font-size: 20px;
    font-weight: 700;
    color: #2f3a1f;
}

/* Buttons Grid */

.project-actions {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 15px;
}

.panel-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 6px 10px;
    background-color: #d4af37;
    color: #2f3a1f; 
    border: 1px solid #000;
    text-decoration: none;
    font-weight: 500;
    transition: 0.2s ease;
    
}

.panel-btn i {
    font-size: 32px;
}

.panel-btn:hover {
    background-color: #243016;
    color: #ffffff;
}


</style>

    <!-- {{-- زر تعديل المشروع --}}
    <a href="{{ route('projects.edit', $project->id) }}"
       class="btn btn-sm"
       style="background:#2f3a1f;color:#d4af37;">
        <i class="far fa-edit"></i> {{ __('Edit Project') }}
    </a> -->
<!-- 
<div class="owner-box" style="margin-right:2rem;width:100%;">
    <i class="fas fa-user-tie"></i>
    <span style="font-size:22px;">اسم المالك:</span>
    <strong style="font-size:22px;">{{ optional($project->ownerUser)->name }}</strong>
</div>

<div class="d-flex flex-wrap gap-2 m-3">


{{-- زر تعديل المشروع --}}
    <a href="{{ route('users.index') }}"
       class="btn btn-sm"
       style="background:#2f3a1f;color:#d4af37;">
        <i class="far fa-edit"></i> {{ __('المستخدمين') }}
    </a>


    <a href="{{ route('projects.index') }}"
    class="btn btn-sm"
    style="background:#2f3a1f;color:#d4af37;">
    <i class="far fa-edit"></i> {{ __('المشاريع') }}
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

<a  href="{{ url('#') }}"
       class="btn btn-sm"
       style="background:#2f3a1f;color:#d4af37;">
        <i class="fas fa-file-signature"></i> {{ __('التصميم') }}
    </a>

    {{-- اعتمادات البلدية --}}
    <a href="{{ route('projects.baladya-approvals.index', ['project' => $project->id]) }}"
       class="btn btn-sm"
       style="background:#2f3a1f;color:#d4af37;">
        <i class="fas fa-file-signature"></i> {{ __('اعتمادات البلدية') }}
    </a>
  <a href="{{ url('users/'.$project->id.'/attachments/create?type=projects&mode=tender') }}"
            class="btn btn-sm"
            style="background:#2f3a1f;color:#d4af37;">
        <i class="fas fa-file-signature"></i> {{ __('المناقصة') }}
    </a>
  <a href="{{ url('users/'.$project->id.'/attachments/create?type=projects&mode=contractor_files') }}"
            class="btn btn-sm"
            style="background:#2f3a1f;color:#d4af37;">
        <i class="fas fa-file-signature"></i> {{ __('عقود المقاول') }}
    </a>
     <a  href="{{ url('#') }}"
       class="btn btn-sm"
       style="background:#2f3a1f;color:#d4af37;">
        <i class="fas fa-file-signature"></i> {{ __('الاشراف') }}
    </a>
    {{-- دفعات المشروع --}}
    <a href="{{ route('projects.project-payments.index', ['project' => $project->id]) }}"
       class="btn btn-sm"
       style="background:#2f3a1f;color:#d4af37;">
        <i class="fas fa-money-check-alt"></i> {{ __('دفعات المشروع') }}
    </a>
 -->





  

  

   <!-- <a href="{{ route('projects.owner-requirements.index', [$project, 'context' => 'pricing']) }}"
        class="btn btn-sm"
        style="background:#2f3a1f;color:#d4af37;">
            <i class="fas fa-file-signature"></i> أسعار توريد التشطيبات
    </a>


    <a href="{{ route('projects.owner-requirements.index', [$project, 'context' => 'tender']) }}"
        class="btn btn-sm"
        style="background:#2f3a1f;color:#d4af37;">
            <i class="fas fa-file-signature"></i> حساب الكميات
    </a> 


  
   

    

   


</div>
-->



@if (in_array(auth()->user()->role_id, [1,4,11,12]))
<div class="project-panel">

    <div class="project-panel-header d-flex justify-content-between align-items-center">

    <!-- العنوان -->
    <div>
        <i class="fas fa-folder-open me-2"></i>
        {{ __('لوحة إدارة المشروع') }}
    </div>

    <!-- زر العودة -->
    <a href="{{ route('projects.index') }}"
       class="btn btn-olive btn-sm" style="background:#2f3a1f;color:#d4af37;">
        <i class="fas fa-arrow-left me-1"></i>
        العودة إلى المشاريع
    </a>

</div>


    <div class="project-panel-body">

        <!-- Owner Box -->
        <div class="owner-box">
            <i class="fas fa-user-tie"></i>
            <div>
                <div class="owner-label">اسم المالك</div>
                <div class="owner-name">
                    {{ optional($project->ownerUser)->name ?? '—' }}
                </div>
            </div>
        </div>

        <!-- Buttons Grid -->
        <div class="project-actions">

            <a href="{{ route('users.index') }}" class="panel-btn">
                <i class="far fa-users"></i>
                المستخدمين
            </a>

            <!-- <a href="{{ route('projects.index') }}" class="panel-btn">
                <i class="far fa-folder"></i>
                العودة الي المشاريع
            </a> -->

            <a href="{{ route('projects.edit', $project->id) }}" class="panel-btn">
                <i class="far fa-folder"></i>
                تعديل المشروع
            </a>

            <!-- <a href="{{ route('projects.owner-requirements.index', ['project' => $project->id]) }}" class="panel-btn">
                <i class="fas fa-clipboard-list"></i>
                احتياجات المالك
            </a> -->


 <a href="{{ url('users/'.$project->id.'/attachments/create?type=projects') }}" class="panel-btn">
                <i class="fas fa-clipboard-list"></i>
               {{ __('عقود الاستشاري') }}
            </a>



 <a  href="{{ url('#') }}" class="panel-btn">
                <i class="fas fa-clipboard-list"></i>
              {{ __('التصميم') }}
            </a>


 <a  href="{{ route('projects.baladya-approvals.index', ['project' => $project->id]) }}" class="panel-btn">
                <i class="fas fa-clipboard-list"></i>
              {{ __('اعتمادات البلدية') }}
            </a>
 <a  href="{{ url('users/'.$project->id.'/attachments/create?type=projects&mode=tender') }}" class="panel-btn">
                <i class="fas fa-clipboard-list"></i>
              {{ __('المناقصة') }}
            </a>

 <a  href="{{ url('users/'.$project->id.'/attachments/create?type=projects&mode=contractor_files') }}" class="panel-btn">
                <i class="fas fa-clipboard-list"></i>
               {{ __('عقود المقاول') }}
            </a>

 <a  href="{{ url('#') }}" class="panel-btn">
                <i class="fas fa-clipboard-list"></i>
              {{ __('الاشراف') }}
            </a>

 <a  href="{{ route('projects.project-payments.index', ['project' => $project->id]) }}" class="panel-btn">
                <i class="fas fa-clipboard-list"></i>
             {{ __('دفعات المشروع') }}
            </a>








            <!-- <a href="{{ route('projects.baladya-approvals.index', ['project' => $project->id]) }}" class="panel-btn">
                <i class="fas fa-building"></i>
                اعتمادات البلدية
            </a>

            <a href="{{ url('users/'.$project->id.'/attachments/create?type=projects&mode=tender') }}" class="panel-btn">
                <i class="fas fa-file-contract"></i>
                المناقصة
            </a> -->

            <!-- <a href="{{ route('projects.project-payments.index', ['project' => $project->id]) }}" class="panel-btn">
                <i class="fas fa-money-check-alt"></i>
                دفعات المشروع
            </a> -->

        </div>

    </div>
</div>
@endif