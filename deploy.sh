#!/bin/bash
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
DEST=klecks@euve251339.serverprofi24.de:/home/klecks/www
RSYNC="rsync -rlptEz --exclude-from $DIR/rsync.exclude"

$RSYNC --del -v $DIR/app $DIR/bootstrap $DIR/database $DIR/public $DIR/resources $DIR/routes $DEST
$RSYNC -v $DIR/storage .env.example artisan $DEST
$RSYNC --ignore-existing -v $DIR/config $DEST
$RSYNC --del $DIR/vendor $DEST
