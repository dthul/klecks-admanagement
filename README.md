Klecks Werbeverwaltung
======================

Dieses Repository enthält den Code zur Klecks Werbeverwaltungssoftware.

Systemvoraussetzungen
---------------------

* PHP
* PostgreSQL / MySQL
* Nginx

Anleitung zum Bauen
-------------------

Notwendige Software installieren:

```bash
sudo apt install php-cli php-mbstring [php-pgsql|php-sqlite3|php-mysql] php-xml php-tokenizer
sudo apt install npm
sudo ln -s /usr/bin/nodejs /usr/bin/node
sudo apt install git
sudo npm install -g gulp-cli
```

[Composer](https://getcomposer.org/download/) herunterladen, `composer.phar` in `composer` umbenennen und in `$PATH` eintragen.

Abhängigkeiten installieren:

```bash
composer install
npm install
```

`.env.example` nach `.env` kopieren und anpassen.

Datenbanktabellen einrichten (Achtung, löscht Daten, nur beim ersten Mal oder im Development benutzen):

```bash
php artisan migrate:refresh
php artisan db:seed
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

Auf dem Server:

```bash
apt install php-fpm php-mbstring php-pgsql php-xml php-tokenizer
```

Postgres einrichten:

```bash
apt install postgresql
> CREATE DATABASE klecksdev;
> CREATE USER klecks WITH PASSWORD 'klecksdev';
> GRANT ALL PRIVILEGES ON DATABASE klecksdev TO klecks;
```

Oder für sqlite:

```bash
sqlite3 /path/to/db.sqlite
> .exit
```

Auf der lokalen Maschine alle Dependencies installieren (`composer install`, `npm install`) und die App bauen (`gulp --production`). Dann deployen (`./deploy.sh`).

`.env.example` nach `.env` kopieren und anpassen.

```bash
php artisan key:generate
```

Datenbanktabellen einrichten (Achtung, löscht Daten, nur beim ersten Mal oder im Development benutzen):

```bash
php artisan migrate:refresh
```
