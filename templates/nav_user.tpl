<!-- header -->
<div class="header">
	
	<ul>
		<li style="width:80px;"{if $currentnav=="homepage"} class="selected" {/if}>	<a href="./home_user.php">Home</a></li>
		
		<li style="width:80px;"{if $currentnav=="videos"} class="selected" {/if}> <a href="./videos_user.php">Video</a></li>
        <li style="width:150px;"{if $currentnav=="search"} class="selected" {/if}> <a href="./searchtag_user.php">SearchTag</a></li>
                        
        <li style="width:80px;"{if $currentnav=="logout"} class="selected" {/if}> <a href="./logout.php">logout</a></li>
			
	</ul>
</div>