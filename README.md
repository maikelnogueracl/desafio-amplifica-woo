# Desafío Amplifica Woo (Overlay)

**IMPORTANTE:** Este ZIP es un *overlay* listo con código, SQLite y configuración,
pero **no incluye el core de Laravel ni la carpeta `vendor/`**. Necesitas una base de Laravel ya instalada
(idealmente Laravel 11.x) para que funcione sin `composer install`.

## Opción A (rápida, sin Composer local)
1. Copia una carpeta `vendor/` de cualquier proyecto Laravel 11.x funcionando en tu máquina.
2. Pégala en esta carpeta (`desafio-amplifica-woo/`).
3. Verifica que exista `artisan` en la raíz y que `bootstrap/app.php` apunte a Laravel 11.x.
4. Ve a `C:\laragon\www`, descomprime el ZIP como `desafio-amplifica-woo`.
5. Abre consola:
   ```
   cd desafio-amplifica-woo
   php artisan key:generate
   php artisan migrate --force
   php artisan serve
   ```
   Usuario demo: **admin@demo.test** / **secret**

> *Nota:* Este overlay ya trae `.env` configurado para SQLite y `database/database.sqlite` creado.

## Opción B (si puedes ejecutar Composer una vez)
1. En la raíz del proyecto, ejecuta:
   ```
   composer install
   php artisan key:generate
   php artisan migrate --force
   php artisan serve
   ```
2. Listo.

## Qué incluye
- Autenticación simple (login con usuario hardcodeado en `.env`) — requerido por el PDF. 
- Integración con **WooCommerce** vía REST (API Key) para:
  - Listar **productos** (nombre, SKU, precio, imagen).
  - Listar **pedidos** recientes (últimos 30 días: cliente, fecha, ítems, estado).
- Exportación a **CSV** para productos y pedidos.

## Variables de entorno
Configura en `.env`:
```
WC_BASE_URL=https://tu-tienda.com
WC_CONSUMER_KEY=ck_xxx
WC_CONSUMER_SECRET=cs_xxx
DEMO_USER_EMAIL=admin@demo.test
DEMO_USER_PASS=secret
```

## Rutas principales
- GET `/login` (form), POST `/login`
- GET `/logout`
- GET `/` (dashboard)
- GET `/products`, GET `/orders`
- GET `/export/products`, GET `/export/orders`

## Consideraciones
- Para evitar errores SSL en entornos de prueba, las llamadas a WooCommerce se hacen con `verify=False`.
- SQLite ya está inicializada: `database/database.sqlite`.

