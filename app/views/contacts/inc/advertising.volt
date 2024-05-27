<section class="advertising">
	<div class="container">
		<div class="advertising__tablet">
			<div class="advertising__big-block">
					<h2 class="advertising__title">Размещение рекламы</h2>
				<div class="advertising__info-block">
					<div class="advertising__connection">
						<div class="advertising__text">Контактный телефон</div>
						<div class="advertising__info advertising__telephon">
							{% for item in blocks %}
								{{ item.data.text }}</br>
							{% endfor %}
						</div>
						<div class="advertising__text">Email</div>
						<a href="mailto:{{ data['email'] }}" class="advertising__info">{{ data['email'] }}</a>
					</div>
					<div class="advertising__address">
						<div class="advertising__text">Адрес редакции</div>
						<div class="advertising__info">{{ data['address'] }}</div>
					</div>
				</div>
			</div>
			{% if manager %}
			<div class="advertising__image">
				{% set managerPhoto = manager.getPhoto() %}
				{% if managerPhoto %}
					<img src="{{ managerPhoto }}" alt="{{ manager.name }} - {{ manager.post }}" class="advertising__img">
				{% endif %}
				<h2 class="advertising__desc">{{ manager.post }}</h2>
				<div class="advertising__name">{{ manager.name }}</div>
			</div>
			{% endif %}
		</div>
		<div class="advertising__border"></div>
	</div>
</section>
