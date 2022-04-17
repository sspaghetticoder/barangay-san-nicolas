@extends('documents.layout.pdf')

@section('content')
<div class="h-100 mt-60">
    <h5 class="uppercase font-bold text-xl text-center">Certificate of Residency</h5>

    <p class="indent-10 leading-loose mt-8">
        This is to certify that <span class="font-bold text-md">{{ $full_name }}</span>
        is a resident of <span class="font-bold text-md"># {{ $complete_address }}</span>.
    </p>

    <p class="indent-10 leading-loose mt-8">
        This certification is being issued this {{ $now }} as requested by {{ $prefixed_last_name }}
        as a proof of <span class="lowercase">{{ $adjective }}</span> residency for <span class="font-bold text-md">{{ $purpose }}</span>
        requirement.
    </p>

    <div class="flex justify-end mt-24">
        <div class="text-center">
            <h5 class="uppercase font-bold text-lg">{{ config('setting.punong_barangay') }}</h5>
            <p>Punong Barangay</p>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0">
        <footer class="text-center">
            <p class="text-sm uppercase">Official Document</p>
            <p class="text-sm uppercase">Not Valid Without Dry Seal</p>
        </footer>
    </div>
</div>
@endsection
