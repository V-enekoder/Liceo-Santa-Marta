# PASOS PARA LA INSTALACION y EJECUCION DEL SISTEMA
### 1. Bajar el repositorio mediante la terminal 
```
git clone https://github.com/V-enekoder/Liceo-Santa-Marta.git
```
### 2. Tener xampp instalado
Link de descarga: https://www.apachefriends.org/es/index.html
##### 2.1 abrir xampp y ejecutar la BD
![image](https://github.com/V-enekoder/Liceo-Santa-Marta/assets/108310642/503fb38e-369f-40e1-9728-e135471f511f)
![image](https://github.com/V-enekoder/Liceo-Santa-Marta/assets/108310642/3e1e9fd4-7772-45b3-b1ca-23bdc2cbd9b8)
### 3. Abrir terminal en el proyecto y ejecutar paso a paso los siguientes comandos:
```
npm install
npm run build
composer update --with-all-dependencies
php artisan migrate
```
### 4. Agregar Moonshine al Proyecto:
***Composer***
```
composer require moonshine/moonshine
```
***Instalación***
```
php artisan moonshine:install
```
### 5. Reparar error 500 no se encuentra el servidor:
```
composer install
mv .env.example .env
php artisan cache:clear
composer dump-autoload
php artisan key:generate
```
### 6. Modificar archivo **.env**:
##### 6.1 Ubicar el archivo **.env**
![image](https://github.com/V-enekoder/Liceo-Santa-Marta/assets/108310642/8f6a48be-2753-458f-b388-032833ec6d6f)
##### 6.2 Ingresar y buscar la línea **SESSION_DRIVER**
![image](https://github.com/V-enekoder/Liceo-Santa-Marta/assets/108310642/03208291-1de9-4599-99d2-6e70b2290d20)
##### 6.3 Cambiar el valor _database_ por ***file*** [database ---> file]
![image](https://github.com/V-enekoder/Liceo-Santa-Marta/assets/108310642/138d3bb4-7e04-4f87-8b85-b23e8dc4598e)

## [FINAL] Ejecución del servidor:
_Una sola vez previo a la ejecución del servidor_
```
php artisan db:seed
```
_Cada vez que se quiera iniciar el servidor_
```
php artisan serve
```
![image](https://github.com/user-attachments/assets/2170f528-6b6f-4b68-8b3b-53fc62c7ffe8)
![image](https://github.com/V-enekoder/Liceo-Santa-Marta/assets/108310642/60650598-21b8-4eaf-b7c5-51a9bcd6498e)


--------------------------------------------------------
# DOCUMENTACION DE LARAVEL 
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

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).




    
