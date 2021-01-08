#!/bin/bash

# Install packages
apt install -y supervisor
apt install -y cron

# Create Supervisor/Horizon configuration file
touch /etc/supervisor/conf.d/horizon.conf

# Add contents to Supervisor/Horizon configuration file
echo "[program:horizon]
process_name=%(program_name)s
environment=
    APP_ENV=\"$APP_ENV\",
    APP_KEY=\"$APP_KEY\",
    APP_NAME=\"$APP_NAME\",
    APP_URL=\"$APP_URL\",
    CACHE_DRIVER=\"$CACHE_DRIVER\",
    DB_DATABASE=\"$DB_DATABASE\",
    DB_HOST=\"$DB_HOST\",
    DB_PASSWORD=\"$DB_PASSWORD\",
    DB_SSLMODE=\"$DB_SSLMODE\",
    DB_USERNAME=\"$DB_USERNAME\",
    MAIL_ENCRYPTION=\"$MAIL_ENCRYPTION\",
    MAIL_FROM_ADDRESS=\"$MAIL_FROM_ADDRESS\",
    MAIL_HOST=\"$MAIL_HOST\",
    MAIL_PASSWORD=\"$MAIL_PASSWORD\",
    MAIL_PORT=\"$MAIL_PORT\",
    MAIL_USERNAME=\"$MAIL_USERNAME\",
    PHP_INI_SCAN_DIR=\"$PHP_INI_SCAN_DIR\",
    QUEUE_CONNECTION=\"$QUEUE_CONNECTION\",
    REDIS_HOST=\"$REDIS_HOST\",
    REDIS_PASSWORD=\"$REDIS_PASSWORD\",
    REDIS_PORT=\"$REDIS_PORT\",
    SESSION_DRIVER=\"$SESSION_DRIVER\",
    SESSION_LIFETIME=\"$SESSION_LIFETIME\",
    SESSION_SECURE_COOKIE=\"$SESSION_SECURE_COOKIE\"
command=php /home/site/wwwroot/artisan horizon
autostart=true
autorestart=true
user=root
redirect_stderr=true
stdout_logfile=/home/site/wwwroot/storage/logs/horizon.log
stopwaitsecs=3600" >> /etc/supervisor/conf.d/horizon.conf

# Add scheduler runner to crontab
echo "* * * * * cd /home/site/wwwroot && php artisan schedule:run >> /dev/null 2>&1" >> /etc/crontab

# Reload Supervisor config, update and start Horizon
service cron start
service supervisor start
supervisorctl reload
supervisorctl reread
supervisorctl update
supervisorctl start horizon

rm /home/site/wwwroot/bootstrap/cache/*

php /home/site/wwwroot/artisan horizon:publish

php /home/site/wwwroot/artisan cache:clear
php /home/site/wwwroot/artisan config:cache