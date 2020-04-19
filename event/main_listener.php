<?php
/**
 *
 * Topic Starter extension for the phpBB Forum Software package
 *
 * @copyright (c) 2020, Kailey Truscott, https://www.layer-3.org/
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace kinerity\topicstarter\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Topic Starter event listener
 */
class main_listener implements EventSubscriberInterface
{
	/** @var \phpbb\language\language */
	protected $language;

	/**
	 * Constructor
	 *
	 * @param \phpbb\language\language  $language
	 */
	public function __construct(\phpbb\language\language $language)
	{
		$this->language = $language;
	}

	public static function getSubscribedEvents()
	{
		return [
			'core.viewtopic_modify_post_row'	=> 'viewtopic_modify_post_row',
		];
	}

	public function viewtopic_modify_post_row($event)
	{
		$this->language->add_lang('common', 'kinerity/topicstarter');

		$event->update_subarray('post_row', 'S_TOPIC_STARTER', ($event['topic_data']['topic_poster'] == $event['poster_id'] && $event['poster_id'] != ANONYMOUS) ? true : false);
	}
}
