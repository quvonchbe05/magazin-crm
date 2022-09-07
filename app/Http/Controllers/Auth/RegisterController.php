<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateWorker;
use App\Http\Requests\WorkersValidate;
use App\Models\Role;
// use App\Models\Worker;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $roles = Role::orderByDesc('id')->get();
        $workers = Worker::orderByDesc('id')->paginate(10);
        return view('auth.register', [
            'roles' => $roles,
            'workers' => $workers,
        ]);
    }

    public function registerPage()
    {
        $roles = Role::all();
        return view('auth.create', [
            'roles' => $roles
        ]);
    }

    public function register(WorkersValidate $request)
    {
        // $request->validate([
        //     'fish' => 'required',
        //     'phone1' => 'required',
        //     't_sana' => 'required',
        //     'role' => 'required',
        //     'img' => 'required',
        //     'password' => 'required|min:8',
        //     'email' => 'required|email|unique:workers'
        // ]);
        $worker = new Worker();
        $fileName = time() . '_' . $request->file('img')->getClientOriginalName();
        $filePath = $request->file('img')->storeAs('uploads', $fileName, 'public');
        $worker->role_id = $request->role;
        $worker->fish = $request->fish;
        $worker->phone1 = $request->phone1;
        $worker->phone2 = $request->phone2;
        $worker->t_sana = $request->t_sana;
        $worker->description = $request->description;
        $worker->password = Hash::make($request->password);
        $worker->email = $request->email;
        $worker->img = $fileName;
        $worker->img_path = '/storage/' . $filePath;
        $worker->kelgan_sana = $request->kelgan_sana;
        $worker->save();
        return redirect()->back()->with('success', "Ishchi muvofaqiyatli ro'yxatga olindi!");
    }

    public function updatePage($id)
    {
        $roles = Role::all();
        $worker = Worker::findOrFail($id);
        return view('auth.update', [
            'roles' => $roles,
            'worker' => $worker
        ]);
    }

    public function update(UpdateWorker $request, $id)
    {
        $worker = Worker::findOrFail($id);
        if ($request->file()) {
            $fileName = time() . '_' . $request->file('img')->getClientOriginalName();
            $filePath = $request->file('img')->storeAs('uploads', $fileName, 'public');
            $worker->role_id = $request->role;
            $worker->fish = $request->fish;
            $worker->phone1 = $request->phone1;
            $worker->phone2 = $request->phone2;
            $worker->t_sana = $request->t_sana;
            $worker->description = $request->description;
            $worker->password = $worker->password;
            $worker->email = $request->email;
            $worker->img = $fileName;
            $worker->img_path = '/storage/' . $filePath;
            $worker->kelgan_sana = $request->kelgan_sana;
        } else if ($request->password) {
            $worker->role_id = $request->role;
            $worker->fish = $request->fish;
            $worker->phone1 = $request->phone1;
            $worker->phone2 = $request->phone2;
            $worker->t_sana = $request->t_sana;
            $worker->description = $request->description;
            $worker->password = Hash::make($request->password);
            $worker->email = $request->email;
            $worker->img = $worker->img;
            $worker->img_path = $worker->img_path;
            $worker->kelgan_sana = $request->kelgan_sana;
        } else {
            $worker->role_id = $request->role;
            $worker->fish = $request->fish;
            $worker->phone1 = $request->phone1;
            $worker->phone2 = $request->phone2;
            $worker->t_sana = $request->t_sana;
            $worker->description = $request->description;
            $worker->password = $worker->password;
            $worker->email = $request->email;
            $worker->img = $worker->img;
            $worker->img_path = $worker->img_path;
            $worker->kelgan_sana = $request->kelgan_sana;
        }
        $worker->save();
        return redirect()->back()->with('success', "Ishchi muvofaqiyatli o'zgartirildi olindi!");
    }

    public function show($id)
    {
        $worker = Worker::findOrFail($id);
        $roles = Role::orderByDesc('id')->get();
        return view('auth.registered_show', [
            'worker' => $worker,
            'roles' => $roles
        ]);
    }
    
    public function deletePage($id)
    {
        $worker = Worker::findOrFail($id);
        return view('auth.delete', [
            'worker' => $worker
        ]);
    }

    public function delete($id)
    {
        $worker = Worker::findOrFail($id);
        $worker->delete();
        return redirect()->route('register.index')->with('success', 'Xodim muvofaqiyatli o\'chirildi!');
    }

    public function search(Request $request)
    {
        $workers = Worker::where('fish','like','%'.$request->fish.'%')->leftJoin('roles','workers.role_id','=','roles.id')->select('roles.role_name','workers.*')->orderByDesc('id')->get();
        return response()->json([
            'workers' => $workers
        ]);
    }
}
