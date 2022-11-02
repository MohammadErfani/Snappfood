@if(auth()->guard('salesman')->check())
    <x-restaurant-layout></x-restaurant-layout>
@elseif(auth()->guard('admin')->check())
    <x-admin-layout></x-admin-layout>
@else
    <x-guest-layout>
    </x-guest-layout>
@endif
