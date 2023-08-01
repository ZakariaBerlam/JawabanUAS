@extends('layout.master')
@section('title','Home')
@section('content')
@foreach ($Pengguna as $user)
<div class="max-w-sm rounded overflow-hidden shadow-lg">
    <img class="w-full" src="{{asset('storage/'. $user->profileimage)}}" alt="Sunset in the mountains">
    <div class="px-6 py-4">
      <div class="font-bold text-xl mb-2">{{$user->name}}</div>
      <p class="text-gray-700 text-base">
        Hobby:
      </p>
    </div>
    @php
        $hobby = App\Models\Hobby::where('user_id',$user->id)->get();
    @endphp

    <div class="px-6 pt-4 pb-2">
        @foreach ($hobby as $kesenangan )
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{$kesenangan->hobby}}</span>
        @endforeach
    </div>
  </div>
@endforeach
@endsection

