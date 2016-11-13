<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rechnung</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/invoice.css') }}">
    <link rel="license" href="http://www.opensource.org/licenses/mit-license/">
    {{--<script src="{{ asset('js/invoice.js') }}"></script>--}}
</head>
<body>
<header>
    <h1>Rechnung</h1>
    <address>
        <p>Schülerzeitung Der Klecks</p>
        <p>Abt-Richard-Straße XX</p>
        <p>54550 Daun</p>
    </address>
    <span><img alt="" src="logo.png"></span>
</header>
<article>
    <h1>Recipient</h1>
    <address>
        <p>{!! nl2br(e($customer->address)) !!}</p>
    </address>
    <table class="meta">
        <tr>
            <th>Rechnung #</th>
            <td>{{ $issue->id }}-{{ $customer->id }}</td>
        </tr>
        <tr>
            <th>Datum</th>
            <td>January 1, 2012</td>
        </tr>
        <tr>
            <th>Fällig am</th>
            <td>January 1, 2012</td>
        </tr>
    </table>
    <table class="inventory">
    <thead>
        <tr>
            <th>Werbeformat</th>
            <th>Seite</th>
            <th>Preis</th>
        </tr>
    </thead>
    <tbody>
    <?php $total = 0; ?>
    @foreach ($advertisements as $advertisement)
        <tr>
            <td>{{ $advertisement->adformat->name }}</td>
            <td>{{ $advertisement->page }}</td>
            <td>{{ $advertisement->adformat->price / 100 }}€</td>
        </tr>
        <?php $total += $advertisement->adformat->price; ?>
    @endforeach
    </tbody>
    </table>
    <table class="balance">
        <tr>
            <th>Gesamt</th>
            <td>{{ $total / 100 }}€</td>
        </tr>
        {{--
        <tr>
            <th><span>Amount Paid</span></th>
            <td><span>$</span><span>0.00</span></td>
        </tr>
        <tr>
            <th><span>Balance Due</span></th>
            <td><span>$</span><span>600.00</span></td>
        </tr>
        --}}
    </table>
</article>
<aside>
    <h1><span>Additional Notes</span></h1>
    <div>
        <p>A finance charge of 1.5% will be made on unpaid balances after 30 days.</p>
    </div>
</aside>
</body>
</html>