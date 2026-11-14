# Proyecto Login

**Alumno/a:** [Nombre y Apellido]
**Materia:** [Nombre de la materia]
**Año de cursada:** [Año]

## Descripción
Sistema de login y registro de usuarios con pantalla de bienvenida protegida por sesión.

## Tecnologías
- Front-end: HTML5, CSS3 y JavaScript (validación de campos vacíos y de contraseñas)
- Back-end: PHP 8
- Base de datos: MySQL (puerto 3306)
- Servidor local: XAMPP (Apache, puertos 80 y 443, localhost 127.0.0.1)

## Funcionalidades
- Inicio de sesión (`index.php` / `login.php`)
- Crear cuenta con validación de contraseña (`register.php`)
- Dashboard de bienvenida con cierre de sesión (`dashboard.php` / `logout.php`)
- Pantalla de recuperar contraseña (simulación visual, `recuperar.php`)
- Contraseñas guardadas encriptadas con `password_hash()`

## Cómo ejecutarlo
1. Instalar XAMPP e iniciar **Apache** y **MySQL**.
2. Copiar la carpeta `ProyectoLogin_TP3` dentro de `C:\xampp\htdocs`.
3. Abrir `http://localhost/phpmyadmin`, ir a la pestaña **SQL**, pegar el contenido de `database.sql` y ejecutarlo.
4. Entrar a `http://localhost/ProyectoLogin_TP3/`.