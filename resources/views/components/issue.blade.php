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
        <label>Ausgabe
            <input type="text" value="{{ !$create ? $issue->name : '' }}" placeholder="2015-2" name="name" id="{{ $id }}_name">
        </label>
        <label>Fällig am
            <input type="date" value="{{ !$create ? $issue->due->format('Y-m-d') : '' }}" name="due" id="{{ $id }}_due" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" placeholder="YYYY-MM-DD" aria-describedby="{{ $id }}_due_help_text">
        </label>
        <p class="help-text" id="{{ $id }}_due_help_text">Format: YYYY-MM-DD</p>
        <button type="submit" class="tiny">{{ $create ? 'Anlegen' : 'Änderung speichern' }}</button>
    </form>
</div>