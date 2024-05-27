{% extends "layouts/main.volt" %}

{% block page %}
	{% if article.is_wide and article.big_img %}
	{% include "articles/inc/widePostHead.volt" %}
	{% else %}
	{% include "articles/inc/standartPostHead.volt" %}
	{% endif %}
	{% if  blocks|length and article.is_wide  %}
		<section class="crystal">
			<div class="container crystal__container crystal__info">
				{{ renderer.render(blocks) }}
			</div>
		</section>
	{% else %}
		{% if blocks|length %}
			<section class="crystal">
				<div class="container crystal__container crystal__info">
					{{ renderer.render(blocks) }}
				</div>
			</section>
		{% endif %}
	{% endif %}
	{% if gallery is defined and gallery|length > 0 %}
		{% include "articles/inc/gallery.volt" %}
	{% endif %}
	{% include "articles/inc/author.volt" %}
	<sectino class="info">
		<div class="container info__container">
			<div class="info__content info__blog">
				{% for recommendedPost in recommended %}
				<a href="{{ recommendedPost.getUrl() }}" class="info__block" onclick="o2.info.getUrl(this, event)">
					<div class="info__block-image" data-get="1">
					<img src="{{ recommendedPost.getImagePath() }}" alt="{{ recommendedPost.post_title }}" class="info__img">
					</div>
					<div class="info__text">
						<h2 class="info__title">{{ recommendedPost.getCategoryName() }}</h2>
						<span class="info__desc">{{ recommendedPost.post_title }}</span>
					</div>
				</a>
				{% endfor %}
			</div>
		</div>
	</sectino>
{% endblock %}
