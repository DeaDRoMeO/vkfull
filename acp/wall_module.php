<?php

/**
*
* @package VKWigets
* @copyright (c) 2021 DeaDRoMeO ; hello-vitebsk.ru
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace deadromeo\vkfull\acp;

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
    exit;
}

/**
* @package acp
*/
class wall_module
{
	protected $config;
	protected $request;
	protected $template;
	protected $user;
	protected $pagination;

	var $u_action;

	function main($id, $action)
	{
		global $config, $request, $db, $template, $user, $pagination, $u_action, $phpbb_container;

		$this->config = $config;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->pagination = $pagination;
		$vk_postwall_table = $phpbb_container->getParameter('deadromeo.vkfull.table.vk_postwall');
		$this->user->add_lang('acp/common');
		$this->tpl_name = 'acp_wall';
		$this->page_title = $this->user->lang('VK_WALL');
		$action = $request->variable('action', '');
		$id		= $request->variable('id', 0);
		
		if ($this->request->is_set_post('submit3'))
		{
						
			$vkbb_wall_on = $this->request->variable('vkbb_wall_on', 0);
			$this->config->set('vkbb_wall_on', $vkbb_wall_on);
			$vkbb_wall_p = $this->request->variable('vkbb_wall_p', 0);
			$this->config->set('vkbb_wall_p', $vkbb_wall_p);
						
			trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
		}
				$start = $this->request->variable('start', 0);
				$total_postwall    = 0;
				$per_page        = 10;
				$sql = 'SELECT COUNT(id) AS total_postwall
					FROM ' . $vk_postwall_table;
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$total_postwall = $row['total_postwall'];
				$db->sql_freeresult($result);
				$pagination_url = $this->u_action;
				$pagination = $phpbb_container->get('pagination');
				$pagination->generate_template_pagination($pagination_url, 'pagination', 'start', $total_postwall, $per_page, $start);
			
				$sql = 'SELECT id, name, display
					FROM ' . $vk_postwall_table . '
					ORDER by id';
				$result = $db->sql_query_limit($sql, $per_page, $start);

				while ($row = $db->sql_fetchrow($result))
				{
					$template->assign_block_vars('postwall', array(
						'ID'			=> $row['id'],
						'NAME'			=> $row['name'],
						'DISPLAY'		=> ($row['display'] == 1) ? $user->lang['YES'] : $user->lang['NO'],
						'U_EDIT'		=> $this->u_action . '&amp;action=edit&amp;id=' .$row['id'],
						'U_DEL'			=> $this->u_action . '&amp;action=delete&amp;id=' .$row['id'],
						)
					);
				}
				$db->sql_freeresult($result);
		$template->assign_vars(array(
		    'VK_VERSION'			=> isset($this->config['vk_version']) ? $this->config['vk_version'] : '',
			'VKBB_WALL_P'				=> isset($this->config['vkbb_wall_p']) ? $this->config['vkbb_wall_p'] : '',
			'VKBB_WALL_ON'				=> isset($this->config['vkbb_wall_on']) ? $this->config['vkbb_wall_on'] : '',
			'S_QC_LIST'			=> true,
			'TOTAL_POSTWALL'		=>  $this->user->lang('TOTAL_POSTWALL', (int) $total_postwall),
			'PAGE_NUMBER'        => $pagination->on_page($total_postwall, $per_page, $start),
			'U_EDIT_ACTION'		=> $this->u_action,
			'U_ADD_QUOTE'		=> $this->u_action . '&amp;action=add_quote',
			'U_ACTION'				=> $this->u_action,
		));
		switch ($action)
				{
					
					case 'add_quote';
						$this->page_title = 'POSTWALL_ADD';
						$this->tpl_name = 'acp_wall';
						$form_action = $this->u_action. '&amp;action=add_new';
						$lang_mode = $user->lang['POSTWALL_ADD'];
						
						$action = ((isset($_POST['submit']) && !$_POST['id']) ? 'add_new' : $action );

					
						$id			= $this->request->variable('id', 0);
						$name		= $this->request->variable('name', '', true);
						$element_id		= $this->request->variable('element_id', '', true);
						$owner_id		= $this->request->variable('owner_id', '', true);
						$post_id		= $this->request->variable('post_id', '', true);
						$hash		= $this->request->variable('hash', '', true);
						$display = $this->request->variable('display', 0);
						
						$template->assign_vars(array(
							'S_QC_ADD'	=> true,
							'S_QC_LIST'	=> false,
							'ID'		=> $id,
							'NAME'		=> $name,
							'ELEMENT_ID'	=> $element_id,
							'OWNER_ID'	=> $owner_id,
							'POST_ID'		=> $post_id,
							'HASH'	=> $hash,
							'DISPLAY' => $display,

							'U_BACK'			=> $this->u_action,
							'U_ACTION'			=> $form_action,
							'L_MODE_TITLE'		=> $lang_mode,
						));
					break;

					case 'add_new':
						
						$id			= $this->request->variable('id', 0);
						$name		= $this->request->variable('name', '', true);
						$element_id		= $this->request->variable('element_id', '', true);
						$owner_id		= $this->request->variable('owner_id', '', true);
						$post_id		= $this->request->variable('post_id', '', true);
						$hash		= $this->request->variable('hash', '', true);
						$display = $this->request->variable('display', 0);
						
						$sql_ary_add = array(
							'name'	=> $name,
							'element_id' => $element_id,
							'owner_id' => $owner_id,
							'post_id' => $post_id,
							'hash' => $hash,
							'display' => $display,
						);

						$db->sql_query('INSERT INTO ' . $vk_postwall_table .' ' . $db->sql_build_array('INSERT', $sql_ary_add));
						trigger_error($user->lang['POSTWALL_ADDS'] . adm_back_link($this->u_action));

					break;

					
					case 'edit':
						$this->page_title = 'POSTWALL_EDIT';
						$this->tpl_name = 'acp_wall';
						$form_action = $this->u_action. '&amp;action=update';
						$lang_mode = $user->lang['POSTWALL_EDIT'];

						$action = ((isset($_POST['submit']) && !$_POST['id']) ? 'update' : $action );

						$id = $request->variable('id', '');

						$sql = 'SELECT *
							FROM ' . $vk_postwall_table . '
							WHERE id = ' . $id;
						$result = $db->sql_query_limit($sql,1);
						$row = $db->sql_fetchrow($result);
						$db->sql_freeresult($result);

						$template->assign_vars(array(
							'S_QC_EDIT'	=> true,
							'S_QC_LIST'	=> false,
							'ID'		=> $row['id'],
							'NAME'		=> $row['name'],
							'ELEMENT_ID'	=> $row['element_id'],
							'OWNER_ID'		=> $row['owner_id'],
							'POST_ID'		=> $row['post_id'],
							'HASH'		=> $row['hash'],
							'DISPLAY'		=> ($row['display'] == '1') ? 'checked="checked"' : '',
							)
						);

						$template->assign_vars(array(
							'U_ACTION'		=> $form_action,
							'L_MODE_TITLE'	=> $lang_mode,
							)
						);
					break;

				
					case 'update':
						$name		= $request->variable('name', '', true);
						$element_id		= $request->variable('element_id', '', true);
						$owner_id		= $request->variable('owner_id', '', true);
						$post_id		= $request->variable('post_id', '', true);
						$hash		= $request->variable('hash', '', true);
						$display = $request->variable('display', 0);

						$sql_ary = array(
							'name'	=> $name,
							'element_id' => $element_id,
							'owner_id' => $owner_id,
							'post_id' => $post_id,
							'hash' => $hash,
							'display' => $display,
						);

						
						
						$db->sql_query('UPDATE ' . $vk_postwall_table . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE id = ' . $id);
						trigger_error($user->lang['POSTWALL_UPD'] . adm_back_link($this->u_action));
						
					break;

					case 'delete':
						if (confirm_box(true))
						{
							$sql = 'DELETE FROM ' . $vk_postwall_table . '
								WHERE id = '. $id;
							$db->sql_query($sql);
							trigger_error($user->lang['POSTWALL_DELL'] . adm_back_link($this->u_action));
						}
						else
						{
							confirm_box(false, $user->lang['REALY_POSTWALL_DELL'], build_hidden_fields(array(
								'id'		=> $id,
								'action'	=> 'delete',
								))
							);
						}
						redirect($this->u_action);
					break;
				}
	}
}

?>