<!-- Modal -->
<div id="modalViewProduct" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del modal-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Informacion del Producto</h4>
            </div>
            <div class="modal-body">
                @if($productSelected !=null)

                <div class="row">
                    <div class="col-md-6">
                        <!-- Mostrar la primera imagen del producto o una imagen por defecto si no hay imágenes -->
                        <img src="{{ asset($productSelected->photo) }}" class="img-fluid rounded"
                            alt="{{ $productSelected->name }}">
                    </div>
                    <div class="col-md-6">
                        <!-- Mostrar la información del producto -->
                        <h3>{{ $productSelected->name }}</h3>
                        <p>{{ $productSelected->description ?? 'Sin descripción' }}</p>
                        <p><strong>SKU:</strong> {{ $productSelected->sku }}</p>
                        <p><strong>Tipo:</strong> {{ ucfirst($productSelected->type) }}</p>
                        <p><strong>Estado:</strong> {{ ucfirst($productSelected->status) }}</p>
                        <p><strong>Visble:</strong> {{ ucfirst($productSelected->visibility) }}</p>
                        <p><strong>Precio regular:</strong> ${{ $productSelected->price }}</p>
                        <p><strong>Precio Venta:</strong> ${{ $productSelected->price2 }}</p>
                        <p><strong>Stock:</strong> {{ ucfirst($productSelected->stock_status) }}</p>
                        <p><strong>Stock Cant.:</strong> {{ $productSelected->stock_qty }}</p>
                        <p><strong>Stock Min.:</strong> {{ $productSelected->low_stock }}</p>
                        <p><strong>Proveedor:</strong> {{ $productSelected->supplier->name }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="tab-slide-content new-arrival-product mb-4 mb-xl-0">
                            <!-- Nav tabs -->
                            <ul class="nav slide-item-list mt-3" role="tablist">
                                @if ($productSelected->images)
                                @foreach ($productSelected->images as $image)
                                <li role="presentation" class="show">
                                    <a href="#first" role="tab" data-toggle="tab">
                                        <img class="img-fluid rounded"
                                            src="{{ asset('storage/products/' . $image->file)}}" alt="" width="50">
                                    </a>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>