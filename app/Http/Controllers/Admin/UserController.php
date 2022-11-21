<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $sql = User::orderBy('name', 'ASC');

        if ($request->q) {
            $sql->where(function($q) use($request) {
                $q->where('name', 'LIKE', $request->q.'%')
                    ->orWhere('mobile', 'LIKE', $request->q.'%')
                    ->orWhere('email', 'LIKE', $request->q.'%');
            });
        }

        if ($request->type) {
            $sql->where('type', $request->type);
        }

        if ($request->status) {
            $sql->where('status', $request->status);
        }

        $records = $sql->paginate($request->limit ?? 15);

        return view('admin.user', compact('records'))->with('list', 1);
    }

    public function create()
    {
        return view('admin.user')->with('create', 1);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'mobile' => 'required|unique:users,mobile',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|max:20|min:8|confirmed',
            'type' => 'required|in:Admin,Staff',
            'status' => 'required|in:Active,Deactivated',
        ]);

        $storeData = [
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
            'status' => $request->status,
        ];
        User::create($storeData);

        $request->session()->flash('successMessage', 'User was successfully added!');
        return redirect()->route('users.create');
    }

    public function show(Request $request, $id)
    {
        $data = User::findOrFail($id);
        return view('admin.user', compact('data'))->with('show', $id);
    }

    public function edit(Request $request, $id)
    {
        $data = User::findOrFail($id);
        return view('admin.user', compact('data'))->with('edit', $id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'mobile' => 'required|unique:users,mobile,'.$id.',id',
            'email' => 'required|email|max:100|unique:users,email,'.$id.',id',
            'type' => 'required|in:Admin,Staff',
            'status' => 'required|in:Active,Deactivated',
        ]);

        $data = User::findOrFail($id);

        $storeData = [
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'type' => $request->type,
            'status' => $request->status,
        ];

        if ($request->password != '') {
            $this->validate($request, [
                'password' => 'required|max:20|min:8|confirmed',
            ]);
            $storeData['password'] = Hash::make($request->password);
        }

        $data->update($storeData);

        $request->session()->flash('successMessage', 'User was successfully updated!');
        return redirect()->route('users.index');
    }

    public function destroy(Request $request, $id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        $request->session()->flash('successMessage', 'User was successfully deleted!');
        return redirect()->route('users.index');
    }
}
