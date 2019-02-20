# Valleypoint-Campsite

> A Web-based Lodging Monitoring System with Bar and Restaurant Point-of-Sales for Valleypoint Campsite.

## Quick Start

``` bash
# Clone repository
git clone https://github.com/culanag/valleypoint-campsite.git

# Install Composer Dependencies
composer install

# Install NPM Dependencies
npm install

# Allow access to project files
chmod 755 -R valleypoint-campsite
chmod -R o+w valleypoint-campsite/storage

# Add virtual host if using Apache
<VirtualHost *:80>
    ServerName valleypoint.com
    DocumentRoot "${INSTALL_DIR}/www/valleypoint-campsite/public"
</VirtualHost>

# If you get an error about an encryption key
php artisan key:generate

```

## Version Control

### Pull latest commit
``` bash
git pull --rebase
```

### Update files in local repository
``` bash
git add .
```

### Commit to local repository
``` bash
git commit -m "[add commit message here]"
```

### Push to GitHub repository
``` bash
git push
```

### Check files
``` bash
git status
```

For any questions, send a chat in #general through Slack.