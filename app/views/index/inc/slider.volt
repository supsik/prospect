<div class="g-slider">
	{% for slide in slides %}
	<div class="g-slider__item-wr">
		<div style="background-image: url({{  slide.getImagePath() }});" class="g-slider__item">
			<div class="container">
				<h1 class="g-slider__title">{{ slide.post_title }}</h1>
				<span class="g-slider__desc">{{ slide.description }}</span>
				<a href="{{ slide.getUrl() }}" class="g-slider__button">Читать полностью</a>
			</div>
		</div>
	</div>
	{% endfor %}
</div>
