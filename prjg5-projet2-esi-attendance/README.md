# But

Application de gestion de prise de présences pour l'ESI.

# Fonctionnalités

Sont implémentées les fonctionnalités :
- Importation de fichier CSV relatif à l'affectation des groupes pour chaque étudiant
- Téléchargement des statistiques de présences au format XLSX ou CSV au choix
- Consultation des étudiants présents à une séance
- Importation des horaires des professeurs
- Prise de présence (au travers de la consultation des étudiants)
- Ajout d'un étudiant à un cours
- Suppression d'un étudiant d'un cours
- Gestion des étudiants
- Gestion des présences via le calendrier

# Déploiement

Via Heroku : http://esi-attendance-johnlom.herokuapp.com/

## Marche à suivre pour mettre à jour le déploiement Heroku

**À faire absolument après un merge sur la branche master.**
Si ça n'est pas fait, le déploiement Heroku ne rendra pas compte de la modification.
(Pensez à mettre à jour la liste des fonctionnalités implémentées un peu plus haut !)


- Si ça n'est pas encore fait, installer le Heroku CLI (permet d'interagir avec Heroku via le cmd/bash): https://devcenter.heroku.com/articles/heroku-cli
- Si ça n'est pas encore fait, ouvrir un cmd/bash et se connecter via `heroku login`. La connexion passe par le navigateur.
- Pour mettre à jour le déploiement, depuis le dossier du projet, utiliser `git push heroku HEAD:master`. Si jamais ça ne fonctionne pas, utiliser `heroku git:remote -a esi-attendance-johnlom` et réessayer (ça permet de régler l'adresse du dépôt Heroku qui sera utilisé lors du push).

## Une commande utile : les logs

Si jamais vous remarquez que le déploiement ne s'est pas bien passé, une (première) façon de "débugger" est de consulter les logs du déploiement.
Ils pourront vous renseigner sur des possibles erreurs internes. Pour ce faire :

- `heroku logs -a esi-attendance-johnlom` vous donneront les derniers logs de l'application.
- `heroku logs -a esi-attendance-johnlom --tail` vous donneront les logs en temps réel. Les logs précédents s'affichent et le cmd/bash reste ouvert pour afficher en temps réel les nouveaux logs (CTRL+C pour arrêter).

## Notes supplémentaires

Le CSS sur les différentes pages se charge uniquement sur l'application déployée. La raison est la suivante: pour des raisons de sécurité le CSS est uniquement chargé si celui-ci provient d'une connection sécurisée. Ceci est uniquement le cas quand sur l'application déployé et pas quand l'application tourne en local. 
