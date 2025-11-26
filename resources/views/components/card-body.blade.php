 <div class="card border m-0  border-dark h-100">
     <div class="card-header p-2 border-bottom">
         <div class="row g-1 ustify-content-between">
            @isset($header)
            {{ $header }}
            @endisset
         </div>
     </div>
     <div class="card-body p-2">
        {{ $slot }}
     </div>
 </div>
