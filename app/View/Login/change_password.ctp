<div class="container">
	<div class="mainContentBlock section sectionMain insideSidebar">
		<form method="post" class="xenForm AutoValidator ContactDetailsForm" action="account/security-save" data-optinout="OptIn">
			<table>
				<tr class="cttrUnit">
					<td><label for="cttr_password_original">Current Password</label></td>
					<td>
						<input type="password" name="old_password" value="" dir="ltd" class="textCttr" id="cttr_password_original" autofocus="autofocus" placeholder="Current Password">
					</td>
				</tr>


				<tr class="cttrUnit">
					<td><label for="cttr_password">New Password</label></td>
					<td><input type="password" name="password" value="" dir="ltd" class="textCttr" id="cttr_password" placeholder="New Password"></td>
				</tr>

				<tr class="cttrUnit">
					<td><label for="cttr_password_confirm">Confirm Password</label></td>
					<td><input type="password" name="password_confirm" value="" class="textCttr" dir="ltd" id="cttr_password_confirm" placeholder="Confirm Password"></td>
				</tr>


				<tr class="cttrUnit submitUnit">
					<td></td>
					<td><input type="submit" name="save" value="Save" accesskey="s" class="button primary"></td>
				</tr>
			</table>
		</form>
	</div>
</div>