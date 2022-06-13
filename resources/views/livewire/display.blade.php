<div>
    <div class="flex justify-center" wire:poll.3s>
        <p class="absolute top-1/4 text-white text-7xl font-medium text-center uppercase">{!! $greeting !!}</p>
        <p class="absolute top-1/3 text-green-400 text-15xl font-bold right-36">{{ $count }}</p>

        <div class="absolute bottom-1/4">
            <p class="text-white text-7xl font-medium text-center uppercase">{!! $message !!}</p><br>
            <p class="text-white text-7xl font-medium text-center uppercase mt-8">{!! $info !!}</p>
        </div>
    </div>
    <div class="absolute bottom-0 right-6">
        <div class="flex justify-end">
            <p class="p-6 text-black text-3xl font-bold text-right">{{ \Carbon\Carbon::now()->format('l, d M Y') }} | {{ \Carbon\Carbon::now()->format('H:i') }} | {{ Alkoumi\LaravelHijriDate\Hijri::Date('l ، j F ، Y', Carbon\Carbon::now()) }}</p>
        </div>
    </div>
</div>
