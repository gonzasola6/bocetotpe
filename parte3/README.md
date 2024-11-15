# Disqueria api

# Trabajo practico especial

## Integrantes:
    * Gonzalo Sola
    * Ariadna Cataldi

## Descripción:

Diseño de la Base de Datos:

La base de datos está diseñada para almacenar un conjunto de elementos, que en este caso son álbumes y autores, con una relación de 1 a N.
El diseño se basa en diferentes discos con sus datos, que se relacionan directamente con los autores y sus respectivos datos.


El modelo de datos incluye dos tablas principales:

* Tabla Álbumes:
Atributos: ID_Album (clave primaria), nombre (nombre del álbum), lanzamiento (fecha de lanzamiento), cantCanciones (cantidad de canciones), genero (género musical), ID_Autor (clave foránea que referencia a la tabla Autores).

* Tabla Autores:
Atributos: ID_Autor (clave primaria), nombre (nombre del autor), pais (país de origen), cantAlbumes (cantidad de álbumes publicados).
La clave foránea ID_Autor en la tabla Álbumes se refiere a la clave primaria ID_Autor en la tabla Autores, estableciendo una relación de 1 a N. Es decir, un autor puede estar asociado a múltiples álbumes, pero cada álbum solo puede estar asociado a un único autor.

Este diseño define las claves primarias y las relaciones entre las entidades, permitiendo modelar los ítems con sus respectivos detalles.

Mediante los ID se puede relacionar los albumes con sus respectivos autores y poder encontrar sus atributos, ya que obtenemos una "clave única", para acceder a los atributos de su respectiva tabla.



## DER

![Diagrama Entidad Relación](/der.png)


##EXPLICACION DE: cómo desplegar el sitio en un servidor con Apache y MySQL
 

Para desplegar el sitio web, se deberá descargar XAMPP, que es un sistema de Software Libre, que gestiona Bases de Datos y nos proporciona un entorno de Servidor Local. Este sistema viene con Apache y MySql incluido, siendo el primero el servidor web, y el segundo, el sistema de gestión de bases de datos. 
Una vez instalado XAMPP, hay que activar ("start") Apache y MySql. Para abrir el proyecto, hay que descargarlo y ubicarlo dentro de la carpeta htdocs. Esta carpeta se encuentra dentro otra carpeta llamada XAMPP, ubicada en el disco C. 
Una vez realizado todo eso, se podrá abrir el proyecto en el entorno que elijamos, y en el navegador predeterminado de la computadora que estemos utilizando. Esto lo vamos a hacer escribiiendo esto en el buscador del nav. : localhost/disqueria
A partir de ahí, ya ingresaremos al proyecto y podremos visualizar toda la información perteneciente a la base de datos. Y a partir del LogIn (US: webadmin PSW: admin) se podrá acceder a la lectura, creación, modificación y eliminación de cada uno de los datos. 
Sin hacer ese LogIn, el usuario no podrá acceder al CRUD del proyecto. 


