<!DOCTYPE HTML>
<html>
<head>
	<title>Getting Real-Time with Pusher - Nettuts+ Demo</title>
	<script src="http://js.pusherapp.com/1.9/pusher.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script>
	var username;
	var pusher;
	var nettuts_channel;
	var has_chat = false;
	function ajaxCall(ajax_url, ajax_data, successCallback) {
		$.ajax({
			type : "POST",
			url : ajax_url,
			dataType : "json",
			data: ajax_data,
			time : 10,
			success : function(msg) {
				if( msg.success ) {
					successCallback(msg);
				} else {
					alert(msg.errormsg);
				}
			},
			error: function(msg) {
			}
		});
	}
	
	function updateOnlineCount() {
		$('#chat_widget_counter').html($('.chat_widget_member').length);
	}
	
	function newMessageCallback(data) {
		if( has_chat == false ) { //if the user doesn't have chat messages in the div yet
			$('#chat_widget_messages').html(''); //remove the contents i.e. 'chat messages go here'
			has_chat = true; //and set it so it won't go inside this if-statement again
		}
		
		$('#chat_widget_messages').append(data.message + '<br />');
	}
	
	$(document).ready(function() {
		$('#chat_widget_login_button').click(function() {
			$('#chat_widget_login_button').hide(); //hide the login button
			$('#chat_widget_login_loader').show(); //show the loader gif
			username = $('#chat_widget_username').val(); //get the username
			username = username.replace(/[^a-z0-9]/gi, ''); //filter it
			if( username == '' ) { //if blank, then alert the user
				alert('Please provide a valid username (alphanumeric only)');
			} else { //else, login our user via start_session.php
				ajaxCall('start_session.php', { username : username }, function() {
					pusher = new Pusher('12c4f4771a7f75100398'); //APP KEY
					Pusher.channel_auth_endpoint = 'pusher_auth.php'; //override the channel_auth_endpoint
					nettuts_channel = pusher.subscribe('presence-nettuts'); //join the presence-nettuts channel
					
					pusher.connection.bind('connected', function() {
						$('#chat_widget_login_loader').hide(); //hide the loading gif
						$('#chat_widget_login_button').show(); //show the login button again
						
						$('#chat_widget_login').hide(); //hide the login screen
						$('#chat_widget_main_container').show(); //show the chat screen
						
						//here, we bind to the pusher:subscription_succeeded event, which is called whenever you
						//successfully subscribe to a channel
						nettuts_channel.bind('pusher:subscription_succeeded', function(members) {
							//this makes a list of all the online clients and sets the online list html
							//it also updates the online count
							var whosonline_html = '';
							members.each(function(member) {
								whosonline_html += '<li class="chat_widget_member" id="chat_widget_member_' + 
								member.id + '">' + member.info.username + '</li>';
							});
							$('#chat_widget_online_list').html(whosonline_html);
							updateOnlineCount();
						});
						
						//here we bind to the pusher:member_added event, which tells us whenever someone else
						//successfully subscribes to the channel
						nettuts_channel.bind('pusher:member_added', function(member) {
							//this appends the new connected client's name to the online list
							//and updates the online count as well
							$('#chat_widget_online_list').append('<li class="chat_widget_member" ' +
							'id="chat_widget_member_' + member.id + '">' + member.info.username + '</li>');
							updateOnlineCount();
						});
						
						//here, we bind to pusher:member_removed event, which tells us whenever someone
						//unsubscribes or disconnects from the channel
						nettuts_channel.bind('pusher:member_removed', function(member) {
							//this removes the client from the online list and updates the online count
							$('#chat_widget_member_' + member.id).remove();
							updateOnlineCount();
						});	
						
						nettuts_channel.bind('new_message', function(data) {
							newMessageCallback(data);
						});
					});
				});
			}
		});
		
		$('#chat_widget_form').submit(function() {
			var message = $('#chat_widget_input').val(); //get the value from the text input
			$('#chat_widget_button').hide(); //hide the chat button
			$('#chat_widget_loader').show(); //show the chat loader gif
			ajaxCall('send_message.php', { message : message }, function(msg) { //make an ajax call to send_message.php
				$('#chat_widget_input').val(''); //clear the text input
				$('#chat_widget_loader').hide(); //hide the loader gif
				$('#chat_widget_button').show(); //show the chat button
				newMessageCallback(msg.data); //display the message with the newMessageCallback function
			});
			return false;
		});
	});
	</script>
	<style>
		#chat_widget_container {
			padding: 20px 20px 5px 20px;
			background-color: #F2F2F2;
			border: 5px solid #AFAFAF;
			border-bottom: 0px;
			width: 733px;
			font-size: 11px;
			font-family: "Lucida Grande", Arial, Helvetica, sans-serif;
			position: fixed;
			bottom: 0px;
			right: 20px;
		}
		
		#chat_widget_login {
			width: 733px;
			text-align: center;
			height: 166px;
			margin-top: 80px;
		}
		
		#chat_widget_main_container {
			display: none;
		}
		
		#chat_widget_messages_container { 
			float: left;
			width: 600px;
			border: 1px solid #DDD;
			height: 200px;
			overflow: auto;
			padding: 5px;
			background-color: #FFF;
			position: relative;
		}
		
		#chat_widget_messages {
			overflow-x: hidden;
			overflow-y: auto;
			position: absolute;
			bottom: 0px;
		}
		
		#chat_widget_online {
			width: 100px;
			height: 210px;
			float: left;
			padding: 0px 10px;
			border: 1px solid #DDD;
			border-left: 0px;
			background-color: #FFF;
			overflow: auto;
		}
		
		#chat_widget_online_list {
			list-style: none;
			padding: 0px;
		}
		
		#chat_widget_online_list > li {
			margin-left: 0px;
		}
		
		#chat_widget_input_container {
			margin-top: 10px;
			text-align: left;
		}
		
		#chat_widget_input {
			width: 660px;
			margin-right: 10px;
			border: 1px solid #DDD;
			padding: 2px 5px;
		}
		#chat_widget_loader { display: none; }
		#chat_widget_login_loader { display: none; }
		.clear { clear: both; }
	</style>
</head>
<body>
	<div id="chat_widget_container">
		<div id="chat_widget_login">
			<label for="chat_widget_username">Name:</label>
			<input type="text" id="chat_widget_username" />
			<input type="button" value="Login!" id="chat_widget_login_button" /><img src="loading.gif" alt="Logging in..." id="chat_widget_login_loader" />
		</div>
		
		<div id="chat_widget_main_container">
			<div id="chat_widget_messages_container">
				<div id="chat_widget_messages">
					chat messages go here
				</div>
			</div>
			<div id="chat_widget_online">
				<p>Who's Online (<span id="chat_widget_counter">0</span>)</p>
				<ul id="chat_widget_online_list">
					<li>online users go here</li>
				</ul>
			</div>
			<div class="clear"></div>
			<div id="chat_widget_input_container">
				<form method="post" id="chat_widget_form">
					<input type="text" id="chat_widget_input" /><input type="submit" value="Chat" id="chat_widget_button" /><img src="loading.gif" alt="Sending..." id="chat_widget_loader" />
				</form>
			</div>
		</div>
	</div>
</body>
</html>