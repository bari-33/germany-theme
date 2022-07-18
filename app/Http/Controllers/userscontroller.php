<?php

namespace App\Http\Controllers;


use App\Models\EmployeeProduct;
use App\Models\Role;
use App\Models\User;
use App\Models\Order;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Alert;

class userscontroller extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('user.adduser', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|confirmed|min:8',
            'email' => 'required|email',
            'first_name' => 'required',
            'role' => 'required',
            'telephone' => 'nullable',
            'biographical_information' => 'nullable',
        ]);


        if (UserDetail::where('username', '=', Input::get('username'))->exists() || User::where('email', '=', Input::get('email'))->exists()) {
            return redirect()->back()->with('message', 'Username and email alreday exist');
        } else {

            $userdetail = new User();
            $userdetail->name = $request->get('first_name') . ' ' . $request->get('last_name');
            $userdetail->email = $request->get('email');
            $userdetail->password = Hash::make($request->get('password'));
            $userdetail->save();
            $userdetail->roles()->attach($request->get('role'));


            $userDetail = new UserDetail();
            $userDetail->user_id = $userdetail->id;
            $userDetail->username = $request->get('username');
            $userDetail->first_name = $request->get('first_name');
            $userDetail->last_name = $request->get('last_name');
            $userDetail->telephone = $request->get('telephone');
            $userDetail->website = $request->get('website');
            $userDetail->facebook = $request->get('facebook');
            $userDetail->instagram = $request->get('instagram');
            $userDetail->deutch = $request->get('deutch');
            $userDetail->english = $request->get('english');
            $userDetail->spanish = $request->get('spanish');
            $userDetail->french = $request->get('french');
            $userDetail->web_designer = $request->get('web_designer');
            $userDetail->graphic_designer = $request->get('graphic_designer');
            $userDetail->media_designer = $request->get('media_designer');
            $userDetail->biographical_information = $request->get('biographical_information');

            if ($request->hasFile('profile_picture')) {
                $image = $request->profile_picture;
                $ext = $image->getClientOriginalExtension();
                $filename = uniqid() . '.' . $ext;
                $image->move('images/profiles', $filename);
                $profile_picture = $filename;
            }else{
                $profile_picture = "profile.png";
            }

            $userdetail->profile_picture = $profile_picture;
            $userDetail->save();
            $userdetail->save();



            return redirect()->back()->with('alert', 'Insert Recorde successfully');
        }
    }
    public function create()
    {
        $users = User::orderBy('created_at', 'ASC')->with('userdetail')->get();
        $all = $users->count();
        $admins = 0;
        $clients = 0;
        $customers = 0;
        $employees = 0;
        foreach ($users as $user) {
            if ($user->roles()->first()->slug == "admin") {
                $admins++;
            } else if ($user->roles()->first()->slug == "client") {
                $clients++;
            } else if ($user->roles()->first()->slug == "customer") {
                $customers++;
            } else if ($user->roles()->first()->slug == "employee") {
                $employees++;
            }
        }
        Session::put('all', $all);
        Session::put('admins', $admins);
        Session::put('clients', $clients);
        Session::put('customers', $customers);
        Session::put('employees', $employees);
        //  Alert::success('Saved');
        return view("user.listuser", compact('users'));
    }
    public function search(Request $request)
    {
        switch ($request->input('action')) {

            case 'all':
                $users = User::orderBy('created_at', 'ASC')->get();
                break;
            case 'admins':
                $users = User::whereHas('roles', function ($q) {

                    $q->where('id', 1); //this refers id field from categories table

                })->orderBy('created_at', 'ASC')->get();


                break;
            case 'employees':
                $users = User::whereHas('roles', function ($q) {

                    $q->where('id', 2);
                })->orderBy('created_at', 'ASC')->get();
                break;
            case 'customers':
                $users = User::whereHas('roles', function ($q) {

                    $q->where('id', 3); //this refers id field from categories table

                })->orderBy('created_at', 'ASC')->get();
                break;

            case 'deleted':
                break;
        }
        return view('user.listuser', compact('users'));
    }
    public function delete($id)
    {
        User::where('id', $id)->delete();
        UserDetail::where('user_id', $id)->delete();
        return redirect()->back();
    }
    public function edit($id)
    {
        $user = User::where('id', $id)->get();
        // Session::put('email',$user->email);
        $roles = Role::all();

        return view('user.edituser', compact('user', 'roles'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $dat = User::where('id', $id)->get();

        $request->validate([
            'username' => 'required',
            'password' => 'nullable|confirmed|min:8',
            'email' => 'required|email',
            'first_name' => 'required',
            'telephone' => 'nullable',
            'biographical_information' => 'nullable',
        ]);

        $data = DB::table('users')->where('email', Input::get('email'))->where("id", $id)->first();

        if ($data == null && (session('email') != $request->get('email'))) {
            return redirect()->back()->with('message', 'email alreday exist');
        } else {
            $userdetail = User::where('id', $id)->first();
            $userdetail->name = $request->get('first_name') . ' ' . $request->get('last_name');
            $userdetail->email = $request->get('email');
            if (!empty($request->get('password'))) {
                $userdetail->password = Hash::make($request->get('password'));
            }
            $userdetail->roles()->sync($request->get('role'));

            $profile_picture = "";


            if ($request->hasFile('profile_picture')) {

                //checking if already profile picture exists
                if (isset($profile_picture)) {
                    if (!empty($userdetail->profile_picture) && $userdetail->profile_picture != "profile.png") {
                        $path = public_path() . "/images/profiles/" . $userdetail->profile_picture;
                        unlink($path);
                    }
                }


                $image = $request->profile_picture;
                $ext = $image->getClientOriginalExtension();
                $filename = uniqid() . '.' . $ext;
                $image->move('images/profiles', $filename);
                $profile_picture = $filename;
            } else {
                $profile_picture = $userdetail->profile_picture ;
            }

            $userdetail->profile_picture = $profile_picture;


            $userdetail->userdetail()->update([
                "first_name" => $request->get('first_name'),
                "last_name" => $request->get('last_name'),
                "telephone" => $request->get('telephone'),
                "website" => $request->get('website'),
                "facebook" => $request->get('facebook'),
                "instagram" => $request->get('instagram'),
                "biographical_information" => $request->get('biographical_information'),
                "deutch" => $request->get('deutch'),
                "english" => $request->get('english'),
                "spanish" => $request->get('spanish'),
                "french" => $request->get('french'),
                "web_designer" => $request->get('web_designer'),
                "graphic_designer" => $request->get('graphic_designer'),
                "media_designer" => $request->get('media_designer'),

                "company" => $request->get('company'),
                "street_no" => $request->get('street_no'),
                "house_no" => $request->get('house_no'),
                "additional_info" => $request->get('additional_info'),
                "zip_code" => $request->get('zip_code'),

                "city" => $request->get('city'),
                "country" => $request->get('country'),

                "bank_name" => $request->get('bank_name'),
                "iban" => $request->get('iban'),
                "bc" => $request->get('bc'),
                "paypal" => $request->get('paypal'),


                'billing' => $request->get('billing'),
                'amount' => $request->get('amount'),
            ]);

            $userdetail->save();

            EmployeeProduct::where('user_detail_id', $userdetail->userdetail->id)->delete();

            if ($request->get('role') === "2") {
                if (!empty($request->get('resume'))) {
                    $employeeproduct = new EmployeeProduct();
                    $employeeproduct->product = $request->get('resume');
                    $employeeproduct->user_detail_id = $userdetail->userdetail->id;
                    $employeeproduct->save();
                }
                if (!empty($request->get('website'))) {
                    $employeeproduct = new EmployeeProduct();
                    $employeeproduct->product = $request->get('website');
                    $employeeproduct->user_detail_id = $userdetail->userdetail->id;
                    $employeeproduct->save();
                }
                if (!empty($request->get('package'))) {
                    $employeeproduct = new EmployeeProduct();
                    $employeeproduct->product = $request->get('package');
                    $employeeproduct->user_detail_id = $userdetail->userdetail->id;
                    $employeeproduct->save();
                }
            }

            return redirect()->back()->with('update', 'Update Recorde succesfully');
        }
    }
    public function show($id)
    {
        $userdetail=user::where('id',$id)->first();
        return view('user.show',compact('userdetail'));

    }
	 public function readall($ids)
    {
        $order_id = explode(',', $ids);
        foreach ($order_id as $key => $value) {
            order::where('id', $value)->update([ "notification_status" => "1"]);
        }
        return redirect()->back();

    }
}
