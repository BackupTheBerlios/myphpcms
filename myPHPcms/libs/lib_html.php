<?php

// HTML Library
//
// Version 0.7 - Last modified 28 September 2001
//
// For more information see HTML_README.TXT and HTML_CHANGELOG.TXT
//
// Library to aid in the creation of HTML documents

// This consists of two parts:

// * a series of classes and functions to create non-indented HTML code
// * HTML formatter that will return nicely formatted and indented HTML code

//  ********************************************************************
//  *                                                                  *
//  * Document tags                                                    *
//  *                                                                  *
//  ********************************************************************
class open_html {
	// Class to create HTML document
	function write() {
		// Write out <HTML> tag
		return "<HTML><eol>";
	}
}

class close_html {
	// Class to close HTML document
	function write() {
		// Write out </HTML> tag
		return "</HTML><eol>";
	}
}

class open_body {
	// Class to write out <BODY> tag
	var $alink="";
	var $background="";
	var $bgcolor="";
	var $link="";
	var $text="";
	var $vlink="";

	function set($varname,$value) {
		$this->varname=$value;
	}

	function write() {
		$html="";
		$html="<BODY";
		// Fill in non-empty values
		if (!empty($this->alink)) $html .=" alink='$this->alink'";
		if (!empty($this->background)) $html .=" background='$this->background'"; 
		if (!empty($this->bgcolor)) $html .=" bgcolor='$this->bgcolor'";
		if (!empty($this->link)) $html .=" link='$this->link'";
		if (!empty($this->text)) $html .=" text='$this->text'";
		if (!empty($this->vlink)) $html .=" vlink='$this->vlink'";
		$html .="><eol>";
		return $html;
	}
}

class close_body {
	// Class to close body tag
	function write() {
		return "</BODY><eol>";
	}
}

class comment {
	// Class to write comment into document

	var $comment="";
	function set($varname,$value) {
		$this->varname=$value;
	}
	
	function write() {
		// Write out comment
		return "<!-- " . $this->comment . " --><eol>";
	}
}

class open_head {
	// Class to open <HEAD> tag
	function write() {
	return "<HEAD><eol>";	
	}
}

class close_head {
	// Class to close <HEAD> tag
	
	function write() {
	return "</HEAD><eol>";	
	}
}

class meta {
	// Class to write out <META . . .> tags
	
	var $author;
	var $description;
	var $expires;
	var $keywords;
	var $nocache;
	var $refresh;
	var $robots="all";
	var $setcookie;
	var $target;
	
	function set($varname,$value) {
		$this->varname=$value;
	}
	
	function write() {
		$html="";
		if (!empty($this->author))      $html .="<META NAME='author' CONTENT='$this->author'><eol>";
		if (!empty($this->description)) $html .="<META NAME='description' CONTENT='$this->description'><eol>";
		if (!empty($this->keywords))    $html .="<META NAME='keywords' CONTENT='$this->keywords'><eol>";
		if (!empty($this->robots))      $html .="<META NAME='robots' CONTENT='$this->robots'><eol>";
		
		if (!empty($this->expires))     $html .="<META HTTP-EQUIV='expires' CONTENT='$this->expires'><eol>";
		if (!empty($this->nocache))     $html .="<META HTTP-EQUIV='pragma' CONTENT='no-cache'><eol>";
		if (!empty($this->refresh))     $html .="<META HTTP-EQUIV='refresh' CONTENT='$this->refresh'><eol>";
		if (!empty($this->setcookie))   $html .="<META HTTP-EQUIV='set-cookie' CONTENT='$this->setcookie'><eol>";
		if (!empty($this->target))      $html .="<META HTTP-EQUIV='windows-target' CONTENT='$this->target'><eol>";
		return $html;
	}
}

class title {
	// Class to write out <TITLE>Page title</TITLE> tag
	
	var $title="Untitled page !";
	
	function set($varname,$value) {
		$this->varname=$value;
	}
	
	function write() {
		return "<TITLE>" . $title . "</TITLE><eol>";	
	}
}

class script {
	// Class to write out <SCRIPT> tag
	
