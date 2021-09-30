<?php
session_start();
include("assets/bin/con_db.php");
 require_once __DIR__ . '/assets/mpdf/vendor/autoload.php';
global $db;

     error_reporting(E_ALL);
     ini_set('display_errors', 1);

  $AppraisalID = filter_input(INPUT_GET,"appid");
  $rst = $rs->row("vw_closedappraisals","S_ROWID=$AppraisalID");
    $AppraiseeName = $rst["Fullname"];
    $AppPeriod = $rst["PeriodName"];
  $url = "";
     $mpdf = new \Mpdf\Mpdf([
    'setAutoTopMargin' => 'stretch',
    'autoMarginPadding' => 3,
    'orientation' => 'L'
]);


     $stylesheet = file_get_contents('mpdfstyle.css');
    $mpdf->WriteHTML($stylesheet,1);
  $dateCreated = date('D jS M Y g:i a');

    $mpdf->SetWatermarkImage('assets/images/siayalogo.png');
    $mpdf->showWatermarkImage = true;
    $mpdf->watermarkImageAlpha = 0.1;
 //$db->debug=1;


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

    $html ="";
    $html .= "<div class='center'>";
    $html .="<p style='v-align:center;'> <img src='assets/images/siayalogo.png' width='300px' height='52px'></p>";
    $html .="<p style='v-align:center;'><h2>STAFF PERFORMANCE REPORT</h2></p>";
    $html .= "</div>";

      $html .= "<h4>SECTION 1: PERSONAL PARTICULARS</h4>";

     $html .= "<table class='gridtable' width='99%'>";

          $html .= "<tbody>";
          $html .= "<tr>";
              $html .= "<td class='bggray'>Appraisee PFNo :</td>";
              $html .= "<td>".$rst["AppraiseeUserID"]."</td>";
              $html .= "<td class='bggray'>Appraisal Period :</td>";
              $html .= "<td>".$rst["PeriodName"]."</td>";
          $html .= "</tr>";

          $html .= "<tr>";
              $html .= "<td class='bggray'>Appraisee Name:</td>";
              $html .= "<td>".$rst["Fullname"]."</td>";
              $html .= "<td class='bggray'>Period Begins:</td>";
              $html .= "<td>".date('D jS M Y',strtotime($rst["PeriodBegins"]))."</td>";
          $html .= "</tr>";

          $html .= "<tr>";
              $html .= "<td class='bggray'>PhoneNo :</td>";
              $html .= "<td>".$rst["Phone"]."</td>";
              $html .= "<td class='bggray'>Period Ends:</td>";
              $html .= "<td>".date('D jS M Y',strtotime($rst["PeriodEnds"]))."</td>";
          $html .= "</tr>";

          $html .= "<tr>";
              $html .= "<td class='bggray'>Email :</td>";
              $html .= "<td>".$rst["Email"]."</td>";
              $html .= "<td class='bggray'>Supervisor:</td>";
              $html .= "<td>".$rst["HeadofDept"]."</td>";
          $html .= "</tr>";

          $html .= "<tr>";
              $html .= "<td class='bggray'>Designation :</td>";
              $html .= "<td>".$rst["Position"]."</td>";
              $html .= "<td class='bggray'>Department:</td>";
              $html .= "<td>".$rst["DepartmentName"]."</td>";
          $html .= "</tr>";

          $html .= "</tbody>";
          $html .= "</table>";

          $mpdf->AddPage();
          $html .= "<pagebreak />";

        $html .= "<h4>SECTION 2: DEPARTMENTAL OBJECTIVES</h4>";
          $html .= "<table class='gridtable' width='99%'>";
           $html .= "<thead>";
               $html .= "<tr>";
               $html .= "<th>#</th>";
               $html .= "<th>List of Departmental Objectives</th>";

               $html .= "</tr>";
               $html .= "</thead>";
               $html .= "<tbody>";

                $UDeptID = $rst["Department"];
                $PeriodID = $rst["AppPeriodID"];
                 $getdeptObjs = $db->GetArray("select *,getuinfo(CreatedBy) as CreatedName from vw_depttargetlists where DeptID='$UDeptID' and PeriodID='$PeriodID'");
                 $i = 0;

                 foreach ($getdeptObjs as $okey => $oval) {
                   $i += 1;
                   $TargetDescription = $oval["TargetDescription"];
                   $CreatedBy = $oval["CreatedName"]." on ".date('D jS M Y g:i A',strtotime($oval["DateCreated"]));
                   $html .="<tr>";
                     $html .="<td>$i</td>";
                     $html .="<td>$TargetDescription</td>";

                   $html .="</tr>";
                 }
               $html .= "</tbody>";
               $html .= "</table>";

               //$mpdf->AddPage();
               $html .= "<pagebreak />";

        $html .= "<h4>SECTION 3: PERFORMANCE TARGETS</h4>";

        $html .= "<table class='gridtable' width='99%'>";
         $html .= "<thead>";
             $html .= "<tr>";
             $html .= "<th>#</th>";
             $html .= "<th>Performance Targets/Activities</th>";

             $html .= "<th><b>AgreedNo of Targets</b></th>";
             $html .= "<th><b>Set Weight(%)</b></th>";
             $html .= "<th><b>Results Achieved</b></th>";
             $html .= "<th><b>PA Ratings</b></th>";
             $html .= "<th><b>Appraisee Remarks</b></th>";
             $html .= "<th><b>Supervisor Remarks</b></th>";
             $html .= "</tr>";
             $html .= "</thead>";
             $html .= "<tbody>";
             $getPerfTargets = $db->GetArray("select *from tbl_section3 where AppraisalID='$AppraisalID'");

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
                $SR_Remarks         = $pval["SR_Remarks"];
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
                $html .= "<td>$SR_Remarks</td>";
                $html .= "</tr>";
              }
              $html .= "</tbody>";
                $TTPA_Ratings = round($TTPA_Ratings);
                $html .= "<tfoot>";
                  $html .= "<tr style='font-size:18px;color:blue;font-weight:bold;'>";
                  $html .= "<th></th>";
                  $html .= "<th>Totals </th>";
                  $html .= "<th style='text-align:center;'><b>$TTNoofTargets</b></th>";
                  $html .= "<th style='text-align:center;'><b>$TTWeight %</b></th>";

                  $html .= "<th style='text-align:center;' >$TargetAchieved</th>";
                  $html .= "<th style='text-align:center;' >$TTPA_Ratings %</th>";
              $html .= "</tr>";
                $html .= "</tfoot>";
             $html .= "</table>";

              $html .= "<pagebreak />";
            $html .= "<h4>SECTION 4: STAFF TRAINING AND DEVELOPMENT PLAN</h4>";

            $html .= "<table class='gridtable' width='99%'>";
             $html .= "<thead>";
                 $html .= "<tr>";
                 $html .= "<th>#</th>";
                 $html .= "<th>Training Need</th>";
                 $html .= "<th>Training Duration</th>";
                 $html .= "<th>Appraisee Comment</th>";
                 $html .= "<th>Supervisor Comment</th>";
                 $html .= "</tr>";
                 $html .= "</thead>";
                 $html .= "<tbody>";
                 $getTrainings = $db->GetArray("select *from tbl_section4 where AppraisalID='$AppraisalID'");
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
                 $html .= "</tbody>";
                 $html .= "</table>";

                   $html .= "<pagebreak />";
                $html .= "<h4>SECTION 5A: VALUES/STAFF COMPETENCIES</h4>";
                $html .= "<table class='gridtable' width='99%'>";
                 $html .= "<thead>";
                     $html .= "<tr>";
                     $html .= "<th>#</th>";
                     $html .= "<th>Value</th>";
   									$html .= "<th>SA Rating Score</th>";
   									$html .= "<th>SA Remarks</th>";
   									$html .= "<th>SR Rating Score</th>";
   									$html .= "<th>SR Remarks</th>";

                     $html .= "</tr>";
                     $html .= "</thead>";
                     $html .= "<tbody>";
                     $get5ARatings = $db->GetArray("select *from tbl_section5a where AppraisalID='$AppraisalID'");
   									    $r = 0;
   											$SAttScore = 0;
   											$SRttScore = 0;
   									  foreach ($get5ARatings as $rkey => $rval) {
   											$r +=1;
   											$ValueName = $stValues[$rval["ValueType"]];
   											$SAScoreRate = $scoresRT[$rval["SA_ScoreValue"]];
   											$SRScoreRate = $scoresRT[$rval["SR_ScoreValue"]];
   											$SAscore = $rval["SA_ScoreValue"];
   											$SRscore = $rval["SR_ScoreValue"];
   											$SAttScore += $SAscore;
   											$SRttScore += $SRscore;
   											$SA_Remarks = $rval["SA_Remarks"];
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

                     $html .= "</table>";

                       $html .= "<pagebreak />";
                     $html .= "<h4>SECTION 5B: MANAGERIAL AND SUPERVISORY COMPETENCIES</h4>";

                     $html .= "<table class='gridtable' width='99%'>";
                      $html .= "<thead>";
                          $html .= "<tr>";
                          $html .= "<th>#</th>";
                          $html .= "<th>Value</th>";
        									$html .= "<th>SA Rating Score</th>";
        									$html .= "<th>SA Remarks</th>";
        									$html .= "<th>SR Rating Score</th>";
        									$html .= "<th>SR Remarks</th>";

                          $html .= "</tr>";
                          $html .= "</thead>";
                          $html .= "<tbody>";

                          $get5ARatings = $db->GetArray("select *from tbl_section5b where AppraisalID='$AppraisalID'");
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

                          $html .= "</table>";

                            $html .= "<pagebreak />";
                          $html .= "<h4>SECTION 8: APPRAISEES COMMENTS ON APPRAISAL BY THE SUPERVISOR</h4>";

                          $html .= "<table class='gridtable' width='99%'>";
                               $html .= "<tbody>";
                               $html .= "<tr>";
                                $html .= " <td>8A</td>";
                                 $html .= "<td><p style='font-weight:bold;'>DID PERFORMANCE-RELATED DISCUSSIONS TAKE PLACE DURING THE REPORTING PERIOD WITH YOUR SUPERVISOR?</p></td>";
                                $html .= " <td>".$rst["IsPerformanceDiscussion"]."</td>";
                              $html .= "</tr>";
                            $html .= "  <tr>";
                              $html .= "  <td>8B</td>";
                                $html .= "<td><p style='font-weight:bold;'>General Comments (if any) on your overall performance</p></td>";
                                $html .= "<td>".$rst["SA_FinalComments"]."</td>";
                             $html .= "</tr>";
                               $html .= "</tbody>";
                               $html .= "</table>";

                               $UserType = $rst["user_type"];
                               $Section3  = $db->GetOne("select round(sum(PA_Ratings),2) as PA_Ratings from tbl_section3 where AppraisalID=$AppraisalID");
                               $Section5a = $db->GetOne("select round(sum(SR_ScoreValue),2) as SR_ScoreValue from tbl_section5a where AppraisalID=$AppraisalID");

                               $S3Score = $Section3 * 0.7;
                               $S5aScore = $Section5a * 0.5;
                               $S10ATotal = $S3Score + $S5aScore;

                                 $Section5b = 0;
                                 $S5bScore = 0;
                                 $S3BScore = 0;
                                 $S5abScore = 0;
                                 $S10BTotal = 0;
                                 $Section3b = 0;
                                 $Section5ab = 0;
                                  if($UserType == "HeadofDepartments")
                                  {
                                    $Section3b = $Section3;
                                    $Section5ab = $Section5a;
                                    $Section5b = $db->GetOne("select round(sum(SR_ScoreValue),2) as SR_ScoreValue from tbl_section5b where AppraisalID=$AppraisalID");
                                    $S5bScore = $Section5b * 0.5;
                                    $S3BScore = $Section3 * 0.5;
                                    $S5abScore = $Section5ab * 0.5;
                                    $S10BTotal = $S3BScore + $S5abScore + $S5bScore;
                                  }
                                  $html .= "<h3>SECTION 10: PERFORMANCE TARGETS</h3>";

                                    $html .= "<h4 style='text-align:center;'>A. STAFF WITHOUT SUPERVISORY ROLES</h4>";

                                  $html .= "<table class='gridtable' width='99%'>";
                                   $html .= "<thead>";
                                       $html .= "<tr>";

                                       $html .= "<th class='bggrayc'>Section 3</th>";
                                       $html .= "<th class='bggrayc'>Section 5A</th>";
                                       $html .= "<th class='bggrayc'>Score</th>";

                                       $html .= "</tr>";
                                       $html .= "</thead>";
                                       $html .= "<tbody>";
                                       $html .= "<tr>";
                                           $html .= "<td><h4>PA Ratings Score : $Section3 x 0.7 = $S3Score </h4></td>";
                                          $html .= " <td><h4>Score : $Section5a x 0.5 = $S5aScore</h4></td>";
                                           $html .= "<td><h4>Total Score : $S10ATotal % </h4></td>";
                                       $html .= "</tr>";
                                       $html .= "</tbody>";
                                       $html .= "</table>";

                              $html .= "<h4 style='text-align:center;'>B. STAFF WITH SUPERVISORY ROLES</h4>";

                              $html .= "<table class='gridtable' width='99%'>";
                               $html .= "<thead>";
                                   $html .= "<tr>";

                                   $html .= "<th class='bggrayc'>Section 3</th>";
                                   $html .= "<th class='bggrayc'>Section 5A</th>";
                                   $html .= "<th class='bggrayc'>Section 5B</th>";
                                   $html .= "<th class='bggrayc'>Score</th>";

                                   $html .= "</tr>";
                                   $html .= "</thead>";
                                   $html .= "<tbody>";
                                   $html .= "<tr>";
                                   $html .= "<td><h4>PA Ratings Score : $Section3b x 0.5 = $S3BScore</h4></td>";
                                   $html .= "<td><h4>Score : $Section5ab x 0.5 = $S5abScore</h4></td>";
                                   $html .= "<td><h4>Score : $Section5b x 0.5 = $S5bScore</h4></td>";
                                   $html .= "<td><h4>Total Score : $S10BTotal % </h4></td>";
                                   $html .= "</tr>";
                                   $html .= "</tbody>";
                                   $html .= "</table>";

    $foothtml = "<hr/>";
   $foothtml .= "<table width='100%'><tr>";
   $foothtml .= "<td width='33%'>{DATE j-m-Y}</td>";
   $foothtml .= "<td width='33%' align='center'>{PAGENO}/{nbpg}</td>";
   $foothtml .= "<td width='33%' style='text-align: right;'>$AppPeriod - $AppraiseeName</td>";
   $foothtml .= "</tr></table>";

   $mpdf->SetHTMLFooter($foothtml);

   $mpdf->WriteHTML($html);
      // Set a simple Footer including the page number
  $mpdf->setHeader("Generated on $dateCreated");
  $FileName = $AppPeriod."-".$AppraiseeName;
  $mpdf->Output($FileName."_".date('ymdhms').".pdf", "D");
  //$mpdf->Output();
?>
