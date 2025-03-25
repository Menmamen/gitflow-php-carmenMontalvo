# Uso de Git Flow en un Proyecto PHP

Este documento explica los pasos seguidos para completar el ejercicio de Git Flow en un proyecto PHP.

---

## 1: Creación del repositorio y configuración inicial

1. Se crea un repositorio en GitHub con el nombre `gitflow-php-carmenMontalvo`.  
2. Se clona el repositorio en la máquina local:  
   ```bash
   git clone https://github.com/tu_usuario/gitflow-php-carmenMontalvo.git
   cd gitflow-php-carmenMontalvo
3. Se inicializa Git Flow:
    ```bash
    git flow init
    Se aceptan los valores predeterminados.
4. Se crea la rama develop si no existe:
    ```bash
    git checkout -b develop
    git push -u origin develop

## 2: Creación de un archivo PHP
1. Se inicia una nueva funcionalidad en Git Flow:
    ```bash
    git flow feature start crear-mi-archivo
2. Se crea la carpeta alumnos/ y el archivo PHP:
    <?php
    // Archivo: alumnos/carmenMontalvo.php
    echo "Hola, soy Carmen Montalvo y estoy aprendiendo Git Flow!";
    ?>
3. Se agregan y confirman los cambios:
    ```bash
    git add alumnos/carmenMontalvo.php
    git commit -m "Agregar archivo PHP con saludo"
    git push origin feature/crear-mi-archivo
4. Se finaliza la funcionalidad y se fusiona en develop:
    ```bash
    git flow feature finish crear-mi-archivo
    git push origin develop

## 3: Modificación de un archivo existente
1. Se inicia una nueva funcionalidad:
    ```bash
    git flow feature start modificar-index
2. Se edita index.php agregando la línea:
    <?php
    include "alumnos/carmenMontalvo.php";
    ?>
3. Se visualizan los cambios antes de confirmar:
    ```bash
    git diff
4. Se confirman los cambios y se suben:
    ```bash
    git add index.php
    git commit -m "Modificar index.php para incluir mi archivo"
    git push origin feature/modificar-index
5. Se finaliza la funcionalidad y se fusiona en develop:
    ```bash
    git flow feature finish modificar-index
    git push origin develop

## 4: Resolución de conflictos
1. Se modifica index.php en la misma línea que otro compañero.
2. Se intenta fusionar la rama en develop, generando un conflicto:
    ```bash
    git checkout develop
    git merge feature/modificar-index
3. Se muestra el estado del conflicto:
    ```bash
    git status
4. Se edita index.php para resolver manualmente el conflicto y se confirman los cambios:
    ```bash
    git add index.php
    git commit -m "Resolver conflicto en index.php"
    git push origin develop

## 5: Eliminación de un archivo
1. Se inicia una nueva funcionalidad en Git Flow:
    ```bash
    git flow feature start borrar-mi-archivo
2. Se elimina el archivo PHP:
    ```bash
    rm alumnos/carmenMontalvo.php
    git status
3. Se confirman y suben los cambios:
    ```bash
    git add alumnos/carmenMontalvo.php
    git commit -m "Eliminar mi archivo PHP"
    git push origin feature/borrar-mi-archivo
4. Se finaliza la funcionalidad y se fusiona en develop:
    ```bash
    git flow feature finish borrar-mi-archivo
    git push origin develop

## 6: Publicación de la versión final
1. Se crea una nueva release en Git Flow:
    ```bash
    git flow release start v1.0
2. Se finaliza la versión y se fusiona en main:
    ```bash
    git flow release finish v1.0
3. Se crea una etiqueta para la versión:
    ```bash
    git tag -a v1.0 -m "Versión final del proyecto"
    git push --tags