<?php

class ContactsController extends ControllerBase
{
	public function indexAction()
	{
		$contacts = Contacts::find([
			'is_manager != 1'
		]);
		$manager = Contacts::findFirstByIsManager(1);

		$this->view->setVar('contacts', $contacts);
		$this->view->setVar('manager', $manager);
		$this->view->setVar('title','Контакты | Проспект Северный Кавказ');
		$staticBlocks = StaticBlocks::find("code='contacts_title' OR code='contacts_description'");
		$this->view->setVar('contactsTitle', '');
		$this->view->setVar('contactsDescription', '');
		foreach($staticBlocks as $block)
		{
			$content = json_decode($block->content);
			if(empty($content->blocks[0]->data->text))
				continue;
			if($block->code == 'contacts_title')
			{
				$this->view->setVar('contactsTitle', $content->blocks[0]->data->text);
			}
			else
			{
				$this->view->setVar('contactsDescription', $content->blocks[0]->data->text);
			}
		}
		$contact = StaticBlocks::find("code='email' OR code='address'");
		$data = [];
		foreach($contact as $item)
			$data[$item->code] = $item->description;
		$this->view->setVar('data', $data);

		$phone = StaticBlocks::find("code = 'phone'");
		foreach($phone as $item)
			$data = json_decode($item->content);
			$this->view->setVar('blocks', $data->blocks);
	}
}
