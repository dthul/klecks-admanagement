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
     aria-labelledby="{{ !$create ? $advertisement->name : 'Neue Anzeige' }}"
     aria-hidden="true"
     role="dialog">
    <form method="POST" action="{{ !$create ? route('advertisements.update', $advertisement->id) : route('advertisements.create', $issue->id) }}" autocomplete="off">
        {!! csrf_field() !!}
        {{--<label for="{{ $id }}_name">Ausgabe</label>
        <input type="text" value="{{ !$create ? $advertisement->name : '' }}" placeholder="2015-2" name="name" id="{{ $id }}_name">
        <label for="{{ $id }}_due">Fällig am</label>
        <input type="date" value="{{ !$create ? $advertisement->due->format('Y-m-d') : '' }}" name="due" id="{{ $id }}_due">
        <button type="submit" class="tiny">{{ $create ? 'Anlegen' : 'Änderung speichern' }}</button>--}}
        {{ $issue->name }}
        <label for="{{ $id }}_customer">Kunde</label>
        <select name="customer_id" id="{{ $id }}_customer">
            @foreach ($issue->adformats as $adformat)
                <option value="{{ $adformat->id }}">{{ $adformat->name }}</option>
            @endforeach
        </select>
        <label for="{{ $id }}_adformat">Werbeformat</label>
        <select name="adformat_id" id="{{ $id }}_adformat">
            @foreach ($issue->adformats as $adformat)
                <option value="{{ $adformat->id }}">{{ $adformat->name }}</option>
            @endforeach
        </select>
    </form>
</div>