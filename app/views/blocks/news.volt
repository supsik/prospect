<div class="info__content">
	{% for item in news[0:5] %}
	<div class="info__block">
		<a href="#">
			<picture>
				<source media="(min-width: 1440px)" srcset="{{item.getImage()}}" type="image/webp">
				<source media="(min-width: 768px)" srcset="{{item.getImage()}}" type="image/webp">
				<img src="{{item.getImage()}}" alt="{{ item.name }}" class="info__img">
			</picture>
			<div class="info__text">
				<h3 class="info__title">{{ item.section.name }}</h3>
				<span class="info__desc">{{ item.name }}</span>
			</div>
		</a>
	</div>
	{% endfor %}
</div>