  <form name="frmHelp" id="frmHelp">
<table>
	<tr>
		
		<td><textarea name="Helpcontext" id="Helpcontext" rows="10" cols="140">
        <?php echo $rst["Helpcontext"]; ?>
            </textarea>
        <script>
                CKEDITOR.replace('Helpcontext',{
                  height: 310,
                  width: 810
                });
            </script></td>
	</tr>
	<tr>
		
		<td><button type="submit" name="btnHelpContext" id="btnHelpContext" class="btn btn-sm btn-success"> Save Changes</button></td>
	</tr>

</table>

</form>