	var $type;
	var $language;
	var $content;
	
	function set($varname,$value) {
		$this->varname=$value;
	}
	
	function write() {
		$html="<SCRIPT";
		if (!empty($this->language)) $html .=" language='$this->language'";
		if (!empty($this->type))     $html .=" type='$this->type'><eol>";
		if (!empty($this->content))  $html .="<!--<eol>" . $this->content . "<eol>" . "//--><eol>";
		$html .="</SCRIPT><eol>";
		return $html;	
	}
}

class link {
	// Class to add link information for linking to eg stylesheets
	
	var $css;
	function set($varname,$value) {
		$this->varname=$value;
	}
	function write() {

		if (!empty($this->css)) $html="<LINK REL='stylesheet' TYPE='text/css' HREF='$this->css'<eol>";
		return $html;
	}
}

//	********************************************************************
//	*                                                                  *
//	* Text tags                                                        *
//	*                                                                  *
//	********************************************************************

class text {
	// Class to apply text formatting tags to supplied text
	
	var $text="";
	var $tag="";
	
	// Create method to set defaults to other values
	function set($varname,$value) {
		$this->$varname=$value;
	}
	
	// Create method to output string of HTML
	function write() {
		// Write out string surrounded by tags as required	
		
		// Convert supplied string to upper case and then copy and reverse
		$leading_tags=strtoupper($this->tag);
		$trailing_tags=strrev($leading_tags);
		
		// Create array of permitted tags
		$opening_tags[0]=">H1<";
		$opening_tags[1]=">H2<";
		$opening_tags[2]=">H3<";
		$opening_tags[3]=">H4<";
		$opening_tags[4]=">H5<";
		$opening_tags[5]=">H6<";
		$opening_tags[6]=">B<";
		$opening_tags[7]=">I<";
		$opening_tags[8]=">TT<";
		$opening_tags[9]=">CITE<";
		$opening_tags[10]=">EM<";
		$opening_tags[11]=">STRONG<";
		
		$closing_tags[0]="</H1>";
		$closing_tags[1]="</H2>";
		$closing_tags[2]="</H3>";
		$closing_tags[3]="</H4>";
		$closing_tags[4]="</H5>";
		$closing_tags[5]="</H6>";
		$closing_tags[6]="</B>";
		$closing_tags[7]="</I>";
		$closing_tags[8]="</TT>";
		$closing_tags[9]="</CITE>";
		$closing_tags[10]="</EM>";
		$closing_tags[11]="</STRONG>";
		
		// Loop through and replace 		
		foreach ($opening_tags as $key=>$value) {
			$trailing_tags=str_replace($opening_tags[$key],$closing_tags[$key],$trailing_tags);
		}
		$html=$leading_tags . $this->text . $trailing_tags . "<eol>";
		return $html;
	}
}

class font_open {
	// Class to write out <font> tag
	
	var $color="";
	var $bgcolor="";
	var $size="";
	
	// Create method to set defaults to other values
	function set($varname,$value) {
		$this->$varname=$value;
	}
	
	// Create method to output string of HTML
	function write() {
		// Write out font tag as required
		$html="<FONT";
		if (!empty($this->color))   $html .=" color='$this->color'";
		if (!empty($this->bgcolor)) $html .=" bgcolor='$this->bgcolor'";
		if (!empty($this->size))    $html .=" size='$this->size'";
		$html .="><eol>";
		return $html;
	}
}

class font_close {
	// Class to write out </font> tag
	
	// Create method to output string of HTML
	function write() {
		// Write out font tag as required
		$html="</FONT><eol>";
		return $html;
	}
}

//	********************************************************************
//	*                                                                  *
//	* Links tags                                                       *
//	*                                                                  *
//	********************************************************************

class href{
	// Class to output link tags
	
	var $link="";
	var $text="";
	
	// Create method to set defaults to other values
	function set($varname,$value) {
		$this->$varname=$value;
	}
	
	// Create method to output string of HTML
	function write() {
		// Write out font tag as required
		$html="<A HREF";
		if (!empty($this->link)) $html .=" ='$this->link'";
		$html .=">$this->text</A><eol>";
		return $html;
	}
}

