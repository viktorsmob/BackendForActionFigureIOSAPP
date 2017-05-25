{include file="{$prefix}header.tpl" title="HomePage" bodyid="dashboard"}
{include file="{$prefix}nav.tpl" currentnav="search"}
{config_load file="ads_en.conf"}
<script>

   
   
    
	function onSaveClicked(mode)
            {
			             
                          var video_id=$('select#video').val();
                          document.video_title_form.video_in.value=video_id;
                            if(appDetailsCheck()) 
                            {
                            document.video_title_form.submit();
                            }              
          
				return false;
				
			}
           
            
            function appDetailsCheck()
            {
                if(document.video_title_form.video_in.value == "")
                {
                    alert("Choose Video!");
                    return false;
                }
               
                else if(document.video_title_form.searchtag.value== "")
                {
                    alert("Enter search tag!");
                    return false;
                }
                return true;
            }         
             function modify(id)
            {
               
               
                    location.href = "searchtag.php?action=modify&id="+id;
                
            }
            
           
            function deleteImage(id){
			 if(confirm("Are you sure you want to delete this tag?") == true)
                {
                    location.href = "searchtag.php?action=delete&id="+id;
				 
			}
			}
           
</script>
<div class="body">
</br>
    <h2 class="heading2">Edit  Search tags</h2>
    <div id="div_seperate" class="div_seperate"></div>
    <div id="div_user_video" class="user_edit">
        <div class="div_form">
           <form action="{$prefix}searchtag.php?action=create" name="video_title_form" method="post" id = "video_title_form" enctype="multipart/form-data">
            <input type="hidden" name="mode" id="mode" value="{$mode}"/>
            <input type="hidden" name="video" id="video_in" value=""/>
            <input type="hidden" value="{$title_id}" name="title_id"/></br></br>
            	       
                   <p>Video:
					<select id="video" class="input_data_question">
					<option value="{$selectedvideo_id}" Selected>{$selectedvideo}</option>
						{foreach from=$videos item="data"}
							<option value='{$data['id']}'>{$data['title']}</option>							
						{/foreach}						
					</select>
                       Video Search Tag:<input type="text" name="searchtag" id="searchtag" value="{$tag_name}" class="input_data_question" style="margin-left:5px;" placeholder="Enter Video Search Tag ."/>
					           
					
                	<a href="javascript: onSaveClicked({$mode});" id = "btnsave" class="view" style="font-size:1.2em;margin-left:10px;">{if $mode == '0'}Add{else}Save{/if}</a></p>
           </form>
           </div>
         </div>
        <h2 class="heading2">Search Tag table</h2>
		<div id="div_seperate" class="div_seperate"></div></br>
		 
       <div id="div_tbl_video" class="div_tbl_video">  
   
            <table id="videos" class="stats" border="1" border-spacing="1px"  >
                    <tbody style="width:100%;">
                    <tr class="statshead">
                        
                        <td width="1000px">
                        
                            Video
                        </td>
                                        
                        
                        <td width="500px">
                            Tag Name 
                        </td>
                                                                
                        <td class="delete"width="300px">
                            Edit
                        </td>
                        <td class="delete"width="300px">
                            Delete
                        </td>
                    </tr>
                    {foreach from=$searchtags item="data"}
                        <tr class="statsrow">
                            <td>
                                {$data['title']}
                            </td>
                                                    
                            
                            <td >
                                {$data['tag_name']}
                            </td>
                                                        
                                                            
                            <td class="delete"width="5%">
                                <a href="javascript: modify({$data['id']});" class="view">edit</a>
                            </td>
                            <td class="delete"width="5%">
                                <a href="javascript: deleteImage({$data['id']});" class="view">Delete</a>
                            </td>
                        </tr>
                    {/foreach}
                    </tbody>
            </table>
        </div>
    </div>
 </div>
 {include file="{$prefix}footer.tpl"}
		
		
       



