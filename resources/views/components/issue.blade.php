<?php
    $id = 'ID_'.md5(uniqid(rand(), true));

    if (!isset($issue))
        $issue = null;
    $create = $issue == null ? true : false;
    $linkText = isset($linkText) ? $linkText : ($create ? 'Neue Ausgabe anlegen' : $issue->name);
?>
<a href="#" data-reveal-id="{{ $id }}">{{ $linkText }}{!! isset($linkHtml) ? $linkHtml : '' !!}</a>
<div id="{{ $id }}"
     class="reveal-modal tiny"
     data-reveal
     aria-labelledby="{{ !$create ? $issue->name : 'Neue Ausgabe' }}"
     aria-hidden="true"
     role="dialog">
    <form method="POST" action="{{ !$create ? route('issues.update', $issue->id) : route('issues.create') }}" autocomplete="off">
        {!! csrf_field() !!}
        <label for="{{ $id }}_name">Ausgabe</label>
        <input type="text" value="{{ !$create ? $issue->name : '' }}" placeholder="2015-2" name="name" id="{{ $id }}_name">
        <label for="{{ $id }}_due">Fällig am</label>
        <input type="date" value="{{ !$create ? $issue->due->format('Y-m-d') : '' }}" name="due" id="{{ $id }}_due">
        <button type="submit" class="tiny">{{ $create ? 'Anlegen' : 'Änderung speichern' }}</button>
    </form>
</div>