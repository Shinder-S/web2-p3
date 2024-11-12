- Sistema de Gestión de Hospital

Este proyecto es un sistema de gestión de datos hospitalarios que permite la administración de citas, pacientes, profesionales, y usuarios. Está desarrollado en PHP y utiliza una base de datos MySQL para almacenar la información.

Integrantes:

- Micaela Zuzulich 37237155
- Santiago Shinder 36786244


http://localhost/WEB-2ApiRestful/api/professionals


- Características del Proyecto 

        Gestión de Profesionales: CRUD de profesionales médicos, con opción de filtrado por año de incorporación.

- Estructura del Proyecto
        
        Database.php: Clase para la conexión a la base de datos.
        Router.php: Archivo de enrutamiento que permite definir y gestionar rutas para la API.
        ProfesionalesController.php: Controlador que maneja las operaciones CRUD de los profesionales.
        APIView.php: Clase que gestiona las respuestas en formato JSON.

## Rutas de la API

Profesionales

    GET /professionals - Muestra todos los profesionales.
    GET /professionals/:ID - Muestra un profesional por ID.
    POST /professionals - Agrega un nuevo profesional.
    DELETE /professionals/:ID - Elimina un profesional por ID.
    PUT /professionals/:ID - Actualiza un profesional por ID.
    GET /professionals/filter/:year - Filtra profesionales por año de incorporación.

Ejemplo de uso

# Obtener todos los profesionales (GET /professionals):

curl -X GET http://localhost/hospital_api/professionals

# Obtener un profesional por ID (GET /professionals/:ID):

curl -X GET http://localhost/hospital_api/professionals/1

# Agregar un nuevo profesional (POST /professionals):

curl -X POST -H "Content-Type: application/json" \
-d '{"name":"Carlos", "last_name":"Gómez", "specialty":"Cardiología", "incorporation":"2023-05-01"}' \
http://localhost/hospital_api/professionals

# Eliminar un profesional por ID (DELETE /professionals/:ID):

curl -X DELETE http://localhost/hospital_api/professionals

# Actualizar un profesional por ID (PUT /professionals/:ID):

curl -X PUT -H "Content-Type: application/json" \
-d '{"name":"Carlos", "last_name":"Gómez", "specialty":"Cardiología", "incorporation":"2023-05-01"}' \
http://localhost/hospital_api/professionals/1


# Filtrar profesionales por año de incorporación (GET /professionals/filter/:year):#

curl -X GET http://localhost/hospital_api/professionals/filter/2023


- Consideraciones

Este proyecto se realizó como parte de un ejercicio de desarrollo de una API REST en PHP, por lo cual es ideal para entornos de desarrollo o pruebas y no está optimizado para entornos de producción.