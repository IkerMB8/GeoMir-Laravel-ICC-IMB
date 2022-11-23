{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}

@hasanyrole('admin|editor')
    {{ __("Admins and editors section") }}
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
    @hasanyrole('admin')
    @can('users.*')
        {{ __("You can administer users!") }}
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="las la-user-tie"></i>Users</a></li>
    @endcan
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
    @endhasanyrole
    <!-- Mirar el 2.2 si surge algun error, le hemos quitado un menu desplegable y un "li" de Users, que estaba repetido con el de arriba. -->
    
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('visibility') }}"><i class="nav-icon la la-question"></i> Visibilities</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('place') }}"><i class="nav-icon la la-question"></i> Places</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('post') }}"><i class="nav-icon la la-question"></i> Posts</a></li>
@else
   {{ __("Only admins and editors can see this section") }}
@endhasanyrole
@hasanyrole('editor')
<li class="nav-item nav-dropdown">
  <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-globe"></i> Translations</a>
  <ul class="nav-dropdown-items">
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('language') }}"><i class="nav-icon la la-flag-checkered"></i> Languages</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('language/texts') }}"><i class="nav-icon la la-language"></i> Site texts</a></li>
  </ul>
</li>
@else
   {{ __("Only editors can see language section") }}
@endhasanyrole

@vite(['resources/js/app.js'])
@include('partials.language-switcher')