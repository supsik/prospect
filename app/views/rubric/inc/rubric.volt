<sectino class="info">
	<div class="container info__container">
		{% if rubric is defined and rubric|length %}
			<div class="info__grid _info-items">
				{% for item in rubric %}
					<a href="{{ item.getUrl() }}" class="info__block" onclick="o2.info.getUrl(this, event)">
						<div class="info__block-image" data-get="1">
							{% if item.getImagePath() is null %}
								<div class="info__img info__img--empty"></div>
							{% else %}
								<picture>
									<img src="{{ item.getImagePath() }}" alt="{{ item.post_title }}" class="info__img">
								</picture>
							{% endif %}
						</div>
						<div class="info__text">
							<span class="info__desc">{{ item.post_title }}</span>
						</div>
					</a>
				{% endfor %}
			</div>
		{% else %}
			<h2 class="info__title info__title--empty">В категории пусто</h2>
		{% endif %}
	</div>
</sectino>