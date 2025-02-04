<li class="header" style="font-weight:bold;">MENU UTAMA</li>
<li class="{{ set_active('operator.dashboard') }}">
    <a href="{{ route('operator.dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
</li>
<li class="{{ set_active('operator.category') }}">
    <a href="{{ route('operator.category') }}">
        <i class="fa fa-list"></i> <span>Jenis Survei</span>
    </a>
</li>

<li class="header" style="font-weight:bold;">DAFTAR SURVEI</li>

{{--
<li
    class="treeview {{ set_active(['operator.indikator.dosen_tendik', 'operator.laporan.per_prodi', 'operator.laporan.per_indikator']) }}">
    <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Survei Dosen Dan Tendik</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ set_active('operator.indikator.dosen_tendik') }}"><a
                href="{{ route('operator.indikator.dosen_tendik') }}"><i class="fa fa-circle-o"></i> Indikator</a></li>
        <li class="{{ set_active('operator.laporan.per_prodi') }}"><a
                href="{{ route('operator.laporan.per_prodi') }}"><i class="fa fa-circle-o"></i> Laporan Per
                Pekerjaan</a></li>
        <li class="{{ set_active('operator.laporan.per_indikator') }}"><a
                href="{{ route('operator.laporan.per_indikator') }}"><i class="fa fa-circle-o"></i> Laporan Per
                Indikator</a></li>
    </ul>
</li>

<li class="treeview  {{ set_active(['operator.indikator.alumni', 'operator.laporan.per_indikator.alumni']) }}">
    <a href="#">
        <i class="fa fa-graduation-cap"></i>
        <span>Survei Lulusan/Alumni</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ set_active('operator.indikator.alumni') }}"><a
                href="{{ route('operator.indikator.alumni') }}"><i class="fa fa-circle-o"></i> Indikator</a></li>
        <li class="{{ set_active('operator.laporan.per_indikator.alumni') }}"><a
                href="{{ route('operator.laporan.per_indikator.alumni') }}"><i class="fa fa-circle-o"></i> Laporan Per
                Indikator</a></li>
    </ul>
</li>
<li
    class="treeview {{ set_active(['operator.indikator.sarana_prasarana', 'operator.laporan.per_indikator.sarana_prasarana']) }}">
    <a href="#">
        <i class="fa fa-building"></i>
        <span>Survei Sarana&Prasarana</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ set_active('operator.indikator.sarana_prasarana') }}"><a
                href="{{ route('operator.indikator.sarana_prasarana') }}"><i class="fa fa-circle-o"></i> Indikator</a>
        </li>
        <li class="{{ set_active('operator.laporan.per_indikator.sarana_prasarana') }}"><a
                href="{{ route('operator.laporan.per_indikator.sarana_prasarana') }}"><i class="fa fa-circle-o"></i>
                Laporan Per Indikator</a></li>
    </ul>
</li> --}}
@php
    use App\Models\Category;
    $categories = Category::get();
@endphp
@foreach ($categories as $category)
    <li
        class="treeview {{ set_active(['operator.indikator.' . $category->slug, 'operator.laporan.per_indikator.' . $category->slug]) }}">
        <a href="#">
            {{-- <i class="fa fa-building"></i> --}}
            <span
                style="display: inline-block;white-space: normal;max-width:75%;  word-wrap:break-word">{{ $category->nama_category }}</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ set_active('operator.indikator.' . $category->slug) }}"><a
                    href="{{ route('operator.indikator.' . $category->slug) }}"><i class="fa fa-circle-o"></i>
                    Indikator</a></li>
            <li class="{{ set_active('operator.laporan.per_indikator.' . $category->slug) }}"><a
                    href="{{ route('operator.laporan.per_indikator.' . $category->slug) }}"><i
                        class="fa fa-circle-o"></i> Laporan Per Indikator</a></li>
            <li class="{{ set_active('operator.laporan.saran.' . $category->slug) }}"><a
                    href="{{ route('operator.laporan.saran.' . $category->slug) }}"><i
                        class="fa fa-circle-o"></i> Saran</a></li>
        </ul>
    </li>
@endforeach


<li style="padding-left:2px;">
    <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
        <i class="fa fa-power-off text-danger"></i>{{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

</li>
