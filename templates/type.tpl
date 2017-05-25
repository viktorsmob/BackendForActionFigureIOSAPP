{include file="{$prefix}header.tpl" title="HomePage" bodyid="dashboard"}
{include file="{$prefix}nav.tpl" currentnav="type"}
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
               
               
                    location.href = "type.php?action=modify&id="+id;
                
            }
            
           
            function deleteImage(id){
			 if(confirm("Are you sure you want to delete this type?") == true)
                {
                    location.href = "type.php?action=delete&id="+id;
				 
			}
			}
</script>
<div class="body"></br>
	<h2 class="heading2">Edit Type</h2>
	<div id="div_seperate" class="div_seperate"></div>
	<div id="div_user_edit" class="user_edit">
		<div class="div_form">
			<form action="type.php?action=create" name="type" id="type" class="points_detail" method="post" enctype="multipart/form-data">
            </br>
				<input type="hidden"name="mode"value="{$mode}"/>
                <input type="hidden" value="{$title_id}" name="title_id"/>
				<p style="text-align:center;">Type Name*:<input type="text" id="title" name="title" value="{$type_name}" class="input_data_question" style="margin-left:5px;margin-right:20px;" placeholder="Enter Type Name ."/>
                {$mode}:<input type="submit" class="submit_question" ></p>
			</form>
		</div>	
        
	</div>
	<h2 class="heading2">Type Table</h2>
	<div id="div_seperate" class="div_seperate"></div>
	
		<div id="div_tbl_user" class="div_tbl_user">
			<table id="type" class="stats" border="1" border-spacing="1px"  >
					<tbody style="width:100%;">
					<tr class="statshead">
						
						
						<td style="width:800px;">
							Name
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
					{foreach from=$types item="data"}
						<tr class="statsrow">
						
							<td>
								{$data['name']}
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

