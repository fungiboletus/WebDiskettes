<?php
class CaptureView {
	public static function showForm() {

		$url_submit = CNavigation::generateUrlToApp('Dashboard', 'submit');
		$label_url = _('URL');
		$label_tags = _('Tags');
		$legend_text = _('Create a new diskette of an URL');
		$submit_text = _('Create');

		echo <<<END
<form action="$url_submit" name="capture_form" method="post" id="capture_form">
<fieldset>
	<legend>$legend_text</legend>
	<div class="clearfix">
		<label for="input_url">$label_url</label>
		<div class="input">
			<div class="input-prepend">
				<span class="add-on">http://</span>
				<input name="url" id="input_url" type="text" autofocus required />
			</div>
		</div>
	</div>
	<div class="clearfix">
		<label for="input_tags">$label_tags</label>
		<div class="input">
			<input name="tags" id="input_tags" type="text" />
		</div>
	</div>
	<div class="actions">
		<input type="submit" class="btn primary" value="$submit_text" />
	</div>
</fieldset>
</form>	
END;
	}
}
?>
