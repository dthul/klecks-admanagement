<?php
    $id = 'ID_'.md5(uniqid(rand(), true));

    if (!isset($issue))
        $issue = null;
    $create = $issue == null ? true : false;
    $linkText = isset($linkText) ? $linkText : ($create ? 'Neue Ausgabe anlegen' : $issue->name);
?>
<a data-open="{{ $id }}">{{ $linkText }}{!! isset($linkHtml) ? $linkHtml : '' !!}</a>
<div id="{{ $id }}" class="tiny reveal" data-reveal data-close-on-click="true" data-animation-in="fade-in" data-animation-out="fade-out">
    <form method="POST" action="{{ !$create ? route('issues.update', $issue->id) : route('issues.create') }}" autocomplete="off">
        {{ csrf_field() }}
        <label>Ausgabe
            <input type="text" value="{{ !$create ? $issue->name : '' }}" placeholder="2015-2" name="name" id="{{ $id }}_name">
        </label>
        <label>Fällig am
            <input type="date" value="{{ !$create ? $issue->due->format('Y-m-d') : '' }}" name="due" id="{{ $id }}_due" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" placeholder="YYYY-MM-DD">
        </label>
        <button type="submit" class="button">{{ $create ? 'Anlegen' : 'Änderung speichern' }}</button>
    </form>
</div>
