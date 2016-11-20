<?php
    $id = 'ID_'.md5(uniqid(rand(), true));

    if (!isset($customer))
        $customer = null;
    if ($customer == null)
        $edit = true;
    elseif (!isset($edit))
        $edit = false;
    $create = $customer == null ? true : false;
    $linkText = isset($linkText) ? $linkText : ($create ? 'Neuen Kunden anlegen' : $customer->name);
?>
<a data-open="{{ $id }}">{{ $linkText }}{!! isset($linkHtml) ? $linkHtml : '' !!}</a>
<div id="{{ $id }}" class="tiny reveal" data-reveal data-close-on-click="true" data-animation-in="fade-in" data-animation-out="fade-out">
    @if ($edit)
        <form method="POST" action="{{ !$create ? route('customers.update', $customer->id) : route('customers.create') }}" autocomplete="off">
            {{ csrf_field() }}
            <label for="{{ $id }}_name">Name*</label>
            <input type="text" value="{{ !$create ? $customer->name : '' }}" placeholder="Service GmbH" name="name" id="{{ $id }}_name">

            <label for="{{ $id }}_address">Adresse*</label>
            <textarea rows="3" name="address" id="{{ $id }}_address">{{ !$create ? $customer->address : '' }}</textarea>

            <label for="{{ $id }}_tel">Telefonnummer</label>
            <input type="tel" value="{{ !$create ? $customer->telephone : '' }}" placeholder="06592 / 2223" name="telephone" id="{{ $id }}_tel">

            <label for="{{ $id }}_email">E-Mail</label>
            <input type="text" value="{{ !$create ? $customer->email : '' }}" placeholder="info{{ '@' }}servicegmbh.de" name="email" id="{{ $id }}_email">

            <label for="{{ $id }}_comment">Kommentare</label>
            <textarea rows="4" name="comment" id="{{ $id }}_comment">{{ !$create ? $customer->comment : '' }}</textarea>

            <button type="submit" class="button">{{ $create ? 'Anlegen' : 'Änderung speichern' }}</button>
        </form>
    @else
        <h3>{{ $customer->name }}</h3>
        <h4>Adresse</h4>
        <p>{!! nl2br(e($customer->address)) !!}</p>
        @if ($customer->telephone !== null && $customer->telephone !== '')
        <h4>Telefonnummer</h4>
        <p>{{ $customer->telephone }}</p>
        @endif
        @if ($customer->email !== null && $customer->email !== '')
        <h4>E-Mail</h4>
        <p>{{ $customer->email }}</p>
        @endif
        @if ($customer->comment !== null && $customer->comment !== '')
        <h4>Kommentare</h4>
        <p>{!! nl2br(e($customer->comment)) !!}</p>
        @endif
    @endif
</div>
