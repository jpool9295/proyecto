# 🛍️ Tienda Urbana - Base de Datos

Este proyecto utiliza **MySQL 8.0** como sistema gestor de base de datos, configurado dentro de un entorno **Docker Compose**.  
La base de datos principal se llama **`mi_data`** y almacena la información de los usuarios registrados en la plataforma.

---

## 🧱 Estructura de la Base de Datos

### 🧩 Tabla: `usuarios`

Contiene los datos personales y credenciales de los usuarios registrados en la tienda.

| Campo             | Tipo de Dato      | Descripción |
|------------------|------------------|--------------|
| `id_usuario`     | INT (PK, AUTO_INCREMENT) | Identificador único del usuario |
| `nombre`         | VARCHAR(100)     | Nombre del usuario |
| `apellido`       | VARCHAR(100)     | Apellido del usuario |
| `correo`         | VARCHAR(100), UNIQUE | Correo electrónico del usuario |
| `usuario`        | VARCHAR(100), UNIQUE | Nombre de usuario usado para login |
| `password`       | VARCHAR(255)     | Contraseña encriptada con `password_hash()` |
| `dni`            | VARCHAR(20)      | Documento Nacional de Identidad |
| `fecha_nacimiento` | DATE            | Fecha de nacimiento del usuario |
| `fecha_registro` | TIMESTAMP (DEFAULT CURRENT_TIMESTAMP) | Fecha y hora de creación del registro |

---

## 🧩 Relaciones
Actualmente no hay relaciones con otras tablas,  
pero se pueden agregar tablas futuras como:
- `productos`
- `pedidos`
- `carrito`
- `pagos`

---

## ⚙️ Configuración en Docker

El servicio de base de datos se configura dentro de **`docker-compose.yml`** con el siguiente bloque:

```yaml
db:
  image: mysql:8.0
  container_name: mysql-db-1
  restart: always
  environment:
    MYSQL_ROOT_PASSWORD: root123
    MYSQL_DATABASE: mi_data
    MYSQL_USER: tienda_user
    MYSQL_PASSWORD: tienda123
  ports:
    - "3307:3306"
  volumes:
    - db_data:/var/lib/mysql