FROM iwamot/phd-ja-source:rev-345981

WORKDIR /opt/phd-ja/source
RUN svn up

COPY conf/nginx.conf /etc/nginx/conf.d/default.conf
RUN ln -sf /dev/stdout /var/log/nginx/access.log \
 && ln -sf /dev/stderr /var/log/nginx/error.log \
 && rm /etc/logrotate.d/nginx \
 && mkdir -p /run/nginx

COPY conf/sudoers.conf /etc/sudoers.d/phd-ja
RUN set -o pipefail && echo 'www-data:www-data' | chpasswd
USER www-data
RUN set -o pipefail && echo 'www-data' | sudo -S echo 'www-data can sudo!'
USER root

RUN pear install doc.php.net/phd_php && pear clear-cache

COPY conf/php.ini /usr/local/etc/php/php.ini
COPY scripts ../scripts
RUN chmod +x ../scripts/* && sync
RUN ../scripts/phd-update
RUN ../scripts/phd-build
RUN ln -sf /opt/phd-ja/output/php-chunked-xhtml /var/www/html/phd-ja
RUN echo 'user-agent: *\ndisallow: /phd-ja/' > /var/www/html/robots.txt

COPY admin ../admin
RUN ln -sf /opt/phd-ja/admin /var/www/html/phd-ja-admin

COPY conf/supervisord.conf /etc/supervisor.d/phd-ja.ini
RUN rm /etc/logrotate.d/supervisord

EXPOSE 80 9000
CMD ["supervisord", "-c", "/etc/supervisord.conf"]
