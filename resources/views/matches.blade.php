@extends('layout.master')
@section('title','Match')
@section('content')

<div class="w-full h-fit bg-blue-700 mt-40">
    <H1 class="text-xl">Outgoing Request</H1>
        @php
             $couples = App\Models\Pasangan::where('user1_id',auth()->user()->id)->get()
        @endphp
        @foreach ($couples as $pasa)
        @php
            $pasangan = App\Models\User::where('id',$couple->user2_id)->first();
        @endphp
        <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
        <img class="w-full" src="{{asset('storage/'.$pasangan->profileimage)}}" alt="Sunset in the mountains">
        <div class="px-6 py-4">
          <div class="font-bold text-xl mb-2">{{$pasangan->name}}</div>
          <p class="text-gray-700 text-base">
            Hobby:
          </p>
        </div>
        @php
            $hobby = App\Models\Hobby::where('user_id',$pasangan->id)->get();
        @endphp

        <div class="px-6 pt-4 pb-2">
            @foreach ($hobby as $kesenangan )
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{$kesenangan->hobby}}</span>
            @endforeach
        </div>
        <a href="/match/accept/{{$couple->id}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Accept
             <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </a>
      </div>
        @endforeach
</div>


<div class="w-full h-fit bg-zinc-700 mt-40">
    <H1 class="text-xl">Request Invitation</H1>
    @php
        $couples1 = App\Models\Pasangan::where('user2_id',auth()->user()->id)->get()
    @endphp
    @foreach ($couples1 as $couple)
    @if($couple->Status == "waiting"){
        @php
            $pasangan = App\Models\User::where('id',$couple->user1_id)->first();
        @endphp
        <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
            <img class="w-full" src="{{asset('storage/'.$pasangan->profileimage)}}" alt="Sunset in the mountains">
            <div class="px-6 py-4">
              <div class="font-bold text-xl mb-2">{{$pasangan->name}}</div>
              <p class="text-gray-700 text-base">
                Hobby:
              </p>
            </div>
            @php
                $hobby = App\Models\Hobby::where('user_id',$pasangan->id)->get();
            @endphp

            <div class="px-6 pt-4 pb-2">
                @foreach ($hobby as $kesenangan )
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{$kesenangan->hobby}}</span>
                @endforeach
            </div>
            <a href="/match/accept/{{$couple->id}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Accept
                 <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
          </div>
    }
    @endif
    @endforeach
</div>


<div class="w-full h-fit bg-pink-700 my-50">
    <H1 class="text-xl">Matched</H1>
    @php
        $couples2 = App\Models\Pasangan::where('user2_id',auth()->user()->id)->get()
    @endphp
    @foreach ($couples2 as $couple)
    @if($couple->Status == "Pasangan"){
        @php
            $pasangan = App\Models\User::where('id',$couple->user1_id)->first();
        @endphp
        <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white-500">
            <img class="w-full" src="{{asset('storage/'.$pasangan->profileimage)}}" alt="Sunset in the mountains">
            <div class="px-6 py-4">
              <div class="font-bold text-xl mb-2">{{$pasangan->name}}</div>
              <p class="text-gray-700 text-base">
                Hobby:
              </p>
            </div>
            @php
                $hobby = App\Models\Hobby::where('user_id',$pasangan->id)->get();
            @endphp

            <div class="px-6 pt-4 pb-2">
                @foreach ($hobby as $kesenangan )
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{$kesenangan->hobby}}</span>
                @endforeach
            </div>
            <a href="/match/{{$pasangan->name}}">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                   Send a chat
                  </button>
            </a>
          </div>
    }
    @endif
    @endforeach
</div>
@endsection
