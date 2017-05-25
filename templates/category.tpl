{include file="{$prefix}header.tpl" title="HomePage" bodyid="dashboard"}
{include file="{$prefix}nav.tpl" currentnav="category"}
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
               
               
                    location.href = "category.php?action=modify&id="+id;
                
            }
            
           
            function deleteImage(id){
			 if(confirm("Are you sure you want to delete this category?") == true)
                {
                    location.href = "category.php?action=delete&id="+id;
				 
			}
			}
</script>
<div class="body"></br>
	<h2 class="heading2">Edit Category</h2>
	<div id="div_seperate" class="div_seperate"></div>
	<div id="div_user_edit" class="user_edit">
		<div >
			<form action="category.php?action=create" name="category" id="category"  method="post" enctype="multipart/form-data">
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
                        <p >Category Name*:<input type="text" name="title" value="{$category_name}" class="input_data_question" style="margin-left:5px;" placeholder="Enter Category Name ."/>
                        </br></br></br></br></br></br></br></br></br></br>{$mode}:<input type="submit" class="submit_question" ></p>
                    </li>
                </ul>
						
				</div>
                
			</form>
		</div>	
        
	</div>
	<h2 class="heading2">Category Table</h2>
	<div id="div_seperate" class="div_seperate"></div>
	
		<div id="div_tbl_user" class="div_tbl_user">
			<table id="category" class="stats" border="1" border-spacing="1px"  >
					<tbody style="width:100%;">
					<tr class="statshead">
						<td style="width:100px;">
							Cover Image
						</td>
						
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
					{foreach from=$categories item="data"}
						<tr class="statsrow">
						<td>
							<img id="imgIcon" src="{$data['coverimage']}" class="category_icon" style="width:100px;height:100px" />
						</td>
							<td>
								<TEXTAREA NAME="category_name"  COLS=100 ROWS=5 disabled class="textarea_none">{$data['category_name']}</TEXTAREA> 
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
