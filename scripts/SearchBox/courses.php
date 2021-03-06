<div class="well well-raised">
	<legend>Search Course Reserves
	</legend>
	<section id='tabs'>
		<div id='searchboxcenter'>
			<form id='courseReservesSearch' aria-label="reserves search form" class='form-search' name='courses' action="https://utc.primo.exlibrisgroup.com/discovery/search" enctype="application/x-www-form-urlencoded; charset=utf-8" onsubmit="searchPrimoR()" method="get" target='_blank'>
				<label for="searchreserves" class="hide">Search Course, Instructor, or Item</label>
<span class="text-input-wrapper"><input type='text' id="queryR" aria-label="search input for quick search" placeholder='Search Course, Instructor, or Item' class='input-xxlarge' name="q" style="font-size: 1.25em;min-height: 2em;margin: .5em 0 .5em 0;" required /><span title="Clear">&times;</span></span>
				<input type="hidden" name="query" id="primoQueryR">
				<input type="hidden" name="vid" value="01UTC_INST:01UTC">
				<input type="hidden" name="tab" value="CustomCourseReserves">
				<button id="Reserves" onclick="searchPrimoR()"  type='submit' class='btn search-btn btn-primary' style="margin: 0 .5em 0 .5em;min-height: 3em;">Search</button>
		</div>
	</section>
</div>
<script>
	function searchPrimoR() {
		document.getElementById("primoQueryR").value = "any,contains," + document.getElementById("queryR").value.replace(/[,]/g, " ");
		document.forms["courses"].submit();
	}
	(function() {
		var searchForm = document.getElementById('courseReservesSearch'),
			textInput = searchForm.q,
			clearBtn = textInput.nextSibling;
		textInput.onkeyup = function() {
			// Show the clear button if text input value is not empty
			clearBtn.style.visibility = (this.value.length) ? "visible" : "hidden";
		};
		// Hide the clear button on click, and reset the input value
		clearBtn.onclick = function() {
			this.style.visibility = "hidden";
			textInput.value = "";
		};
	})();
</script>
