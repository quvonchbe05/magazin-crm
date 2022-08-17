<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Workers;
use App\Models\Role;
use App\Models\Workers as ModelsWorkers;
use Illuminate\Http\Request;
use Illuminate\Queue\Worker;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $roles = Role::orderByDesc('id')->get();
        $workers = ModelsWorkers::orderByDesc('id')->paginate(10);
        return view('auth.register',[
            'roles' => $roles,
            'workers' => $workers,
        ]);
    }

    public function register(Workers $request)
    {
        $worker = new ModelsWorkers();
        $fileName = time().'_'.$request->file('img')->getClientOriginalName();
        $filePath = $request->file('img')->storeAs('uploads', $fileName, 'public');
        $worker->role_id = $request->role;
        $worker->fish = $request->fish;
        $worker->phone1 = $request->phone1;
        $worker->phone2 = $request->phone2;
        $worker->t_sana = $request->t_sana;
        $worker->description = $request->desctription;
        $worker->password = Hash::make($request->password);
        $worker->email = $request->email;
        $worker->img = $fileName;
        $worker->img_path = '/storage/' . $filePath;
        $worker->save();
        return redirect()->back()->with('success',"Ishchi muvofaqiyatli ro'yxatga olindi!");
    }
}
