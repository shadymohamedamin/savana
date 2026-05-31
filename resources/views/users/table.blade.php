








<style>
:root{
    --gov-primary:#6F5A24;
    --gov-secondary:#F8F4E8;
    --gov-border:#C8B27A;
    --gov-text:#4B3F1F;
    --gov-bg:#F8F4E8;
    --gov-hover:#EFE8C8;
}

.card{
    background:#F8F4E8 !important;
    border:2px solid #C8B27A !important;
    border-radius:14px !important;
}

.gov-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:20px;
    padding:20px;
    margin-bottom:25px;
    background:#F8F4E8;
    border:2px solid #C8B27A;
    border-radius:14px;
}

.gov-header-icon{
    width:60px;
    height:60px;
    border-radius:12px;
    background:#6F5A24;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
}

.gov-header-title{
    font-size:24px;
    font-weight:800;
    color:#6F5A24;
}

.gov-header-subtitle{
    color:#8A7745;
}

.gov-header-stats{
    display:flex;
    gap:15px;
}

.gov-stat{
    min-width:120px;
    text-align:center;
    background:#fff;
    border:1px solid #D8C187;
    border-radius:10px;
    padding:10px;
}

.gov-stat span{
    display:block;
    font-size:22px;
    font-weight:800;
    color:#6F5A24;
}

.top-toolbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.action-btn{
    width:42px;
    height:42px;
    border:none;
    border-radius:12px;
    background:#f5f3ee;
}

.action-menu{
    display:none;
    position:absolute;
    min-width:220px;
    background:#fff;
    border-radius:14px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    z-index:9999;
}

.action-menu.show{
    display:block;
}

.filter-panel{
    display:none;
}

.filter-panel.show{
    display:block;
}

.filter-input{
    border:1px solid #C8B27A;
    border-radius:8px;
    height:44px;
}

.btn-apply,
.btn-reset,
.btn-olive{
    background:#6F5A24 !important;
    border-color:#6F5A24 !important;
    color:#fff !important;
}

.custom-table{
    border:2px solid #C8B27A !important;
}

.custom-header th{
    background:#6F5A24 !important;
    color:#fff !important;
    border:1px solid #C8B27A !important;
    font-weight:800;
}

.custom-table tbody td{
    background:#fff !important;
    border:1px solid rgba(146,114,42,.20) !important;
}

.custom-table tbody tr:hover{
    background:#EFE8C8 !important;
}

.project-row{
    cursor:pointer;
    transition:.2s;
}

.project-row:hover{
    transform:scale(1.002);
}









.action-dropdown{
    position:relative;
}

.action-btn{
    width:44px;
    height:44px;
    border:none;
    border-radius:12px;
    background:#f5f3ee;
    color:#6F5A24;
    font-size:18px;
    transition:.2s;
}

.action-btn:hover{
    background:#e8dfc7;
}

.action-menu{
    position:absolute;
    top:55px;
    left:0;

    min-width:240px;

    background:#fff;

    border:1px solid #E5D7AE;
    border-radius:14px;

    box-shadow:0 12px 30px rgba(0,0,0,.12);

    overflow:hidden;

    z-index:99999;

    display:none;
}

.action-menu.show{
    display:block;
}

.action-menu a,
.action-menu button{
    width:100%;
    display:flex;
    align-items:center;
    gap:10px;

    padding:14px 16px;

    border:none;
    background:none;

    text-decoration:none;

    color:#4B3F1F;
    font-weight:600;

    transition:.2s;
}

.action-menu a:hover,
.action-menu button:hover{
    background:#F8F4E8;
}









/* .card{
    margin-top:150px !important;
} */

</style>




<!-- <canvas id="signature-pad"></canvas> -->
<!-- <canvas id="signature-pad" width="400" height="150" style="border:1px solid #ccc;"></canvas> -->
<div class="card shadow-sm rounded-4 m-0"
     style="background-color:#f5f5dc; margin-top:50px;">

    {{-- Header --}}
    <<div class="gov-header">

    <div class="gov-header-icon">
        <i class="fas fa-users"></i>
    </div>

    <div>
        <div class="gov-header-title">
            إدارة المستخدمين
        </div>

        <div class="gov-header-subtitle">
            إدارة المستخدمين والصلاحيات والأدوار
        </div>
    </div>

    <div class="gov-header-stats">

        <div class="gov-stat">
            <span>{{ $users->total() }}</span>
            <small>إجمالي المستخدمين</small>
        </div>

        <div class="gov-stat">
            <span>{{ $users->where('Active',1)->count() }}</span>
            <small>مستخدم نشط</small>
        </div>

    </div>

