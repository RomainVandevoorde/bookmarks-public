# Bookmarks

En ce moment, vous vous dites: 
"Argh ! C'est plein de dossiers partout ! Je comprends rien ! J'ai pas le niveau pour comprendre ce code !"

Eh bien, vous avez tort ! Laissez moi vous guider à travers ce projet <3

## Les dossiers "OSEF"

Il y a certains dossiers sur lesquels on ne se penchera même pas...

* bootstrap/ contient du code utilisé par Laravel (et n'a rien à voir avec le framework CSS)
* storage/ contient des données et fichiers mis en cache par Laravel. Moi-même je ne sais pas tout ce qui se passe là-dedans x)
* tests/ contient... des tests. C'est quelque chose d'important en milieu professionel mais que je ne connais pas encore, donc je n'en parlerai pas.

## Le routing

Le début, dans un framework, c'est généralement le système de **routing**. Dans le dossier routes/, vous trouverez plusieurs fichiers PHP dont le plus important est web.php. C'est ce fichier qui décrit toutes les URLs accessibles par les utilisateurs, et ce qu'elles font.

Dans le cas de Laravel, il suffit d'écrire Route::, la méthode (POST, GET,...) utilisée, puis en arguments, l'URL puis la fonction à exécuter.

Vous pouvez voir que pour l'URL 'about', donc [http://bookmarks.gamerspice.net/about](http://bookmarks.gamerspice.net/about), on se contente de retourner une vue.    
En revanche, pour l'URL 'profile', on exécute une fonction qui se trouve dans un contrôleur. La syntaxe étant nomDuControleur@nomDeLaFonction.

Cas particulier, Route::resource permet en une seule ligne de code de générer toutes les routes nécessaires à un [CRUD](https://en.wikipedia.org/wiki/Create,_read,_update_and_delete). Plus d'informations à ce sujet dans la [documentation de Laravel](https://laravel.com/docs/5.5/controllers#resource-controllers).

## Les vues

Les vues se trouvent dans le dossier resources/views. Dans ce dossier, vous êtes libres d'organiser vos fichiers comme vous le souhaitez. Pour afficher une de ces vues, il faut ensuite faire
`` return view('chemin de la vue', données) ``
Par exemple, pour afficher le formulaire d'édition d'un bookmark:
`` return view('forms.bookmark.edit', data); ``
On reparlera du data dans la partie contrôleurs.

## Les contrôleurs

Les contrôleurs sont les mieux payés car c'est eux qui font tout le boulot. Ils sont situés dans app/Http/Controllers. Encore une fois, vous pouvez les organiser comme vous le voulez, mais on essaye généralement de les subdiviser de façon logique. Parce que si on met tous les algorithmes de son site dans un seul contrôleur, c'est vite le bordel.

Vous vous rapellez du mot-clé "resource" dans les routes ? Si vous avez regardé la documentation de Laravel en vitesse, vous aurez vu que celui-ci crée automatiquement des routes vers des fonctions: index, create, store, show, edit et update du contrôleur précisé en argument. Dans ce cas ci, BookmarkController. Allons donc regarder à quoi ça ressemble.

Pas de grande surprise, la fonction show (accessible via la route bookmarks/*id*) trouve le bookmark dans la base de données (plus d'infos là-dessus dans la partie Modèles) et envoie toutes les données à une vue qui va afficher celles-ci. Exemple: [http://bookmarks.gamerspice.net/bookmarks/1](http://bookmarks.gamerspice.net/bookmarks/1).

La fonction *edit* du contrôleur vérifie si l'utilisateur est connecté et a le droit de modifier le bookmark et affiche le formulaire d'édition si c'est le cas.

## Les modèles

Vous aurez remarqué que pour trouver tous les bookmarks de la bdd, il me suffit de faire Bookmark::all(), et que pour trouver un bookmark en particulier, il me suffit de faire Bookmark::find(*id*). A une seule condition ! C'est de mettre `` use App\Bookmark `` au sommet du code. Car si vous visitez app/Bookmark.php, vous pouvez voir que j'y ai défini un **modèle**.

Le modèle, c'est le lien entre le code PHP et la base de données. Dans le cas de Bookmark, Laravel va automatiquement chercher une table nommé 'bookmarks' dans la base de données, mais si j'avais nommé cette table 'geoffreysexy', il faudrait que je lui dise que ce modèle correspond à cette table. Il suffirait de faire ça:    
`` protected $table = 'geoffreysexy'; ``

[Voir la documentation](https://laravel.com/docs/5.5/eloquent#eloquent-model-conventions)

Une fois le modèle lié à une table, vous pouvez expliquer à Laravel que ce modèle est lié à d'autres modèles. Par exemple, chaque bookmark est créé par un utilisateur, il y a donc une relation entre les modèles Bookmark et User. Cette relation est explicitée dans chacun des modèles, et me permet de facilement récupérer, par exemple, le nom de la personne qui a créé un bookmark.

Par exemple, quand on affiche un bookmark, via la route bookmarks/*id*, qui apelle la fonction *show* du contrôleur *BookmarkController*, qui affiche la vue resources/views/bookmark.blade.php.    
Ouvrez cette vue, et vous pourrez voir que grâce aux relations définies, il me suffit de taper:
`` <p>Added by: {{ $bookmark->user->name }}</p> ``
pour afficher le nom de la personne qui a ajouté ce lien.

Tout cela en 11 lignes de code. Une dans routes/web.php, 4 dans app/Http/Controllers/BookmarkController, 3 dans app/Bookmark.php, et 3 dans app/User.php.