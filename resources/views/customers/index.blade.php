@extends('layouts.master')

@section('title', 'Kunden')

@section('content')
<div class="row">
<div class="small-12 columns">
    <h1>Kunden</h1>
</div>
<div class="small-12 columns">
    @include('components.customer', ['customer' => null, ''])
    <table id="customers_table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Tel.</th>
            <th>E-Mail</th>
            <th data-orderable="false" data-searchable="false"></th>
            <th data-orderable="false" data-searchable="false"></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Name</th>
            <th>Tel.</th>
            <th>E-Mail</th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
    <tbody>
    @foreach($customers as $customer)
        <tr>
            <td data-search="{{ $customer->name }}" data-order="{{ $customer->name }}">@include('components.customer', ['customer' => $customer])</td>
            <td>{{ $customer->telephone }}</td>
            <td>{{ $customer->email }}</td>
            <td>@include('components.customer', ['customer' => $customer, 'edit' => true, 'linkText' => '', 'linkHtml' => '<i class="fa fa-pencil"></i>'])</td>
            <td><form method="POST" action="{{ route('customers.delete', $customer->id) }}">{!! csrf_field() !!}<a href="#" onclick="$(this).closest('form').submit()"><i class="fa fa-trash-o"></i></a></form></td>
        </tr>
    @endforeach
    </tbody>
    </table>
</div>
</div>
@stop

@section('end')
    <script>
        $(document).ready(function() {
            $('#customers_table').DataTable();
        });
    </script>
@stop