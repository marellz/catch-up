@props(['user'])

<div class="flex items-center space-x-2 me-3 mb-3 text-dark-blue">
     <x-icons.user />

     <span class="">
         {{ $user->name }}
     </span>
 </div>
