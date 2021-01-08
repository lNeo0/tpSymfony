# tpSymfony Maxime CONSIGNY

Version de PHP : 7.3.21<br><br>

Pour les Fixtures il faut charger le fixture ArticlesFixtures.php qui utilise faker, pour ajouter faker il faut utiliser la console et faire "composer require fzaninotto/faker"<br>
Cela permet de générer des données crédibles.<br> <br>

J'ai utilisé le thème : "https://bootswatch.com/4/darkly/bootstrap.min.css"
<br><br>

Pour le développement j'ai d'abord commencé par gérer les articles pour l'ajout et la modification, j'ai fait les formulaires avec l'ajout et la modification d'articles dans la meme méthode grâce a un test si $article est null...
<br>Ensuite j'y ai ajouté les catégories en faisant la jointure grace aux commandes symfony puis j'ai affiché chaque article était dans quel catégorie dans la liste des artciles.<br>

Je n'ai pas eu le temps de faire les autorisations mais j'ai quand même créé une inscription et une connexion avec un encodeur bcrypt de symfony.
