<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
	<title>{if $title}{$title}{else}Lotto project{/if}</title>
	<link rel="stylesheet" href="/resources/css/style.css" type="text/css" />
	<script type="text/javascript" src="/resources/js/jquery.js"></script>
	<script type="text/javascript" src="/resources/js/common.js"></script>
</head>

<body>

	<div class="pre_header">
		<dl class="menu">
			<li><a href="/" title="Home">Home</a></li>
			<li> | </li>
			<li><a href="/Euromillions/Index/">Euro Millions</a></li>
		</dl>
	</div>
	<div class="header">
		<div id="logo" style="padding: 15px 15px 0 20px;">
			<a href="/" title="home">
				<img src="http://icons.resources.jackbrandmagic.co.uk/flavour/emote_biggrin.png" alt="Logo" />
				<br />
				Lotto project
			</a>
		</div>

		<div class="login">

			<form action="/User/Login/" method="post">
				<table>

					<tr>
						<th>Username</th>
						<td>
							<input class="username" name="username" type="text" />
						</td>
					</tr>

					<tr>
						<th>Password</th>
						<td>
							<input class="password" name="password" type="password" />
						</td>
					</tr>

					<tr>
						<th>&nbsp;</th>

						<td>

							<input class="button" value="Login" type="submit" />
						</td>
					</tr>

				</table>
			</form>

		</div>

		<div style="clear: both;"></div>

	</div>

	<div class="breadcrumb">
		<dl>
			<li><a href="/" title="Index page">Home</a></li>
			<li>&gt;</li>
			<li><a href="#" title="">Lorem</a></li>
			<li>&gt;</li>
			<li><a href="#" title="">Ipsum</a></li>
		</dl>
	</div>

	<div class="user_notification" id="user_notification" title="User Notification" style="display: none;">
		<img src="/resources/images/action_stop.gif" onClick="$('#user_notification').fadeOut('slow')" class="close_icon" />
		<div id="user_notification_message">{$user_notification}</div>
	</div>

	<div class="content">{$content}</div>

	
	<div class="footer">[ Generated in: {$generated}s, db queries: <span onclick="$('#query_debug').show('fast');">{$entity_query|@count}] </span>
	</div>
	
	{if $entity_query}
	<div id="query_debug" style="display: none; position: fixed; bottom: 0; left: 0; padding: 5px; border: 1px solid gray; background-color: silver;">
		<span onclick="$('#query_debug').hide('fast')">Close</span>
		<ol style="">
			{foreach from=$entity_query item=query}
			<li style="font-size: 11px;background-color: mistyrose; margin: 5px 0; padding: 3px;">{$query}</li>
			{/foreach}
		</ol>
	</div>
	{/if}

</body>
</html>
