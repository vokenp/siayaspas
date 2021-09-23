<h4 class="header blue bolder smaller">Performance Needs</h4>
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
								<th><b>Performance Targets/Activities</b></th>
								<th><b>AgreedNo of Targets</b></th>
								<th><b>Set Weight(%)</b></th>
								<th><b>Results Achieved</b></th>
								<th><b>PA Ratings</b></th>
								<th><b>Remarks</b></th>
						</tr>
						</thead>
						<tbody>
							 <?php
									$html = "";
									$i = 0;
									$TTWeight = 0;
									$TargetAchieved = 0;
									$TTNoofTargets = 0;
									$TTPA_Ratings = 0;
									foreach ($getPerfTargets as $pkey => $pval) {
										$i += 1;
										$TTID = $pval["S_ROWID"];
										$TargetDescription  = $pval["TargetDescription"];
										$WeightPercentage   = $pval["WeightPercentage"];
										$NoOfTargets        = $pval["NoOfTargets"];
										$PA_Ratings         = $pval["PA_Ratings"];
										$SA_ResultsAchieved = $pval["SA_ResultsAchieved"];
										$SA_Remarks         = $pval["SA_Remarks"];
										$TTWeight           += $WeightPercentage;
										$TargetAchieved     += $SA_ResultsAchieved;
										$TTNoofTargets      += $NoOfTargets;
										$TTPA_Ratings      += $PA_Ratings;
										$html .= "<tr>";
										$html .= "<td>$i</td>";
										$html .= "<td>$TargetDescription</td>";
										$html .= "<td>$NoOfTargets</td>";
										$html .= "<td style='text-align:center;font-weight:bold;'>$WeightPercentage %</td>";
										$html .= "<td>$SA_ResultsAchieved</td>";
										$html .= "<td style='text-align:center;font-weight:bold;'>$PA_Ratings %</td>";
										$html .= "<td>$SA_Remarks</td>";
										$html .= "</tr>";
									}
									$html .= "</tbody>";
										$TTPA_Ratings = round($TTPA_Ratings);
										$html .= "<tfoot>";
											$html .= "<tr>";
											$html .= "<th></th>";
											$html .= "<th>Totals </th>";
											$html .= "<th style='text-align:center;'><b>$TTNoofTargets</b></th>";
											$html .= "<th style='text-align:center;'><b>$TTWeight %</b></th>";

											$html .= "<th style='text-align:center;' >$TargetAchieved</th>";
											$html .= "<th style='text-align:center;' >$TTPA_Ratings %</th>";
									$html .= "</tr>";
										$html .= "</tfoot>";
									echo $html;
							 ?>


	          </table>

	      </div>
	  </div><!-- WidgetBox -->
	</div><!-- RightSide -->

</div>
