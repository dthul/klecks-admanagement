<?php
    $id = 'ID_'.md5(uniqid(rand(), true));

    if (!isset($advertisement))
        $advertisement = null;
    $create = $advertisement == null ? true : false;
    $linkText = isset($linkText) ? $linkText : ($create ? 'Neue Anzeige anlegen' : $advertisement->adformat->name);
?>
<a data-open="{{ $id }}">{{ $linkText }}{!! isset($linkHtml) ? $linkHtml : '' !!}</a>
<div id="{{ $id }}" class="tiny reveal" data-reveal data-close-on-click="true" data-animation-in="fade-in" data-animation-out="fade-out">
    <form method="POST" action="{{ !$create ? route('advertisements.update', $advertisement->id) : route('advertisements.create') }}" autocomplete="off">
        {!! csrf_field() !!}
        <label>Ausgabe
            <input type="text" value="{{ $issue->name }}" readonly>
        </label>
        <label>Kunde
            @if ($create)
                <select name="customer_id">
                    @forelse ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @empty
                        <option value="invalid">- Kein Kunde vorhanden -</option>
                    @endforelse
                </select>
            @else
                <input type="text" value="{{ $advertisement->customer->name }}" readonly>
            @endif
        </label>
        <label>Werbeformat
            <select name="adformat_id">
                @foreach ($issue->adformats as $adformat)
                    <option value="{{ $adformat->id }}" @if (!$create && $advertisement->adformat_id === $adformat->id) selected @endif>{{ $adformat->name }}</option>
                @endforeach
            </select>
        </label>
        @if (!$create)
            <input type="hidden" name="paid" value="0">
            <input id="{{ $id }}_paid" name="paid" type="checkbox" value="1" @if ($advertisement->paid) checked @endif><label for="{{ $id }}_paid">Bezahlt?</label>
            <br>
        @endif
        <button type="submit" class="button">{{ $create ? 'Anlegen' : 'Änderung speichern' }}</button>
    </form>
</div>
