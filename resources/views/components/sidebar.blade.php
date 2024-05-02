<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first" style="color: white;">Menu</li>
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i><span
                class="nav-text">Dashboard</span></a></li>
                @if(Auth::check())
                @if(Auth::user()->role === 'admin')
                <li class="nav-label" style="color: white;">Transaksi Order</li>
                <li><a href="{{ route('order.index') }}" class="{{ request()->routeIs('order.index') ? 'active' : '' }}"><span class="mdi mdi-cart mdi-24px mr-2"></span><span
                    class="nav-text">Order</span></a></li>
                    <li class="nav-label" style="color: white;">Data Master</li>
                    <li><a href="{{ route('konsumen.index') }}" class="{{ request()->routeIs('konsumen.index') ? 'active' : '' }}"><span class="mdi mdi-account-group mdi-24px mr-2"></span><span
                        class="nav-text">Konsumen</span></a></li>
                        <li><a href="{{ route('petugas.index') }}" class="{{ request()->routeIs('petugas.index') ? 'active' : '' }}"><span class="mdi mdi-account-multiple mdi-24px mr-2"></span><span
                            class="nav-text">Petugas</span></a></li>
                            <li><a href="{{ route('layanan.index') }}" class="{{ request()->routeIs('layanan.index') ? 'active' : '' }}"><span class="mdi mdi-washing-machine mdi-24px mr-2"></span></i><span
                                class="nav-text">Layanan</span></a></li>
                                <li><a href="{{ route('pembayaran.index') }}" class="{{ request()->routeIs('pembayaran.index') ? 'active' : '' }}"><span class="mdi mdi-credit-card mdi-24px mr-2"></span></span><span
                                    class="nav-text">Jenis Pembayaran</span></a></li>
                                    @elseif(Auth::user()->role === 'pemimpin')
                                    <li><a href="{{ route('order.index') }}" class="{{ request()->routeIs('order.index') ? 'active' : '' }}"><span class="mdi mdi-cart mdi-24px mr-2"></span><span
                                        class="nav-text">Order</span></a></li>
                                        @elseif(Auth::user()->role === 'petugas')
                                        <li><a href="{{ route('order.index') }}" class="{{ request()->routeIs('order.index') ? 'active' : '' }}"><span class="mdi mdi-cart mdi-24px mr-2"></span><span
                                            class="nav-text">Order</span></a></li>
                                            <li><a href="{{ route('konsumen.index') }}" class="{{ request()->routeIs('konsumen.index') ? 'active' : '' }}"><span class="mdi mdi-account-group mdi-24px mr-2"></span><span
                                                class="nav-text">Konsumen</span></a></li>
                                                <li><a href="{{ route('layanan.index') }}" class="{{ request()->routeIs('layanan.index') ? 'active' : '' }}"><span class="mdi mdi-washing-machine mdi-24px mr-2"></span></i><span
                                                    class="nav-text">Layanan</span></a></li>
                                                    @endif
                                                    @endif
                                                </ul>
                                                
                                            </div>
                                        </div>