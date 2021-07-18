<?php

namespace App\Http\Controllers;

use App\sysmenu;
use App\sysuser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // $categories = sysmenu::where('sysmenu_id','=','0')
        // ->with('childrenCategories')
        // ->get();
        return view('master.user');
    }
    public function list(Request $request)
    {
        $data = sysuser::select('id', 'uname', 'namalengkap', 'email')->get();
        $table['draw'] = '1';
        $table['recordsTotal'] = count($data);
        $table['recordsFiltered'] = count($data);
        $table['data'] = $data;
        return json_encode($table);
    }
    public function tambah(Request $request)
    {
        return view('master.useradd');
    }
    public function simpan(Request $request)
    {
        $user = new sysuser;
        $user->namalengkap = $request->txtnama;
        $user->email = $request->txtemail;
        $user->uname = $request->txtuname;
        $user->upass = $request->txtupass;
        $user->save();
        return view('master.user');
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = sysuser::where('id', $id)->first();
        return view('master.useredit', ['user' => $data]);
    }
    public function update(Request $request)
    {
        $id      = $request->txtid;
        $sysuser = new sysuser;
        $sysuser->where('id', $id)
            ->update([
                'namalengkap' => $request->txtnama,
                'email' => $request->txtemail,
                'uname' => $request->txtuname,
                'upass' => $request->txtupass,
            ]);
        return view('master.user');
    }
}
