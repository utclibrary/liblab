<div class="well well-raised">
	<legend>Search Rare Books
	</legend>
	<section id='tabs'>
		<div id='searchboxcenter'>
			<form id='courseRareBooksSearch' aria-label="rare books search form" class='form-search' name='courses' action="https://utc.primo.exlibrisgroup.com/discovery/search" enctype="application/x-www-form-urlencoded; charset=utf-8" onsubmit="searchPrimoR()" method="get"
			  target='_blank' rel='noopener noreferrer'>
				<label for="searchreserves" class="hide">Search Rare Books</label>
				<input type="hidden" name="query" id="primoQueryR">
				<input type="hidden" name="tab" value="SPC_ARCH">
				<input type="hidden" name="search_scope" value="Spec_Coll_Scope">
				<input type="hidden" name="vid" value="01UTC_INST:SPEC_COLL">
				<input type="hidden" name="mode" value="advanced">
				<span class="text-input-wrapper">
					<input type='text' id="queryR" aria-label="search input for quick search" placeholder='Enter search term(s)' class='input-xxlarge' name="q" style="font-size: 1.25em;min-height: 2em;margin: .5em 0 .5em 0;" required /><span title="Clear">&times;</span>
				</span>
				<button id="Reserves" type='submit' class='btn search-btn btn-primary' style="margin: 0 .5em 0 .5em;min-height: 3em;">Search</button>
		</div>
	</section>
</div>
<style>
	.text-input-wrapper span {
		font-size: 1.25em;
		margin-left: -1.25em;
		cursor: pointer;
		font-weight: bold;
		visibility: hidden;
		margin-right: .25em;
	}
</style>
<script>
	function searchPrimoR() {
		document.getElementById("primoQueryR").value = "any,contains," + document.getElementById("queryR").value.replace(/[,]/g, " ");
		document.forms["courses"].submit();
	}
	(function() {
		var searchForm = document.getElementById('courseRareBooksSearch'),
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
