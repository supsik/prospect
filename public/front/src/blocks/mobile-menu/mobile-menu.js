o2.mobileMenu = {
	open: false,
	toggle()
	{
		if (this.open) this.hide();
		else this.show();
	},
	show()
	{
		this.open = true;
		document.querySelector('._mobile-burger').classList.add('active');
		o2.gPopup.open('_mobile-menu-popup');
	},
	hide()
	{
		this.open = false;
		document.querySelector('._mobile-burger').classList.remove('active');
		o2.gPopup.close(document.querySelector('._mobile-menu-popup'));
	},
};
