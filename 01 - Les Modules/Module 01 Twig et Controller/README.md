# Module 01 Twig et les controller


:one: Création d'un projet
```
:two: symfony new premier --webapp
```
- Création d'un controller avec les maker
```
symfony console make:controller MainController
```
:three: Création de template avec twig et les <code>block</code>
```twig
<title>{% block title %}Mon site web{% endblock %}</title>
```
:four: Mise en place des liens
```twig
    <a href="{{ path('app_main')}}">main</a>
```