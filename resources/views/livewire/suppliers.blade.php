<div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $editing ? 'Editando Proveedor' : 'Creando Proveedor' }}</h4>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <label>Nombre</label>
                        <input wire:model.defer="supplier.name" id='inputFocus' type="text" class="form-control form-control-lg" placeholder="Razon Social del proveedor">
                        @error('supplier.name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>



                </div>


                <div class="form-footer">
                    <button class="btn btn-sm btn-dark float-left hidden {{ $editing ? 'd-block' : 'd-none' }}" wire:click="cancelEdit">
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
                            <h4 class="card-title mb-1">Proveedores</h4>
                            <p class="fs-14-mb-0">Listado Proveedores</p>
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
                                    <th class="text-center">Id</th>
                                    <th class="width=60%">Nombre</th>
                                    <th>Acciones</th>

                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($suppliers as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>
                                        <div>{{$item->name}}</div>
                                    </td>

                                    <td>

                                        <button class="btn tp-btn btn-xs btn-primary" wire:click="Edit({{ $item->id }})"><i class="las la-pen la-2x"></i>
                                        </button>


                                        <!--relacion de proveedores con producto-->
                                        @if(!$item->products()->exists())
                                        <button class="btn tp-btn btn-xs btn-danger" onclick="Confirm('suppliers',{{$item->id}} )">
                                            <i class="las la-trash-alt la-2x"></i>
                                        </button>
                                        @endif

                                    </td>


                                </tr>
                                @empty

                                <tr>
                                    <td colspan="3">No hay Proveedores Registrados</td>
                                </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            {{$suppliers->links()}}
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