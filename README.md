# Sistema de Cursos

## Instalación sobre Docker Compose
- Descargas el repositorio con git clone
```
    - git clone https://github.com/gbelot2003/sistemaDeCursos.git sistema
    - cd sistema
```
- Instalaremos el entorno usando el siguiente comando:
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```
- ### Importante!!! copiar .env.examples a .env
 ```
    cp .env.example .env
 ```
 - Utilizamos luego los siguientes comandos para comenzar
```
    $> npm run build.
    $> sail artisan key:generate
    $> sail up -d
```
- La base de datos se encuentra disponible en un hosting gratuito, pueden sentirse unos segundos de latencia, por favor tener paciencia

## Instalación en otras plataformas

- Descargar e instalar git y composer
- Descargas el repositorio con git clone
```
    - git clone https://github.com/gbelot2003/sistemaDeCursos.git sistema
    - cd sistema
```
- ### Importante!!! copiar .env.examples a .env
 ```
    cp .env.example .env
 ```

- utilizar los siguientes comandos para importar las dependencias
```
    $> composer install
    $> npm install

    // Por ultimo
    $> php artisan serve
```


