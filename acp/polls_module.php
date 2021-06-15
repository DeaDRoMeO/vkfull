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
class polls_module
{
	protected $config;
	protected $request;
	protected $template;
	protected $user;
	protected $pagination;
	var $u_action;

	function main($id, $mode)
	{
		global $config, $db, $request, $template, $user, $pagination, $u_action, $phpbb_container;

		$this->config = $config;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->pagination = $pagination;
		$vk_poll_table = $phpbb_container->getParameter('deadromeo.vkfull.table.vk_poll');
		$this->user->add_lang('acp/common');
		$this->tpl_name = 'acp_polls';
		$this->page_title = $this->user->lang('VK_POLL');
		$action = $request->variable('action', '');
		$id		= $request->variable('id', 0);
		
		if ($this->request->is_set_post('submit3'))
		{
			$vkbb_poll_on = $this->request->variable('vkbb_poll_on', 0);
			$this->config->set('vkbb_poll_on', $vkbb_poll_on);
			$vkbb_poll_p = $this->request->variable('vkbb_poll_p', 0);
			$this->config->set('vkbb_poll_p', $vkbb_poll_p);
		
			trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
		}
		$start = $this->request->variable('start', 0);
				$total_poll    = 0;
				$per_page        = 10;
				$sql = 'SELECT COUNT(id) AS total_poll
					FROM ' . $vk_poll_table;
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$total_poll = $row['total_poll'];
				$db->sql_freeresult($result);
				$pagination_url = $this->u_action;
				$pagination = $phpbb_container->get('pagination');
				$pagination->generate_template_pagination($pagination_url, 'pagination', 'start', $total_poll, $per_page, $start);
			
				$sql = 'SELECT id, name, display
					FROM ' . $vk_poll_table . '
					ORDER by id';
				$result = $db->sql_query_limit($sql, $per_page, $start);

				while ($row = $db->sql_fetchrow($result))
				{
					$template->assign_block_vars('poll', array(
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
			'TOTAL_POLL'		=>  $this->user->lang('TOTAL_POLL', (int) $total_poll),
			'PAGE_NUMBER'        => $pagination->on_page($total_poll, $per_page, $start),
			'VKBB_POLL_P'				=> isset($this->config['vkbb_poll_p']) ? $this->config['vkbb_poll_p'] : '',
			'VKBB_POLL_ON'				=> isset($this->config['vkbb_poll_on']) ? $this->config['vkbb_poll_on'] : '',
			'S_QC_LIST'			=> true,
			'U_EDIT_ACTION'		=> $this->u_action,
			'U_ADD_QUOTE'		=> $this->u_action . '&amp;action=add_quote',
			'U_ACTION'				=> $this->u_action,
		));
		
		switch ($action)
				{
					
					case 'add_quote';
						$this->page_title = 'POLL_ADD';
						$this->tpl_name = 'acp_polls';
						$form_action = $this->u_action. '&amp;action=add_new';
						$lang_mode = $user->lang['POLL_ADD'];
						
						$action = ((isset($_POST['submit']) && !$_POST['id']) ? 'add_new' : $action );

					
						$id			= $this->request->variable('id', 0);
						$name		= $this->request->variable('name', '', true);
						$poll_id		= $this->request->variable('poll_id', '', true);
						$display = $request->variable('display', 0);
												
						$template->assign_vars(array(
							'S_QC_ADD'	=> true,
							'S_QC_LIST'	=> false,
							'ID'		=> $id,
							'NAME'		=> $name,
							'POLL_ID'	=> $poll_id,
							'DISPLAY' => $display,
							
							'U_BACK'			=> $this->u_action,
							'U_ACTION'			=> $form_action,
							'L_MODE_TITLE'		=> $lang_mode,
						));
					break;

					case 'add_new':
						
						$id			= $this->request->variable('id', 0);
						$name		= $this->request->variable('name', '', true);
						$poll_id		= $this->request->variable('poll_id', '', true);
						$display = $request->variable('display', 0);
												
						$sql_ary_add = array(
							'name'	=> $name,
							'poll_id' => $poll_id,
							'display' => $display,
						);

						$db->sql_query('INSERT INTO ' . $vk_poll_table .' ' . $db->sql_build_array('INSERT', $sql_ary_add));
						trigger_error($user->lang['POLL_ADDS'] . adm_back_link($this->u_action));

					break;

					
					case 'edit':
						$this->page_title = 'POLL_EDIT';
						$this->tpl_name = 'acp_polls';
						$form_action = $this->u_action. '&amp;action=update';
						$lang_mode = $user->lang['POLL_EDIT'];

						$action = ((isset($_POST['submit']) && !$_POST['id']) ? 'update' : $action );

						$id = $request->variable('id', '');

						$sql = 'SELECT *
							FROM ' . $vk_poll_table . '
							WHERE id = ' . $id;
						$result = $db->sql_query_limit($sql,1);
						$row = $db->sql_fetchrow($result);
						$db->sql_freeresult($result);

						$template->assign_vars(array(
							'S_QC_EDIT'	=> true,
							'S_QC_LIST'	=> false,
							'ID'		=> $row['id'],
							'NAME'		=> $row['name'],
							'POLL_ID'	=> $row['poll_id'],
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
						$poll_id		= $request->variable('poll_id', '', true);
						$display = $request->variable('display', 0);
						
						$sql_ary = array(
							'name'	=> $name,
							'poll_id' => $poll_id,
							'display' => $display,
						);
			
						$db->sql_query('UPDATE ' . $vk_poll_table . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE id = ' . $id);
						trigger_error($user->lang['POLL_UPD'] . adm_back_link($this->u_action));
						
					break;

					case 'delete':
						if (confirm_box(true))
						{
							$sql = 'DELETE FROM ' . $vk_poll_table . '
								WHERE id = '. $id;
							$db->sql_query($sql);
							trigger_error($user->lang['POLL_DELL'] . adm_back_link($this->u_action));
						}
						else
						{
							confirm_box(false, $user->lang['REALY_POLL_DELL'], build_hidden_fields(array(
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