@extends('layout.master')
@section('title','Register')
@section('content')
    <!-- component -->
    <div class="bg-grey-lighter min-h-screen flex flex-col">
        <div class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2">
            <div class="bg-white px-6 py-8 rounded shadow-md text-black w-full">
                <h1 class="mb-8 text-3xl text-center">Sign up</h1>

                <form action="/register" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" name="name"
                        placeholder="Full Name" required />

                    <input type="email" class="block border border-grey-light w-full p-3 rounded mb-4" name="email"
                        placeholder="Email" required />

                    <input type="password" class="block border border-grey-light w-full p-3 rounded mb-4" name="password"
                        placeholder="Password" required />

                    <h1 class="mb-8 text-l text-center">Insert at least 3 Hobbies, you can add another hobby on profile page later</h1>

                    <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" name="hobby1"
                        placeholder="Hobby 1" required />

                    <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" name="hobby2"
                        placeholder="Hobby 2" required />

                    <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" name="hobby3"
                        placeholder="Hobby 3" required />

                    <input type="numeric" class="block border border-grey-light w-full p-3 rounded mb-4" name="phone"
                        placeholder="Phone Number" required />

                    <div class="my-4">
                        <input type="radio" name="gender" id="L" value="L" required>
                        <label for="L">Laki-laki</label>
                        <input type="radio" name="gender" id="P" value="P" required>
                        <label for="P">Perempuan</label>
                    </div>



                    <div class="my-4">
                        <label class="mx-5 block mb-2 text-sm font-medium text-gray-900 dark:text-gray" for="file_input">Upload Profile Picture</label>
                        <input name="profileimage" class="mx-5 block w-300 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file">
                        <p class="mx-5 mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
                    </div>


                    <button type="submit"
                        class="w-full text-center bg-green-400 py-3 rounded-md text-white hover:bg-blue-400">Create
                        Account</button>
                </form>
                <div class="text-grey-dark mt-6">
                    Already have an account?
                    <a class="no-underline border-b border-blue text-blue" href="../login/">
                        Log in
                    </a>.
                </div>
            </div>
        </div>
@endsection

