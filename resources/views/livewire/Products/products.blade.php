<div>
    <div class="row" id="cardTable" style="display: {{ $action == 1 ? 'block' : 'none' }}">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header ">
                    <div class="d-flex">
                        <div class="separator"></div>
                        <div class="mr-auto">
                            <h4 class="card-title mb-1">Productos</h4>
                            <p class="fs-14 mb-0"> Productos Registrados</p>
                        </div>
                    </div>
                    <div class="float-right">
                        <button class="btn tp-btn-light btn-success btn-xs" wire:click="SyncDown">
                            <i class="las la-download la-2x"></i>
                        </button>
                        <button class="btn tp-btn-light btn-success btn-xs" wire:click.prevent="$set('action',2)">
                            <i class="las la-plus la-2x"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md table-hover  text-center" id="tblProducts">
                            <thead class="thead-primary">
                                <tr>
                                    <th width="80"></th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Estado</th>
                                    <th>Visible</th>
                                    <th>Precio Regular</th>
                                    <th>Precio venta</th>
                                    <th>Stock </th>
                                    <th>Existencia</th>
                                    <th>Stock Cant.</th>
                                    <th>Stock Min.</th>
                                    <th>Categoria</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $item)
                                <tr>
                                    <td>
                                        <img alt="photo" class="img-fluid rounded gallery-item" src="{{ asset($item->photo) }}" data-src="{{ asset($item->photo) }}">
                                    </td>
                                    <td>
                                        <div class="{{ $item->platform_id !=null ? 'text-success' : '' }}">{{$item->name }}</div>
                                        <small>SKU:{{$item->sku}}</small>
                                        <small>${{$item->woocommerce_sales}}</small>
                                    </td>
                                    <td>{{$item->type }}</td>
                                    <td>{{$item->status }}</td>
                                    <td>{{$item->visibility }}</td>
                                    <td>${{$item->price }} </td>
                                    <td>${{$item->price2 }}</td>
                                    <td>{{$item->stock_status }}</td>
                                    <td>{{$item->manage_stock == 1 ? 'yes' : 'no' }}</td>
                                    <td>{{$item->stock_qty }}</td>
                                    <td>{{$item->low_stock }}</td>
                                    <td>
                                         <small> {{implode(", ", $item->categories->pluck('name')->toArray())}}</small> 
                                    </td>

                                    <td>
                                        <div class="dropdown position-static">
                                            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#" wire:click.prevent="viewProduct({{ $item->id }})"><i class="las la-eye la-2x"></i> View</a>
                                                <a class="dropdown-item" href="#" wire:click.prevent="Edit({{ $item->id }})"><i class="las la-pen la-2x"></i> Edit</a>
                                                <a class="dropdown-item" href="#" onclick="Confirm('products',{{ $item->id }})"><i class="las la-trash-alt la-2x"></i> Delete</a>
                                                @if($item->platform_id == null)
                                                <a class="dropdown-item save" href="#" wire:click.prevent="Sync({{ $item->id }})"><i class="las la-sync la-2x"></i> Sync</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>


                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3">No hay products</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            {{$products->links()}}
                        </div>
                        <div class="col-md-6"><span class="float-right">Registros:{{$records}}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- card form --}}
    @include('livewire.Products.form')
    @include('livewire.Products.view')

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    @include('livewire.products.js')
    @push('my-scripts')
    @endpush

    <style>
        .ts-control {
            padding: 0px !important;
            border-style: none;
            border-width: 0px !important;
            background-color: #0E0803
        }
    </style>
</div>