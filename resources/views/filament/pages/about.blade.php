<x-filament::page>
    Static Content About

    <br>
    
    @foreach($content as $product)
        {{ $product->name }}
    @endforeach
</x-filament::page>
