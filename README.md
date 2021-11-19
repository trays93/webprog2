# Web programozás 2 beadandó

## Előkészületek

- A fájlokat bemásolni a C:\beadando mappába, majd az apache webszervernek hozzáadni egy új vhost-ot (C:\xampp\apache\conf\extra\httpd-vhosts.conf):

```apache
<VirtualHost *:80>
    ServerName localhost
    DocumentRoot C:\xampp\htdocs
    <Directory C:\xampp\htdocs>
        DirectoryIndex index.php index.html
    </Directory>
</VirtualHost>


<VirtualHost *:80>
    ServerName beadando.io
    DocumentRoot C:\beadando
    <Directory C:\beadando>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
        Require all granted
    </Directory>
</VirtualHost>

```

- És kiegészíteni a Windows hosts fájlját (C:\Windows\System32\drivers\etc\hosts):

```text
127.0.0.1	localhost
127.0.0.1	beadando.io
```

- Majd a create.sql fájl tartalmát lefuttatni MySQL-ben. Ha létezik már a 'beadando' adatbázis, akkor értelemszerűen törölni kell.
- Legvégül a data mappában található seed.php-t kell lefuttatni

```cmd
cd C:\beadando\data
php seed.php
```