//	********************************************************************
//	*                                                                  *
//	* Formatting tags                                                  *
//	*                                                                  *
//	********************************************************************

class p {
	// Class to write out <p></p> tags surrounding text
	
	var $align;
	var $text;
	
	// Create method to set defaults to other values
	function set($varname,$value) {
		$this->$varname=$value;
	}
	// Write out HTML
	function write() {
		$html="<P";
		if (!empty($this->align)) $html .=" align='$this->align'";
		$html .=">" . $this->text . "</P><eol>";
		return $html;	
	}
}

class br {
	// Class to return a line break tag
	var $clear;
	// Create method to set defaults to other values
	function set($varname,$value) {
		$this->$varname=$value;
	}
	// Write out HTML
	function write() {
		$html="<BR";
		if (!empty($this->clear)) $html .=" clear='$this->clear'";
		$html .="><eol>";
		return $html;
	}
}

class blockquote {
	// Class to return supplied text wrapped up in <blockquote> tags
	
	var $text;
	// Create method to set defaults to other values
	function set($varname,$value) {
		$this->$varname=$value;
	}
	function write() {
		$html ="<BLOCKQUOTE>" . $this->text . "</BLOCKQUOTE><eol>";
		return $html;
	}
}

class ol_open {
	// Class to create an ordered list by returning the <OL> tag
	var $start;
	function set($varname,$value) {
		$this->$varname=$value;
	}
	function write() {
		// Create HTML
		$html="<OL><eol>";
		return $html;
	}
}

class ol_close {
	// Class to complete an ordered list by returning the </OL> tag
	var $start;
	function set($varname,$value) {
		$this->$varname=$value;
	}
	function write() {
		// Create HTML
		$html="</OL><eol>";
		return $html;
	}
}

class li {
	// Class to return the supplied text surrounded by the <LI> and </LI> tags
	var $text;
	function set($varname,$value) {
		$this->$varname=$value;
	}
	function write() {
		$html="<LI>";
		$html .= $this->text . "</LI><eol>";
		return $html;	
	}
}

class ul {
	// Class to return the supplied text surrounded by the <UL> and </UL> tags
	var $text;
	function set($varname,$value) {
		$this->$varname=$value;
	}
	function write() {
		$html="<UL>";
		$html .= $this->text . "</UL><eol>";
		return $html;	
	}
}

class div_open {
	// Class to open a <div> tag
	var $align;
	function set($varname,$value) {
		$this->$varname=$value;
	}
	function write() {
		$html="<DIV";
		if (!empty($this->align)) $html .=" align='$this->align'";
		$html .="><eol>";
		return $html;	
	}
}

class div_close {
	// Class to open a <div> tag
	function write() {
		$html="</DIV><eol>";
		return $html;	
	}
}

//	********************************************************************
//	*                                                                  *
//	* Graphical elements                                               *
//	*                                                                  *
//	********************************************************************

class image {
	// Class to create the <IMG> tag
	
	var $align;
	var $alt;
	var $border;
	var $height;
	var $hspace;
	var $ismap;
	var $src;
	var $usemap;
	var $vspace;
	var $width;
	
	// Create method to set defaults to other values
	function set($varname,$value) {
		$this->$varname=$value;
	}
	
	function write() {
		// Method to write out tag
		$html="IMG ";
		// Fill in attributes of tag
		if (!empty($this->align))  $html .=" align='$this->align'";
		if (!empty($this->alt))    $html .=" alt='$this->alt'";
		if (!empty($this->border)) $html .=" border='$this->border'";
		if (!empty($this->height)) $html .=" height='$this->height'";
		if (!empty($this->hspace)) $html .=" hspace='$this->hspace'";
		if (!empty($this->ismap))  $html .=" ismap='$this->ismap'";
		if (!empty($this->src))    $html .=" src='$this->src'";
		if (!empty($this->usemap)) $html .=" usemap='$this->usemap'";
		if (!empty($this->vspace)) $html .=" vspace='$this->vspace'";
		if (!empty($this->width))  $html .=" width='$this->width'";
		$html .="><eol>";
		return $html;
	}
}

