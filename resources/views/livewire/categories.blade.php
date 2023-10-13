<div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $editing ? 'Editando Categoria' : 'Creando Categoria' }}</h4>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <label>Nombre</label>
                        <input wire:model.defer="category.name" id='inputFocus' type="text"
                            class="form-control form-control-lg" placeholder="Nombre de la Categoria">
                        @error('category.name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="input-group">
                        <label class="custom-file-label">Imagen</label>
                        <div class="custom-file">
                            <input wire:model="upload" type="file" class="custom-file-input"
                                accept="image/x-png, image/jpeg, image/jpg">

                        </div>
                        @error('category.image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>

                    <!-- previsualizar imagen-->
                    @if ($upload != null)
                    <div class="form-group mt-2">
                        <img class="img-fluid rounded" src="{{ $upload->temporaryUrl() }}" width="100">
                        <h6 class="text-muted">Nueva Imagen</h6>
                    </div>
                    @elseif ($category != null && $category->id != null)
                    <div class="form-group mt-2">
                        <img class="img-fluid rounded" src="{{ $savedImg }}" width="100">
                        <h6 class="text-muted">Imagen Actual</h6>
                    </div>
                    @endif


                </div>


                <div class="form-footer">
                    <button class="btn btn-sm btn-dark float-left hidden {{ $editing ? 'd-block' : 'd-none' }}"
                        wire:click="cancelEdit">
                        Cancelar
                    </button>

                    <button class="btn btn-sm btn-info float-right save" wire:click="Store">
                        Guardar
                    </button>
                </div>



            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="separator"></div>
                        <div class="mr-auto">
                            <h4 class="card-title mb-1">Categorias</h4>
                            <p class="fs-14-mb-0">Listado Registrado</p>
                        </div>


                    </div>

                    <button class="btn btn-success btn-xs" wire:click="Add">
                        <i class="las la-plus la-2x"></i>
                    </button>



                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md table-hover text-center">
                            <thead class="thead-primary">
                                <tr>
                                    <th class="text-center">Imagen</th>
                                    <th class="width=60%">Nombre</th>
                                    <th>Acciones</th>

                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($categories as $item)
                                <tr>
                                    <td class="text-center">
                                        <img class="img-fluid rounded" src="{{ $item->picture }}" alt="pic" width="50">
                                    </td>

                                    <td>{{$item->name}}</td>

                                    <td>

                                        <button class="btn tp-btn btn-xs btn-primary"
                                            wire:click="Edit({{ $item->id }})"><i class="las la-pen la-2x"></i>
                                        </button>
                                        <button class="btn tp-btn btn-xs btn-danger"
                                            onclick="Confirm('categories',{{$item->id}} )">
                                            <i class="las la-trash-alt la-2x"></i>
                                        </button>



                                    </td>


                                </tr>
                                @empty

                                <tr>
                                    <td colspan="3">No hay Categorias Registradas</td>
                                </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            {{$categories->links()}}
                        </div>
                        <div class=" col-md-6"><span class="float-right">Registros: {{$records}}</span>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <script>
    document.addEventListener('stop-loader', (event) => {
        SlickLoader.disable()
    })
    </script>

</div>