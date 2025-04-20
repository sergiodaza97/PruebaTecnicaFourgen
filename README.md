# API RESTful - Gestión de Personas y Mascotas 🐶👤

Este proyecto es una API RESTful desarrollada con Laravel (> v8) que permite gestionar personas y sus mascotas. La autenticación se maneja mediante JWT y se incluye una integración con una API externa para enriquecer la información de las mascotas.

## 🚀 Características Principales

- Autenticación de usuarios con JWT
- CRUD completo para personas y mascotas
- Relación de uno a muchos (una persona puede tener muchas mascotas)
- Consulta avanzada: Obtener una persona con todas sus mascotas
- Integración con una API externa para completar información de mascotas (raza, imagen, etc.)
- Validaciones con Form Requests
- Respuestas estructuradas con Laravel API Resources
- Arquitectura limpia basada en controladores, servicios, repositorios y validadores

## 🧪 Extras Implementados

- Paginación en listados
- Logs personalizados
- Uso de Policies para control de acceso
- Documentación automática de la API con Swagger

---

## 🛠️ Requisitos Técnicos

- PHP >= 7.4
- Laravel >= 8.x
- MySQL
- Composer
- Postman o similar (para pruebas de endpoints)

---

## ⚙️ Instalación del Proyecto

1. Clona el repositorio:
   ```bash
   git clone https://github.com/sergiodaza97/PruebaTecnicaFourgen.git
2. Accede al directorio del proyecto:
   cd PruebaTecnicaFourgen
3. Instala las dependencias:
   composer install
4. Copia el archivo de entorno y configúralo:
   de .env.example a .env
5. Corre Comando de creacion clave jwt
   php artisan jwt:secret
6. Crea la base de datos en tu sistema (MySQL)
7. Genera la clave de aplicación:
   php artisan key:generate
8. Ejecuta migraciones y seeders:
   php artisan migrate --seed

## Coleccion de Postman

Puedes importar la colección de Postman para probar los endpoints de la API.
- [API Fourgen.postman_collection.zip](https://github.com/user-attachments/files/19824249/API.Fourgen.postman_collection.zip)

## Usuario de Prueba

Para acceder a los endpoints protegidos por JWT puedes usar el siguiente usuario creado por los seeders:
- Email: sergioandres.daza.1103@gmail.com
- Contraseña: 12345678
