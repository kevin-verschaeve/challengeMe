#!/bin/bash
set -e

: ${WWW_DATA_UID:=`stat -c %u /var/www/html`}
: ${WWW_DATA_GUID:=`stat -c %g /var/www/html`}

# Change www-data's uid & guid to be the same as directory in host
# Fix cache problems
if [ "`id -u www-data`" != "$WWW_DATA_UID" ]; then
    usermod -u $WWW_DATA_UID www-data || true
fi

if [ "`id -u www-data`" != "$WWW_DATA_GUID" ]; then
    groupmod -g $WWW_DATA_GUID www-data || true
fi

apache2-foreground
