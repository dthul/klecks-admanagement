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

Yarn zur Javascript-Paketverwaltung installieren:

```bash
curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list
sudo apt update && sudo apt install yarn
```

[Composer](https://getcomposer.org/download/) herunterladen, `composer.phar` in `composer` umbenennen und in `$PATH` eintragen.

Eventuell [Laravel](https://laravel.com/) installieren. Ist nicht unbedingt notwendig, außer man will `laravel` Befehle ausführen:

```bash
sudo apt install php-zip
composer global require "laravel/installer"
```

Danach `~/.config/composer/vendor/bin` in `$PATH` eintragen.

Abhängigkeiten installieren:

```bash
composer install
yarn install
```

`.env.example` nach `.env` kopieren und anpassen.

Datenbanktabellen einrichten (Achtung, löscht Daten, nur beim ersten Mal oder im Development benutzen):

```bash
php artisan migrate:refresh
php artisan db:seed
```

Das Projekt mit Mix bauen:

* continuous development: `npm run watch`
* one-off development: `npm run dev`
* one-off production: `npm run prod`


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

Auf der lokalen Maschine alle Dependencies installieren (`composer install`, `yarn install`) und die App bauen (`npm run production`). Dann deployen (`./deploy.sh`).

Auf dem Server:

Bei Ersteinrichtung `.env.example` nach `.env` kopieren und anpassen. Nach Laravel Update `.env.example` und bestehendes `.env` vergleichen und eventuell anpassen.

Zum Erzeugen des App-Keys (nur bei Ersteinrichtung benötigt):

```bash
php artisan key:generate
```

Datenbanktabellen einrichten (Achtung, löscht Daten, nur beim ersten Mal oder im Development benutzen):

```bash
php artisan migrate:refresh
```
