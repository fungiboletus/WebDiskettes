<?php
class CaptureView extends AbstractView {
	public static function showForm($url_value) {

		$url_submit = CNavigation::generateUrlToApp('Dashboard', 'submit');
		$label_url = _('URL');
		$label_tags = _('Tags');
		$legend_text = _('Create a new diskette of an URL');
		$submit_text = _('Create');

		$url_value = htmlspecialchars($url_value);

		echo <<<END
<form action="$url_submit" name="capture_form" method="post" id="capture_form">
<fieldset>
	<legend>$legend_text</legend>
	<div class="clearfix">
		<label for="input_url">$label_url</label>
		<div class="input">
			<input name="url" id="input_url" type="text" autofocus required value="$url_value" />
		</div>
	</div>
	<div class="clearfix">
		<label for="input_tags">$label_tags</label>
		<div class="input">
			<input name="tags" id="input_tags" type="text" />
		</div>
	</div>
	<div class="actions">
		<input type="submit" class="btn large primary" value="$submit_text" />
	</div>
</fieldset>
</form>	
END;
	}

	public function showList($url) {

		groaw($this->model);
		$hurl = htmlspecialchars($url);
		echo "<ul>\n";
		foreach ($this->model as $capture) {
			$link = CNavigation::generateUrlToApp('Archive', 'versions', array('url' => 'test'));
			groaw($capture);
			$date = $this->formateDate($capture->date);
			echo "\t<li><a href=\"$link\">$date</a></li>\n";
		}
		echo "</ul>\n";
	}
}
?>
