<?php
    $id = 'ID_'.md5(uniqid(rand(), true));

    if (!isset($adformat))
        $adformat = null;
    $create = $adformat == null ? true : false;
    $linkText = isset($linkText) ? $linkText : ($create ? 'Neues Werbeformat anlegen' : $adformat->name);
?>
<a href="#" data-reveal-id="{{ $id }}">{{ $linkText }}{!! isset($linkHtml) ? $linkHtml : '' !!}</a>
<div id="{{ $id }}"
     class="reveal-modal tiny"
     data-reveal
     aria-labelledby="{{ !$create ? $adformat->name : 'Neues Werbeformat' }}"
     aria-hidden="true"
     role="dialog">
    <form method="POST" action="{{ !$create ? route('adformats.update', $adformat->id) : route('adformats.create', $issue->id) }}" autocomplete="off">
        {!! csrf_field() !!}
        <label for="{{ $id }}_name">Name</label>
        <input type="text" value="{{ !$create ? $adformat->name : '' }}" placeholder="1/2 Seite bunt" name="name" id="{{ $id }}_name">
        <div class="row collapse">
            <label for="{{ $id }}_price">Preis</label>
            <div class="small-9 columns">
                <input type="number" value="{{ !$create ? $adformat->price : '' }}" placeholder="1000" name="price" id="{{ $id }}_price">
            </div>
            <div class="small-3 columns">
                <span class="postfix">Cent</span>
            </div>
        </div>
        <button type="submit" class="tiny">{{ $create ? 'Anlegen' : 'Änderung speichern' }}</button>
    </form>
</div>