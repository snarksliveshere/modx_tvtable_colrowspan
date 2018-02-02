<?php
/** @var modX $modx */
/** @var array $scriptProperties */
if (!isset($tv)){
   return;
}

$tv = (int)$tv;
$classname = isset($classname) ? $classname : 'pricelist';
$did =isset($id) ? $id : $modx->resource->id;

if ($tvObject = $modx->getObject('modTemplateVarResource', array('tmplvarid' => $tv, 'contentid' => $did ))){
    $tvv = $tvObject->get('value');
}

if (!$tvv || $tvv=='[["",""],["",""]]') return;
$tvtArr=json_decode($tvv);
$output='<table class="'.$classname.'">'."\n";
$output .='<tr>'."\n";
$find_span = '/(colspan\=[0-9]{0,2})|(rowspan\=[0-9]{0,2})/u';
for($i=0; $i<count($tvtArr[0]); $i++) {
    if( (stripos($tvtArr[0][$i],'colfalse') === 0) || stripos($tvtArr[0][$i],'colfalse') ) {
        continue;
    }
    if(preg_match($find_span,$tvtArr[0][$i],$match)) {
        $newstr = preg_replace($find_span,'',$tvtArr[0][$i]);
        $output .='<th ' .$match[0]. '>' .$newstr. '</th>'."\n";  
        continue;
    }
    $output .='<th>' .$tvtArr[0][$i]. '</th>'."\n";
}
$output.='</tr>'."\n";

for($row=1; $row<count($tvtArr); $row++) {
	$output .='<tr'.(($row%2) ? '' : ' class="altrow"').'>'."\n";
	for($i=0; $i<count($tvtArr[$row]); $i++) {
	    if( ( (stripos($tvtArr[$row][$i],'colfalse') === 0) || stripos($tvtArr[$row][$i],'colfalse') ) || ( (stripos($tvtArr[$row][$i],'rowfalse') === 0) || stripos($tvtArr[$row][$i],'rowfalse') )  ) {
            continue;
        }
        if(preg_match($find_span,$tvtArr[$row][$i],$match)) {
            $newstr = preg_replace($find_span,'',$tvtArr[$row][$i]);
            $output .='<td ' .$match[0]. '>' .$newstr. '</td>'."\n";  
            continue;
        }
	    $output .='<td>' .$tvtArr[$row][$i]. '</td>'."\n";    
	}
	$output.='</tr>'."\n";
}
$output.='</table>';
return $output;