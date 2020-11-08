@php
	$already_selected_value = 1990;
	$earliest_year = 1990;

	print '<select name="year" class="form-control">';
	foreach (range(date('Y'), $earliest_year) as $x) {
	    print '<option value="'.$x.'"'.($x === $already_selected_value ? ' selected="selected"' : '').'>'.$x.'</option>';
	}
	print '</select>';
@endphp