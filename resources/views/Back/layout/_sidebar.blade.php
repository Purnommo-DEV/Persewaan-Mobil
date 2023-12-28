 <div id="sidebar" class="active">
     <div class="sidebar-wrapper active" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15); border-radius:10px;">
         <div class="sidebar-header">
             <div class="d-flex justify-content-between">
                 <div class="logo">
                     <a href="#!" style="font-size: 20px;"><img src="{{ asset('All/img/rent.png') }}"
                             style="width: 3rem; height: auto;" alt="Logo" srcset="">&nbsp;Penyewaan Mobil
                     </a>
                 </div>
                 <div class="toggler">
                     <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                 </div>
             </div>
         </div>
         <div class="sidebar-menu">
             <ul class="menu">

                 @if (Auth::user()->role_id == 1)
                     <li class="sidebar-item {{ request()->routeIs('pemilik.HalamanDataMobil*') ? 'active' : '' }}">
                         <a href="{{ route('pemilik.HalamanDataMobil') }}" class='sidebar-link'>
                             <i class="bi bi-grid-fill"></i>
                             <span>Data Mobil</span>
                         </a>
                     </li>
                     <li
                         class="sidebar-item {{ request()->routeIs('pemilik.HalamanDaftarDataPeminjaman*') ? 'active' : '' }}">
                         <a href="{{ route('pemilik.HalamanDaftarDataPeminjaman') }}" class='sidebar-link'>
                             <i class="bi bi-grid-fill"></i>
                             <span>Data Peminjaman</span>
                         </a>
                     </li>
                 @elseif(Auth::user()->role_id == 2)
                     <li class="sidebar-item {{ request()->routeIs('peminjam.HalamanDaftarMobil*') ? 'active' : '' }}">
                         <a href="{{ route('peminjam.HalamanDaftarMobil') }}" class='sidebar-link'>
                             <i class="bi bi-grid-fill"></i>
                             <span>Daftar Mobil</span>
                         </a>
                     </li>
                     <li
                         class="sidebar-item {{ request()->routeIs('peminjam.HalamanDaftarPeminjaman*') ? 'active' : '' }}">
                         <a href="{{ route('peminjam.HalamanDaftarPeminjaman') }}" class='sidebar-link'>
                             <i class="bi bi-grid-fill"></i>
                             <span>Peminjaman</span>
                         </a>
                     </li>
                     <li
                         class="sidebar-item {{ request()->routeIs('peminjam.HalamanDaftarPengembalian*') ? 'active' : '' }}">
                         <a href="{{ route('peminjam.HalamanDaftarPengembalian') }}" class='sidebar-link'>
                             <i class="bi bi-grid-fill"></i>
                             <span>Data Pengembalian</span>
                         </a>
                     </li>
                     {{-- <li
                         class="sidebar-item {{ request()->routeIs('peminjam.HalamanDaftarPeminjaman*') ? 'active' : '' }}">
                         <a href="{{ route('peminjam.HalamanDaftarPeminjaman') }}" class='sidebar-link'>
                             <i class="bi bi-grid-fill"></i>
                             <span>Pengembalian</span>
                         </a>
                     </li> --}}
                 @endif

                 <li class="sidebar-item {{ request()->routeIs('LogoutPengguna*') ? 'active' : '' }}">
                     <a href="{{ route('LogoutPengguna') }}" class='sidebar-link'>
                         <i class="bi bi-arrow-left-square-fill"></i>
                         <span>Keluar</span>
                     </a>
                 </li>
             </ul>
         </div>

         <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
     </div>
 </div>
