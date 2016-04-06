#!/bin/sh

sed -i.bak "s/APP_ENV=local/APP_ENV=production/" .env
sed -i.bak "s/APP_DEBUG=true/APP_DEBUG=false/" .env

exec "$@"