</div>

    <div class="card-header">

    <div class="top-toolbar">

        <form method="GET"
              action="{{ route('users.index') }}"
              style="margin:0;">

            <div style="position:relative; min-width:260px;">

                <i class="fas fa-search"
                   style="
                   position:absolute;
                   right:14px;
                   top:50%;
                   transform:translateY(-50%);
                   color:#999;
                   z-index:2;">
                </i>

                <input type="text"
                       name="name"
                       value="{{ request('name') }}"
                       class="form-control"
                       placeholder="بحث سريع..."
                       style="
                       padding-right:40px;
                       padding-left:40px;
                       border-radius:12px;
                       height:42px;"
                       oninput="
                       clearTimeout(window.searchTimer);
                       window.searchTimer=setTimeout(()=>{
                            this.form.submit();
                       },500)">

                <a href="{{ route('users.index') }}"
                   style="
                   position:absolute;
                   left:12px;
                   top:50%;
                   transform:translateY(-50%);
                   text-decoration:none;
                   color:#999;">
                   ✖
                </a>

            </div>

        </form>

        <div class="action-dropdown">

            <button type="button"
                    class="action-btn"
                    id="actionToggle">
                ⚙️
            </button>

            <div class="action-menu" id="actionMenu">

                <a href="{{ route('users.create') }}">
                    <i class="fas fa-user-plus"></i>
                    إضافة مستخدم
                </a>

                <button type="button" id="toggleFilter">
                    🔍 فلترة
                </button>

            </div>

        </div>

    </div>

</div>


<div class="filter-panel" id="filterPanel">

    <div class="card filter-card shadow-sm mb-4 mt-0">

        <div class="card-body filter-body">

            <form method="GET" action="{{ route('users.index') }}">

                <div class="row g-3">

                    <div class="col-md-3">
                        <label class="form-label">الاسم</label>

                        <input type="text"
                               name="name"
                               class="form-control filter-input"
                               value="{{ request('name') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">رقم الهاتف</label>

                        <input type="text"
                               name="mobile"
                               class="form-control filter-input"
                               value="{{ request('mobile') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">الدور</label>

                        <select name="role_id"
                                class="form-control filter-input">

                            <option value="">اختر الدور</option>

                            @foreach($roles as $id => $role)

                                <option value="{{ $id }}"
                                    {{ request('role_id')==$id ? 'selected' : '' }}>

                                    {{ $role }}

                                </option>

                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-3 d-flex gap-2 align-items-end">

                        <button class="btn btn-apply">
                            <i class="fas fa-search"></i>
                            بحث
                        </button>

                        <a href="{{ route('users.index') }}"
                           class="btn btn-reset">

                            <i class="fas fa-redo"></i>

                            إعادة ضبط

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>






    {{-- Table --}}
    <div class="table-responsive p-3" style="background-color: #f5f5dc;">
        <table class="table table-hover align-middle text-nowrap rounded-4 overflow-auto"
               style="border:1px solid #f5f5dc;">

            <thead class="custom-header">

                <tr>

                    <th>#</th>
                    <th>الاسم</th>
                    <th>البريد</th>
                    <th>الجوال</th>
                    <th>رقم الهوية</th>
                    <th>رقم الرخصة</th>
                    <th>الدور</th>
                    <th>الإجراءات</th>

                </tr>

                </thead>

            <tbody style="background-color: #f5f5dc;">
            @foreach($users as $user)
                <tr class="project-row" data-href="{{ route('users.edit', $user->id) }}" style="background-color: #f5f5dc; cursor:pointer;">
                    <td style="background-color: #f5f5dc;">
                        {{ $loop->iteration }}
                    </td>
                    <td style="background-color: #f5f5dc;">{{ $user->name }}</td>
                    <td style="background-color: #f5f5dc;">{{ $user->email }}</td>
                    <td style="background-color: #f5f5dc;">{{ $user->mobile }}</td>
                    <td style="background-color: #f5f5dc;">{{ $user->uae_id }}</td>
                    <td style="background-color: #f5f5dc;">{{ $user->license_number }}</td>
                    <!-- <td style="background-color: #f5f5dc;">{{ $user->male ? __('Male') : __('Female') }}</td> -->
                    <!-- <td style="background-color: #f5f5dc;">
                        <span class="badge {{ $user->Active ? 'bg-success':'bg-danger' }}">
                            {{ $user->Active ? __('Yes') : __('No') }}
                        </span>
                    </td> -->
                    <!-- <td style="background-color: #f5f5dc;">{{ $user->roleRelation->Role ?? '-' }}</td> -->
                    <td style="background-color: #f5f5dc;">
                        @if(app()->getLocale() == 'ar')
                            {{ $user->roleRelation->name_ar ?? '-' }}
                        @else
                            {{ $user->roleRelation->name_en ?? '-' }}
                        @endif
                    </td>

                    <!-- <td style="background-color: #f5f5dc;">
                        <span class="badge {{ $user->is_admin ? 'bg-warning text-dark':'bg-secondary' }}">
                            {{ $user->is_admin ? __('Yes') : __('No') }}
                        </span>
                    </td> -->
                    <td style="background-color: #f5f5dc;" onclick="event.stopPropagation();">
                        {{-- Actions Dropdown --}}

