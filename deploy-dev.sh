# Change Laravel ENV vars
# cp .env.production .env
cp docker-compose.yml docker-compose.development.yml
cp docker-compose.production.yml docker-compose.yml


# Copy files
rsync --recursive -avz --exclude-from exclude.txt * root@207.154.237.229:/var/www/html


# Restore Laravel ENV vars
# cp .env.development .env
