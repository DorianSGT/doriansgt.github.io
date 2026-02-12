# PostgreSQL: Gestión de Información de Equitación en la la DB EquitacionSuave

# Índice:

* [1. Instalación de PostgreSQL en Linux](#1-instalación-de-postgresql-en-linux)
    * [1.1 Actualización de repositorios e instalación](#1-actualiza-los-repositorios-del-sistema-e-instala-postgresql)
    * [1.2 Inicio y configuración del servicio](#2-inicia-el-servicio-de-postgresql-y-configura-el-servicio)
    * [1.3 Acceso a la consola de PostgreSQL](#3-cambia-al-usuario-postgres-y-abre-la-consola-de-postgresql)
* [2. Creación de la Base de Datos y Tablas](#2-creación-de-la-base-de-datos-y-tablas)
    * [Paso 1: Crear la base de datos](#paso-1-crear-la-base-de-datos)
    * [Paso 2: Crear las tablas principales (Jinetes y Caballos)](#paso-2-crear-las-tablas-principales)
* [3. Gestión de Usuarios y Roles](#3-gestión-de-usuarios-y-roles)
    * [Ejercicio 1: Crear usuarios con distintos niveles de permisos](#ejercicio-1-crear-usuarios-con-distintos-niveles-de-permisos)
    * [Ejercicio 2: Asignar permisos](#ejercicio-2-asignar-permisos)
* [4. Inserción de Datos en las Tablas](#4-inserción-de-datos-en-las-tablas)
    * [Inserción en tabla Jinetes](#1-inserta-varios-registros-en-la-tabla-jinetes-con-diferentes-valores-de-nombres-apellidos-categorías-y-años-de-experiencia)
    * [Inserción en tabla Caballos](#2-inserta-varios-registros-en-la-tabla-caballos-especificando-el-nombre-raza-edad-y-el-jinete_id-correspondiente)
* [5. Consultas de Datos](#5-consultas-de-datos)
    * [Consultar todos los jinetes](#1-realiza-una-consulta-para-obtener-todos-los-registros-de-la-tabla-jinetes)
    * [Filtrar por experiencia](#2-realiza-una-consulta-que-muestre-solo-los-jinetes-con-más-de-dos-años-de-experiencia)
    * [Join: Caballos y Jinetes](#3-realiza-una-consulta-para-obtener-los-nombres-de-los-caballos-junto-con-los-nombres-de-sus-respectivos-jinetes)
* [6. Actualización y Eliminación de Datos](#6-actualización-y-eliminación-de-datos)
    * [Actualizar (UPDATE)](#1-realiza-una-actualización-en-la-tabla-jinetes-para-cambiar-la-categoría-de-un-jinete)
    * [Eliminar (DELETE)](#2-realiza-una-eliminación-en-la-tabla-jinetes-para-borrar-un-registro-específico)
* [7. Uso de pgAdmin para Administración Visual](#7-uso-de-pgadmin-para-administración-visual)
    * [Paso 1: Acceso y conexión al servidor](#paso-1-acceso-a-pgadmin-y-conexión-al-servidor-postgresql)
    * [Paso 2: Crear la BBDD EquitacionSuave](#paso-2-crear-la-base-de-datos-equitacionsuave)
    * [Paso 3: Crear tablas gráficamente](#paso-3-crear-las-tablas-jinetes-y-caballos)
    * [Paso 4: Insertar y consultar con Query Tool](#paso-4-insertar-y-consultar-datos)
    * [Paso 5: Usuarios y Roles en pgAdmin](#paso-5-crear-y-administrar-usuarios-y-roles-en-pgadmin)
* [8. Características Avanzadas de PostgreSQL](#8-características-avanzadas-de-postgresql)
    * [Ejercicio 1: Uso de JSON](#ejercicio-1-uso-de-json-en-la-tabla-jinetes)
    * [Ejercicio 2: Uso de Arreglos (ARRAYS)](#ejercicio-2-uso-de-arreglos-arrays-para-certificaciones)
    * [Ejercicio 3: Vistas Materializadas](#ejercicio-3-creación-de-vistas-materializadas)
    * [Ejercicio 4: Herencia en Tablas](#ejercicio-4-herencia-en-tablas-para-gestionar-equipos-de-equitación)

## 1. Instalación de PostgreSQL en Linux 

### 1. Actualiza los repositorios del sistema e instala PostgreSQL. 

![Actualiz](img/postgres.png)

### 2. Inicia el servicio de PostgreSQL y configura el servicio.

![p2](img/postgres2.png)

### 3. Cambia al usuario postgres y abre la consola de PostgreSQL

![p3](img/postgres3.png)

## 2. Creación de la Base de Datos y Tablas 

### Paso 1: Crear la base de datos 

![Paso1](img/p4.png)

### Paso 2: Crear las tablas principales 

#### Tabla jinetes 

![Jinetes](img/jinetes.png)

#### Tabla caballos

![Caballos](img/caballos.png)
![Caballos2](img/caballos2.png)

## 3. Gestión de Usuarios y Roles 

### Ejercicio 1: Crear usuarios con distintos niveles de permisos 

#### 1. Crea un usuario admin_equitacion con permisos para iniciar sesión en PostgreSQL y con la capacidad de crear bases de datos

![Admin](img/admin.png)

#### 2. Crea un usuario user_consultas que solo pueda realizar consultas en la base de datos 

![consultas](img/usrconsultas.png)

#### 3. Crea un usuario user_lectura que pueda ver datos en la base de datos pero no  modificarlos. 

![lectura](img/usrlectura.png)

### Ejercicio 2: Asignar permisos 

#### 1. Conéctate a la base de datos EquitacionSuave.

![conectar](img/conectarbbdd.png)

#### 2. Asigna permisos de consulta (SELECT) a user_consultas en las tablas jinetes y caballos

![permCosnultas](img/permconsultas.png)

#### 3. Configura permisos para user_lectura para que solo pueda ver datos y no modificarlos en ambas tablas 

![permLectura](img/permlectura.png)

#### 4. Da permisos completos (SELECT, INSERT, UPDATE, DELETE) al usuario admin_equitacion en las tablas jinetes y caballos.

![permAdmin](img/permadmin.png)

## 4. Inserción de Datos en las Tablas 

#### 1. Inserta varios registros en la tabla jinetes con diferentes valores de nombres, apellidos, categorías y años de experiencia. 

![InsertJinetes](img/insertJinetes.png)

#### 2. Inserta varios registros en la tabla caballos, especificando el nombre, raza, edad, y el jinete_id correspondiente.

![InsertCaballos](img/insertCaballos.png)

## 5. Consultas de Datos 

#### 1. Realiza una consulta para obtener todos los registros de la tabla jinetes.

![Consulta1](img/consulta1.png)

#### 2. Realiza una consulta que muestre solo los jinetes con más de dos años de experiencia. 

![Consulta2](img/consulta2.png)

#### 3. Realiza una consulta para obtener los nombres de los caballos junto con los nombres de sus respectivos jinetes.

![Consulta3](img/consulta3.png)


## 6. Actualización y Eliminación de Datos 

#### 1. Realiza una actualización en la tabla jinetes para cambiar la categoría de un jinete.

![Update](img/update1.png)

#### 2. Realiza una eliminación en la tabla jinetes para borrar un registro específico.

![Delete](img/delete.png)


## 7. Uso de pgAdmin para Administración Visual

### Paso 1: Acceso a pgAdmin y conexión al servidor PostgreSQL 

#### 1. Abre pgAdmin y conéctate al servidor PostgreSQL usando las credenciales de postgres. 

![pgadmin](img/pgadmin1.png)
![pgadmin](img/pgadmin2.png)

#### 2. Verifica la conexión y accede a la lista de bases de datos. 

![conexion](img/pdadmin3.png)

### Paso 2: Crear la base de datos EquitacionSuave

#### 1. En pgAdmin, crea la base de datos EquitacionSuave con postgres como propietario. 

![crearBBDD](img/crearbbddpgadmin.png)

### Paso 3: Crear las tablas jinetes y caballos 

#### 1. En la sección Schemas > public > Tables de pgAdmin, crea la tabla jinetes con los campos mencionados en el paso 2.

![Jinetes](img/pgadminJinetes.png)

#### 2. Crea también la tabla caballos con los campos requeridos y la referencia a la tabla jinetes. 

![Caballos1](img/pgadmincaballos.png)
![Caballos2](img/pgadmincaballosfk.png)

### Paso 4: Insertar y consultar datos 

#### 1. Utiliza la herramienta de consulta (Query Tool) de pgAdmin para insertar y consultar datos en ambas tablas.

![Consulta](img/consultapgadmin.png)

### Paso 5: Crear y administrar usuarios y roles en pgAdmin 

#### 1. En Login/Group Roles de pgAdmin, crea los usuarios admin_equitacion,user_consultas y user_lectura.

**admin_equitacion**

![admin1](img/pgadmin-crearadmin1.png)
![admin1](img/pgadmin-crearadmin2.png)

**user_consultas**

![consultas1](img/pgadmin-crearuserconsultas.png)
![consultas2](img/pgadmin-crearuserconsultas2.png)

**user_lectura**

![lectura](img/pgadmin-userlectura.png)
![lectura](img/pgadmin-userlectura2.png)

#### 2. Asigna los permisos correspondientes a cada usuario en las tablas jinetes y caballos usando la interfaz gráfica de pgAdmin. 

**Tabla jinetes**
![adminjinetes](img/privilegiosusradmin.png)
![consultasjinetes](img/privilegiosusrconsultas.png)
![lecturajinetes](img/privilegiosusrlectura.png)

**Tabla caballos**
![admincaballos](img/privilegiosadmincaballos.png)
![consultascaballos](img/privilegiosconsultacaballos.png)
![lecturacaballos](img/privilegioslecturacaballos.png)

## 8. Características Avanzadas de PostgreSQL 

### Ejercicio 1: Uso de JSON en la tabla jinetes

#### 1. Añade una columna llamada detalles_competencias de tipo JSON en la tabla jinetes.

![columnaJSON](img/crearjson.png)

#### 2. Inserta un nuevo registro en la tabla jinetes y jinetes y utiliza la columna detalles_competencias para almacenar datos en formato JSON que incluyan las competencias y el número de victorias del jinete. 

![NuevoRegistro](img/insertjson.png)

### Ejercicio 2: Uso de arreglos (ARRAYS) para certificaciones 

#### 1. Añade una columna certificaciones de tipo ARRAY en la tabla jinetes. 

![columnarray](img/certificaciones1.png)

#### 2. Actualiza uno de los registros en jinetes para almacenar múltiples certificaciones en la columna certificaciones. 

![certficaciones](img/certificaciones2.png)

### Ejercicio 3: Creación de Vistas Materializadas 

#### 1. Crea una vista materializada llamada vista_jinetes_avanzados que contenga los registros de jinetes cuya categoría sea Avanzado.

![vista1](img/vistamaterializada1.png)
![vista2](img/vistamaterializada2.png)

#### 2. Realiza una operación para actualizar los datos de la vista materializada. 

![vista3](img/actualizardatosvistamaterializada.png)

### Ejercicio 4: Herencia en Tablas para gestionar equipos de equitación 

#### 1. Crea una tabla base llamada equipo_base con los campos id, nombre y tipo. 

![herencia1](img/herencia1.png)
![herencia2](img/herencia2.png)

#### 2. Crea una tabla heredada llamada equipo_de_salto que extienda equipo_base y añada un campo altura_maxima para especificar la altura máxima permitida del equipo. 

![herencia3](img/herencia3.png)
![herncia4](img/herencia4.png)

#### 3. Inserta un registro en la tabla equipo_de_salto. 

![herencia5](img/herencia5.png)
![herencia6](img/herencia6.png)



