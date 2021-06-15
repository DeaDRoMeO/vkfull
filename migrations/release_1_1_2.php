<?php

/**
*
* @package VKWigets
* @copyright (c) 2021 DeaDRoMeO ; hello-vitebsk.ru
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace deadromeo\vkfull\migrations;

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
    exit;
}

class release_1_1_2 extends \phpbb\db\migration\migration
{
public function effectively_installed()
	{
		return (isset($this->config['vk_version']) && version_compare($this->config['vk_version'], '1.1.2', '>='));
	}
static public function depends_on()
	{
		return array('\deadromeo\vkfull\migrations\release_1_1_1');
	}		
		
	public function update_data()
	{
		return array(
			array('config.add', array('vk_version', '1.1.2')),
			array('if', array(
				(isset($this->config['vk_version']) && version_compare($this->config['vk_version'], '1.1.2', '<')),
				array('config.update', array('vk_version', '1.1.2')),
			)),
		);
	}
	public function update_schema()
	{
		
			return 	array(
				'add_columns' => array(
					$this->table_prefix . 'vk_postwall' => array(
						'display' => array('TINT:1',0),
					),
					$this->table_prefix . 'vk_poll' => array(
						'display' => array('TINT:1',0),
					),
				),
			);
		
	}

	public function revert_schema()
	{
		return 	array(
			'drop_columns' => array(
				$this->table_prefix . 'vk_postwall' => array('display'),
				$this->table_prefix . 'vk_poll' => array('display'),
			),
		);
	}
	public function revert_data()
	{
		
	}
}