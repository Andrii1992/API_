<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersAdminController extends Controller
{

    public function showUsersEdition(UsersRepository $users, Request $req)
    {
        // $data =  $users->getAllUsersEdition();

        $data = $users->search('name', $req->search, $req->sort, $req->by, $req->records)->appends(request()->input());

        // $dane = $users->search('name', $req->searchU, 'created_at', 'desc', 3)->appends(request()->input());

        return response()->json(compact('data'), 200);
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
            'password' => 'required|min:6|confirmed',
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
        return response()->json('Ok', 200);
    }

    public function delete(UsersRepository $rep, $id)
    {
        $id = preg_replace('/[^0-9]/', '', $id);
        $rep->delete($id);
        $message  = " id " . $id . " usunięto";
        return response()->json($message, 200);
    }

    public function edit(UsersRepository $users, $id)
    {
        $id = preg_replace('/[^0-9]/', '', $id);
        $user = $users->find($id);
        $rola = $user->getRole();
        return response()->json(compact('user', 'rola'), 200);
    }
    public function editStore(Request $req, UsersRepository $rep)
    {
        $user = $rep->find($req->input('id'));
        if ($req->password) {

            if ($req->email !== $user->email) {
                $req->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|email|unique:users|max:255',
                    'password' => 'required|min:6|confirmed',
                ]);

                $user->name = $req->name;
                $user->password = $req->password;
                $user->email = $req->email;
            } else {
                $req->validate([
                    'name' => 'required|max:255',
                    'password' => 'required|min:6|confirmed',
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
        return response()->json('Ok', 200);
    }
    public static function search(UsersRepository $users, Request $req)
    {
        $dane = $users->search('name', $req->searchU, 'created_at', 'desc', 3)->appends(request()->input());

        return response()->json($dane, 200);
    }
}
