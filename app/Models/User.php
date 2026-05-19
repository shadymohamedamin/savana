<?php

/*namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable as AuditableTrait;

class User extends Authenticatable implements AuditableContract
{
    use AuditableTrait;
    use Notifiable, HasRoles, HasApiTokens, TwoFactorAuthenticatable;
    //protected $primaryKey = 'ID';
    public $table = 'users';


    public $fillable = [
        'Active',
        'RoleID',
        'name',
        'password',
        'email',
        'role',
        'email_verified_at',
        'remember_token',
        'is_admin',
        
    ];

    protected $casts = [
        'Active' => 'boolean',
        'name' => 'string',
        'password' => 'string',
        'email' => 'string',
        'role' => 'string',
        'email_verified_at' => 'datetime',
        'remember_token' => 'string',
        'is_admin' => 'boolean',
        'two_factor_secret' => 'encrypted',
    ];

    public static array $rules = [
        'Active' => 'nullable|boolean',
        'RoleID' => 'required',
        'name' => 'nullable|string|max:255',
        'password' => 'nullable|string|max:255',
        'email' => 'nullable|string|max:255',
        'role' => 'required|string|max:255',
        'email_verified_at' => 'nullable',
        'remember_token' => 'nullable|string|max:100',
        'created_at' => 'required',
        'updated_at' => 'required',
        'is_admin' => 'required|boolean'
    ];

} */














namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable as AuditableTrait;




/*
'uae_id' => [
    'required',
    'string',
    'regex:/^784-\d{4}-\d{7}-\d{1}$/',
    'unique:users,uae_id',
    'unique:primary_datas,uae_id',
],
*/


class User extends Authenticatable implements AuditableContract
{
    use AuditableTrait;
    use Notifiable, HasRoles, HasApiTokens, TwoFactorAuthenticatable;

    public $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'lang',
        'password',
        'role_id',
        'uae_id',
        'mobile',
        'sex',
        'nat',
        'city',
        'country',
        'address',
        'birthday',
        'delete',
        'permissions',
        'last_login',
        'ipaddress',
        'notes',
        'title',
        'picture',
        'Active',
        'role',
        'email_verified_at',
        'remember_token',
        'is_admin',
        'signature',


        'responsible_name',
        'manager_name',
        'license_number',
    ];

    protected $casts = [
        'Active' => 'boolean',
        'is_admin' => 'boolean',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'role_id' => 'integer',
        'uae_id' => 'string',
        'mobile' => 'string',
        'sex' => 'integer',
        'nat' => 'integer',
        'city' => 'integer',
        'country' => 'integer',
        'address' => 'string',
        'delete' => 'boolean',
        'birthday' => 'date',
        'last_login' => 'datetime',
        'ipaddress' => 'string',
        'notes' => 'string',
        'title' => 'string',
        'picture' => 'string',
        'permissions' => 'array', // stored as JSON
        'email_verified_at' => 'datetime',
        'remember_token' => 'string',
        'two_factor_secret' => 'encrypted',
    ];

    public static array $rules = [
        'name' => 'nullable|string|max:255',
        'email' => 'nullable|string|email|max:255',
        'password' => [
            'nullable',
            'string',
            'min:6',
            'confirmed', // 👈 أهم سطر
        ],
        'role_id' => 'required|integer',
        'Active' => 'required',
        //'role' => 'nullable',
        'uae_id' => 'nullable|string|max:20',
        'mobile' => 'nullable|string|max:20',
        'sex' => 'required|integer|exists:sexes,id',
        'nat' => 'nullable',
        'city' => 'required|exists:regions,id',
        'country' => 'nullable',
        'address' => 'nullable|string|max:255',
        'birthday' => 'nullable|date',
        'delete' => 'boolean',
        'permissions' => 'nullable|array',
        'last_login' => 'nullable|date',
        'ipaddress' => 'nullable|string|max:45',
        'notes' => 'nullable|string',
        'title' => 'nullable|string|max:255',
        'picture' => 'nullable|string|max:255',
        //'is_admin' => 'required|boolean',
        'email_verified_at' => 'nullable|date',
        'remember_token' => 'nullable|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        
    ];

    // === Relationships ===

    /*public function roleid()
    {
        return $this->belongsTo(Tblrole::class, 'RoleID');
    }*/
    public function supervisions()
    {
        return $this->hasMany(ProjectSupervision::class);
    }
    public function sexRelation()
    {
        return $this->belongsTo(Sex::class, 'sex'); // assumes Sex model
    }

    public function nationality()
    {
        return $this->belongsTo(Nationalit::class, 'nat'); // assumes Nationality model
    }
   
    //public function countryRelation()
    //{
    //    return $this->belongsTo(Nationalit::class, 'country'); // same table as nat
    //}

    public function cityRelation()
    {
        return $this->belongsTo(Region::class, 'city'); // assumes Region model
    }
    public function primaryData()
    {
        return $this->hasOne(PrimaryData::class, 'IDNo', 'uae_id');
    }
    public function roleRelation()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
    

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class)
            ->withPivot('role_id')
            ->withTimestamps();
    }


    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}

