<section class="gallery-wr">
	<div class="container gallery">
		<div class="gallery__sections _gallery-main-slider">
			{% for section in gallery %}
				<div class="gallery-section">
					<div class="gallery-section__images _gallery-sub-slider">
						{% for image in section['images'] %}
							<div class="gallery-section__img"><img src="{{ image }}"></div>
						{% endfor %}
					</div>
					<div class="gallery-section__content">
						{{ renderer.render(section['description']) }}
					</div>
				</div>
			{% endfor %}
		</div>
		<div class="gallery__pagination">
			<div class="gallery__arrow gallery__arrow--prev _gallery-main-slider-prev">
				<span class="gallery__arrow-icon"><svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.50078 7.7998L1.80078 13.3998C1.40078 13.7998 0.800781 13.7998 0.400781 13.3998C0.000780582 12.9998 0.000780582 12.3998 0.400781 11.9998L5.30078 6.9998L0.400781 1.9998C0.000780582 1.5998 0.000780582 0.999804 0.400781 0.599804C0.60078 0.399804 0.800781 0.299805 1.10078 0.299805C1.40078 0.299805 1.60078 0.399804 1.80078 0.599804L7.50078 6.1998C7.90078 6.6998 7.90078 7.2998 7.50078 7.7998C7.50078 7.6998 7.50078 7.6998 7.50078 7.7998Z" fill="#575966"/></svg></span>
				<span class="gallery__arrow-text">Предыдущая</span>
			</div>
			{% if gallery|length > 1 %}
				<div class="gallery__page-info">
					<span class="gallery__page-number _gallery-main-slider-page-current">1</span>
					<span class="gallery__page-number">из</span>
					<span class="gallery__page-number _gallery-main-slider-page-total">{{ gallery|length }}</span>
				</div>
			{% endif %}
			<div class="gallery__arrow gallery__arrow--next _gallery-main-slider-next">
				<span class="gallery__arrow-text">Следующая</span>
				<span class="gallery__arrow-icon"><svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.50078 7.7998L1.80078 13.3998C1.40078 13.7998 0.800781 13.7998 0.400781 13.3998C0.000780582 12.9998 0.000780582 12.3998 0.400781 11.9998L5.30078 6.9998L0.400781 1.9998C0.000780582 1.5998 0.000780582 0.999804 0.400781 0.599804C0.60078 0.399804 0.800781 0.299805 1.10078 0.299805C1.40078 0.299805 1.60078 0.399804 1.80078 0.599804L7.50078 6.1998C7.90078 6.6998 7.90078 7.2998 7.50078 7.7998C7.50078 7.6998 7.50078 7.6998 7.50078 7.7998Z" fill="#575966"/></svg></span>
			</div>
		</div>
	</div>
</section>
