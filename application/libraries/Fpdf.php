<?php
/*******************************************************************************
* FPDF                                                                         *
*                                                                              *
* Version: 1.81                                                                *
* Date:    2015-12-20                                                          *
* Author:  Olivier PLATHEY                                                     *
*******************************************************************************/

class FPDF
{
protected $page;
protected $n;
protected $offsets;
protected $buffer;
protected $pages;
protected $state;
protected $compress;
protected $k;
protected $DefOrientation;
protected $CurOrientation;
protected $StdPageSizes;
protected $DefPageSize;
protected $CurPageSize;
protected $CurRotation;
protected $PageSizes;
protected $wPt, $hPt;
protected $w, $h;
protected $lMargin;
protected $tMargin;
protected $rMargin;
protected $bMargin;
protected $cMargin;
protected $x, $y;
protected $lasth;
protected $LineWidth;
protected $fontpath;
protected $CoreFonts;
protected $fonts;
protected $FontFiles;
protected $encodings;
protected $cmaps;
protected $FontFamily;
protected $FontStyle;
protected $underline;
protected $CurrentFont;
protected $FontSizePt;
protected $FontSize;
protected $DrawColor;
protected $FillColor;
protected $TextColor;
protected $ColorFlag;
protected $WithAlpha;
protected $ws;
protected $images;
protected $PageLinks;
protected $links;
protected $AutoPageBreak;
protected $PageBreakTrigger;
protected $InHeader;
protected $InFooter;
protected $AliasNbPages;
protected $ZoomMode;
protected $LayoutMode;
protected $metadata;
protected $PDFVersion;

public function __construct($orientation='P', $unit='mm', $size='A4')
{
	$this->page = 0; $this->n = 2; $this->buffer = ''; $this->pages = array(); $this->PageSizes = array(); $this->state = 0; $this->fonts = array(); $this->FontFiles = array(); $this->diffs = array(); $this->encodings = array(); $this->images = array(); $this->links = array(); $this->InHeader = false; $this->InFooter = false; $this->lasth = 0; $this->FontFamily = ''; $this->FontStyle = ''; $this->FontSizePt = 12; $this->underline = false; $this->DrawColor = '0 G'; $this->FillColor = '0 g'; $this->TextColor = '0 g'; $this->ColorFlag = false; $this->WithAlpha = false; $this->ws = 0;
	$this->fontpath = ''; $this->CoreFonts = array('courier', 'helvetica', 'times', 'symbol', 'zapfdingbats');
	if($unit=='pt') $this->k = 1; elseif($unit=='mm') $this->k = 72/25.4; elseif($unit=='cm') $this->k = 72/2.54; elseif($unit=='in') $this->k = 72; else $this->Error('Incorrect unit: '.$unit);
	$this->StdPageSizes = array('a3'=>array(841.89,1190.55), 'a4'=>array(595.28,841.89), 'a5'=>array(420.94,595.28), 'letter'=>array(612,792), 'legal'=>array(612,1008));
	$size = $this->_getpagesize($size); $this->DefPageSize = $size; $this->CurPageSize = $size;
	$orientation = strtolower($orientation);
	if($orientation=='p' || $orientation=='portrait') { $this->DefOrientation = 'P'; $this->w = $size[0]; $this->h = $size[1]; }
	elseif($orientation=='l' || $orientation=='landscape') { $this->DefOrientation = 'L'; $this->w = $size[1]; $this->h = $size[0]; }
	else $this->Error('Incorrect orientation: '.$orientation);
	$this->CurOrientation = $this->DefOrientation; $this->wPt = $this->w*$this->k; $this->hPt = $this->h*$this->k;
	$this->CurRotation = 0; $margin = 28.35/$this->k; $this->SetMargins($margin,$margin); $this->cMargin = $margin/10; $this->LineWidth = .567/$this->k;
	$this->SetAutoPageBreak(true,2*$margin); $this->SetDisplayMode('default'); $this->SetCompression(true); $this->PDFVersion = '1.3';
}

public function SetMargins($left, $top, $right=null) { $this->lMargin = $left; $this->tMargin = $top; if($right===null) $right = $left; $this->rMargin = $right; }
public function SetLeftMargin($margin) { $this->lMargin = $margin; if($this->page>0 && $this->x<$margin) $this->x = $margin; }
public function SetTopMargin($margin) { $this->tMargin = $margin; }
public function SetRightMargin($margin) { $this->rMargin = $margin; }
public function SetAutoPageBreak($auto, $margin=0) { $this->AutoPageBreak = $auto; $this->bMargin = $margin; $this->PageBreakTrigger = $this->h-$margin; }
public function SetDisplayMode($zoom, $layout='default') { $this->ZoomMode = $zoom; $this->LayoutMode = $layout; }
public function SetCompression($compress) { if(function_exists('gzcompress')) $this->compress = $compress; else $this->compress = false; }
public function SetTitle($title, $isUTF8=false) { $this->metadata['Title'] = $title; }
public function SetAuthor($author, $isUTF8=false) { $this->metadata['Author'] = $author; }
public function SetSubject($subject, $isUTF8=false) { $this->metadata['Subject'] = $subject; }
public function SetKeywords($keywords, $isUTF8=false) { $this->metadata['Keywords'] = $keywords; }
public function SetCreator($creator, $isUTF8=false) { $this->metadata['Creator'] = $creator; }
public function AliasNbPages($alias='{nb}') { $this->AliasNbPages = $alias; }
public function Error($msg) { die('<b>FPDF error:</b> '.$msg); }

public function AddPage($orientation='', $size='', $rotation=0)
{
	if($this->state==3) $this->Error('The document is closed');
	$family = $this->FontFamily; $style = $this->FontStyle.($this->underline ? 'U' : ''); $fontsize = $this->FontSizePt; $lw = $this->LineWidth; $dc = $this->DrawColor; $fc = $this->FillColor; $tc = $this->TextColor; $cf = $this->ColorFlag;
	if($this->page>0) { $this->InFooter = true; $this->Footer(); $this->InFooter = false; $this->_endpage(); }
	$this->_beginpage($orientation,$size,$rotation); $this->_out('2 J'); $this->LineWidth = $lw; $this->_out(sprintf('%.2F w',$lw*$this->k));
	if($family) $this->SetFont($family,$style,$fontsize);
	$this->DrawColor = $dc; if($dc!='0 G') $this->_out($dc); $this->FillColor = $fc; if($fc!='0 g') $this->_out($fc); $this->TextColor = $tc; $this->ColorFlag = $cf;
	$this->InHeader = true; $this->Header(); $this->InHeader = false;
	if($this->LineWidth!=$lw) { $this->LineWidth = $lw; $this->_out(sprintf('%.2F w',$lw*$this->k)); }
	if($family) $this->SetFont($family,$style,$fontsize);
	if($this->DrawColor!=$dc) { $this->DrawColor = $dc; $this->_out($dc); } if($this->FillColor!=$fc) { $this->FillColor = $fc; $this->_out($fc); }
	$this->TextColor = $tc; $this->ColorFlag = $cf;
}

public function Header() {}
public function Footer() {}
public function PageNo() { return $this->page; }
public function SetDrawColor($r, $g=null, $b=null) { if(($r==0 && $g==0 && $b==0) || $g===null) $this->DrawColor = sprintf('%.3F G',$r/255); else $this->DrawColor = sprintf('%.3F %.3F %.3F RG',$r/255,$g/255,$b/255); if($this->page>0) $this->_out($this->DrawColor); }
public function SetFillColor($r, $g=null, $b=null) { if(($r==0 && $g==0 && $b==0) || $g===null) $this->FillColor = sprintf('%.3F g',$r/255); else $this->FillColor = sprintf('%.3F %.3F %.3F rg',$r/255,$g/255,$b/255); $this->ColorFlag = ($this->FillColor!=$this->TextColor); if($this->page>0) $this->_out($this->FillColor); }
public function SetTextColor($r, $g=null, $b=null) { if(($r==0 && $g==0 && $b==0) || $g===null) $this->TextColor = sprintf('%.3F g',$r/255); else $this->TextColor = sprintf('%.3F %.3F %.3F rg',$r/255,$g/255,$b/255); $this->ColorFlag = ($this->FillColor!=$this->TextColor); }
public function GetStringWidth($s) { $s = (string)$s; $cw = &$this->CurrentFont['cw']; $w = 0; $l = strlen($s); for($i=0;$i<$l;$i++) $w += $cw[$s[$i]]; return $w*$this->FontSize/1000; }
public function SetLineWidth($width) { $this->LineWidth = $width; if($this->page>0) $this->_out(sprintf('%.2F w',$width*$this->k)); }
public function Line($x1, $y1, $x2, $y2) { $this->_out(sprintf('%.2F %.2F m %.2F %.2F l S',$x1*$this->k,($this->h-$y1)*$this->k,$x2*$this->k,($this->h-$y2)*$this->k)); }
public function Rect($x, $y, $w, $h, $style='') { if($style=='F') $op = 'f'; elseif($style=='FD' || $style=='DF') $op = 'B'; else $op = 'S'; $this->_out(sprintf('%.2F %.2F %.2F %.2F re %s',$x*$this->k,($this->h-$y)*$this->k,$w*$this->k,-$h*$this->k,$op)); }

public function SetFont($family, $style='', $size=0)
{
	if($family=='') $family = $this->FontFamily; else $family = strtolower($family);
	$style = strtoupper($style);
	if(strpos($style,'U')!==false) { $this->underline = true; $style = str_replace('U','',$style); } else $this->underline = false;
	if($style=='IB') $style = 'BI';
	if($size==0) $size = $this->FontSizePt;
	if($this->FontFamily==$family && $this->FontStyle==$style && $this->FontSizePt==$size) return;
	$fontkey = $family.$style;
	if(!isset($this->fonts[$fontkey])) {
		if($family=='arial') $family = 'helvetica';
		if(in_array($family,$this->CoreFonts)) { if($family=='symbol' || $family=='zapfdingbats') $style = ''; $fontkey = $family.$style; if(!isset($this->fonts[$fontkey])) $this->_loadfont($family,$style); }
		else $this->Error('Undefined font: '.$family.' '.$style);
	}
	$this->FontFamily = $family; $this->FontStyle = $style; $this->FontSizePt = $size; $this->FontSize = $size/$this->k;
	$this->CurrentFont = &$this->fonts[$fontkey];
	if($this->page>0) $this->_out(sprintf('BT /F%d %.2F Tf ET',$this->CurrentFont['i'],$this->FontSizePt));
}

public function SetFontSize($size) { if($this->FontSizePt==$size) return; $this->FontSizePt = $size; $this->FontSize = $size/$this->k; if($this->page>0) $this->_out(sprintf('BT /F%d %.2F Tf ET',$this->CurrentFont['i'],$this->FontSizePt)); }

public function Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
{
	$k = $this->k;
	if($this->y+$h>$this->PageBreakTrigger && !$this->InHeader && !$this->InFooter && $this->AutoPageBreak) { $x = $this->x; $ws = $this->ws; if($ws>0) { $this->ws = 0; $this->_out('0 Tw'); } $this->AddPage($this->CurOrientation,$this->CurPageSize,$this->CurRotation); $this->x = $x; if($ws>0) { $this->ws = $ws; $this->_out(sprintf('%.3F Tw',$ws*$k)); } }
	if($w==0) $w = $this->w-$this->rMargin-$this->x;
	$s = '';
	if($fill || $border==1) { if($fill) $op = ($border==1) ? 'B' : 'f'; else $op = 'S'; $s = sprintf('%.2F %.2F %.2F %.2F re %s ',$this->x*$k,($this->h-$this->y)*$k,$w*$k,-$h*$k,$op); }
	if(is_string($border)) { $x = $this->x; $y = $this->y; if(strpos($border,'L')!==false) $s .= sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-$y)*$k,$x*$k,($this->h-($y+$h))*$k); if(strpos($border,'T')!==false) $s .= sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-$y)*$k); if(strpos($border,'R')!==false) $s .= sprintf('%.2F %.2F m %.2F %.2F l S ',($x+$w)*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-($y+$h))*k); if(strpos($border,'B')!==false) $s .= sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-($y+$h))*k,($x+$w)*$k,($this->h-($y+$h))*k); }
	if($txt!=='') { if(!isset($this->CurrentFont)) $this->Error('No font has been set'); if($align=='R') $dx = $w-$this->cMargin-$this->GetStringWidth($txt); elseif($align=='C') $dx = ($w-$this->GetStringWidth($txt))/2; else $dx = $this->cMargin; if($this->ColorFlag) $s .= 'q '.$this->TextColor.' '; $s .= sprintf('BT %.2F %.2F Td (%s) Tj ET',($this->x+$dx)*$k,($this->h-($this->y+.5*$h+.3*$this->FontSize))*$k,$this->_escape($txt)); if($this->ColorFlag) $s .= ' Q'; }
	if($s) $this->_out($s); $this->lasth = $h;
	if($ln>0) { $this->y += $h; if($ln==1) $this->x = $this->lMargin; } else $this->x += $w;
}

