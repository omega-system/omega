#!/bin/sh

if [ -n "$MYSQL_PORT_3306_TCP" ]; then
  if [ -z "$OMEGA_DB_HOST" ]; then
    OMEGA_DB_HOST='mysql'
    OMEGA_DB_PORT=$MYSQL_PORT_3306_TCP_PORT
  fi
fi

if [ -z "$OMEGA_DB_HOST" ]; then
  echo >&2 'error: missing OMEGA_DB_HOST'
  exit 1
fi
if [ -z "$OMEGA_DB_PORT" ]; then
  echo >&2 'error: missing OMEGA_DB_PORT'
  exit 1
fi

: ${OMEGA_DB_USER:=${MYSQL_ENV_MYSQL_USER:-root}}
if [ "$OMEGA_DB_USER" = 'root' ]; then
  : ${OMEGA_DB_PASSWORD:=$MYSQL_ENV_MYSQL_ROOT_PASSWORD}
fi
: ${OMEGA_DB_PASSWORD:=$MYSQL_ENV_MYSQL_PASSWORD}
: ${OMEGA_DB_NAME:=${MYSQL_ENV_MYSQL_DATABASE:-omega}}

if [ -z "$OMEGA_DB_PASSWORD" ]; then
  echo >&2 'error: missing required OMEGA_DB_PASSWORD environment variable'
  exit 1
fi

sed -i.bak "s/APP_ENV=local/APP_ENV=production/" .env
sed -i.bak "s/APP_DEBUG=true/APP_DEBUG=false/" .env
sed -i.bak "s/DB_HOST=127.0.0.1/DB_HOST=${OMEGA_DB_HOST}/" .env
sed -i.bak "s/DB_PORT=3306/DB_PORT=${OMEGA_DB_PORT}/" .env
sed -i.bak "s/DB_DATABASE=homestead/DB_DATABASE=${OMEGA_DB_NAME}/" .env
sed -i.bak "s/DB_USERNAME=homestead/DB_USERNAME=${OMEGA_DB_USER}/" .env
sed -i.bak "s/DB_PASSWORD=secret/DB_PASSWORD=${OMEGA_DB_PASSWORD}/" .env

# Create database if not exists
php -r '
for ($i = 10; $i--; ) {
  try {
    $pdo = new PDO("mysql:host=$argv[1];port=$argv[2]", $argv[3], $argv[4]);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$argv[5]`"); exit(0);
  } catch (Exception $e) {
    printf("warning: " . $e);
    sleep(10);
  }
}
exit(1);' -- $OMEGA_DB_HOST $OMEGA_DB_PORT $OMEGA_DB_USER $OMEGA_DB_PASSWORD $OMEGA_DB_NAME || exit 1

php artisan migrate --force

exec "$@"
