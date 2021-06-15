<?php

/**
*
* @package VKWigets
* @copyright (c) 2021 DeaDRoMeO ; hello-vitebsk.ru
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace deadromeo\vkfull\event;

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
    exit;
}

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	protected $auth;
	protected $config;
	protected $db;
	protected $user;
	protected $template;
	protected $request;
	protected $phpbb_root_path;
	protected $vk_postwall_table;
	protected $vk_poll_table;

	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\user $user, \phpbb\template\template $template, \phpbb\request\request $request, $phpbb_root_path, $vk_postwall_table, $vk_poll_table)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->db = $db;
		$this->user = $user;
		$this->template = $template;
		$this->request = $request;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->vk_postwall_table = $vk_postwall_table;
		$this->vk_poll_table = $vk_poll_table;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.index_modify_page_title' 			=> 'display_index',
			'core.page_header' 						=> 'display_all',	
			'core.viewtopic_modify_page_title' 		=> 'display_viewtopic',
			'core.user_setup'						=> 'load_language_on_setup',
			'core.memberlist_view_profile'			=> 'memberlist',
			'core.viewforum_modify_topicrow'		=> 'dispcom',
			'core.search_modify_tpl_ary'			=> 'dispcoms',
			'core.permissions'						=> 'add_permisions',
			'core.viewtopic_modify_post_row'		=> 'viewtopic_text',
		);
	}
	
	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'deadromeo/vkfull',
			'lang_set' => 'vkfull',
		);
		$event['lang_set_ext'] = $lang_set_ext;
		if ($vkbb_poll_on == true)
		{
			$sql3 = 'SELECT id, poll_id
				FROM ' . $this->vk_poll_table . '
				WHERE display != 0
				ORDER by id';
			$result3 = $this->db->sql_query($sql3);
			while ($row3 = $this->db->sql_fetchrow($result3))
			{
				$this->template->assign_block_vars('poll', array(
					'ID'			=> $row3['id'],
					'POLL_ID'			=> $row3['poll_id'],	
				));
			}
		}
	}

	public function display_all($event)
	{
			$this->template->assign_vars(array(
			'VKBB_DISPLAY'			=> $this->config['vkbb_on'],
			'VK_ID'					=> $this->config['vk_id'],
			'VKBB_SAVE_ON'			=> $this->config['vkbb_save_on'],
			'VKBB_SAVE_P'			=> $this->config['vkbb_save_p'],
			'VKBB_SAVE_L'			=> $this->config['vkbb_save_l'],
			'SAVE_TEXT'				=> htmlspecialchars_decode($this->config['save_text']),
			'SAVE_STYLE'			=> $this->config['save_style'],
			'VKBB_SAVE_LT'			=> $this->config['vkbb_save_lt'],
			'S_DISPLAY_WALL'		=> $this->auth->acl_get('u_viewwall'),
			'S_DISPLAY_POLL'		=> $this->auth->acl_get('u_viewpoll'),
			'S_DISPLAY_SOC'			=> $this->auth->acl_get('u_viewsoc'),
			'S_DISPLAY_USERS'		=> $this->auth->acl_get('u_viewusers'),
			'S_DISPLAY_COM'			=> $this->auth->acl_get('u_viewcom'),
			'S_DISPLAY_TOPCOM'		=> $this->auth->acl_get('u_viewtopcom'),
			'S_DISPLAY_TOPLIK'		=> $this->auth->acl_get('u_viewtoplik'),
			'S_DISPLAY_REC'			=> $this->auth->acl_get('u_viewrec'),
		));
	}	
	
	public function display_viewtopic($event)
	{
		$this->template->assign_vars(array(
			'GLOB_ID'					=> $this->user->data['user_id'],
			'VKBB_LIKE_DISPLAY'			=> $this->config['vkbb_like_on'],
			'VKBB_LIKE_H'				=> $this->config['vkbb_like_h'],
			'VKBB_LIKE_T'				=> $this->config['vkbb_like_t'],
			'VKBB_LIKE_F'				=> $this->config['vkbb_like_f'],
			'VKBB_COM_ON'				=> $this->config['vkbb_com_on'],
			'VKBB_COM_H'				=> $this->config['vkbb_com_h'],
			'VKBB_COM_K'				=> $this->config['vkbb_com_k'],
		));
	}

	public function add_permisions($event)
	{
		$permissions = $event['permissions'];
		$permissions['u_viewtopcom'] = array('lang' => 'ACL_U_VIEWTOPCOM', 'cat' => 'misc');
		$permissions['u_viewtoplik'] = array('lang' => 'ACL_U_VIEWTOPLIK', 'cat' => 'misc');
		$permissions['u_viewwall'] = array('lang' => 'ACL_U_VIEWWALL', 'cat' => 'misc');
		$permissions['u_viewpoll'] = array('lang' => 'ACL_U_VIEWPOLL', 'cat' => 'misc');
		$permissions['u_viewcom'] = array('lang' => 'ACL_U_VIEWCOM', 'cat' => 'misc');
		$permissions['u_viewusers'] = array('lang' => 'ACL_U_VIEWUSERS', 'cat' => 'misc');
		$permissions['u_viewsoc'] = array('lang' => 'ACL_U_VIEWSOC', 'cat' => 'misc');
		$permissions['u_viewrec'] = array('lang' => 'ACL_U_VIEWREC', 'cat' => 'misc');
		$event['permissions'] = $permissions;
	}

	public function memberlist($event)
	{	
		$vk_token = $this->config['vk_token'];
		$member = $event['member'];
		$user_id = (int) $member['user_id'];
		$sql = 'SELECT pf_vkbb_profile, user_id
			FROM ' . PROFILE_FIELDS_DATA_TABLE . '
			WHERE user_id = ' . $user_id . '';	
		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);
		$params = array('user_id' => $row['pf_vkbb_profile'], 'access_token' => $vk_token, 'v' => '5.126', 'order' => 'random', 'count' => '5', 'fields' => 'photo_50,city,country');
		$link_s = 'https://api.vk.com/method/friends.get';
		$vk_info_m = $this->get_comm($link_s, $params);
		for ($i = 0; $i < 5; $i++)
		{
			$vk_ids1 = !empty($vk_info_m['response']['items'][$i]['id']) ? $vk_info_m['response']['items'][$i]['id'] : '';
			$vk_firstname = !empty($vk_info_m['response']['items'][$i]['first_name']) ? $vk_info_m['response']['items'][$i]['first_name'] : $this->user->lang['NOT'];
			$vk_lastname = !empty($vk_info_m['response']['items'][$i]['last_name']) ? $vk_info_m['response']['items'][$i]['last_name'] : '';
			$vk_city = !empty($vk_info_m['response']['items'][$i]['city']['title']) ? $vk_info_m['response']['items'][$i]['city']['title'] : '';
			$vk_country = !empty($vk_info_m['response']['items'][$i]['country']['title']) ? $vk_info_m['response']['items'][$i]['country']['title'] : '';
			if (!empty($vk_info_m['response']['items'][$i]))
			{
				$vk_photo1 = '<img id="vk_img_prof" src="' . $vk_info_m['response']['items'][$i]['photo_50'] . '" />';
			}
			else
			{
				$vk_photo1 = '<img id="vk_img_prof" src="./ext/deadromeo/vkfull/images/not.png" />';
			}
			$this->template->assign_block_vars('vkwigets_m', array(
				'VK_IDS'			=> $vk_ids1,
				'VK_FIRSTNAME'		=> $vk_firstname,
				'VK_LASTNAME'		=> $vk_lastname,
				'VK_CITY'			=> $vk_city,
				'VK_CCITY'			=> $vk_country,
				'VK_PHOTO'			=> $vk_photo1,
			));
		}
			
		$params4 = array('user_id' => $row['pf_vkbb_profile'],'access_token' => $vk_token, 'v' => '5.126', 'count' => '5', 'fields' => 'photo_50,city,country',);
		$link_s4 = 'https://api.vk.com/method/users.getFollowers';
		$vk_info_fol = $this->get_comm($link_s4, $params4);
		for ($n = 0; $n < 5; $n++)
		{
			$vk_ids1 = !empty($vk_info_fol['response']['items'][$n]['id']) ? $vk_info_fol['response']['items'][$n]['id'] : '';
			$vk_firstname = !empty($vk_info_fol['response']['items'][$n]['first_name']) ? $vk_info_fol['response']['items'][$n]['first_name'] : $this->user->lang['NOT_FOLLO'];
			$vk_lastname = !empty($vk_info_fol['response']['items'][$n]['last_name']) ? $vk_info_fol['response']['items'][$n]['last_name'] : '';
			$vk_city = !empty($vk_info_fol['response']['items'][$n]['city']['title']) ? $vk_info_fol['response']['items'][$n]['city']['title'] : '';
			$vk_country = !empty($vk_info_fol['response']['items'][$n]['country']['title']) ? $vk_info_fol['response']['items'][$n]['country']['title'] : '';
			if (!empty($vk_info_fol['response']['items'][$n]))
			{
				$vk_photo1 = '<img id="vk_img_prof" src="' . $vk_info_fol['response']['items'][$n]['photo_50'] . '" />';
			}
			else
			{
				$vk_photo1 = '<img id="vk_img_prof" src="./ext/deadromeo/vkfull/images/not.png" />';
			}
			$this->template->assign_block_vars('vkwigets_fol', array(
				'VK_IDS'			=> $vk_ids1,
				'VK_FIRSTNAME'		=> $vk_firstname,
				'VK_LASTNAME'		=> $vk_lastname,
				'VK_CITY'			=> $vk_city,
				'VK_CCITY'			=> $vk_country,
				'VK_PHOTO'			=> $vk_photo1,
			));
		}	
	
		$params1 = array('user_id' => $row['pf_vkbb_profile'], 'access_token' => $vk_token, 'v' => '5.126', 'extended' => '1', 'count' => '5', 'fields' => 'photo_50',);
		$link_s1 = 'https://api.vk.com/method/users.getSubscriptions';
		$vk_info_g = $this->get_comm($link_s1, $params1);
		for ($k = 0; $k < 5; $k++)
		{
			$vk_ids = !empty($vk_info_g['response']['items'][$k]['id']) ? $vk_info_g['response']['items'][$k]['id'] : '';
			$vk_grname = !empty($vk_info_g['response']['items'][$k]['name']) ? $vk_info_g['response']['items'][$k]['name'] : $this->user->lang['NOT2'];
			if (!empty($vk_info_g['response']['items'][$k]))
			{
				$vk_photo = '<img id="vk_img_prof" src="' . $vk_info_g['response']['items'][$k]['photo_50'] . '" />';
			}
			else
			{
				$vk_photo = '<img id="vk_img_prof" src="./ext/deadromeo/vkfull/images/not.png" />';
			}
			$this->template->assign_block_vars('vkwigets_g', array(
				'VK_IDS'		=> $vk_ids,
				'VK_GRNAME'		=> $vk_grname,
				'VK_PHOTO'		=> $vk_photo,
			));
		}
		$params3 = array('user_ids' => $row['pf_vkbb_profile'], 'access_token' => $vk_token, 'v' => '5.126', 'fields' => 'status, counters',);
		$link_s3 = 'https://api.vk.com/method/users.get';
		$vk_stat = $this->get_comm($link_s3, $params3);
		$vk_status	=	!empty($vk_stat['response'][0]['status']) ?$vk_stat['response'][0]['status'] : $this->user->lang['NOTSTAT'];
		$alb = !empty($vk_stat['response'][0]['counters']['albums']) ? $vk_stat['response'][0]['counters']['albums'] : $this->user->lang['VK_STAT_NO'];
		$vid = !empty($vk_stat['response'][0]['counters']['videos']) ? $vk_stat['response'][0]['counters']['videos'] : $this->user->lang['VK_STAT_NO'];
		$aud = !empty($vk_stat['response'][0]['counters']['audios']) ? $vk_stat['response'][0]['counters']['audios'] : $this->user->lang['VK_STAT_NO'];
		$phot = !empty($vk_stat['response'][0]['counters']['photos']) ? $vk_stat['response'][0]['counters']['photos'] : $this->user->lang['VK_STAT_NO'];
		$fren = !empty($vk_info_m['response']['count']) ? $vk_info_m['response']['count'] : $this->user->lang['VK_STAT_NO'];
		$group = !empty($vk_stat['response'][0]['counters']['groups']) ? $vk_stat['response'][0]['counters']['groups'] : $this->user->lang['VK_STAT_NO'];
		$folll = !empty($vk_stat['response'][0]['counters']['followers']) ? $vk_stat['response'][0]['counters']['followers'] : $this->user->lang['VK_STAT_NO'];
		$subs = !empty($vk_stat['response'][0]['counters']['subscriptions']) ? $vk_stat['response'][0]['counters']['subscriptions'] : $this->user->lang['VK_STAT_NO'];
		$page = !empty($vk_info_g['response']['count']) ? $vk_info_g['response']['count'] : $this->user->lang['VK_STAT_NO'];
		
		$this->template->assign_vars(array(
			'GR'				=> $vk_info_g['response']['count'],
			'FR'				=> $vk_info_m['response']['count'],
			'FOL'				=> $vk_info_fol['response']['count'],
			'VK_STATUS'			=> $vk_status,
			'VK_ALB'			=> $alb,
			'VK_VID'			=> $vid,
			'VK_AUD'			=> $aud,
			'VK_PHOT'			=> $phot,
			'VK_FREN'			=> $fren,
			'VK_GROUP'			=> $group,
			'VK_FOLLL'			=> $folll,
			'VK_SUBS'			=> $subs,
			'VK_PAGE'			=> $page,
		));			
	}
	
	public function dispcom($event)
	{				
		$row = $event['row'];
		$topic_id = $row['topic_id'];
		$forum_id = $row['forum_id'];
		$vk_id 	= $this->config['vk_id'];
		$vk_token = $this->config['vk_token'];
		$vkbb_com_on = $this->config['vkbb_com_on'];
		$topic_row = $event['topic_row'];
		$board_url = generate_board_url();
		if($vkbb_com_on == true)
		{
			$params = array('widget_api_id' => $vk_id, 'access_token' => $vk_token, 'page_id' => $topic_id, 'v' => '5.126');
			$link_s = 'https://api.vk.com/method/widgets.getComments';
			$vk_com_t = $this->get_comm($link_s, $params);
			if (empty($vk_com_t['response']))
				{
					$vk_com_tt = ' / <a id="vk_com_t" title="' . $this->user->lang['VK_COM_T'] . '" href="./viewtopic.php?' . $forum_id . '&t=' . $topic_id . '#vk_com_t">0</a>';
				}
				else
				{
					$vk_com_tt = ' / <a id="vk_com_t" title="' . $this->user->lang['VK_COM_T'] . '" href="./viewtopic.php?' . $forum_id . '&t=' . $topic_id . '#vk_com_t">' . $vk_com_t['response']['count'] . '</a>';
				}
		}
		else
		{
			$vk_com_tt ='';
		}

		$topic_row['REPLIES'] .= '' . $vk_com_tt . '';
		$event['topic_row'] = $topic_row;
	}
	
	public function dispcoms($event)
	{
		$row = $event['row'];
		$topic_id = $row['topic_id'];
		$forum_id = $row['forum_id'];
		$vk_id 	= $this->config['vk_id'];
		$vk_token = $this->config['vk_token'];
		$tpl_ary = $event['tpl_ary'];
		$board_url = generate_board_url();
		$params = array('widget_api_id' => $vk_id, 'access_token' => $vk_token, 'page_id' => $topic_id, 'v' => '5.126');
		$link_s = 'https://api.vk.com/method/widgets.getComments';
		$vk_com_t = $this->get_comm($link_s, $params);
		if (empty($vk_com_t['response']))
			{
				$vk_com_tt = ' / <a id="vk_com_t" title="' . $this->user->lang['VK_COM_T'] . '" href="./viewtopic.php?' . $forum_id . '&t=' . $topic_id . '#vk_com_t">0</a>';
			}
			else
			{
				$vk_com_tt = ' / <a id="vk_com_t" title="' . $this->user->lang['VK_COM_T'] . '" href="./viewtopic.php?' . $forum_id . '&t=' . $topic_id . '#vk_com_t">' . $vk_com_t['response']['count'] . '</a>';
			}
		$tpl_ary['TOPIC_REPLIES'] .= '' . $vk_com_tt . '';
		$event['tpl_ary'] = $tpl_ary;
	}

	public function display_index($event)
	{
		$vkbb_users_on = $this->config['vkbb_users_on'];
		$vk_id = $this->config['vk_id'];
		$vk_token = $this->config['vk_token'];
		$vkbb_top_d_l = $this->config['vkbb_top_d_l'];
		$vkbb_top_k_l = $this->config['vkbb_top_k_l'];
		$vkbb_top_d_c = $this->config['vkbb_top_d_c'];
		$vkbb_top_k_c = $this->config['vkbb_top_k_c'];
		$vkbb_top_on_c = $this->config['vkbb_top_on_c'];
		$vkbb_top_on_l = $this->config['vkbb_top_on_l'];
		$vkbb_poll_on	= $this->config['vkbb_poll_on'];
		$vkbb_wall_on = $this->config['vkbb_wall_on'];

		if ($vkbb_users_on == true) 
		{
			$sql = 'SELECT pf_vkbb_profile
				FROM ' . PROFILE_FIELDS_DATA_TABLE . '
				WHERE pf_vkbb_profile !=0
				ORDER BY RAND() LIMIT 5';	
			$result = $this->db->sql_query($sql);
			$ids_vk ='';
			while($row = $this->db->sql_fetchrow($result))
			{
				$ids_vk .= '' . $row['pf_vkbb_profile'] . ',';
			}
			//$ids_vk = substr($ids_vk, 0, -2);
			$params = array('user_ids' => $ids_vk, 'access_token' => $vk_token, 'v' => '5.126', 'fields' => 'photo_50');
			$link_s = 'https://api.vk.com/method/users.get';
			$vk_info = $this->get_comm($link_s, $params);
			for ($i = 0; $i <5 ; $i++)
			{				
				$firstname = !empty($vk_info['response'][$i]['first_name']) ? $vk_info['response'][$i]['first_name'] : $this->user->lang['NOT_USERS'];
				$lastname = !empty($vk_info['response'][$i]['last_name']) ? $vk_info['response'][$i]['last_name'] : '';
				$photo = !empty($vk_info['response'][$i]) ? $vk_info['response'][$i]['photo_50'] : './ext/deadromeo/vkfull/images/not.png';
				$this->template->assign_block_vars('vkwigets', array(
					'VK_FIRSTNAME'		=> $firstname,
					'VK_LASTNAME'		=> $lastname,
					'VK_PHOTO'			=> '<img src="' . $photo . '" />',
				));	
			}
		}

		if ($vkbb_top_on_c == true)
			{
				$params1 = array('widget_api_id' => $vk_id, 'access_token' => $vk_token, 'order' => 'comments', 'period' => $vkbb_top_d_c, 'count' => $vkbb_top_k_c, 'v' => '5.126');
				$link_s1 = 'https://api.vk.com/method/widgets.getPages';
				$vk_top_c = $this->get_comm($link_s1, $params1);
				for ($a = 0; $a <= $vkbb_top_k_c, !empty($vk_top_c['response']['pages'][$a]['comments']['count']); $a++) 
					{
						if (empty($vk_top_c['response']['pages'][$a]['id'])) 
							{
								$top_title_c = '';
								$top_url_c = '';
								$top_comments = '';
							}
							else
							{
								$top_title_c = $vk_top_c['response']['pages'][$a]['title'];
								$top_title_c = preg_replace('/\\\u0([0-9a-fA-F]{3})/', '&#x\1;', $top_title_c);
								$top_url_c = $vk_top_c['response']['pages'][$a]['url'];
								$top_comments = $vk_top_c['response']['pages'][$a]['comments']['count'];
							}
						$this->template->assign_block_vars('top_c', array(
							'TOP_TITLE_C'		=> $top_title_c,
							'TOP_URL_C'			=> $top_url_c,
							'TOP_COMMENTS'		=> $top_comments,
						));	
					}
			}
		if ($vkbb_top_on_l == true)
			{
				$params2 = array('widget_api_id' => $vk_id, 'access_token' => $vk_token, 'order' => 'likes', 'period' => $vkbb_top_d_l, 'count' => $vkbb_top_k_l, 'v' => '5.126');
				 $link_s2 = 'https://api.vk.com/method/widgets.getPages';
				$vk_top_l = $this->get_comm($link_s2, $params2);
				for ($b = 0; $b <= $vkbb_top_k_l,  !empty($vk_top_l['response']['pages'][$b]['likes']['count']) ; $b++)
					{
						if (empty($vk_top_l['response']['pages'][$b]['id']))
							{
								$top_title_l = '';
								$top_url_l = '';
								$top_likes = '';
							}
							else
							{
								$top_title_l = $vk_top_l['response']['pages'][$b]['title'];
								$top_title_l = preg_replace('/\\\u0([0-9a-fA-F]{3})/', '&#x\1;', $top_title_l);
								$top_url_l = $vk_top_l['response']['pages'][$b]['url'];
								$top_likes = $vk_top_l['response']['pages'][$b]['likes']['count'];
							}
						$this->template->assign_block_vars('top_l', array(
							'TOP_TITLE_L'		=> $top_title_l,
							'TOP_URL_L'			=> $top_url_l,
							'TOP_LIKES'			=> $top_likes,
						));	
					}
			}
		if ($vkbb_wall_on == true)
		{
			$sql2 = 'SELECT id, element_id, owner_id, post_id, hash
				FROM ' . $this->vk_postwall_table . '
				WHERE display != 0
				ORDER by id';
			$result2 = $this->db->sql_query($sql2);
			while ($row2 = $this->db->sql_fetchrow($result2))
			{
				$this->template->assign_block_vars('postwall', array(
					'ID'			=> $row2['id'],
					'ELEMENT_ID'			=> $row2['element_id'],
					'OWNER_ID'			=> $row2['owner_id'],
					'POST_ID'			=> $row2['post_id'],
					'HASH'			=> $row2['hash'],			
				));
			}
		}
		if ($vkbb_poll_on == true)
		{
			$sql3 = 'SELECT id, poll_id
				FROM ' . $this->vk_poll_table . '
				WHERE display != 0
				ORDER by id';
			$result3 = $this->db->sql_query($sql3);
			while ($row3 = $this->db->sql_fetchrow($result3))
			{
				$this->template->assign_block_vars('poll', array(
					'ID'			=> $row3['id'],
					'POLL_ID'			=> $row3['poll_id'],	
				));
			}
		}
		$this->template->assign_vars(array(
			'VKBB_REC_ON'				=> $this->config['vkbb_rec_on'],
			'VKBB_REC_P'				=> $this->config['vkbb_rec_p'],
			'VKBB_REC_MP'				=> $this->config['vkbb_rec_mp'],
			'VKBB_REC_MPM'				=> $this->config['vkbb_rec_mpm'],
			'VKBB_REC_PER'				=> $this->config['vkbb_rec_per'],
			'VKBB_REC_VER'				=> $this->config['vkbb_rec_ver'],
			'VKBB_REC_TARG'				=> $this->config['vkbb_rec_targ'],
			'VKBB_LIKE_DISPLAY'			=> $this->config['vkbb_like_on'],
			'VKBB_SOC_ON'				=> $this->config['vkbb_soc_on'],
			'VKBB_SOC_P'				=> $this->config['vkbb_soc_p'],
			'VKBB_SOC_ID'				=> $this->config['vkbb_soc_id'],
			'VKBB_SOC_H'				=> $this->config['vkbb_soc_h'],
			'VKBB_SOC_M'				=> $this->config['vkbb_soc_m'],
			'VKBB_SOC_MW'				=> $this->config['vkbb_soc_mw'],
			'VKBB_SOC_C_A'				=> $this->config['vkbb_soc_c_a'],
			'VKBB_SOC_C_B'				=> $this->config['vkbb_soc_c_b'],
			'VKBB_SOC_C_C'				=> $this->config['vkbb_soc_c_c'],
			'VKBB_COM_ON'				=> $this->config['vkbb_com_on'],
			'VKBB_POLL_ON'				=> $this->config['vkbb_poll_on'],
			'VKBB_WALL_ON'				=> $this->config['vkbb_wall_on'],
			'VKBB_POLL_P'				=> $this->config['vkbb_poll_p'],
			'VKBB_WALL_P'				=> $this->config['vkbb_wall_p'],
			'VKBB_COM_H'				=> $this->config['vkbb_com_h'],
			'VKBB_COM_K'				=> $this->config['vkbb_com_k'],
			'VKBB_USERS_ON'				=> $this->config['vkbb_users_on'],
			'VKBB_USERS_P'				=> $this->config['vkbb_users_p'],
			'VKBB_COM_ON_I'				=> $this->config['vkbb_com_on_i'],
			'VKBB_COM_I_P'				=> $this->config['vkbb_com_i_p'],
			'VKBB_TOP_ON_C'				=> $this->config['vkbb_top_on_c'],
			'VKBB_TOP_P_C'				=> $this->config['vkbb_top_p_c'],
			'VKBB_TOP_ON_L'				=> $this->config['vkbb_top_on_l'],
			'VKBB_TOP_P_L'				=> $this->config['vkbb_top_p_l'],
		));
	}
	
	private function buildBaseString($baseURI, $method, $params) 
	{
		$r = array();
		ksort($params);
		foreach($params as $key=>$value)
		{
			$r[] = "$key=" . rawurlencode($value);
		}
		return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
	}

	private function buildAuthorizationHeader($oauth)
	{
		$r = 'Authorization: OAuth ';
		$values = array();
		foreach($oauth as $key=>$value)
        $values[] = "$key=\"" . rawurlencode($value) . "\"";
		$r .= implode(', ', $values);
		return $r;
	}

	public function viewtopic_text($event)
	{
		$row = $event['row'];
			
			$post_row = $event['post_row'];
			$post_id = $row['post_id'];
			
			$post_row = array_merge($post_row, array(
				
				'MESS'		=> mb_substr($this->strip_code($row['post_text']), 0, 150) . '...',
				'TW_MESS'		=> mb_substr($this->strip_code($row['post_text']), 0, 50) . '...',
			));
			$event['post_row'] = $post_row;
	}
	
	function strip_code($text)
	{
		$text = censor_text($text);
		strip_bbcode($text);
		$text = str_replace(array("&quot;", "/", "\n", "\t", "\r"), ' ', $text);
		$text = preg_replace(array("|http(.*)jpg|isU", "@(http(s)?://)?(([a-z0-9.-]+)?[a-z0-9-]+(!?\.[a-z]{2,4}))@"), ' ', $text);
		return preg_replace("/[^A-ZА-ЯЁ.,-–?]+/ui", " ", $text);
	}
	private function get_comm($link_s, $params)
	{
		$curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $link_s);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
		curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,5);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);
		return json_decode($result, true);
	}
	
	private function get_comm2($link_s)
	{
		$curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $link_s);
		curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,5);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);
		return json_decode($result, true);
	}
}