class hr {
	// Class to create the <hr> tag
	
	var $align;
	var $noshade;
	var $size;
	var $width;
	
	// Create method to set defaults to other values
	function set($varname,$value) {
		$this->$varname=$value;
	}
	
	function write() {
		$html="<HR";
		if (!empty($this->align))   $html .=" align='$this->align'";
		if (!empty($this->noshade)) $html .=" noshade";
		if (!empty($this->size))    $html .=" size='$this->size'";
		if (!empty($this->width))   $html .=" width='$this->width'";
		$html .="><eol>";
		return $html;
	}
}

//	********************************************************************
//	*                                                                  *
//	* Table tags                                                       *
//	*                                                                  *
//	********************************************************************

class table_open {
	// Class to create a <TABLE> tag with the associated properties
	
	// Set default values
	var $align="";
	var $background="";
	var $bgcolor="";
	var $border="0";
	var $cellpadding="0";
	var $cellspacing="0";
	var $frame="";
	var $height="";
	var $hspace="";
	var $rules="";
	var $summary="";
	var $vspace="";
	var $width="100%";
	
	// Create method to set defaults to other values
	function set($varname,$value) {
		$this->$varname=$value;
	}

	// Create method to output string of HTML
	function write() {
		// Open tag
		$html="<TABLE";
		
		// Force these properties to be printed
		$html .=" cellpadding='$this->cellpadding'";
		$html .=" cellspacing='$this->cellspacing'";
		if (!empty($this->border))      $html .=" border='$this->border'";
		// Fill in the non-null properties
		if (!empty($this->align))       $html .=" align='$this->align'";
		if (!empty($this->background))  $html .=" background='$this->background'";
		if (!empty($this->bgcolor))     $html .=" bgcolor='$this->bgcolor'";
		if (!empty($this->frame))       $html .=" frame='$this->frame'";
		if (!empty($this->height))      $html .=" height='$this->height'";
		if (!empty($this->hspace))      $html .=" hspace='$this->hspace'";
		if (!empty($this->rules))       $html .=" rules='$this->rules'";
		if (!empty($this->summary))     $html .=" summary='$this->summary'";
		if (!empty($this->vspace))      $html .=" vspace='$this->vspace'";
		if (!empty($this->width))       $html .=" width='$this->width'";
		// Close the tag
		$html .="><eol>";
		return $html;	
	}
}

class table_close {
	// Class to write out closing </table> tag
	function write() {
		return "</TABLE><eol>";	
	}	
}

class table_row_open {
	// Class to create a <TR> tag with the associated properties
	
	// Set default values
	var $align="";
	var $bgcolor="";
	var $valign="";
	
	// Create a method to set defaults to other values
	function set($varname,$value) {
		$this->$varname=$value;
	}
	
	// Create method to output string of HTML
	function write() {
		$html="<TR";
		// Fill in non-null properties
		if (!empty($this->align))   $html .=" align='$this->align'";
		if (!empty($this->bgcolor)) $html .=" bgcolor='$this->bgcolor'";
		if (!empty($this->valign))  $html .=" valign='$this->valign'";
		// Close the tag
		$html .="><eol>";
		return $html;
	}
}

class table_row_close {
	// Class to create a </TR>

	// Create method to output string of HTML
	function write() {
		$html="</TR><eol>";
		return $html;
	}
}

class table_div_open {
	// Class to create a <TD> tag with the associated properties
	
	// Set default values
	var $align="";
	var $background="";
	var $bgcolor="";
	var $colspan="";
	var $height="";
	var $nowrap;
	var $rowspan="";
	var $valign="";
	var $width="";
	
	// Create a method to set defaults to other values
	function set($varname,$value) {
		$this->$varname=$value;
	}
	
