<li class="header" style="font-weight:bold;">MENU UTAMA</li>
<li class="{{ set_active('operator.dashboard') }}">
    <a href="{{ route('operator.dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
</li>

<li class="treeview {{ set_active(['operator.indikator', 'operator.laporan.per_prodi', 'operator.laporan.per_indikator']) }}">
    <a href="#">
      <i class="fa fa-pie-chart"></i>
      <span>Survei Dosen Dan Tendik</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ set_active('operator.indikator') }}"><a href="{{ route('operator.indikator') }}"><i class="fa fa-circle-o"></i> Manajemen Indikator</a></li>
      <li class="{{ set_active('operator.laporan.per_prodi') }}"><a href="{{ route('operator.laporan.per_prodi') }}"><i class="fa fa-circle-o"></i> Laporan Per Pekerjaan</a></li>
      <li class="{{ set_active('operator.laporan.per_indikator') }}"><a href="{{ route('operator.laporan.per_indikator') }}"><i class="fa fa-circle-o"></i> Laporan Per Indikator</a></li>
    </ul>
</li>

<li class="treeview  ">
    <a href="#">
      <i class="fa fa-graduation-cap"></i>
      <span>Survei Lulusan/Alumni</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ set_active('operator.indikator') }}"><a href="{{ route('operator.indikator') }}"><i class="fa fa-circle-o"></i> Manajemen Indikator</a></li>
      <li class="{{ set_active('operator.laporan.per_prodi') }}"><a href="{{ route('operator.laporan.per_prodi') }}"><i class="fa fa-circle-o"></i> Laporan Per Pekerjaan</a></li>
      <li class="{{ set_active('operator.laporan.per_indikator') }}"><a href="{{ route('operator.laporan.per_indikator') }}"><i class="fa fa-circle-o"></i> Laporan Per Indikator</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
      <i class="fa fa-building"></i>
      <span>Survei Sarana&Prasarana</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ set_active('operator.indikator') }}"><a href="{{ route('operator.indikator') }}"><i class="fa fa-circle-o"></i> Manajemen Indikator</a></li>
      <li class="{{ set_active('operator.laporan.per_prodi') }}"><a href="{{ route('operator.laporan.per_prodi') }}"><i class="fa fa-circle-o"></i> Laporan Per Pekerjaan</a></li>
      <li class="{{ set_active('operator.laporan.per_indikator') }}"><a href="{{ route('operator.laporan.per_indikator') }}"><i class="fa fa-circle-o"></i> Laporan Per Indikator</a></li>
    </ul>
</li>

{{--<li class="{{ set_active('operator.laporan.per_fakultas') }}">
    <a href="{{ route('operator.laporan.per_fakultas') }}">
        <i class="fa fa-pie-chart"></i> <span>Laporan Per Pendidikan</span>
    </a>
</li>

 <li class="{{ set_active('operator.laporan.keseluruhan') }}">
    <a href="{{ route('operator.laporan.keseluruhan') }}">
        <i class="fa fa-line-chart"></i> <span>Laporan Per Responden</span>
    </a>
</li>

<li class="{{ set_active('operator.laporan.saran') }}">
    <a href="{{ route('operator.laporan.saran') }}">
        <i class="fa fa-comments-o"></i> <span>Pesan / Saran</span>
    </a>
</li> --}}

<li style="padding-left:2px;">
    <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
        <i class="fa fa-power-off text-danger"></i>{{__('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

</li>
