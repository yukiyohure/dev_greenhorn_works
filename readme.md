# Greenhorn Works  
- Use  
  - PHP : Version >= 7.0.*  
  - Mysql : Version >= 5.7.*  
  - Node : Version >= v8.9.*  

## Installation guide  
- Dockerの設定ファイルを共有してもらう  
- 任意の場所に作業用ディレクトリを作ってそこに配置  

```shell
docker-compose -d --build
cd www
git clone {このリポジトリのURL}
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
[http://localhost:8080](http://localhost:8080)  







