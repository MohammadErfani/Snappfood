@if(auth()->guard('salesman'))
    <x-restaurant-layout></x-restaurant-layout>
@elseif(auth()->guard('admin'))
    <x-admin-layout></x-admin-layout>
@else
    <x-guest-layout>
    </x-guest-layout>
@endif