<!-- <button class="btn btn-sm btn-secondary dropdown-toggle"
                                    type="button"
                                    style="background-color: #2f3a1f;border: 1px solid #2f3a1f;color: #d4af37;"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <i class="fas fa-cog"></i>
                            </button> -->


                        <div class="dropdown" style="background-color: #f5f5dc;">
                            <button class="btn btn-sm btn-olive dropdown-toggle rounded-3"
                                    style="background-color: #2f3a1f;border: 1px solid #2f3a1f;color: #f5f5dc;"
                                    type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" style="background-color: #f5f5dc;">
                                <!-- <li>
                                    <a class="dropdown-item" href="{{ route('users.show', $user->id) }}">
                                        <i class="far fa-eye me-1"></i> {{ __('Show') }}
                                    </a>
                                </li> -->
                                <li>
                                    <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}">
                                        <i class="far fa-edit me-1"></i> {{ __('Edit') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                    href="{{ url('users/'.$user->id.'/attachments/create?type=users') }}">
                                        <i class="fas fa-folder-open me-1"></i> {{ __('مستندات') }}
                                    </a>
                                </li>
                                <li>
                                    {!! Form::open(['route'=>['users.destroy',$user->id],'method'=>'delete']) !!}
                                    {!! Form::button('<i class="far fa-trash-alt me-1"></i> '. __('Delete'),
                                        ['type'=>'submit','class'=>'dropdown-item text-danger',
                                        'onclick'=>"return confirm('Are you sure?')"]) !!}
                                    {!! Form::close() !!}
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>

    {{-- Pagination --}}
    <div class="card-footer  rounded-bottom-4" style="background-color: #f5f5dc;" >
        <div class="float-end" style="background-color: #f5f5dc;">
            @include('adminlte-templates::common.paginate',['records'=>$users])
        </div>
    </div>

</div>

{{-- Custom btn-olive CSS --}}
@push('styles')
<style>
.btn-olive {
    background-color: #2f3a1f;
    border: 1px solid #2f3a1f;
    color: #d4af37;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}
.btn-olive:hover {
    background-color: #3e4a29;
    border-color: #d4af37;
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(212,175,55,0.35);
}
</style>
@endpush










<!-- 
<canvas id="signature-pad" width="400" height="150" style="border:1px solid #ccc;"></canvas>
<button id="clear-btn" class="btn btn-sm btn-olive">مسح</button>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let canvas = document.getElementById("signature-pad");

        // تأكد من أن العنصر canvas موجود في الصفحة
        if (!canvas) {
            console.error("Canvas element not found.");
            return;
        }

        let signaturePad = new SignaturePad(canvas);

        // تحقق إذا كانت اللوحة جاهزة للرسم
        signaturePad.onBegin = function () {
            console.log("Started drawing on the canvas");
        };

        signaturePad.onEnd = function () {
            console.log("Ended drawing on the canvas");
        };

        // إضافة حدث لإظهار رسالة عند الضغط على اللوحة
        canvas.addEventListener('mousedown', function() {
            console.log("Mouse down on canvas.");
        });

        canvas.addEventListener('mousemove', function() {
            console.log("Mouse is moving on canvas.");
        });

        canvas.addEventListener('mouseup', function() {
            console.log("Mouse up on canvas.");
        });

        // مسح التوقيع عند الضغط على الزر
        document.getElementById('clear-btn').addEventListener('click', function() {
            console.log("Clearing the canvas...");
            signaturePad.clear();
        });
    });
</script> -->









<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.project-row').forEach(row => {
        row.addEventListener('click', function (e) {

            // امنع التنقل لو الضغط على زر أو لينك أو dropdown
            if (
                e.target.closest('a') ||
                e.target.closest('button') ||
                e.target.closest('.dropdown')
            ) {
                return;
            }

            window.location = this.dataset.href;
        });
    });
});
</script>


<script>

const toggleBtn = document.getElementById('actionToggle');
const menu = document.getElementById('actionMenu');

toggleBtn?.addEventListener('click', () => {
    menu.classList.toggle('show');
});

document.getElementById('toggleFilter')?.addEventListener('click', () => {
    document.getElementById('filterPanel')
        ?.classList.toggle('show');
});

window.addEventListener('click', function(e){

    if(!e.target.closest('.action-dropdown')){
        menu?.classList.remove('show');
    }

});

</script>
