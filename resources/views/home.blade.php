@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- <p>Welcome, {{ Auth::user()->name }} (ID: {{ Auth::user()->id }})</p>
                    <p>Role: {{ Auth::user()->role }}</p>

                    {{ __('You are logged in!') }} -->
                    <h3>👤 {{ __('Welcome') }}, {{ Auth::user()->name }}</h3>

                    @if(in_array(Auth::user()->role_id, [1,4,11,12]))
                    
                    <div class="mt-4">
                        <a href="{{ url('/users/' . Auth::id() . '/attachments/create?type=users') }}"
                        class="btn btn-olive px-4 py-2">
                            📁 {{ __('My Documents') }}
                        </a>
                    </div>
                    @endif
                        <!-- @if ($data)
                            
                            <div class="card mb-4">
                                <div class="card-header bg-success text-white">📄 Your Information</div>
                                <div class="card-body">
                                    <p><strong>ID Number:</strong> {{ $data->IDNo }}</p>
                                    <p><strong>file_number:</strong> {{ $data->FileNo }}</p>
                                    <p><strong>Name:</strong> {{ $data->Nam }}</p>
                                    <p><strong>Phone:</strong> {{ $data->mob }}</p>
                                    <p><strong>Email:</strong> {{ $data->Email }}</p>
                                    

                                    <a href="{{ route('support.primaryDatas.edit', $data->ID) }}" class="btn btn-primary">✏️ Edit My Info</a>

                                </div>
                            </div>





                            

                            @if ($mergedSupports->count())
                                <div class="card mt-4">
                                    <div class="card-header bg-info text-white">📋 Your Incomplete Aid Applications</div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <td>#</td>
                                                    <th>Action</th>
                                                    <th>Application Date</th>
                                                    <th>Help Type</th>
                                                    <th>Status</th>
                                                    <th>Reply</th>
                                                    <th>Custom Reply</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $allCompleted = true;
                                                @endphp
                                                @foreach ($mergedSupports as $item)
                                                    @php
                                                        $editStatuses = ['تم الارسال', 'يرجي تعديل الطلب'];
                                                        $finalStatuses = ['مقبول', 'اعتذار', 'تأجيل'];
                                                        if (!in_array($item->request_status, $finalStatuses)) {
                                                            $allCompleted = false;
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            @if (in_array($item->request_status, $editStatuses))
                                                                <a href="{{ route('user.edit', $item->ID) }}" class="btn btn-sm btn-primary">
                                                                    ✏️ Edit
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>{{ $item->Application_Date ?? '-' }}</td>
                                                        <td>{{ $item->help_type ?? '-' }}</td>
                                                        <td>{{ $item->request_status ?? '-' }}</td>
                                                        <td>{{ $item->request_reply ?? '-' }}</td>
                                                        <td>{{ $item->request_custom_reply ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                @if ($allCompleted)
                                    <div class="text-center mt-4">
                                        <a href="{{ route('support.submissions.create') }}" class="btn btn-success">
                                            ➕ Create New Aid Application
                                        </a>
                                    </div>
                                @endif
                            @else
                                @if ($completedSupports->count())
                                    <div class="alert alert-success mt-4">
                                        ✅ All your aid applications are completed.
                                    </div>
                                @endif

                                <div class="text-center mt-4">
                                    <a href="{{ route('support.submissions.create') }}" class="btn btn-success">
                                        ➕ Create New Aid Application
                                    </a>
                                </div>
                            @endif



                             @if (!empty($files) && count($files))




                            




                                <div class="card">
                                    <div class="card-header bg-secondary text-white">📁 Uploaded Files</div>
                                    <div class="card-body">
                                        <ul>
                                            @foreach ($files as $file)
                                                <li><a href="{{ asset('storage/' . $file->path) }}" target="_blank">{{ $file->filename }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif 
                        @else
                            
                        @endif -->
                                        



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
