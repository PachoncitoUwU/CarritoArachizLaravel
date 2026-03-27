# Guía de instalación y ejecución local

Este proyecto es una aplicación Laravel 12. Sigue estos pasos desde cero para tenerlo corriendo en tu PC.

---

## Requisitos previos

Antes de empezar, asegúrate de tener instalado lo siguiente:

- **PHP 8.2 o superior** → https://www.php.net/downloads
- **Composer** → https://getcomposer.org/download/
- **Node.js 18 o superior** (incluye npm) → https://nodejs.org/
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

## Paso 5 — Base de datos (SQLite, no necesitas instalar nada)

Este proyecto usa **SQLite**, así que no necesitas MySQL ni ningún servidor de base de datos externo. Solo crea el archivo de base de datos:

```bash
# Windows (CMD)
type nul > database\database.sqlite

# Windows (PowerShell)
New-Item -ItemType File database\database.sqlite

# Mac/Linux
touch database/database.sqlite
```

Luego verifica que en tu `.env` la conexión esté configurada así (ya viene por defecto):

```env
DB_CONNECTION=sqlite
```

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
type nul > database\database.sqlite
php artisan migrate --seed
npm install
npm run build
php artisan serve
```
