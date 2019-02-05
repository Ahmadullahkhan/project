<?php 
include ("includes/functions.php");
include ("includes/connection.php");

 
if(isset($_POST['searchbtn'])){
	$search_by=$_POST['search_by'];
    $search=$_POST['search'];
	$campus=$_POST['campus'];
	$department=$_POST['department'];
	$search_type=$_POST['search_type'];
	
	if($search_type=="force_search"){
		
		// force search when department and campus both are not selectd
		if(($campus=="0")&& ($department=="0") && ($search_by=="name")){
		 $result=force_search_by_name($search);	
		}else if(($campus=="0")&& ($department=="0") && ($search_by=="phone")){
			$result=force_search_by_phone($search);
		} else if(($campus=="0")&& ($department=="0") && ($search_by=="cnic")){
			$result=force_search_by_cnic($search);
		} else if(($campus=="0")&& ($department=="0") && ($search_by=="domicile")){
		$result=force_search_by_domicile($search);
		
		
		// force search when only campus is selected (not department).
	
		} else if (($campus!="0")&& ($department=="0") && ($search_by=="name")){
			$result=force_search_by_campus_by_name($campus,$search);
		} else if (($campus!="0")&& ($department=="0") && ($search_by=="phone")){
			$result=force_search_by_campus_by_phone($campus,$search);
		}else if (($campus!="0")&& ($department=="0") && ($search_by=="cnic")){
			$result=force_search_by_campus_by_cnic($campus,$search);
		} else if (($campus!="0")&& ($department=="0") && ($search_by=="domicile")){
			$result=force_search_by_campus_by_domicile($campus,$search);
		}
		
		// force search when only  department is selected (not campus )
		    else if (($campus=="0")&& ($department!="0") && ($search_by=="name")){
            $result=force_search_by_department_by_name($search,$department);
  		    }else if (($campus=="0")&& ($department!="0") && ($search_by=="phone")){
            $result=force_search_by_department_by_phone($search,$department);
  		    }else if (($campus=="0")&& ($department!="0") && ($search_by=="phone")){
            $result=force_search_by_department_by_cnic($search,$department);
  		    } else if (($campus=="0")&& ($department!="0") && ($search_by=="phone")){
            $result=force_search_by_department_by_domicile($search,$department);
  		    }
			
		// force search when both Department and campus are selected .
	
		else if (($campus !="0") && ($department!="0") &&($search_by=="name")){
			$result=force_search_by_dept_campus_by_name($department,$campus,$search);
		} else if (($campus !="0") && ($department!="0") &&($search_by=="phone")){
			$result=force_search_by_dept_campus_by_phone($department,$campus,$search);
		} else if (($campus !="0") && ($department!="0") &&($search_by=="cnic")){
			$result=force_search_by_dept_campus_by_cnic($department,$campus,$search);
		}
		else if (($campus !="0") && ($department!="0") &&($search_by=="domicile")){
			$result=force_search_by_dept_campus_by_domicile($department,$campus,$search);
	    }
// loose search  when both (campus and department) are not selected.
	 }else{
		 if(($campus=="0")&& ($department=="0") && ($search_by=="name")){
		    $result=loose_search_by_name($search);
		 }else if(($campus=="0")&& ($department=="0") && ($search_by=="phone")){
			$result=loose_search_by_phone($search);
		} else if(($campus=="0")&& ($department=="0") && ($search_by=="cnic")){
			$result=loose_search_by_cnic($search);
		} else if(($campus=="0")&& ($department=="0") && ($search_by=="domicile")){
		$result=loose_search_by_domicile($search);
		}
 
 
 
 // loose search when campus is selected. 
		    else if (($campus!="0")&& ($department=="0") && ($search_by=="name")){
			$result=loose_search_by_campus_by_name($campus,$search);
		    } else if (($campus!="0")&& ($department=="0") && ($search_by=="phone")){
			$result=loose_search_by_campus_by_phone($campus,$search);
		    }else if (($campus!="0")&& ($department=="0") && ($search_by=="cnic")){
			$result=loose_search_by_campus_by_cnic($campus,$search);
		    } else if (($campus!="0")&& ($department=="0") && ($search_by=="domicile")){
			$result=loose_search_by_campus_by_domicile($campus,$search);
			}
		
// loose search when department is selected
		    else if (($campus=="0")&& ($department !="0") && ($search_by=="name")){
			$result=loose_search_by_department_by_name($department,$search);
		    } else if (($campus=="0")&& ($department!="0") && ($search_by=="phone")){
			$result=loose_search_by_department_by_phone($department,$search);
		    }else if (($campus=="0")&& ($department !="0") && ($search_by=="cnic")){
			$result=loose_search_by_department_by_cnic($department,$search);
		    } else if (($campus=="0")&& ($department !="0") && ($search_by=="domicile")){
			$result=loose_search_by_department_by_domicile($department,$search);
		    }
			
// LOOSE SEARCH WHEN BOTH (DEPARTMENT & CAMPUS) IS SELECTED.
           else if (($campus !="0") && ($department!="0") &&($search_by=="name")){
			$result=loose_search_by_dept_campus_by_name($department,$campus,$search);
		} else if (($campus !="0") && ($department!="0") &&($search_by=="phone")){
			$result=loose_search_by_dept_campus_by_phone($department,$campus,$search);
		} else if (($campus !="0") && ($department!="0") &&($search_by=="cnic")){
			$result=loose_search_by_dept_campus_by_cnic($department,$campus,$search);
		}
		else if (($campus !="0") && ($department!="0") &&($search_by=="domicile")){
			$result=loose_search_by_dept_campus_by_domicile($department,$campus,$search);
	    }
           
	
	}// end of else body.
	
	
}else{
	redirect_to("search.php");

}

$record=mysql_fetch_array($result);
echo $record['name'];
echo "<br/>";
echo $record['cnic'];
echo "<br/>";
echo $record['campus'];



?>