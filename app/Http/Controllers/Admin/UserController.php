<?php

namespace App\Http\Controllers\Admin;

use App\Models\Staff;
use App\Exports\StaffExport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Traits\GenerateDataChartTrait;

class UserController extends Controller
{
    use GenerateDataChartTrait;

    public function index()
    {
        $staffs = Staff::with('user')->where('id', '!=', auth()->user()->idNv)->get();
        $data = $this->generateDataForChart();

        return view('admin.users', compact('staffs', 'data'));
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
