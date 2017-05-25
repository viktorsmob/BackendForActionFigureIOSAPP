{include file="{$prefix}header.tpl" title="HomePage" bodyid="dashboard"}
{include file="{$prefix}nav_user.tpl" currentnav="videos"}
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
   
   
   
   
    function showMyVideo(fileInput){
        var file = fileInput.files[0];
            var videoNode = document.querySelector('video');
            var fileURL = URL.createObjectURL(file);
            videoNode.src = fileURL;
        
    }
    
	    
        
        
        
        function onSaveClicked(mode)
            {
			             var category_id = $('select#video_category').val();
                         if(category_id==''){
                            alert("Please choose category!");
                            return;
                           
                         }
                          
                         var video_type_id=$('#video_type_in').val();
                          if(video_type_id==''){
                            alert("Please choose video type!");
                            return;
                            
                         }
                          document.video_title_form.category_in.value=category_id;
                          
                         
                          
                         
			if(mode=='0'){
				
				
				 if(appDetailsCheck()){
				if($('#fname')[0].value!=""&&$('#vfname')[0].value!=""){
						
					document.video_title_form.submit();
					}else{
					alert("Please choose the image or video file!");
                    return;
					}
				}else
					alert("Please insert title or description");
                    return;
											
				}
				else{
				
				
				document.video_title_form.submit();
				
				
				}
			}
           
           function getVideoTypeId(id){
                if (document.getElementById(id).checked) {
                     var video_type_id=$('select#video_type').val();
                     document.video_title_form.video_type_in.value=video_type_id;
                    }
           } 
        
        
        
            function appDetailsCheck()
            {
                if(document.video_title_form.title.value == "")
                {
                   
                    return false;
                }
               
                else if(document.video_title_form.description.value== "")
                {
                    
                    return false;
                }
                return true;
            }         
          
          
          
          
          
          
             function modify(id)
            {
               
               
                    location.href = "videos_user.php?action=modify&id="+id;
                
            }
            
            function getVideokindId(id){
                                           
                     document.video_title_form.video_kind_in.value=id;
                    
           } 
           
            function deleteImage(id){
			 if(confirm("Are you sure you want to delete this video?") == true)
                {
                    location.href = "videos_user.php?action=delete&id="+id;
				 
			}
			}
            
           function maxlength(element, maxvalue)
                {
                var e = document.getElementById(element);
                var q=e.value.length;
                var r = q - maxvalue;
                var msg = "Sorry, you have input "+q+" characters into the "+
                "description box you just completed. It can return no more than "+
                maxvalue+" characters to be processed. Please abbreviate "+
                "your text by at least "+r+" characters";
                if (q > maxvalue) alert(msg);
                }
      
     
           
