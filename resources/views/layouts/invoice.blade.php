<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rechnung</title>
    <link rel="stylesheet" href="{{ asset('css/invoice.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">
    <link rel="license" href="http://www.opensource.org/licenses/mit-license/">
    {{--<script src="{{ asset('js/invoice.js') }}"></script>--}}
</head>
<body>
<div class="page">
    <div class="header">
        <h1>Der Klecks</h1>
    </div>
    <div class="window">
        <address class="sender">
            <p>TMG&#x2003;Freiherr-vom-Stein-Str. 14&#x2003;54550 Daun</p>
        </address>
        <address class="recipient">
            <p>
                {{ $customer->name }}<br>
                {!! nl2br(e($customer->address)) !!}
            </p>
        </address>
    </div>
    <div class="info">
        <p>
            Schülerzeitung Der Klecks<br>
            Thomas-Morus-Gymnasium<br>
            Freiherr-vom-Stein-Str. 14<br>
            54550 Daun
        <p>
        <p>
            Tel.: +49 (6592) 98350-35<br>
            klecks@???
        </p>
        <p>
            Datum: {{ date('Y-m-d') }}
        </p>
    </div>
    <div class="text">
        <p class="subject">
            Rechnung Nr. {{ $issue->id }}-{{ $customer->id }}
        </p>
        <p class="salutation">
            Sehr geehrter Werbekunde,
        <p>
        <p>
            für Ihre Werbeanzeige in der aktuellen Ausgabe der Schülerzeitung "Der Klecks" erlauben wir uns, folgende Positionen in Rechnung zu stellen.
        </p>
        <table class="listing">
        <thead>
            <tr>
                <th>Werbeformat</th>
                <th>Seite</th>
                <th class="text-right">Preis</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($advertisements as $advertisement)
            <tr>
                <td>{{ $advertisement->adformat->name }}</td>
                <td>{{ $advertisement->page }}</td>
                <td class="text-right">{{ $advertisement->adformat->price / 100 }}€</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td colspan="2" class="text-right">Summe&#x2003;{{ $advertisements->pluck('adformat')->pluck('price')->sum() / 100 }} €</td>
            </tr>
        </tfoot>
        </table>
        <p>
            Bitte überweisen Sie den Rechnungsbetrag innerhalb von 14 Tagen.
        </p>
        <p>
            Wir danken recht herzlich für Ihren Auftrag.
        </p>
        <p class="valediction">
            Mit freundlichen Grüßen,<br>
            Die Redaktion des Klecks
        </p>
    </div>
    <div class="pagenumber">
        <p>Seite 1 von 1</p>
    </div>
    <div class="footer">
        <p>
            Schülerzeitung Der Klecks<br>
            Thomas-Morus-Gymnasium<br>
            Freiherr-vom-Stein-Str. 14<br>
            54550 Daun
        </p>
        <p>
            Bank: Kreissparkasse Vulkaneifel<br>
            IBAN: DE11 9900 0000 8888 7777 00
        </p>
        <p>
            Email: klecks@???<br>
            Telefon: +49 (6592) 98350-35
        </p>
    </div>
    <hr class="page-marker-1">
    <hr class="page-marker-2">
    <hr class="page-marker-3">
</page>
</body>
</html>