"use strict";
o2.gallery =
{
	mainSlider: null,
	mainSliderClass: '_gallery-main-slider',
	subSliders: null,
	currentPageContainer: null,
	init()
	{
		const mainSlider = $(`.${this.mainSliderClass}`);
		const subSliders = $('._gallery-sub-slider');

		if (!mainSlider.length) return;

		this.currentPageContainer = $('._gallery-main-slider-page-current');

		if (subSliders.length)
			this.subSliders = subSliders.slick({
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				prevArrow: '<div class="gallery-section__arrow gallery-section__arrow--prev _gallery-sub-slider-prev"></div>',
				nextArrow: '<div class="gallery-section__arrow gallery-section__arrow--next _gallery-sub-slider-next"></div>',
			});

		this.mainSlider = $('._gallery-main-slider').slick({
			infinite: false,
			slidesToShow: 1,
			slidesToScroll: 1,
			draggable: false,
			swipe: false,
			adaptiveHeight: true,
			prevArrow: '._gallery-main-slider-prev',
			nextArrow: '._gallery-main-slider-next',
		});
		this.mainSlider.on('beforeChange', (e, slick, currentSlide, nextSlide) => this.updateCurrentPage(nextSlide + 1, slick));
	},
	updateCurrentPage(newPage, slick)
	{
		if (!slick
			|| !slick.$slider.hasClass(this.mainSliderClass)
			|| !this.currentPageContainer) return;
		this.currentPageContainer.html(newPage);
	},
};
