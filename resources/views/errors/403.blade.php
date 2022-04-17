@extends('errors.layout.error')

@section('title')
    Error 403
@endsection

@section('content')
    <div class="bg-white w-full">
        <div class="flex flex-col h-screen">
            <div class="m-auto text-center">
                <div class="flex justify-center">
                    <x-jet-application-mark width="100" class="block h-9 w-auto" />
                </div>
                <h5 class="text-blue-600 font-bold uppercase mt-14">403 Page</h5>
                <h1 class="font-black text-4xl mt-2">Unauthorized Action</h1>
                <p class="text-gray-500 text-lg mt-2">{{ $exception->getMessage() }}
                </p>

                <a href="{{ route('dashboard') }}">
                    <button class="text-blue-600 hover:text-blue-800 text-xl font-bold mt-20">
                        <div class="flex items-center justify-center">
                            <div class="">
                                Go back
                            </div>
    
                            <div class="ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-right"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <line x1="15" y1="16" x2="19" y2="12"></line>
                                    <line x1="15" y1="8" x2="19" y2="12"></line>
                                </svg>
                            </div>
                        </div>
                    </button>
                </a>
            </div>
        </div>
    </div>
@endsection
