# Procedura di installazione

## Requisiti base
- Sistema operativo richiesto: debian-based (ubuntu, debian, linux mint)
- Apache 2.2 (mod_rewrite attivo)
- Mysql server 5.5
- PHP 5.x
    - php5-curl
- composer

## PROCEDURA DI INSTALLAZIONE

1) installare i requisiti base

2) clonare il repository https://github.com/davidedusi/simpleauth in /var/www/

3) creare un database mysql (e.g. simpleauth)

4) installare dipendenze composer

```

cd /var/www/simpleauth
composer install

```

al termine dell'installazione configurare connessione al database e all'smtp (per la funzionalità di cambio password)

5) configurare apache con il seguente vhost

```                                                                                                  

<VirtualHost *:80>

        ServerName simpleauth.local
        ServerAlias simpleauth.local

        DocumentRoot /var/www/simpleauth/web
        <Directory /var/www/simpleauth/web>
                AllowOverride All
                Order Allow,Deny
                Allow from All
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log

        # Possible values include: debug, info, notice, warn, error, crit,
        # alert, emerg.
        LogLevel warn

        CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>


```

6) creare lo schema database con il seguente comando comando

```

cd /var/www/simpleauth
php app/console doctrine:schema:update --force

```

7) utilizzare l'indirizzo http://simpleauth.local per vedere l'homepage

### API REST OAUTH

#### CREARE CLIENT 

Creare client di autenticazione con accesso client_credentials, con il comando shell personalizzato

```

php app/console app:oauth-server:client:create --redirect-uri=http://simpeauth/login --grant-type=token --grant-type=authorization_code --grant-type=password --grant-type=client_credentials

```

#### CREARE AUTH TOKEN

Generare un token di autenticazione utilizzato il *public_id* e il *secret* del client

```

curl -u <public_id>:<secret>  http://simpleauth.local/oauth/v2/token -d 'grant_type=client_credentials'

```

#### ACCESSO ALLE API CON TOKEN DI AUTENTICAZIONE

Utilizzare l'*auth_token* per accedere alle api protette

```

curl -X GET  http://simpleauth.local/api/hello -H "Authorization: Bearer <auth_token>" | json_pp

```
