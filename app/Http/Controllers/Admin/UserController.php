<?php

namespace App\Http\Controllers\Admin;

use App\Exports\StaffExport;
use App\Models\Staff;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;

class UserController extends Controller
{
    public function index()
    {
        $staffs = Staff::with('user')->where('id', '!=', auth()->user()->idNv)->get();

        return view('admin.users', compact('staffs'));
    }

    public function show($id)
    {
        $staff = Staff::with(['diaries', 'user'])->find($id);

        return view('admin.staff', compact('staff'));
    }

    public function profile()
    {
        $staff = Staff::with(['diaries', 'user'])->find(auth()->user()->idNv);

        return view('admin.profile', compact('staff'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        $user = auth()->user();

        if ($request->name) {
            $user->update([
                'name' => $request->name,
            ]);
            $user->staff->update([
                'name' => $request->name,
            ]);
        }

        if ($request->email) {
            $user->update([
                'email' => $request->email,
            ]);
        }

        if ($request->password) {
            $user->update([
                'password' => $request->password,
            ]);
        }

        return redirect()->back();
    }

    public function export()
    {
        return Excel::download(
            new UsersExport(Staff::with('user')->where('id', '!=', auth()->user()->idNv)->get()),
            'users.xlsx'
        );
    }

    public function staffExport($id)
    {
        return Excel::download(
            new StaffExport(Staff::with(['diaries', 'user'])->find($id)),
            'users.xlsx'
        );
    }
}
