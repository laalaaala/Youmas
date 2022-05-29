# Change Laravel ENV vars
cp .env.production .env
cp docker-compose.production.yml docker-compose.yml

# Copy files
rsync --recursive -avz --exclude-from exclude.txt * root@212.227.30.63:/var/www/html

# Restore Laravel ENV vars
cp .env.development .env
cp docker-compose.development.yml docker-compose.yml
