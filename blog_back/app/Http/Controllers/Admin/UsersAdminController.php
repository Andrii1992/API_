<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function showUsersEdition(UsersRepository $users, Request $req)
    {
        $dane = $users->search('name', $req->search, $req->sort, $req->by, $req->records)->appends(request()->input());
        return view('admin.users.show', ["dane" => $dane, "search" => $req->search, "sort" => $req->sort, "by" => $req->by, "records" => $req->records]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStore(UsersRepository $rep, Request $req)
    {
        $req->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8|confirmed',
        ]);
        $user = $rep->create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
        ]);

        // $user->assignRole('user');
        if ($req->role !== "brak") {
            $user->assignRole($req->role);
        }

        return redirect('admin/uzytkowniki');
    }
    public function create()
    {
        return view('admin.users.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(UsersRepository $rep, $id)
    {
        $id = preg_replace('/[^0-9]/', '', $id);
        $rep->delete($id);
        return redirect('admin/uzytkowniki')->with('message', " id " . $id . " usunięto");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(UsersRepository $users, $id)
    {
        $id = preg_replace('/[^0-9]/', '', $id);
        $user = $users->find($id);
        return view('admin.users.edit', ["user" => $user, "rola" => $user->getRole()]);
    }
    public function editStore(Request $req, UsersRepository $rep)
    {


        $user = $rep->find($req->input('id'));
        //  dd(Role::findOrFail($req->input('id')));
        if ($req->password) {

            if ($req->email !== $user->email) {
                $req->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|email|unique:users|max:255',
                    'password' => 'required|min:8|confirmed',
                ]);

                $user->name = $req->name;
                $user->password = $req->password;
                $user->email = $req->email;
            } else {
                $req->validate([
                    'name' => 'required|max:255',
                    'password' => 'required|min:8|confirmed',
                ]);

                $user->name = $req->name;
                $user->password = $req->password;
            }
        } else {

            if ($req->email !== $user->email) {
                $req->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|email|unique:users|max:255',
                ]);

                $user->name = $req->name;
                $user->email = $req->email;
            } else {
                $req->validate([
                    'name' => 'required|max:255',
                ]);
                $user->name = $req->name;
            }
        }

        if ($req->role !== "brak") {
            if ($req->role === "admin") {
                if ($user->getRole() !== "none") {
                    $user->removeRole($user->roles->first());
                    $user->assignRole("admin");
                } else {
                    $user->assignRole("admin");
                }
            } else {
                if ($user->getRole() !== "none") {
                    $user->removeRole($user->roles->first());
                    $user->assignRole("user");
                } else {
                    $user->assignRole("user");
                }
            }
        } else {
            $user->removeRole($user->roles->first());
        }

        $user->save();
        return redirect('admin/uzytkowniki');
    }
    public static function search(UsersRepository $users, Request $req)
    {
        $dane = $users->search('name', $req->searchU, 'created_at', 'desc', 3)->appends(request()->input());

        return view('admin.users.search', ["dane" => $dane, "searchU" => $req->searchU]);
    }
}
