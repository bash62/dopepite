<h1 align="center"> Compte rendu projet web : Dofus Excel </h1> 
<h2 align="center"> Bachelet Maxime </h2> <br>

<p align="center">
  <a href="https://gitpoint.co/">
    <img alt="GitPoint" title="GitPoint" src="https://i.imgur.com/9qKUNCT.png.png" width="450">
  </a>
</p>

<p align="center">
  <strong>Un outil communotaire pour enregistrer les prix des items et les comparer, fait avec Symfony et VueJS </strong>
</p>

<p align="center">
  <a href="https://dofusexcel.fr/show">
    <img alt="DofusExcel.fr" title="Dofus Excel" src="https://imgur.com/sTNiuXb.png" width="140">
  </a>

</p>

<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->
## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Diagramme BDD](#diagramme-bdd)
- [Outils](#outils)
- [Installation](#installation)


<!-- END doctoc generated TOC please keep comment here to allow auto update -->

## Introduction



Mon projet est un outil qui permet d'enregistrer des informations sur les ressources et les entité pour le jeux Dofus.
On peut enregistrer le prix d'une ressource à l'instant T pour pouvoir calculer si elle peut être rentable.
Le jeux permet de recycler ses ressources contre des pépites, une autre ressource très convoité mais dans un premier temps le rendement est inconnu.( 1 pepite = 200kamas, une plume piou = 0.1 pepite mais une plume = 1,5000k donc ce n'est pas rentable)
Mon outil permet donc d'enregistrer le prix à un instant T et si personnes n'a encore renseigner le coefficient alors il le peux.
Une fois beaucoup de donnèes récolté on peut trouver les ressources les plus rentable.

**Une application  web .**

<p align="center" >
  <img src="https://imgur.com/fB03B8J.png" />
</p>



## Features

Ce que l'on peut faire avec DofusExcel :


* Rechercher une ressource
 <p align="center" >
  <img src="https://imgur.com/600VdT1.png" />
</p>
 <p align="center" >
  <img src="https://imgur.com/8eB5W8Xl.png" />
</p>

* Renseigner une ressource introuvable pour l'utilisateur et ses groupe
 <p align="center" >
  <img src="https://imgur.com/AMnwIgyl.png" />
</p>
 <p align="center" >
  <img src="https://imgur.com/E63ML5Nl.png" />
</p>

* Enregistrer le prix, le coefficient et le bonus de la zone.
 <p align="center" >
  <img src="https://imgur.com/mwoBDbrl.png" />
</p>

* Modifier seulement le prix si vous ou vos amis on déjà modifier le prix d'une ressource.

 <p align="center" >
  <img src="https://imgur.com/nv2PGZNl.png" />
</p>


* Archiver une ressource disparu du jeux
 <p align="center" >
  <img src="https://imgur.com/K6ylzJvl.png" />
</p>

* Accèder à un historique pour annuler ou modifier vos saisis.
 <p align="center" >
  <img src="https://imgur.com/pO67wE2l.png" />
</p>



## Diagramme BDD

Voici mes entitées.

 <p align="center" >
    <a href="https://imgur.com/glH9gjV.png">
    <img src="https://imgur.com/glH9gjV.png" />
    </a>
</p>

Beaucoup ont des méthodes personalisé à l'aide de query builder pour bien intégré les relations.
 <p align="center" >
<a href="https://imgur.com/QCwsmy7.png">
  <img src="https://imgur.com/QCwsmy7.png" />
</a>
<a href="https://imgur.com/pm8oHue.png">
  <img src="https://imgur.com/pm8oHue.png" />
</a>
</p>



<a href="https://imgur.com/EAKDJBU.png">
  <img src="https://imgur.com/EAKDJBU.png" />
</a>

Le plus important étant les ressources du jeux qui est donc nécessaire au projet. Partie la plus longue car il fallait faire beaucoup de recherche.

[![https://imgur.com/dI8dFlK.png](https://imgur.com/dI8dFlK.png)](https://imgur.com/dI8dFlK.png)







## Outils

Mon projet est composé de deux partie.

Le backend est développé avec le Framework Symfony :
* La gestion de la securité
 <p align="center" >
<a href="https://imgur.com/5t31ZII.png">
<a href="https://imgur.com/z4xp7lY.png">
  <img src="https://imgur.com/z4xp7lY.png" />
</a>
</a>
</p>

* API
 <p align="center" >
<a href="https://imgur.com/5t31ZII.png">
  <img src="https://imgur.com/5t31ZII.png" />
</a>
</p>

* Les formulaires

 <p align="center" >
  <img src="https://imgur.com/mwoBDbrl.png" />
</p>

* Le backoffice

 <p align="center" >
<a href="https://imgur.com/eyz4Qzp.png">
  <img src="https://imgur.com/eyz4Qzp.png" />
</a>
</p>


Pour le front j'ai utilisé VueJs, un moyen d'afficher dynamiquement les recherches de ressources. Pour lier l'ensemble entre symfony et vuejs j'utilise webpack encore : 
 <p align="center" >

<a href="https://imgur.com/2SbEzn0.png">
  <img src="https://imgur.com/2SbEzn0.png" />
</a>
</p>


Cela me permet d'avoir un build en direct et d'intégrer Tailwind css pour me faciliter le design !
 <p align="center" >
<a href="https://imgur.com/WfQzaK1.png">
  <img src="https://imgur.com/WfQzaK1.png" />
</a>
</p>
 <p align="center" >

<a href="https://imgur.com/4DUpzaB.png">
  <img src="https://imgur.com/4DUpzaB.png" />
</a>
</p>

Mes vue utilise le store :


 <p align="center" >
<a href="https://imgur.com/VGD734F.png">
  <img src="https://imgur.com/VGD734F.png" />
</a>
</p>




Mon controlleur Symfony gère simplement l'appel de la `<div id="app">`

 <p align="center" >
<a href="https://imgur.com/spopURz.png">
  <img src="https://imgur.com/spopURz.png" />
</a>
</p>



## Installation


**Pour installer mon projet **

1) `git clone https://github.com/bash62/dopepite`
2)  cd dopepite
3) npm i
4) composer install
5) **Créer et modifier votre .env**
6) make:migration




## Conclusion


Le projet m'a permis de solidifier mes compétences en développement VueJs mais surtout Symfony, qui se révéle être un outil incroyable pour gagner du temps.

Le projet était très long car j'ai sous éstimé le temps nécessaire à collecté l'ensemble de mes donnèes nécessaire au bon fonctionnement. 




## Acknowledgments

Travail réalisé par Maxime Bachelet pour le projet S4 de web.