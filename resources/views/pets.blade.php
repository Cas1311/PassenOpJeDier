<h1>{{$heading}}</h1>

@if (count($pets) == 0)
    <p>Geen dieren aangeboden</p>
@endif


@foreach($pets as $pet)
 <a href='/pets/{{$pet['id']}}'>
    {{$pet['animal']}}
 </a>
 <p>
    {{$pet['description']}}
 </p>
@endforeach