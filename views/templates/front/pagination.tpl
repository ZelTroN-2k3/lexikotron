{if $alphabet|@count}
<nav>
	<ul class="pagination">
	{foreach from=$alphabet item=char}
		{if $char == $current}
		<li class="active"><a href="#" title="{$char}">{$char}</a></li>
		{else}
		<li><a href="{$link->getModuleLink('lexikotron', 'lexipage')}?k={$char}" title="{$char}">{$char}</a></li>
		{/if}
	{/foreach}
	</ul>
</nav>
{/if}