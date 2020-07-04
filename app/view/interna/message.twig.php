{% extends "interna/partial.twig.php" %}

{% block title %}Valor inválido!{% endblock %}

{% block body %}
<div class="main-container">
    <div class="max-width vertical-center">
        {{message}}
        <br>
    </div>
</div>
{% endblock %}