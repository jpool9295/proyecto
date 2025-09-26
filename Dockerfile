# Usamos Nginx como servidor web
FROM nginx:alpine

# Copiamos el código de la tienda dentro del contenedor
COPY ./frontend /usr/share/nginx/html

# Exponemos el puerto 80
EXPOSE 80