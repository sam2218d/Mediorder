# ==========================================
# Stage 1: Build frontend assets using Node
# ==========================================
FROM node:20 AS node_builder

WORKDIR /app

# Copy package.json and install dependencies
COPY package*.json ./
RUN npm install

# Copy rest of the files and build assets
COPY . .
RUN npm run build


# ==========================================
# Stage 2: Build PHP application
# ==========================================
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# Enable Apache mod_rewrite for Laravel routing
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configure Apache DocumentRoot to point to Laravel's public directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Configure Apache to listen on $PORT (Render provides this env variable)
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf
ENV PORT=80

# Copy application files
COPY . /var/www/html

# Copy built frontend assets from node_builder stage
COPY --from=node_builder /app/public/build /var/www/html/public/build

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Set proper permissions for storage and bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Create an entrypoint script to run migrations, seed, and start Apache
RUN echo '#!/bin/bash\n\
echo "Running optimizations..."\n\
php artisan config:cache\n\
php artisan route:cache\n\
php artisan view:cache\n\
echo "Running migrations..."\n\
php artisan migrate --force\n\
echo "Seeding database..."\n\
php artisan db:seed --force\n\
echo "Starting Apache..."\n\
apache2-foreground' > /usr/local/bin/start.sh \
    && chmod +x /usr/local/bin/start.sh

# Run the startup script
CMD ["/usr/local/bin/start.sh"]
