<?php
 include("lib_timing.php");
 timing_start('static_page'); 
?>

<HTML>
	<HEAD>
		<TITLE>Eurologic SPIDER Metrics</TITLE>
	</HEAD>
	<BODY>
		<!-- Start of main table to hold entire page -->
		<TABLE width=95% border=1 cellpadding=0 cellspacing=0>
			<TR>
				<TD valign=top>
					<!-- Start of main table to hold entire page -->
					<TABLE width=100% valign=top border=1 cellpadding=0 cellspacing=0><TR>
							<!-- Start of top row to hold page header -->
							<TD><H2>Eurologic SPIDER Metrics</H2></TD>
							<!-- End of top row to hold page header -->
						</TR><TR>
							<!-- Start of middle row to hold main page content -->
							<TD>
								<TABLE width=100% valign=top border=1 cellpadding=0 cellspacing=0>
									<TR>
										<TD width=25%><a href=index.php>Home</a></TD>
										<TD width=*>fred</TD>
									</TR>
								</TABLE>
							</TD>
							<!-- End of middle row to hold main page content -->
						</TR><TR>
							<!-- Start of bottom row to hold page footer -->
							<TD><FONT size=-2>The small print !</FONT></TD>
							<!-- End of bottom row to hold page footer -->
						</TR></TABLE>
					<!-- End of main table to hold entire page -->
				</TD>
			</TR>
		</TABLE>
		<!-- End of main table to hold entire page -->
	</BODY>
</HTML>
<?php
timing_stop('static_page');
echo "Whole script took: " . timing_current('static_page') . " seconds to run<BR>";

?>