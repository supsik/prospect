{% extends "layouts/main.volt" %}

{% block page %}
	{% include "index/inc/slider.volt" %}
	{% include "blocks/info.volt" %}
	{% if staticBlocks is defined and staticBlocks|length %}
		{% include "index/inc/digest.volt" %}
	{% endif %}
	{% if waterBlock is defined and renderer is defined %}
		{% include "index/inc/water.volt" %}
	{% endif %}
	{% include "index/inc/recent.volt" %}
{% endblock %}
