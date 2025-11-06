# Module 06 Les formulaires

## :one: Créer un formulaire
```
symfony console make:form
```
**ou bien**
```
symfony console make:form Film
```
Selectionnez l'Entité

## :two: Ajouter Bootstrap sur les formulaires
<code>config/pakage/twig.yaml</code>

```yaml
 form_themes: ['bootstrap_5_layout.html.twig']
```

```yaml
twig:
    file_name_pattern: '*.twig'
    form_themes: ['bootstrap_5_layout.html.twig']
when@test:
    twig:
        strict_variables: true
```



## :three: Ajouter le formulaire dans twig
le controller
```php
 #[Route('/film', name: 'app_film')]
    public function index(): Response
    {
        $film = new Film();
        $form = $this->createForm(FilmType::class, $film);
        
        return $this->render('film/index.html.twig', [
            'form' => $form,
        ]);
    }
```

twig
```html
{% block body %}
<div class="col-4">
    {{ form_start(form)}}

    {{ form_widget(form)}}
    <button class="btn btn-primary" type="submit">OK</button>
    {{ form_end(form)}}

</div>
{% endblock %}
```

## :four: Récupérer les données du formulaire
```php
#[Route('/film', name: 'app_film')]
    public function index(Request $request,EntityManagerInterface $em): Response
    {
        $film = new Film();
        $form = $this->createForm(FilmType::class, $film);

        $form->handleRequest($request);
        if ($form->isSubmitted()){
             $em->persist($film);
             $em->flush();
            return $this->redirectToRoute("main_home");
        }
        
        return $this->render('film/index.html.twig', [
            'form' => $form,
        ]);
    }
```

## :five: Traitement des données formulaire
```php
$builder
            ->add('titre')
            ->add('annee')
            ->add('realisateur')
            //->add('isValid')
            ->add('isMajeur',CheckboxType::class,[
                'label'    => 'Etes vous majeur?',
                'mapped'=>false,
                'required'=>false
                ])
        ;
```

```php
#[Route('/film', name: 'app_film')]
    public function index(Request $request,EntityManagerInterface $em): Response
    {
        $film = new Film();
        $form = $this->createForm(FilmType::class, $film);

        $form->handleRequest($request);
        if ($form->isSubmitted()){
           //---------------------------
           $majeur = $form->get('isMajeur')->getData();
            dd($majeur);
             $film->setValid(true);
             //---------------------------
             $em->persist($film);
             $em->flush();
            return $this->redirectToRoute("main_home");
        }
        
        return $this->render('film/index.html.twig', [
            'form' => $form,
        ]);
    }
```