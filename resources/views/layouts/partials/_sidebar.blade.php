<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo" style="width: 5rem;">
        <a href="{{ route('home')}}" class="app-brand-link">
			<img src="/assets/img/educacion.png" class="card-img-top">
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
 		<li class="menu-item @if ( request()->is('/') ) active @endif">
			<a href="{{ route('home')}}" class="menu-link"><i class="menu-icon tf-icons ti ti-checkbox"></i>
				<div>Inicio</div>
			</a>
		</li>
		@if(auth()->user()->hasPermissionTo('operaciones_ingresadas'))
		<li class="menu-item @if ( request()->is('aspirantes') ) active @endif">
			<a href="{{ route('aspirantes.index')}}" class="menu-link">
				<i class="menu-icon tf-icons ti ti-table"></i>
				<div>Operaciones Ingresadas</div>
			</a>
		</li>
		@endif
		
		<li class="menu-item @if ( request()->is('config/jurisdicciones') ) active @endif">
			<a href="{{ route('secciones.index') }}" class="menu-link">Secciones</a>
		</li>
		 

    </ul>
</aside>
