{% extends "interna/partials/partial.twig.php" %}

{% block title %}Erro!{% endblock %}

{% block body %}
<div class="main-container">
    <div class="max-width vertical-center">
        {{message}}
        <br>
    </div>
</div>
{% endblock %}