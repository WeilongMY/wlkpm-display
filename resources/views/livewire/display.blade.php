<div>
    <div class="flex justify-center" wire:poll.3s>
        <p class="absolute top-1/4 text-white text-7xl font-medium text-center">{!! $greeting !!}</p>
        <p class="absolute top-1/3 text-green-400 text-15xl font-bold right-48">{{ $count }}</p>

{{--        <p class="absolute bottom-1/3 text-white text-4xl font-bold text-center">WAKTU SOLAT PUTRAJAYA</p>--}}
{{--        <div class="absolute bottom-1/3 text-white text-5xl font-bold text-center">WE CAPTURED YOUR CARPLATE! <br> PLEASE PAY AT EXIT.</div>--}}
    </div>
    <div class="absolute top-2/3 pt-8">
        <div class="flex justify-center flex-wrap">
{{--            @foreach($times as $key => $time)--}}
{{--                <p class="text-white text-4xl font-medium text-center uppercase w-full py-1">{{ $key }} - {{ $time }}</p>--}}
{{--            @endforeach--}}
        </div>
    </div>
    <div class="absolute bottom-0 right-6">
        <div class="flex justify-end">
            <p class="p-6 text-black text-3xl font-bold text-right">{{ \Carbon\Carbon::now()->format('l, d M Y') }} | {{ \Carbon\Carbon::now()->format('H:i') }} | {{ Alkoumi\LaravelHijriDate\Hijri::Date('l ، j F ، Y', Carbon\Carbon::now()) }}</p>
        </div>
    </div>
</div>
