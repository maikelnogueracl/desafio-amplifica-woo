# Desafío Técnico – Amplifica (WooCommerce)

Este proyecto corresponde al desafío técnico solicitado por **Amplifica**, implementando una aplicación en **Laravel** que se conecta a una tienda **WooCommerce** para visualizar productos y pedidos, con exportación de datos a CSV.

## 📌 Objetivo

- Autenticación de usuario (hardcodeada en `.env`).
- Conexión a WooCommerce vía **REST API** (consumer key / secret).
- Listado de productos: nombre, SKU, precio, imagen.
- Listado de pedidos recientes (últimos 30 días): cliente, fecha, estado, productos comprados.
- Exportación de productos y pedidos a CSV.

## 🛠 Tecnologías utilizadas

- **PHP 8.3**  
- **Laravel 11**  
- **GuzzleHTTP** para consumo de API WooCommerce  
- **SQLite** como base de datos local  
- **Bootstrap 5** para estilos básicos  

---

## 🚀 Instalación

1. **Clonar repositorio**
   ```bash
   git clone https://github.com/maikelnogueracl/desafio-amplifica-woo.git
   cd desafio-amplifica-woo
   ```

2. **Instalar dependencias**
   > Si tienes problemas con SSL en Composer, puedes copiar la carpeta `vendor/` desde otro proyecto Laravel 11 funcional.
   ```bash
   composer install
   ```

3. **Configurar variables de entorno**
   Copia `.env.example` a `.env` y ajusta:
   ```env
   APP_NAME=DesafioAmplificaWoo
   APP_ENV=local
   APP_KEY=
   APP_DEBUG=true
   APP_URL=http://localhost

   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite

   WC_BASE_URL=https://tu-tienda.com
   WC_CONSUMER_KEY=ck_xxx
   WC_CONSUMER_SECRET=cs_xxx

   DEMO_USER_EMAIL=admin@demo.test
   DEMO_USER_PASS=secret
   ```

4. **Generar clave y migrar BD**
   ```bash
   php artisan key:generate
   php artisan migrate --force
   ```

5. **Levantar servidor**
   ```bash
   php artisan serve
   ```

---

## 🧪 Pruebas de integración

1. Inicia sesión con:
   ```
   admin@demo.test
   secret
   ```
2. Configura en `.env` las credenciales de tu WooCommerce.
3. Ve a:
   - `/products` → listado de productos.
   - `/orders` → pedidos últimos 30 días.
4. Exporta datos:
   - `/export/products` → descarga CSV de productos.
   - `/export/orders` → descarga CSV de pedidos.

---

## 🔗 Rutas principales

| Método | Ruta                 | Descripción                              |
|--------|----------------------|------------------------------------------|
| GET    | `/login`              | Formulario de login                      |
| POST   | `/login`              | Procesa login                            |
| GET    | `/logout`             | Cierra sesión                            |
| GET    | `/`                   | Dashboard                                |
| GET    | `/products`           | Lista productos desde WooCommerce        |
| GET    | `/orders`             | Lista pedidos últimos 30 días            |
| GET    | `/export/products`    | Exporta productos a CSV                  |
| GET    | `/export/orders`      | Exporta pedidos a CSV                    |

---

## 📂 Estructura relevante

- `/app/Http/Controllers/AuthController.php` – Login hardcodeado.
- `/app/Http/Controllers/WooController.php` – Controlador principal.
- `/app/Services/WooCommerceService.php` – Cliente API WooCommerce.
- `/resources/views` – Vistas Blade (login, dashboard, listados).
- `/database/database.sqlite` – BD SQLite creada.

---

## 💡 Posibles mejoras (extras no obligatorios)

- Soporte para **Shopify** además de WooCommerce.
- Métricas agregadas (ventas por mes, productos más vendidos).
- Filtros avanzados por cliente, fecha o estado.
- Sincronización periódica de datos en BD.
- Pruebas unitarias e integración.

---

## 👤 Autor

Desarrollado por **Maikel Noguera**  
GitHub: [@maikelnogueracl](https://github.com/maikelnogueracl)
