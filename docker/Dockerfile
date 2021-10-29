FROM wordpress

COPY /init.sh /init.sh

RUN chown -R www-data:www-data /var/www/html \
  && chmod +x /init.sh

CMD ["/init.sh"]
