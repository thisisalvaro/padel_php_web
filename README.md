# Padel page

Repositorio en donde encontraremos el código de la aplicación web de ayuda y reserva de canchas de pádel. El proyecto está hecho en PHP y SQL como base de datos.

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

## Paleta de colores

Los colores serán creados como variables en CSS y en hexadecimal para evitar la confusión.

- black: #1F1F21
- white: #F3F3F3
- yellow: #FED700
- gray: #50545D

## Tipografía

La tipografía ya estará añadida a todo lo que se escriba, en este caso usaremos Geist Sans.
