<div class="dropdown">
   <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
       <!-- {{ $availableLocales[$currentLocale] }} ({{ $currentLocale }}) -->
       <img style="width: 30px; height: 30px" src="/img/{{ $currentLocale }}.png" alt="">
   </a>
   <ul style="background-color:#1A1830; width: 20px; --bs-dropdown-min-width: 4rem;" class="dropdown-menu" aria-labelledby="dropdownMenuLink">
   @foreach($availableLocales as $locale => $localeName)
       @if($locale !== $currentLocale)
           <li style="margin: 0px;"><a class="dropdown-item" href="{{ url('language/'.$locale) }}"><img style="width: 30px; height: 30px;" src="/img/{{ $locale }}.png" alt=""></a></li>
       @endif
   @endforeach
   </ul>       
</div>