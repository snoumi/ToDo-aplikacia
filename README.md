Pred sťahovaním projektu sa uistite, že máte stiahnuté: 
-  composer: https://getcomposer.org/download/
- php - súčasťou XAMPP: https://www.apachefriends.org
- node.js s npm: https://nodejs.org/en/download
- git: https://git-scm.com/downloads
- laravel - cez composer príkaz: composer global require laravel/installer

Stiahnite projekt ToDo-aplikacia a otvorte ho v editovacom programe (tento návod bude orientovaný pre Visual Studio Code).

Skopírujte a premenujte súbor .env.example na .env a upravte v ňom riadky:
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=todo_db
- DB_USERNAME=root
- DB_PASSWORD=

zmeny uložte (CTRL + S).
Použite príkazy v terminály v projekte:
- composer install
- npm install
- npm run build

Otvorte XAMPP, zapnite Apache a MySQL, následne sa vráťte do terminálu v projekte a použite príkaz: php artisan migrate .

Terminál sa vás opýta na vytvorenie novej databázy todo_db, napíšte: yes .

Použite príkaz: php artisan key:generate , a po ňom: php artisan serve , po chvíli sa web server zapne a môžete prejsť na https://127.0.0.1:8000 .

Pri prvom vstupe na stránke sa zaregistrujte cez možnosť registrácie v pravom hornom rohu.

Po registrácii sa ocitnete v dashboarde, tu prejdite ďalej cez "Spravuj svoje úlohy".

Tu môžeš vytvoriť úlohy, upraviť ich, zobraziť ich podrobnosti, odstrániť ich a filtrovať ich pomocou vyhľadávača tagov.



Seedovanie dummy dát: php artisan db:seed
Testy: php artisan test


Použitie API  (Postman: https://www.postman.com/downloads/)

REGISTRÁCIA: URL: POST ⏐ http://127.0.0.1:8000/api/register
                       Body(JSON): {
                                             "name": "meno",
                                             "email": "mail",
                                             "password": "heslo",
                                             "password_confirmation": "heslo"
                                           }

PRIHLÁSENIE: URL: POST ⏐ http://127.0.0.1:8000/api/login
                       Body(JSON): {
                                             "email": "mail",
                                             "password": "heslo"
                                           }

pre ďalšie API potrebujete Authorization buď cez Bearer Token (mala by ho obsahovať odpoveď z registrácie/prihlásenia) alebo Basic login (email, heslo)

ODHLÁSENIE: URL: POST ⏐ http://127.0.0.1:8000/api/logout

 ZOBRAZENIE VŠETKÝCH ÚLOH: URL: GET ⏐ http://127.0.0.1:8000/api/tabulka

 VYTVORENIE ÚLOHY: URL: POST ⏐ http://127.0.0.1:8000/api/tabulka
                                           Body(JSON): {
                                                                 "name": "názov úlohy",
                                                                 "description": "popis úlohy",
                                                                 "status": true / false,
                                                                 "tags": "tag1, tag2, ..."
                                                               }

ÚPRAVA ÚLOHY: URL: PUT ⏐ http://127.0.0.1:8000/api/tabulka/{id}
                                 Body(JSON): {
                                                       "name": "nový názov úlohy",
                                                       "description": "Upravený popis",
                                                       "status": true / false,
                                                       "tags": "tag3, tag4, ..."
                                                     }

ODSTRÁNENIE ÚLOHY: DELETE ⏐ http://127.0.0.1:8000/api/tabulka/{id}
