<!-- Active Field -->
<div class="col-sm-12">
    {!! Form::label('Active', 'Active:') !!}
    <p>{{ $user->Active }}</p>
</div>

<!-- Roleid Field -->
<div class="col-sm-12">
    {!! Form::label('RoleID', 'Roleid:') !!}
    <p>{{ $user->RoleID }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $user->name }}</p>
</div>

<!-- Password Field -->
<div class="col-sm-12">
    {!! Form::label('password', 'Password:') !!}
    <p>{{ $user->password }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $user->email }}</p>
</div>

<!-- Role Field -->
<div class="col-sm-12">
    {!! Form::label('role', 'Role:') !!}
    <p>{{ $user->role }}</p>
</div>

<!-- Email Verified At Field -->
<div class="col-sm-12">
    {!! Form::label('email_verified_at', 'Email Verified At:') !!}
    <p>{{ $user->email_verified_at }}</p>
</div>

<!-- Remember Token Field -->
<div class="col-sm-12">
    {!! Form::label('remember_token', 'Remember Token:') !!}
    <p>{{ $user->remember_token }}</p>
</div>

<!-- Is Admin Field -->
<div class="col-sm-12">
    {!! Form::label('is_admin', 'Is Admin:') !!}
    <p>{{ $user->is_admin }}</p>
</div>

