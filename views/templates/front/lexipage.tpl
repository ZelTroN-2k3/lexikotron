<h2>{$title}</h2>

<div id="glossaries-list">
	<dl>
	{foreach from=$glossaries item=glossary}
		<dt>{$glossary.name}</dt>
		<dd>{$glossary.description}</dd>
	{/foreach}
	</dl>
</div>