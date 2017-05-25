{include file="{$prefix}header.tpl" title="HomePage" bodyid="dashboard"}
{include file="{$prefix}nav.tpl" currentnav="users"}
{config_load file="ads_en.conf"}
<script>
	function userEdit(id){
		     
			location.href="users.php?action=mode&user_id="+id;
		
	}
    function getChannelId(){
             var channel_id=$('select#video_channel').val();
                          if(channel_id==''){
                            alert("Please choose channel!");
                            return;
                            
                         }else if($('#username').val()==''){
                            alert("Please Enter Username!");
                            return;
                            
                         }else if($('#password').val()==''){
                            alert("Please Enter Password!");
                            return;
                            
                         }else if($('#email').val()==''){
                            alert("Please Enter Email!");
                            return;
                            
                         }
             document.user_info_form.user_channel_in.value=channel_id;
             document.user_info_form.submit();    
      }
      
	function userDelete(id){
		 if(confirm("Are you sure you want to delete this user?") == true){
			location.href="users.php?action=user_delete&user_id="+id;
		}else{
			return;
		}
	}
</script>
<div class="body">
</br>
	<h2 class="heading2">edit user</h2>
	<div id="div_seperate" class="div_seperate"></div>
	<div id="div_user_edit" class="user_edit">
		<div class="div_form">
			<form action="users.php?action=user_info&user_id={$user_id}" name="user_info_form" id="user_info_form" class="user_info" method="post" enctype="multipart/form-data">
				<input type="hidden"name="mode"value="{$mode}"/>
                <input type="hidden" name="channel" id="user_channel_in" value=""/>
				<p style="margin-left:20px;">Username:<input type="text" id="username" name="username" value="{$username}" style="margin-right:100px;"class="input_data" placeholder="Enter Username"/>
				Email:<input type="email" id="email" name="email" value="{$email}" class="input_data" style="margin-right:20px;"placeholder="Enter Email:example@mail.com"/>
				Choose Channel:
                    <select id="video_channel" class="input_data_question">
					<option value="{$selectedchannel_id}" Selected>{$selectedchannel}</option>
						{foreach from=$channels item="data"}
							<option value='{$data['id']}'>{$data['channel_name']}</option>							
						{/foreach}						
					</select></br></br>
				Password:<input type="password" id="password" name="password" style="margin-right:6px;"value="{$password}" class="input_data" placeholder="Enter Password:*********"/>
				Confirm Password:<input type="password" id="conf_password" name="conf_password" value="{$password}" class="input_data" style="margin-right:115px;"placeholder="Enter Confirm Password:*********"/>
				
				<input id="btnsave" type="button" class="submit" value="{$mode}"onclick="getChannelId();"/></p>
			</form>
		</div>	
	</div>
	<h2 class="heading2">Users Data</h2>
	<div id="div_seperate" class="div_seperate"></div>
	
		<div id="div_tbl_user" class="div_tbl_user">
			<table id="users" class="stats" border="1" border-spacing="1px"  >
					<tbody style="width:100%;">
					<tr class="statshead">
						
						<td style="width:1000px;">
							String ID
						</td>
                        <td style="width:1000px;">
							Username
						</td>
						<td style="width:1000px;">
							Email
						</td>
						<td style="width:1000px;">
							Password
						</td>
                        <td style="width:1000px;">
							Channel
						</td>
                        <td style="width:500px;">
                            Create
                        </td>
						<td style="width:150px;">
							Edit
						</td>
						
						<td style="width:150px;">
							Delete
						</td>
						
											
					</tr>
					{foreach from=$users item="data"}
						<tr class="statsrow">
                        <td>
								{$data['string_id']}
							</td>
							<td>
								{$data['username']}
							</td>
							<td>
								{$data['email']}
							</td>
							<td>
								{$data['password']}
							</td>
                            <td>
								{$data['channel_name']}
							</td>
                            <td>
                                {$data['date']}
                            </td>
							<td>
								<a href="javascript: userEdit({$data['user_id']});"class="view">edit</a>
							</td>
							
							<td>
								<a href="javascript:userDelete({$data['user_id']});"class="view">delete</a>
							</td>
							
						</tr>
					{/foreach}
					</tbody>
						
				</table>
		</div>
	
</div>
{include file="{$prefix}footer.tpl"}

