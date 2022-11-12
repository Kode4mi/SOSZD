<img src="./public/images/logo.png " data-canonical-src="./public/images/logo.png" width="400" alt="Logo SOSZD" />


## System Obiegu SZkolnych Dokumentów
Wykonana we frameworku Laravel aplikacja pomagająca w zarządzaniu, udostępnianiu i przetwarzaniu dokumentów szkolnych. Dzięki niebywałym umiejętnościom zespołu szkół technicznych stworzyliśmy fantastyczny system wspomagający pracę oświaty.


## Instalacja
1. Pobierz <a href="https://getcomposer.org/">Composera</a>
2. Wpisz w konsole w lokalizacji projektu `composer install`
3. Utwórz bazę danych i użytkownika, w konsoli mysql:
- `create database soszd_db;`
- `create user 'soszd-admin'@'localhost' identified by 'admin';`
- `GRANT ALL PRIVILEGES ON *.* TO 'soszd-admin'@'localhost';`
- `FLUSH PRIVILEGES;`
4. Wpisz `npm install`
5. Wpisz `npm run dev`
6. Wpisz `.\r`
7. Wpisz `.\start`
8. Gotowe

#### Włączenie kolejowania emaili `php artisan queue:work` 

## Dane logowania testowych użytkowników:

- admin email: `admin@soszd.pl` hasło: `admin` 
- admin email: `uzytkownik@soszd.pl` hasło: `test` 

## Autorzy
- Michał Szajner
- Mikołaj Szokaluk
- Mariusz Wakuła
- Jan Ślepaczuk
