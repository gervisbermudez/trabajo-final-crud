# Proyecto Wonderland - Cafetería Online

## Descripción
**Wonderland** es una aplicación web de comercio electrónico diseñada para una cafetería. Permite gestionar productos, clientes y pedidos a través de un panel de administración.

## Requisitos previos
- **XAMPP**: Un entorno de desarrollo local que incluye Apache, MySQL, PHP y otros componentes necesarios. Descarga la última versión desde [Apache Friends](https://www.apachefriends.org/es/index.html).
- **HeidiSQL**: Una herramienta de administración de bases de datos MySQL. Descárgala desde [HeidiSQL](https://heidisql.com/).
- **Navegador web**: Chrome, Firefox, Edge o similar.
- Conocimientos básicos de:
  - HTML, CSS
  - PHP
  - MySQL

## Instalación y configuración

### 1. Instalar XAMPP
- Descarga e instala **XAMPP** siguiendo las instrucciones del instalador.
- Inicia el servidor Apache y MySQL desde el panel de control de XAMPP.

### 2. Crear la base de datos
- Abre **HeidiSQL** y conéctate a tu servidor MySQL local (usualmente `localhost`, usuario `root`, sin contraseña).
- Crea una nueva base de datos llamada `wonderland` (o el nombre que prefieras).
- Si tienes un script SQL para crear las tablas, impórtalo en la base de datos recién creada.

### 3. Clonar el proyecto
- Clona este repositorio en la carpeta `htdocs` de XAMPP (o la carpeta de documentos de tu servidor web local).

### 4. Configurar el archivo de configuración
- Edita el archivo `config.php` (o similar) para ajustar las credenciales de tu base de datos.

## Ejecutar el proyecto
```bash
php -S localhost:8080
```
Abre tu navegador y ve a http://localhost:8080 para acceder a tu sitio.
### Panel de administración
Accede al panel de administración en http://localhost:8080/admin.
Utiliza las credenciales de administrador que hayas definido para iniciar sesión.
Estructura del proyecto

public: Contiene los archivos públicos del sitio web (HTML, CSS, JavaScript).
admin: Contiene los archivos del panel de administración.

includes: Contiene archivos PHP que se incluyen en otras páginas.
config.php: Contiene la configuración de la aplicación (base de datos, etc.).

## Adicional

### Seguridad
Contraseñas: Utiliza funciones de encriptación para almacenar contraseñas de forma segura.
Validación: Valida todos los datos de entrada para prevenir inyecciones SQL y otros ataques.
Permisos: Limita los permisos de los archivos y directorios para proteger tu aplicación.