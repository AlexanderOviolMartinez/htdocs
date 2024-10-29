# M295
- MD - Dateien Vorschau: Ctrl + Shift + V
- Erweiterung zum mermaid anzeigen: Markdown Preview Mermaid Support von Matt Bierner

## Links zum Aufrufen
- Seite öffnen: http://M295.tag4.local
- http://M295.tag4.local/cars/getData/4

## composer
```shell
    composer install
```

## Diagramm
```mermaid
graph TD;
    A[FC - public/index.php] --> B[Routing];
    B --> C[C - app/cars/cars.php];
    C --> D[M - app/cars/model.php];
    D --> E[lib/database.php];

    C -->|Instanz| D;
    D -->|erbt| E;
```