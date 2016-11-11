Klecks Werbeverwaltung
======================

Dieses Repository enthält den Code zor Klecks Werbeverwaltungssoftware.

Systemvoraussetzungen
---------------------

* PHP
* PostgreSQL / MySQL
* Nginx

Anleitung zum Bauen
-------------------

Notwendige Software installieren:

```bash
sudo apt install php php-fpm php-mbstring php-pgsql php-xml php-tokenizer
sudo apt install npm
sudo ln -s /usr/bin/nodejs /usb/bin/node
sudo apt install git
sudo npm install -g bower
sudo npm install -g gulp-cli
```

[Composer](https://getcomposer.org/download/) herunterladen, `composer.phar` in `composer` umbenennen und in `$PATH` eintragen.

Abhängigkeiten installieren:

```bash
composer install
npm install
bower install
```

Das Projekt mit Gulp bauen:

* continuous: `npm run dev`
* one-off development: `gulp`
* one-off production: `gulp --production`


Development-Server aufrufen (benötigt eingerichtete Datenbank):

```bash
php artisan serve
```

Anleitung zum Deployen
----------------------

```bash
apt install postgresql
> CREATE DATABASE klecksdev;
> CREATE USER klecks WITH PASSWORD 'klecksdev';
> GRANT ALL PRIVILEGES ON DATABASE klecksdev TO klecks;
```

Datenbank einrichten (Achtung, löscht Daten, nur beim ersten Mal oder im Development benutzen):

```bash
php artisan migrate:refresh --seed
```

