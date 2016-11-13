<?php
    $id = 'ID_'.md5(uniqid(rand(), true));

    if (!isset($adformat))
        $adformat = null;
    $create = $adformat == null ? true : false;
    $linkText = isset($linkText) ? $linkText : ($create ? 'Neues Werbeformat anlegen' : $adformat->name);
?>
<a data-open="{{ $id }}">{{ $linkText }}{!! isset($linkHtml) ? $linkHtml : '' !!}</a>
<div id="{{ $id }}" class="tiny reveal" data-reveal data-close-on-click="true" data-animation-in="fade-in" data-animation-out="fade-out">
    <form method="POST" action="{{ !$create ? route('adformats.update', $adformat->id) : route('adformats.create', $issue->id) }}" autocomplete="off">
        {!! csrf_field() !!}
        <label for="{{ $id }}_name">Name</label>
		<input type="text" value="{{ !$create ? $adformat->name : '' }}" placeholder="1/2 Seite bunt" name="name" id="{{ $id }}_name">
		<label for="{{ $id }}_price">Preis</label>
		<div class="input-group">
			<input type="number" value="{{ !$create ? $adformat->price : '' }}" placeholder="1000" name="price" id="{{ $id }}_price" class="input-group-field">
			<span class="input-group-label">Cent</span>
		</div>
        <button type="submit" class="button">{{ $create ? 'Anlegen' : 'Änderung speichern' }}</button>
    </form>
</div>
