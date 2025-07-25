<div>
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="card-title">
                    {{ $unit->name }}
                </h3>
            </div>

            <div class="card-actions btn-actions">
                <x-action.close route="{{ route('units.index') }}" />
            </div>
        </div>

        <div class="card-body border-bottom py-3">
            <div class="d-flex">
                <div class="text-secondary">
                    Tampil
                    <div class="mx-2 d-inline-block">
                        <select wire:model.live="perPage" class="form-select form-select-sm"
                            aria-label="result per page">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                    baris
                </div>
                <div class="ms-auto text-secondary">
                    Cari :
                    <div class="ms-2 d-inline-block">
                        <input type="text" wire:model.live="search" class="form-control form-control-sm"
                            aria-label="Search invoice">
                    </div>
                </div>
            </div>
        </div>

        <x-spinner.loading-spinner />

        <div class="table-responsive">
            <table wire:loading.remove class="table table-bordered card-table table-vcenter text-nowrap datatable">
                <thead class="thead-light">
                    <tr>
                        <th class="align-middle text-center w-1">
                            #
                        </th>
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('name')" href="#" role="button">
                                Nama Produk
                                @include('inclues._sort-icon', ['field' => 'name'])
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center d-none d-sm-table-cell">
                            <a wire:click.prevent="sortBy('code')" href="#" role="button">
                                Kode Produk
                                @include('inclues._sort-icon', ['field' => 'code'])
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center d-none d-sm-table-cell">
                            <a wire:click.prevent="sortBy('quantity')" href="#" role="button">
                                Jumlah Produk
                                @include('inclues._sort-icon', ['field' => 'quantity'])
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td class="align-middle text-center">
                                {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                            </td>
                            <td class="align-middle">
                                {{ $product->name }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $product->code }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $product->quantity }}
                            </td>
                            <td class="align-middle text-center" style="width: 10%">
                                <x-button.show class="btn-icon" route="{{ route('products.show', $product) }}" />
                                <x-button.edit class="btn-icon" route="{{ route('products.edit', $product) }}" />
                                <x-button.delete class="btn-icon" route="{{ route('products.destroy', $product) }}" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="align-middle text-center" colspan="8">
                                No results found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center">
            <p class="m-0 text-secondary">
                Tampilkan <span>{{ $products->firstItem() }}</span> di <span>{{ $products->lastItem() }}</span> pada
                <span>{{ $products->total() }}</span> baris
            </p>

            <ul class="pagination m-0 ms-auto">
                {{ $products->links() }}
            </ul>
        </div>
    </div>
</div>
