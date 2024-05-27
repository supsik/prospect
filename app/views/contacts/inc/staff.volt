<section class="staff">
	<div class="container">
		<h2 class="staff__title">Редакция</h2>
		<div class="staff__block">
			{% for contact in contacts %}
			<div class="staff__images">
			{% set contactPhoto = contact.getPhoto() %}
				{% if contactPhoto %}
					<img src="{{ contactPhoto }}" alt="{{ contact.name }} - {{ contact.post }}" class="staff__img">
				{% endif %}
				<h3 class="staff__desc">{{ contact.post }}</h3>
				<div class="staff__name">{{ contact.name }}</div>
			</div>
			{% endfor %}
		</div>
	</div>
</section>
