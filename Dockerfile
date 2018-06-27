FROM iwamot/phd-ja-source:rev-345221

WORKDIR /opt/phd-ja/source
RUN svn up

COPY conf/nginx.conf /etc/nginx/sites-available/phd-ja
RUN ln -sf /etc/nginx/sites-available/phd-ja /etc/nginx/sites-enabled/default \
 && ln -sf /dev/stdout /var/log/nginx/access.log \
 && ln -sf /dev/stderr /var/log/nginx/error.log \
 && rm /etc/logrotate.d/nginx

COPY conf/sudoers.conf /etc/sudoers.d/phd-ja
RUN echo 'www-data:www-data' | chpasswd
USER www-data
RUN echo 'www-data' | sudo -S echo 'www-data can sudo!'
USER root

RUN pear install doc.php.net/phd_php && pear clear-cache

COPY conf/php.ini /usr/local/etc/php/php.ini
COPY scripts ../scripts
RUN chmod +x ../scripts/* && sync
RUN ../scripts/phd-update
RUN ../scripts/phd-build
RUN ln -sf /opt/phd-ja/output/php-chunked-xhtml /var/www/html/phd-ja

COPY admin ../admin
RUN ln -sf /opt/phd-ja/admin /var/www/html/phd-ja-admin

COPY conf/supervisord.conf /etc/supervisor/conf.d/phd-ja.conf
EXPOSE 80 9000
CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]
