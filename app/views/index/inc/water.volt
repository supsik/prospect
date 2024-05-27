<section class="water">
	<a href="{{ water[0].getUrl() }}">
		<div class="container water__container">
			<img src="{{ water[0].getImagePath() }}">
			<div class="water__content">
				{% if water[0].post_title|length %}
					<h3 class="water__title">{{ water[0].post_title }}</h3>
				{% endif %}

				{% if water[0].description|length %}
					<span class="water__desc">{{ water[0].description }}</span>
				{% endif %}
			</div>
			<div class="water__bc"></div>
		</div>
	</a>
</section>