# Guía de instalación y ejecución local

Este proyecto es una aplicación Laravel 12. Sigue estos pasos desde cero para tenerlo corriendo en tu PC.

---

## Requisitos previos

Antes de empezar, asegúrate de tener instalado lo siguiente:

- **PHP 8.2 o superior** → https://www.php.net/downloads
- **Composer** → https://getcomposer.org/download/
- **Node.js 18 o superior** (incluye npm) → https://nodejs.org/
- **MySQL 8 o superior** → https://dev.mysql.com/downloads/mysql/ (o usa XAMPP/Laragon)
- **Git** → https://git-scm.com/downloads

Para verificar que todo está instalado, abre una terminal y ejecuta:

```bash
php -v
composer -v
node -v
npm -v
git -v
```

---

## Paso 1 — Extraer el ZIP

Descomprime el archivo `.zip` que descargaste en la carpeta donde quieras tener el proyecto. Por ejemplo:

```
C:\proyectos\mi-proyecto\
```

Abre una terminal dentro de esa carpeta (o navega hasta ella con `cd`).

---

## Paso 2 — Instalar dependencias PHP

```bash
composer install
```

Esto descarga todos los paquetes de Laravel definidos en `composer.json`.

---

## Paso 3 — Crear el archivo de entorno

```bash
copy .env.example .env
```

> En Mac/Linux usa `cp .env.example .env`

---

## Paso 4 — Generar la clave de la aplicación

```bash
php artisan key:generate
```

Esto rellena el valor `APP_KEY` en tu `.env`, necesario para encriptar sesiones y datos.

---

## Paso 5 — Configurar la base de datos (MySQL)

Asegúrate de tener MySQL corriendo y crea una base de datos vacía:

```sql
CREATE DATABASE nombre_de_tu_bd;
```

Luego edita tu `.env` y configura la conexión:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_bd
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```

> Si usas XAMPP o Laragon, el usuario suele ser `root` y la contraseña está vacía por defecto.

---

## Paso 6 — Ejecutar las migraciones y seeders

Esto crea todas las tablas y carga los datos de prueba (20 productos):

```bash
php artisan migrate --seed
```

---

## Paso 7 — Instalar dependencias de JavaScript

```bash
npm install
```

---

## Paso 8 — Compilar los assets (CSS/JS)

```bash
npm run build
```

---

## Paso 9 — Levantar el servidor local

```bash
php artisan serve
```

Abre tu navegador en: **http://localhost:8000**

---

## Paso 10 — Subir el proyecto a GitHub

### 10.1 — Inicializar el repositorio (si aún no tiene Git)

```bash
git init
git add .
git commit -m "first commit"
```

### 10.2 — Crear un repositorio en GitHub

Ve a https://github.com/new, ponle un nombre y haz clic en **Create repository**.

### 10.3 — Conectar y subir

Copia la URL de tu repositorio (la que termina en `.git`) y ejecuta:

```bash
git remote add origin https://github.com/tu-usuario/tu-repositorio.git
git branch -M main
git push -u origin main
```

> El `.gitignore` ya está configurado para excluir `/vendor`, `/node_modules`, `.env` y otros archivos que no deben subirse al repo.

---

## Resumen de comandos

```bash
composer install
copy .env.example .env
php artisan key:generate
# Edita el .env con tus credenciales de MySQL
php artisan migrate --seed
npm install
npm run build
php artisan serve
```
