# GUIDA LAMINAS-PROJECT

#1) Installazione
Con la Shell entrare nella cartella contenenti i progetti di php
ed eseguire il seguente comando :

```bash
composer create-project -sdev laminas/laminas-mvc-skeleton ilmioportale
```
#2) AGGIUNGERE IL PROGETTO SU GITHUB
Su PhpStorm cliccare su git e share project on gitHUB 

#3) MODIFICARE IL COMPOSER.JSON
Modificare e configurare il Composer.json aggiungendo i repositories degli altri progetti git

```bash
"repositories": [
        {
            "type": "github",
            "url":  "git@github.com:devgiandev/metronic.git"
        }
    ],
    "require": {
       "metronic/metronic": "dev-master"
    },
```
#4) CONFIGURAZIONE COMPOSER-PLUGIN METRONIC
Entrare tramite shell nella directory del progetto metronic ed eseguire il seguente comando: 
```bash
composer init
```
E configurare il composer.json in questo modo: 
```bash
{
    "name": "metronic/metronic",
    "description": "theme",
    "type": "library",
    "license": "Gianluca Tuono",
    "authors": [
        {
            "name": "devgiandev",
            "email": "devgiandev@gmail.com"
        }
    ],
    "require": {}
}

```
#5) VERIFICARE DI AVERE INSTALLATO LE SEGUENTI DIPENDENZE
Entrare nella  cartella metronic/metronic/theme/tools e eseguire il seguente comando:
```bash
node -v
npm -v
gulp -v
```

#6) INSTALLARE LE LIBRERIE CONTENUTE IN NODE_MODULES
Entrare nella  cartella metronic/metronic/theme/tools e eseguire il seguente comando: 
```bash
npm install
```
#7) MODIFICARE IL GULP.CONFIG.JSON DI CONFIGURAZIONE DEL PATH ASSETS DEI FILE NELLA PUBLIC
Entrare nella  cartella metronic/metronic/theme/tools e aprire il file gulp.config.json modificando la seguente riga:
```bash
"dist": [
            "./../../../../../public/assets"
        ]
```
#8) ESEGUIRE IL CAMANDO PER GENERARE GLI ASSETS DEL TEMA DEMO1
Entrare nella  cartella metronic/metronic/theme/tools eseguire il seguente comando:
```bash
gulp --demo1
```

#9) INSERIRE NELLA PAGINA LAYOUT.PHTML DELLA VIEW I LINK E GLI SCRIPT PER VISUALIZZARE CORRETTAMENTE GLI ASSETS DEL TEMA
Entrare nella pagina layout.phtml della view e sostituire i link stylsheet e glis cript js della pagina con i seguenti: 
```bash
<!-- Le styles -->
        <?= $this->headLink(['rel' => 'shortcut icon', 'type' => 'image/vnd.microsoft.icon', 'href' => $this->basePath() . '/img/favicon.ico'])
            ->prependStylesheet($this->basePath('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css'))
            ->prependStylesheet($this->basePath('assets/plugins/global/plugins.bundle.css'))
            ->prependStylesheet($this->basePath('assets/plugins/custom/prismjs/prismjs.bundle.css'))
            ->prependStylesheet($this->basePath('assets/css/style.bundle.css'))
            ->prependStylesheet($this->basePath('assets/css/themes/layout/header/base/light.css'))
            ->prependStylesheet($this->basePath('assets/css/themes/layout/header/menu/light.css'))
            ->prependStylesheet($this->basePath('assets/css/themes/layout/brand/dark.css'))
            ->prependStylesheet($this->basePath('assets/css/themes/layout/aside/dark.css'))
        ?>
//PRIMA DI CHIUDERE IL BODY
    <?= $this->inlineScript()
        ->prependFile($this->basePath('assets/js/pages/widgets.js'))
        ->prependFile($this->basePath('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js'))
        ->prependFile($this->basePath('assets/js/scripts.bundle.js'))
        ->prependFile($this->basePath('assets/plugins/global/plugins.bundle.js'))
        ->prependFile($this->basePath('assets/plugins/custom/prismjs/prismjs.bundle.js'))
    ?>
```