<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                Unit
            </h3>
        </div>

        <div class="card-actions">
            <x-action.create route="{{ route('units.create') }}" />
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
                        <a wire:click.prevent="sortBy('name')" href="#" role="button">
                            Nama
                            @include('inclues._sort-icon', ['field' => 'name'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center d-none d-sm-table-cell">
                        <a wire:click.prevent="sortBy('slug')" href="#" role="button">
                            Slug
                            @include('inclues._sort-icon', ['field' => 'slug'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('short_code')" href="#" role="button">
                            Kode
                            @include('inclues._sort-icon', ['field' => 'short_code'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($units as $unit)
                    <tr>
                        <td class="align-middle text-center">
                            {{ ($units->currentPage() - 1) * $units->perPage() + $loop->iteration }}
                        </td>
                        <td class="align-middle">
                            {{ $unit->name }}
                        </td>
                        <td class="align-middle">
                            {{ $unit->slug }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $unit->short_code }}
                        </td>
                        <td class="align-middle text-center" style="width: 10%">
                            <x-button.show class="btn-icon" route="{{ route('units.show', $unit) }}" />
                            <x-button.edit class="btn-icon" route="{{ route('units.edit', $unit) }}" />
                            <x-button.delete class="btn-icon" route="{{ route('units.destroy', $unit) }}" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="align-middle text-center" colspan="8">
                            Data tidak ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-secondary d-none d-sm-block">
            Menampilkan <span>{{ $units->firstItem() }}</span> di <span>{{ $units->lastItem() }}</span> pada
            <span>{{ $units->total() }}</span> baris
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $units->links() }}
        </ul>
    </div>
</div>
