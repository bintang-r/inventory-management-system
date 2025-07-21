<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                Pembelian
            </h3>
        </div>

        <div class="card-actions">
            <x-action.create route="{{ route('purchases.create') }}" />
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
                        <a wire:click.prevent="sortBy('purchase_no')" href="#" role="button">
                            Nomor Pembelian
                            @include('inclues._sort-icon', ['field' => 'purchase_no'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('supplier_id')" href="#" role="button">
                            Pemasok
                            @include('inclues._sort-icon', ['field' => 'supplier_id'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('date')" href="#" role="button">
                            Tanggal
                            @include('inclues._sort-icon', ['field' => 'date'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('total_amount')" href="#" role="button">
                            Total
                            @include('inclues._sort-icon', ['field' => 'total_amount'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('status')" href="#" role="button">
                            Status
                            @include('inclues._sort-icon', ['field' => 'status'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($purchases as $purchase)
                    <tr>
                        <td class="align-middle text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $purchase->purchase_no }}
                        </td>
                        <td class="align-middle">
                            {{ $purchase->supplier->name }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $purchase->date->format('d-m-Y') }}
                        </td>
                        <td class="align-middle text-center">
                            {{ Number::currency($purchase->total_amount, 'IDR') }}
                        </td>

                        @if ($purchase->status === \App\Enums\PurchaseStatus::APPROVED)
                            <td class="align-middle text-center">
                                <span class="badge bg-green text-white text-uppercase">
                                    {{ __('APPROVED') }}
                                </span>
                            </td>
                            <td class="align-middle text-center">
                                <x-button.show class="btn-icon" route="{{ route('purchases.show', $purchase) }}" />

                                <x-button.edit class="btn-icon" route="{{ route('purchases.edit', $purchase) }}" />
                            </td>
                        @else
                            <td class="align-middle text-center">
                                <span class="badge bg-orange text-white text-uppercase">
                                    {{ __('PENDING') }}
                                </span>
                            </td>
                            <td class="align-middle text-center" style="width: 5%">
                                <x-button.show class="btn-icon" route="{{ route('purchases.show', $purchase) }}" />
                                <x-button.edit class="btn-icon" route="{{ route('purchases.edit', $purchase) }}" />
                                <x-button.delete class="btn-icon" route="{{ route('purchases.delete', $purchase) }}" />
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td class="align-middle text-center" colspan="7">
                            Tidak ada data.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-secondary">
            Tampilkan <span>{{ $purchases->firstItem() }}</span>
            di <span>{{ $purchases->lastItem() }}</span> pada <span>{{ $purchases->total() }}</span> baris
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $purchases->links() }}
        </ul>
    </div>
</div>
