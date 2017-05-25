<!-- header -->
<div class="header">
	
	<ul>
		<li style="width:80px;"{if $currentnav=="homepage"} class="selected" {/if}>	<a href="./home.php">Home</a></li>
		<li style="width:80px;"{if $currentnav=="users"} class="selected" {/if}><a href="./users.php">Users</a></li>
		<li style="width:80px;"{if $currentnav=="videos"} class="selected" {/if}> <a href="./videos.php">Video</a></li>
        <li style="width:150px;"{if $currentnav=="search"} class="selected" {/if}> <a href="./searchtag.php">SearchTag</a></li>
        <li style="width:150px;"{if $currentnav=="category"} class="selected" {/if}> <a href="./category.php">Category</a></li>
		<li style="width:120px;"{if $currentnav=="channel"} class="selected" {/if}> <a href="./channel.php">Channel</a></li>
         <li style="width:60px;"{if $currentnav=="type"} class="selected" {/if}> <a href="./type.php">Type</a></li>
         <li style="width:100px;"{if $currentnav=="admin"} class="selected" {/if}> <a href="./admin.php">Admin</a></li>
         
        <li style="width:80px;"{if $currentnav=="logout"} class="selected" {/if}> <a href="./logout.php">logout</a></li>
			
	</ul>
</div>