<h4 class="header blue bolder smaller">Training Needs</h4>
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
									<th>Training Need</th>
									<th>Training Duration</th>
									<th>Appraisee Comment</th>
									<th>Supervisor Comment</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$html ="";
									$getTrainings = $db->GetArray("select *from tbl_section4 where AppraisalID='$cid'");
									    $t = 0;
									  foreach ($getTrainings as $tkey => $tval) {
											$t +=1;
											$TrainingNeed = $tval["TrainingNeed"];
											$TrainingPeriod = $tval["TrainingPeriod"];
											$SA_Comments = $tval["SA_Comments"];
											$SR_Comments = $tval["SR_Comments"];
											$html .="<tr>";
											$html .="<td>$t</td>";
											$html .="<td>$TrainingNeed</td>";
											$html .="<td>$TrainingPeriod</td>";
											$html .="<td>$SA_Comments</td>";
											$html .="<td>$SR_Comments</td>";
											$html .="</tr>";
									  }
										echo $html;

								?>
							</tbody>
	          </table>

	      </div>
	  </div><!-- WidgetBox -->
	</div><!-- RightSide -->

</div>
