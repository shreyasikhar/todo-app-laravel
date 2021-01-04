<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function uploadAvatar(Request $request) {
        // to store image inside storage/app/images/
        // $request->image->store('images');

        // to store image inside storage/public/images
        // $request->image->store('images', 'public');

        if($request->hasFile('image')) {
            User::uploadAvatar($request->image);

            $request->session()->flash('message', 'Image is uploaded');
            return redirect()->back();  // success msg
            // OR
            // return redirect()->back()->with('message', 'Image is uploaded');
        }
        $request->session()->flash('error', 'Image not uploaded');
        return redirect()->back();  // error msg
    }

    
    public function index() {
        // ELOQUENT ORM

        // insert
        // $data = [
        //     'name' => 'Elon',
        //     'email' => 'elon@gmail.com',
        //     'password' => 'password'
        // ];
        // User::create($data);
        // ------------------------------------
        // $user = new User();
        // $user->name = "Shreyas";
        // $user->email = "shreyasikhar26@gmail.com";
        // $user->password = bcrypt("password");
        // $user->save();

        // read
        $users = User::all();
        return $users;

        // delete
        // User::where('id', 2)->delete();

        // update
        // User::where('id', 3)->update(['name' => 'shreyasikhar']);
        // $users = User::all();
        // return $users;

        
        // RAW SQL QUERY 

        // DB::insert('insert into users(name, email, password) values (?,?,?)', [
        //     'shreyas', 'shreyasikhar26@gmail.com', 'password'
        // ]);

        // $users = DB::select('select * from users');
        // return $users;

        // DB::update('update users set name = ? where id = ?', [
        //     'Shreyas Ikhar', 1
        // ]);
        // $users = DB::select('select * from users');
        // return $users;

        // DB::delete('delete from users where id = ?', [
        //     1
        // ]);
        // $users = DB::select('select * from users');
        // return $users;
        return view('home');
    }
}
