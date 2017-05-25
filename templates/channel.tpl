{include file="{$prefix}header.tpl" title="HomePage" bodyid="dashboard"}
{include file="{$prefix}nav.tpl" currentnav="channel"}
{config_load file="ads_en.conf"}
<script>
	function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
                continue;
            }           
            var img=document.getElementById("thumbnil");            
            img.file = file;  
			  
            var reader = new FileReader();
			
            reader.onload = (function(aImg) {
			
                return function(e) { 
				
                    aImg.src = e.target.result; 
                }; 
				
            })(img);
			
            reader.readAsDataURL(file);
        }  
		
    }		
    
	
                    
           
           
             function modify(id)
            {
               
               
                    location.href = "channel.php?action=modify&id="+id;
                
            }
            
           
            function deleteImage(id){
			 if(confirm("Are you sure you want to delete this channel?") == true)
                {
                    location.href = "channel.php?action=delete&id="+id;
				 
			}
			}
</script>
<div class="body"></br>
	<h2 class="heading2">Edit Channel</h2>
	<div id="div_seperate" class="div_seperate"></div>
	<div id="div_user_edit" class="user_edit">
		<div>
			<form action="channel.php?action=create" name="channel" id="channel" method="post" enctype="multipart/form-data">
            </br>
				<input type="hidden"name="mode"value="{$mode}"/>
                <input type="hidden" value="{$title_id}" name="title_id"/>
                <div class="video_edit_form">
                    <ul >
                        <li >
                            <img id="thumbnil" class="category_icon" style="width:329px;height:185px;" src="{$coverimage}" alt="image"/>            	
                            <p>Choose Image*:<input type="file"  id="fname" name="imagefile" accept="image/*" onchange="showMyImage(this);"style="color:#ddd;"/></p> 
                            </li>
                        <li style="margin-left:50px;"> 
                            <p >Channel Name*:<input type="text" id="title" name="title" value="{$channel_name}" class="input_data_question" style="margin-left:5px;" placeholder="Enter Channel Name ."/>
                            </br></br></br></br></br></br></br></br></br></br>{$mode}:<input type="submit" class="submit_question" onClick="check();"></p>
                        </li>
                    </ul>
                            
				</div>
                
			</form>
		</div>	
		
	</div>
	<h2 class="heading2">Channel Table</h2>
	<div id="div_seperate" class="div_seperate"></div>
	
		<div id="div_tbl_user" class="div_tbl_user">
			<table id="channel" class="stats" border="1" border-spacing="1px"  >
					<tbody style="width:100%;">
					<tr class="statshead">
						<td style="width:100px;">
							Cover Image
						</td>
						
						<td style="width:800px;">
							Name
						</td>
                        <td>
                           Totoal
                           </td>
                        <td>
                           Create
                        </td>
						<td>
							Edit
						</td>				
						
						<td>
							Delete
						</td>
						
											
					</tr>
					{foreach from=$channels item="data"}
						<tr class="statsrow">
						<td>
							<img id="imgIcon" src="{$data['coverimage']}" class="channel_icon" style="width:100px;height:100px" />
						</td>
							<td>
								<TEXTAREA NAME="category_name"  COLS=100 ROWS=5 disabled class="textarea_none">{$data['channel_name']}</TEXTAREA> 
							</td>
                            <td >
								{$data['channel_view_count']}
							</td>
							<td >
								{$data['date']}
							</td>
							<td>
							    
						      <a href="javascript: modify({$data['id']});" class="view">edit</a>
							<td>
								<a href="javascript:deleteImage({$data['id']});"class="view">delete</a>
							</td>
							
						</tr>
					{/foreach}
					</tbody>
						
				</table>
              
                
		</div>
         
        
		
	
</div>
 
{include file="{$prefix}footer.tpl"}
