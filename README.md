# 🥩 MyksService - Sistema de Inventario y Gestión para Carnicería

![CakePHP](https://img.shields.io/badge/CakePHP-4.x-blue?logo=cakephp&style=flat-square)
![Build Status](https://img.shields.io/github/workflow/status/cakephp/app/CI?style=flat-square)
![License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)
![PHPStan](https://img.shields.io/badge/PHPStan-level%207-brightgreen.svg?style=flat-square)

MVP enfocado en plataforma web para la gestión de inventario, ventas, usuarios y cierre de caja en carnicerías, desarrollado con [CakePHP](https://cakephp.org) 4.x.

**Puntos técnicos destacados:**
* **Lógica Financiera:** Módulo dedicado al "Cierre de Caja", gestionando importes, entradas y salidas de dinero.
* **Control de Inventario:** Gestión dinámica de productos, categorías y actualización de stock tras ventas o pedidos.
* **RBAC (Role-Based Access Control):** Sistema de permisos granular para Administradores, Empleados y Distribuidores.
* **Gestión de Pedidos:** Flujo completo desde la solicitud del cliente hasta la entrega y facturación.

**Link de Figma**
* Aqui podra visualizar algunas vistas del proyecto.

https://www.figma.com/design/Dti4Ee9PyhIW5jafcanHET/Modelado-Interfaz-MKS?t=ieogG9x0SPu5T4gz-1

---

## 🚀 Funcionalidades principales

- 📦 Gestión de productos e inventario.
- 🧾 Registro y seguimiento de pedidos.
- 👥 Administración de clientes, empleados y distribuidores.
- 🗃️ Cierre de caja y control de importes.
- 🛡️ Gestión de roles y permisos de usuarios.
- 📊 Dashboard administrativo y reportes.
- 🔔 Alertas y notificaciones.
- 🔒 Autenticación y seguridad.
- 📧 Envío de correos electrónicos.

---

## 🗂️ Estructura del proyecto

```
MyksService/
├── src/
│   ├── Controller/      # Lógica de negocio y endpoints
│   ├── Model/           # Entidades, tablas y comportamientos
│   ├── View/            # Vistas y helpers
│   └── Console/         # Scripts CLI
├── templates/           # Vistas y layouts
├── config/              # Configuración y rutas
├── tests/               # Pruebas unitarias y fixtures
├── webroot/             # Archivos públicos (CSS, JS, imágenes)
├── bin/                 # Scripts CLI
├── logs/                # Logs de la aplicación
├── resources/           # Recursos adicionales
└── README.md            # Este archivo
```

---

## 🏗️ Estructura y resumen de componentes principales

### Controllers (`src/Controller/`)
- **AppController.php**  
  Controlador base, gestiona lógica común (autenticación, helpers, componentes).
- **ErrorController.php**  
  Maneja páginas de error personalizadas.
- **CategoriasController.php**  
  CRUD de categorías de productos.
- **CierrecajasController.php**  
  Registro y gestión de cierres de caja diarios.
- **ClientesController.php**  
  Administración de clientes: alta, edición, búsqueda y visualización.
- **DistribuidoresController.php**  
  Gestión de distribuidores y proveedores.
- **EmpleadosController.php**  
  Gestión de empleados y sus permisos.
- **ImportesController.php**  
  Control y registro de importes relacionados con ventas y caja.
- **PagesController.php**  
  Renderiza páginas estáticas y dashboard.
- **PedidosController.php**  
  Registro y seguimiento de pedidos de clientes.
- **ProductosController.php**  
  Gestión de productos e inventario.
- **RolesController.php**  
  Administración de roles y permisos de usuarios.
- **UsersController.php**  
  Gestión de usuarios: registro, edición, login, historial y ajustes.

### Models (`src/Model/`)
- **Entity/**  
  Define las entidades principales: Producto, Cliente, Empleado, Pedido, etc.
- **Table/**  
  Lógica de acceso a datos y reglas de validación para cada entidad (ej: ProductosTable, PedidosTable).
- **Behavior/**  
  Comportamientos reutilizables (timestamps, validaciones).

### Vistas (`templates/`)
- **Categorias/**  
  Vistas para listar, agregar, editar y ver categorías.
- **Cierrecajas/**  
  Vistas para cierres de caja: registro, edición, historial.
- **Clientes/**  
  Vistas para clientes: alta, edición, búsqueda, historial.
- **Distribuidores/**  
  Vistas para distribuidores: alta, edición, listado.
- **Empleados/**  
  Vistas para empleados: alta, edición, permisos.
- **Importes/**  
  Vistas para importes y movimientos de caja.
- **Pedidos/**  
  Vistas para pedidos: registro, seguimiento, historial.
- **Productos/**  
  Vistas para productos: alta, edición, inventario.
- **Roles/**  
  Vistas para roles y permisos.
- **Users/**  
  Vistas para usuarios: login, registro, ajustes.
- **Pages/**  
  Vistas estáticas y dashboard.
- **layout/**  
  Layouts generales, login, error, alertas.

---

## ⚙️ Instalación

1. **Requisitos previos**
   - PHP >= 7.4
   - Composer
   - Base de datos MySQL o compatible

2. **Instalación**
   ```bash
   git clone https://github.com/tuusuario/MyksService.git
   cd MyksService
   composer install
   ```

3. **Configuración**
   - Copia `config/app_local.example.php` a `config/app_local.php` y ajusta tus credenciales de BD.
   - Opcional: copia `.env.example` a `.env` y configura variables de entorno.

4. **Migraciones**
   - Importa los archivos SQL de `config/schema/` en tu base de datos.

5. **Servidor de desarrollo**
   ```bash
   bin/cake server -p 8765
   ```
   Accede a [http://localhost:8765](http://localhost:8765)

---

## 🧑‍💻 Uso

- Accede con tus credenciales de usuario.
- Navega por el dashboard para gestionar productos, pedidos, clientes, empleados y cierres de caja.
- Utiliza los formularios para registrar ventas, editar inventario, realizar cierres de caja y administrar usuarios.
- Visualiza reportes y el historial de movimientos.

---

## 🛡️ Seguridad

- Autenticación de usuarios y roles.
- Protección CSRF y validaciones.
- Manejo de errores personalizado.

---

## 🧪 Pruebas

Ejecuta las pruebas unitarias con PHPUnit:

```bash
vendor/bin/phpunit
```

---

## 📚 Documentación y soporte

- [Documentación CakePHP](https://book.cakephp.org/4/en/)
- [API CakePHP](https://api.cakephp.org/)
- [Foro CakePHP](https://discourse.cakephp.org/)
- [Slack CakePHP](https://slack-invite.cakephp.org/)

---

## 📝 Licencia

Este proyecto está bajo licencia MIT.

---

## ✨ Créditos

Desarrollado con [CakePHP](https://cakephp.org) por tu equipo.

---

## 📦 Dependencias principales

- CakePHP 4.x
- DebugKit
- Bake
- Migrations

---

## 📌 Notas

- Personaliza los layouts en `templates/layout/`.
- Los controladores principales están en [`src/Controller/`](src/Controller/).
- Los modelos y entidades en [`src/Model/`](src/Model/).
- Las vistas en [`templates/`](templates/).

---

¡Gracias por usar MyksService! 🥩
