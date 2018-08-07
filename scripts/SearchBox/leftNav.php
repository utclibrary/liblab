<script>
	function setSelectedValue(selectObj, valueToSet) {
		for (var i = 0; i < selectObj.options.length; i++) {
			if (selectObj.options[i].text== valueToSet) {
				selectObj.options[i].selected = true;
				return;
			}
		}
	}
</script>

<?php
date_default_timezone_set('America/New_York');
$today = time();
echo $today;
$endTime = 1420315200;
$emergMessage = "<p class='text-danger'>The UTC Library catalog will be down for vendor scheduled maintenance from Midnight to 3pm on Saturday, January 3rd.  
		This outage will affect the Everything, Articles, Journals, and Reserves tabs of our search box along with select databases.  
		We apologize for the inconvenience.</p>";
?>

<div id="searchandql" class = "row">
	<div id="libsearch" class="well well-raised">
		<legend>Search Library Resources
			<p class="pull-right"><a href="/library/help/index.php" target="_blank" class="btn btn-danger">Ask A Librarian</a></p>
		</legend>
		<section id='tabs'>
			<div id='searchboxcenter'>
				<ul class='nav nav-tabs'>
					<li class="active"><a href='#everything' data-toggle='tab'>Everything</a></li>
					<li><a href='#articles' data-toggle='tab'>Articles</a></li>
					<li><a href='#journals' data-toggle='tab'>Journals</a></li>
					<li><a href='#databases' data-toggle='tab'>Databases</a></li>
					<li><a href='#subjects' data-toggle='tab'>Subjects</a></li>
					<li><a href='#courses' data-toggle='tab'>Reserves</a></li>
				</ul>
				<div id='myTabContent' class='tab-content'>
					<div class='tab-pane active' id='everything'>
						<form class='form-search' name='everything' onsubmit='return WorldCatInterface();' method='get' target='_blank'>
							<input type='text' placeholder='Search Books, Articles, Movies, and More...' class='input-xxlarge' name='q'/>
							<button type='submit' class='btn'>Search</button>
							<br/><br/>Limit results to: 
							<select class='input-medium' name='fq'>
								<option value='' selected>Everything</option>
								<option value='x0:book'>Books</option>
								<option value='x0:video'>Videos</option>
								<option value='x0:music'>Music</option>
								<option value='x0:artchap'>Articles</option>
							</select>
							<input type='hidden' name='scope' value='0'/>
							<!--<select class='input-large' name='scope'>
								<option value='0'>Libraries Worldwide</option>
								<option value='1'>Other Area Libraries</option>
								<option value='2' selected>UTC</option>
								<option value='3'>Reference Collection</option>
								<option value='4'>Walker Center</option>
							</select>-->
						</form>
						<small class="pull-right">
							<a href="http://www.utc.worldcat.org/advancedsearch" target="_blank">Advanced Search</a>
						</small>
					</div>
					<div class='tab-pane' id='articles'>
						<form class='form-search' name='articles' onsubmit='return WorldCatInterface();' method='get' target='_blank'>
							<input type='text' placeholder='Search Articles' class='input-xxlarge' name='q'/>
							<button type='submit' class='btn'>Search</button>
							<br/><br/>Limit results to: 
							<input type='text' placeholder='Journal Title (optional)' class='input-medium' name='source'/>
							<input type='hidden' name='scope' value='0'/>
							<!--<select name='scope'>
								<option value='0'>Libraries Worldwide</option>
								<option value='2' selected>UTC Library</option>
							</select>-->
							<input type='hidden' value='x0:artchap' name='fq'/>
						</form>
						<small class="pull-right">
							<a href="http://www.utc.worldcat.org/advancedsearch" target="_blank">Advanced Search</a>
						</small>
					</div>
					<div class='tab-pane' id='journals'>
						<form class='form-search' name='journals' action='http://utc.worldcat.org/openurlresolver/search' method='get' target='_blank'>
							<input type='text' placeholder='Enter a Journal Title' class='input-xxlarge' name='search_value'/>
							<button type='submit' class='btn'>Search</button>
							<br/><br/>Search by:
							<select class='input-medium' name='search_field'>
								<option value='title' selected>Title</option>
								<option value='issn'>ISSN</option>
							</select>
							<select class='input-medium' name='search_relation'>
								<option value='starts_with' selected>Starts With</option>
								<option value='exact'>Match Exact</option>
								<option value='match_all_words'>Match All</option>
								<option value='match_any_words'>Match Any</option>
							</select>
							<input type='hidden' value='journals' name='search_category'/>
							<input type='hidden' value='journal' name='search_type'/>
						</form>
					</div>
					<div class='tab-pane' id='databases'>
						<?php
							// block error reporting for live code
							error_reporting(0);
							 
							$url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		                
							// connect to database
							require_once ('mysqlconnect.php');
										
							$query = "SELECT Dbases.Title, Dbases.Key_ID, Dbases.ShortDescription, Dbases.ContentType, Dbases.HighlightedInfo, Dbases.SimUsers FROM Dbases
								WHERE NotAtoZ = 0 AND Dbases.CANCELLED = 0 AND Dbases.MASKED = 0 ORDER BY Dbases.Title";
					
							$result = mysql_query($query);
					
							if (!$con || empty($result))
							{
								echo "Database search is currently unavailable.";
							}
						
							else
							{
								$count = 1;
			
								while($row = mysql_fetch_array($result))
								{
									$dbTitle[$count] = $row['Title'];
									$dbID[$count] = $row['Key_ID'];
									if (!empty($row['ContentType']))
										$dbDescrip[$count] = "<strong>" . $row['ContentType'] . ": </strong>";
									$dbDescrip[$count] .= $row['ShortDescription'];
									if (!empty($row['HighlightedInfo']))
										$dbDescrip[$count] .= "<strong><font color='red'>  " . $row['HighlightedInfo'] . "</font></strong>";
									if ($row['SimUsers'] == 1)
										$dbDescrip[$count] .= "<strong><font color='red'>  Limited to " . $row['SimUsers'] . " simultaneous user.</font></strong>";
									else if ($row['SimUsers'] > 1)
										$dbDescrip[$count] .= "<strong><font color='red'>  Limited to " . $row['SimUsers'] . " simultaneous users.</font></strong>";
									if (strlen($dbDescrip[$count])<107)
										$dbDescrip[$count] .= "<br/><br/>";
									$dbDescrip[$count] = preg_replace('/"/','\'',$dbDescrip[$count]);
									$count++;
								} ?>
								
								<script type="text/javascript">
									function changetext(elemid) 
									{
										var ind = document.getElementById(elemid).selectedIndex;
										var description = new Array();
										description[0] = "<br/><br/>";
							
										<?php for ($i=1; $i<$count; $i++){?>
											description[<?php echo $i; ?>] = "<?php echo $dbDescrip[$i]; ?>";
										<?php } ?>
							
										document.getElementById('descriptions').innerHTML = description[ind];
									}
								</script>
								
								<form class='form-search' name='databases' action='http://www5.lib.utc.edu/databases/LGForward.php' method='get' target='_blank'>								
									<input type='hidden' name='url' value=$url></input>
									<div id='allDb' style='display: block;'>
										<select name='db0' class='input-xxlarge' id='allDbList' onChange="changetext('allDbList');">
											<option value='0' selected>Databases A to Z</option>
											<?php for($i=1; $i<$count; $i++)
											{
												echo "<option value='" . $dbID[$i] ."'>" . $dbTitle[$i] . "</option>";
											} ?>
										</select>
										<button type='submit' class='btn'>Go</button>
									</div>						
								</form>
								<p class="muted" id="descriptions"><br/><br/></p>
							<?php } ?>
						<small class="pull-left">
							<a href="http://guides.lib.utc.edu/eresources" target="_blank">Databases By Subject</a>
						</small>
						<small class="pull-right">
							<a href="http://guides.lib.utc.edu/multisubject" target="_blank">Multisubject Databases</a>
						</small>
					</div>
					<div class='tab-pane' id='subjects'>
						<?php 
							$query = "SELECT Subject, LibGuidesPage FROM SubjectList WHERE Format = 0 AND LibGuidesPage IS NOT NULL ORDER BY Subject";
					
							$result = mysql_query($query);
					
							if (!$con || empty($result))
							{
								echo "Subject search is currently unavailable.";
							}
						
							else
							{
								echo "<form class='form-search' name='databases'>
									<select id='db' class='input-xxlarge'>
									<option value='http://guides.lib.utc.edu/eresources' selected>Subject Guides A to Z</option>";
								while($row = mysql_fetch_array($result))
								{
									echo "<option value='http://guides.lib.utc.edu/" . $row['LibGuidesPage'] ."'>" . $row['Subject'] . "</option>";
								}
								echo "</select>";
								echo " <button type='submit' class='btn' onClick='window.open(db.value)'>Go</button></form>";
							}
							mysql_close($con);
						?>
						<br/><br/>
						<small class="pull-left">
							<a href="http://guides.lib.utc.edu/eresources" target="_blank">Databases By Subject</a>
						</small>
						<small class="pull-right">
							<a href="http://guides.lib.utc.edu/multisubject" target="_blank">Multisubject Databases</a>
						</small>
					</div>
					<div class='tab-pane' id='courses'>
						<form class='form-search' name='courses' action='http://utc.worldcat.org/wcpa/courseReserves' method='get' target='_blank'>
							<input type='text' placeholder='Search Course Reserves' class='input-xxlarge' name='query'/>
							<button type='submit' class='btn'>Search</button>
							<br/><br/>Search for:
							<select class='input-large' name='searchIn'>
								<option value='Courses' selected>Course or Instructor</option>
								<option value='Items'>Reserve Items</option>
							</select>
							<select class='input-medium' name='searchWords'>
								<option value='allWords' selected>Match All Words</option>
								<option value='anyWords'>Match Any Words</option>
							</select>
							<input type='hidden' value='courseReserveManagerSearchCourses' name='action'/>
						</form>
						<small class="pull-left">
							<a href="/library/services/students/course-reserves.php">Reserves Help</a>
						</small>
						<?php if ($today < $endTime) echo $emergMessage; ?>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
        
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
	function WorldCatInterface()
	{
		var w=window.innerWidth
			|| document.documentElement.clientWidth
			|| document.body.clientWidth;
			
		if (w < 900)
		{
			document.everything.action = 'http://utc.worldcat.org/search';
			document.articles.action = 'http://utc.worldcat.org/search';
		}
		else
		{
			document.everything.action = 'http://utc.worldcat.org/search';
			document.articles.action = 'http://utc.worldcat.org/search';
		}
				
		return true;
	}
</script>