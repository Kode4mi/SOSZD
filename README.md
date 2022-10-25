## Instalacja
1. Pobierz <a href="https://getcomposer.org/">Composera</a>
2. Wpisz w konsole w lokalizacji projektu `composer install`
3. Utwórz bazę danych i użytkownika, w konsoli mysql:
- `create database soszd_db;`
- `create user 'soszd-admin'@'localhost' identified by 'admin';`
- `GRANT ALL PRIVILEGES ON *.* TO 'soszd-admin'@'localhost';`
- `FLUSH PRIVILEGES;`
4. Wpisz `npm install`
5. Wpisz `npx mix`//
6. Wpisz `php artisan migrate --seed`
7. Wpisz `php artisan serve` //
8. Gotowe
