<div>
    <div class="flex justify-center" wire:poll.5s>
        <p class="absolute top-1/4 text-white text-7xl font-medium text-center uppercase">SELAMAT DATANG KE<br> ALAMANDA</p>
        <p class="absolute top-1/3 text-green-400 text-15xl font-bold right-36">{{ $count ?? 0 }}</p>

        <div class="absolute bottom-1/4">
            <p class="text-white text-7xl font-medium text-center uppercase">AUTOMATED LICENSE<br>PLATE RECOGNITION</p><br>
            <p class="text-white text-7xl font-medium text-center uppercase mt-8">PLEASE ENTER</p>
        </div>
    </div>
    <div class="absolute bottom-0 right-6">
        <div class="flex justify-end">
            <p class="p-6 text-black text-3xl font-bold text-right">{{ $datetime }}</p>
        </div>
    </div>
</div>
