<section class="magazines">
	<div class="container">
		<div class="magazines__grid">
			{% for journal in journals %}
				<div class="magazines__block">
					<div class="magazines__block-image">
						<picture>
							<img src="{{ journal.getImagePath() }}" alt="{{ journal.person }}" class="magazines__img">
						</picture>
					</div>
					<h3 class="magazines__title">{{ journal.name }}</h3>
					<div class="magazines__btn">
					{% if journal.price %}
						<button class="magazines__button" onclick="o2.gPopup.open('poupap')">Купить</button>
					{% else %}
						<button class="magazines__button" onclick="o2.gPopup.open('poupap')">Читать</button>
					{% endif %}
					</div>
				</div>
			{% endfor %}
		</div>
		{% include "inc/poupap.volt" %}
	</div>
</section>
