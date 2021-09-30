<?php
	$getStValues = $db->GetArray("select *from listitems where ItemType='StaffValues'");
	    $stValues = array();
	  foreach ($getStValues as $stkey => $stval) {
			$stValues[$stval["ItemCode"]] = $stval["ItemDescription"];
	  }

		$getScoreRating = $db->GetArray("select *from listitems where ItemType='ScoreRating'");
				$scoresRT = array();
			foreach ($getScoreRating as $rtkey => $rtval) {
				$scoresRT[str_replace('R','',$rtval["ItemCode"])] = $rtval["ItemDescription"];
			}


?>
<h4 class="header blue bolder smaller">Managerial & Supervisor Competencies</h4>
<div class="row">
	<div class="col-xs-12">
	      <div class="widget-box">
	        <div class="widget-header widget-header-flat">
	          <h4 class="widget-title smaller">
	            <i class="ace-icon fa fa-list smaller-80"></i>

	          </h4>
	          <div class="widget-toolbar no-border">

	           </div>
	        </div>
	      <div class="widget-body">
	        <table id="tblObjectives" class="table table-bordered table-striped">
						<thead>
								<tr>
									<th>#</th>
									<th>Value</th>
									<th>SA Rating Score</th>
									<th>SA Remarks</th>
									<th>SR Rating Score</th>
									<th>SR Remarks</th>

								</tr>
							</thead>
							<tbody>
								<?php
									$html ="";
									$get5ARatings = $db->GetArray("select *from tbl_section5b where AppraisalID='$cid'");
									    $r = 0;
											$SAttScore = 0;
											$SRttScore = 0;
									  foreach ($get5ARatings as $rkey => $rval) {
											$r +=1;
											
											$ValueName = $stValues[$rval["ValueType"]];
											$SAScoreRate = $scoresRT[$rval["SA_ScoreValue"]];
											$SRScoreRate = $scoresRT[$rval["SR_ScoreValue"]];
											$SAscore = $rval["SA_ScoreValue"];
											$SAttScore += $SAscore;
											$SA_Remarks = $rval["SA_Remarks"];
											$SRscore = $rval["SR_ScoreValue"];
											$SRttScore += $SRscore;
											$SR_Remarks = $rval["SR_Remarks"];
											$html .="<tr>";
											$html .="<td>$r</td>";
											$html .="<td>$ValueName</td>";
											$html .="<td>$SAScoreRate <b>($SAscore)</b></td>";
											$html .="<td>$SA_Remarks</td>";
											$html .="<td>$SRScoreRate <b>($SRscore)</b></td>";
											$html .="<td>$SR_Remarks</td>";
											$html .="</tr>";
									  }
										$html .= "</tbody>";

										$html .= "<tfoot>";
										$html .= "<tr style='font-size:24px;color:blue;font-weight:bold;'>";
										$html .= "<td colspan='2' style='font-weight:bold;'>Total Score</td>";
										$html .= "<td style='font-weight:bold;color:red;'>$SAttScore</td>";
										$html .= "<td></td>";
										$html .= "<td style='font-weight:bold;color:red;'>$SRttScore</td>";
										$html .= "</tr>";
										$html .= "</tfoot>";
										echo $html;

								?>

	          </table>
						<div class="widget-toolbox padding-8 clearfix text-left" style="font-weight:bold;font-size:16px;">
								<p>SA - Self Appraisal Ratings by the Appraisee</p>
								<p>SR - Supervisors Rating (Taken for Final Score)</p>
	          </div>
	      </div>
	  </div><!-- WidgetBox -->
	</div><!-- RightSide -->

</div>
