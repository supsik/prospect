<section class="recent">
	<div class="container recent__container">
		<div class="recent__block">
			<div class="recent__magazine">
				<h3 class="recent__title">Свежий цифровой номер{% if journal.price %}<span class="recent__price">{{ journal.price }}₽</span>{% endif %}</h3>
				<button onclick="o2.gPopup.open('poupap')" class="recent__button">Читать журнал</button>
			</div>
			<div class="recent__image">
				<img onclick="o2.gPopup.open('poupap')" src="{{ journal.getImagePath() }}" alt="{{journal.person}}" class="recent__img">
			</div>
		</div>
		{% include "inc/poupap.volt" %}
	</div>
</section>