</script>
<div class="body">
    </br>
    <h2 class="heading2">Edit Video ({$channel_name})</h2>
    <div id="div_seperate" class="div_seperate"></div>
    <div id="div_user_video" class="video_edit">
        <div class="div_form">
           <form action="{$prefix}videos_user.php?action=create" name="video_title_form" method="post" id = "video_title_form" enctype="multipart/form-data">
            <input type="hidden" name="mode" id="mode" value="{$mode}"/>
            <input type="hidden" name="category" id="category_in" value=""/>
            <input type="hidden" name="kind" id="video_kind_in" value="none"/>
            <input type="hidden" name="video_type" id="video_type_in" value=""/>
            <input type="hidden" value="{$title_id}" name="title_id"/>
            <div class="video_edit_form">
	
            <ul>
                <li >
                    <img id="thumbnil" class="category_icon" style="width:329px;height:185px;" src="{$coverimage}" alt="image"/></br>
                     <p>Choose Image*:<input type="file"  id="fname" name="imagefile" accept="image/*" onchange="showMyImage(this);"style="color:#ddd;"/></p> 
                    </li>
                <li style="margin-left:10px;" > 
                    <video id="videoplayer" width="400" height="185" style="border: 1px solid #00d9ff;"controls autoplay>
                        <source src="{$videourl}" type="video/mp4">
                    </video></br>
                     <p>Choose Video*:<input type='file' id="vfname" name='videofile' onchange="showMyVideo(this);" style="color:#ddd;"/></p>
                </li>
                <li style="margin-left:30px;" > 
                 <div style="height:200px;">
                    <p>Video Title*</br><input type="text" name="title" value="{$title}" class="input_data_question" placeholder="Enter Video Title ."/></br></br>
                    Choose Category*</br>
                    <select id="video_category" class="input_data_question">
					<option value="{$selectedcategory_id}" Selected>{$selectedcategory}</option>
						{foreach from=$categories item="data"}
							<option value='{$data['id']}'>{$data['category_name']}</option>							
						{/foreach}						
					</select></br></br>
                     Video Description</br>
                    <TEXTAREA NAME="description" id="description"COLS=40 ROWS=5 placeholder="Enter Short Description of Video" class="input_data_question" onchange="maxlength('description', 200);">{$video_description}</TEXTAREA></br>
                    <input type="radio" id="recent" name="video_kind" value="recent" onchange="getVideokindId('recent');" />recent
                        <input type="radio" id="popular" name="video_kind" value="popular" onchange="getVideokindId('popular');" />popular
                        <input type="radio" id="featured" name="video_kind" value="featured" onchange="getVideokindId('featured');"/>featured
                        <input type="radio" id="playlist" name="video_kind" value="playlist" onchange="getVideokindId('playlist');" />playlist
                        <input type="radio" id="none" name="video_kind" value="none" checked="checked"onchange="getVideokindId('none');" />none</br>
                    </p>
                    </div>      
                 </li>
                <li style="margin-left:10px;">
               
                <div class="div_video_type" >
                    {foreach from=$types item="data"}
                      <p >  <input type="radio" id="{$data['id']}" name="video_type" value="{$data['id']}"  onchange="getVideoTypeId({$data['id']});"/>{$data['name']}</p>					
                    {/foreach}
                </div>
                
                </li>
                    
            </ul>
        </div>
        <div id="div_seperate" class="div_seperate"></div></br>
            <input type="button"onclick="onSaveClicked({$mode});" id = "btnsave" style="margin-left:650px;"class="submit" value="{if $mode == '0'}Add{else}Save{/if}"/>
           </form>
           </div>
         </div>
        <h2 class="heading2">Video Table ({$channel_name})</h2>
		<div id="div_seperate" class="div_seperate"></div></br>
		 
       <div id="div_tbl_video" class="div_tbl_video">  
   
            <table id="videos" class="stats" border="1" border-spacing="1px"  >
                    <tbody style="width:100%;">
                    <tr class="statshead">
                        <td width="5%">
                            Cover Image
                        </td>
                        <td width="10%">
                        
                            Title
                        </td>
                                        
                        
                        <td width="5%">
                            Type 
                        </td>
                        <td width="5%">
                            Category 
                        </td>
                        <td width="5%">
                            Kind
                        </td>
                        <td width="20%">
                            URL
                        </td>
                        
                        <td width="20%">
                            Description
                        </td>
                        <td width="5%">
                            View Count
                        </td>				
                        <td width="10%">
                            Upload Date
                        </td>
                                        
                        <td class="delete"width="5%">
                            Edit
                        </td>
                        <td class="delete"width="5%">
                            Delete
                        </td>
                    </tr>
                    {foreach from=$videos item="data"}
                        <tr class="statsrow">
                            <td width="5%">
                                <img id="imgIcon" src="{$data['coverimage']}" class="category_icon" style="width:100px;height:100px"/>
                            </td>
                            <td width="10%" height="100">
                               <TEXTAREA NAME="description" value="{$video_description}" COLS=20 ROWS=5 disabled class="textarea_none">{$data['title']}</TEXTAREA> 
                            </td>
                                                    
                            
                            <td width="5%" height="100">
                               <TEXTAREA NAME="description" value="{$video_description}" COLS=8 ROWS=5 disabled class="textarea_none">  {$data['name']}</TEXTAREA>
                            </td>
                            <td width="5%" height="100">
                                <TEXTAREA NAME="description" value="{$video_description}" COLS=8 ROWS=5 disabled class="textarea_none"> {$data['category_name']}</TEXTAREA>
                            </td>
                            <td width="5%" height="100">
                                <TEXTAREA NAME="description" value="{$video_description}" COLS=8 ROWS=5 disabled class="textarea_none"> {$data['kind']}</TEXTAREA>
                            </td>
                            <td width="20%" height="100">
                                {$data['video_url']}
                            </td>
                            <td width="20%" height="100">
                                <TEXTAREA NAME="description" value="{$video_description}" COLS=30 ROWS=5 disabled class="textarea_none">{$data['description']}</TEXTAREA>
                            </td>
                            <td width="5%" height="100">
                                {$data['view_count']}
                            </td>
                            
                            <td width="10%">
                                {$data['upload_date']}
                            </td>
                                        
                                                            
                            <td class="delete"width="5%">
                                <a href="javascript: modify({$data['id']});" class="view">edit</a>
                            </td>
                            <td class="delete"width="5%">
                                <a href="javascript: deleteImage({$data['id']});" class="view">delete</a>
                            </td>
                        </tr>
                    {/foreach}
                    </tbody>
            </table>
        </div>
    </div>
 </div>
 {include file="{$prefix}footer.tpl"}
		
		
       



