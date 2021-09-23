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
									<th>Rating Type</th>
									<th>Rating Score</th>
									<th>Remarks</th>

								</tr>
							</thead>
							<tbody>
								<?php
									$html ="";
									$get5ARatings = $db->GetArray("select *from tbl_section5b where AppraisalID='$cid'");
									    $r = 0;
											$ttScore = 0;
									  foreach ($get5ARatings as $rkey => $rval) {
											$r +=1;
											$ValueName = $stValues[$rval["ValueType"]];
											$ScoreRate = $scoresRT[$rval["SA_ScoreValue"]];
											$score = $rval["SA_ScoreValue"];
											$ttScore += $score;
											$SA_Remarks = $rval["SA_Remarks"];
											$html .="<tr>";
											$html .="<td>$r</td>";
											$html .="<td>$ValueName</td>";
											$html .="<td>$ScoreRate</td>";
											$html .="<td>$score</td>";
											$html .="<td>$SA_Remarks</td>";
											$html .="</tr>";
									  }
										$html .= "</tbody>";

										$html .= "<tfoot>";
										$html .= "<tr>";
										$html .= "<td colspan='3' style='font-weight:bold;'>Total Score</td>";
										$html .= "<td style='font-weight:bold;color:red;'>$ttScore</td>";
										$html .= "</tr>";
										$html .= "</tfoot>";

										echo $html;

								?>

	          </table>

	      </div>
	  </div><!-- WidgetBox -->
	</div><!-- RightSide -->

</div>
