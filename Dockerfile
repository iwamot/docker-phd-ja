FROM iwamot/phd-ja-source:rev-345125

RUN apt-get update && apt-get install -y nginx && apt-get clean && rm -rf /var/lib/apt/lists/*
RUN ln -sf /dev/stdout /var/log/nginx/access.log && \
    ln -sf /dev/stderr /var/log/nginx/error.log

RUN pear install doc.php.net/phd_php && pear clear-cache
RUN echo 'date.timezone = UTC' >  /usr/local/etc/php/php.ini && \
    echo 'memory_limit = 256M' >> /usr/local/etc/php/php.ini

WORKDIR /opt/phd-ja/source
RUN svn up

COPY scripts ../scripts
RUN chmod +x ../scripts/* && sync
RUN ../scripts/phd-configure
RUN ../scripts/phd-build

RUN ln -sf /opt/phd-ja/output/php-chunked-xhtml /var/www/html/phd-ja

CMD ["nginx", "-g", "daemon off;"]
EXPOSE 80
