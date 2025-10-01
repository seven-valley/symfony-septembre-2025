# Module 05 Twig et les controller


:one: Création d'un projet
```
 symfony new premier --webapp
```
:two: Création d'un controller avec les maker
```
symfony console make:controller MainController
```
:three: Création de template avec twig et les <code>block</code> & <code>extends</code>
```twig
<title>{% block title %}Mon site web{% endblock %}</title>
```
:four: Mise en place des liens
```twig
    <a href="{{ path('app_main')}}">main</a>
```

:five: Mise en place des assets
```twig
  <link rel="stylesheet" href="{{asset('styles/styles.css')}}">   
```

:six: Afficher un tableau
```twig
{# dump(personnes) #}

{% for personne in personnes %}
   {{loop.index}}
   {{personne.prenom}}  {{personne.nom}} <br> 
{% endfor %}
```
