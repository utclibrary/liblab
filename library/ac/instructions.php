<?php
/**********************************************************
 Copyright (C) The Regents of the University of Minnesota

 This program is free software; you can redistribute it and/or
 modify it under the terms of the GNU General Public License
 version 2 as published by the Free Software Foundation.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License in COPYRIGHT for more details.



File: instructions.php
Original Author: John Hickey (a former student worker)
Modified:  Shane Nackerud snackeru@tc.umn.edu
Last Modified: 09.Jan.2012 Michael Berkowski <mjb@umn.edu>
***********************************************************
Comments:
This is the main file of steps for the Assignment Calculator.
The steps are located in a big array called $instructions[].
The decimal point in the array describes the amount of time
each step should take.  Make sure that your numbers equal 1
(one), or in other words make sure it equals 100% of the time.

The file also contains various functions necessary for the AC.

Jan 2012: MJB Changed this from numerically indexed sub-arrays
to a proper associative array
**********************************************************/


//main array.  Each element has three parts.  A decimal that
//represents fraction of total time, a description, and an
//array of tips
$instructions = array(

//Step 1
array(
  "time" => .03,
  "title" => "Understand your assignment",
  "items" => array(
    "<a href='https://www.utc.edu/library/services/writing-and-communication-center/understanding-assignment.php' target='__blank'>Read your assignment guidelines carefully and ask your instructor about any questions you may have</a>.",
    "<a href='https://utc.mywconline.com/' target='_blank'>Make an appointment at the Writing & Communication center</a>. You don’t need to have a single word written. Just bring your assignment sheet and a tutor will help you review the guidelines and make a plan of action."
  ),
  "due" => NULL
),

//Step 2
array(
  "time" => .04,
  "title" => "Select and focus topic",
  "items" => array(
    "Develop your topic by <a href='https://www.youtube.com/watch?v=9Nn0KeoPlMQ' target='__blank'>creating a concept map</a>.",
    "<a href='tune-up-your-research-question.pdf' target='__blank'>Gather background information</a>."
  ),
  "due" => NULL
),

//Step 3
array(
  "time" => .02,
  "title" => "Write working thesis",
  "items" => array(
  "First, determine <a href='https://owl.english.purdue.edu/owl/resource/545/01/' target='__blank'>what type of thesis statement</a> your paper requires.",
  "Then, begin drafting your thesis. <a href='https://www.utc.edu/library/services/writing-and-communication-center/creating-thesis.php' target='_blank'>Your thesis should be arguable, specific, and situated within an ongoing academic conversation</a>.",
  "Remember, your thesis might change as you begin to research and write and come to new understandings on your topic. This is a normal part of the writing, research, and thinking process!"

  ),
  "due" => NULL
),

//Step 4
array(
  "time" => .35,
  "title" => "Find, review, and evaluate books, journals, magazine, and newspaper articles",
  "items" => array(
  "<a href='https://www.utc.edu/library' target='__blank'>Search the library's catalog</a>, narrow results by format, date, or topic. ",
  "Check out our <a href='https://www.utc.edu/library/help/tutorials/reseach-basics.php' target='__blank'>Research Basics.</a> page for help using the library resources.",
  "Try searching our <a href='https://www.utc.edu/library/help/research-guides.php' target='__blank'>subject specific databases</a> for more specific research.",
  "Take good notes as you go, it will save you time later!",
  "Having trouble? Set up a <a href='https://www.utc.edu/library/services/students/research-appointments.php' target='__blank'>research appointment</a> with a librarian."



  ),
  "due" => NULL
),

//Step 5
array(
  "time" => .06,
  "title" => "Find, review, and evaluate web sites",
  "items" => array(
    "You may need to look to the internet to flesh out your research. Remember, not everything on the web is a credible source. Be critical as you evaluate!",
    "Read about <a href='https://guides.lib.utc.edu/evaluating-sources' target='__blank'>how to evaluate websites</a>.",
   "Be sure to always <a href='https://guides.lib.utc.edu/citing' target='__blank'>cite your sources</a>!"

  ),
  "due" => NULL
),

//Step 6
array(
  "time" => .02,
  "title" => "Outline or describe overall structure ",
  "items" => array(
  "Here are some <a href='http://newarkwww.rutgers.edu/guides/threeways.htm' target='__blank'>general organization strategies</a>.",
  "Play with <a href='http://www.crlsresearchguide.org/NewOutlineMaker/NewOutlineMakerInput.aspx' target='__blank'>this outline generator</a> to help you organize your main points.",
  "If you're writing an APA style research paper, <a href='https://owl.english.purdue.edu/owl/resource/560/13/' target='__blank'>check here for standard structures and section orders</a>.",
  "Need to talk through your plan? <a href='https://utc.mywconline.com' target='_blank'>Book an appointment</a> with the WCC for help with outlining and organizing your ideas."

  ),
  "due" => NULL
),

//Step 7
array(
  "time" => .20,
  "title" => "Write 1st draft",
  "items" => array(
  "<a href='http://blog.nanowrimo.org/post/66207328376/the-author-huddle-6-tips-to-finish-your-first' target='__blank'>Read and embrace</a> these tips for writing a first draft! Our favorite tip at the WCC? “Much of writing is just doing it.&quot;",
  "Have you ever heard the saying, &quot;Being a good writer is 3% talent and 97% not being distracted by the internet?&quot; If you're having trouble dealing with distractions, <a href='https://writetodone.com/how-to-write-without-distractions/' target='__blank'>check out these tips</a>."

  ),
  "due" => NULL
),

//Step 8
array(
  "time" => .02,
  "title" => "Conduct additional research as necessary.",
  "items" => array(
  "Need more sources? Check out these <a href='https://www.lib.ncsu.edu/tutorials/phrase-searching/' target='__blank'>tips and tricks</a> for more efficient searching",
  "<a href='https://www.utc.edu/library/help/' target='__blank'>Get Help</a> from a librarian; we're always here to help."

  ),
  "due" => NULL
),

//Step 9
array(
  "time" => .20,
  "title" => ": Revise & rewrite",
  "items" => array(
  "When your draft is complete, <a href='https://owl.english.purdue.edu/owl/resource/689/1/' target='__blank'>make a reverse outline</a>. This is a great way to make sure that your paper is well-organized and matches up with the claim you make in your thesis.",
  "Now is a good time to <a href='https://utc.mywconline.com/' target='__blank'>make another appointment</a> at the WCC. This time, bring your draft with you, along with any particular questions you may want to ask the consultant. Don't wait until right before your paper is due; make sure to give yourself some time after your WCC session to make additional revisions."

  ),
  "due" => NULL
),

//Step 10
array(
  "time" => .06,
  "title" => "Put paper in final form",
  "items" => array(
  "Does your paper adhere to the citation style required by your professor? <a href='https://guides.lib.utc.edu/citing' target='__blank'>Go here if you need help with citations</a>. The WCC consultants can help you with this too!",
  "Proofread! Our favorite proofreading tip? Read your paper backwards, sentence by sentence, when you proofread. This way, you'll focus more on each sentence by itself. Another tip? Read aloud. This forces you to slow way down, allowing you to catch errors you may not have noticed otherwise. It always helps to have a friend or WCC consultant look everything over one last time as well.",
  "Just for fun: <a href='https://www.youtube.com/watch?v=OonDPGwAyfQ' target='__blank'>Poet Taylor Mail reminds us about &quot;The the impotence of proofreading&quot; in this spoken word poem</a>!"

  ),
  "due" => NULL
)
);


