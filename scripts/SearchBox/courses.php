<div id="libsearch" class="well well-raised">
	<legend>Search Course Reserves
		<p class="pull-right"><a href="/library/help/index.php" target="_blank" class="btn btn-warning">Ask A Librarian</a></p>
	</legend>
	<section id='tabs'>
		<div id='searchboxcenter'>
			<form class='form-search' name='courses' action='http://utc.worldcat.org/wcpa/courseReserves' method='get' target='_blank'>
				<input type='text' placeholder='Search Course Reserves' class='input-xlarge' name='query'/>
				<button type='submit' class='btn'>Search</button>
				<br/><br/>Search for:
				<select name='searchIn'>
					<option value='Courses' selected>Course or Instructor</option>
					<option value='Items'>Reserve Items</option>
				</select>
				<select name='searchWords'>
					<option value='allWords' selected>Match All Words</option>
					<option value='anyWords'>Match Any Words</option>
				</select>
				<input type='hidden' value='courseReserveManagerSearchCourses' name='action'/>
			</form>
		</div>
	</section>
</div>
