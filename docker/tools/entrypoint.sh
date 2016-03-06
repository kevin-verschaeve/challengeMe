#!/bin/bash
set -e

: ${WWW_DATA_UID:=`stat -c %u /var/www/html`}
: ${WWW_DATA_GUID:=`stat -c %g /var/www/html`}

# Change www-data's uid & guid to be the same as directory in host or the configured one
# Fix cache problems
if [ "`id -u www-data`" != "$WWW_DATA_UID" ]; then
    usermod -u $WWW_DATA_UID www-data || true
fi

if [ "`id -u www-data`" != "$WWW_DATA_GUID" ]; then
    groupmod -g $WWW_DATA_GUID www-data || true
fi

# Execute all commands with user www-data
if [ "$1" = "composer" ]; then
    su www-data -s /bin/bash -c "`which php` -d memory_limit=-1 `which composer` ${*:2}"
else
    su www-data -s /bin/bash -c "$*"
fi
