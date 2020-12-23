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
Modificare e configurare il Composer.json aggiungendo i repositories degli altri progetti git privati

```bash
"repositories": [
        {
            "type": "git",
            "url":  "git@github.com:devgiandev/metronic.git"
        }
    ],
    "require": {
        "vendor/metronic": "dev-master"
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
    "name": "vendor/metronic",
    "description": "metronic theme build",
    "type": "composer-plugin",
    "license": "gianluca tuono",
    "authors": [
        {
            "name": "devgiandev",
            "email": "devgiandev@gmail.com"
        }
    ],
    "require": {}
}
```