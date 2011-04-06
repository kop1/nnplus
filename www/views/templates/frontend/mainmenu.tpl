{if $menulist|@count > 0} 
<li class="menu_main">
	<h2>Menu</h2> 
	<ul>
			{foreach from=$menulist item=menu}
			{strip}
				{assign var="var" value=$menu.menueval}	
				{eval var="$var," assign='menuevalresult'}
				{if $menuevalresult|replace:",":"1" == "1"}
					<li {strip}
					{if $menu.newwindow =="1"}
						onclick="window.open('{$menu.href}');return false;"
					{else}
						onclick="document.location='{$menu.href}';"
					{/if}{/strip}>
					<a {if $menu.newwindow =="1"}class="external" target="null"{/if} title="{$menu.tooltip}" href="{$menu.href}">{$menu.title}</a></li>
				{/if}
			{/strip}
			{/foreach}
	</ul>
</li>
{/if}