<form>
	<table class="contentTable search-bar">
		<thead><tr><th>搜索</th></tr></thead>
		<tbody>
			<tr>
				<td><input type="text" name="name" value="<?=$this->config->user_item('search/name')?>" placeholder="名称" title="名称" /></td>
			</tr>
			<tr>
				<td>
					<select name="labels[]" class="chosen" data-placeholder="标签" title="输入多个标签，将采取“且”方式查找" multiple="multiple"><?=options($this->people->getAllLabels(),$this->config->user_item('search/labels'))?></select>
				</td>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="in_team" class="tagging" multiple="multiple" data-ajax="/team/match/" data-placeholder="团组" style="width:238px;" data-initselection='<?=json_encode($this->team->getArray(array('id_in'=>$this->config->user_item('search/in_team')),'name','id'))?>' value="<?=implode((array)$this->config->user_item('search/in_team'))?>" />
				</td>
			</tr>
			<tr>
				<td class="submit">
					<button type="submit" name="search" tabindex="0">搜索</button>
					<button type="submit" name="search_cancel" tabindex="1"<?if(!array_reduce($this->search_items, function($result, $item){return ($result || $this->config->user_item('search/'.$item));},false)){?> class="hidden"<?}?>>取消</button>
				</td>
			</tr>
		</tbody>
	</table>
</form>