/**********************************************************
Function: days_between
Author: John Hickey
Last Modified: 2001
***********************************************************
Purpose:
Generates the number of days between two dates
**********************************************************/
function days_between($time1, $time2) {

	$time =  $time2 - $time1;
	return ($time/86400);

}


/**********************************************************
Function: out_of_time
Author: John Hickey
Last Modified: 2012 by Michael Berkowski
***********************************************************
Purpose:
Breaks up the steps into the times designated by the decimals
in the $instructions array

2012: Michael Berkowski made the due dates a component of the
$instructions array rather than a separate array
NOTE: $instructions_array is passed by reference now...
**********************************************************/
function out_of_time($time1, $time2, &$instructions_array, $bedTime, $ampm) {

	$time= abs($time1-$time2);
	//depending on the number of day and the number of divisions, we choose different date formats.

		// No idea what $div_array was for...
		if(days_between($time1, $time2)>12) {

			$format="D M d, Y";
			$stages = $time1; //keep the running total.

			foreach ($instructions_array as &$step) {
				$stages += ($time * $step['time']);
				$step['due'] = date($format, $stages);
			}
		} else {

		$format="g a D M d";

		$stages = $time1; //keep the running total.

			foreach ($instructions_array as &$step) {
				$stages += ($time * $step['time']);
				$hour24 = date("G", $stages);
				if ($hour24 > 12) $hour24 = $hour24-24; //this keeps the time centered around midnight. 2 is 2 am and -2 is 10pm
				if( ($ampm == 'am' && $hour24 > $bedTime && $hour24 < $bedTime + 10) or ($ampm == 'pm' && $hour24 > $bedTime-12 && $hour24 < $bedTime-2)){//if the time is later than a person wants to get to sleep
					$step['due'] = "$bedTime $ampm " . date("D M d", $stages);
				} else {
					$step['due'] = date($format, $stages);
				}
			}

		}
	return;
}

/**********************************************************
Function: pres_date
Author: John Hickey
Last Modified: 2012 by Michael Berkowski (fixed attribute quoting)
***********************************************************
Purpose:
Generates the form for Start Date and Due Date information
**********************************************************/
function pres_date($number = "", $myDay = "", $myMon = "", $myYear = "") {
	if ($myDay!=""){
  $combined=$myMon."/".$myDay."/".$myYear;
  }else {
  $combined="";
  }
  //print "<input type= 'text' name='month$number' size='2' maxlength='2' value='$myMon'> - \n";
//	print "<input type= 'text' name='day$number' size='2' maxlength='2' value='$myDay'> - \n";
//	print "<input type= 'text' name='year$number' size='4' maxlength='4' value='$myYear'>\n";

  print "<input type='text' class='date-field' name='".$number."' value='".$combined."'>";

}
 ?>
