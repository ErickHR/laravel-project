# INICIAR

1. Para este caso se uso MySql, crear una BD
2. Ejecutar el comando 
```
php artisan migrate --seed
```
# Se tiene dos usuarios por el momento

- admin@example.com password
- student@example.com password

# NOTA

Al loguearse te genera la cookie y tambien el token, se puede usar las otras rutas sin necesidad del token

Si se quiere usar el token se debe agregar en el header 
Accept:application/json
Authorization: Bearer {{token}}

para usar las apis primero ejecutar /sanctum/csrf-cookie ( sanctum ),luego login
