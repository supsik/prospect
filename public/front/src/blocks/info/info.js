o2.info = {
	page: 1,
	isLastPage: false,
	category: '',
	inProgress: false,
	baseUrl: /localhost/.test(window.location.origin) ? 'http://prospect-web.dev3.odva.pro/' : '/',
	blockMargin: 10,
	mobileWidth: 767,
	containerSelector: '._info-items',
	blockSelector: '.info__block',
	init()
	{
		this.updateBlockMargin();
		this.updateInfoHeight();
		this.setCategory();
		window.addEventListener('resize', () =>
		{
			this.updateBlockMargin();
			this.updateInfoHeight();
		});
		document.querySelectorAll(`${this.containerSelector} img`).forEach(img =>
		{
			img.addEventListener('load', () => this.updateInfoHeight());
			img.addEventListener('error', (e) => console.log(e));
		});
	},
	setCategory()
	{
		const paths = window.location.pathname.split('/').filter(el => !!el);
		this.category = paths[paths.length - 1] || '';
	},
	async showMore(instance)
	{
		$('.container').css('overflow', 'hidden');
		if (!this.category) this.setCategory();
		if (this.isLastPage || this.inProgress) return;
		this.inProgress = true;
		let postsData = await $.ajax({
			url: `${this.baseUrl}articles/getNextPage/`,
			method: 'POST',
			data: { page: this.page, category: this.category },
		});
		postsData = JSON.parse(postsData);
		if (postsData.result.current >= postsData.result.next)
		{
			instance.style.display = 'none';
			this.isLastPage = true;
		}

		this.page = postsData.result.current;
		this.addNewItems(postsData.result.items);
		this.inProgress = false;
	},
	updateBlockMargin()
	{
		const block = document.querySelector(`${this.containerSelector} ${this.blockSelector}`);
		if (!block) return;
		const blockStyle = block.currentStyle || window.getComputedStyle(block);
		this.blockMargin = +blockStyle.marginBottom.match(/\d+/);
	},
	updateInfoHeight()
	{
		const container = document.querySelector(this.containerSelector);
		if (!container) return;
		if (window.innerWidth <= this.mobileWidth)
		{
			container.style.height = '';
			return;
		}

		const height = this.getColumnHeight(container);
		container.style.height = `${height}px`;
		container.classList.add('visibility');
	},
	getColumnHeight(container)
	{
		const heightsOfColumns = [0,0,0];

		let column = 0;
		container.querySelectorAll(`${this.blockSelector}`).forEach(element =>
		{
			heightsOfColumns[column] += element.offsetHeight + this.blockMargin;
			column = column >= 2 ? 0 : column + 1;
		});

		let max = heightsOfColumns[0] > heightsOfColumns[1] ? heightsOfColumns[0] : heightsOfColumns[1];
		max = max > heightsOfColumns[2] ? max : heightsOfColumns[2];

		return max + this.blockMargin * 2;
	},
	addNewItems(items)
	{
		const itemsContainer = document.querySelector(`${this.containerSelector}`);
		let newBlocks = [];
		for (let item of items)
		{
			const domItem = this.createItem(item);
			const domItemImage = domItem.querySelector('img');
			if (domItemImage) domItemImage.addEventListener('load', () => this.updateInfoHeight());
			itemsContainer.appendChild(domItem);
		}
		setTimeout(function(){
			$('._info__block').removeClass('hide');
			$('.container').css('overflow', 'unset');
		}, 700);
		this.updateInfoHeight();
	},
	createItem(item)
	{
		const template = document.querySelector('._info-block-template');
		const newItem = document.createElement('a');
		newItem.innerHTML = template.innerHTML
			.replace('#imagePath#', item.imagePath)
			.replace('#categoryName#', item.categoryName)
			.replace('#title#', item.post_title)
			.replace('#alt#', item.post_title);
		newItem.href = item.url;
		$(newItem).attr('onclick', 'o2.info.getUrl(this, event)');
		if (!item.imagePath)
		{
			let block = newItem.querySelector('.info__block-image');
			let emptyImage = document.createElement('div');
			emptyImage.classList.add('info__img');
			emptyImage.classList.add('info__img--empty');
			$(emptyImage).attr('data-get', 1);
			newItem.replaceChild(emptyImage, block);
		}
		let blockClass = this.blockSelector.match(/[a-zA-Z0-9_-]+/)[0];
		newItem.classList.add(blockClass);
		newItem.classList.add('_info__block');
		newItem.classList.add('hide');
		return newItem;
	},
	getUrl(link, event)
	{
		event.preventDefault();
		history.pushState(null, null, link.href);
		let img = $(link).find('[data-get]');
		let x = img.offset().left,
			y = img.offset().top,
			w = $(img).width(),
			h = $(img).height();
		$('main').find('div').addClass('hide');
		$.ajax({
			url: link.href,
			dataType: 'json',
			data: {ajax: 1},
			cache: false,
			success: (msg) => {
				$('main').html(msg.data, 1000);
				let smile = document.querySelector('.smile');
				if(smile)
				{
					this.getPhotoprojects(smile, x, y, w, h);
				}
				else
				{
					this.getArticles(x, y, w, h);
				}
			}
		});
	},
	getPhotoprojects(smile, x, y, w, h)
	{
		$('main').find('div').addClass('hide');
		$(smile).css({
			'width': ''+w+'px',
			'height': ''+h+'px',
			'transform': 'translateX('+x+'px) translateY('+y+'px)',
		});
		window.scrollTo(0, 0);
		setTimeout(function(){
			$(smile).css({
				'width': '100%',
				'height': 'unset',
				'transform': 'translateX(0) translateY(0)',
				'transition': '.7s',
			});
			setTimeout(function(){
				$("html, body").animate({ scrollTop: 0 }, "10");
				$('main').find('div').removeClass('hide');
				$('main').find('div').addClass('visible');
			}, 500);
		}, 100);
	},
	getArticles(x, y, w, h)
	{
		$('main').find('div').addClass('hide');
		let image = $('.standart-post-head__img').find('img');
		let dx = x - image.offset().left,
			dy = y - image.offset().top;
		if($(window).width() <= 767)
		{
			image.css({
				'transform': 'translateY('+dy+'px)',
			});
		}
		else
		{
			image.css({
				'transform': 'translateX('+dx+'px) translateY('+dy+'px)',
			});
		}
		setTimeout(function(){
			image.css({
				'transition': '1s',
				'transform': 'translateX(0) translateY(0)',
			});
			setTimeout(function(){
				$("html, body").animate({ scrollTop: 0 }, "10");
				$('main').find('div').removeClass('hide');
				$('main').find('div').addClass('visible');
			}, 200);
		}, 1);
	}
};






















































































