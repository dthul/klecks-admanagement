<?php
    $id = 'ID_'.md5(uniqid(rand(), true));

    if (!isset($advertisement))
        $advertisement = null;
    $create = $advertisement == null ? true : false;
    $linkText = isset($linkText) ? $linkText : ($create ? 'Neue Anzeige anlegen' : $advertisement->adformat->name);
?>
<a href="#" data-reveal-id="{{ $id }}">{{ $linkText }}{!! isset($linkHtml) ? $linkHtml : '' !!}</a>
<div id="{{ $id }}"
     class="reveal-modal tiny"
     data-reveal
     aria-labelledby="{{ !$create ? $advertisement->adformat->name : 'Neue Anzeige' }}"
     aria-hidden="true"
     role="dialog">
    <form method="POST" action="{{ !$create ? route('advertisements.update', $advertisement->id) : route('advertisements.create') }}" autocomplete="off">
        {!! csrf_field() !!}
        {{ $issue->name }}
        <label for="{{ $id }}_customer">Kunde</label>
        @if ($create)
            <select name="customer_id" id="{{ $id }}_customer">
                @forelse ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @empty
                    <option value="invalid">- Kein Kunde vorhanden -</option>
                @endforelse
            </select>
        @else
            <input type="text" value="{{ $advertisement->customer->name }}" readonly>
        @endif
        <label for="{{ $id }}_adformat">Werbeformat</label>
        <select name="adformat_id" id="{{ $id }}_adformat">
            @foreach ($issue->adformats as $adformat)
                <option value="{{ $adformat->id }}">{{ $adformat->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="tiny">{{ $create ? 'Anlegen' : 'Änderung speichern' }}</button>
    </form>
</div>
