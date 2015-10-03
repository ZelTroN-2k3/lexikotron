<h2>{$title}</h2>

{if $alphabet|@count}
<div class="glossary-alphabet">
	<ul>
	{foreach from=$alphabet item=char}
		<li><a href="{$link->getModuleLink('lexikotron', 'lexipage')}?k={$char}" title="{$char}">{$char}</a></li>
	{/foreach}
	</ul>
</div>
{/if}

<div id="glossary-list">
	<dl>
	{foreach from=$glossaries item=glossary}
		<dt>{$glossary.name}</dt>
		<dd>{$glossary.description}</dd>
	{/foreach}
	</dl>
</div>

{if $alphabet|@count}
<div class="glossary-alphabet">
	<ul>
	{foreach from=$alphabet item=char}
		<li><a href="{$link->getModuleLink('lexikotron', 'lexipage')}?k={$char}" title="{$char}">{$char}</a></li>
	{/foreach}
	</ul>
</div>
{/if}