<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\Pasangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\ElseIf_;

class LoginController extends Controller
{

    public function Home(){
        $userId = auth()->id();

        $couple = Pasangan::where('user1_id', $userId)
            ->orWhere('user2_id', $userId)
            ->get();

        $excludeUserIds = $couple->pluck('user1_id')->merge($couple->pluck('user2_id'))->unique();

        $Pengguna = User::whereNotIn('id', $excludeUserIds)
            ->whereNotIn('id', [$userId]) // Exclude the currently authenticated user's ID
            ->get();
        return view('homelog', compact('Pengguna'));
    }

    public function ShowGender1(){
        $userId = auth()->id();

        $couple = Pasangan::where('user1_id', $userId)
            ->orWhere('user2_id', $userId)
            ->get();

        $excludeUserIds = $couple->pluck('user1_id')->merge($couple->pluck('user2_id'))->unique();

        $Pengguna = User::whereNotIn('id', $excludeUserIds)
            ->whereNotIn('id', [$userId])
            ->where('gender','L') // Exclude the currently authenticated user's ID
            ->get();
        return view('homelog', compact('Pengguna'));
    }

    public function ShowGender2(){
        $userId = auth()->id();

        $couple = Pasangan::where('user1_id', $userId)
            ->orWhere('user2_id', $userId)
            ->get();

        $excludeUserIds = $couple->pluck('user1_id')->merge($couple->pluck('user2_id'))->unique();

        $Pengguna = User::whereNotIn('id', $excludeUserIds)
            ->whereNotIn('id', [$userId])
            ->where('gender','P') // Exclude the currently authenticated user's ID
            ->get();
        return view('homelog', compact('Pengguna'));
    }

    public function defaultpage(){
        $Pengguna = User::all();
        return view('home',compact('Pengguna'));
    }

    public function Register(Request $request){
        $validate = $request->validate([
            'name'=>'required|min:4',
            'email'=>'required|email',
            'password'=>'required',
            'gender'=>'required',
            'instagram'=>'nullable',
            // 'hobby1'=>'required',
            // 'hobby2'=>'required',
            // 'hobby3'=>'required',
            'phone'=>'required|numeric',
            'profileimage'=>'image'
        ]);
        if ($request->file('profileimage')) {
            $path = $request->file('profileimage')->store('profile-picture', 'public');
            $validate['profileimage'] = $path;
        }
        $validate['instagram'] = 'http://www.instagram.com/'.$validate['name'];
        $validate['password'] = bcrypt($validate['password']);
        $hayato = User::create($validate);
        $Hobby = $request->validate([
            'hobby1'=>'required'
        ]);
        $hobby = new Hobby();
        $hobby->hobby = $Hobby['hobby1'];
        $hobby->user_id = $hayato->id;
        $hobby->save();
        $Hobby = $request->validate([
            'hobby2'=>'required'
        ]);
        $hobby = new Hobby();
        $hobby->hobby = $Hobby['hobby2'];
        $hobby->user_id = $hayato->id;
        $hobby->save();
        $Hobby = $request->validate([
            'hobby3'=>'required'
        ]);
        $hobby = new Hobby();
        $hobby->hobby = $Hobby['hobby3'];
        $hobby->user_id = $hayato->id;
        $hobby->save();
        return redirect('/register/payment');
    }

    public function LogIn(Request $request){
        $validate = $request->validate([
            'password'=>'required',
            'email'=>'required|email:dns'
        ]);
        if(Auth::attempt($validate)){
            $request->session()->regenerate();
            $role = auth()->user()->role;
        }
        return redirect('/home');
    }

    public function pembayaran(Request $request, $harga){
        $uang = $request->input('amount');
        if($harga>$uang){
            return redirect()->back()->with("error", "You don't have enough money. You need $" . ($harga - $uang));
        }
        elseif ($harga < $uang) {
            $kembalian = $uang - $harga;
            return redirect()->back()->withInput()->with("kembalian", $kembalian);
        }
        return redirect('/login');
    }

    public function simpen($uang){
        $user = User::latest()->first();
        $user->wallet =  $uang;
        $user->update();
        return redirect('/login');
    }

    public function LogOut(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }

    public function topup(Request $request){
        $user = User::find(auth()->user()->id);
        $user->wallet = $user->wallet + $request->wallet;
        $user->update();
        return redirect('/home');
    }
}
