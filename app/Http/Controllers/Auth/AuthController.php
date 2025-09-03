<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        $user = Auth::user();
        return view('dashboard.users.index')->with(compact('users', 'user'));
    }

    public function showLogin()
    {
        return view('Auth.login'); // tampilan form login kamu
    }

    public function showCreate()
    {
        return view('Auth.register'); // tampilan form login kamu
    }


    // public function login(Request $request)
    // {

    //     // dd($request->all());
    //     $credentials = $request->validate([
    //         'username' => ['required', 'string', 'min:3'],
    //         'password' => ['required', 'string'],
    //     ]);
    //     $remember_me = $request->has('remember_me') ? true : false;
    //     if (Auth::attempt($credentials, $remember_me)) {
    //         createLog($request->username, 'Login');
    //         return redirect()->intended('myrole');
    //     } else {
    //         return redirect()->back()->with('errors', 'Username atau Password Salah');
    //     }
    // }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember') || $request->boolean('remember_me');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            /** @var \App\Models\User $user */
            $user = Auth::user();

            // Tentukan nama route dashboard berdasarkan role (urutan = prioritas)
            $dashboardRoute = match (true) {
                $user->hasRole('superadmin')   => 'owner.dashboard',
                $user->hasRole('owner_cafe')   => 'cafe-owner.dashboard',
                $user->hasRole('admin_cafe')   => 'cafe-admin.dashboard',
                $user->hasRole('cashier_cafe') => 'cashier.dashboard',
                default                        => null, // fallback ke '/'
            };

            // Bangun URL target: kalau ada nama route, pakai route(); kalau tidak, pakai '/'
            $target = $dashboardRoute ? route($dashboardRoute) : url('/');

            // dd($target);

            // HAPUS dd($target); agar redirect jalan
            return redirect()->intended($target);
        }

        return back()
            ->withErrors(['email' => __('auth.failed')]) // atau 'Email atau password tidak sesuai.'
            ->onlyInput('email');
    }

    public function create(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'     => ['required', 'string', 'in:superadmin,owner_cafe,admin_cafe,cashier_cafe'],
        ]);

        // Create the user
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Assign the role to the user
        $user->assignRole($validated['role']); // Assumes you are using Spatie's Laravel Permission package or similar

        // Return a success response or redirect as needed
        return redirect()->route('users.index') // Adjust the route as needed
            ->with('success', 'User created successfully!');
    }


    // Logout
    public function logout()
    {
        $user = Auth::user();
        // createLog($user->username, 'Logout');
        Auth::logout();
        return redirect()->route('login');
    }

    public function add()
    {
        $user = Auth::user();
        return view('dashboard.users.add')->with(compact('user'));
    }
    public function edit($id)
    {
        $user = Auth::user();
        $data = User::with('roles')->where('id', $id)->first();
        $roles = Role::all();
        return view('dashboard.users.edit')->with(compact('user', 'data', 'roles'));
    }

    public function saveEdit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:username',
            'nama' => 'required',
        ]);
        $user = User::find($id);

        try {
            $user->username = $request->username;
            $user->nama = $request->nama;
            $user->save();
            Alert::success('Success', 'Berhasil Edit Data!');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal Edit Data!');
            return redirect()->back();
        }
    }
}
