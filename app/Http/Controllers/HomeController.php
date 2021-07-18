<?php

namespace App\Http\Controllers;

use App\sysmenu;
use App\sysuser;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $categories = sysmenu::where('sysmenu_id', '0')
        //     ->with('childrenCategories')->get();
        return view('layout.app');
    }
    public function login(Request $request)
    {
        $session = $request->session()->exists('userid');
        if (!$session) {
            return view('auth.login');
        } else {
            redirect('/');
        }
    }
    public function masuk(Request $request)
    {
        $user_name = $request->input('txtuser');
        $pwd = sha1($request->input('txtpass'));
        $sys_user = new sysuser();
        $data = $sys_user::where([
            ['uname', '=', $user_name], ['upass', '=', $pwd]
        ])->get();
        $user = null;
        foreach ($data as $item) {
            $user = $item->uname;
            $nama = $item->namalengkap;
            $email = $item->email;
        }
        if ($user) {
            session([
                'userid' => $user,
                'nama' => $nama,
                'email' => $email,
            ]);
            $session = $request->session()->get('userid');
            if ($session) {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}
