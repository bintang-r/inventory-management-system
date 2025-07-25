<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                Pemasok
            </h3>
        </div>

        <div class="card-actions">
            <x-action.create route="{{ route('suppliers.create') }}" />
        </div>
    </div>

    <div class="card-body border-bottom py-3">
        <div class="d-flex">
            <div class="text-secondary">
                Tampil
                <div class="mx-2 d-inline-block">
                    <select wire:model.live="perPage" class="form-select form-select-sm" aria-label="result per page">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                    </select>
                </div>
                baris
            </div>
            <div class="ms-auto text-secondary">
                cari :
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
                            Nama
                            @include('inclues._sort-icon', ['field' => 'name'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('email')" href="#" role="button">
                            Email
                            @include('inclues._sort-icon', ['field' => 'email'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('shopname')" href="#" role="button">
                            Nama Pembeli
                            @include('inclues._sort-icon', ['field' => 'shopname'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('type')" href="#" role="button">
                            Tipe
                            @include('inclues._sort-icon', ['field' => 'type'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suppliers as $supplier)
                    <tr>
                        <td class="align-middle text-center">
                            {{ ($suppliers->currentPage() - 1) * $suppliers->perPage() + $loop->iteration }}
                        </td>
                        <td class="align-middle">
                            {{ $supplier->name }}
                        </td>
                        <td class="align-middle">
                            {{ $supplier->email }}
                        </td>
                        <td class="align-middle">
                            {{ $supplier->shopname }}
                        </td>
                        <td class="align-middle text-center">
                            <span class="badge bg-primary text-white text-uppercase">
                                {{ $supplier->type }}
                            </span>
                        </td>
                        <td class="align-middle text-center" style="width: 10%">
                            <x-button.show class="btn-icon" route="{{ route('suppliers.show', $supplier) }}" />
                            <x-button.edit class="btn-icon" route="{{ route('suppliers.edit', $supplier) }}" />
                            <x-button.delete class="btn-icon" route="{{ route('suppliers.destroy', $supplier) }}" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="align-middle text-center" colspan="5">
                            Data tidak ada.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-secondary">
            Menampilkan <span>{{ $suppliers->firstItem() }}</span> di <span>{{ $suppliers->lastItem() }}</span> pada
            <span>{{ $suppliers->total() }}</span> baris
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $suppliers->links() }}
        </ul>
    </div>
</div>
