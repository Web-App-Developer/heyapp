<div class="single-point">
	<table class="table">
		<tr>
			<td class="left--col">Request Type</td>
			<td class="right--col">
				<select name="request_type" class="form-control">
					<option value="">Select One</option>
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="C">C</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="left--col">Load a Request</td>
			<td class="right--col">
				<input type="file" name="request_file" class="form-control">
				<small class="text-danger">(multiple docs, in diff formats: PDF, JPG, PGN, MS Office)</small>
			</td>
		</tr>

		<tr>
			<td class="left--col">Message</td>
			<td class="right--col">
				<textarea name="message" class="form-control" rows="5" cols="5"></textarea>
			</td>
		</tr>

		<tr class="text-center">
			<td colspan="2"><input type="checkbox" name="gdpr" value="gdpr"> <span>GDPR</span></td>
		</tr>
		<tr class="text-center">
			<td colspan="2">
				<button class="btn btn-primary" type="submit">SUBMIT</button>
			</td>
		</tr>
	</table>
</div>