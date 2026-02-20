<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Flash;
use App\Helpers\AuditHelper;
use App\Models\Nationalit;

class UserController extends AppBaseController
{
    /** @var UserRepository $userRepository*/
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     */
    public function index(Request $request)
    {
        $query = \App\Models\User::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', $request->email . '%');//'%' . $request->email . '%'
        }

        if ($request->filled('mobile')) {
            $query->where('mobile', 'like', $request->mobile . '%');//'%' . $request->email . '%'
        }

        if ($request->filled('active')) {
            $query->where('active', $request->active);
        }

        if ($request->filled('role_id')) {
            $query->where('role_id', $request->role_id);
        }

        if ($request->filled('is_admin')) {
            $query->where('is_admin', $request->is_admin);
        }

        // Add more filters here if needed

        //$users = $query->paginate(10)->appends($request->all());
        /*$users = $query
            ->latest()   // = orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends($request->all());*/
        $users = $query
            ->with('roleRelation') // لو بتعرض اسم الـ Role
            ->orderBy('created_at') //Desc
            ->paginate(10)
            ->appends($request->query());



        $roles = \App\Models\Role::pluck(
                app()->getLocale() == 'ar' ? 'name_ar' : 'name_en',
                'id'
            );
        return view('users.index', compact('users', 'roles'));
        //$users = $this->userRepository->paginate(10);

        //return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     */
    public function create(Request $request)
    {
        //$nationalities = Nationalit::pluck('nationality', 'id');
        $nationalities = Nationalit::whereIn('id', [1, 58,19,31,12,26,8])->pluck('nationality', 'id');

        $regions = \App\Models\Region::where('status', 1)->pluck('region', 'id');
        $roles = \App\Models\Role::pluck('name_ar', 'id');

        $defaultTypes = [1, 4, 3]; // User attachments

        return view('users.create', [
            'nationalities'=>$nationalities,
            'regions'=>$regions,
            'roles'=>$roles,
            'defaultTypes'=>$defaultTypes  ,
            'roleId' => $request->get('role_id'),
        ]);
    }


    /**
     * Store a newly created User in storage.
     */
    public function store(CreateUserRequest $request)
    {


        /*$request->validate([
            'mobile' => [
                'required',
                'regex:/^05[0-9]{8}$/'
            ],
            'uae_id' => [
                'nullable',
                'regex:/^784-[0-9]{4}-[0-9]{7}-[0-9]{1}$/'
            ],
        ]);*/
        //dd($request->validated());
        // شيل dd بعد ما تخلص Debug
        $input = $request->validated();

        // الجنسية ID
        //$input['nat'] = (int) $request->nat;

        // country نفس الجنسية (ID)
        //if($input['nat']) $input['country'] = $input['nat'];
        //else {
        //    $input['country'] = 66;
        //    $input['nat'] = 66;
        //}
        $input['male'] = $input['sex'];
        if($input['role_id']==1)$input['is_admin']=1;
        else $input['is_admin']=0;

        if ($input['role_id'] == 3) {
            $input['country'] = 66;
            $input['nat'] = 66;
        }
        if (!empty($input['password'])) {

            $input['password'] = bcrypt($input['password']);
        } else {
            unset($input['password']);
        }
        // تشفير الباسورد
        //$input['password'] = bcrypt($input['password']);

        $user = \App\Models\User::create($input);

        AuditHelper::logAudit('created', $user, [], $user->getAttributes());

        Flash::success('User saved successfully.');

        //return redirect()->route('users.attachments.create', $user->id)
        //    ->with('success', 'User created successfully! Now you can upload attachments.');


        /*return redirect()->route('users.attachments.create', $user->id)
            ->route('users.index')
            ->with('toast', [
                'type' => 'success',
                'message' => 'تم الحفظ بنجاح ✅'
            ]);*/

        return redirect()
            ->route('users.attachments.create', [
                'id' => $user->id,
                'type' => 'users'
            ])
            ->with('toast', [
                'type' => 'success',
                'message' => __('User created successfully. You can now upload attachments.')
            ]);

        //return redirect()->route('users.index');
    }

   /* public function store(CreateUserRequest $request)
    {
        dd($request);
        $input = $request->all();

        $input['country'] = $request->nat; // نفس الجنسية
        $user = \App\Models\User::create($input);
        //$user = $this->userRepository->create($input);
        AuditHelper::logAudit('created', $user,[],$user->getAttributes());

        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }*/

    /**
     * Display the specified User.
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     */
    public function edit($id)
{
    $user = $this->userRepository->find($id);

    if (empty($user)) {
        Flash::error('User not found');
        return redirect(route('users.index'));
    }

    // You need to load these for the dropdowns
    $regions = \App\Models\Region::where('status', 1)->pluck('region', 'id'); // or however you store cities
    $roles = \App\Models\Role::pluck('name_ar', 'id');   // all roles
    //$nationalities = \App\Models\Nationalit::pluck('Nationality', 'id'); // or define as array
    $nationalities = Nationalit::whereIn('id', [1, 58,19,31,12,26,8])->pluck('nationality', 'id');
    return view('users.edit', compact('user', 'regions', 'roles', 'nationalities'));
}


    /**
     * Update the specified User in storage.
     */
    public function update($id, UpdateUserRequest $request)
    {
        /*$request->validate([
            'mobile' => [
                'required',
                'regex:/^05[0-9]{8}$/'
            ],
            'uae_id' => [
                'nullable',
                'regex:/^784-[0-9]{4}-[0-9]{7}-[0-9]{1}$/'
            ],
        ]);*/

        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $oldValues = $user->getAttributes(); // Or limit fields like: $user->only(['name', 'email'])

        $user = $this->userRepository->update($request->all(), $id);

        $newValues = $user->getAttributes();

        AuditHelper::logAudit('updated', $user, $oldValues, $newValues);

        Flash::success('User updated successfully.');

        return redirect()
    ->back()
    ->with('toast', [
        'type' => 'success',
        'message' => __('user updated successfully.')
    ]);
//return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        AuditHelper::logAudit('deleted', $user, $user->getAttributes(), []);

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect()->back();
    }
}
