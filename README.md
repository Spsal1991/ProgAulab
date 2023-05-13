SETTAGGI PRESENTI:

-   PublicController

-   cartella components con: footer | navbar | header | layout(Fontawsome, @vite)

-   cartella auth con : login | register

-   Fority:
    a. già presente con dentro le funzioni login e register già impostate.
    b. config->app.php-> "App\Providers\FortifyServiceProvider::class," impostata(riga 188)

-   css.app + js.app già configurati e collegati a style.css e main.js

-   app->Providers->RouteServiceProvider.php-> la public const HOME = '/'; impostata correttamente

-   php artisan make:mail ContactMail già lanciata

-   vista welcome impostata, collegata alla navbar, rotta scritta in web.php e funzione presente in PublicController