	// Create method to output string of HTML
	function write() {
		$html="<TD";
		// Fill in non-null properties
		if (!empty($this->align))      $html .=" align='$this->align'";
		if (!empty($this->background)) $html .=" background='$this->background'";
		if (!empty($this->bgcolor))    $html .=" align='$this->bgcolor'";
		if (!empty($this->colspan))    $html .=" colspan='$this->colspan'";
		if (!empty($this->height))     $html .=" height='$this->height'";
		if (!empty($this->nowrap))     $html .=" nowrap";
		if (!empty($this->rowspan))    $html .=" rowspan='$this->rowspan'";
		if (!empty($this->valign))     $html .=" align='$this->valign'";
		if (!empty($this->width))      $html .=" width='$this->width'";
		// Close the tag
		$html .="><eol>";
		return $html;
	}
}

class table_div_close {
	// Class to create a </TD>

	// Create method to output string of HTML
	function write() {
		$html="</TD><eol>";
		return $html;
	}
}

class table_header_open {
	// Class to create a <TH> tag with the associated properties
	
	// Set default values
	var $align="";
	var $background="";
	var $bgcolor="";
	var $colspan="";
	var $height="";
	var $rowspan="";
	var $valign="";
	var $width="";
	
	// Create a method to set defaults to other values
	function set($varname,$value) {
		$this->$varname=$value;
	}
	
	// Create method to output string of HTML
	function write() {
		$html="<TH";
		// Fill in non-null properties
		if (!empty($this->align))      $html .=" align='$this->align'";
		if (!empty($this->background)) $html .=" background='$this->background'";
		if (!empty($this->bgcolor))    $html .=" align='$this->bgcolor'";
		if (!empty($this->colspan))    $html .=" colspan='$this->colspan'";
		if (!empty($this->height))     $html .=" height='$this->height'";
		if (!empty($this->rowspan))    $html .=" rowspan='$this->rowspan'";
		if (!empty($this->valign))     $html .=" align='$this->valign'";
		if (!empty($this->width))      $html .=" width='$this->width'";
		// Close the tag
		$html .="><eol>";
		return $html;
	}
}

class table_header_close {
	// Class to create a </TH>

	// Create method to output string of HTML
	function write() {
		$html="</TH><eol>";
		return $html;
	}
}

//	********************************************************************
//	*                                                                  *
//	* Forms                                                            *
//	*                                                                  *
//	********************************************************************

class form_open {
	// Class that creates the opening <FORM> tag with it sttributes
	
	var $action;
	var $enctype;
	var $method="post";
	
	// Create a method to set defaults to other values
	function set($varname,$value) {
		$this->$varname=$value;
	}
	
	// Create method to output string of HTML
	function write() {
		$html="<FORM";
		// Fill in non-null properties
		if (!empty($this->action))  $html .=" action='$this->action'";
		if (!empty($this->enctype)) $html .=" enctype='$this->enctype'";
		if (!empty($this->method))  $html .=" method='$this->method'";
		$html .="><eol>";
		return $html;
	}
}

class form_close {
		// Create method to output string of HTML
	function write() {
		$html="</FORM><eol>";
		return $html;
	}
}

class input {
	// Class to create a form <INPUT> tag
	
	var $accept;
	var $align;
	var $checked;
	var $maxlength;
	var $name;
	var $src;
	var $size;
	var $type;
	var $value;
		
	// Create a method to set defaults to other values
	function set($varname,$value) {
		$this->$varname=$value;
	}
	
