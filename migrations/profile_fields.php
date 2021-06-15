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

class profile_fields extends \phpbb\db\migration\migration
{

	protected $profilefield_name = 'vkbb_profile';

	protected $profilefield_database_type = array('VCHAR', '');

	protected $profilefield_data = array(
		'field_name'			=> 'vkbb_profile',
		'field_type'			=> 'profilefields.type.string',
		'field_ident'			=> 'vkbb_profile',
		'field_length'			=> '20',
		'field_minlen'			=> '1',
		'field_maxlen'			=> '30',
		'field_novalue'			=> '',
		'field_default_value'	=> '',
		'field_validation'		=> '[\w.]+',
		'field_required'		=> 0,
		'field_show_novalue'	=> 0,
		'field_show_on_reg'		=> 0,
		'field_show_on_pm'		=> 0,
		'field_show_on_vt'		=> 1,
		'field_show_profile'	=> 1,
		'field_hide'			=> 0,
		'field_no_view'			=> 0,
		'field_active'			=> 1,
		'field_is_contact'		=> 1,
		'field_contact_desc'	=> 'PROFILE_VK',
		'field_contact_url'		=> 'https://vk.com/%s',
	);

	protected $user_column_name = 'user_vk';
	
 public function effectively_installed()
	{
		return $this->db_tools->sql_column_exists($this->table_prefix . 'profile_fields_data', 'pf_' . $this->profilefield_name);
	}

	public function update_schema()
	{
		return array(
			'add_columns'	=> array(
				$this->table_prefix . 'profile_fields_data'			=> array(
					'pf_' . $this->profilefield_name		=> $this->profilefield_database_type,
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns'	=> array(
				$this->table_prefix . 'profile_fields_data'			=> array(
					'pf_' . $this->profilefield_name,
				),
			),
		);
	}

	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'create_custom_field'))),
					);
	}

	public function revert_data()
	{
		return array(
			array('custom', array(array($this, 'delete_custom_profile_field_data'))),
		);
	}

	public function create_custom_field()
	{
		$profilefield_name = 'vkbb_profile';
		$profilefield_database_type = array('VCHAR', '');
		$sql = 'SELECT MAX(field_order) as max_field_order
			FROM ' . PROFILE_FIELDS_TABLE;
		$result = $this->db->sql_query($sql);
		$max_field_order = (int) $this->db->sql_fetchfield('max_field_order');
		$this->db->sql_freeresult($result);

		$sql_ary = array_merge($this->profilefield_data, array(
			'field_order'			=> $max_field_order + 1,
		));

		$sql = 'INSERT INTO ' . PROFILE_FIELDS_TABLE . ' ' . $this->db->sql_build_array('INSERT', $sql_ary);
		$this->db->sql_query($sql);
		$field_id = (int) $this->db->sql_nextid();

		$insert_buffer = new \phpbb\db\sql_insert_buffer($this->db, PROFILE_LANG_TABLE);

		$sql = 'SELECT lang_id
			FROM ' . LANG_TABLE;
		$result = $this->db->sql_query($sql);
		$lang_name = (strpos($this->profilefield_name, 'phpbb_') === 0) ? strtoupper(substr($this->profilefield_name, 6)) : strtoupper($this->profilefield_name);
		while ($lang_id = (int) $this->db->sql_fetchfield('lang_id'))
		{
			$insert_buffer->insert(array(
				'field_id'				=> (int) $field_id,
				'lang_id'				=> (int) $lang_id,
				'lang_name'				=> $lang_name,
				'lang_explain'			=> $lang_name.'_EXP',
				'lang_default_value'	=> '',
			));
		}
		$this->db->sql_freeresult($result);

		$insert_buffer->flush();
		$schema_change = array('add_columns' => array(
					$this->table_prefix . 'profile_fields_data'	=> array(
						'pf_' . $profilefield_name => $profilefield_database_type,
					),
				));
				$this->db_tools->perform_schema_changes($schema_change);
	}
	public function delete_custom_profile_field_data()
	{
		$field_id = $this->get_custom_profile_field_id();

		$sql = 'DELETE FROM ' . PROFILE_FIELDS_TABLE . '
			WHERE field_id = ' . (int) $field_id;
		$this->db->sql_query($sql);

		$sql = 'DELETE FROM ' . PROFILE_LANG_TABLE . '
			WHERE field_id = ' . (int) $field_id;
		$this->db->sql_query($sql);

		$sql = 'DELETE FROM ' . PROFILE_FIELDS_LANG_TABLE . '
			WHERE field_id = ' . (int) $field_id;
		$this->db->sql_query($sql);
	}
	public function get_custom_profile_field_id()
	{
		$sql = 'SELECT field_id
			FROM ' . PROFILE_FIELDS_TABLE . "
			WHERE field_name = '" . $this->profilefield_name . "'";
		$result = $this->db->sql_query($sql);
		$field_id = (int) $this->db->sql_fetchfield('field_id');
		$this->db->sql_freeresult($result);

		return $field_id;
	}
}