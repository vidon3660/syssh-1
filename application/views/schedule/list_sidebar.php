<form>
	<table class="contentTable search-bar">
		<thead><tr><th>搜索</th></tr></thead>
		<tbody>
			<tr>
				<td><input type="text" name="name" value="<?=$this->config->user_item('search/name')?>" placeholder="名称" title="名称" /></td>
			</tr>
			<tr><td><input type="text" name="time/from" value="<?=$this->config->user_item('search/time/from')?>" class="date" placeholder="开始日期" /></td></tr>
			<tr><td><input type="text" name="time/to" value="<?=$this->config->user_item('search/time/to')?>" class="date" placeholder="结束日期" /></td></tr>
			<tr>
				<td class="submit">
					<button type="submit" name="search" tabindex="0">搜索</button>
					<button type="submit" name="search_cancel" tabindex="1"<?if(!$this->config->user_item('search/name') && !$this->config->user_item('search/time/from') && !$this->config->user_item('search/time/to')){?> class="hidden"<?}?>>取消</button>
				</td>
			</tr>
		</tbody>
	</table>
</form>