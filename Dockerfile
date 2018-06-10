FROM php:5.6.36-cli-stretch

WORKDIR /opt/phd-ja/source
COPY scripts ../scripts

RUN apt-get update && \
    apt-get install -y less nginx subversion vim && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN pear install doc.php.net/phd_php && \
    pear clear-cache

RUN svn co http://svn.php.net/repository/phpdoc/modules/doc-ja .

RUN chmod +x ../scripts/phd-configure && \
    ../scripts/phd-configure

RUN echo 'date.timezone = UTC' >  /usr/local/etc/php/php.ini && \
    echo 'memory_limit = 256M' >> /usr/local/etc/php/php.ini && \
    chmod +x ../scripts/phd-build && \
    ../scripts/phd-build

RUN ln -s /opt/phd-ja/output/php-chunked-xhtml /var/www/html/phd-ja

CMD ["/usr/sbin/nginx", "-g", "daemon off;"]
EXPOSE 80
