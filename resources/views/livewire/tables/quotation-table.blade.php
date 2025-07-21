<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                Kutipan
            </h3>
        </div>

        <div class="card-actions">
            <x-action.create route="{{ route('quotations.create') }}" />
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
                        <a wire:click.prevent="sortBy('reference')" href="#" role="button">
                            Nomor Kutipan
                            @include('inclues._sort-icon', ['field' => 'reference'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('date')" href="#" role="button">
                            Tanggal
                            @include('inclues._sort-icon', ['field' => 'date'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('customer_name')" href="#" role="button">
                            Nama Pelanggan
                            @include('inclues._sort-icon', ['field' => 'customer_name'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('total')" href="#" role="button">
                            Total Pembelian
                            @include('inclues._sort-icon', ['field' => 'total_amount'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('order_status')" href="#" role="button">
                            Status
                            @include('inclues._sort-icon', ['field' => 'order_status'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($quotations as $quotation)
                    <tr>
                        <td class="align-middle text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $quotation->reference }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $quotation->date->format('d-m-Y') }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $quotation->customer->name }}
                        </td>
                        <td class="align-middle text-center">
                            {{ Number::currency($quotation->total_amount, 'IDR') }}
                        </td>
                        <td class="align-middle text-center">
                            <span
                                class="badge {{ $quotation->status === \App\Enums\QuotationStatus::PENDING ? 'bg-orange' : 'bg-green' }} text-white text-uppercase">
                                {{ $quotation->status->label() }}
                            </span>
                        </td>
                        <td class="align-middle text-center">
                            <x-button.show class="btn-icon" route="{{ route('quotations.show', $quotation) }}" />
                            <x-button.edit class="btn-icon" route="{{ route('quotations.edit', $quotation) }}" />
                            <x-button.delete class="btn-icon" route="{{ route('quotations.destroy', $quotation) }}" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="align-middle text-center" colspan="8">
                            Data tidak ada.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-secondary">
            Menampilkan <span>{{ $quotations->firstItem() }}</span> di <span>{{ $quotations->lastItem() }}</span> pada
            <span>{{ $quotations->total() }}</span> baris
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $quotations->links() }}
        </ul>
    </div>
</div>
