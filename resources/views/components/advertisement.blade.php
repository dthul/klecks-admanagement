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
                    <option value="{{ $adformat->id }}">{{ $adformat->name }}</option>
                @endforeach
            </select>
        </label>
        @if (!$create)
            <input type="hidden" name="paid" value="0">
            <input id="{{ $id }}_paid" name="paid" type="checkbox" value="1" @if ($advertisement->paid) checked @endif><label for="{{ $id }}_paid">Bezahlt?</label>
        @endif
        <button type="submit" class="tiny">{{ $create ? 'Anlegen' : 'Änderung speichern' }}</button>
    </form>
</div>
