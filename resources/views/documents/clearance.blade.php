@extends('documents.layout.pdf')

@section('content')
<div class="h-100 mt-20">
    <h5 class="uppercase font-bold text-xl text-center">Barangay Clearance</h5>

    <p class="mt-8 uppercase text-sm text-right">
        BC NO.: {{ $btc_no }}
    </p>

    <p class="mt-8 capitalize text-sm text-left">
        To Whom It May Concern,
    </p>

    <p class="indent-10 leading-relaxed mt-6">
        This is to certify that <span class="font-bold text-md">{{ $full_name }}</span>
        whose signature appears below, is a bonified resident of <span class="font-bold text-md"># {{ $complete_address }}</span>
        is cleared of any infraction to the peace of our barangay and has no record of violation nor violates any regulations
        and ordinances regaring health, pollution, order, convenience and safety of our residents. 
    </p>

    <p class="indent-10 leading-relaxed mt-8">
        That the Barangay Council of {{ config('setting.barangay') }} has no full objection to the application, and that this
        clearance is being issued for <span class="font-bold text-md underline">{{ $purpose }}</span> requirement.
    </p>

    <p class="indent-10 leading-relaxed mt-8">
        Issued this {{ $now }} at Barangay {{ config('setting.barangay') }}, {{ config('setting.city') }}. 
    </p>

    <div class="mt-8 flex justify-start">
        <div class="text-center">
            <p class="uppercase text-sm">
                _______________________________
            </p>
            <p class="text-sm">
                Signature
            </p>
        </div>
    </div>

    <div class="flex justify-end mt-8">
        <div class="text-center">
            <h5 class="uppercase font-bold text-lg">{{ config('setting.punong_barangay') }}</h5>
            <p>Punong Barangay</p>
        </div>
    </div>

    <div class="text-left mt-4">
        <p class="text-sm">CTC NO. <span class="underline">0712932</span></p>
        <p class="text-sm">Issued on: <span class="underline">{{ $issued_on }}</span></p>
        <p class="text-sm">Issued at: <span class="underline">{{ config('setting.city') }}</span></p>
        <p class="text-sm">Amount Paid: <span class="underline">{{ config('setting.amount_paid') }}</span></p>
    </div>

    <div class="absolute bottom-0 left-0 right-0">
        <footer class="text-center">
            <p class="text-sm uppercase">Official Document</p>
            <p class="text-sm uppercase">Not Valid Without Dry Seal</p>
        </footer>
    </div>
</div>
@endsection
