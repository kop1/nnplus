<h1>{$page->title}</h1>

<div style="float:right;">

	<form name="ragesearch" action="" method="get">
		<label for="title">Search:</label>
		&nbsp;&nbsp;<input id="title" type="text" name="title" value="{$ragename}" size="25" />
		&nbsp;&nbsp;
		<input type="submit" value="Go" />
	</form>
</div>

<p><b>Jump to</b>:
&nbsp;&nbsp;[ {if $seriesletter == '0-9'}<b><u>{/if}<a href="{$smarty.const.WWW_TOP}/series/0-9">0-9</a>{if $seriesletter == '0-9'}</u></b>{/if} 
{foreach $seriesrange as $range}
{if $range == $seriesletter}<b><u>{/if}<a href="{$smarty.const.WWW_TOP}/series/{$range}">{$range}</a>{if $range == $seriesletter}</u></b>{/if} 
{/foreach}]
</p>

{$site->adbrowse}	

{if $serieslist|@count > 0}

<table style="width:100%;" class="data highlight icons" id="browsetable">
	{foreach $serieslist as $sletter => $series}
		<tr>
			<td style="padding-top:15px;" colspan="10"><a href="#top" class="top_link">Top</a><h2>{$sletter}...</h2></td>
		</tr>
		<tr>
			<th width="35%">Name</th>
			<th>Country</th>
			<th width="35%">Genre</th>
			<th>Last Episode</th>
			<th>View</th>
		</tr>
		{foreach $series as $s}
			<tr class="{cycle values=",alt"}">
				<td><a class="title" title="View series" href="{$smarty.const.WWW_TOP}/series/{$s.rageID}">{$s.releasetitle|escape:"htmlall"}</a>{if $s.prevdate != ''}<br />Last: {$s.previnfo|escape:"htmlall"} aired {$s.prevdate|date_format}{/if}</td>
				<td>{$s.country|escape:"htmlall"}</td>
				<td>{$s.genre|escape:"htmlall"|replace:'|':', '}</td>
				<td><a title="{$s.prevdate}" href="{$smarty.const.WWW_TOP}/series/{$s.rageID}#latest">{$s.prevdate|date_format}</a></td>
				<td><a title="View series" href="{$smarty.const.WWW_TOP}/series/{$s.rageID}">Series</a>&nbsp;&nbsp;{if $s.rageID > 0}<a title="View at TVRage" target="_blank" href="{$site->dereferrer_link}http://www.tvrage.com/shows/id-{$s.rageID}">TVRage</a>{/if}</td>
			</tr>
		{/foreach}
	{/foreach}
</table>

{else}
<h2>No results</h2>
{/if}
