@ECHO OFF
ECHO Resetowanie migracji...
php artisan migrate:fresh -q --seed
ECHO Restart zakończony powodzeniem!
