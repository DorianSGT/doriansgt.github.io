# MONGO DB 

## Instalación de Docker la última versión Mongo DB oficial y levantar el contendor.

```
docker run -d \
  --name no-soy-un-mongo \
  -p 27017:27017 \
  -e MONGO_INITDB_ROOT_USERNAME=admin \
  -e MONGO_INITDB_ROOT_PASSWORD=admin123 \
  -v ~/mongo_data:/data/db \
  mongo
```

```
mongosh -u admin -p admin123 --authenticationDatabase admin
```

![Docker](img/contenedor.png)

## Mongo DB (Modelo NoSQL)

> ### 1. Modelo de datos basado en documentos
> Almacena la información en formato BSON (Binary JSON), permitiendo estructuras flexibles y anidadas (arrays y objetos dentro de otros). A diferencia de las filas rígidas de SQL, los documentos mapean directamente a los objetos del código, facilitando el desarrollo.

> ### 2. NoSQL
>Categoría de bases de datos que rompe con el modelo relacional tabular SQL y las transacciones ACID rígidas. Prioriza la flexibilidad del esquema, la velocidad de iteración y el rendimiento en grandes volúmenes de datos distribuidos.

> ### 3. Escalabilidad horizontal
>Capacidad de aumentar el rendimiento añadiendo más servidores estándar para distribuir los datos y la carga . Es la alternativa eficiente en costes frente a la escalabilidad vertical como comprar un solo servidor superpotente.

> ### 4. Consultas
>Utiliza una sintaxis expresiva basada en JSON para realizar búsquedas ad-hoc. Permite filtrar por cualquier campo , realizar proyecciones y ordenamientos sin la complejidad de las uniones (JOINs) tradicionales.

> ### 5. Alta disponibilidad
> Se logra mediante "Replica Sets", donde los datos se copian automáticamente en varios nodos. Si el nodo principal cae, el sistema elige automáticamente uno nuevo para minimizar el tiempo de inactividad del servicio.

> ### 6. Índices
> Estructuras de datos que ordenan campos específicos para acelerar drásticamente las lecturas, evitando el escaneo completo de la colección. Su desventaja es que consumen RAM y ralentizan ligeramente las escrituras.

> ### 7. Agregaciones
> Es el equivalente al GROUP BY y las funciones de suma/promedio de SQL, pero mucho más potente. Funciona como una tubería en la que los datos van pasando por etapas. Permite hacer transformaciones de datos muy complejas paso a paso que en SQL requerirían consultas anidadas masivas.

> ### 8. Resumen 
> Viniendo de trabajar solo con Bases de Datos Relacionales y SQL, lo que me parece más interesante de MongoDB es el cambio sobre la redundancia de datos. En SQL hay que separar todo en tablas para no repetir información, mientras que en mongoDB es agrupar los datos relacionados en un solo documento.

## 0) Esquema de la Base de Datos Relacional de mandarinas

![mandarinas1](img/mandarinas1.png)
![mandarinas2](img/mandarinas2.png)

## 1) Esquema de la Base de Datos Relacional de un comercio

![comercio1](img/comercio1.png)
![comercio2](img/comercio2.png)

## 2) Creación de la Base de Datos mi_comercio y Inserción de Datos

### A. Utilizando la Terminal de mongo DB

#### Crea una base de datos llamada mi_comercio

![CrearDB](img/creardb.png)

#### Crea las colecciones anteriores e Inserta los datos 

He modificado un poco algunos datos como los users y products.

**USERS**

![users](img/users.png)

**PRODUCTS**

![products](img/products.png)

**ORDERS**

![orders](img/orders.png)

**ORDER_PRODUCTS**

![order_product](img/order_product.png)
___
### Consultas

#### 0. Lista todas la colecciones

![consulta0](img/c0.png)

#### 1. Listar todos los usuarios

![consulta1](img/c1.png)

#### 2. Buscar pedidos de un usuario cuyo id sea 1

![consulta2](img/c2.png)

#### 3.  Listar productos con precio mayor a 30

![consulta3](img/c3.png)

#### 4. Buscar pedidos que contengan un producto con id = 2

![consulta4](img/c4.png)

#### 5. Obtener usuarios que hayan realizado pedidos con un total mayor a 40

![consulta5](img/c5.png)

#### 6. Mostrar solo los nombres y correos de los usuarios

![consulta6](img/c6.png)

#### 7. Contar cuántos productos tienen un precio menor o igual a 50

![consulta7](img/c7.png)

#### 8. Encontrar usuarios que hayan pedido un producto llamado "Mouse"

![consulta8](img/C8.png)

#### 9. Agrupar los pedidos por usuario y calcular el total gastado por cada uno

![consulta9](img/c9.png)

#### 10. Listar productos únicos comprados en todos los pedidos

![consulta10](img/c10.png)

### B. Utilizando la interfaz gráfica de MongoDB Compass

**Instalacion de MongoDB Compass**

```
sudo wget https://downloads.mongodb.com/compass/mongodb-compass_1.40.4_amd64.deb

sudo dpkg -i mongodb-compass_1.40.4_amd64.deb

mongodb-compass
```
![MongoCompass](img/mongodb_compass.png)


**Conexión con MongoDB Compass**

```
mongodb://admin:admin123@127.0.0.1:27017/?authSource=admin
```

![ConexionCompass](img/compass1.png)

#### Creacion de la BBDD mi_comercio2

![Compass2](img/compass2.png)
![Compass3](img/compass3.png)
![Compas4](img/compass4.png)

#### Consultas

**0. Lista todas la colecciones**

![c0](img/c0-compass.png)

**1. Listar todos los usuarios**

![c1](img/c1-compass.png)

**2. Buscar pedidos de un usuario cuyo id sea 1**

![c2](img/c2-compass.png)

**3.  Listar productos con precio mayor a 30**

![c3](img/c3-compass.png)

**4. Buscar pedidos que contengan un producto con id = 2**

![c4](img/c4-compass.png)

**5. Obtener usuarios que hayan realizado pedidos con un total mayor a 40**

![c5](img/c5-compass.png)

**6. Mostrar solo los nombres y correos de los usuarios**

![c6](img/c6-compass6.png)

**7. Contar cuántos productos tienen un precio menor o igual a 50**

![c7](img/c7-compass.png)

**8. Encontrar usuarios que hayan pedido un producto llamado "Mouse"**

![c8](img/c8-compass.png)

**9. Agrupar los pedidos por usuario y calcular el total gastado por cada uno**

![c9](img/c9-compass.png)

**10. Listar productos únicos comprados en todos los pedidos**

![c10](img/c10-compass.png)