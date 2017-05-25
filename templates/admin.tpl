{include file="{$prefix}header.tpl" title="HomePage" bodyid="dashboard"}
{include file="{$prefix}nav.tpl" currentnav="admin"}
{config_load file="ads_en.conf"}
<script>
	function adminEdit(id){
		
			location.href="admins.php?action=mode&admin_id="+id;
		
	}
   
	function adminDelete(id){
		 if(confirm("Are you sure you want to delete this admin?") == true){
			location.href="admin.php?action=delete&id="+id;
		}else{
			return;
		}
	}
</script>
<div class="body">
</br>
	<h2 class="heading2">edit admin</h2>
	<div id="div_seperate" class="div_seperate"></div>
	<div id="div_user_edit" class="user_edit">
		<div >
        
			<form action="admin.php?action=create" name="admin_info" id="admin_info"  method="post" enctype="multipart/form-data">
				<input type="hidden"name="mode"value="{$mode}"/>
                <input type="hidden" name="channel" id="channel_in" value=""/>
				<p style="text-align:center;">Admin:<input type="text" id="adminname" name="adminname" value="" class="input_data" placeholder="Enter Adminname"/>
				
			    Password:<input type="password" id="password" name="password" value="" class="input_data" placeholder="Enter Password:*********"/>
				Confirm Password:<input type="password" id="conf_password" name="conf_password" value="" class="input_data" placeholder="Enter Confirm Password:*********"/></br></br>
				<input id="btnsave" type="submit" class="submit" /></p>
			</form>
            
		</div>	
	</div>
	<h2 class="heading2">Admins Data</h2>
	<div id="div_seperate" class="div_seperate"></div>
	
		<div id="div_tbl_user" class="div_tbl_user">
			<table id="admins" class="stats" border="1" border-spacing="1px"  >
					<tbody style="width:100%;">
					<tr class="statshead">
						
						<td style="width:1000px;">
							Admin
						</td>
											
                        <td style="width:1000px;">
							Password
						</td>
                        <td style="width:500px;">
                            Create
                        </td>
												
						<td style="width:150px;">
							Delete
						</td>
						
											
					</tr>
					{foreach from=$admins item="data"}
						<tr class="statsrow">
                        
							<td>
								{$data['username']}
							</td>
							<td>
								{$data['password']}
							</td>
							
                            <td>
                                {$data['date']}
                            </td>
														
							<td>
								<a href="javascript:adminDelete({$data['admin_id']});"class="view">delete</a>
							</td>
							
						</tr>
					{/foreach}
					</tbody>
						
				</table>
		</div>
	
</div>
{include file="{$prefix}footer.tpl"}

