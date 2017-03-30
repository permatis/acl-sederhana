<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<form action="{{ url('test') }}" method="post">
	<?php echo csrf_field(); ?>
	<ul>
		<li>
			<input type="checkbox" id="test"> Test
			<ul>
				<li><input type="checkbox" name="test[]" id="test_1" value="1"> Test 1</li>
				<li><input type="checkbox" name="test[]" id="test_2" value="3"> Test 2</li>
			</ul>
		</li>
		<li><input type="checkbox" name="test[]" value="2"> Aka</li>
	</ul>
	<input type="submit" value="Simpan">
</form>
<script type="text/javascript">
	$(function() {
		$('input:checkbox').click(function() {
			var cb = $("input[id*='"+$(this).attr('id')+"']");
			var cc = $("input[id='"+$(this).attr('id').split('_')[0]+"']");
// console.log($(this).attr('id').indexOf('_') > -1);
			if (cb.prop('checked') == true) { 
				cb.attr('checked', true);
			if( $(this).attr('id').indexOf('_') > -1) { 
				cc.attr('checked', true);
			}else {
				console.log('un');
				cb.attr('checked', false);
			}


		});
	});
</script>