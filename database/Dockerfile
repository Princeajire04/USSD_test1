# Use official MySQL 8.0 image as base
FROM mysql:8.0

# Set environment variables
ENV MYSQL_ROOT_PASSWORD=password2
ENV MYSQL_DATABASE=ussd_db

# Expose MySQL port
EXPOSE 1527

# (Optional) If you had any custom init scripts you'd copy them here
# COPY ./init.sql /docker-entrypoint-initdb.d/
COPY database/ /var/lib/mysql