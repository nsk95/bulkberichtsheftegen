<?php

$p = $_POST;
if($p['code'] != 1907 && $p['code'] != '1907')
{
	die('Security breach');
}
require_once(__DIR__.'/../vendor/autoload.php');

$path_html 		= __DIR__.'/../data/001.html';
$a_result 		= array();
$i_offset_left 	= 55;
$s_name 		= 'DN20-Berichtsheft-KW';
$s_vername 		= $p['name'];

foreach($p['vars'] as $v)
{
	
	if(empty($v['date']) || empty($v['bt']) 
		|| empty($v['uw']) ||empty($v['school']))
	{
		continue;
	}
	$date 		= new \DateTime($v['date']);
	$s_week		= $date->format('W');
	$s_date1 	= $date->format('d.m.Y');
	$date->add(new \DateInterval('P4D'));
	$s_date2  	= $date->format('d.m.Y');

	$a_tmp_bt 	= explode(' -', $v['bt']);
	$s_bt 		= '';
	$i_bt 		= 132;

	if($a_tmp_bt !== false && count($a_tmp_bt) > 0)
	{
		foreach($a_tmp_bt as $bt)
		{
			$s_bt .= '<p style="position:absolute;top:'.$i_bt.'px;left:'.$i_offset_left.'px;white-space:nowrap" class="ft10">'.$bt.'</p>';
			$i_bt = $i_bt + 30;
			if($i_bt > 360)
			{
				break;
			}
		}
	}

	$a_tmp_uw 	= explode(' -', $v['uw']);
	$s_uw 		= '';
	$i_uw 		= 298;

	if($a_tmp_uw !== false && count($a_tmp_uw) > 0)
	{
		foreach($a_tmp_uw as $uw)
		{
			$s_uw .= '<p style="position:absolute;top:'.$i_uw.'px;left:'.$i_offset_left.'px;white-space:nowrap" class="ft10">'.$uw.'</p>';
			$i_uw = $i_uw + 30;
			if($i_uw > 830)
			{
				break;
			}
		}
	}

	$a_tmp_school 	= explode('#', $v['school']);
	$s_school 		= '';
	$i_school 		= 765;

	if($a_tmp_school !== false && count($a_tmp_school) > 0)
	{
		foreach($a_tmp_school as $school)
		{
			$a_days_schule = explode('- ', $school);
			$s_school .= '<p style="position:absolute;top:795px;left:'.$i_offset_left.'px;white-space:nowrap" class="ft12">'.$a_days_schule[0].'<br/>';
			unset($a_days_schule[0]);
			foreach($a_days_schule as $day)
			{
				$s_school .= $day.'<br/>';
				$i_school = $i_school + 30;
			}
			$s_school .= '</p>';
			$i_school = $i_school + 30;
			if($i_school > 980)
			{
				break;
			}
		}
	}
	$html = file_get_contents($path_html);
	$html = str_replace('###NAME###', $s_vername, $html);
	$html = str_replace('###DATE###', $s_date1.' - '.$s_date2, $html);
	$html = str_replace('###BT###', $s_bt, $html);
	$html = str_replace('###UW###', $s_uw, $html);
	$html = str_replace('###SCHOOL###', $s_school, $html);

	$a_result[$s_name.$s_week] = $html;
}

$a_output = array();

foreach($a_result as $key => $result)
{
	$pdf = new \Mpdf\Mpdf();
	$pdf->WriteHtml($result);
	$a_output[$key.'.pdf'] = $pdf->Output('', \Mpdf\Output\Destination::STRING_RETURN);
}

$zip = new ZipArchive();
$s_zip = __DIR__.'/berichtshefte.zip';

if(file_exists($s_zip))
{
	unlink($s_zip);
}

if(false === $zip->open($s_zip, ZipArchive::CREATE))
{
	die('Fehler bei der Erstellung');
}

foreach($a_output as $k => $v)
{
	$zip->addFromString($k, $v);
}
$zip->close();

header("Content-type: application/zip"); 
header("Content-Disposition: attachment; filename=berichtshefte.zip"); 
header("Pragma: no-cache"); 
header("Expires: 0"); 
readfile("$s_zip");

?>