public function Ln($h=null) { $this->x = $this->lMargin; if($h===null) $this->y += $this->lasth; else $this->y += $h; }
public function GetX() { return $this->x; }
public function SetX($x) { if($x>=0) $this->x = $x; else $this->x = $this->w+$x; }
public function GetY() { return $this->y; }
public function SetY($y, $resetX=true) { if($y>=0) $this->y = $y; else $this->y = $this->h+$y; if($resetX) $this->x = $this->lMargin; }
public function SetXY($x, $y) { $this->SetY($y,false); $this->SetX($x); }

public function Output($dest='', $name='', $isUTF8=false)
{
	$this->Close(); if(strlen($name)==1 && strlen($dest)!=1) { $tmp = $dest; $dest = $name; $name = $tmp; }
	if($dest=='') $dest = 'I'; if($name=='') $name = 'doc.pdf';
	switch(strtoupper($dest)) {
		case 'I': $this->_checkoutput(); if(PHP_SAPI!='cli') { header('Content-Type: application/pdf'); header('Content-Disposition: inline; filename="'.$name.'"'); header('Cache-Control: private, max-age=0, must-revalidate'); header('Pragma: public'); } echo $this->buffer; break;
		case 'D': $this->_checkoutput(); header('Content-Type: application/x-download'); header('Content-Disposition: attachment; filename="'.$name.'"'); header('Cache-Control: private, max-age=0, must-revalidate'); header('Pragma: public'); echo $this->buffer; break;
		case 'F': $f = fopen($name,'wb'); if(!$f) $this->Error('Unable to create output file: '.$name); fwrite($f,$this->buffer,strlen($this->buffer)); fclose($f); break;
		case 'S': return $this->buffer;
		default: $this->Error('Incorrect output destination: '.$dest);
	}
	return '';
}

