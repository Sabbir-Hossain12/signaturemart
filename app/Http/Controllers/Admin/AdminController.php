<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (\request()->ajax()) {
            $admins = User::role('admin');

            return DataTables::eloquent($admins)
                ->addColumn('status', function ($admin) {
//                if(Auth::guard('admin')->user()->can('Status Admin')) {
                    if ($admin->status == 1) {
                        return ' <a class="status" id="adminStatus" href="javascript:void(0)"
                                               data-id="'.$admin->id.'" data-status="'.$admin->status.'"> <i
                                                        class="fa-solid fa-toggle-on fa-2x"></i>
                                            </a>';
                    } else {
                        return '<a class="status" id="adminStatus" href="javascript:void(0)"
                                               data-id="'.$admin->id.'" data-status="'.$admin->status.'"> <i
                                                        class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                                            </a>';
                    }
//                }

                })
                ->addColumn('role', function ($admin) {
                    $role = $admin->getRoleNames();
//                $string = implode(',', $role);

                    if (count($role)) {
                        return '<span class="badge bg-success">'.$role[0].'</span>';
                    }
                    return '';
                })
                ->addColumn('action', function ($admin) {
                    $editAction = '<a class="editButton btn btn-sm btn-primary" href="javascript:void(0)"
                                  data-id="'.$admin->id.'" data-bs-toggle="modal" data-bs-target="#editAdminModal">
                                   <i class="fas fa-edit"></i></a>';
                    $deleteAction = '<a class="btn btn-sm btn-danger" href="javascript:void(0)"
                                   data-id="'.$admin->id.'" id="deleteAdminBtn""> 
                                   <i class="fas fa-trash"></i></a>';

//              if(Auth::guard('admin')->user()->can('Edit Admin')) {
//
//                  $editAction= '<a class="editButton btn btn-sm btn-primary" href="javascript:void(0)"
//                                    data-id="'.$admin->id.'" data-bs-toggle="modal" data-bs-target="#editAdminModal">
//                                    <i class="fas fa-edit"></i></a>';
//
//              }
//
//              if(Auth::guard('admin')->user()->can('Delete Admin')) {
//
//                  $deleteAction= '<a class="btn btn-sm btn-danger" href="javascript:void(0)"
//                                    data-id="'.$admin->id.'" id="deleteAdminBtn""> 
//                                    <i class="fas fa-trash"></i></a>';
//
//              }

                    return '<div class="d-flex gap-3"> '.$editAction.$deleteAction.'</div>';
                })
                ->rawColumns(['action', 'status', 'role'])
                ->make(true);
        }
        
        $roles = Role::get();
        
        return view('admin.pages.admin.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function changeAdminStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if ($status == 1) {
            $stat = 0;
        } else {
            $stat = 1;
        }

        $page = User::findOrFail($id);
        $page->status = $stat;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $stat, 'id' => $id]);
    }
}
