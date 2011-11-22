<?php 
include 'lib/php/skeleton_index.php';
?>

<?php startblock('h1') ?>
Invitations
<?php endblock() ?>

<?php startblock('content') ?>
<div id="inviteProvider">
	<form action="lib/php/admin_process.php" method="POST">
		<input type="hidden" name="action" id="action" value="invite_provider" />
		<div class="formrow">
			<label for="inviteProviderName">Név</label><input type="text" id="inviteProviderName" name="inviteProviderName"/><span style="display:none;" class="error">Hiba!</span>
		</div>
		<div class="formrow">
			<label for="inviteProviderEmail">Email cím</label>
			<div class="input-prepend">
				<span class="add-on">@</span>
				<input type="text" id="inviteProviderEmail" name="inviteProviderEmail"/>
			</div>
			<span style="display:none;" class="error">Hiba!</span>
		</div>
		<div class="formrow">
			<label for="inviteProviderType">Típus</label><select id="inviteProviderType" name="inviteProviderType"><option value="1">Guide</option><option value="0">Egyéb szolgáltató</option></select>
		</div>
		<div class="formrow">
			<input type="submit" value="Elküld" class="btn primary" />
		</div>
	</form>
</div>
<?php endblock() ?>