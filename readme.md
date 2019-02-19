# Greenhorn Works  
- Use  
  - PHP : Version >= 7.0.*  
  - Mysql : Version >= 5.7.*  
  - Node : Version >= v8.9.*  

## Installation guide  

#### Docker環境構築

- 任意の場所に作業用のディレクトリを作成し、下記2ファイルを配置

###### docker-compose.yml
```yaml:docker-compose.yml
version: '2'
services:
  db:
    image: mysql:5.7
    ports:
      - "6603:3306"
    environment:
      - MYSQL_ALLOW_EMPTY_PASSWORD=true
      - MYSQL_DATABASE=greenhorn
      - LANG=C.UTF-8
    volumes:
      - db:/var/lib/mysql
    command: mysqld --sql-mode=NO_ENGINE_SUBSTITUTION --character-set-server=utf8 --collation-server=utf8_unicode_ci

  web:
    image: arbiedev/php-nginx:7.1.8
    ports:
      - "8080:80"
    volumes:
      - ./www:/var/www
      - ./nginx.conf:/etc/nginx/sites-enabled/default

volumes:
  db:
```

###### nginx.conf
```shell:nginx.conf
server {
    listen         80;
    listen         [::]:80;
    server_name    domain.com;
    root           /var/www/dev_greenhorn_works/public;
    index          index.php index.html;
    error_log      /var/www/error.log warn;
    access_log     /var/www/access.log combined;
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    location ~ \.php$ {
            try_files $uri /index.php =404;
            fastcgi_pass  127.0.0.1:9000;
            fastcgi_index index.php;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            include fastcgi_params;
    }
}

```

- 作業ディレクトリ内でコマンドを実行
```shell
docker-compose up -d
cd www
git clone このリポジトリのURL
cd dev_greenhorn_works
cp .env{.example,}
composer install
```
### .env の編集  

```shell
# DB設定を以下のように編集
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=greenhorn
DB_USERNAME=root
DB_PASSWORD=

# 以下を追記してください
MAIL_ADDRESSPASS=some_word
MAIL_PRIVILEGES=some_word
ACCESS_RIGHT_ADMIN=100
ACCESS_RIGHT_USER=010
ACCESS_RIGHT_STORE=001
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_FROM_NAME=Greenhorn_works
MAIL_FROM_ADDRESS=atsushi0202test@gmail.com
MAIL_USERNAME=atsushi0202test@gmail.com
MAIL_PASSWORD=hwrtwvrqwnvybxlv
MAIL_ENCRYPTION=ssl
MAIL_PRETEND=false
SLACK_KEY=42620444977.353915109553
SLACK_SECRET=7d76080bb20537972e1487621cf9c020
SLACK_REDIRECT_URI=http://localhost:8080/callback
SLACK_API_KEY=xoxp-42620444977-362509122881-400641301381-e88a476b0565405b24d0e1ed3b31a695
```

### migrateとseed  
```shell
docker-compose exec web bash
cd var/www/dev_grennhorn_works
```
```shell
php artisan key:generate
php artisan migrate --seed
```

### Access URL  

- User    
[http://localhost:8080](http://localhost:8080)  

- Admin    
[http://localhost:8080/admin/login](http://localhost:8080/admin/login)    
管理者ユーザー名:admin    
パスワード:1234