	// Create method to output string of HTML
	function write() {
		$html="<INPUT";
		// Fill in non-null properties
		switch ($this->type) {
			case "button":
				if (!empty($this->name)) $html .=" name='$this->name'";
				if (!empty($this->value)) $html .=" value='$this->value'";
				break;
			case "checkbox":
				if (!empty($this->checked)) $html .=" checked='$this->checked'";
				if (!empty($this->name)) $html .=" name='$this->name'";
				if (!empty($this->value)) $html .=" value='$this->value'";
			case "file":
				if (!empty($this->accept)) $html .=" accept='$this->action'";
				if (!empty($this->name)) $html .=" name='$this->name'";
				if (!empty($this->value)) $html .=" value='$this->value'";
			case "hidden":
				if (!empty($this->name)) $html .=" name='$this->name'";
				if (!empty($this->value)) $html .=" value='$this->value'";
			case "image":
				if (!empty($this->align))  $html .=" align='$this->align'";
				if (!empty($this->name)) $html .=" name='$this->name'";
				if (!empty($this->src)) $html .=" src='$this->src'";
			case "password":
				if (!empty($this->maxlength)) $html .=" maxlength='$this->maxlength'";
				if (!empty($this->name)) $html .=" name='$this->name'";
				if (!empty($this->size)) $html .=" size='$this->size'";
				if (!empty($this->value)) $html .=" value='$this->value'";
			case "radio":
				if (!empty($this->checked)) $html .=" checked='$this->checked'";
				if (!empty($this->name)) $html .=" name='$this->name'";
				if (!empty($this->value)) $html .=" value='$this->value'";
			case "reset":
				if (!empty($this->value)) $html .=" value='$this->value'";
			case "submit":
				if (!empty($this->value)) $html .=" value='$this->value'";
			case "text":
				if (!empty($this->maxlength)) $html .=" maxlength='$this->maxlength'";
				if (!empty($this->name)) $html .=" name='$this->name'";
				if (!empty($this->size)) $html .=" size='$this->size'";
				if (!empty($this->value)) $html .=" value='$this->value'";
		}
		$html .="><eol>";
		return $html;
	}
}

class select_open {
	// Class to create <select> tag and associated tag
	
	var $multiple;
	var $name;
	var $size;
	
	// Create a method to set defaults to other values
	function set($varname,$value) {
		$this->$varname=$value;
	}
	
	// Create method to output string of HTML
	function write() {
		$html="<SELECT";
		// Fill in non-null properties
		if (!empty($this->multiple))  $html .=" multiple='$this->multiple'";
		if (!empty($this->name)) $html .=" name='$this->name'";
		if (!empty($this->size))  $html .=" size='$this->size'";
		$html .="><eol>";
		return $html;
	}
	
}

class select_close {
	// Class to output closing </SELECT> tag
		
	// Create method to output string of HTML
	function write() {
		$html="</SELECT><eol>";
		return $html;
	}
}

class option {
	// Class to create a <OPTION></OPTION> tag around the specified text
	
	var $selected;
	var $text="";
	var $value;
	var $width;
	
	// Create a method to set defaults to other values
	function set($varname,$value) {
		$this->$varname=$value;
	}
	
	function write() {
		// Create method to output string of HTML
		$html="<OPTION";
		if (!empty($this->selected)) $html .=" selected='$this->selected'";
		if (!empty($this->value))    $html .=" value='$this->value'";
		if (!empty($this->width))    $html .=" width='$this->width'";
		// close the tag
		$html .=">";
		// Insert the text to display
		$html .= "'$this->text'";
		// Close the tag off
		$html .="</SELECT><eol>";
		return $html;
	}
}

class textarea {
	// Class to create a textarea <TEXTAREA> tag with text in it and
	// the closing tag
	
	var $cols;
	var $name;
	var $rows;
	var $wrap;
	var $text;
	
	// Create a method to set defaults to other values
	function set($varname,$value) {
		$this->$varname=$value;
	}
	
	function write() {
		// Create method to output string of HTML
		$html="<TEXTAREA";
		if (!empty($this->cols))  $html .=" cols='$this->cols'";
		if (!empty($this->name))  $html .=" name='$this->name'";
		if (!empty($this->rows))  $html .=" rows='$this->rows'";
		if (!empty($this->wrap))  $html .=" wrap='$this->wrap'";
		// Close tag
		$htmml .=">";
		// Enclose optional default text
		$html .=$this->text;
		// Close tag
		$html .="</TEXTAREA>";
		return $html;
	}
}

//**************************************************************************
//*                                                                        *
//* HTML code formatter                                                    *
//*                                                                        *
//**************************************************************************

function pretty_html ($input_string, $offset=0) {
	// Function to replace <eol> tags with \r\n for readability
	// and to correctly indent HTML source code
	$output_string=str_replace("<eol>","\r\n",$input_string);
	return $output_string;
}
	
?>
