<div>
    <h1>Liste des Commandes</h1>
    <ul>
        @foreach($commandes as $commande)
            <li>{{ $commande->note }}</li>
        @endforeach

    </ul>
</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js" defer></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
@endassets

@script
<script>
    new Pikaday({ field: $wire.$el.querySelector('[data-picker]') });
</script>
@endscript
