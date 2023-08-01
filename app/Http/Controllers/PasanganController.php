<?php

namespace App\Http\Controllers;

use App\Models\Pasangan;
use App\Models\User;
use Illuminate\Http\Request;

class PasanganController extends Controller
{
    public function Nembak($couplename) {
        // dd($couplename);
        $couple = new Pasangan();
        $couple->user1_id = auth()->user()->id;
        $user2 = User::where('name', $couplename)->first();
        // dd($user2);
        $couple->user2_id = $user2->id;
        $couple->Status = "waiting";
        $couple->save();
        return redirect('/Matches');
    }

    public function Showmatch(){
        // $couples = Pasangan::where('user2_id',auth()->user()->id)->get();
        $couples = Pasangan::all();
        // $couples = Pasangan::All();
        // dd($couples);
        return view('matches',compact('couples'));
    }

    public function terima($idcouple){
        $couple = Pasangan::where('id',$idcouple)->first();
        $couple->Status = "Pasangan";
        $couple->update();
        return redirect('/Matches');
    }
}
