{include file="{$prefix}header.tpl" title="HomePage" bodyid="dashboard"}
{include file="{$prefix}nav.tpl" currentnav="homepage"}
{config_load file="ads_en.conf"}
<!-- content -->
<script>
$(window).load(function(){
    location.href = "#openModal";
});
</script>
<div class="body">
    <div class="featured">
    <h1>ACTION FUGURE</h1>
    </div>
    <p class="who">Today!Do you know who winner is?...I think that .........
    </p>
    <div id="openModal" class="modalDialog">
		
									
		<div >
				<form  action="{$prefix}login.php?action=login" method="post" style="margin-left:45px;"  > 
				    </br>
                    <p> 
                        <label for="username" class="uname" data-icon="u" style="font-size:1em;color:black;">Username:</label>
                        <input id="username" name="username" value=""required="required" type="text" placeholder="Username"/>
                    </p>
                    <p> 
                        <label for="password" class="youpasswd" data-icon="p"style="font-size:1em;color:black;">Password : </label>
                        <input id="password" name="password" required="required"value="" type="password" placeholder="Password" /> 
                    </p>
                    
                    <p class="keeplogin"style="font-size:0.8em;color:#606061;"> 
                        <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
                        <label for="loginkeeping">Keep me logged in</label>
                    </p>
                   
                    <p > 
                        <input class="btn" type="submit" value="Login" /> 
                    </p>
                    </br>
			</form>								
			
					
											
		</div>
							
	</div>
</div>
{include file="{$prefix}footer.tpl"}

