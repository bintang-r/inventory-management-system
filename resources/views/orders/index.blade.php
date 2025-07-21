@extends('layouts.tabler')

@section('content')
<div class="page-body">
    @if($orders->isEmpty())
    <x-empty
        title="Tidak ada pesanan ditemukan"
        message="Coba sesuaikan pencarian atau filter untuk menemukan apa yang Anda cari."
        button_label="{{ __('Tambah Pesanan Pertama Anda') }}"
        button_route="{{ route('orders.create') }}"
    />
    @else
    <div class="container-xl">
        <x-alert/>

        <livewire:tables.order-table />
    </div>
    @endif
</div>
@endsection
