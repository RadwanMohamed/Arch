<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends ImageController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view("admin.users.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect('admin-panel/users ');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view("admin.users.edit", compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->admin = $request->admin;
        if (!$user->isDirty())
            return redirect()->back()->with('message', '  يجب تعديل بعض البيانات قبل التحديث  ');

        $user->save();
        return redirect("admin-panel/users");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */

    public function destroy(User $user)
    {
        if($user->id == 1)
            returnredirect("admin-panel/users")->with('cant delete user no 1');

        $this->deleteRelation($user);
        $user->delete();
        return redirect("admin-panel/users");
    }

    /**
     * return dataTables (table) with users data
     * @param User $user
     * @return mixed
     * @throws \Exception
     */
    public function usersTableData(User $user)
    {

        $users = $user->all();

        return Datatables::of($users)
            ->editColumn('name', function ($model) {
                return '<a href="' . url('/admin-panel/users/' . $model->id . '/edit') . '">' . $model->name . '</a>';
            })
            ->editColumn('admin', function ($model) {
                return $model->admin == 0 ? '<span class="badge badge-info">' . 'عضو' . '</span>' : '<span class="badge badge-warning">' . 'مدير الموقع' . '</span>';
            })
            ->editColumn('buildings', function ($model) {
                return '<a href="' . url('/admin-panel/users/' . $model->id . '/buildings') . '" class="btn btn-info btn-circle"> العقارات</a> ';

            })

            ->editColumn('control', function ($model) {
                $all = '<a href="' . url('/admin-panel/users/' . $model->id . '/edit') . '" class="btn btn-info btn-circle"><i class="fa fa-edit"></i></a> ';
                if ($model->id != 1) {
                    $all .=
                        '<form action="' . url('/admin-panel/users') . '/' . $model->id . '" method="post">'
                        . method_field("delete")
                        . csrf_field() . '
                          <button class="btn btn-danger btn-circle delete">  <i class="fa fa-trash-o"></i>  </button>
                          </form>';
                    //$all .= '<a href="' . url('/admin-panel/users/' . $model->id ) . '" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i></a>';
                }
                return $all;
            })->escapeColumns([])
            ->make(true);

    }

    /**
     * deletes user relation
     * @param $user
     */

    protected function deleteRelation($user){
        if ($user::has('buildings'))
        {
            foreach ($user->buildings as $building)
            {
                $this->deleteAll($building->images);
                $this->removeAllUrl($building->images);

            }

            $user->buildings()->delete();

        }
    }

    /**
     * display the form of reset password
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resetPasswordView(User $user)
    {
        return view('website.user.resetpassword',compact('user'));
    }

    /**
     * reset password
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updatePassword( PasswordRequest $request,User $user)
    {

        $user->update(['password' => Hash::make($request->password)]);
        Auth::logout();
        return redirect("/login");

    }
    /**
     * display the form of reset email
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resetEmailView(User $user)
    {
        return view('website.user.changeemail',compact('user'));
    }

    /**
     * reset email
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateEmail( EmailRequest $request,User $user)
    {

        $user->update(['email' => $request->email]);
        Auth::logout();
        return redirect("/login");

    }

    /**
     * display buildings for specific user
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function userBuildings(User $user)
    {
        $buildings = $user->buildings;
        return view('admin.buildings.index', compact('buildings'));
    }

}
