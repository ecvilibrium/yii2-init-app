<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Claim ASAP</h1>
    <br>
</p>

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-advanced)

Local NGINX Config
-------------------

```
server {
   charset utf-8;
   listen 80;
   listen [::]:80;
#
listen 443 ssl;
listen [::]:443 ssl;
#
   root /var/www/claimasap;

   # Add index.php to the list if you are using PHP
   index index.html index.htm index.php;

   server_name app.claimasap.com;
#
include snippets/self-signed.conf;
include snippets/ssl-params.conf;
#
   access_log /var/log/nginx/claimasap-access.log;
   error_log /var/log/nginx/claimasap-error.log warn;

   location / {
       root /var/www/claimasap/frontend/web;
       try_files $uri /frontend/web/index.php?$args;
   }
   location ~ [^/]\.php(/|$) {
       try_files $uri =404;
       fastcgi_split_path_info ^(.+\.php)(/.+)$;
       fastcgi_pass unix:/run/php/php7.2-fpm.sock;
       fastcgi_index index.php;
       fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
       include fastcgi_params;
   }
   location ~* \.(htaccess|htpasswd|svn|git) {
       deny all;
   }

   location /admin {
       alias /var/www/claimasap/backend/web;
       try_files $uri /backend/web/index.php?args;
   }
#
#   location ~* \.(css|js|png|eot|otf|ttf|woff|woff2|map)$ {
#         add_header Access-Control-Allow-Origin *;
#   }
}

```
