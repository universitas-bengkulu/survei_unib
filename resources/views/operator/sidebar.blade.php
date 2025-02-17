<li class="header" style="font-weight:bold;background-color: #3C8DBC; color: #fff ">MENU UTAMA</li>
<li class="one {{ set_active('operator.dashboard') }}">
    <a href="{{ route('operator.dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
</li>
<style>
    .sidebar-menu li.one.active a{ background-color: #b7e5ff4f !important; }
</style>
@if (auth()->user()->akses=='administrator')
<li class="one {{ set_active('operator.category') }}">
    <a href="{{ route('operator.category') }}">
        <i class="fa fa-list"></i> <span>Jenis Survei</span>
    </a>
</li>
<li class="one {{ set_active(['operator.users', 'operator.edit', 'operator.add']) }}">
    <a href="{{ route('operator.users') }}">
        <i class="fa fa-users"></i> <span>Operator</span>
    </a>
</li>

@endif

<li class="one {{ set_active('operator.resetPassword') }}">
    <a href="{{ route('operator.resetPassword') }}">
        <i class="fa fa-key"></i> <span>Reset Password </span>
    </a>
</li>
@php
    use App\Models\Category;
    $menu_categories = Category::get();
@endphp
<li class="header" style="font-weight:bold;background-color: #3C8DBC; color: #fff ">DAFTAR SURVEI <span class="badge bg-red pull-right-container" style="float: right; margin-right: -10px">{{$menu_categories->count()}}</span></li>



@foreach ($menu_categories as $category)
    <li class="treeview  {{ request()->is('operator/deskripsi/'.$category->id.'/'.$category->slug) || request()->is('operator/indikator/'.$category->id.'/'.$category->slug) ||request()->is('operator/laporan/'.$category->id.'/per_indikator/'.$category->slug)|| request()->is('operator/laporan/pesan_dan_saran/'.$category->id.'/'.$category->slug) || request()->is('operator/jenis-survei/'.$category->id.'/formulir')  ? 'active' : ''  }} ">
        <a href="#">
            {{-- <i class="fa fa-building"></i> --}}
            <span
                style="display: inline-block;white-space: normal;max-width:75%;  word-wrap:break-word">{{ $category->nama_category }}</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ request()->is('operator/deskripsi/'.$category->id.'/'.$category->slug) ? 'active' : '' }}"><a
                href="{{ route('operator.deskripsi' , [$category->id , $category->slug]) }}"><i class="fa fa-circle-o"></i>
                Deskripsi</a></li>
            <li class="{{ request()->is('operator/jenis-survei/'.$category->id.'/formulir') ? 'active' : '' }}"><a
                href="{{ route('operator.category.formulir' , [$category->id ]) }}"><i class="fa fa-circle-o"></i>
                Form</a></li>
            <li class="{{ request()->is('operator/indikator/'.$category->id.'/'.$category->slug) ? 'active' : '' }}"><a
                    href="{{ route('operator.indikator', [$category->id , $category->slug]) }}"><i class="fa fa-circle-o"></i>
                    Indikator/Pertanyaan</a></li>
            <li class="{{ request()->is('operator/laporan/'.$category->id.'/per_indikator/'.$category->slug) ? 'active' : '' }}"><a
                    href="{{ route('operator.laporan.per_indikator', [$category->id , $category->slug]) }}"><i
                        class="fa fa-circle-o"></i> Laporan Per Indikator</a></li>
            <li class="{{ request()->is('operator/laporan/pesan_dan_saran/'.$category->id.'/'.$category->slug) ? 'active' : '' }}"><a
                    href="{{ route('operator.laporan.saran', [$category->id , $category->slug]) }}"><i
                        class="fa fa-circle-o"></i>Informasi Tambahan/Saran</a></li>
        </ul>
    </li>
@endforeach


{{-- <li style="padding-left:2px;">
    <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
        <i class="fa fa-power-off text-danger"></i>{{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

</li> --}}
