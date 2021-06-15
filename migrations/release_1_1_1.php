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

class release_1_1_1 extends \phpbb\db\migration\migration
{
public function effectively_installed()
	{
		return (isset($this->config['vk_version']) && version_compare($this->config['vk_version'], '1.1.1', '>='));
	}
static public function depends_on()
	{
		return array('\deadromeo\vkfull\migrations\release_1_1_0');
	}		
		
	public function update_data()
	{
		return array(
			array('config.remove', array('vkbb_wall_id')),
			array('config.remove', array('vkbb_wall_id1')),
			array('config.remove', array('vkbb_wall_idpost')),
			array('config.remove', array('vkbb_hash')),
			array('config.remove', array('vkbb_poll_id')),
			array('config.remove', array('like_style')),
			array('config.remove', array('vkbb_com_p')),
			array('config.remove', array('vkbb_like_p')),
			array('config.add', array('vk_version', '1.1.1')),
			array('if', array(
				(isset($this->config['vk_version']) && version_compare($this->config['vk_version'], '1.1.1', '<')),
				array('config.update', array('vk_version', '1.1.1')),
			)),
			
		);
	}
	public function update_schema()
	{
		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'vk_postwall'	=> array(
					'COLUMNS'	=> array(
						'id'				=> array('UINT:11', null, 'auto_increment'),
						'name'			=> array('VCHAR', ''),
						'element_id'			=> array('VCHAR', ''),
						'owner_id'			=> array('VCHAR', ''),
						'post_id'			=> array('VCHAR', ''),
						'hash'			=> array('VCHAR', ''),
						
					),
					'PRIMARY_KEY'	=> 'id',
				),
			$this->table_prefix . 'vk_poll'	=> array(
					'COLUMNS'	=> array(
						'id'				=> array('UINT:11', null, 'auto_increment'),
						'name'			=> array('VCHAR', ''),
						'poll_id'			=> array('VCHAR', ''),
						
					),
					'PRIMARY_KEY'	=> 'id',
				),
			),
		);
	}

	public function revert_schema()
	{
		return 	array(
			'drop_tables' => array(
				$this->table_prefix . 'vk_postwall',
				$this->table_prefix . 'vk_poll',
			),
		);
	}
	public function revert_data()
	{
		
	}
}