#!/bin/bash
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
DEST=klecks@euve251339.serverprofi24.de:/home/klecks/www
RSYNC="rsync --recursive --links --safe-links --perms --executability --times --compress --exclude-from $DIR/rsync.exclude"

$RSYNC --del --verbose $DIR/app $DIR/bootstrap $DIR/config $DIR/database $DIR/public $DIR/resources $DIR/routes $DEST
$RSYNC --verbose $DIR/storage .env.example artisan $DEST
$RSYNC --del $DIR/vendor $DEST
