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