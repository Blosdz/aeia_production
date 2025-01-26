FROM php:7.4-fpm-alpine

# Add PHP extension installer
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install PHP extensions
RUN apk update && chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions gd xdebug pdo pdo_pgsql sockets zip

# RUN chmod +x /usr/local/bin/install-php-extensions && \
#     install-php-extensions gd xdebug pdo pdo_pgsql sockets zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# Copy Composer binary
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js and npm
RUN apk add --no-cache nodejs npm

# Set working directory
WORKDIR /app

# Copy package.json and package-lock.json (if present) before running npm install
COPY package*.json ./

# Install npm dependencies
RUN npm install

# Copy the rest of the application files
COPY . .
RUN ls -la /app

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
