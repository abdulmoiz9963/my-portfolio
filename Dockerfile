FROM richarvey/nginx-php-fpm:3.1.6

RUN apk add --no-cache php84 php84-fpm php84-pdo php84-pdo_mysql php84-mbstring php84-zip php84-gd || true

COPY . .

ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]
