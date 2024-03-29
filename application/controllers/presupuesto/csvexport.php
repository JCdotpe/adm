<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Csvexport extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->load->library('ion_auth');
		$this->load->helper('form');
		$this->load->library('PHPExcel');
		$this->load->model('presupuesto/presupuesto_model');

		// if (!$this->ion_auth->logged_in()) {
		// 	redirect('auth/login');
		// }

		// $roles = $this->ion_auth->get_roles();
		// $flag = FALSE;
		// foreach ($roles as $role) {
		// 	if ($role->id == 6) {
		// 		$flag = TRUE;
		// 		break;
		// 	}
		// }

		// if (!$flag) {
		// 	show_404();
		// 	die();
		// }
	}

	public function exp_presupuesto()
	{

		$cod_area = 1;
		$cod_pryct = '00000001';
		$anio = '2014';

		$query =  $this->presupuesto_model->get_pptt_proyect( $cod_area, $cod_pryct );

		// cantidad de meses del proyecto
		foreach ($query->result() as $filas) {
			$Cantidad_Mes = $filas->Cantidad_Mes;
		}

		$fromCell = array();
		$col_index = 13; // indice del primer mes
		for ($x=0; $x < $Cantidad_Mes; $x++) {
			array_push($fromCell, PHPExcel_Cell::stringFromColumnIndex($col_index));
			$col_index++;
		}

		$pr_mes = $fromCell[0];
		$ult_mes = $fromCell[$Cantidad_Mes-1];

		// pestaña
		$sheet = $this->phpexcel->getActiveSheet(0);

		//colores y estilos
		$alignment_general = array(
			'alignment' => array(
				'wrap' => true,
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
		);

		$style_cabecera_general = array(
			'font' => array(
				'bold' => true,
				'color' => array('rgb' => '366092'),
			)
		);

		$style_celda_general = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => '215967')
			),
			'font' => array(
				'bold' => true,
				'color' => array('rgb' => 'FFFFFF'),
				'size' => 12,
			),
			// 'borders' => array(
			// 	'right' => array(
			// 		'style' => PHPExcel_Style_Border::BORDER_THICK,
			// 		'color' => array('rgb' => 'FFFFFF'),
			// 	),
			// ),
		);

		$style_fondo_uno = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => '31869B')
			),
			'font' => array(
				'bold' => true,
				'color' => array('rgb' => 'FFFFFF'),
			),
		);
		
		////////////////////////////////
		// formato de la hoja ( Set Orientation, size and scaling )
		////////////////////////////////

		$sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);// horizontal
		$sheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A3);
		$sheet->getPageSetup()->setFitToPage(false); // ajustar pagina
		$sheet->getPageSetup()->setFitToWidth(1);
		$sheet->getPageSetup()->setFitToHeight(0);
		$sheet->getDefaultStyle()->getFont()->setName('Calibri');
		$sheet->getDefaultStyle()->getFont()->setSize(10);
		$sheet->getDefaultStyle()->applyFromArray($alignment_general);
		$sheet->getSheetView()->setZoomScale(70);

		// ancho y altura de columnas del file
		$sheet->getColumnDimension('A')->setWidth(12);
		$sheet->getColumnDimension('B')->setWidth(2);
		$sheet->getColumnDimension('C')->setWidth(20);
		$sheet->getColumnDimension('D')->setWidth(77);
		$sheet->getColumnDimension('E')->setWidth(16);
		$sheet->getColumnDimension('F')->setWidth(7);
		$sheet->getColumnDimension('G')->setWidth(16);
		$sheet->getColumnDimension('H')->setWidth(13);
		$sheet->getColumnDimension('I')->setWidth(31);
		$sheet->getColumnDimension('J')->setWidth(12);
		$sheet->getColumnDimension('K')->setWidth(2);
		$sheet->getColumnDimension('L')->setWidth(33);
		$sheet->getColumnDimension('M')->setWidth(2);

		// ancho de los meses
		for ($i=0; $i < count($fromCell) ; $i++) { 
			$sheet->getColumnDimension($fromCell[$i])->setWidth(25);
		}

		$sheet->getRowDimension(1)->setRowHeight(38);
		$sheet->getRowDimension(2)->setRowHeight(38);
		$sheet->getRowDimension(3)->setRowHeight(38);
		$sheet->getRowDimension(5)->setRowHeight(54);
		$sheet->getRowDimension(6)->setRowHeight(4);
		$sheet->getRowDimension(7)->setRowHeight(30);
		$sheet->getRowDimension(10)->setRowHeight(6);
		$sheet->getRowDimension(11)->setRowHeight(32);
		$sheet->getRowDimension(12)->setRowHeight(3);

		$sheet->getRowDimension(13)->setRowHeight(17);
		$sheet->getRowDimension(14)->setRowHeight(17);
		$sheet->getRowDimension(15)->setRowHeight(17);
		$sheet->getRowDimension(16)->setRowHeight(17);
		$sheet->getRowDimension(17)->setRowHeight(17);
		$sheet->getRowDimension(18)->setRowHeight(17);
		$sheet->getRowDimension(19)->setRowHeight(17);
		$sheet->getRowDimension(20)->setRowHeight(17);

		////////////////////////////////
		// Logo
		////////////////////////////////
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setWorksheet($sheet);
		$objDrawing->setName("inei");
		$objDrawing->setDescription("Inei");
		$objDrawing->setPath("img/inei.jpeg");
		$objDrawing->setCoordinates('C1');
		$objDrawing->setHeight(80);
		$objDrawing->setOffsetX(1);
		$objDrawing->setOffsetY(5);

		////////////////////////////////
		// Cabecera General
		////////////////////////////////
		$sheet->setCellValue('C2','PRESUPUESTO POR ACTIVIDADES');
			$sheet->mergeCells('C1:'.$ult_mes.'1');
			$sheet->getStyle('C1:'.$ult_mes.'1')->getFont()->setSize(16);
			$sheet->mergeCells('C2:'.$ult_mes.'2');
			$sheet->getStyle('C2:'.$ult_mes.'2')->getFont()->setSize(12);
			$sheet->mergeCells('C3:'.$ult_mes.'3');
			$sheet->getStyle('C3:'.$ult_mes.'3')->getFont()->setSize(11);
			
			$sheet->getStyle('C1:'.$ult_mes.'3')->applyFromArray($style_cabecera_general);

		////////////////////////////////
		//Datos Generales del Proyecto
		////////////////////////////////
		$sheet->setCellValue('C5','PART.');
			$sheet->getStyle('C5')->applyFromArray($style_celda_general)
				->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK)->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_WHITE));

		$sheet->setCellValue('D5','ACTIVIDADES');
			$sheet->mergeCells('D5:H5');
			$sheet->getStyle('D5:H5')->applyFromArray($style_celda_general)
				->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK)->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_WHITE));

		$sheet->setCellValue('I5','TOTAL GENERAL S/.');
			$sheet->mergeCells('I5:J5');
			$sheet->getStyle('I5:J5')->applyFromArray($style_celda_general);

		$sheet->setCellValue('L5','TOTAL');
			$sheet->getStyle('L5')->applyFromArray($style_celda_general);

		// datos generales - meses
		$sheet->getStyle('N5:'.$ult_mes.'5')->applyFromArray($style_celda_general);
		for ($i=0; $i < count($fromCell) ; $i++) { 
			$sheet->getStyle($fromCell[$i].'5')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK)->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_WHITE));
		}

		$sheet->setCellValue('G7','TOTAL GENERAL');
			$sheet->mergeCells('G7:H7');
			$sheet->getStyle('C7:J7')->applyFromArray($style_fondo_uno);

		$sheet->setCellValue('G8','IGV');
			$sheet->mergeCells('G8:H8');

		$sheet->setCellValue('G9','SUB - TOTAL');
			$sheet->mergeCells('G9:H9');

		$sheet->getStyle('C7:H9')->getFont()->setSize(12);
		$sheet->getStyle('C7:H9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$sheet->getStyle('C8:H9')->getFont()->setBold(true)->getColor()->setRGB('366092');

		// style de contenido 1
		$sheet->mergeCells('I7:J7');
		$sheet->mergeCells('I8:J8');
		$sheet->mergeCells('I9:J9');
		$sheet->getStyle('I7:J9')->getFont()->setSize(15);
		$sheet->getStyle('I7:J9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$sheet->getStyle('I7:J9')->getNumberFormat()->setFormatCode('#,##0.00');

		$sheet->getStyle('L7')->applyFromArray($style_fondo_uno);
		$sheet->getStyle('L7:L9')->getFont()->setSize(15);
		$sheet->getStyle('L7:L9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$sheet->getStyle('L7:L9')->getNumberFormat()->setFormatCode('#,##0.00');

		// contenido 1 - datos generales
		foreach ($query->result() as $filas) {
			$sheet->getCellByColumnAndRow(2,1)->setValue(utf8_encode($filas->Proyecto));
			$sheet->getCellByColumnAndRow(2,3)->setValue(utf8_encode($filas->Descripcion));
			$sheet->getCellByColumnAndRow(8,7)->setValue($filas->Total_Gral);
			$sheet->getCellByColumnAndRow(11,7)->setValue($filas->Total_Gral);

			$sheet->getCellByColumnAndRow(8,8)->setValue($filas->IGV);
			$sheet->getCellByColumnAndRow(11,8)->setValue($filas->IGV);

			$sheet->getCellByColumnAndRow(8,9)->setValue($filas->Subtotal);
			$sheet->getCellByColumnAndRow(11,9)->setValue($filas->Subtotal);
		}

		////////////////////////////////////
		//Datos de Actividades del Proyecto
		////////////////////////////////////
		$sheet->setCellValue('C11','ACTIVIDADES');
			$sheet->mergeCells('C11:D11');
			$sheet->getStyle('C11:D11')->applyFromArray($style_celda_general)
				->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK)->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_WHITE));

		$sheet->setCellValue('E11','SUB - TOTAL');
			$sheet->mergeCells('E11:H11');
			$sheet->getStyle('E11:H11')->applyFromArray($style_celda_general)
				->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK)->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_WHITE));

		$sheet->getStyle('I11')->applyFromArray($style_celda_general)
				->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK)->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_WHITE));

		$sheet->setCellValue('J11','%');
		$sheet->getStyle('J11')->applyFromArray($style_celda_general);

		$sheet->getStyle('L11')->applyFromArray($style_celda_general);

		// contenido 2 - Actividades
		$col_c2 = 13;
		$fil_c2 = 13;
		$i = 0;
		$mes = 0;
		$tot_grl = 0;

		$query_pa =  $this->presupuesto_model->get_data_pa( $cod_area, $cod_pryct, $anio );

		foreach ($query_pa->result() as $filas) {
			if ( $i == 0) {
				$sheet->getCellByColumnAndRow($col_c2,$fil_c2)->setValue($filas->Monto_Act);
				$tot_grl = $filas->Monto_Act; // se puede cambiar
				$mes = $filas->Mes;
			}else {
				$col_c2 = ( $mes != $filas->Mes ) ? ( $col_c2 + 1 ) : $col_c2;
				$fil_c2 = ( $mes != $filas->Mes ) ? 13 : ( $fil_c2 + 1 );
				$sheet->getCellByColumnAndRow($col_c2,$fil_c2)->setValue($filas->Monto_Act);
				$tot_grl = $tot_grl + $filas->Monto_Act; // se puede cambiar
				$mes = $filas->Mes;
			}
			$sheet->getCellByColumnAndRow(2,$fil_c2)->setValue($filas->Nro_Act);
			$sheet->getCellByColumnAndRow(3,$fil_c2)->setValue(utf8_encode($filas->Descripcion));
			$i++;
		}

		$fromCell = PHPExcel_Cell::stringFromColumnIndex(13);
		$sheet->setCellValue('N11',$fromCell);


		$sheet->setCellValue('I11',$tot_grl);
			$sheet->getStyle('I11')->getNumberFormat()->setFormatCode('#,##0.00');
		$sheet->setCellValue('L11',$tot_grl);
			$sheet->getStyle('L11')->getNumberFormat()->setFormatCode('#,##0.00');

		$sheet->getStyle('C13:J20')->applyFromArray($style_fondo_uno);
		$sheet->getStyle('L13:L20')->applyFromArray($style_fondo_uno);
		$sheet->getStyle('N13:P20')->applyFromArray($style_fondo_uno);

		$sheet->getStyle('D13:D20')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);



		//SALIDA EXCEL ( Propiedades del archivo excel )
		$sheet->setTitle("Presupuesto");
		$this->phpexcel->getProperties()
		->setTitle("Presupuesto1")
		->setDescription("Presupuesto2");
		header("Content-Type: application/vnd.ms-excel");
		$nombreArchivo = 'Presupuesto'.date('Y-m-d');
		header("Content-Disposition: attachment; filename=\"$nombreArchivo.xls\""); 
		header("Cache-Control: max-age=0");
		
		// Genera Excel
		$writer = PHPExcel_IOFactory::createWriter($this->phpexcel, "Excel5");

		$writer->save('php://output');
		exit;
	}

	// public function ExportacionUbigeo_Avance()
	// {

	// 	$depa = 99; //$this->input->get('vdepa');
	// 	$prov = 0; //$this->input->get('vprov');
	// 	$periodo_min = 1; // $this->input->get('vperiodo1');
	// 	$periodo_max = 14; //$this->input->get('vperiodo2');
		
	// 	$tipo = 0;

	// 	if ($depa!=99 && $prov!=99)
	// 	{
	// 		$tipo = 1;
	// 	}elseif ($depa!=99 && $prov==99){
	// 		$tipo = 2;
	// 	}elseif ($depa==99){
	// 		$tipo = 3;
	// 	}

	// 	//echo $tipo;

	// 	$query = $this->presupuesto_model->get_avance_ubigeo($depa,$prov,$periodo_min,$periodo_max,$tipo);
				  
	// 	// pestaña
	// 	$sheet = $this->phpexcel->getActiveSheet(0);

	// 	//colores
	// 		$color_celda_cabeceras =   array(
	// 			'fill' => array(
	// 				'type' => PHPExcel_Style_Fill::FILL_SOLID,
	// 				'color' => array('rgb' => '27408B')
	// 			)
	// 		);
	// 	//colores
		
	// 	// formato de la hoja
	// 		// Set Orientation, size and scaling
	// 		$sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);// horizontal
	// 		$sheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
	// 		$sheet->getPageSetup()->setFitToPage(false); // ajustar pagina
	// 		$sheet->getPageSetup()->setFitToWidth(1);
	// 		$sheet->getPageSetup()->setFitToHeight(0);		
	// 	// formato de la hoja

	// 	// ANCHO Y ALTURA DE COLUMNAS DEL FILE
	// 		$sheet->getColumnDimension('A')->setWidth(1);
	// 		$sheet->getColumnDimension('B')->setWidth(5);
	// 		$sheet->getColumnDimension('C')->setWidth(22);
	// 		$sheet->getColumnDimension('D')->setWidth(15);
	// 		$sheet->getColumnDimension('E')->setWidth(15);
	// 		$sheet->getColumnDimension('F')->setWidth(10);
	// 		$sheet->getColumnDimension('G')->setWidth(8);
	// 		$sheet->getColumnDimension('H')->setWidth(8);
	// 		$sheet->getColumnDimension('I')->setWidth(8);
	// 		$sheet->getColumnDimension('J')->setWidth(8);
	// 		$sheet->getColumnDimension('K')->setWidth(8);
	// 		$sheet->getColumnDimension('L')->setWidth(5);
	// 		$sheet->getColumnDimension('M')->setWidth(6);
	// 		$sheet->getColumnDimension('N')->setWidth(6);
	// 		$sheet->getColumnDimension('O')->setWidth(5);
	// 		$sheet->getColumnDimension('P')->setWidth(5);
	// 		$sheet->getColumnDimension('Q')->setWidth(5);
			
			

	// 		$sheet->getRowDimension(4)->setRowHeight(2);
	// 		$sheet->getRowDimension(6)->setRowHeight(2);
	// 	// ANCHO Y ALTURA DE COLUMNAS DEL FILE

	// 	// TITULOS
	// 		$sheet->setCellValue('D3','INSTITUTO NACIONAL DE ESTADÍSTICA E INFORMATICA');
	// 		$sheet->mergeCells('D3:R3');
	// 		$sheet->setCellValue('D5','CENSO DE INFRAESTRUCTURA EDUCATIVA 2013');
	// 		$sheet->mergeCells('D5:Q5');
	// 		$sheet->setCellValue('D7','REPORTE DE AVANCE DIARIO POR UBIGEO (MONITOREO)');
	// 		$sheet->mergeCells('D7:Q7');
	// 		$sheet->getStyle('D3:Q7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	// 		$sheet->getStyle('D3:Q7')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);
	// 		$sheet->getStyle('D3:Q3')->getFont()->setname('Arial black')->setSize(16);
	// 		$sheet->getStyle('D5:Q7')->getFont()->setname('Arial')->setSize(16);

	// 		// LOGO
	//           $objDrawing = new PHPExcel_Worksheet_Drawing();
	//           $objDrawing->setWorksheet($sheet);
	//           $objDrawing->setName("inei");
	//           $objDrawing->setDescription("Inei");
	//           $objDrawing->setPath("img/inei.jpeg");
	//           $objDrawing->setCoordinates('C2');
	//           $objDrawing->setHeight(80);
	//           $objDrawing->setOffsetX(1);
	//           $objDrawing->setOffsetY(5);
	          
	// 	// TITULOS

	// 	// CABECERA ESPECIAL
	// 				$sheet->setCellValue('B9','PERIODO:');
	// 				$sheet->mergeCells('B9:C9');

	// 				//if ($periodo==99){ $periodo = "Todos"; }

	// 				$sheet->setCellValue('D9',$periodo_min.' - '.$periodo_max);
	// 				$sheet->mergeCells('D9:E9');

	// 				$sheet->getStyle('D9:C9')->getFont()->setname('Arial')->setSize(12);
	// 				$sheet->getStyle("D9:C9")->getAlignment()->setWrapText(true);// AJUSTA TEXTO A CELDA

	// 		     	$sheet->getStyle("B9:C9")->applyFromArray($color_celda_cabeceras);

	// 		     	$sheet->getStyle("B9:E9")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
	// 				$sheet->getStyle("B9:C9")->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);

	// 				$sheet->getStyle("B9:E9")->applyFromArray(array(
	// 				'borders' => array(
	// 							'allborders' => array(
	// 											'style' => PHPExcel_Style_Border::BORDER_THIN)
	// 						)
	// 				));
	// 	// CABECERA ESPECIAL

	// 	// CABECERA
	// 		// INICIO DE LA  cabecera
	// 		$cab = 11;	
				
	// 		// NOMBRE CABECERAS
	
	// 				$sheet->setCellValue('B'.$cab,'N°');
	// 				$sheet->mergeCells('B'.$cab.':B'.($cab+2));

	// 				$sheet->setCellValue('C'.$cab,'Departamento');
	// 				$sheet->mergeCells('C'.$cab.':C'.($cab+2));
	// 				$sheet->setCellValue('D'.$cab,'Provincia');
	// 				$sheet->mergeCells('D'.$cab.':D'.($cab+2));
	// 				$sheet->setCellValue('E'.$cab,'LOCALES PROGRAMADOS DEL PERIODO' );
	// 				$sheet->mergeCells('E'.$cab.':E'.($cab+2));
	// 				$sheet->setCellValue('F'.$cab,'Locales Visitados');
	// 				$sheet->mergeCells('F'.$cab.':F'.($cab+2));
	// 				$sheet->setCellValue('G'.$cab,'AVANCE (%)');
	// 				$sheet->mergeCells('G'.$cab.':G'.($cab+2));


	// 				$sheet->setCellValue('H'.$cab, 'Instituciones Educativas según Resultado');
	// 				$sheet->mergeCells('H'.$cab.':Q'.$cab);
	// 					$sheet->setCellValue('H'.($cab+1), 'Completa');
	// 					$sheet->mergeCells('H'.($cab+1).':I'.($cab+1));
	// 						$sheet->setCellValue('H'.($cab+2), 'Abs');
	// 						$sheet->mergeCells('H'.($cab+2).':H'.($cab+2));
	// 						$sheet->setCellValue('I'.($cab+2), '%');
	// 						$sheet->mergeCells('I'.($cab+2).':I'.($cab+2));
	// 					$sheet->setCellValue('J'.($cab+1), 'Incompleta');
	// 					$sheet->mergeCells('J'.($cab+1).':K'.($cab+1));
	// 						$sheet->setCellValue('J'.($cab+2), 'Abs');
	// 						$sheet->mergeCells('J'.($cab+2).':J'.($cab+2));
	// 						$sheet->setCellValue('K'.($cab+2), '%');
	// 						$sheet->mergeCells('K'.($cab+2).':K'.($cab+2));
	// 					$sheet->setCellValue('L'.($cab+1), 'Rechazo');
	// 					$sheet->mergeCells('L'.($cab+1).':M'.($cab+1));
	// 						$sheet->setCellValue('L'.($cab+2), 'Abs');
	// 						$sheet->mergeCells('L'.($cab+2).':L'.($cab+2));
	// 						$sheet->setCellValue('M'.($cab+2), '%');
	// 						$sheet->mergeCells('M'.($cab+2).':M'.($cab+2));
	// 					$sheet->setCellValue('N'.($cab+1), 'Desocupada');
	// 					$sheet->mergeCells('N'.($cab+1).':O'.($cab+1));
	// 						$sheet->setCellValue('N'.($cab+2), 'Abs');
	// 						$sheet->mergeCells('N'.($cab+2).':N'.($cab+2));
	// 						$sheet->setCellValue('O'.($cab+2), '%');
	// 						$sheet->mergeCells('O'.($cab+2).':O'.($cab+2));
	// 					$sheet->setCellValue('P'.($cab+1), 'Otro');
	// 					$sheet->mergeCells('P'.($cab+1).':Q'.($cab+1));
	// 						$sheet->setCellValue('P'.($cab+2), 'Abs');
	// 						$sheet->mergeCells('P'.($cab+2).':P'.($cab+2));
	// 						$sheet->setCellValue('Q'.($cab+2), '%');
	// 						$sheet->mergeCells('Q'.($cab+2).':Q'.($cab+2));

	// 		// NOMBRE CABECERAS

	// 		// ESTILOS  CABECERAS
	// 			$sheet->getStyle("B".$cab.":Q".($cab+2))->getAlignment()->setWrapText(true);// AJUSTA TEXTO A CELDA
	// 			$sheet->getStyle("B".$cab.":Q".($cab+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);						
	// 			$sheet->getStyle("B".$cab.":Q".($cab+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);						
	// 			$sheet->getStyle("B".$cab.":Q".($cab+2))->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
	// 			$sheet->getStyle("B".$cab.":Q".($cab+2))->getFont()->setname('Arial')->setSize(9);



	// 	     	$headStyle = $this->phpexcel->getActiveSheet()->getStyle("B".$cab.":Q".($cab+2));
	// 			$headStyle->applyFromArray($color_celda_cabeceras);

	// 			$sheet->getStyle("B".$cab.":Q".($cab+2))->applyFromArray(array(
	// 			'borders' => array(
	// 						'allborders' => array(
	// 										'style' => PHPExcel_Style_Border::BORDER_THIN)
	// 					)
	// 			));
	// 			$sheet->getStyle('K16')->getFont()->setname('Arial Narrow')->setSize(9); // tamaño especial para esta celda
	// 		// ESTILOS  CABECERAS
	// 	// CABECERA

	//     // CUERPO
	// 		$total = $query->num_rows()+ ($cab+2);
			
	// 		$sheet->getStyle("A".($cab+3).":Q".$total)->getFont()->setname('Arial Narrow')->setSize(9);

	// 		//bordes cuerpo
	// 		$sheet->getStyle("B".($cab+3).":Q".$total)->applyFromArray(array(
	// 		'borders' => array(
	// 					'allborders' => array(
	// 									'style' => PHPExcel_Style_Border::BORDER_THIN)
	// 				)
	// 		));

	// 		// EXPORTACION A EXCEL
	// 		$row = $cab+2;
	// 		$col = 2;
	// 		$num = 0;
	// 		$cambio = FALSE;
	// 		 foreach($query->result() as $filas){
	// 		    $row ++;
	// 		    $num ++;			    
	// 		    $sheet->getCellByColumnAndRow(1, $row)->setValue($num);// para numerar los registros
			  		
	// 		  		$provincia = ($tipo !=3) ? $filas->NombProv : '';
	// 		  		$sheet->getCellByColumnAndRow(2, $row)->setValue(utf8_encode(trim($filas->NombDpto)));
	// 		  		$sheet->getCellByColumnAndRow(3, $row)->setValue(utf8_encode(trim($provincia)));
	// 		  		$sheet->getCellByColumnAndRow(4, $row)->setValue($filas->LocEscolares);
	// 		  		$sheet->getCellByColumnAndRow(5, $row)->setValue($filas->LocEscolar_Censado);
	// 		  		if ( $filas->LocEscolar_Censado > 0 ) {

	// 			  		$sheet->getCellByColumnAndRow(6, $row)->setValue('=IF('.$filas->LocEscolar_Censado_Porc.'>=100,ROUND('.$filas->LocEscolar_Censado_Porc.',0),'.$filas->LocEscolar_Censado_Porc.')');
	// 			  		$sheet->getCellByColumnAndRow(7, $row)->setValue($filas->Completa);
	// 			  		$sheet->getCellByColumnAndRow(8, $row)->setValue('=IF('.$filas->Completa_Porc.'>=100,ROUND('.$filas->Completa_Porc.',0),'.$filas->Completa_Porc.')');
	// 			  		$sheet->getCellByColumnAndRow(9, $row)->setValue($filas->Incompleta);
	// 			  		$sheet->getCellByColumnAndRow(10, $row)->setValue('=IF('.$filas->Incompleta_Porc.'>=100,ROUND('.$filas->Incompleta_Porc.',0),'.$filas->Incompleta_Porc.')');
	// 			  		$sheet->getCellByColumnAndRow(11, $row)->setValue($filas->Rechazo);
	// 			  		$sheet->getCellByColumnAndRow(12, $row)->setValue('=IF('.$filas->Rechazo_Porc.'>=100,ROUND('.$filas->Rechazo_Porc.',0),'.$filas->Rechazo_Porc.')');
	// 			  		$sheet->getCellByColumnAndRow(13, $row)->setValue($filas->Desocupada);
	// 			  		$sheet->getCellByColumnAndRow(14, $row)->setValue('=IF('.$filas->Desocupada_Porc.'>=100,ROUND('.$filas->Desocupada_Porc.',0),'.$filas->Desocupada_Porc.')');
	// 			  		$sheet->getCellByColumnAndRow(15, $row)->setValue($filas->Otro);
	// 			  		$sheet->getCellByColumnAndRow(16, $row)->setValue('=IF('.$filas->Otro_Porc.'>=100,ROUND('.$filas->Otro_Porc.',0),'.$filas->Otro_Porc.')');

	// 		  		}else{

	// 			  		$sheet->getCellByColumnAndRow(6, $row)->setValue($filas->LocEscolar_Censado_Porc);
	// 			  		$sheet->getCellByColumnAndRow(7, $row)->setValue($filas->Completa);
	// 			  		$sheet->getCellByColumnAndRow(8, $row)->setValue($filas->Completa_Porc);
	// 			  		$sheet->getCellByColumnAndRow(9, $row)->setValue($filas->Incompleta);
	// 			  		$sheet->getCellByColumnAndRow(10, $row)->setValue($filas->Incompleta_Porc);
	// 			  		$sheet->getCellByColumnAndRow(11, $row)->setValue($filas->Rechazo);
	// 			  		$sheet->getCellByColumnAndRow(12, $row)->setValue($filas->Rechazo_Porc);
	// 			  		$sheet->getCellByColumnAndRow(13, $row)->setValue($filas->Desocupada);
	// 			  		$sheet->getCellByColumnAndRow(14, $row)->setValue($filas->Desocupada_Porc);
	// 			  		$sheet->getCellByColumnAndRow(15, $row)->setValue($filas->Otro);
	// 			  		$sheet->getCellByColumnAndRow(16, $row)->setValue($filas->Otro_Porc);
	// 		  		}


	// 			//}
	// 			 $col = 2;
	// 			 //dar formato de color intercalado a cada fila
	// 			 if($cambio){
	// 		     	$fila_color = $this->phpexcel->getActiveSheet()->getStyle("B".$row.":Q".$row);
			        
	// 				$fila_color->applyFromArray(
	// 				    array(
	// 				        'fill' => array(
	// 				            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	// 				            'color' => array('rgb' => 'DCDCDC')
	// 				        )
	// 				    )
	// 				);			        
	// 		        $cambio = FALSE;	
	// 			 }else{	$cambio = TRUE; }
				
	// 		}

	// 		$sheet->getStyle('B'.($cab+2).':Q'.$total)->getAlignment()->setWrapText(true)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

	// 		$sheet->getStyle('D'.($cab+2).':Q'.$total)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

 // 		// CUERPO

	// 	// PIE TOTALES
	// 		$celda_s = $total+1 ; // inicio de pie de resumenes
	// 		$sheet->setCellValue('B'.$celda_s,'TOTALES');
	// 		$sheet->mergeCells('B'.$celda_s.':D'.$celda_s);
	// 		$sheet->mergeCells('H'.$celda_s.':Q'.$celda_s);
			
	// 		$inicio_s = $cab+3 ; // inicio suma  de resumenes	
	// 		$fin_s = $total ; // fin suma de resumenes	

	// 		$sheet->setCellValue('E'. $celda_s ,'=IF(SUM(E'.$inicio_s.':E'.$fin_s.')>0,SUM(E'.$inicio_s.':E'.$fin_s.')," ")');
	// 		$sheet->setCellValue('F'. $celda_s ,'=IF(SUM(F'.$inicio_s.':F'.$fin_s.')>0,SUM(F'.$inicio_s.':F'.$fin_s.')," ")');
	// 		$sheet->setCellValue('G'. $celda_s ,'=ROUND((F'.$celda_s.'*100)/E'.$celda_s.',2)');

	// 		$sheet->getStyle('B'.$celda_s)->applyFromArray($color_celda_cabeceras);
	//      	$sheet->getStyle('H'.$celda_s)->applyFromArray($color_celda_cabeceras);
	//      	$sheet->getStyle('B'.$celda_s.':Q'.$celda_s)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
	// 		$sheet->getStyle('B'.$celda_s)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);

	// 		$sheet->getStyle('B'.$celda_s.':Q'.$celda_s)->applyFromArray(array(
	// 		'borders' => array(
	// 					'allborders' => array(
	// 									'style' => PHPExcel_Style_Border::BORDER_THIN)
	// 				)
	// 		));

	// 		//fecha
	// 		$sheet->setCellValue('B'.($celda_s +2),'IMPRESO:' );
	// 		$sheet->mergeCells('B'.($celda_s +2).':C'.($celda_s +2));
	//      	$sheet->getStyle('B'.($celda_s + 2))->applyFromArray($color_celda_cabeceras)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	     		
	// 		$sheet->getStyle('B'.($celda_s + 2))->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);

	// 		$sheet->setCellValue('D'.($celda_s +2), date('d/m/Y H:i:s') );
	// 		$sheet->mergeCells('D'.($celda_s +2).':E'.($celda_s +2));
	// 		$sheet->getStyle('D'.($celda_s +2))->getNumberFormat()->setFormatCode('d/m/Y H:i:s'); 
	// 		$sheet->getStyle('B'.($celda_s +2).':E'.($celda_s +2))->applyFromArray(array(
	// 		'borders' => array(
	// 					'allborders' => array(
	// 									'style' => PHPExcel_Style_Border::BORDER_THIN)
	// 				)
	// 		));
	// 	// PIE TOTALES

	// 	// SALIDA EXCEL
	// 		// Propiedades del archivo excel
	// 			$sheet->setTitle("Reporte Avance UBIGEO");
	// 			$this->phpexcel->getProperties()
	// 			->setTitle("Reporte Avance Ubigeo")
	// 			->setDescription("Reporte de Avance Diario por Ubigeo");

	// 		header("Content-Type: application/vnd.ms-excel");
	// 		$nombreArchivo = 'Monitoreo_AvanceDiario_Ubigeo_'.date('Y-m-d');
	// 		header("Content-Disposition: attachment; filename=\"$nombreArchivo.xls\""); //EXCEL
	// 		header("Cache-Control: max-age=0");
			
	// 		// Genera Excel
	// 		$writer = PHPExcel_IOFactory::createWriter($this->phpexcel, "Excel5");

	// 		$writer->save('php://output');
	// 		exit;
	// 	// SALIDA EXCEL
	// }

}

?>