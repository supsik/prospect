{% extends "layouts/main.volt" %}

{% block page %}
	{% include "contacts/inc/edition.volt" %}
	{% include "contacts/inc/advertising.volt" %}
	{% if contacts|length %}
	{% include "contacts/inc/staff.volt" %}
	{% endif %}
{% endblock %}
