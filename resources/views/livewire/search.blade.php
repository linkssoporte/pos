<div class="input-group search-area d-xl-inline-flex d-none">
    <input wire:keydown.enter.prevent= "$emit('search', $event.target.value)" type="text" class="form-control" 
    placeholder="Buscar..." id="searchInput">
    <div class="input-group-append">
        <button class="input-group-text"><i class="flaticon-381-search-2"></i></button>
    </div>

    @push('my-scripts')
    <script>
        //script para vaciar el search despues de ejecutar o presionar Enter
        livewire.on('search', event => {

            document.getElementById('searchInput').value=''
        })

    </script>
    @endpush

</div>