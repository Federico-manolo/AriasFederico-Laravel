## Pasos

- clonar el repo https://github.com/iaw-2023/laravel-template y mantener como owner la organización de la materia.
## parados en el directorio del repositorio recientemente clonado, ejecutar:

- `composer install`
- `cp .env.example .env`
- `php artisan key:generate`
- `php artisan serve`

Con el último comando, pueden acceder a http://127.0.0.1:8000/ y ver la cáscara de la aplicación Laravel

### Requisitos

- tener [composer](https://getcomposer.org/) instalado
- tener [php](https://www.php.net/) instalado



<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
## Informe Primera Entrega
El proyecto web se basa en un servicio web de ventas físicas de Cartas de jugadores de la NBA, liga estadounidense profesional de primera de basketball. Usuarios comunes tendrán la capacidad de optar por un conjunto de cartas, seleccionando desde un ser cargado de jugadores activos de la liga. Además, ofrecerá información específica sobre estos mismos, incluyendo los equipos en los que se desempeñan. 
En un principio todas las entidades presentadas en el diagrama van a actualizarse, los jugadores, equipos y cartas serán cargados desde el inicio y posteriormente los administradores tendrán la posibilidades de agregar nuevos objetos. Además los usuarios, a medida que van ingresando en la página actualizarán la respectiva entidad llevando a cabo el Log In. Por último, los Pedidos se crearán una vez llevada a cabo la compra.
Los reportes que podremos generar son listas de jugadores activos en la página con sus respectivas cartas, reportes acerca de los jugadores cuyas cartas han sido más vendidas en un determinado rango de tiempo. Incluso, haciendo una selección más específica, podremos visualizar reportes de jugadores dependiendo al equipo al que pertenecen.
Las entidades que se pueden obtener por API son: 
•	Jugador
•	Equipo
•	Carta
•	Usuario
•	Pedido
Las entidades que se pueden modificar por API son:
•	Usuario
•	Pedido
El usuario podrá acceder a información relacionada a la carta del jugador, datos más específicos del mismo y, a su vez, características puntuales sobre los equipos que fueron cargados por el administrador. 
Con respecto al accionar y funcionalidad disponible para el usuario, en primer lugar este podrá acceder a la página como invitado (sin ningún tipo de usuario), iniciando sesión o sino registrándose (cabe destacar que para una supuesta compra posterior deberá si o sí estar registrado y haber iniciado sesión). El usuario podrá optar por visualizar tres categorías diferentes, una de los jugadores, otra de los equipos y la relacionada a las cartas puntualmente. Dependiendo de la misma la página tendrá una distribución distinta en dónde aparece la información correspondiente. En cualquier momento el usuario puede volver al inicio de la aplicación. Al acceder a la selección de las cartas se podrán visualizar y escoger en caso de que se quieran agregar al carrito. Una vez que el usuario haya finalizado el proceso en cuestión y decida efectuar el pago, debe dirigirse al carrito efectuar la compra. 

## Diagrama entidad-relacion
![Diagrama entidad-relación](https://raw.githubusercontent.com/iaw-2023/Cyber-Strikers/entrega/app/public/images/diagrama.png?token=GHSAT0AAAAAACAG4PMK5RGKRXIYVAVWUYUYZB4MDUQ)

https://app.diagrams.net/#G15bdq6Ws_p4AqoLwWcuyKLdDGjo4nXfJ3