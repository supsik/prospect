<section class="info">
	<div class="container info__container">
		{% if posts is defined and posts|length %}
			<div class="info__grid _info-items">
				{% for post in posts %}
					<a class="info__block" href="{{ post.getUrl() }}" onclick="o2.info.getUrl(this, event)">
						{% set image = post.getImagePath() %}
						{% if image is null %}
							<div class="info__block-image" data-get="1">
								<div class="info__img info__img--empty"></div>
							</div>
						{% else %}
							<div class="info__block-image" data-get="1">
								<img src="{{ image }}" alt="{{ post.post_title }}" class="info__img">
							</div>
						{% endif %}
						<div class="info__text">
							<h3 class="info__title">{{ post.getCategoryName() }}</h3>
							<span class="info__desc">{{ post.post_title }}</span>
						</div>
					</a>
				{% endfor %}
			</div>
			<a class="info__block _info__block info__block--template _info-block-template" href="#url#" data-click="o2.info.getUrl(this, event)">
				<div class="info__block-image" data-get="1">
					<img src="#imagePath#" alt="#alt#" class="info__img">
				</div>
				<div class="info__text">
					<h3 class="info__title">#categoryName#</h3>
					<span class="info__desc">#title#</span>
				</div>
			</a>
			{% if posts|length > 6 %}
			<div class="info__btn">
				<button onclick="o2.info.showMore(this)" class="info__button">Показать больше</button>
			</div>
			{% endif %}
		{% else %}
			<h2 class="info__title info__title--empty">В категории пусто</h2>
		{% endif %}
	</div>
</section>
