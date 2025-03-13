# Padel Page

Repositorio en donde encontraremos el código de la aplicación web de ayuda y reserva de canchas de pádel. El proyecto está hecho en PHP y SQL como base de datos.
**Este proyecto fue realizado entre un grupo de trabajo en parejas**

## Arquitectura

Página de pádel dividida por módulos, en donde encontramos la carpeta auth, encargada del inicio de sesión y registro, reservations, encargada de hacer reservaciones
a canchas de pádel, tips, encargada de mostrar los tips / ayudas con respecto a tu manera de jugar pádel y ecommerce, encargada de mostrar productos con la posibilidad de agregarlos al carrito de la compra.

## Configuración de Rutas

Cada usuario debe crear un archivo `config/local.php` para definir su propia configuración de rutas. Este archivo no se subirá a GitHub.

Ejemplo de `config/local.php`:

```php
<?php
// Configuración para el entorno local
define('BASE_URL', 'http://localhost:8000/public');

// Configuración para el entorno de tus compañeros
// define('BASE_URL', 'http://localhost/padel/public');
```

## Arquitectura

Página de pádel dividida por módulos, en donde encontramos la carpeta auth, encargada del inicio de sesión y registro, reservations, encargada de hacer reservaciones
a canchas de pádel, tips, encargada de mostrar los tips / ayudas con respecto a tu manera de jugar pádel y ecommerce, encargada de mostrar productos con la posibilidad de agregarlos al carrito de la compra.

```
/padel
|-- /public               # Archivos accesibles desde el navegador
|   |-- index.php         # Entrada principal
|   |-- /css              # Archivos de estilos globales
|   |-- /images           # Imágenes globales
|
|-- /app                  # Lógica de negocio y controladores
|   |-- /auth             # Lógica de autenticación (Joaquin)
|   |-- /reservations     # Lógica para reservas de canchas (Álvaro y Sergio)
|   |-- /tips             # Lógica para tips de jugadas (Carlos e Iván)
|   |-- /ecommerce        # Lógica para e-commerce y carrito (Jorge y Gonzalo)
|   |-- /models           # Modelos de la base de datos
|
|-- /views                # Vistas HTML y PHP organizadas por funcionalidad
|   |-- /auth             # Vistas de login y registro (Joaquin)
|   |-- /reservations     # Vistas para reservas (Álvaro y Sergio)
|   |-- /tips             # Vistas para tips (Carlos e Iván)
|   |-- /ecommerce        # Vistas para el e-commerce (Jorge y Gonzalo)
|
|-- /config               # Configuración del proyecto
|   |-- db.php            # Conexión a la base de datos
|   |-- config.php        # Configuración global (rutas, constantes, etc.)
```

## Agregar una Nueva Vista

1. Crea un archivo en la carpeta views con el nombre de la vista, por ejemplo views/nueva_vista.php.

2. En el controlador correspondiente, agrega un método para cargar la vista:

```php
Copy
public function nuevaVista() {
    renderView('nueva_vista');
}
```

3. En public/index.php, agrega la ruta para cargar el controlador y la acción correspondiente.

## Paleta de colores

Los colores serán creados como variables en CSS y en hexadecimal para evitar la confusión.

- black: #1F1F21
- white: #F3F3F3
- yellow: #FED700
- gray: #50545D
- dark-gray: #353638

Para utilizar estas variables solo las tenemos que llamar de la siguiente manera:

```css
.text {
    color: var(--white);
    background-color: var(--gray);
}
```

## Tipografía

La tipografía ya estará añadida a todo lo que se escriba, en este caso usaremos Geist Sans.

## Configuración de Rutas

La aplicación usa **URLs limpias** gracias al archivo `.htaccess`.  
Ejemplo de estructura de rutas:  

| URL Amigable                | Internamente Cargado                  |
|-----------------------------|--------------------------------------|
| `/`                         | `index.php?page=auth/login`         |
| `/reservations/make`        | `index.php?page=reservations/make`  |
| `/ecommerce/product?id=1`   | `index.php?page=ecommerce/product`  |
| `/tips`                     | `index.php?page=tips`               |

**Reglas de `.htaccess`**  

```apache
RewriteEngine On

# Evitar redirección de archivos y directorios existentes
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

# Redirigir URLs limpias a index.php?page=...
RewriteRule ^(.+)$ index.php?page=$1 [QSA,L]
```
