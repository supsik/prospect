<?php

class ArchiveController extends ControllerBase
{
	public function indexAction()
	{
		$this->view->setVar('title','Архив | Проспект Северный Кавказ');
		$journals = Journals::find([
			'is_active = 1',
			'order' => 'date DESC',
		]);
		$this->view->setVar('journals',$journals);
		$staticBlocks = StaticBlocks::find("code='archive_title' OR code='archive_description'");
		$this->view->setVar('archiveTitle', '');
		$this->view->setVar('archiveDescription', '');
		foreach($staticBlocks as $block)
		{
			$content = json_decode($block->content);
			if(empty($content->blocks[0]->data->text))
				continue;
			if($block->code == 'archive_title')
			{
				$this->view->setVar('archiveTitle', $content->blocks[0]->data->text);
			}
			else
			{
				$this->view->setVar('archiveDescription', $content->blocks[0]->data->text);
			}
		}
	}

}
