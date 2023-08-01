@extends('layout.master')
@section('title','Registration Fee')
@section('content')
<h1 class="text-3xl font-bold mb-4">Payment Page</h1>

<div class="bg-white p-6 rounded shadow-md">
    @php
        $harga = rand(100000, 150000);
    @endphp
    <h2 class="text-xl font-bold mb-4">Price to Pay: ${{$harga}}</h2>

    @if(session('kembalian'))
        <div id="toast-message-cta" class="w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:bg-gray-800 dark:text-gray-400" role="alert">
            <div class="flex">
                <div class="ml-3 text-sm font-normal">
                    <span class="mb-1 text-sm font-semibold text-gray-900 dark:text-white">Notification</span>
                    <div class="mb-2 text-sm font-normal">You have kembalian that is {{ session('kembalian') }}. Do you want to save your money?</div>
                    <a href="/payment/save/{{ session('kembalian') }}" class="inline-flex px-2.5 py-1.5 text-xs font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">yes</a>
                </div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white justify-center items-center flex-shrink-0 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-message-cta" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif
    @if(session('error'))
    <div class="bg-red-200 border-l-4 border-red-500 text-red-700 p-4" role="alert">
        <p class="font-bold">Error</p>
        <p>{{ session('error') }}</p>
    </div>
    @endif
    <form action="/payment/{{$harga}}" method="POST" class="flex flex-col space-y-4">
        @csrf

        <label for="amount" class="font-semibold">Enter Amount to Pay:</label>
        <div class="relative">
            <span class="text-gray-500 absolute inset-y-0 left-0 pl-3 flex items-center">
                $
            </span>
            <input type="number" name="amount" id="amount" step="0.01" min="0" required
                class="block w-full py-2 pl-10 pr-3 rounded-lg border border-gray-400 focus:ring focus:ring-indigo-300 focus:border-indigo-300 focus:outline-none">
        </div>

        <button type="submit" class="bg-indigo-500 text-white font-semibold py-2 px-4 rounded">
            Pay Now
        </button>
    </form>
</div>
@endsection
