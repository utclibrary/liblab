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
// block error reporting for live code
error_reporting(0);
date_default_timezone_set('America/New_York');
$today = time();
// set link for Search Help for first three tabs - need to set back after semester start (<a href="/library/help/tutorials/research-bascis.php">Search Help</a>)
$searchHelpLink='<a class="btn btn-mini search-xtra-left" href="/library/help/tutorials/reseach-basics.php">Search Help</a>';
// emergency message within the search box
$endTime = 1420315200;
$emergMessage = "<br/><br/><p><font color='red'>The UTC Library catalog will be down for vendor scheduled maintenance from Midnight to 3pm on Saturday, January 3rd.
		This outage will affect the Everything, Articles, Journals, and Reserves tabs of our search box along with select databases.
		We apologize for the inconvenience.</font></p>";

// Enter name and url for Quicklinks box.  Any links with blank ('') name or url fields will not appear in the box.
// Only urls beginning with "/library/" will open in the same tab.  Others will open in a new tab.
$quickLink[1]['name'] = 'Hours';
$quickLink[1]['url'] = '/library/about/hours.php';

$quickLink[2]['name'] = 'Library Instruction';
$quickLink[2]['url'] = '/library/services/instruction/';

$quickLink[3]['name'] = 'Research Appointments';
$quickLink[3]['url'] = '/library/services/students/research-appointments.php';

$quickLink[4]['name'] = 'Reserve a Room';
$quickLink[4]['url'] = '/library/services/rooms/';

$quickLink[5]['name'] = 'Interlibrary Loan';
$quickLink[5]['url'] = '/library/services/interlibrary-loan.php';

$quickLink[6]['name'] = 'EndNote';
$quickLink[6]['url'] = '/library/help/endnote.php';

$quickLink[7]['name'] = '';
$quickLink[7]['url'] = '';

$quickLink[8]['name'] = '';
$quickLink[8]['url'] = '';
?>

<div id="searchandql" class = "row">
	<div class="span9">
		<div id="libsearch" class="well well-raised">
		<a data-step='5' data-intro='Still need help? Ask a Librarian!' class="ask pull-right btn btn-warning" href="/library/help/index.php" target="_blank">Ask A Librarian</a>
			<legend>Search Library Resources</legend>
			<section id='section-tabs'>
				<div id='searchboxcenter'>
<!-- BEGIN tabs default 'desktop' display-->
					<ul class='nav nav-tabs' id="tabs">
						<?php $searchTabLiBlock = "<li class='active'><a href='#everything' data-toggle='tab'>Everything</a></li>
						<li><a href='#ebooks'data-toggle='tab'>Ebooks+</a></li>
						<li><a href='#articles' data-toggle='tab'>Articles</a></li>
						<li><a href='#journals' data-toggle='tab'>Journals</a></li>
						<li><a href='#databases' data-toggle='tab'>Databases</a></li>
						<li><a href='#subjects' data-toggle='tab'>Subjects</a></li>
						<li><a href='#courses' data-toggle='tab'>Reserves</a></li>";
						echo $searchTabLiBlock;
						?>
					</ul>
<!-- END tabs -->
<!-- BEGIN select for responsive display on mobile-->
				 <ul class='hide nav nav-tabs' id='tabs-select'>
					 <li> <a href='#' class='dropdown-toggle' data-toggle='dropdown'></a>
						 <ul class='dropdown-menu' role='menu'>
							 <?php 	echo $searchTabLiBlock;?>
				 </ul>
				 						 </li>
				 </ul>
