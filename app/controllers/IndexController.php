<?php

class IndexController extends ControllerBase
{
	public function indexAction()
	{
		$journal = Journals::findFirst([
			'is_active = 1',
			'order' => 'date DESC',
		]);
		$slides = Posts::find([
			'is_wide = 1 AND is_active = 1',
			'limit' => 4,
			'order' => 'post_date DESC',
		]);
		$posts = Posts::find([
			'id NOT IN (:slidesId:) AND is_active = 1',
			'bind' => [
				'slidesId' => implode(', ', array_column($slides->toArray(), 'id')),
			],
			'order'  => 'post_date DESC',
			'limit'  => 6,
		]);

		/***/
		$staticBlocks = StaticBlocks::find();

		if (count($staticBlocks))
		{
			$renderer = new CodexToHtml();
			$this->view->setVar('renderer', $renderer);

			if (count($staticBlocks) > 5)
				$this->view->setVar('waterBlock', $staticBlocks->getLast());

			$this->view->setVar('staticBlocks', $staticBlocks);
		}
		/***/
		$water = Posts::find(
			[
				"category = 'photoprojects' AND id = '1634'",
			]
		);
		$this->view->setVar('water', $water);
		$this->view->setVar('posts', $posts);
		$this->view->setVar('journal', $journal);
		$this->view->setVar('slides', $slides);

		$lastBlock = Posts::find(
			[
				"category = 'photoprojects' AND description IS NOT NULL AND description != '' AND is_active != 0",
				'order' => 'post_date DESC',
				'limit' => 1,
			]
		);
		$this->view->setVar('lastBlock', $lastBlock);
		$randomBlock = Posts::find(
			[
				"category = 'interview'",
				'order' => 'RAND()',
				'limit' => 2,
			]
		);
		$this->view->setVar('randomBlock', $randomBlock);
	}

	/**
	 * Action для отображения Not Found страницы
	 * @return view
	 */
	public function notfoundAction()
	{
		$this->response->setStatusCode(404, 'Not Found');
	}

}