protected function _getpagesize($size) { if(is_string($size)) { $size = strtolower($size); if(!isset($this->StdPageSizes[$size])) $this->Error('Unknown page size: '.$size); $a = $this->StdPageSizes[$size]; return array($a[0]/$this->k, $a[1]/$this->k); } else { if($size[0]>$size[1]) return array($size[1], $size[0]); else return $size; } }
protected function _beginpage($orientation, $size, $rotation) { $this->page++; $this->pages[$this->page] = ''; $this->state = 2; $this->x = $this->lMargin; $this->y = $this->tMargin; $this->FontFamily = ''; if($orientation=='') $orientation = $this->DefOrientation; else $orientation = strtoupper($orientation[0]); if($size=='') $size = $this->DefPageSize; else $size = $this->_getpagesize($size); if($orientation!=$this->CurOrientation || $size[0]!=$this->CurPageSize[0] || $size[1]!=$this->CurPageSize[1]) { if($orientation=='P') { $this->w = $size[0]; $this->h = $size[1]; } else { $this->w = $size[1]; $this->h = $size[0]; } $this->wPt = $this->w*$this->k; $this->hPt = $this->h*$this->k; $this->PageBreakTrigger = $this->h-$this->bMargin; $this->CurOrientation = $orientation; $this->CurPageSize = $size; } if($orientation!=$this->DefOrientation || $size[0]!=$this->DefPageSize[0] || $size[1]!=$this->DefPageSize[1]) $this->PageSizes[$this->page] = array($this->wPt, $this->hPt); }
protected function _endpage() { $this->state = 1; }
protected function _loadfont($font, $style) { $font = strtolower($font); if($font=='arial') $font = 'helvetica'; $fontkey = $font.$style; $cw = array(); for($i=0;$i<256;$i++) $cw[chr($i)]=600; $cw[' ']=278; $this->fonts[$fontkey] = array('i'=>count($this->fonts)+1, 'type'=>'core', 'name'=>$font.($style ? '-'.$style : ''), 'up'=>-100, 'ut'=>50, 'cw'=>$cw); }
protected function _out($s) { if($this->state==2) $this->pages[$this->page] .= $s."\n"; else $this->buffer .= $s."\n"; }
protected function _putfont($font) { $this->_newobj(); $this->_out('<</Type /Font'); $this->_out('/BaseFont /'.$font['name']); $this->_out('/Subtype /Type1'); $this->_out('>>'); $this->_out('endobj'); }
protected function _putheader() { $this->_out('%PDF-'.$this->PDFVersion); }
protected function _newobj() { $this->n++; $this->offsets[$this->n] = strlen($this->buffer); $this->_out($this->n.' 0 obj'); }
protected function _putpages() { $nb = $this->page; for($n=1;$n<=$nb;$n++) { $this->_newobj(); $this->_out('<</Type /Page'); $this->_out('/Parent 2 0 R'); if(isset($this->PageSizes[$n])) $this->_out(sprintf('/MediaBox [0 0 %.2F %.2F]',$this->PageSizes[$n][0],$this->PageSizes[$n][1])); $this->_out('/Resources 2 0 R'); $this->_out('/Contents '.($this->n+1).' 0 R>>'); $this->_out('endobj'); $p = ($this->compress) ? gzcompress($this->pages[$n]) : $this->pages[$n]; $this->_newobj(); $this->_out('<</Length '.strlen($p).($this->compress ? ' /Filter /FlateDecode' : '').'>>'); $this->_out('stream'); $this->_out($p); $this->_out('endstream'); $this->_out('endobj'); } $this->offsets[2] = strlen($this->buffer); $this->_out('2 0 obj'); $this->_out('<</Type /Pages'); $kids = '/Kids ['; for($i=0;$i<$nb;$i++) $kids .= (3+2*$i).' 0 R '; $this->_out($kids.']'); $this->_out('/Count '.$nb); $this->_out(sprintf('/MediaBox [0 0 %.2F %.2F]',$this->wPt,$this->hPt)); $this->_out('>>'); $this->_out('endobj'); }
protected function _putresources() { $this->_newobj(); $this->_out('<<'); $this->_out('/ProcSet [/PDF /Text]'); $this->_out('/Font <<'); foreach($this->fonts as $font) $this->_out('/F'.$font['i'].' '.$font['n'].' 0 R'); $this->_out('>>'); $this->_out('>>'); $this->offsets[2] = strlen($this->buffer); }
protected function _putinfo() { $this->_out('/Producer (FPDF 1.81)'); foreach($this->metadata as $key=>$value) $this->_out('/'.$key.' ('.$this->_escape($value).')'); $this->_out('/CreationDate (D:'.@date('YmdHis').')'); }
protected function _escape($s) { return str_replace(')','\\)',str_replace('(','\\(',str_replace('\\','\\\\',$s))); }
protected function _puttrailer() { $this->_out('trailer'); $this->_out('<<'); $this->_out('/Size '.($this->n+1)); $this->_out('/Root '.$this->n.' 0 R'); $this->_out('/Info 1 0 R'); $this->_out('>>'); $this->_out('startxref'); $this->_out($this->offsets[count($this->offsets)]); $this->_out('%%EOF'); }
protected function _putcatalog() { $this->_out('/Type /Catalog'); $this->_out('/Pages 2 0 R'); }
protected function _putxref() { $this->_out('xref'); $this->_out('0 '.($this->n+1)); $this->_out('0000000000 65535 f '); for($i=1;$i<=$this->n;$i++) $this->_out(sprintf('%010d 00000 n ',$this->offsets[$i])); }
protected function Close() { if($this->state==3) return; if($this->page==0) $this->AddPage(); $this->InFooter = true; $this->Footer(); $this->InFooter = false; $this->_endpage(); $this->state = 3; $this->_putheader(); $this->_newobj(); $this->_out('<<'); $this->_putinfo(); $this->_out('>>'); $this->_out('endobj'); $this->_putpages(); foreach($this->fonts as $font) $this->_putfont($font); $this->_newobj(); $this->_out('<<'); $this->_putcatalog(); $this->_out('>>'); $this->_out('endobj'); $this->_putxref(); $this->_puttrailer(); }
protected function _checkoutput() { if(PHP_SAPI!='cli' && headers_sent($file,$line)) $this->Error("Some data has already been output, can't send PDF file (output started at $file:$line)"); }
}
?>
