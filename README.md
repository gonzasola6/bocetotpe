# Disqueria api

# Trabajo practico especial

## Integrantes:
    * Gonzalo Sola
    * Ariadna Cataldi

## Descripción

En este proyecto se desarrolla una API para administrar los autores de los álbumes de la disqueria, con la posibilidad de listar todos los autores, un autor en específico, agregar, editar o eliminar autores, etc. (CRUD)



## Documentación de la API

### Endpoints 
|       Request         | Método |      Endpoint        | Status Success |  Status Error    |
|-----------------------|--------|----------------------|----------------|------------------|
| Listar autores        |  GET   | /api/autores         |       200      |  404             |
| Obtener autor         |  GET   | /api/autores/:id     |       200      |  400/404         |
| Agregar autor         |  POST  | /api/autores         |       201      |  400/401/404/500 |
| Editar autor          |  PUT   | /api/autores/:id     |       201      |  400/401/404     |
| Obtener token         |  GET   | /api/usuarios/token  |       200      |  400             |

---

### Listar autores (GET)

Esta endpoint permite obtener una lista de los autores de los álbumes de la disqueria, con opciones para filtrar, ordenar y paginar los resultados.

```http
GET /api/autores
```

**Filtrado**:  
Se pueden filtrar los resultados por cualquiera de los campos `nombre`,`pais`, `cantAlbumes`. En el parámetro `filterBy` se debe escribir el campo y en `value` el valor a buscar.

***Ejemplo de filtrado***:  
Obtiene todos los autores que el pais sea Argentina:
```http
GET /api/autores?filterBy=pais&value=argentina
 ```

**Orden**:  
Se pueden ordenar los resultados por cualquiera de los campos `nombre`, `pais`, `cantAlbum` de forma ascendente (`ASC`) o descendente (`DESC)`. Si no se pone el parámetro `orderBy` se devuelve la lista de autores ordenados por id. En caso de no poner 'ASC' o 'DESC' en el parámetro `order` la lista se ordenará en orden ascendente. 
  
***Ejemplo de ordenamiento***:  
Obtiene todos los autores, ordenados por precio en orden descendente:
  ```http
  GET /api/autores?orderBy=cantAlbumes&order=DESC
  ```


**Paginación**:  
Se puede limitar la cantidad de resultados por página a un número específico, además de seleccionar la página deseada. En el parámetro `page` se debe especificar la página deseada y en `limit` el límite máximo de elementos por página.

**Ejemplo de paginación**:  
Obtiene los autores de la página 1 con límite a 4 autores por página:
```http
GET /api/autores?page=1&limit=4
```

---

### Obtener Autor (GET)

Devuelve un Autor específico mediante su `id`.

```http
GET /api/autores/:id
```
**Ejemplo de request**:
Obtiene el autor con el `Id_Autor`: 2;
```http
GET /api/autores/2
```

---

### Agregar un Autor (POST)

* Requiere autenticación del usuario.

Inserta un nuevo autor con los valores de los campos enviados en el cuerpo de la solicitud en formato JSON. 

```http
POST /api/autores
```

**Ejemplo de body de request**:


```json
{
    "nombre": "Mala Fama",
    "pais": "Argentina",
    "cantAlbumes": "2"
}
```


### Editar un autor (PUT)
* Requiere autenticación del usuario.

Modifica un autor segun el id con la información enviada para los campos en el cuerpo de la solicitud en formato JSON.
```http
PUT /api/autores/:id
```

**Ejemplo de request**:
```http
PUT /api/autores/12
```
**body**:
```json
{
    "nombre": "Marcelo Ju",
    "pais": "Colombia",
    "cantAlbumes": "7"
  }
```

---

### Eliminar un Autor (DELETE)
* Requiere autenticación del usuario.

Elimina un autor específico mediante su `id`.
```http
DELETE /api/autores/:id
```

**Ejemplo de request**:
```http
DELETE /api/autores/2
```

---

### Autenticar (GET)

Para acceder a ciertas funcionalidades, se debe autenticar utilizando un token.
```http
GET /api/usuarios/token
```

**Credenciales Basic Auth**

- **Nombre de usuario:** `webadmin`
- **Password:** `admin`

Se devolverá un token que puede ser utilizado para la autenticación de futuras solicitudes a la API (POST, PUT o DELETE).

Para poder autenticarse, se debe acceder al endpoint de mencionado en autenticar, usando en los Auth Basic las credenciales, lo que nos devolvera el Token a utilizar para hacer alguna acción, se debe copiar.
Luego para agergar por ejemplo, a la hora de poner "Send", en los Headers se debe poner "Authorization" en la primer casilla, y luego "Bearer *token*" en la segunda. Esto verificara la autenticación y dejará ejecutar la acción.
Por ejemplo:

* Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI...



----API-RESTfull----

La API RestFull, permite que distintos sistemas puedan interaccionar entre sí, esto se da a través de la aquitectura cliente-servidor, donde se utiliza la transmisión de información mediante el protocolo HTTP. 
Desarrollamos una API con la misma base de datos que veníamos trabajando, para que de esta manera, se pueda utilizar para conectarse e interaccionar con otro sistema. 
A la API no le hicimos una implementacion de vista, ya que no era necesaria para lo que se pedía. Solo incluimos dentro de la vista, los posibles errores que pueden ocurrir y haciendo que los datos, se expresen en formato JSON (que es el formato de respuesta que debe tener la API). 
Para probar esta, lo hicimos mediante Thunder Client. Probando los distintos tipos de solucitudes GET, POST, PUT Y DELETE. Esto hacía que podamos mostrar, agregar, modificar y eliminar datos de la base.
Agregamos autenticaciones, e implementamos los queryparams que se pueden utilizar.




