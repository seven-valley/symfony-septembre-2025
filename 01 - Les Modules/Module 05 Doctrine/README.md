# Module 02 - Prise en main de Doctrine

## :one: Créer une entité
```
symfony console make:entity
```

```
symfony console make:entity Film
```

- Définir les attributs et les types
- Définir la contrainte de nullité

## :two: Mettre l'entité en base de données

```
symfony console doctrine:schema:update -force
```

```
symfony console d:s:u -f
```

## :three: Créer une entité dans le controller
```php
$film = new Film();
```
- Nous allons hydrater cette entité
```php
$film = new Film();
$film->setTitle('SAW');
$film->setAnnee('2006');
$film->setRealisateur('toto');
$film->setValid(true);
```

# :four: Création de la route
```php
    #[Route('/ajouter', name: 'main_ajouter')]
    public function ajouter(EntityManagerInterface $em)
    {
        $film = new Film();
        $film->setTitle('SAW');
        $film->setAnnee('2006');
        $film->setRealisateur('toto');
        $film->setValid(true);
        dump($film);
        $em->persist($film);
        $em->flush();

        dd($film);
        return $this->redirectToRoute("main_home");

    }
```

# :five: Afficher la liste
```php
    #[Route('/', name: 'main_home')]
    public function home(FilmRepository $repo): Response
    {

        $films = $repo->findAll();
        return $this->render('main/home.html.twig', [
            'titre' => 'Home',
            'films' => $films,
        ]);
    }
```

# :five: Afficher un  éléments de la liste
```php
 #[Route('/film/{id}', name: 'main_film')]
    public function film(Film $film): Response
    {
        //dd($film); 

        return $this->render('main/film.html.twig', [
            'titre' => 'Details film :',
            'film' => $film,
        ]);
    }
```