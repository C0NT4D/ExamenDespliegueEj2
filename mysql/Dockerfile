FROM mysql:8.0
LABEL maintainer="tu_email@dominio.com"

ENV MYSQL_DATABASE=discos
ENV MYSQL_ROOT_PASSWORD=discos1234
ENV MYSQL_USER=michael
ENV MYSQL_PASSWORD=michael1234

COPY discos.sql /docker-entrypoint-initdb.d/

EXPOSE 3306