<!-- END select -->
					<div id='myTabContent' class='tab-content'>
						<div class='tab-pane active' id='everything'>
							<form aria-label="Search Form" class='form-search' name='everything' onsubmit='return WorldCatInterface();' method='get' target='_blank'>
								<label for="searchAll" class="hide">Search Books, Articles, Movies, and More...</label>
								<input type='text' id="searchAll" aria-label="Search Input" placeholder='Search Books, Articles, Movies, and More...' class='input-xxlarge' name='queryString' required/>
								<button id="Everything" type='submit' class='btn search-btn btn-primary'>Search</button>
								<div class="spacer"></div>
								<label for="everythingformat" aria-label="limit results to">Limit results to:</label>
								<select id="everythingformat" class='input-medium' name='format'>
									<option value='' selected>Everything</option>
									<option value='Book'>Books</option>
									<option value='Book::book_digital'>Ebooks</option>
									<option value='Video'>Videos</option>
									<option value='Video::video_digital'>Evideos</option>
									<option value='Music'>Music</option>
									<option value='Music::music_digital'>Emusic</option>
									<option value='Artchap'>Articles</option>
								</select>
								<label for="everythingscope" class="hide">search scope</label>
								<select id="everythingscope" aria-label="search scope" class='input-large' name='scope'>
									<option value=''>Libraries Worldwide</option>
									<option value='wz:703' selected>UTC</option>
								</select>
							</form>
								<?php echo $searchHelpLink; ?>
								<a class="btn btn-mini search-xtra-right" href="http://utc.on.worldcat.org/advancedsearch" target="_blank">Advanced Search</a>
							<?php if ($today < $endTime) echo $emergMessage; ?>
						</div>

						<div class='tab-pane' id='ebooks'>
							<form aria-label="Ebooks Search Form" class='form-search' name='ebooks' onsubmit='return WorldCatInterface();' method='get' target='_blank'>
								<label for="searchersources" class="hide">Search Ebooks</label>
								<input data-step='3' data-intro='Enter keyword, title, author, etc.' type='text' id="searchebooks" aria-label="Search ebooks Input" placeholder='Search Ebooks' class='input-xxlarge' name='queryString' required/>
								<button data-step='4' data-intro='Click Search' id="eBooks" type='submit' class='btn search-btn btn-primary'>Search</button>
								<div class="spacer"></div>
								<label for="eformat" aria-label="limit results to">Limit results to:</label>
								<select data-step='2' data-intro='Ebooks are searched by default but you may also limit search results to evideo or emusic' id="eformat" class='input-medium' name='subformat'>
									<option value='Book::book_digital'>Ebooks</option>
									<option value='Video::video_digital'>Evideos</option>
									<option value='Music::music_digital'>Emusic</option>
								</select>
								<input type='hidden' name='scope' value='wz:703'></input>
								</select>
							</form>
							<?php //echo $searchHelpLink; ?>
							<a style="font-weight:bold;" class="btn btn-mini search-xtra-left" href="javascript:void(0);" onclick="javascript: introJs().start().setOptions({ 'skipLabel': 'Got it!', 'doneLabel': 'Got it!' });">
								Show Me How</a>
								<a class="btn btn-mini search-xtra-right" href="http://utc.on.worldcat.org/advancedsearch" target="_blank">Advanced Search</a>
							<?php if ($today < $endTime) echo $emergMessage; ?>
						</div>

						<div class='tab-pane' id='articles'>
							<form class='form-search' name='articles' onsubmit='return WorldCatInterface();' method='get' target='_blank'>
								<label for="searcharticles" class="hide" aria-label="Search Input">Search Articles</label>
								<input id="searcharticles" type='text' placeholder='Search Articles' class='input-xxlarge' name='queryString' required/>
								<button id="Articles" type='submit' class='btn search-btn btn-primary'>Search</button>
								<div class="spacer"></div>
								<label for="articlesscope">Limit results to:</label>
								<select id="articlesscope" class='input-large' name='scope'>
									<option value=''>Libraries Worldwide</option>
									<option value='wz:703' selected>UTC</option>
								</select>
							<label><input type="checkbox" name="content" value="peerReviewed"> Peer Reviewed</label>
								<input type='hidden' value='Artchap' name='format'/>
							</form>
							<div class="lib-searchbox-xtras">

								<?php echo $searchHelpLink; ?>

								<a class="btn btn-mini search-xtra-right" href="http://utc.on.worldcat.org/advancedsearch" target="_blank">Advanced Search</a>

						</div>
							<?php if ($today < $endTime) echo $emergMessage; ?>
						</div>
						<div class='tab-pane' id='journals'>
							<form class='form-search' name='journals' action='http://utc.on.worldcat.org/atoztitles/journals' method='get' target='_blank'>
								<label for="query-search-UTCL-home" class="hide" aria-label="Search Input">Search Journal</label>
								<input  id="query-search-UTCL-home" type='text' placeholder='Enter a Journal Title' class='input-xxlarge' name='jtitle' required/>
								<button id="Journals" type='submit' class='btn search-btn btn-primary'>Search</button>
								<div class="spacer"></div>
								<label for="journalsscope" aria-label="limit results to">Search type:</label>
								<select id="journalsscope" class='input-medium' name='search_field'>
									<option value='title' selected>Title</option>
									<option value='issn'>ISSN</option>
								</select>
								<label class="hide" for="searchBy-UTCL-home" aria-label="limit results to">what to match</label>
								<select id="searchBy-UTCL-home" class='input-medium' name='searchType'>
									<option value='startsWith' selected>Starts With</option>
									<option value='matchExact'>Match Exact</option>
									<option value='matchAll'>Match All</option>
									<option value='matchAny'>Match Any</option>
								</select>
							</form>
							<small class="pull-left">
								<?php echo $searchHelpLink; ?>
							</small>
							<?php if ($today < $endTime) echo $emergMessage; ?>
						</div>
						<div class='tab-pane' id='databases'>
							<?php
								$url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

								// connect to database
								require_once ('mysqlconnect.php');

								$query = "SELECT Dbases.Title, Dbases.Key_ID, Dbases.OpenAccess, Dbases.ShortDescription, Dbases.ContentType, Dbases.HighlightedInfo, Dbases.ExtraInfo, Dbases.SimUsers FROM Dbases
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
											$dbDescrip[$count] = "<span class='ContentType'>" . $row['ContentType'] . ": </span>";
										$dbDescrip[$count] .= $row['ShortDescription'];
										if (($row['OpenAccess']) == '1')
											$dbDescrip[$count] .= "<a  id='oa_icon' title='open access resource' href='http://http://guides.lib.utc.edu/openaccess/overview' target='_blank'><img src='http://www.utc.edu/library/_resources/icon-oa.svg'></img></a>";
										if (!empty($row['HighlightedInfo']))
											$dbDescrip[$count] .= "<span class='highlight'>  " . $row['HighlightedInfo'] . "</span>";
										if ($row['SimUsers'] == 1)
											$dbDescrip[$count] .= "<span class='highlight'>  Limited to " . $row['SimUsers'] . " simultaneous user.</span>";
										else if ($row['SimUsers'] > 1)
											$dbDescrip[$count] .= "<span class='highlight'>  Limited to " . $row['SimUsers'] . " simultaneous users.</span>";
										if (!empty($row['ExtraInfo']))
											$dbDescrip[$count] .= "<span class='highlight'><br/><br/>  " . $row['ExtraInfo'] . "</span>";
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
											<label for="jumptodatabase" class="hide" aria-label="Search Input">Select Database</label>
											<select id="jumptodatabase" name='db0' class='input-xxlarge' onChange="changetext('jumptodatabase');">
												<option value='0' selected>Databases A to Z</option>
												<?php for($i=1; $i<$count; $i++)
												{
													echo "<option value='" . $dbID[$i] ."'>" . $dbTitle[$i] . "</option>";
												} ?>
											</select>
											<button id="Databases" type='submit' class='btn search-btn btn-primary'>Go</button>
										</div>
									</form>
									<p class="muted" id="descriptions"><br/><br/></p>
								<?php } ?>

								<a class="btn btn-mini search-xtra-left" href="http://guides.lib.utc.edu/eresources" target="_blank">Databases By Subject</a>

								<a  class="btn btn-mini search-xtra-right" href="http://guides.lib.utc.edu/multisubject" target="_blank">Multisubject Databases</a>
							<?php if ($today < $endTime) echo $emergMessage; ?>
						</div>
						<div class='tab-pane' id='subjects'>
							<?php
								$query = "SELECT Subject, LibGuidesPage FROM SubjectList WHERE NotSubjectList = 0 AND LibGuidesPage IS NOT NULL ORDER BY Subject";

								$result = mysql_query($query);

								if (!$con || empty($result))
								{
									echo "Subject search is currently unavailable.";
								}

								else
								{
									echo "<form class='form-search' name='databases'>
									<label for='db' class='hide' aria-label='go to subject'>Select Subject</label>
										<select id='db' class='input-xxlarge'>
										<option value='http://guides.lib.utc.edu/eresources' selected>Subject Guides A to Z</option>";
									while($row = mysql_fetch_array($result))
									{
										echo "<option value='http://guides.lib.utc.edu/" . $row['LibGuidesPage'] ."'>" . $row['Subject'] . "</option>";
									}
									echo "</select>";
									echo " <button id='Subjects' type='submit' class='btn search-btn btn-primary' onClick='window.open(db.value)'>Go</button></form>";
								}
								mysql_close($con);
							?>

								<a  class="btn btn-mini search-xtra-left" href="http://guides.lib.utc.edu/eresources" target="_blank">Databases By Subject</a>

								<a  class="btn btn-mini search-xtra-right" href="http://guides.lib.utc.edu/multisubject" target="_blank">Multisubject Databases</a>

							<?php if ($today < $endTime) echo $emergMessage; ?>
						</div>
						<div class='tab-pane' id='courses'>
							<form class='form-search' name='courses' action='http://utc.worldcat.org/wcpa/courseReserves' method='get' target='_blank'>
								<label for="searchreserves" class="hide" aria-label="Search Course Reserves">Search Course Reserves</label>
								<input id="searchreserves" type='text' placeholder='Search Course Reserves' class='input-xxlarge' name='query' required/>
								<button id="Reserves" type='submit' class='btn search-btn btn-primary'>Search</button>
								<div class="spacer"></div>
									<label for="reservessearchin" aria-label="Search for:">Search for:</label>
								<select id="reservessearchin" class='input-large' name='searchIn'>
									<option value='Courses' selected>Course or Instructor</option>
									<option value='Items'>Reserve Items</option>
								</select>
								<label for="reservessearchwords" class="hide" aria-label="All/Any Words">All/Any Words</label>
								<select id="reservessearchwords" class='input-medium' name='searchWords'>
									<option value='allWords' selected>Match All Words</option>
									<option value='anyWords'>Match Any Words</option>
								</select>
								<input type='hidden' value='courseReserveManagerSearchCourses' name='action'/>
							</form>

								<a  class="btn btn-mini search-xtra-left" href="/library/services/students/course-reserves.php">Reserves Help</a>

							<?php if ($today < $endTime) echo $emergMessage; ?>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<div class="span3 sidebar">
		<div id="quicklinks" class="sidebar well">
			<h3 class="welltopperGold">Quick Links</h3>
			<ul>
				<?php
				for ($i=1; $i<9; $i++)
				{
					if (!empty($quickLink[$i]['name']) && !empty($quickLink[$i]['url']))
					{
						echo '<li><a class="quicklink" href="' . $quickLink[$i]['url'] . '"';
						if (substr($quickLink[$i]['url'],0,9) != '/library/')
						{
							echo ' target="_blank"';
						}
						echo '>' . $quickLink[$i]['name'] . '</a></li>';
					}
				}
				?>
			</ul>
		</div>
	</div>
</div>
<!-- Le javascript (moved to the pagefooter in OUCampus) -->
