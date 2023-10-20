<div id="cardForm" style="display: {{ $action !=1 ? 'block' : 'none' }}">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header ">
                    <h4 class="card-title mb-1">{{ $action == 2 ? 'Create Product' : 'Edit Product' }}</h4>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-12 col-md-8">
                            <label>Name</label>
                            <input wire:model.defer="product.name" id='inputFocus' type="text"
                                class="form-control form-control-lg" placeholder="Name">
                            @error('product.name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label>Sku</label>
                            <input wire:model.defer="product.sku" type="text" class="form-control form-control-lg"
                                placeholder="Name">
                            @error('product.sku') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-12">
                            <label>Description</label>
                            <input wire:model.defer="product.description" type="text"
                                class="form-control form-control-lg" placeholder="description">
                            @error('product.description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-12 col-md-4">
                            <label>Type</label>
                            <select wire:model.defer='product.type' class="form-control  form-control-lg">
                                <option value="simple">Simple</option>
                                <option value="variable">Variable</option>
                            </select>
                            @error('product.type') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label>Status</label>
                            <select wire:model.defer='product.status' class="form-control  form-control-lg">
                                <option value="publish">Publish</option>
                                <option value="pending">Pending</option>
                                <option value="draft">Draft</option>
                            </select>
                            @error('product.status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label>Visibility</label>
                            <select wire:model.defer='product.visibility' class="form-control  form-control-lg">
                                <option value="visible">Visible</option>
                                <option value="hide">Hide</option>
                            </select>
                            @error('product.visibility') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-12 col-md-4">
                            <label>Regular Price</label>
                            <input wire:model.defer="product.price" type="number" class="form-control form-control-lg"
                                placeholder="0.00">
                            @error('product.price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label>Sale Price</label>
                            <input wire:model.defer="product.price2" type="number" class="form-control form-control-lg"
                                placeholder="0.00">
                            @error('product.price2') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label>Stock Status</label>
                            <select wire:model.defer='product.stock_status' class="form-control  form-control-lg">
                                <option value="instock">In Stock</option>
                                <option value="outofstock">Out Of Stock</option>
                                <option value="onbackorder">On BackOrder</option>
                            </select>
                            @error('product.stock_status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-12 col-md-3">
                            <label>Manage Stock</label>
                            <select wire:model.defer='product.manage_stock' class="form-control  form-control-lg">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('product.manage_stock') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label>Stock Quantity</label>
                            <input wire:model.defer="product.stock_qty" type="number"
                                class="form-control form-control-lg" placeholder="0">
                            @error('product.stock_qty') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label>Low Stock</label>
                            <input wire:model.defer="product.low_stock" type="number"
                                class="form-control form-control-lg" placeholder="0">
                            @error('product.low_stock') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label>Supplier</label>
                            <select wire:model.defer='product.supplier_id' class="form-control  form-control-lg">
                                @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                            @error('product.supplier_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-12 col-md-6">
                            <label>Images</label>
                            <input type="file" class="form-control" wire:model="gallery" accept="image/x-png,image/jpeg"
                                style="height:44px" multiple id="inputImg">
                            @error('gallery.*')
                            <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 col-md-6" wire:ignore>
                            <label>Categories</label>
                            <input wire:model="categoriesList" type="text" class="form-control form-control-lg"
                                placeholder="Search category" autocomplete="off" id="tomCategory">
                        </div>
                    </div>

                    <div class="mt-2">
                        <div wire:loading wire:target="gallery">Cargando imágenes...</div>
                        @if (!empty($gallery))
                        <div class="row">
                            @foreach ($gallery as $photo)
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3">
                                <div class="media">
                                    <img src="{{ $photo->temporaryUrl() }}" class="img-fluid rounded" alt="img">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>


                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-dark float-left" wire:click.prevent="cancelEdit">Cancel</button>
                    <button class="btn btn-sm btn-info float-right save" wire:click.prevent="Store">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>