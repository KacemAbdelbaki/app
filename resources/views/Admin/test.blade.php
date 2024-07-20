<div>
    <ul>
        @foreach ($chaines as $chaine)
            <li>{{ $chaine['olt']->nom }}</li>
            <li>{{ $chaine['hub']->nom }}</li>
            @foreach ($chaine['subBoxs'] as $sub)
                <li>{{ $sub->nom }}</li>
            @endforeach
        @endforeach
    </ul>
</div>